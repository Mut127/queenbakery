<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SessionController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\KaryawanMiddleware;
use App\Http\Middleware\OwnerMiddleware;
use Illuminate\Support\Facades\Route;


// kalo mau tambah user pertama ini di komen dulu
Route::get('/', function () {
    return view('sesi.login');
});
Route::get('/sesi', [SessionController::class, 'index'])->name('index');
Route::post('/sesi/login', [SessionController::class, 'login'])->name('sesi.login');
// kalo mau tambah user ini di aktifin 
// Route::post('/admin/user', [SessionController::class, 'store'])->name('sesi.store');

Route::middleware(['auth'])->group(function () {
    Route::match(['get', 'post'], '/profile', [SessionController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [SessionController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/change-photo', [SessionController::class, 'changeProfilePhoto'])->name('profile.changePhoto');
    Route::post('/logout', [SessionController::class, 'logout'])->name('logout');
    Route::get('/profile/editpassword', [SessionController::class, 'password'])->name('profile.password');
    Route::post('/profile/changepasswod', [SessionController::class, 'changePassword'])->name('password.changePassword');
});

// Rute khusus admin
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', [PageController::class, 'showDashboard'])->name('admin.dashboard');
    // kalo mau tambah user ini di komen dulu
    Route::post('/admin/user', [SessionController::class, 'store'])->name('sesi.store');

    Route::get('/admin/profile', [PageController::class, 'showProfile'])->name('admin.profile');
    Route::post('/admin/profile', [PageController::class, 'updateProfile'])->name('admin.profile.update');
    Route::get('/admin/user', [PageController::class, 'showUserList'])->name('admin.user.list');
    Route::post('/users', [PageController::class, 'store'])->name('admin.users.store');
    Route::put('/users/{id}', [PageController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [PageController::class, 'destroy'])->name('admin.users.destroy');

    // Absensi and Kehadiran routes
    Route::get('/admin/absensi', [PageController::class, 'showAbsensi'])->name('admin.absensi');
    Route::get('/admin/kehadiran', [PageController::class, 'showKehadiran'])->name('admin.kehadiran');

    // Additional admin routes
    Route::get('/admin/pelamar', [PageController::class, 'showPelamar'])->name('admin.pelamar');
    Route::get('/admin/lowongan', [PageController::class, 'showLowongan'])->name('admin.lowongan');
    Route::get('/admin/nilai', [PageController::class, 'showNilai'])->name('admin.nilai');
    Route::get('/admin/pengumuman', [PageController::class, 'showPengumuman'])->name('admin.pengumuman');
    Route::get('/admin/cuti', [PageController::class, 'showCuti'])->name('admin.cuti');
    Route::get('/admin/penilaian', [PageController::class, 'showPenilaian'])->name('admin.penilaian');
});

// Owner routes
Route::middleware(['auth', OwnerMiddleware::class])->group(function () {
    Route::get('/owner/dashboard', [PageController::class, 'showDashboard'])->name('owner.dashboard');
    Route::post('/owner/user', [SessionController::class, 'store'])->name('owner.user.store');

    Route::get('/owner/profile', [PageController::class, 'showProfile'])->name('owner.profile');
    Route::post('/owner/profile', [PageController::class, 'updateProfile'])->name('owner.profile.update');
    Route::get('/owner/user', [PageController::class, 'showUserList'])->name('owner.user.list');
    Route::post('/users', [PageController::class, 'store'])->name('owner.users.store');
    Route::put('/users/{id}', [PageController::class, 'update'])->name('owner.users.update');
    Route::delete('/users/{id}', [PageController::class, 'destroy'])->name('owner.users.destroy');

    // Absensi and Kehadiran routes
    Route::get('/owner/absensi', [PageController::class, 'showAbsensi'])->name('owner.absensi');
    Route::get('/owner/kehadiran', [PageController::class, 'showKehadiran'])->name('owner.kehadiran');

    // Additional owner routes
    Route::get('/owner/pelamar', [PageController::class, 'showPelamar'])->name('owner.pelamar');
    Route::get('/owner/lowongan', [PageController::class, 'showLowongan'])->name('owner.lowongan');
    Route::get('/owner/nilai', [PageController::class, 'showNilai'])->name('owner.nilai');
    Route::get('/owner/pengumuman', [PageController::class, 'showPengumuman'])->name('owner.pengumuman');
    Route::get('/owner/cuti', [PageController::class, 'showCuti'])->name('owner.cuti');
    Route::get('/owner/penilaian', [PageController::class, 'showPenilaian'])->name('owner.penilaian');
});

// Karyawan routes
Route::middleware(['auth', KaryawanMiddleware::class])->group(function () {
    // Corrected `karywan` to `karyawan`
    Route::get('/karyawan/absensi', [PageController::class, 'showAbsensi'])->name('karyawan.absensi');
    Route::get('/karyawan/kehadiran', [PageController::class, 'showKehadiran'])->name('karyawan.kehadiran');
    Route::get('/karyawan/cuti', [PageController::class, 'showCuti'])->name('karyawan.cuti');
    Route::get('/karyawan/penilaian', [PageController::class, 'showPenilaian'])->name('karyawan.penilaian');
});
