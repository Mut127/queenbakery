<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kehadiran;
use App\Models\Cuti;

class KehadiranController extends Controller
{

    public function showAbsensi()
    {
        return view('admin.absensi'); // Sesuaikan dengan path view absensi
    }

    public function showKehadiran(Request $request)
    {
        // Ambil data pengguna yang sedang login
        $user = Auth::user();

        // Jika request method adalah POST (misalnya pengajuan izin)
        if ($request->isMethod('post')) {
            // Lakukan validasi data jika perlu
            $request->validate([
                'status' => 'required|string|in:Hadir,Izin,Sakit',
                'ket' => 'nullable|string|max:1000',
            ]);

            // Simpan data absensi ke database
            $kehadiran = Kehadiran::create([
                'user_id' => $user->id,
                'status' => $request->status,
                'ket' => $request->ket ?? null,
                'date' => now()->toTimeString(), // Waktu saat ini
                'tanggal' => now()->toDateString(), // Tanggal saat ini
            ]);


            // Redirect dengan pesan sukses
            return redirect()->route('admin.kehadiran')->with('success', 'Absensi berhasil disimpan.');
        }

        // Ambil data kehadiran yang sudah ada untuk ditampilkan (jika ada)
        $kehadiran = Kehadiran::where('user_id', $user->id)->get();

        // Kirim data kehadiran ke view
        return view('admin.kehadiran', compact('user', 'kehadiran'));
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
        return redirect()->route('admin.cuti')->with('success', 'Pengajuan cuti berhasil disimpan.');
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