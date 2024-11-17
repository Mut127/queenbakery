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
}
