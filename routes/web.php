<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\KaryawanMiddleware;
use App\Http\Middleware\OwnerMiddleware;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

// kalo mau tambah user pertama ini di komen dulu
Route::get('/', function () {
    return view('sesi.login');
});
Route::get('/sesi', [SessionController::class, 'index'])->name('index');
Route::post('/sesi/login', [SessionController::class, 'login'])->name('sesi.login');
// kalo mau tambah user ini di aktifin 
// Route::post('/admin/user', [SessionController::class, 'store'])->name('sesi.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');
    Route::post('/logout', [SessionController::class, 'logout'])->name('logout');
});



// Rute khusus admin
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');

    Route::get('/admin/user', [AdminController::class, 'showUserList'])->name('admin.user');
    // kalo mau tambah user ini di komen dulu
    Route::post('/admin/user', [AdminController::class, 'store'])->name('admin.store');
    Route::put('/admin/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

    // Absensi and Kehadiran routes
    Route::get('/admin/absensi', [AdminController::class, 'showAbsensi'])->name('admin.absensi');
    Route::get('/admin/kehadiran', [AdminController::class, 'showKehadiran'])->name('admin.kehadiran');

    // Additional admin routes
    Route::get('/admin/pelamar', [AdminController::class, 'showPelamar'])->name('admin.pelamar');
    Route::get('/admin/lowongan', [AdminController::class, 'showLowongan'])->name('admin.lowongan');
    Route::get('/admin/nilai', [AdminController::class, 'showNilai'])->name('admin.nilai');
    Route::get('/admin/pengumuman', [AdminController::class, 'showPengumuman'])->name('admin.pengumuman');
    Route::get('/admin/cuti', [AdminController::class, 'showCuti'])->name('admin.cuti');
    Route::get('/admin/izin', [AdminController::class, 'showIzin'])->name('admin.izin');
    Route::get('/admin/penilaian', [AdminController::class, 'showPenilaian'])->name('admin.penilaian');
});

Route::middleware(['auth', OwnerMiddleware::class])->group(function () {
    Route::get('/owner/dashboard', [OwnerController::class, 'ownerDashboard'])->name('owner.dashboard');
    Route::get('/owner/profile', [OwnerController::class, 'ownerProfile'])->name('owner.profile');
    Route::post('/owner/profile', [PageController::class, 'updateProfile'])->name('owner.profile.update');
    Route::get('/owner/user', [OwnerController::class, 'ownerUserList'])->name('owner.user');
    // kalo mau tambah user ini di komen dulu
    Route::post('/owner/user', [SessionController::class, 'store'])->name('sesi.store');
    Route::post('/users', [OwnerController::class, 'store'])->name('owner.users.store');
    Route::put('/users/{id}', [OwnerController::class, 'update'])->name('owner.users.update');
    Route::delete('/users/{id}', [OwnerController::class, 'destroy'])->name('owner.users.destroy');

    // Absensi and Kehadiran routes
    Route::get('/owner/absensi', [OwnerController::class, 'ownerAbsensi'])->name('owner.absensi');
    Route::get('/owner/kehadiran', [OwnerController::class, 'ownerKehadiran'])->name('owner.kehadiran');

    // Additional admin routes
    Route::get('/owner/pelamar', [OwnerController::class, 'ownerPelamar'])->name('owner.pelamar');
    Route::get('/owner/lowongan', [OwnerController::class, 'ownerLowongan'])->name('owner.lowongan');
    Route::get('/owner/nilai', [OwnerController::class, 'ownerNilai'])->name('owner.nilai');
    Route::get('/owner/pengumuman', [OwnerController::class, 'ownerPengumuman'])->name('owner.pengumuman');
    Route::get('/owner/cuti', [OwnerController::class, 'ownerCuti'])->name('owner.cuti');
    Route::get('/owner/penilaian', [OwnerController::class, 'ownerPenilaian'])->name('owner.penilaian');
});
Route::middleware(['auth', KaryawanMiddleware::class])->group(function () {
    // Absensi and Kehadiran routes
    Route::get('/karyawan/absensi', [KaryawanController::class, 'karyawanAbsensi'])->name('karyawan.absensi');
    Route::get('/karyawan/kehadiran', [KaryawanController::class, 'karyawanKehadiran'])->name('karyawan.kehadiran');
    Route::get('/karyawan/cuti', [KaryawanController::class, 'karyawanCuti'])->name('karyawan.cuti');
    Route::get('/karyawan/penilaian', [KaryawanController::class, 'karyawanPenilaian'])->name('karyawan.penilaian');
});
