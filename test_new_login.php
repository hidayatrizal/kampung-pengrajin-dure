<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Auth;
use App\Models\User;

// Test authentication with new credentials
$credentials = [
    'email' => 'admin@desumkm.com',
    'password' => 'admin123',
];

if (Auth::attempt($credentials)) {
    echo "Authentication successful with new credentials!" . PHP_EOL;
    echo "User: " . Auth::user()->email . PHP_EOL;
    Auth::logout(); // Clean up
} else {
    echo "Authentication failed with new credentials." . PHP_EOL;
}

// Also test the old credentials to confirm they no longer work
$oldCredentials = [
    'email' => 'admin@desadure.id',
    'password' => 'password',
];

if (Auth::attempt($oldCredentials)) {
    echo "Old credentials still work (unexpected)" . PHP_EOL;
    Auth::logout();
} else {
    echo "Old credentials correctly rejected." . PHP_EOL;
}