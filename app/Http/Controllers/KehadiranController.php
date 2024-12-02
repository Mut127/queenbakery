<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kehadiran;
use App\Models\Cuti;

class KehadiranController extends Controller
{

    public function showAbsensi(Request $request)
    {
        // Ambil bulan dan tahun dari request atau gunakan bulan dan tahun saat ini sebagai default
        $bulan = $request->input('bulan', now()->month); // Default ke bulan berjalan
        $tahun = $request->input('tahun', now()->year); // Default ke tahun berjalan

        // Ambil data absensi berdasarkan bulan dan tahun yang dipilih
        $kehadiran = Kehadiran::with('user')
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->orderBy('tanggal', 'asc')
            ->get();

        // Kirim data ke view
        return view('admin.absensi', compact('kehadiran', 'bulan', 'tahun'));
    }


    public function showKehadiran(Request $request)
    {
        // Ambil data pengguna yang sedang login
        $user = Auth::user();

        // Jika request method adalah POST (misalnya pengajuan kehadiran)
        if ($request->isMethod('post')) {
            // Lakukan validasi data
            $request->validate([
                'status' => 'required|string|in:Hadir,Izin,Sakit',
                'ket' => 'nullable|string|max:1000',
                'image_path' => 'nullable|file|mimes:jpg,png,jpeg,pdf|max:2048', // Validasi file (opsional)
            ]);

            $imagePath = $request->file('image_path') ? $request->file('image_path')->store('izin', 'public') : null;

            // Simpan data absensi ke database
            Kehadiran::create([
                'user_id' => $user->id,
                'status' => $request->status,
                'ket' => $request->ket ?? null,
                'image_path' => $imagePath, // Simpan path file jika ada
                'date' => now()->toTimeString(), // Waktu saat ini
                'tanggal' => now()->toDateString(), // Tanggal saat ini
            ]);

            // Redirect dengan pesan sukses
            // After successfully saving the attendance
            if (Auth::user()->usertype == 'admin') {
                return redirect()->route('admin.kehadiran')->with('success', 'Absensi berhasil disimpan.');
            } elseif (Auth::user()->usertype == 'owner') {
                return redirect()->route('owner.kehadiran')->with('success', 'Absensi berhasil disimpan.');
            } else {
                return redirect()->route('karyawan.kehadiran')->with('success', 'Absensi berhasil disimpan.');
            }
        }

        // Ambil data kehadiran yang sudah ada untuk ditampilkan berdasarkan peran pengguna
        if (Auth::check()) {
            // Jika peran pengguna adalah admin
            if ($user->usertype == 'admin') {
                $kehadiran = Kehadiran::all(); // Ambil semua data kehadiran
                return view('admin.kehadiran', compact('user', 'kehadiran'));

                // Jika peran pengguna adalah owner
            } elseif ($user->usertype == 'owner') {
                $kehadiran = Kehadiran::where('user_id', $user->id)->get(); // Ambil data kehadiran untuk owner
                return view('owner.kehadiran', compact('user', 'kehadiran'));

                // Jika peran pengguna adalah karyawan
            } elseif ($user->usertype == 'karyawan') {
                $kehadiran = Kehadiran::where('user_id', $user->id)->get(); // Ambil data kehadiran untuk karyawan
                return view('karyawan.kehadiran', compact('user', 'kehadiran'));
            }
        }

        // Jika tidak ada pengguna yang terautentikasi, redirect atau tampilkan error
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }



    public function showCuti()
    {
        // Ambil semua pengajuan cuti dari database
        $cuti = Cuti::all();

        // Kirim data ke view
        return view('admin.cuti', compact('cuti'));
    }


    // Method untuk menyimpan pengajuan cuti
    public function submitCuti(Request $request)
    {
        // Validasi inputan form
        $request->validate([
            'employee_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'leave_days' => 'required|integer|min:1',
            'leave_type' => 'required|string|in:Tahunan,Sakit,Keluarga',
            'description' => 'nullable|string|max:1000',
        ]);

        // Simpan data cuti ke dalam database
        Cuti::create([
            'tgl_awal' => $request->start_date,
            'tgl_akhir' => $request->end_date,
            'jml_cuti' => $request->leave_days,
            'jenis' => $request->leave_type,
            'ket' => $request->description,
            'user_id' => Auth::id(),  // Mengambil ID pengguna yang sedang login
        ]);

        // Redirect setelah berhasil menyimpan data
        if (Auth::user()->usertype == 'admin') {
            return redirect()->route('admin.cuti')->with('success', 'Pengajuan cuti berhasil disimpan.');
        } elseif (Auth::user()->usertype == 'owner') {
            return redirect()->route('owner.cuti')->with('success', 'Pengajuan cuti berhasil disimpan.');
        } else {
            return redirect()->route('karyawan.cuti')->with('success', 'Pengajuan cuti berhasil disimpan.');
        }
    }

    public function approveCuti($id)
    {
        $cuti = Cuti::findOrFail($id);
        $cuti->status = 'Disetujui';
        $cuti->save();

        return redirect()->route('admin.cuti')->with('success', 'Cuti berhasil disetujui.');
    }

    public function rejectCuti($id)
    {
        $cuti = Cuti::findOrFail($id);
        $cuti->status = 'Ditolak';
        $cuti->save();

        return redirect()->route('admin.cuti')->with('success', 'Cuti berhasil ditolak.');
    }
}
