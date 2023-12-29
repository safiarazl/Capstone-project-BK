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

Route::get('/login', [LogRegController::class, 'loginForm'])->name('login');
Route::post('/login-proses', [LogRegController::class, 'loginProses'])->name('loginProses');

Route::get('/register', [LogRegController::class, 'registerForm'])->name('register');
Route::post('/register-proses', [LogRegController::class, 'registerProses'])->name('registerProses');

Route::get('/logout', [LogRegController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('adminDashboard');
    Route::get('/', function () {
        return view('welcome');
    });

    // admin dokter routes
    Route::get('/manage-dokter', [AdminDashboard::class, 'manageDokter'])->name('manageDokter');
    Route::post('/tambah-dokter-proses', [AdminDashboard::class, 'tambahDokterProses'])->name('tambahDokterProses');
    Route::delete('/delete-dokter-proses/{id}', [AdminDashboard::class, 'deleteDokterProses'])->name('deleteDokterProses');
    Route::get('/edit-dokter/{id}', [AdminDashboard::class, 'editDokter'])->name('editDokter');
    Route::put('/edit-dokter-proses/{id}', [AdminDashboard::class, 'editDokterProses'])->name('editDokterProses');

    // admin poli routes
    Route::get('/manage-poli', [AdminDashboard::class, 'managePoli'])->name('managePoli');
    Route::post('/tambah-poli-proses', [AdminDashboard::class, 'tambahPoliProses'])->name('tambahPoliProses');
    Route::delete('/delete-poli-proses/{id}', [AdminDashboard::class, 'deletePoliProses'])->name('deletePoliProses');
    Route::get('/edit-poli/{id}', [AdminDashboard::class, 'editPoli'])->name('editPoli');
    Route::put('/edit-poli-proses/{id}', [AdminDashboard::class, 'editPoliProses'])->name('editPoliProses');

    // admin pasien routes
    Route::get('/manage-pasien', [AdminDashboard::class, 'managePasien'])->name('managePasien');
    Route::post('/tambah-pasien-proses', [AdminDashboard::class, 'tambahPasienProses'])->name('tambahPasienProses');
    Route::delete('/delete-pasien-proses/{id}', [AdminDashboard::class, 'deletePasienProses'])->name('deletePasienProses');
    Route::get('/edit-pasien/{id}', [AdminDashboard::class, 'editPasien'])->name('editPasien');
    Route::put('/edit-pasien-proses/{id}', [AdminDashboard::class, 'editPasienProses'])->name('editPasienProses');

    // admin obat routes
    Route::get('/manage-obat', [AdminDashboard::class, 'manageObat'])->name('manageObat');
    Route::post('/tambah-obat-proses', [AdminDashboard::class, 'tambahObatProses'])->name('tambahObatProses');
    Route::delete('/delete-obat-proses/{id}', [AdminDashboard::class, 'deleteObatProses'])->name('deleteObatProses');
    Route::get('/edit-obat/{id}', [AdminDashboard::class, 'editObat'])->name('editObat');
    Route::put('/edit-obat-proses/{id}', [AdminDashboard::class, 'editObatProses'])->name('editObatProses');
});
