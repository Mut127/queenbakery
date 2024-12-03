<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Kinerja;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    public function showDashboard()
    {

        return view('admin.dashboard');
    }

    public function updateProfile(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Get the logged-in admin's information from the session
        $admin = Admin::find(session('LoggedAdminInfo'));

        if (!$admin) {
            return redirect()->route('admin.login')->with('fail', 'You must be logged in to update the profile');
        }

        // Update the admin's information
        $admin->name = $request->input('name');
        $admin->bio = $request->input('bio');

        // Handle the profile picture upload
        if ($request->hasFile('picture')) {
            // Delete old picture if it exists
            if ($admin->picture) {
                Storage::disk('public')->delete($admin->picture);
            }

            // Store the new picture
            $file = $request->file('picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('profile_pictures', $filename, 'public');

            $admin->picture = $path;
        }

        $admin->save();

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully');
    }

    /*
    public function logout()
    {
        // Clear the session data for the logged-in admin
        session()->forget('LoggedAdminInfo');

        // Redirect to the login page
        return redirect()->route('admin.login');
    }
    */

    public function showUserList()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('fail', 'You must be logged in to access this page');
        }

        $users = User::all();

        if (Auth::user()->usertype == 'admin') {
            return view('admin.user', compact('users'));
        } elseif (Auth::user()->usertype == 'owner') {
            return view('owner.user', compact('users'));
        } else {
            return redirect('/');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'number' => 'required',
            'usertype' => 'required|in:admin,owner,karyawan',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'usertype' => $request->usertype,
            'password' => bcrypt($request->password),
        ]);

        // Mengarahkan berdasarkan jenis pengguna yang login
        if (Auth::user()->usertype == 'admin') {
            return redirect()->route('admin.user')->with('success', 'User created successfully.');
        } elseif (Auth::user()->usertype == 'owner') {
            return redirect()->route('owner.user')->with('success', 'User created successfully.');
        }

        // Jika jenis pengguna tidak teridentifikasi, kembali ke halaman sebelumnya
        return redirect()->route('login')->with('error', 'Unknown user type.');
    }
    public function edit($id)
    {
        $user = User::findOrFail($id); // Menemukan pengguna berdasarkan ID
        return response()->json($user); // Mengembalikan data pengguna dalam format JSON
    }

    // Update the specified user in storage
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required',
            'number' => 'required',
            'usertype' => 'required|in:admin,owner,karyawan',
            'password' => 'nullable|min:8',
        ]);

        // Cari user berdasarkan ID
        $user = User::find($id);

        // Update data user
        $user->update([
            'name' => $request->name,
            'number' => $request->number,
            'usertype' => $request->usertype,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);

        // Mengarahkan berdasarkan jenis pengguna yang login
        if (Auth::user()->usertype == 'admin') {
            return redirect()->route('admin.user')->with('success', 'User created successfully.');
        } elseif (Auth::user()->usertype == 'owner') {
            return redirect()->route('owner.user')->with('success', 'User created successfully.');
        }

        // Jika jenis pengguna tidak teridentifikasi, kembali ke halaman sebelumnya
        return redirect()->route('login')->with('error', 'Unknown user type.');
    }


    // Remove the specified user from storage
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // Soft delete
        return redirect()->back()->with('success', 'User berhasil dihapus.');

        // Mengarahkan berdasarkan jenis pengguna yang login
        if (Auth::user()->usertype == 'admin') {
            return redirect()->route('admin.user')->with('success', 'User created successfully.');
        } elseif (Auth::user()->usertype == 'owner') {
            return redirect()->route('owner.user')->with('success', 'User created successfully.');
        }

        // Jika jenis pengguna tidak teridentifikasi, kembali ke halaman sebelumnya
        return redirect()->route('login')->with('error', 'Unknown user type.');
    }
    public function hardDestroy($id)
    {
        $user = User::withTrashed()->findOrFail($id); // Mengambil user yang sudah di-soft delete (termasuk yang sudah terhapus)

        $user->forceDelete(); // Menghapus data secara permanen
        if (Auth::user()->usertype == 'admin') {
            return redirect()->route('admin.userhistory')->with('success', 'User created successfully.');
        } elseif (Auth::user()->usertype == 'owner') {
            return redirect()->route('owner.userhistory')->with('success', 'User created successfully.');
        }

        // Jika jenis pengguna tidak teridentifikasi, kembali ke halaman sebelumnya
        return redirect()->route('login')->with('error', 'Unknown user type.');
    }


    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id); // Cari user termasuk yang terhapus
        $user->restore(); // Pulihkan user

        // Mengarahkan berdasarkan jenis pengguna yang login
        if (Auth::user()->usertype == 'admin') {
            return redirect()->route('admin.user')->with('success', 'User created successfully.');
        } elseif (Auth::user()->usertype == 'owner') {
            return redirect()->route('owner.user')->with('success', 'User created successfully.');
        }

        // Jika jenis pengguna tidak teridentifikasi, kembali ke halaman sebelumnya
        return redirect()->route('login')->with('error', 'Unknown user type.');
    }

    public function showDeletedUsers()
    {
        $users = User::onlyTrashed()->get();
        return view('admin.userhistory', compact('users'));
    }


    // Di dalam AdminController.php

    public function showIzin()
    {
        return view('admin.izin'); // Page izin
    }

    public function showPelamar()
    {
        return view('admin.pelamar'); // Page Rekrutmen
    }

    public function showLowongan()
    {
        return view('admin.lowongan');
    }

    public function showNilai()
    {
        return view('admin.nilai');
    }

    public function showPengumuman()
    {
        return view('admin.pengumuman');
    }
}
