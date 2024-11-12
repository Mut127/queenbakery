<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SessionController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\KaryawanMiddleware;
use App\Http\Middleware\OwnerMiddleware;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('admin.dashboard');
});
// kalo mau tambah user pertama ini di komen dulu
// Route::get('/', function () {
//     return view('sesi.login');
// });
Route::get('/sesi', [SessionController::class, 'index'])->name('index');
Route::post('/sesi/login', [SessionController::class, 'login'])->name('sesi.login');
// kalo mau tambah user ini di aktifin 
Route::post('/admin/user', [SessionController::class, 'store'])->name('sesi.store');


Route::get('/admin/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');
// kalo mau tambah user ini di komen dulu
Route::post('/admin/user', [SessionController::class, 'store'])->name('sesi.store');

Route::get('/admin/profile', [AdminController::class, 'showProfile'])->name('admin.profile');
Route::post('/admin/profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
Route::get('/admin/user', [AdminController::class, 'showUserList'])->name('admin.user');
Route::post('/users', [AdminController::class, 'store'])->name('admin.users.store');
Route::put('/users/{id}', [AdminController::class, 'update'])->name('admin.users.update');
Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy');

// Absensi and Kehadiran routes
Route::get('/admin/absensi', [AdminController::class, 'showAbsensi'])->name('admin.absensi');
Route::get('/admin/izin', [AdminController::class, 'showIzin'])->name('admin.izin');
Route::get('/admin/kehadiran', [AdminController::class, 'showKehadiran'])->name('admin.kehadiran');

// Additional admin routes
Route::get('/admin/pelamar', [AdminController::class, 'showPelamar'])->name('admin.pelamar');
Route::get('/admin/lowongan', [AdminController::class, 'showLowongan'])->name('admin.lowongan');
Route::get('/admin/nilai', [AdminController::class, 'showNilai'])->name('admin.nilai');
Route::get('/admin/pengumuman', [AdminController::class, 'showPengumuman'])->name('admin.pengumuman');
Route::get('/admin/cuti', [AdminController::class, 'showCuti'])->name('admin.cuti');
Route::get('/admin/penilaian', [AdminController::class, 'showPenilaian'])->name('admin.penilaian');