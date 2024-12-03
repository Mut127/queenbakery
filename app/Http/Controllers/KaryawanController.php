<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Kehadiran;
use App\Models\Kinerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KaryawanController extends Controller
{

    // Di dalam karyawanController.php
    public function karyawanAbsensi(Request $request)

    {
        $user = Auth::user();  // Get the currently logged-in user

        // Optional: Retrieve the selected month and year from the request
        $bulan = $request->input('bulan', now()->month);
        $tahun = $request->input('tahun', now()->year);

        // Get the attendance records for the current user, filtered by month and year
        $kehadiran = Kehadiran::where('user_id', $user->id)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->get();

        // Pass data to the view
        return view('karyawan.absensi', compact('user', 'kehadiran', 'bulan', 'tahun'));
    }



    public function karyawanKehadiran()
    {
        return view('karyawan.kehadiran');
    }

    public function karyawanIzin()
    {
        return view('karyawan.izin'); // Page izin
    }

    public function karyawanCuti()
    {
        $user = Auth::user();
        $cuti = Cuti::where('user_id', $user->id)->get();
        $cuti = Cuti::where('user_id', $user->id)->withTrashed()->get();

        // Kirim data ke view
        return view('karyawan.cuti', compact('user', 'cuti'));
    }


    public function karyawanPenilaian()
    {
        $user = Auth::user();
        $kinerjas = Kinerja::where('user_id', $user->id)->get();

        // Kirim data ke view
        return view('karyawan.penilaian', compact('user', 'kinerjas'));
    }
}
