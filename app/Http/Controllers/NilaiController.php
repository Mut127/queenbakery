<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /**
     * Menampilkan daftar nilai.
     *
     * @return \Illuminate\View\View
     */
    public function indexNilai()
    {
        $nilai = Nilai::all();
        return view('admin.nilai', compact('nilai'));
    }

    /**
     * Menyimpan data nilai baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeNilai(Request $request)
    {
        $validated = $request->validate([
            'nama_pelamar' => 'required|string|max:255',
            'nilai_tes' => 'required|integer|min:0|max:100',
            'nilai_wawancara' => 'required|integer|min:0|max:100',
            'hasil_keputusan' => 'required|string|in:Diterima,Ditolak',
        ]);

        Nilai::create($validated);

        return redirect()->route('admin.nilai.indexNilai')->with('success', 'Nilai berhasil ditambahkan.');
    }

    /**
     * Memperbarui data nilai.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateNilai(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_pelamar' => 'required|string|max:255',
            'nilai_tes' => 'required|integer',
            'nilai_wawancara' => 'required|integer',
            'hasil_keputusan' => 'required|string',
        ]);

        $nilai = Nilai::findOrFail($id);
        $nilai->update($validated);

        return redirect()->route('admin.nilai.indexNilai')->with('success', 'Nilai berhasil diperbarui.');
    }


    /**
     * Menghapus data nilai.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyNilai($id)
    {
        $nilai = Nilai::findOrFail($id);
        $nilai->delete();
        return redirect()->route('admin.nilai.indexNilai')->with('success', 'Data berhasil dihapus');
    }
}
