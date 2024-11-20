<?php

namespace App\Http\Controllers;

use App\Models\Pelamar;
use Illuminate\Http\Request;

class PelamarController extends Controller
{
    public function indexPelamar()
    {
        // Mengambil semua pelamar
        $pelamars = Pelamar::all();
        return view('admin.pelamar', compact('pelamars'));
    }

    public function storePelamar(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'address' => 'required|string|max:500',
            'education' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $photoName = null;

        // Cek apakah direktori ada, jika tidak buat direktori
        if (!file_exists(public_path('images/pelamar'))) {
            mkdir(public_path('images/pelamar'), 0777, true);
        }

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('images/pelamar'), $photoName);
        }

        Pelamar::create([
            'name' => $validatedData['name'],
            'dob' => $validatedData['dob'],
            'address' => $validatedData['address'],
            'education' => $validatedData['education'],
            'position' => $validatedData['position'],
            'photo' => $photoName,
        ]);

        return redirect()->route('admin.pelamar.indexPelamar')->with('message', 'Pelamar berhasil ditambahkan.');
    }

    public function editPelamar($id)
    {
        // Menemukan pelamar berdasarkan ID
        $pelamars = Pelamar::findOrFail($id);
        return view('admin.pelamar_edit', compact('pelamars'));
    }

    public function updatePelamar(Request $request, $id)
    {
        // Menemukan pelamar berdasarkan ID
        $pelamars = Pelamar::findOrFail($id);

        // Validasi data yang masuk
        $request->validate([
            'name' => 'required|string',
            'dob' => 'required|string',
            'address' => 'required|string',
            'education' => 'required|string',
            'position' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Menyimpan data yang telah diupdate
        $pelamars->update($request->except('photo')); // Mengecualikan 'photo' dari data update

        // Menangani upload foto jika ada
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($pelamars->photo) {
                unlink(storage_path('app/public/' . $pelamars->photo));
            }
            // Simpan foto baru
            $pelamars->photo = $request->file('photo')->store('photos', 'public');
            $pelamars->save();
        }

        return redirect()->route('admin.pelamar.indexPelamar')->with('success', 'Pelamar updated successfully!');
    }

    public function destroyPelamar($id)
    {
        // Menemukan pelamar berdasarkan ID
        $pelamars = Pelamar::findOrFail($id);

        /* Hapus foto jika ada
        if ($pelamars->photo) {
            unlink(storage_path('app/public/' . $pelamars->photo));
        }*/

        // Hapus pelamar dari database
        $pelamars->delete();

        return redirect()->route('admin.pelamar.indexPelamar')->with('success', 'Pelamar deleted successfully!');
    }
}
