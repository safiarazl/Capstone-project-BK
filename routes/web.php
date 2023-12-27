<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogRegController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [LogRegController::class, 'loginForm'])->name('login');
Route::post('/login-proses', [LogRegController::class, 'loginProses'])->name('loginProses');

Route::get('/register', [LogRegController::class, 'registerForm'])->name('register');
Route::post('/register-proses', [LogRegController::class, 'registerProses'])->name('registerProses');
