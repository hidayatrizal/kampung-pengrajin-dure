<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
use App\Models\Product;
use App\Models\ProductImage;

// Fix products with incorrect image paths
$products = Product::where('image', 'like', 'http://%')->orWhere('image', 'like', 'https://%')->get();
foreach($products as $product) {
    // These are already correct (external URLs), skip
    echo "Product {$product->id}: External URL - {$product->image}\n";
}

$products = Product::where('image', 'like', '/storage/%')->get();
foreach($products as $product) {
    // Extract the actual filename from the incorrect path
    // /storage/products/filename.jpg -> products/filename.jpg
    if (preg_match('#/storage/(.+)$#', $product->image, $matches)) {
        $correctPath = $matches[1];
        echo "Product {$product->id}: Fixing '{$product->image}' -> '{$correctPath}'\n";
        $product->image = $correctPath;
        $product->save();
    }
}

// Fix product images
$images = ProductImage::where('image', 'like', '/storage/%')->get();
foreach($images as $image) {
    if (preg_match('#/storage/(.+)$#', $image->image, $matches)) {
        $correctPath = $matches[1];
        echo "ProductImage {$image->id}: Fixing '{$image->image}' -> '{$correctPath}'\n";
        $image->image = $correctPath;
        $image->save();
    }
}

echo "Done fixing existing data.\n";