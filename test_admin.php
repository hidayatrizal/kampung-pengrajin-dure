<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Auth;
use App\Models\User;

// Attempt to authenticate
$credentials = [
    'email' => 'admin@desadure.id',
    'password' => 'password',
];

if (Auth::attempt($credentials)) {
    echo "Authentication successful!" . PHP_EOL;
    echo "User: " . Auth::user()->email . PHP_EOL;
    // Now try to access a protected route by checking if user can access admin dashboard
    // We can just see if the user is authenticated
    if (Auth::check()) {
        echo "Auth check passes." . PHP_EOL;
    }
    // Try to get the dashboard view? Not needed.
    // Let's see if we can redirect manually? Not needed.
    // Instead, we can try to visit the dashboard via a simulated request.
    // But for now, just confirm login works.
    Auth::logout(); // logout after test
} else {
    echo "Authentication failed." . PHP_EOL;
}