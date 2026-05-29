<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
use App\Models\Product;

$products = Product::take(5)->get();
foreach ($products as $p) {
    echo "Product ID: {$p->id} - Name: {$p->name}\n";
    echo "  Raw image from DB: {$p->image}\n";
    echo "  GetAttribute result: {$p->getImageAttribute($p->image)}\n";
    echo "  Starts with http? " . (preg_match('/^https?:\/\//', $p->image) ? 'Yes' : 'No') . "\n";
    echo "\n";
}