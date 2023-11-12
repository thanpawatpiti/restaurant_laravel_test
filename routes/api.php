<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apis\RestaurantLaravelTestController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// For the restaurant-laravel-test page
// POST /api/restaurant-laravel-test/search
Route::post('/restaurant-laravel-test/search', function (Request $request) {
    return (new RestaurantLaravelTestController)->search($request);
});
