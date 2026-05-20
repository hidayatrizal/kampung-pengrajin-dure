<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Craftsman;
use App\Models\Gallery;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('craftsman')->orderBy('id', 'desc')->take(3)->get();
        $craftsmen = Craftsman::orderBy('id', 'desc')->take(2)->get();
        $galleries = Gallery::orderBy('id', 'desc')->get();

        return view('pages.home', compact('products', 'craftsmen', 'galleries'));
    }
}