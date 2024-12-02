<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Kehadiran;
use App\Models\Kinerja;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OwnerController extends Controller
{
    public function ownerDashboard()
    {

        return view('owner.dashboard');
    }

    public function ownerProfile(Request $request)
    {

        return view('owner.profile');
    }

    public function logout()
    {
        // Clear the session data for the logged-in owner
        session()->forget('LoggedownerInfo');

        // Redirect to the login page
        return redirect()->route('owner.login');
    }


    public function ownerUserList()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('fail', 'You must be logged in to access this page');
        }

        $users = User::all();
        if (Auth::user()->usertype == 'owner') {
            return view('owner.user', compact('users'));
        } else {
            return redirect('/');
        }
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'role' => 'required|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create a new User instance
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        // Handle the picture file upload
        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('profile_pictures', $filename, 'public');
            $user->picture = $path;
        }

        // Save the user to the database
        $user->save();

        // Redirect to the user list with a success message
        return redirect()->route('owner.user')->with('success', 'User created successfully.');
    }


    // Update the specified user in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required|string',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('profile_pictures', $filename, 'public');
            $user->picture = $path;
        }
        $user->save();

        return redirect()->route('owner.user')->with('success', 'User updated successfully.');
    }

    // Remove the specified user from storage
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('owner.user')->with('success', 'User deleted successfully.');
    }

    // Di dalam ownerController.php
    public function ownerAbsensi(Request $request)
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
        return view('owner.absensi', compact('kehadiran', 'bulan', 'tahun'));
    }


    public function ownerIzin()
    {
        return view('owner.izin'); // Page izin
    }
    public function ownerCuti()
    {
        $cuti = Cuti::all();

        // Kirim data ke view
        return view('owner.cuti', compact('cuti'));
    }

    public function ownerKehadiran()
    {
        return view('owner.kehadiran');
    }

    public function ownerPelamar()
    {
        return view('owner.pelamar');
    }

    public function ownerLowongan()
    {
        return view('owner.lowongan');
    }

    public function ownerNilai()
    {
        return view('owner.nilai');
    }

    public function ownerPengumuman()
    {
        return view('owner.pengumuman');
    }


    public function ownerPenilaian()
    {
        // Ambil semua pegawai
        $users = User::where('usertype', 'karyawan')->get();

        // Ambil data penilaian
        $kinerjas = Kinerja::with('user')
            ->whereMonth('tgl_nilai', now()->month)
            ->orderBy('tgl_nilai', 'asc')
            ->get();

        return view('owner.penilaian', compact('users', 'kinerjas'));
    }
}
