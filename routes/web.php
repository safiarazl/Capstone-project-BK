<?php

use App\Http\Controllers\AdminDashboard;
use App\Http\Controllers\DokterDashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogRegController;
use App\Http\Controllers\PasienDashboard;
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
// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['guest'])->group(function () {
    Route::get('login', [LogRegController::class, 'loginForm'])->name('login');
    Route::post('login-proses', [LogRegController::class, 'loginProses'])->name('loginProses');

    Route::get('register', [LogRegController::class, 'registerForm'])->name('register');
    Route::post('register-proses', [LogRegController::class, 'registerProses'])->name('registerProses');
});

Route::get('/home', function () {
    return redirect('/dashboard');
})->name('adminDashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::get('/logout', [LogRegController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'checkRole:admin'])->group(function () {

    // admin dokter routes
    Route::get('admin/manage-dokter', [AdminDashboard::class, 'manageDokter'])->name('manageDokter');
    Route::post('admin/tambah-dokter-proses', [AdminDashboard::class, 'tambahDokterProses'])->name('tambahDokterProses');
    Route::delete('admin/delete-dokter-proses/{id}', [AdminDashboard::class, 'deleteDokterProses'])->name('deleteDokterProses');
    Route::get('admin/manage-dokter/{id}', [AdminDashboard::class, 'editDokter'])->name('editDokter');
    Route::put('admin/edit-dokter-proses/{id}', [AdminDashboard::class, 'editDokterProses'])->name('editDokterProses');

    // admin poli routes
    Route::get('admin/manage-poli', [AdminDashboard::class, 'managePoli'])->name('managePoli');
    Route::post('admin/tambah-poli-proses', [AdminDashboard::class, 'tambahPoliProses'])->name('tambahPoliProses');
    Route::delete('admin/delete-poli-proses/{id}', [AdminDashboard::class, 'deletePoliProses'])->name('deletePoliProses');
    Route::get('admin/manage-poli/{id}', [AdminDashboard::class, 'editPoli'])->name('editPoli');
    Route::put('admin/edit-poli-proses/{id}', [AdminDashboard::class, 'editPoliProses'])->name('editPoliProses');

    // admin pasien routes
    Route::get('admin/manage-pasien', [AdminDashboard::class, 'managePasien'])->name('managePasien');
    Route::post('admin/tambah-pasien-proses', [AdminDashboard::class, 'tambahPasienProses'])->name('tambahPasienProses');
    Route::delete('admin/delete-pasien-proses/{id}', [AdminDashboard::class, 'deletePasienProses'])->name('deletePasienProses');
    Route::get('admin/manage-pasien/{id}', [AdminDashboard::class, 'editPasien'])->name('editPasien');
    Route::put('admin/edit-pasien-proses/{id}', [AdminDashboard::class, 'editPasienProses'])->name('editPasienProses');

    // admin obat routes
    Route::get('admin/manage-obat', [AdminDashboard::class, 'manageObat'])->name('manageObat');
    Route::post('admin/tambah-obat-proses', [AdminDashboard::class, 'tambahObatProses'])->name('tambahObatProses');
    Route::delete('admin/delete-obat-proses/{id}', [AdminDashboard::class, 'deleteObatProses'])->name('deleteObatProses');
    Route::get('admin/manage-obat/{id}', [AdminDashboard::class, 'editObat'])->name('editObat');
    Route::put('admin/edit-obat-proses/{id}', [AdminDashboard::class, 'editObatProses'])->name('editObatProses');
});

route::middleware(['auth', 'checkRole:dokter'])->group(function () {
    Route::get('dokter/change-profile/{id}', [DokterDashboard::class, 'changeProfile'])->name('changeProfile');
    Route::put('dokter/change-profile-proses/{id}', [DokterDashboard::class, 'changeProfileProses'])->name('changeProfileProses');

    Route::post('dokter/input-jadwal-proses', [DokterDashboard::class, 'inputJadwalProses'])->name('inputJadwalProses');
});

route::middleware(['auth', 'checkRole:pasien'])->group(function () {
    Route::post('pasien/daftar-poli-proses', [PasienDashboard::class, 'daftarPoliProses'])->name('daftarPoliProses');
});
