<?php

use App\Http\Controllers\SampleController;
use App\Http\Controllers\SampleOctaneCacheController;
use App\Http\Controllers\TransactionSampleController;
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

Route::get('/sample/number', [SampleController::class, "index"]);
Route::get('/sample/number/apc', [SampleController::class, "number_of_apc_cache"]);
Route::get('/sample/number/redis', [SampleController::class, "number_of_redis_cache"]);
Route::get('/sample/long/apc', [SampleController::class, "long_key_value_apc_cache"]);
Route::get('/sample/long/redis', [SampleController::class, "long_key_value_redis_cache"]);
Route::get('/sample/number/octane/cache', [SampleOctaneCacheController::class, "index"]);
Route::get('/sample/long/octane/cache', [SampleOctaneCacheController::class, "long_key_value_cache"]);
Route::get('/sample/number/octane/tables', [SampleOctaneCacheController::class, "octane_table"]);

Route::get('/sample/normal/get', [TransactionSampleController::class, 'normalGet']);
Route::get('/sample/transaction/get', [TransactionSampleController::class, 'transactionGet']);
Route::get('/sample/normal/create', [TransactionSampleController::class, 'normalCreate']);
Route::get('/sample/transaction/create', [TransactionSampleController::class, 'transactionCreate']);
Route::get('/sample/normal/update', [TransactionSampleController::class, 'normalUpdate']);
Route::get('/sample/transaction/update', [TransactionSampleController::class, 'transactionUpdate']);

Route::get("/users", [UserController::class, "index"]);
