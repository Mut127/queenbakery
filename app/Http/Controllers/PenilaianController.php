<?php

namespace App\Http\Controllers;

use App\Models\Kinerja;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenilaianController extends Controller
{
    public function showPenilaian()
    {
        // Ambil semua pegawai
        $users = User::where('usertype', 'karyawan')->get();

        // Ambil data penilaian
        $kinerjas = Kinerja::with('user')
            ->whereMonth('tgl_nilai', now()->month)
            ->orderBy('tgl_nilai', 'asc')
            ->get();

        return view('admin.penilaian', compact('users', 'kinerjas'));
    }

    // Simpan data penilaian kinerja
    public function storePenilaian(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'tgl_nilai' => 'required|date',
            'catatan' => 'nullable|string|max:1000',
            'nilai' => 'required|string|in:baiksekali,baik,cukup,kurang',
        ]);

        Kinerja::create([
            'user_id' => $request->user_id, // Ubah dari employee_id ke user_id
            'tgl_nilai' => $request->tgl_nilai, // Ubah dari date ke tgl_nilai
            'catatan' => $request->catatan, // Ubah dari description ke catatan
            'nilai' => $request->nilai, // Perbaiki typo 'niali' menjadi 'nilai', ubah dari score
        ]);
        if (Auth::user()->usertype == 'admin') {
            return redirect()->route('admin.penilaian')->with('success',   'Penilaian berhasil disimpan.');
        } elseif (Auth::user()->usertype == 'owner') {
            return redirect()->route('owner.penilaian')->with('success',   'Penilaian berhasil disimpan.');
        }

        // Jika jenis pengguna tidak teridentifikasi, kembali ke halaman sebelumnya
        return redirect()->route('login')->with('error', 'Unknown user type.');
    }

    // Edit data penilaian kinerja
    public function editPenilaian($id)
    {
        $kinerja = Kinerja::findOrFail($id);
        return response()->json($kinerja);
    }

    // Update data penilaian kinerja

    public function updatePenilaian(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'catatan' => 'required',
            'nilai' => 'required|in:baiksekali,baik,cukup,buruk',
        ]);

        // Cari user berdasarkan ID
        $kinerja = Kinerja::find($id);

        // Update data user
        $kinerja->update([
            'catatan' => $request->catatan,
            'nilai' => $request->nilai,
        ]);

        if (Auth::user()->usertype == 'admin') {
            return redirect()->route('admin.penilaian')->with('success',   'Penilaian berhasil diedit.');
        } elseif (Auth::user()->usertype == 'owner') {
            return redirect()->route('owner.penilaian')->with('success',   'Penilaian berhasil diedit.');
        }

        // Jika jenis pengguna tidak teridentifikasi, kembali ke halaman sebelumnya
        return redirect()->route('login')->with('error', 'Unknown user type.');
    }


    // Hapus data penilaian kinerja
    public function destroyPenilaian($id)
    {
        $kinerja = Kinerja::findOrFail($id);
        $kinerja->delete();

        if (Auth::user()->usertype == 'admin') {
            return redirect()->route('admin.penilaian')->with('success',   'Penilaian berhasil dihapus.');
        } elseif (Auth::user()->usertype == 'owner') {
            return redirect()->route('owner.penilaian')->with('success',   'Penilaian berhasil dihapus.');
        }

        // Jika jenis pengguna tidak teridentifikasi, kembali ke halaman sebelumnya
        return redirect()->route('login')->with('error', 'Unknown user type.');
    }
}
