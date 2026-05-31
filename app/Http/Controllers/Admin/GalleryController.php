<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gallery;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    private function getDisk()
    {
        return (getenv('VERCEL') !== false || ($_SERVER['VERCEL'] ?? null) === '1')
            ? 'vercel' : env('FILESYSTEM_DISK', 'public');
    }

    private function uploadToVercelBlob($file, $path = 'gallery')
    {
        // Only use Vercel Blob when actually on Vercel
        if (!((getenv('VERCEL') !== false || ($_SERVER['VERCEL'] ?? null) === '1'))) {
            return $file->store($path, 'public');
        }

        try {
            // For Vercel deployment, we'll use the vercel disk
            // which is configured to use /tmp/storage/app/public
            // Vercel's serverless functions can write to /tmp
            $disk = 'vercel';
            
            // Generate a unique filename to avoid conflicts
            $filename = Str::uuid() . '_' . $file->getClientOriginalName();
            $filePath = $path . '/' . $filename;
            
            // Store the file
            $storedPath = $file->storeAs($path, $filename, $disk);
            
            Log::info('File uploaded to Vercel disk: ' . $storedPath);
            
            return $storedPath;
        } catch (\Exception $e) {
            Log::error('Error uploading to Vercel disk: ' . $e->getMessage());
            // Fallback to local storage on error
            return $file->store($path, 'public');
        }
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
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'url' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('url')) {
            $validated['url'] = $this->uploadToVercelBlob($request->file('url'), 'gallery');
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
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'url' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $disk = $this->getDisk();
        if ($request->hasFile('url')) {
            $oldUrl = $gallery->getRawOriginal('url');
            if ($oldUrl && Storage::disk($disk)->exists($oldUrl)) {
                Storage::disk($disk)->delete($oldUrl);
            }
            $validated['url'] = $request->file('url')->store('gallery', $disk);
        }

        $gallery->update($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Foto galeri berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery)
    {
        $disk = $this->getDisk();
        $oldUrl = $gallery->getRawOriginal('url');
        if ($oldUrl && Storage::disk($disk)->exists($oldUrl)) {
            Storage::disk($disk)->delete($oldUrl);
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Foto galeri berhasil dihapus.');
    }
}
