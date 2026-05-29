<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;

// 1. Log in the user
$user = User::where('email', 'admin@desadure.id')->first();
if (!$user) {
    die("User not found\n");
}
if (!Hash::check('password', $user->password)) {
    die("Password mismatch\n");
}
Auth::login($user); // This logs in the user for the current request

// 2. Now simulate a request to admin/dashboard
$request = Request::create('/admin/dashboard', 'GET');

// Set the current session (Laravel uses the session from the container)
// We need to set the user in the session manually? Auth::login already does that via the guard.
// But we need to make sure the request has the same session.
// Let's just call the route directly via the container's route resolver.
// However, easier: we can just call the controller method and see if it returns a view.
// But we want to test middleware etc.

// Instead, let's check if the user is authenticated via Auth::check()
if (Auth::check()) {
    echo "User is authenticated: " . Auth::user()->email . PHP_EOL;
} else {
    echo "User is NOT authenticated after Auth::login\n";
    die;
}

// 3. Now try to call the dashboard controller method directly
$controller = new App\Http\Controllers\Admin\DashboardController();
try {
    $response = $controller->index();
    // If it returns a View, we can render it
    if ($response instanceof \Illuminate\Contracts\View\View) {
        $content = $response->render();
        echo "Dashboard view rendered successfully. Length: " . strlen($content) . PHP_EOL;
        // Check for expected content
        if (strpos($content, 'Selamat Datang') !== false) {
            echo "Dashboard contains welcome text." . PHP_EOL;
        } else {
            echo "Dashboard does NOT contain expected welcome text." . PHP_EOL;
            // Show snippet
            echo substr($content, 0, 200) . "..." . PHP_EOL;
        }
    } else {
        echo "Controller returned: " . gettype($response) . PHP_EOL;
        var_dump($response);
    }
} catch (\Exception $e) {
    echo "Exception when calling dashboard controller: " . $e->getMessage() . PHP_EOL;
    echo $e->getTraceAsString();
}