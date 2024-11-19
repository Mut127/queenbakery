<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ProfileController extends Controller
{
    public function showProfile(Request $request)
    {

        return view('profile');
    }
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        /** @var \App\Models\User $user **/
        $user = Auth::user();
        $user->name = $request->name;
        $user->number = $request->number;
        if ($request->hasFile('profile_image')) {
            $profileImage = $request->file('profile_image');
            $profileImageName = time() . '.' . $profileImage->getClientOriginalExtension();
            $profileImage->move(public_path('images/profile'), $profileImageName);

            // delete old profile image if exists
            if ($user->profile_image) {
                $oldImagePath = public_path('images/profile/' . $user->profile_image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $user->profile_image = $profileImageName;
        }
        $user->save();

        return redirect()->route('profile')->with('message', 'Profile berhasil diperbarui');
    }

    public function changeProfilePhoto(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/profile');
            $image->move($destinationPath, $name);
            /** @var \App\Models\User $user **/
            $user->profile_image = $name;
            $user->save();
        }

        return redirect()->route('profile')->with('message', 'Foto profile berhasil diganti');
    }

    public function password()
    {
        return view('page.editpassword');
    }

    public function changePassword(Request $request)
    {
        // Mengimpor aturan Password yang benar dari Laravel
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::min(8)],

        ]);
        $user = Auth::user();

        // Verifikasi password saat ini
        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Password tidak sesuai.'])->withInput();
        }

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('profile')->with('message', 'Ganti password telah berhasil.');
    }
}
