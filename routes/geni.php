<?php

use App\Helpers\Routes\RouteHelper;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    RouteHelper::includeRouteFiles(__DIR__ . '/v1');
});
Route::get('/wew', function () {
    return response()->json([
        'status' => 'ok',
        'server' => 'swoole',
        'octane' => app()->bound('octane'),
        'swoole_version' => swoole_version(),
        'php_version' => phpversion(),
    ]);
})
