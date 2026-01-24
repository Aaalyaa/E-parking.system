<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TipeKendaraanController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\LokasiAreaController;
use App\Http\Controllers\Admin\KapasitasAreaController;
use App\Http\Controllers\Admin\DataKendaraanController;
use App\Http\Controllers\Admin\TarifController;
use App\Http\Controllers\Admin\TipeMemberController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\TrackingParkirController;
use App\Http\Controllers\Petugas\TrackingParkirController as PetugasTrackingParkirController;
use App\Http\Controllers\Petugas\KapasitasAreaController as PetugasKapasitasAreaController;
use App\Http\Controllers\Petugas\TransaksiParkirController as PetugasTransaksiParkirController;

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

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile.index');
    Route::get('/profile/password', [ProfileController::class, 'editPassword'])
        ->name('profile.editPassword');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])
        ->name('profile.updatePassword');
});

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

    Route::prefix('master')
        ->name('master.')
        ->group( function () {
        Route::get('area/by-lokasi/{id}', 
        [AreaController::class, 'getByLokasi']
        )->name('area.byLokasi');

        Route::resource('area', controller: AreaController::class);
        Route::resource('lokasi_area', controller: LokasiAreaController::class);
        Route::resource('data_kendaraan', controller: DataKendaraanController::class);
        Route::resource('kapasitas_area', controller: KapasitasAreaController::class);
        Route::resource('tipe_kendaraan', controller: TipeKendaraanController::class);
        Route::resource('tipe_member', controller: TipeMemberController::class);
        Route::resource('tarif', controller: TarifController::class);
    });

    Route::prefix('kendaraan_dan_member')
        ->name('kendaraan_dan_member.')
        ->group( function () {
        Route::resource('membership', MemberController::class);
        Route::resource('tracking', TrackingParkirController::class);
    });

    Route::prefix('pengaturan_pengguna')
        ->name('pengaturan_pengguna.')
        ->group( function () {
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
    });
});

Route::middleware(['auth', 'role:petugas'])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {
    Route::get('/dashboard', function () {
        return view('petugas.dashboard');
    });

    Route::prefix('master')
        ->name('master.')
        ->group( function () {
        Route::resource('kapasitas_area', controller: PetugasKapasitasAreaController::class);
    });

    Route::prefix('transaksi')
    ->name('transaksi.')
    ->group( function () {
        Route::get('/', [PetugasTransaksiParkirController::class, 'index'])
            ->name('index');
        Route::post('/masuk', [PetugasTransaksiParkirController::class, 'storeMasuk'])
            ->name('masuk');
        Route::post('/keluar/{id}', [PetugasTransaksiParkirController::class, 'storeKeluar'])
            ->name('keluar');
        Route::get('/{id}', [PetugasTransaksiParkirController::class, 'strukKeluar'])
            ->name('struk_keluar');
    });

    Route::prefix('kendaraan')
        ->name('kendaraan.')
        ->group( function () {
        Route::resource('tracking', PetugasTrackingParkirController::class);
    });
});

Route::middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/owner/dashboard', function () {
        return view('owner.dashboard');
    });
});