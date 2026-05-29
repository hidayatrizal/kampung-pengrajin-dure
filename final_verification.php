<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== FINAL VERIFICATION ===\n\n";

// Check a few products
use App\Models\Product;
use App\Models\ProductImage;

$products = Product::with(['craftsman'])->take(4)->get();
foreach($products as $p) {
    echo "Product ID: {$p->id}\n";
    echo "  Name: {$p->name}\n";
    echo "  Raw DB Value: '{$p->image}'\n";
    echo "  Processed URL: '{$p->getImageAttribute($p->image)}'\n";
    
    // Check if it's accessible
    $url = $p->getImageAttribute($p->image);
    if (preg_match('#^https?://#', $url)) {
        echo "  Type: External URL\n";
    } elseif (preg_match('#^/storage/#', $url)) {
        echo "  Type: Local Storage URL\n";
        // Check if file exists
        $filePath = public_path($url);
        if (file_exists($filePath)) {
            echo "  Status: File EXISTS ✓\n";
        } else {
            echo "  Status: File MISSING ✗\n";
        }
    } else {
        echo "  Type: Unknown format\n";
    }
    echo "\n";
}

// Check product images
echo "Product Images:\n";
$images = ProductImage::take(3)->get();
foreach($images as $img) {
    echo "  Image ID: {$img->id} (Product ID: {$img->product_id})\n";
    echo "    Raw DB Value: '{$img->image}'\n";
    echo "    Processed URL: '{$img->getImageAttribute($img->image)}'\n";
    
    $url = $img->getImageAttribute($img->image);
    if (preg_match('#^/storage/#', $url)) {
        $filePath = public_path($url);
        if (file_exists($filePath)) {
            echo "    Status: File EXISTS ✓\n";
        } else {
            echo "    Status: File MISSING ✗\n";
        }
    }
    echo "\n";
}

echo "=== VERIFICATION COMPLETE ===\n";