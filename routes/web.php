<?php

use App\Http\Controllers\AllBookingController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DapurController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KalendarController;
use App\Http\Controllers\PendingBookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\TetapanController;
use App\Http\Controllers\UserListController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::patch('/bookings/{booking}/status', [DashboardController::class, 'updateStatus'])->name('bookings.status');

    Route::get('/pending-booking', [PendingBookingController::class, 'index'])->name('pending-booking');

    Route::get('/all-booking', [AllBookingController::class, 'index'])->name('all-booking');

    Route::resource('dapur', DapurController::class)->except(['show']);

    Route::get('/dapur/{dapur}/barang', [BarangController::class, 'index'])->name('dapur.barang');
    Route::post('/dapur/{dapur}/peralatan', [BarangController::class, 'storePeralatan'])->name('dapur.peralatan.store');
    Route::put('/dapur/{dapur}/peralatan/{peralatan}', [BarangController::class, 'updatePeralatan'])->name('dapur.peralatan.update');
    Route::delete('/dapur/{dapur}/peralatan/{peralatan}', [BarangController::class, 'destroyPeralatan'])->name('dapur.peralatan.destroy');
    Route::post('/dapur/{dapur}/bahan', [BarangController::class, 'storeBahan'])->name('dapur.bahan.store');
    Route::put('/dapur/{dapur}/bahan/{bahan}', [BarangController::class, 'updateBahan'])->name('dapur.bahan.update');
    Route::delete('/dapur/{dapur}/bahan/{bahan}', [BarangController::class, 'destroyBahan'])->name('dapur.bahan.destroy');

    Route::get('/pengguna', [UserListController::class, 'index'])->name('pengguna.index');

    Route::get('/kalendar', [KalendarController::class, 'index'])->name('kalendar.index');

    Route::get('/laporan/maklumbalas', function () {
        return view('feedback-list');
    })->name('laporan.maklumbalas');

    Route::get('/laporan/maklumbalas/{id}', function () {
        return view('feedback-detail');
    })->name('laporan.maklumbalas.show');

    Route::get('/laporan/rekod', [RecordController::class, 'index'])->name('laporan.rekod');
    Route::get('/laporan/rekod/{id}', [RecordController::class, 'show'])->name('laporan.rekod.show');

    Route::get('/tetapan', [TetapanController::class, 'index'])->name('tetapan.index');
    Route::patch('/tetapan/profile', [TetapanController::class, 'updateProfile'])->name('tetapan.profile.update');
});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
