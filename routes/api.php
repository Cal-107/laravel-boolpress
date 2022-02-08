<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Test route API
Route::get('/test', function() {
    return response()->json([
        'clients' => ['Jax', 'Tommy', 'Walter'],
        'Type' => 'Premium',
    ]);
});

// Create a endpoint for the Api's
Route::namespace('Api')->group(function() {
    // Post archive
    Route::get('/posts', 'PostController@index');
});