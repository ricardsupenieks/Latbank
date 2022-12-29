<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class LandingController extends Controller
{
    public function index(): View
    {
        if(Session::has('user')) {
            return view('home');
        }
        return view('landing');
    }
}
