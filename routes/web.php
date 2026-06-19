<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Auth middleware temporarily removed for UI development
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/pending-booking', function () {
    return view('pending-booking');
})->name('pending-booking');

Route::get('/dapur', function () {
    return view('dapur-list');
})->name('dapur.index');

Route::get('/dapur/create', function () {
    return view('create-dapur');
})->name('dapur.create');

Route::get('/dapur/{id}/barang', function () {
    return view('manage-barang');
})->name('dapur.barang');

Route::get('/dapur/{id}/edit', function () {
    return view('edit-dapur');
})->name('dapur.edit');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';