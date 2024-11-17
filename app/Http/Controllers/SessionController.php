<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    function index()
    {
        return view('sesi/login');
    }

    public function login(Request $request)
    {
        // Menyimpan email ke sesi untuk ditampilkan kembali jika login gagal
        Session::flash('email', $request->email);

        // Validasi input
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        // Menyiapkan informasi login
        $infologin = [
            'email' => $request->email,
            'password' => $request->password
        ];

        // Mencoba autentikasi
        if (Auth::attempt($infologin)) {
            $user = Auth::user();

            // Cek tipe user dan arahkan ke halaman yang sesuai
            if ($user->usertype === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Selamat Datang, ' . $user->name);
            } elseif ($user->usertype === 'owner') {
                return redirect()->route('owner.dashboard')->with('success', 'Selamat Datang, ' . $user->name);
            } elseif ($user->usertype === 'karyawan') {
                return redirect()->route('karyawan.absensi')->with('success', 'Selamat Datang, ' . $user->name);
            }
        } else {
            // Jika login gagal, kembali ke halaman login dengan pesan error
            return redirect('sesi')->withErrors(['loginError' => 'Username dan password yang dimasukkan tidak valid']);
        }
    }


    // public function create()
    // {
    //     return view('admin.create');
    // }

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

        return redirect()->route('admin.user')->with('success', 'User created successfully.');
    }

    public function profile()
    {
        return view('page.profile');
    }


    // public function updateProfile(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'number' => 'required|string|max:255',
    //         'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);
    //     /** @var \App\Models\User $user **/
    //     $user = Auth::user();
    //     $user->name = $request->name;
    //     $user->number = $request->number;
    //     if ($request->hasFile('profile_image')) {
    //         $profileImage = $request->file('profile_image');
    //         $profileImageName = time() . '.' . $profileImage->getClientOriginalExtension();
    //         $profileImage->move(public_path('images/profile'), $profileImageName);

    //         // delete old profile image if exists
    //         if ($user->profile_image) {
    //             $oldImagePath = public_path('images/profile/' . $user->profile_image);
    //             if (file_exists($oldImagePath)) {
    //                 unlink($oldImagePath);
    //             }
    //         }

    //         $user->profile_image = $profileImageName;
    //     }
    //     $user->save();

    //     return redirect()->route('profile')->with('message', 'Profile berhasil diperbarui');
    // }

    // public function changeProfilePhoto(Request $request)
    // {
    //     $request->validate([
    //         'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);

    //     $user = Auth::user();
    //     if ($request->hasFile('profile_image')) {
    //         $image = $request->file('profile_image');
    //         $name = time() . '.' . $image->getClientOriginalExtension();
    //         $destinationPath = public_path('/images/profile');
    //         $image->move($destinationPath, $name);
    //         /** @var \App\Models\User $user **/
    //         $user->profile_image = $name;
    //         $user->save();
    //     }

    //     return redirect()->route('profile')->with('message', 'Foto profile berhasil diganti');
    // }

    // public function password()
    // {
    //     return view('page.editpassword');
    // }

    // public function changePassword(Request $request)
    // {
    //     // Mengimpor aturan Password yang benar dari Laravel
    //     $validated = $request->validateWithBag('updatePassword', [
    //         'current_password' => ['required', 'current_password'],
    //         'password' => ['required', 'confirmed', Password::min(8)],

    //     ]);
    //     $user = Auth::user();

    //     // Verifikasi password saat ini
    //     if (!Hash::check($validated['current_password'], $user->password)) {
    //         return back()->withErrors(['current_password' => 'Password tidak sesuai.'])->withInput();
    //     }

    //     $request->user()->update([
    //         'password' => Hash::make($validated['password']),
    //     ]);

    //     return redirect()->route('profile')->with('message', 'Ganti password telah berhasil.');
    // }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
