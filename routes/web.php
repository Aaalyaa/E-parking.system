<?php

use Illuminate\Support\Facades\Route;
use App\Helpers\LogAktivitas;
use App\Models\TransaksiParkir;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Laporan\LaporanHarianController;
use App\Http\Controllers\Laporan\LaporanRentangController;
use App\Http\Controllers\Laporan\LaporanOkupansiController;
use App\Http\Controllers\AreaKapasitasController;
use App\Http\Controllers\LokasiAreaController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\TipeKendaraanController;
use App\Http\Controllers\TipeMemberController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\DataKendaraanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TransaksiParkirController;
use App\Http\Controllers\TrackingKendaraanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LogAktivitasController;


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

    Route::get('/area-kapasitas', [AreaKapasitasController::class, 'index'])
        ->name('area-kapasitas.index');

    Route::get('/transaksi', [TransaksiParkirController::class, 'index'])
        ->name('transaksi.index');

    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::get('/area-kapasitas/create', [AreaKapasitasController::class, 'create'])
            ->name('area-kapasitas.create');
        Route::post('/area-kapasitas', [AreaKapasitasController::class, 'store'])
            ->name('area-kapasitas.store');
        Route::get('/area-kapasitas/{kapasitasArea}/edit', [AreaKapasitasController::class, 'edit'])
            ->name('area-kapasitas.edit');
        Route::put('/area-kapasitas/{kapasitasArea}', [AreaKapasitasController::class, 'update'])
            ->name('area-kapasitas.update');
        Route::delete('/area-kapasitas/{kapasitasArea}', [AreaKapasitasController::class, 'destroy'])
            ->name('area-kapasitas.destroy');

        Route::get('/lokasi-area', [LokasiAreaController::class, 'index'])
            ->name('lokasi-area.index');
        Route::get('/lokasi-area/create', [LokasiAreaController::class, 'create'])
            ->name('lokasi-area.create');
        Route::post('/lokasi-area', [LokasiAreaController::class, 'store'])
            ->name('lokasi-area.store');
        Route::get('/lokasi-area/{lokasiArea}/edit', [LokasiAreaController::class, 'edit'])
            ->name('lokasi-area.edit');
        Route::put('/lokasi-area/{lokasiArea}', [LokasiAreaController::class, 'update'])
            ->name('lokasi-area.update');
        Route::delete('/lokasi-area/{lokasiArea}', [LokasiAreaController::class, 'destroy'])
            ->name('lokasi-area.destroy');

        Route::get('/area/by-lokasi/{id}', [AreaController::class, 'getByLokasi'])
            ->name('area.byLokasi');
        Route::get('/area', [AreaController::class, 'index'])
            ->name('area.index');
        Route::get('/area/create', [AreaController::class, 'create'])
            ->name('area.create');
        Route::post('/area', [AreaController::class, 'store'])
            ->name('area.store');
        Route::get('/area/{area}/edit', [AreaController::class, 'edit'])
            ->name('area.edit');
        Route::put('/area/{area}', [AreaController::class, 'update'])
            ->name('area.update');
        Route::delete('/area/{area}', [AreaController::class, 'destroy'])
            ->name('area.destroy');

        Route::get('/tipe-kendaraan', [TipeKendaraanController::class, 'index'])
            ->name('tipe-kendaraan.index');
        Route::get('/tipe-kendaraan/create', [TipeKendaraanController::class, 'create'])
            ->name('tipe-kendaraan.create');
        Route::post('/tipe-kendaraan', [TipeKendaraanController::class, 'store'])
            ->name('tipe-kendaraan.store');
        Route::get('/tipe-kendaraan/{tipeKendaraan}/edit', [TipeKendaraanController::class, 'edit'])
            ->name('tipe-kendaraan.edit');
        Route::put('/tipe-kendaraan/{tipeKendaraan}', [TipeKendaraanController::class, 'update'])
            ->name('tipe-kendaraan.update');
        Route::delete('/tipe-kendaraan/{tipeKendaraan}', [TipeKendaraanController::class, 'destroy'])
            ->name('tipe-kendaraan.destroy');

        Route::get('/tipe-member', [TipeMemberController::class, 'index'])
            ->name('tipe-member.index');
        Route::get('/tipe-member/create', [TipeMemberController::class, 'create'])
            ->name('tipe-member.create');
        Route::post('/tipe-member', [TipeMemberController::class, 'store'])
            ->name('tipe-member.store');
        Route::get('/tipe-member/{tipeMember}/edit', [TipeMemberController::class, 'edit'])
            ->name('tipe-member.edit');
        Route::put('/tipe-member/{tipeMember}', [TipeMemberController::class, 'update'])
            ->name('tipe-member.update');
        Route::delete('/tipe-member/{tipeMember}', [TipeMemberController::class, 'destroy'])
            ->name('tipe-member.destroy');

        Route::get('/tarif', [TarifController::class, 'index'])
            ->name('tarif.index');
        Route::get('/tarif/create', [TarifController::class, 'create'])
            ->name('tarif.create');
        Route::post('/tarif', [TarifController::class, 'store'])
            ->name('tarif.store');
        Route::get('/tarif/{tarif}/edit', [TarifController::class, 'edit'])
            ->name('tarif.edit');
        Route::put('/tarif/{tarif}', [TarifController::class, 'update'])
            ->name('tarif.update');
        Route::delete('/tarif/{tarif}', [TarifController::class, 'destroy'])
            ->name('tarif.destroy');

        Route::get('/data-kendaraan', [DataKendaraanController::class, 'index'])
            ->name('data-kendaraan.index');
        Route::get('/data-kendaraan/create', [DataKendaraanController::class, 'create'])
            ->name('data-kendaraan.create');
        Route::post('/data-kendaraan', [DataKendaraanController::class, 'store'])
            ->name('data-kendaraan.store');
        Route::get('/data-kendaraan/{dataKendaraan}/edit', [DataKendaraanController::class, 'edit'])
            ->name('data-kendaraan.edit');
        Route::put('/data-kendaraan/{dataKendaraan}', [DataKendaraanController::class, 'update'])
            ->name('data-kendaraan.update');
        Route::delete('/data-kendaraan/{dataKendaraan}', [DataKendaraanController::class, 'destroy'])
            ->name('data-kendaraan.destroy');

        Route::get('/membership', [MemberController::class, 'index'])
            ->name('membership.index');
        Route::get('/membership/create', [MemberController::class, 'create'])
            ->name('membership.create');
        Route::post('/membership', [MemberController::class, 'store'])
            ->name('membership.store');
        Route::delete('/membership/{id}', [MemberController::class, 'destroy'])
            ->name('membership.destroy');

        Route::get('/users', [UserController::class, 'index'])
            ->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])
            ->name('users.create');
        Route::post('/users', [UserController::class, 'store'])
            ->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])
            ->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])
            ->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])
            ->name('users.destroy');

        Route::get('/log-aktivitas', [LogAktivitasController::class, 'index'])
            ->name('log-aktivitas.index');
    });

    Route::middleware('role:petugas')->group(function () {
        Route::get('/petugas/dashboard', function () {
            return view('petugas.dashboard');
        })->name('petugas.dashboard');

        Route::get('/transaksi/create', [TransaksiParkirController::class, 'create'])
            ->name('transaksi.create');
        Route::post('/transaksi/masuk', [TransaksiParkirController::class, 'storeMasuk'])
            ->name('transaksi.masuk');
        Route::post('/transaksi/keluar/{id}', [TransaksiParkirController::class, 'storeKeluar'])
            ->name('transaksi.keluar');
    });

    Route::middleware('role:owner')->group(function () {
        Route::get('/owner/dashboard', function () {
            return view('owner.dashboard');
        })->name('owner.dashboard');
    });

    Route::middleware('role:admin|petugas')->group(function () {
        Route::get('/tracking', [TrackingKendaraanController::class, 'index'])
            ->name('tracking.index');
    });

    Route::middleware(['auth', 'role:admin|owner'])
        ->prefix('laporan')
        ->name('laporan.')
        ->group(function () {
            Route::get('/harian', [LaporanHarianController::class, 'index'])
                ->name('harian');
            Route::get('/harian/pdf', [LaporanHarianController::class, 'harianPdf'])
                ->name('harian.pdf');
            Route::get('/rentang', action: [LaporanRentangController::class, 'index'])
                ->name('rentang');
            Route::get('/rentang/pdf', [LaporanRentangController::class, 'rentangPdf'])
                ->name('rentang.pdf');
            Route::get('/okupansi', action: [LaporanOkupansiController::class, 'index'])
                ->name('okupansi');
            Route::get('/okupansi/pdf', [LaporanOkupansiController::class, 'okupansiPdf'])
                ->name('okupansi.pdf');
        });

    Route::get('/transaksi/{id}', [TransaksiParkirController::class, 'strukKeluar'])
        ->name('transaksi.struk_keluar');
    Route::post('/transaksi/{id}/log-cetak', function ($id) {
        $transaksi = TransaksiParkir::findOrFail($id);

        LogAktivitas::add(
            'CETAK_STRUK',
            'Cetak struk transaksi ' . $transaksi->kode,
            'transaksi_parkir',
            $transaksi->id
        );

        return response()->json(['status' => 'ok']);
    })->name('transaksi.log_cetak');
});