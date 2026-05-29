<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
$products = App\Models\Product::get();
foreach($products as $p){
    echo $p->name . ' | ' . $p->image . PHP_EOL;
}