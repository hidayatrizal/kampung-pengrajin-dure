<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Craftsman;
use App\Models\Gallery;
use App\Models\ContactMessage;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $productsCount = Product::count();
        $craftsmenCount = Craftsman::count();
        $galleriesCount = Gallery::count();
        $unreadMessages = ContactMessage::where('is_read', false)->count();

        $recentProducts = Product::with('craftsman')->orderBy('id', 'desc')->take(5)->get();
        $recentMessages = ContactMessage::orderBy('id', 'desc')->take(5)->get();

        $categories = Product::selectRaw('category, COUNT(*) as count')
            ->groupBy('category')
            ->orderByDesc('count')
            ->get();

        return view('admin.dashboard', compact(
            'productsCount',
            'craftsmenCount',
            'galleriesCount',
            'unreadMessages',
            'recentProducts',
            'recentMessages',
            'categories'
        ));
    }
}