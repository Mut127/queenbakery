<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function showDashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('fail', 'You must be logged in to access the dashboard');
        }

        if (Auth::user()->usertype == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::user()->usertype == 'owner') {
            return redirect()->route('owner.dashboard');
        } else {
            return redirect('/');
        }
    }

    public function showProfile()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('fail', 'You must be logged in to access the profile page');
        }

        if (Auth::user()->usertype == 'admin') {
            return view('admin.profile');
        } elseif (Auth::user()->usertype == 'owner') {
            return redirect()->route('owner.profile');
        } else {
            return redirect('/');
        }
    }

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

    public function showAbsensi()
    {
        return $this->redirectByUsertype('absensi');
    }

    public function showIzin() //izin
    {
        return $this->redirectByUsertype('izin');
    }

    public function showKehadiran()
    {
        return $this->redirectByUsertype('kehadiran');
    }

    public function showPelamar()
    {
        return $this->redirectByUsertype('pelamar');
    }

    public function showLowongan()
    {
        return $this->redirectByUsertype('lowongan');
    }

    public function showNilai()
    {
        return $this->redirectByUsertype('nilai');
    }

    public function showPengumuman()
    {
        return $this->redirectByUsertype('pengumuman');
    }

    public function showCuti()
    {
        return $this->redirectByUsertype('cuti');
    }

    public function showPenilaian()
    {
        return $this->redirectByUsertype('penilaian');
    }

    private function redirectByUsertype($routeName)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('fail', 'You must be logged in to access this page');
        }

        $usertype = Auth::user()->usertype;

        if ($usertype == 'admin') {
            return redirect()->route("admin.$routeName");
        } elseif ($usertype == 'owner') {
            return redirect()->route("owner.$routeName");
        } else {
            return redirect()->route("karyawan.$routeName", $routeName);
        }
    }
}
