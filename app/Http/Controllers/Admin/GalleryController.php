<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gallery;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Traits\VercelBlobStorage;

class GalleryController extends Controller
{
    use VercelBlobStorage;

    private function getDisk()
    {
        return (getenv('VERCEL') !== false || ($_SERVER['VERCEL'] ?? null) === '1')
            ? 'vercel' : env('FILESYSTEM_DISK', 'public');
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
            if ($oldUrl) {
                $this->deleteStorageFile($disk, $oldUrl);
            }
            $validated['url'] = $this->uploadToVercelBlob($request->file('url'), 'gallery');
        }

        $gallery->update($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Foto galeri berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery)
    {
        $disk = $this->getDisk();
        $oldUrl = $gallery->getRawOriginal('url');
        if ($oldUrl) {
            $this->deleteStorageFile($disk, $oldUrl);
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Foto galeri berhasil dihapus.');
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
            if ($oldUrl) {
                $this->deleteStorageFile($disk, $oldUrl);
            }
            $validated['url'] = $this->uploadToVercelBlob($request->file('url'), 'gallery');
        }

        $gallery->update($validated);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Foto galeri berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery)
    {
        $disk = $this->getDisk();
        $oldUrl = $gallery->getRawOriginal('url');
        if ($oldUrl) {
            $this->deleteStorageFile($disk, $oldUrl);
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Foto galeri berhasil dihapus.');
    }
}
