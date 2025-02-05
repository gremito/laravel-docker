<?php

use App\Http\Controllers;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(Controllers\Api\SampleController::class)->group(function () {
    Route::get('/sample', 'index');
    Route::get('/sample/get_number', 'getNumber');
});

Route::controller(Controllers\Api\SampleOctaneCacheDriverController::class)->group(function () {
    Route::get('/sample/octane_cache', 'index');
});

Route::controller(Controllers\Api\SampleOctaneTablesController::class)->group(function () {
    Route::get('/sample/octane_tables', 'index');
});

Route::get('/', function () {
    return response()->json([
        'message' => 'This is a simple example of item returned by your APIs. Everyone can see it.'
    ]);
});
