<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KategorilokerController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PelamarController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\KaryawanMiddleware;
use App\Http\Middleware\OwnerMiddleware;
use App\Models\Admin;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Kategoriloker;
use App\Models\Kehadiran;
use App\Models\Pelamar;
use App\Models\Lowongan;
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
    Route::put('/profile', [ProfileController::class, 'updateProfile'])->name('user.updateProfile');
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
    Route::get('/admin/userhistory', [AdminController::class, 'showDeletedUsers'])->name('admin.userhistory');
    Route::patch('/admin/restore/{id}', [AdminController::class, 'restore'])->name('admin.restore');
    Route::delete('/admin/userhistory/{id}', [AdminController::class, 'hardDestroy'])->name('admin.hardDestroy');



    
    // Absensi and Kehadiran routes
    Route::get('/admin/absensi', [KehadiranController::class, 'showAbsensi'])->name('admin.absensi');
    Route::get('/admin/kehadiran', [KehadiranController::class, 'showKehadiran'])->name('admin.kehadiran');
    Route::match(['get', 'post'], '/kehadiran', [KehadiranController::class, 'showKehadiran'])->name('admin.kehadiran');
    Route::post('/store-izin', [KehadiranController::class, 'storeIzin'])->name('admin.storeIzin');

    //Cuti routesg
    Route::get('/admin/cuti', [KehadiranController::class, 'showCuti'])->name('admin.cuti');
    Route::post('/admin/cuti', [KehadiranController::class, 'submitCuti'])->name('admin.cuti');
    // Rute untuk persetujuan dan penolakan cuti
    Route::put('/admin/cuti/approve/{id}', [KehadiranController::class, 'approveCuti'])->name('admin.cuti.approve');
    Route::put('/admin/cuti/reject/{id}', [KehadiranController::class, 'rejectCuti'])->name('admin.cuti.reject');
    Route::delete('admin/cuti/{id}', [KehadiranController::class, 'destroyCuti'])->name('admin.cuti.destroy');



    // Rekrutmen

    // Kelola Pelamar
    Route::get('/admin/pelamar', [PelamarController::class, 'indexPelamar'])->name('admin.pelamar.indexPelamar');
    Route::post('/admin/pelamar', [PelamarController::class, 'storePelamar'])->name('admin.pelamar.storePelamar');
    Route::get('/admin/pelamar/{id}/edit', [PelamarController::class, 'editPelamar'])->name('admin.pelamar.editPelamar');
    Route::put('/admin/pelamar/{id}', [PelamarController::class, 'updatePelamar'])->name('admin.pelamar.updatePelamar');
    Route::delete('/admin/pelamar/{id}', [PelamarController::class, 'destroyPelamar'])->name('admin.pelamar.destroyPelamar');
    Route::get('/admin/pelamar/{id}/status', [PelamarController::class, 'updateStatus'])->name('admin.pelamar');
    Route::put('/admin/pelamar/{id}/status', [PelamarController::class, 'updateStatus'])->name('admin.updateStatus');




    // Kelola Nilai
    Route::get('/admin/nilai', [NilaiController::class, 'indexNilai'])->name('admin.nilai');
    Route::post('/admin/nilai', [NilaiController::class, 'storeNilai'])->name('admin.nilai.storeNilai');
    Route::get('/admin/nilai/{id}/edit', [NilaiController::class, 'editNilai'])->name('admin.nilai.editNilai');
    Route::put('/admin/nilai/{id}', [NilaiController::class, 'updateNilai'])->name('admin.nilai.updateNilai');
    Route::delete('/admin/nilai/{id}', [NilaiController::class, 'destroyNilai'])->name('admin.nilai.destroyNilai');


    Route::get('/admin/kategoriloker', [KategorilokerController::class, 'index'])->name('admin.kategoriloker');
    Route::post('/admin/kategoriloker', [KategorilokerController::class, 'storeKategoriLoker'])->name('admin.storeKategoriLoker');
    Route::put('/kategoriloker/{ketegoriloker}', [KategorilokerController::class, 'updateKategoriLoker'])->name('admin.updateKategoriLoker');
    Route::delete('/kategoriloker/{ketegoriloker}', [KategorilokerController::class, 'destroyKategoriLoker'])->name('admin.destroyKategoriLoker');

    Route::get('/admin/lowongan', [LowonganController::class, 'showLowongan'])->name('admin.lowongan');
    Route::post('/admin/lowongan', [LowonganController::class, 'storeLowongan'])->name('admin.storeLowongan');
    Route::post('/admin/lowongan/{id}', [LowonganController::class, 'editLowongan'])->name('admin.editLowongan');
    Route::put('/admin/lowongan/{id}/update', [LowonganController::class, 'updateLowongan'])->name('admin.updateLowongan');
    Route::delete('/admin/lowongan/{id}/delete', [LowonganController::class, 'destroyLowongan'])->name('admin.destroyLowongan');




    Route::get('/admin/pengumuman', [PengumumanController::class, 'showPengumuman'])->name('admin.pengumuman');
    Route::post('/admin/pengumuman', [PengumumanController::class, 'storePengumuman'])->name('admin.storePengumuman');
    Route::put('/admin/pengumuman/{id}/update', [PengumumanController::class, 'updatePengumuman'])->name('admin.updatePengumuman');
    Route::delete('/admin/pengumuman/{id}/delete', [PengumumanController::class, 'destroyPengumuman'])->name('admin.destroyPengumuman');


    Route::get('/admin/izin', [AdminController::class, 'showIzin'])->name('admin.izin');
    Route::get('/admin/penilaian', [PenilaianController::class, 'showPenilaian'])->name('admin.penilaian');
    Route::post('/admin/penilaian', [PenilaianController::class, 'storePenilaian'])->name('admin.storePenilaian');
    Route::post('/admin/penilaian/{id}', [PenilaianController::class, 'editPenilaian'])->name('admin.editPenilaian');
    Route::put('/admin/penilaian/{id}/update', [PenilaianController::class, 'updatePenilaian'])->name('admin.updatePenilaian');
    Route::delete('/admin/penilaian/{id}/delete', [PenilaianController::class, 'destroyPenilaian'])->name('admin.destroyPenilaian');
});

