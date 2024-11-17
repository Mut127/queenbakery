<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function showProfile()
    {
        if (Auth::user()->usertype == 'admin') {
            return view('admin.profile');
        } elseif (Auth::user()->usertype == 'owner') {
            return redirect()->route('owner.profile');
        } else {
            return redirect('/');
        }
    }
}
