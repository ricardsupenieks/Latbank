<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class TransferController extends Controller
{
    public function showForm(): View
    {
        return view('transfer');
    }
}
