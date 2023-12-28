<?php

use App\Http\Controllers\AdminDashboard;
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

Route::get('/logout', [LogRegController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('adminDashboard');

    Route::get('/manage-dokter', [AdminDashboard::class, 'manageDokter'])->name('manageDokter');

    Route::get('/tambah-dokter', [AdminDashboard::class, 'tambahDokter'])->name('tambahDokter');
    Route::post('/tambah-dokter-proses', [AdminDashboard::class, 'tambahDokterProses'])->name('tambahDokterProses');

    Route::delete('/delete-dokter-proses/{id}', [AdminDashboard::class, 'deleteDokterProses'])->name('deleteDokterProses');

    Route::get('/edit-dokter/{id}', [AdminDashboard::class, 'editDokter'])->name('editDokter');
    Route::put('/edit-dokter-proses/{id}', [AdminDashboard::class, 'editDokterProses'])->name('editDokterProses');
});
