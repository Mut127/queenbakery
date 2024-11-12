<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function showDashboard()
    {
        // $LoggedAdminInfo = Admin::find(session('LoggedAdminInfo'));

        // if (!$LoggedAdminInfo) {
        //     return redirect()->route('admin.login')->with('fail', 'You must be logged in to access the dashboard');
        // }

        // return view('admin.dashboard', [
        //     'LoggedAdminInfo' => $LoggedAdminInfo,
        // ]);
        return view('admin.dashboard');
    }
    public function showProfile(Request $request)
    {
        // Get the logged-in admin's information from the session
        // $LoggedAdminInfo = Admin::find(session('LoggedAdminInfo'));

        // if (!$LoggedAdminInfo) {
        //     return redirect()->route('admin.login')->with('fail', 'You must be logged in to access the profile page');
        // }

        // // Pass the admin data to the profile view
        // return view('admin.profile', [
        //     'LoggedAdminInfo' => $LoggedAdminInfo,
        // ]);
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


    public function logout()
    {
        // Clear the session data for the logged-in admin
        session()->forget('LoggedAdminInfo');

        // Redirect to the login page
        return redirect()->route('admin.login');
    }


    public function showUserList()
    {
        $users = User::all(); // You might want to paginate or filter users

        return view('admin.user', compact('users'));
        // Pass the users data to the view
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
        return view('admin.pelamar');
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
