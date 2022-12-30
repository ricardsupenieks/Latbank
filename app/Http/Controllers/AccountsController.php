<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AccountsController extends Controller
{
    public function showForm(): View
    {
        return view('accounts');
    }

    public function create()
    {

    }
}
