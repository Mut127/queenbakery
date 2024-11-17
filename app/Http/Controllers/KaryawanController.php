<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KaryawanController extends Controller
{

    // Di dalam karyawanController.php
    public function karyawanAbsensi()
    {
        return view('karyawan.absensi'); // Sesuaikan dengan path view absensi
    }

    public function karyawanKehadiran()
    {
        return view('karyawan.kehadiran');
    }


    public function karyawanCuti()
    {
        return view('karyawan.cuti');
    }

    public function karyawanPenilaian()
    {
        return view('karyawan.penilaian');
    }
}
