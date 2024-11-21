<?php

use App\Http\Controllers\SampleController;
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

Route::get('/sample', [SampleController::class, "index"])->name("sample.index");
Route::get('/sample/get_number', [SampleController::class, "getNumber"])->name("sample.getNumber");

Route::get("/users", [UserController::class, "index"])->name("users.index");
