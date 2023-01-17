<?php

namespace App\Http\Controllers;

use App\GenerateAccountNumber;
use App\GenerateCode;
use App\Models\Account;
use App\Models\Code;
use Illuminate\Support\Facades\Auth;
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

                Account::create([
                   'owner_id' => Auth()->user()->getAuthIdentifier(),
                    'account_number' => (new GenerateAccountNumber)->generateAccountNumber(),
                    'currency' => 'EUR',
                    'balance' => 0
                ]);

                for($i=0;$i<10;$i++) {
                    Code::create([
                        'owner_id' => Auth()->user()->getAuthIdentifier(),
                        'code' => (new GenerateCode)->generateCode(),
                    ]);
                }

            } else {
                $firstTimeLogin = false;
            }

            $codes = Code::whereOwnerId(Auth::user()->getAuthIdentifier())->get();

            return view('home', ['firstTimeLogin' => $firstTimeLogin, 'codes' => $codes]);
        }
        return view('landing');
    }
}
