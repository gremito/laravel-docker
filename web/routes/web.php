<?php

use App\Http\Controllers\SampleController;
use App\Http\Controllers\SampleOctaneCacheDriverController;
use App\Http\Controllers\SampleOctaneTablesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sample', [SampleController::class, "index"]);
Route::get('/sample/number/redis', [SampleController::class, "numberOfRedisCache"]);
Route::get('/sample/number/apc', [SampleController::class, "numberOfApcCache"]);
Route::get('/sample/octane_cache', [SampleOctaneCacheDriverController::class, "index"]);
Route::get('/sample/octane_tables', [SampleOctaneTablesController::class, "index"]);

Route::get("/users", [UserController::class, "index"]);
