<?php

use App\Helpers\Routes\RouteHelper;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'server' => 'swoole',
        'octane' => app()->bound('octane'),
        'swoole_version' => swoole_version(),
        'php_version' => phpversion(),
    ]);
});
Route::get('/user', function () {
    return User::all();
});

// Route::prefix('api/v1')->group(function () {
//     RouteHelper::includeRouteFiles(__DIR__ . '/v1');
// });
