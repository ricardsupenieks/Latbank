<?php

namespace App\Http\Controllers;

use App\generateAccountNumber;
use App\generateCode;
use App\Models\Account;
use App\Models\Code;
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

                Account::create([
                   'owner_id' => Auth()->user()->getAuthIdentifier(),
                    'account_number' => (new generateAccountNumber)->generateAccountNumber(),
                    'currency' => 'EUR',
                    'balance' => 0.00
                ]);

                for($i=0;$i<10;$i++) {
                    Code::create([
                        'owner_id' => Auth()->user()->getAuthIdentifier(),
                        'code' => (new generateCode)->generateCode(),
                    ]);
                }

            } else {
                $firstTimeLogin = false;
            }

            $codes = json_decode(Code::whereOwnerId(Auth::user()->getAuthIdentifier())->get(), true);

            return view('home', ['firstTimeLogin' => $firstTimeLogin, 'codes' => $codes]);
        }
        return view('landing');
    }
}
