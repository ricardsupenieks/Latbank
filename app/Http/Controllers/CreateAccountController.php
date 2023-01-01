<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class CreateAccountController extends Controller
{
    public function showForm(): View
    {

        return view('accountCreate');
    }

    public function execute(): Redirector
    {

        return \redirect('accounts');
    }
}
