<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('/', function () {
        // dd($_COOKIE);
        return view('welcome');
    })->name('dashboard');
});

Route::get('login', [AuthController::class, 'showLogin'])->name('auth.showLogin');
Route::get('register', [AuthController::class, 'showRegister'])->name('auth.showregister');

Route::group(['middleware'=>['jwt.verify']],function(){
    Route::resource('product',ProductController::class);
});
Route::get('addToCart}',[ProductController::class,'addToCart'])->name('product.addToCart');