<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
use Illuminate\Support\Facades\Hash;
$user = App\Models\User::where('email', 'admin@desadure.id')->first();
if ($user) {
    echo "User: " . $user->email . PHP_EOL;
    echo "Password hash: " . $user->password . PHP_EOL;
    // Check if password matches
    if (Hash::check('password', $user->password)) {
        echo "Password 'password' matches!" . PHP_EOL;
    } else {
        echo "Password 'password' does NOT match." . PHP_EOL;
    }
} else {
    echo "No user found" . PHP_EOL;
}