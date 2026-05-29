<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
$users = App\Models\User::get();
foreach($users as $u){
    echo $u->id . ': ' . $u->email . ' - ' . $u->password . PHP_EOL;
}