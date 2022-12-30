<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class LandingController extends Controller
{
    public function index(): View
    {
        if (Auth::user()) {
            $firstTimeLogin = true;

            if (Auth::user()->first_time_login) {
                Auth::user()->first_time_login = false;
                Auth::user()->save();
            } else {
                $firstTimeLogin = false;
            }
            return view('home', ['firstTimeLogin' => $firstTimeLogin]);
        }
        return view('landing');
    }
}
