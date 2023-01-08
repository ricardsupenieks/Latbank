<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CryptoSearchController extends Controller
{
    public function showResult(Request $request)
    {
        var_dump($request->get('search'));
    }
}
