<?php

namespace App\Http\Controllers;

use App\Models\Kinerja;
use App\Models\User;
use Illuminate\Http\Request;

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

        return redirect()->route('admin.penilaian')->with('success', 'Penilaian berhasil disimpan.');
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
        $validated = $request->validate([
            'catatan' => 'nullable|string|max:1000',
            'nilai' => 'required|string|in:Baik Sekali,Baik,Cukup,Kurang',
        ]);

        $kinerja = Kinerja::findOrFail($id);
        $kinerja->update([
            'catatan' => $request->catatan, // Ubah dari description
            'nilai' => $request->nilai, // Ubah dari score
        ]);

        return redirect()->route('admin.penilaian')->with('success', 'Penilaian berhasil disimpan.');
    }

    // Hapus data penilaian kinerja
    public function destroyPenilaian($id)
    {
        $kinerja = Kinerja::findOrFail($id);
        $kinerja->delete();

        return redirect()->route('admin.penilaian')->with('success', 'Penilaian berhasil disimpan.');
    }
}
