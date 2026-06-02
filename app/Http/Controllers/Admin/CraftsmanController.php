<?php

namespace App\Http\Controllers\Admin;

use App\Models\Craftsman;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Traits\VercelBlobStorage;

class CraftsmanController extends Controller
{
    use VercelBlobStorage;

    private function getDisk()
    {
        return (getenv('VERCEL') !== false || ($_SERVER['VERCEL'] ?? null) === '1')
            ? 'vercel' : env('FILESYSTEM_DISK', 'public');
    }

    public function index()
    {
        $craftsmen = Craftsman::withCount('products')->orderBy('id', 'desc')->get();
        return view('admin.craftsmen.index', compact('craftsmen'));
    }

    public function create()
    {
        return view('admin.craftsmen.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:500',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'capacity' => 'nullable|integer|min:0',
            'price' => 'nullable|string|max:255',
            'wa' => 'nullable|string|max:20',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->uploadToVercelBlob($request->file('image'), 'craftsmen');
        }

        Craftsman::create($validated);

        return redirect()->route('admin.craftsmen.index')
            ->with('success', 'Toko/UMKM berhasil ditambahkan.');
    }

    public function edit(Craftsman $craftsman)
    {
        return view('admin.craftsmen.edit', compact('craftsman'));
    }

    public function update(Request $request, Craftsman $craftsman)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:500',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'capacity' => 'nullable|integer|min:0',
            'price' => 'nullable|string|max:255',
            'wa' => 'nullable|string|max:20',
        ]);

        if ($request->hasFile('image')) {
            $oldImage = $craftsman->getRawOriginal('image');
            if ($oldImage) {
                $this->deleteStorageFile($oldImage);
            }
            $validated['image'] = $this->uploadToVercelBlob($request->file('image'), 'craftsmen');
        }

        $craftsman->update($validated);

        return redirect()->route('admin.craftsmen.index')
            ->with('success', 'Toko/UMKM berhasil diperbarui.');
    }

    public function destroy(Craftsman $craftsman)
    {
        $oldImage = $craftsman->getRawOriginal('image');
        if ($oldImage) {
            $this->deleteStorageFile($oldImage);
        }

        $craftsman->delete();

        return redirect()->route('admin.craftsmen.index')
            ->with('success', 'Toko/UMKM berhasil dihapus.');
    }
}
