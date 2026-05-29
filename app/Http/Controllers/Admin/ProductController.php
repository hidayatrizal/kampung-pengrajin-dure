<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Craftsman;
use App\Models\ProductImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'craftsman_id' => 'nullable|exists:craftsmen,id',
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'wa' => 'nullable|string|max:20',
            'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        $product = Product::create($validated);

        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $index => $file) {
                $path = $file->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $craftsmen = Craftsman::orderBy('name')->get();
        $product->load('images');
        return view('admin.products.edit', compact('product', 'craftsmen'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'craftsman_id' => 'nullable|exists:craftsmen,id',
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'wa' => 'nullable|string|max:20',
            'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = Storage::url($path);
        }

        $product->update($validated);

        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $index => $file) {
                $path = $file->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                    'sort_order' => $product->images()->max('sort_order') + $index + 1,
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        foreach ($product->images as $img) {
            if (Storage::disk('public')->exists($img->image)) {
                Storage::disk('public')->delete($img->image);
            }
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

        if (Storage::disk('public')->exists($image->image)) {
            Storage::disk('public')->delete($image->image);
        }

        $image->delete();

        return back()->with('success', 'Gambar berhasil dihapus.');
    }
}