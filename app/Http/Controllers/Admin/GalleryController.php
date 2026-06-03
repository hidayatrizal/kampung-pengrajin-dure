<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gallery;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GalleryController extends Controller
{
    /**
     * Upload file ke Cloudinary
     */
    private function uploadToCloudinary($file, $folder = 'gallery')
    {
        try {
            $uploaded = cloudinary()->upload($file->getRealPath(), [
                'folder' => $folder,
                'resource_type' => 'image',
            ]);
            return $uploaded->getSecurePath();
        } catch (\Exception $e) {
            Log::error('Cloudinary upload error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Hapus file dari Cloudinary berdasarkan URL
     */
    private function deleteFromCloudinary($url)
    {
        if (!$url || !filter_var($url, FILTER_VALIDATE_URL)) {
            return false;
        }

        try {
            $pattern = '/\/upload\/(?:v\d+\/)?(.+)\.[a-zA-Z]+$/';
            if (preg_match($pattern, $url, $matches)) {
                $publicId = $matches[1];
                cloudinary()->destroy($publicId);
                Log::info('Deleted from Cloudinary: ' . $publicId);
                return true;
            }
        } catch (\Exception $e) {
            Log::error('Cloudinary delete error: ' . $e->getMessage());
        }

        return false;
    }

    public function index()
    {
        $galleries = Gallery::orderBy('id', 'desc')->get();
        return view('admin.gallery.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'    => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'url'      => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('url')) {
            $validated['url'] = $this->uploadToCloudinary($request->file('url'), 'gallery');
        }

        Gallery::create($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title'    => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'url'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('url')) {
            $this->deleteFromCloudinary($gallery->getRawOriginal('url'));
            $validated['url'] = $this->uploadToCloudinary($request->file('url'), 'gallery');
        }

        $gallery->update($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Foto galeri berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery)
    {
        $this->deleteFromCloudinary($gallery->getRawOriginal('url'));
        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Foto galeri berhasil dihapus.');
    }
}