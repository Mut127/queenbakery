<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('/admin/dashboard');
});

Route::get('/sesi/login', function () {
    return view('/sesi/login');
});



// Route::get('/admin/register', [AdminController::class, 'showRegister'])->name('admin.register');
// Route::post('/admin/register', [AdminController::class, 'register'])->name('admin.register.submit');

// Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
// Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');

Route::get('/admin/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');

Route::get('/admin/profile', [AdminController::class, 'showProfile'])->name('admin.profile');
Route::post('/admin/profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');


Route::get('/admin/user', [AdminController::class, 'showUserList'])->name('admin.user');
Route::post('/users', [AdminController::class, 'store'])->name('users.store');

Route::put('/users/{id}', [AdminController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('users.destroy');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Route absensi dan kehadiran
Route::get('/admin/absensi', [AdminController::class, 'showAbsensi'])->name('admin.absensi');
Route::get('/admin/kehadiran', [AdminController::class, 'showKehadiran'])->name('admin.kehadiran');

// Route kelola pelamar, kelola lowongan, kelola nilai, kelola pengumuman
Route::get('/admin/pelamar', [AdminController::class, 'showPelamar'])->name('admin.pelamar');
Route::get('/admin/lowongan', [AdminController::class, 'showLowongan'])->name('admin.lowongan');
Route::get('/admin/nilai', [AdminController::class, 'showNilai'])->name('admin.nilai');
Route::get('/admin/pengumuman', [AdminController::class, 'showPengumuman'])->name('admin.pengumuman');

// Route cuti
Route::get('/admin/cuti', [AdminController::class, 'showCuti'])->name('admin.cuti');

// Route penilaian kinerja
Route::get('/admin/penilaian', [AdminController::class, 'showPenilaian'])->name('admin.penilaian');