<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Craftsman;
use App\Models\ProductImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Upload file ke Cloudinary
     */
    private function uploadToCloudinary($file, $folder = 'products')
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
            // Ambil public_id dari URL Cloudinary
            // Contoh URL: https://res.cloudinary.com/cloud/image/upload/v123/products/filename.jpg
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
        $products = Product::with(['craftsman', 'images'])->orderBy('id', 'desc')->paginate(20);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $craftsmen = Craftsman::orderBy('name')->get();
        return view('admin.products.create', compact('craftsmen'));
    }

    public function edit(Product $product)
    {
        $craftsmen = Craftsman::orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'craftsmen'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'craftsman_id'          => 'nullable|exists:craftsmen,id',
            'name'                  => 'required|string|max:255',
            'price'                 => 'required|string|max:255',
            'category'              => 'nullable|string|max:255',
            'description'           => 'required|string',
            'image'                 => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'wa'                    => 'nullable|string|max:20',
            'additional_images.*'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Upload gambar utama ke Cloudinary
        if ($request->hasFile('image')) {
            $validated['image'] = $this->uploadToCloudinary($request->file('image'), 'products');
        }

        $product = Product::create($validated);

        // Upload gambar tambahan ke Cloudinary
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $index => $file) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image'      => $this->uploadToCloudinary($file, 'products'),
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'craftsman_id'          => 'nullable|exists:craftsmen,id',
            'name'                  => 'required|string|max:255',
            'price'                 => 'required|string|max:255',
            'category'              => 'nullable|string|max:255',
            'description'           => 'required|string',
            'image'                 => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'wa'                    => 'nullable|string|max:20',
            'additional_images.*'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Hapus gambar lama & upload baru ke Cloudinary
        if ($request->hasFile('image')) {
            $this->deleteFromCloudinary($product->getRawOriginal('image'));
            $validated['image'] = $this->uploadToCloudinary($request->file('image'), 'products');
        }

        $product->update($validated);

        // Upload gambar tambahan
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $index => $file) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image'      => $this->uploadToCloudinary($file, 'products'),
                    'sort_order' => $product->images()->max('sort_order') + $index + 1,
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        // Hapus gambar utama dari Cloudinary
        $this->deleteFromCloudinary($product->getRawOriginal('image'));

        // Hapus semua gambar tambahan dari Cloudinary
        foreach ($product->images as $img) {
            $this->deleteFromCloudinary($img->getRawOriginal('image'));
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    public function destroyImage(Product $product, ProductImage $image)
    {
        if ($image->product_id !== $product->id) {
            abort(403);
        }

        $this->deleteFromCloudinary($image->getRawOriginal('image'));
        $image->delete();

        return back()->with('success', 'Gambar berhasil dihapus.');
    }
}