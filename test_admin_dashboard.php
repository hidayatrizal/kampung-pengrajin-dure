<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;

// Simulate a login
$request = Request::create('/admin/login', 'POST', [
    'email' => 'admin@desadure.id',
    'password' => 'password',
    'remember' => false,
]);

// Set up session
$session = new Session();
$session->start();
$request->setSession($session);

// Dispatch the login route
$response = \Illuminate\Support\Facades\Route::dispatch($request);

// If login succeeded, it should redirect (status 302)
if ($response->getStatusCode() == 302) {
    echo "Login successful, redirecting to: " . $response->headers->get('Location') . PHP_EOL;
    
    // Now follow the redirect to dashboard
    $redirectUrl = $response->headers->get('Location');
    $dashboardRequest = Request::create($redirectUrl, 'GET');
    $dashboardRequest->setSession($session);
    
    // Set the user in the request (simulate auth)
    $user = User::where('email', 'admin@desadure.id')->first();
    Auth::login($user);
    
    // Now dispatch the dashboard request
    $dashboardResponse = \Illuminate\Support\Facades\Route::dispatch($dashboardRequest);
    
    echo "Dashboard response status: " . $dashboardResponse->getStatusCode() . PHP_EOL;
    if ($dashboardResponse->getStatusCode() == 200) {
        echo "Dashboard loaded successfully!" . PHP_EOL;
        // Check if it contains expected content
        $content = $dashboardResponse->getContent();
        if (strpos($content, 'Selamat Datang') !== false) {
            echo "Dashboard contains expected welcome text." . PHP_EOL;
        } else {
            echo "Dashboard might be missing expected content." . PHP_EOL;
            // Show first 500 chars for debugging
            echo substr($content, 0, 500) . "..." . PHP_EOL;
        }
    } else {
        echo "Dashboard failed to load. Response:" . PHP_EOL;
        echo $dashboardResponse->getContent();
    }
} else {
    echo "Login failed. Response status: " . $response->getStatusCode() . PHP_EOL;
    echo "Response: " . $response->getContent() . PHP_EOL;
}