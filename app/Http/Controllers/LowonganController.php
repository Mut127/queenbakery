<?php

namespace App\Http\Controllers;

use App\Models\Kategoriloker;
use App\Models\Lowongan;
use Illuminate\Http\Request;

class LowonganController extends Controller
{
    public function showLowongan()
    {
        // Ambil data kategori dari tabel Kategoriloker
        $kategorilokers = Kategoriloker::all();

        // Ambil data lowongan
        $lowongans = Lowongan::all();

        // Kirim data ke view
        return view('admin.lowongan', compact('lowongans', 'kategorilokers'));
    }

    // Menyimpan lowongan baru
    public function storeLowongan(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategorilokers,id',
            'tgl_awal' => 'required|date',
            'tgl_dl' => 'required|date|after_or_equal:tgl_awal',
            'deskripsi' => 'required|string',
        ]);

        Lowongan::create([
            'name' => $request->name,
            'kategori_id' => $request->kategori_id,
            'tgl_awal' => $request->tgl_awal,
            'tgl_dl' => $request->tgl_dl,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.lowongan')->with('success', 'Lowongan berhasil ditambahkan.');
    }

    // Memperbarui data lowongan
    public function updateLowongan(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategorilokers,id',
            'tgl_awal' => 'required|date',
            'tgl_dl' => 'required|date|after_or_equal:tgl_awal',
            'deskripsi' => 'required|string',
        ]);

        $lowongan = Lowongan::findOrFail($id);
        $lowongan->update([
            'name' => $request->name,
            'kategori_id' => $request->kategori_id,
            'tgl_awal' => $request->tgl_awal,
            'tgl_dl' => $request->tgl_adl,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.lowongan')->with('success', 'Lowongan berhasil diupdate.');
    }

    // Menghapus data lowongan
    public function deleteLowongan($id)
    {
        $lowongan = Lowongan::findOrFail($id);
        $lowongan->delete();

        return redirect()->route('admin.lowongan')->with('success', 'Lowongan berhasil dihapus.');
    }
}