Route::middleware(['auth', OwnerMiddleware::class])->group(function () {
    Route::get('/owner/dashboard', [OwnerController::class, 'ownerDashboard'])->name('owner.dashboard');
    Route::get('/owner/user', [AdminController::class, 'showUserList'])->name('owner.user');
    // kalo mau tambah user ini di komen dulu
    Route::post('/owner/user', [AdminController::class, 'store'])->name('owner.store');
    Route::put('/owner/{id}', [AdminController::class, 'update'])->name('owner.update');
    Route::delete('/owner/{id}', [AdminController::class, 'destroy'])->name('owner.destroy');;
    Route::get('/owner/userhistory', [OwnerController::class, 'showDeletedUsersOwner'])->name('owner.userhistory');
    Route::patch('/owner/restore/{id}', [AdminController::class, 'restore'])->name('owner.restore');
    Route::delete('/owner/userhistory/{id}', [AdminController::class, 'hardDestroy'])->name('owner.hardDestroy');

    // Absensi and Kehadiran routes
    Route::get('/owner/absensi', [OwnerController::class, 'ownerAbsensi'])->name('owner.absensi');
    Route::get('/owner/kehadiran', [KehadiranController::class, 'showKehadiran'])->name('owner.kehadiran');
    Route::post('/owner/kehadiran', [KehadiranController::class, 'showKehadiran'])->name('owner.kehadiran');
    Route::get('/owner/izin', [OwnerController::class, 'ownerIzin'])->name('owner.izin');
    Route::post('/owner/cuti', [KehadiranController::class, 'submitCuti'])->name('owner.cuti');
    Route::post('/store-izin', [KehadiranController::class, 'storeIzin'])->name('owner.storeIzin');
    Route::get('/owner/cuti', [OwnerController::class, 'ownerCuti'])->name('owner.cuti');
    Route::put('/owner/cuti/approve/{id}', [KehadiranController::class, 'approveCuti'])->name('owner.cuti.approve');
    Route::put('/owner/cuti/reject/{id}', [KehadiranController::class, 'rejectCuti'])->name('owner.cuti.reject');

    // Additional admin routes
    Route::get('/owner/pelamar', [OwnerController::class, 'ownerPelamar'])->name('owner.pelamar');
    Route::get('/owner/lowongan', [OwnerController::class, 'ownerLowongan'])->name('owner.lowongan');
    Route::get('/owner/nilai', [OwnerController::class, 'ownerNilai'])->name('owner.nilai');
    Route::get('/owner/pengumuman', [OwnerController::class, 'ownerPengumuman'])->name('owner.pengumuman');
    Route::get('/owner/cuti', [OwnerController::class, 'ownerCuti'])->name('owner.cuti');
    Route::put('/owner/cuti/approve/{id}', [KehadiranController::class, 'approveCuti'])->name('owner.cuti.approve');
    Route::put('/owner/cuti/reject/{id}', [KehadiranController::class, 'rejectCuti'])->name('owner.cuti.reject');
    Route::delete('owner/cuti/{id}', [KehadiranController::class, 'destroyCuti'])->name('owner.cuti.destroy');

    Route::get('/owner/penilaian', [OwnerController::class, 'ownerPenilaian'])->name('owner.penilaian');
    Route::post('/owner/penilaian', [PenilaianController::class, 'storePenilaian'])->name('owner.storePenilaian');
    Route::post('/owner/penilaian/{id}', [PenilaianController::class, 'editPenilaian'])->name('owner.editPenilaian');
    Route::put('/owner/penilaian/{id}/update', [PenilaianController::class, 'updatePenilaian'])->name('owner.updatePenilaian');
    Route::delete('/owner/penilaian/{id}/delete', [PenilaianController::class, 'destroyPenilaian'])->name('owner.destroyPenilaian');
});

Route::middleware(['auth', KaryawanMiddleware::class])->group(function () {
    // Absensi and Kehadiran routes
    Route::get('/karyawan/absensi', [KaryawanController::class, 'karyawanAbsensi'])->name('karyawan.absensi');
    Route::get('/karyawan/kehadiran', [KehadiranController::class, 'showKehadiran'])->name('karyawan.kehadiran');
    Route::post('/karyawan/kehadiran', [KehadiranController::class, 'showKehadiran'])->name('karyawan.kehadiran');
    Route::get('/karyawan/izin', [KaryawanController::class, 'karyawanIzin'])->name('karyawan.izin');
    Route::post('/karyawan/cuti', [KehadiranController::class, 'submitCuti'])->name('karyawan.cuti');
    Route::post('/store-izin', [KehadiranController::class, 'storeIzin'])->name('karyawan.storeIzin');
    Route::get('/karyawan/cuti', [KaryawanController::class, 'karyawanCuti'])->name('karyawan.cuti');
    Route::get('/karyawan/penilaian', [KaryawanController::class, 'karyawanPenilaian'])->name('karyawan.penilaian');
    Route::post('/cuti/{id}/cancel', [KehadiranController::class, 'cancelRequest'])->name('cuti.cancel');
    Route::post('/cuti/{id}/restore', [KehadiranController::class, 'restoreRequest'])->name('cuti.restore');
});
