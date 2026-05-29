<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
$products = App\Models\Product::where('image', 'like', 'http://127.0.0.1:8000/storage/%')->get();
foreach($products as $p){
    echo $p->id . ' | ' . $p->name . ' | ' . $p->image . PHP_EOL;
}
if ($products->isEmpty()) {
    echo "No products with local storage image URLs found.\n";
}