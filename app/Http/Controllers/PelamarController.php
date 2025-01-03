<?php

namespace App\Http\Controllers;

use App\Models\Kategoriloker;
use App\Models\Pelamar;
use App\Models\PelamarAcceptedMail;
use App\Models\PelamarRejectedMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PelamarController extends Controller
{
    public function indexPelamar()
    {
        // Mengambil semua pelamar
        $pelamars = Pelamar::all();
        $kategorilokers = Kategoriloker::all();

        return view('admin.pelamar', compact('pelamars', 'kategorilokers'));
    }

    public function storePelamar(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'dob' => 'required|date',
            'address' => 'required|string|max:500',
            'education' => 'required|string|max:255',

            'kategori_id' => 'required|exists:kategorilokers,id', // Tambahkan validasi kategori
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
            'email' => $validatedData['email'],
            'dob' => $validatedData['dob'],
            'address' => $validatedData['address'],
            'education' => $validatedData['education'],

            'kategori_id' => $validatedData['kategori_id'], // Tambahkan kategori loker
            'photo' => $photoName,
        ]);

        return redirect()->route('admin.pelamar.indexPelamar')->with('message', 'Pelamar berhasil ditambahkan.');
    }

    public function editPelamar($id)
    {
        // Menemukan pelamar berdasarkan ID
        $pelamars = Pelamar::findOrFail($id);
        $kategorilokers = Kategoriloker::all();

        return view('admin.pelamar_edit', compact('pelamars', 'kategorilokers'));
    }

    public function updatePelamar(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'address' => 'required|string',
            'education' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategorilokers,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $pelamar = Pelamar::findOrFail($id);

        // Update data pelamar
        $pelamar->name = $request->input('name');
        $pelamar->dob = $request->input('dob');
        $pelamar->address = $request->input('address');
        $pelamar->education = $request->input('education');
        $pelamar->kategori_id = $request->input('kategori_id');

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


    public function updateStatus(Request $request, $id)
    {
        try {
            $pelamar = Pelamar::findOrFail($id);
            $pelamar->status = $request->status;
            $pelamar->save();

            // Logging sebelum mengirim email
            Log::info('Mencoba mengirim email', [
                'pelamar_id' => $pelamar->id,
                'email' => $pelamar->email,
                'status' => $pelamar->status
            ]);

            if ($pelamar->status === 'diterima') {
                Mail::to($pelamar->email)->send(new PelamarAcceptedMail($pelamar));
                Log::info('Email penerimaan berhasil dikirim');
            } elseif ($pelamar->status === 'ditolak') {
                Mail::to($pelamar->email)->send(new PelamarRejectedMail($pelamar));
                Log::info('Email penolakan berhasil dikirim');
            }

            return redirect()->route('admin.pelamar.indexPelamar')->with('success', 'Status pelamar berhasil diperbarui.');
        } catch (\Exception $e) {
            // Logging error
            Log::error('Gagal mengirim email', [
                'error' => $e->getMessage(),
                'pelamar_id' => $id
            ]);

            return redirect()->route('admin.pelamar.indexPelamar')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
