<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Http\Controllers\Api\V1'], function () {
    // V1 routes will go here
    Route::get('/test', function() {
        return response()->json(['version' => 'v1']);
    });
});
