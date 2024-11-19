<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\Pelamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        // Ambil semua data pelamar
        $pelamars = Pelamar::all();

        // Kirim data ke view
        return view('admin.pelamar', compact('pelamars'));
    }

    public function showDashboard()
    {

        return view('admin.dashboard');
    }
    public function showProfile(Request $request)
    {

        return view('admin.profile');
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
        return redirect()->route('admin.user')->with('success', 'User created successfully.');
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

        return redirect()->route('admin.user')->with('success', 'User updated successfully.');
    }

    // Remove the specified user from storage
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.user')->with('success', 'User deleted successfully.');
    }

    // Di dalam AdminController.php
    public function showAbsensi()
    {
        return view('admin.absensi'); // Sesuaikan dengan path view absensi
    }

    public function showIzin()
    {
        return view('admin.izin'); // Page izin
    }

    public function showKehadiran()
    {
        return view('admin.kehadiran');
    }

    public function showPelamar()
    {
        $pelamars = Pelamar::all();
        return view('admin.pelamar', compact('pelamars'));
    }

    public function storePelamar(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|string',
            'address' => 'required|string',
            'education' => 'required|string',
            'institution_name' => 'required|string',
            'entry_year' => 'required|numeric',
            'exit_year' => 'required|numeric',
            'position' => 'required|string',
            'company_name' => 'required|string',
            'work_entry_year' => 'required|numeric',
            'work_exit_year' => 'required|numeric',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        Pelamar::create($data);

        return redirect()->route('admin.pelamar')->with('success', 'Pelamar added successfully!');
    }

    // Show edit form
    /*public function editPelamar($id)
    {
        $pelamars = Pelamar::findOrFail($id);
        return view('admin.pelamar', compact('pelamar'));
    }*/


    // Update an applicant
    public function updatePelamar(Request $request, $id)
    {

        $pelamars = Pelamar::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string',
            'dob' => 'required|string',
            'address' => 'required|string',
            'education' => 'required|string',
            'institution_name' => 'required|string',
            'entry_year' => 'required|string',
            'exit_year' => 'required|string',
            'position' => 'required|string',
            'company_name' => 'required|string',
            'work_entry_year' => 'required|string',
            'work_exit_year' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $pelamars = Pelamar::findOrFail($id);
        $pelamars->update($request->all());

        // Handle file upload
        if ($request->hasFile('photo')) {
            $pelamars->photo = $request->file('photo')->store('photos', 'public');
            $pelamars->save();
        }

        return redirect()->route('admin.pelamar')->with('success', 'Pelamar updated successfully!');
    }

    // Delete an applicant
    public function destroyPelamar($id)
    {
        $pelamars = Pelamar::findOrFail($id);
        if ($pelamars->photo) {
            unlink(storage_path('app/public/' . $pelamars->photo));
        }
        $pelamars->delete();

        return redirect()->route('admin.pelamar')->with('success', 'Pelamar deleted successfully!');
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

    public function showCuti()
    {
        return view('admin.cuti');
    }

    public function showPenilaian()
    {
        return view('admin.penilaian');
    }
}
