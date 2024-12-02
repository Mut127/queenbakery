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
        $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'address' => 'required|string',
            'education' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $pelamar = Pelamar::findOrFail($id);

        // Update data pelamar
        $pelamar->name = $request->input('name');
        $pelamar->dob = $request->input('dob');
        $pelamar->address = $request->input('address');
        $pelamar->education = $request->input('education');
        $pelamar->position = $request->input('position');

        // Menangani upload foto jika ada
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($pelamar->photo && file_exists(public_path('images/pelamar/' . $pelamar->photo))) {
                unlink(public_path('images/pelamar/' . $pelamar->photo));
            }

            // Simpan foto baru
            $photo = $request->file('photo');
            $photoName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('images/pelamar'), $photoName);

            $pelamar->photo = $photoName;
        }

        $pelamar->save();

        return redirect()->route('admin.pelamar.indexPelamar')->with('success', 'Data pelamar berhasil diperbarui.');
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