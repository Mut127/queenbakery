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
            // Validate the form data
            $request->validate([
                'status' => 'required|string|in:Hadir,Izin,Sakit',
                'ket' => 'nullable|string|max:1000',
                'image_path' => 'nullable|file|mimes:jpg,png,jpeg,pdf|max:2048', // Validate file (optional)
                'user_id' => 'required|exists:users,id', // Ensure the user exists
            ]);

            $imagePath = $request->file('image_path') ? $request->file('image_path')->store('izin', 'public') : null;

            // Save the attendance for the selected user
            Kehadiran::create([
                'user_id' => $request->user_id, // Save the selected user's ID
                'status' => $request->status,
                'ket' => $request->ket ?? null,
                'image_path' => $imagePath, // Save file path if present
                'date' => now()->toTimeString(), // Current time
                'tanggal' => now()->toDateString(), // Current date
            ]);

            // Redirect dengan pesan sukses
            // After successfully saving the attendance
            if (Auth::user()->usertype == 'admin') {
                return redirect()->route('admin.kehadiran')->with('success', 'Presensi berhasil disimpan.');
            } elseif (Auth::user()->usertype == 'owner') {
                return redirect()->route('owner.kehadiran')->with('success', 'Presensi berhasil disimpan.');
            } else {
                return redirect()->route('karyawan.kehadiran')->with('success', 'Presensi berhasil disimpan.');
            }
        }

        // Ambil data kehadiran yang sudah ada untuk ditampilkan berdasarkan peran pengguna
        if (Auth::check()) {
            if ($user->usertype == 'admin') {
                // Fetch all users for admin
                $users = \App\Models\User::all();
                return view('admin.kehadiran', compact('user', 'users')); // Pass users to the view
            } elseif ($user->usertype == 'owner') {
                $users = \App\Models\User::all();
                return view('owner.kehadiran', compact('user', 'users'));
            } elseif ($user->usertype == 'karyawan') {
                $kehadiran = Kehadiran::where('user_id', $user->id)->get();
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

        // Jika pengguna adalah admin, simpan data cuti untuk pegawai yang dipilih

        // Untuk pengguna lain (owner atau karyawan), hanya menyimpan data cuti untuk mereka sendiri
        Cuti::create([
            'tgl_awal' => $request->start_date,
            'tgl_akhir' => $request->end_date,
            'jml_cuti' => $request->leave_days,
            'jenis' => $request->leave_type,
            'ket' => $request->description,
            'user_id' => Auth::id(),  // ID pengguna yang sedang login
        ]);


        // Redirect setelah berhasil menyimpan data
        if (Auth::user()->usertype == 'admin') {
            return redirect()->route('admin.cuti')->with('success_save', 'Pengajuan cuti berhasil disimpan.');
        } elseif (Auth::user()->usertype == 'owner') {
            return redirect()->route('owner.cuti')->with('success_save', 'Pengajuan cuti berhasil disimpan.');
        } else {
            return redirect()->route('karyawan.cuti')->with('success_save', 'Pengajuan cuti berhasil disimpan.');
        }
    }


    public function approveCuti($id)
    {
        $cuti = Cuti::findOrFail($id);
        $cuti->status = 'Disetujui';
        $cuti->save();
        if (Auth::user()->usertype == 'admin') {
            return redirect()->route('admin.cuti')->with('success',  'Cuti berhasil disetujui.');
        } elseif (Auth::user()->usertype == 'owner') {
            return redirect()->route('owner.cuti')->with('success',  'Cuti berhasil disetujui.');
        }

        // Jika jenis pengguna tidak teridentifikasi, kembali ke halaman sebelumnya
        return redirect()->route('login')->with('error', 'Unknown user type.');
    }
    public function rejectCuti($id)
    {
        $cuti = Cuti::findOrFail($id);
        $cuti->status = 'Ditolak';
        $cuti->save();

        if (Auth::user()->usertype == 'admin') {
            return redirect()->route('admin.cuti')->with('success_reject',  'Cuti berhasil ditolak.');
        } elseif (Auth::user()->usertype == 'owner') {
            return redirect()->route('owner.cuti')->with('success_reject',  'Cuti berhasil ditolak.');
        }

        // Jika jenis pengguna tidak teridentifikasi, kembali ke halaman sebelumnya
        return redirect()->route('login')->with('error', 'Unknown user type.');
    }

    public function cancelRequest($id)
    {
        $cuti = Cuti::findOrFail($id);

        if ($cuti->status === 'Pending') {
            $cuti->delete(); // Soft delete
            return redirect()->back()->with('success_cancel', 'Permintaan cuti berhasil dibatalkan.');
        }

        return redirect()->back()->with('error', 'Hanya permintaan dengan status Pending yang dapat dibatalkan.');
    }

    public function restoreRequest($id)
    {
        $cuti = Cuti::withTrashed()->findOrFail($id);

        if ($cuti->trashed()) {
            $cuti->restore(); // Mengembalikan data
            return redirect()->back()->with('success_request', 'Permintaan cuti berhasil diaktifkan kembali.');
        }

        return redirect()->back()->with('error', 'Data tidak dapat diaktifkan kembali.');
    }
    public function destroyCuti($id)
    {
        $cuti = Cuti::withTrashed()->findOrFail($id); // Termasuk data yang dihapus (soft delete)
        $cuti->forceDelete(); // Hapus permanen
        return redirect()->back()->with('success_delete', 'Data cuti berhasil dihapus secara permanen.');
    }
}
