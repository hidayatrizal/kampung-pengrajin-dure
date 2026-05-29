<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
$p = App\Models\Product::find(3);
if ($p) {
    echo "Product: " . $p->name . PHP_EOL;
    echo "Image attribute: " . $p->image . PHP_EOL;
    // Also check the raw attribute
    echo "Raw image: " . $p->getAttributes()['image'] ?? 'null' . PHP_EOL;
} else {
    echo "Product not found\n";
}