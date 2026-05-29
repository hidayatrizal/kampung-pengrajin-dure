<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\URL;

// We need to set the URL generator for the asset and route helpers.
// But for simplicity, we'll use the built-in HTTP client and handle the CSRF token manually.

$baseUrl = 'http://127.0.0.1:8000';

// Step 1: Get the login page to extract the CSRF token from the meta tag or the form.
$loginPageResponse = Http::get($baseUrl.'/admin/login');
if ($loginPageResponse->clientError() || $loginPageResponse->serverError()) {
    echo "Failed to get login page: " . $loginPageResponse->status() . PHP_EOL;
    echo $loginPageResponse->body();
    exit;
}
$loginPageBody = $loginPageResponse->body();

// Extract the CSRF token from the meta tag: <meta name="csrf-token" content="...">
if (preg_match('/<meta name="csrf-token" content="([^"]+)"/', $loginPageBody, $matches)) {
    $csrfToken = $matches[1];
    echo "CSRF token found: " . substr($csrfToken, 0, 10) . "...\n";
} else {
    // Fallback: look for the token in the form input
    if (preg_match('/<input[^>]*name="csrf-token"[^>]*value="([^"]+)"/', $loginPageBody, $matches)) {
        $csrfToken = $matches[1];
        echo "CSRF token found in input: " . substr($csrfToken, 0, 10) . "...\n";
    } else {
        echo "Could not find CSRF token in login page." . PHP_EOL;
        // Show a snippet of the body for debugging
        echo substr($loginPageBody, 0, 500) . "...\n";
        exit;
    }
}

// Step 2: Post to the login route with the credentials and CSRF token.
$loginResponse = Http::asForm()->post($baseUrl.'/admin/login.post', [
    'email' => 'admin@desumkm.com',
    'password' => 'admin123',
    'remember' => false,
    '_token' => $csrfToken,
]);

// Check if we got a redirect (302) or a successful page (200)
if ($loginResponse->redirect()) {
    // Get the redirect URL from the headers
    $redirectUrl = $loginResponse->headers()['location'][0] ?? null;
    echo "Login successful, redirecting to: " . $redirectUrl . PHP_EOL;
    
    // Step 3: Follow the redirect to the dashboard (or wherever it goes)
    // We need to maintain the session, so we'll use the cookie jar from the response.
    // The HTTP client automatically handles cookies if we don't create a new instance each time.
    // But we are using Http::asForm() which creates a new request? Actually, the HTTP client is stateless by default.
    // We need to use the same instance with cookies. Let's redo with a single instance.
    
    // Let's restart and use a single HTTP client instance with cookie jar.
    echo "Restarting with cookie jar...\n";
    $client = Http::withOptions([
        'cookies' => true,
    ]);
    
    // Get login page again
    $loginPageResponse = $client->get($baseUrl.'/admin/login');
    $loginPageBody = $loginPageResponse->body();
    if (preg_match('/<meta name="csrf-token" content="([^"]+)"/', $loginPageBody, $matches)) {
        $csrfToken = $matches[1];
    } elseif (preg_match('/<input[^>]*name="csrf-token"[^>]*value="([^"]+)"/', $loginPageBody, $matches)) {
        $csrfToken = $matches[1];
    } else {
        die("Could not find CSRF token\n");
    }
    
    // Post login
    $loginResponse = $client->asForm()->post($baseUrl.'/admin/login.post', [
        'email' => 'admin@desumkm.com',
        'password' => 'admin123',
        'remember' => false,
        '_token' => $csrfToken,
    ]);
    
    if ($loginResponse->redirect()) {
        $redirectUrl = $loginResponse->headers()['location'][0] ?? null;
        echo "Login redirect to: " . $redirectUrl . PHP_EOL;
        
        // Now get the dashboard
        $dashboardResponse = $client->get($baseUrl.'/admin/dashboard');
        echo "Dashboard response status: " . $dashboardResponse->status() . PHP_EOL;
        if ($dashboardResponse->successful()) {
            $dashboardBody = $dashboardResponse->body();
            echo "Dashboard body length: " . strlen($dashboardBody) . PHP_EOL;
            if (strpos($dashboardBody, 'Selamat Datang') !== false) {
                echo "Dashboard contains welcome text - SUCCESS!\n";
            } else {
                echo "Dashboard does NOT contain welcome text.\n";
                // Show first 500 chars
                echo substr($dashboardBody, 0, 500) . "...\n";
            }
        } else {
            echo "Dashboard request failed: " . $dashboardResponse->status() . PHP_EOL;
            echo $dashboardResponse->body();
        }
    } else {
        echo "Login did not redirect. Response status: " . $loginResponse->status() . PHP_EOL;
        echo $loginResponse->body();
    }
} else {
    // Login might have failed and returned to the login page with errors
    echo "Login did not redirect. Response status: " . $loginResponse->status() . PHP_EOL;
    // Check if there are validation errors in the body
    if (strpos($loginResponse->body(), 'Kredensial yang diberikan tidak cocok') !== false) {
        echo "Login failed: invalid credentials.\n";
    } else {
        echo "Login response body (first 500 chars):\n";
        echo substr($loginResponse->body(), 0, 500) . "...\n";
    }
}