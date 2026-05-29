<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Check if user with desired email exists
$existingUser = User::where('email', 'admin@desumkm.com')->first();

if ($existingUser) {
    // Update password if user exists
    $existingUser->password = Hash::make('admin123');
    $existingUser->name = 'Admin Desa Dure'; // Update name too
    $existingUser->save();
    echo "Updated existing user: admin@desumkm.com" . PHP_EOL;
} else {
    // Check if the original user exists and update it instead
    $origUser = User::where('email', 'admin@desadure.id')->first();
    if ($origUser) {
        // Update the original user to the desired credentials
        $origUser->email = 'admin@desumkm.com';
        $origUser->password = Hash::make('admin123');
        $origUser->name = 'Admin Desa Dure';
        $origUser->save();
        echo "Updated user from admin@desadure.id to admin@desumkm.com" . PHP_EOL;
    } else {
        // Create new user
        User::create([
            'name' => 'Admin Desa Dure',
            'email' => 'admin@desumkm.com',
            'password' => Hash::make('admin123'),
        ]);
        echo "Created new user: admin@desumkm.com" . PHP_EOL;
    }
}

// Verify the user can be authenticated
$user = User::where('email', 'admin@desumkm.com')->first();
if ($user && Hash::check('admin123', $user->password)) {
    echo "Credentials verified: admin@desumkm.com / admin123" . PHP_EOL;
} else {
    echo "ERROR: Failed to verify credentials" . PHP_EOL;
}