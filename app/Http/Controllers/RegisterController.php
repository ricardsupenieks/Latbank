<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function showForm(): View
    {
        return view('register');
    }

    public function execute(Request $request)
    {
        $request->validate([
           'name' => ['required', 'alpha'],
           'surname' => ['required', 'alpha'],
           'email' => ['required','email', 'unique:users,email'],
           'password' => ['required'],
           'confirm_password' => ['required', 'same:password'],
        ]);

        User::create([
            'name' => ucfirst(strtolower($request->input('name'))),
            'surname' => ucfirst(strtolower($request->input('surname'))),
            'full_name' => strtoupper($request->input('name') . ' ' . $request->input('surname')),
            'email' => strtolower($request->input('email')),
            'password' => bcrypt($request->input('password')),
        ]);

        return \redirect('/login')->with('success', 'Your account has been created.');
    }
}
