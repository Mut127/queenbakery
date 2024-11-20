<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;  // Ensure this model is imported
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    // Display all pengumuman
    public function showPengumuman()
    {
        $pengumuman = Pengumuman::all();
        return view('admin.pengumuman', compact('pengumuman'));
    }

    // Store a new pengumuman
    public function storePengumuman(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'judul' => 'required|string|max:255',  // Updated to match model field
            'tgl_post' => 'required|date',         // Updated to match model field
            'deskripsi' => 'required|string',      // Matches model field
        ]);

        // Create a new Pengumuman using validated data
        Pengumuman::create([
            'judul' => $request->judul,            // Match model field
            'tgl_post' => $request->tgl_post,      // Match model field
            'deskripsi' => $request->deskripsi,    // Match model field
        ]);

        // Redirect back with a success message
        return redirect()->route('admin.pengumuman')->with('success', 'Pengumuman berhasil ditambahkan');
    }

    // Delete an existing pengumuman
    public function destroyPengumuman($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->delete();

        return redirect()->route('admin.pengumuman')->with('success', 'Pengumuman berhasil dihapus');
    }
}
