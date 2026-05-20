<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Craftsman;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['craftsman', 'images']);

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('toko')) {
            $query->where('craftsman_id', $request->toko);
        }

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $products = $query->orderBy('id', 'desc')->get();
        $categories = Product::distinct()->pluck('category')->sort()->values()->all();
        $craftsmen = Craftsman::orderBy('name')->get();

        return view('pages.catalog', compact('products', 'categories', 'craftsmen'));
    }
}