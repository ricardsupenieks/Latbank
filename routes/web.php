<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\CreateAccountController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LandingController::class, 'index']);

Route::get('/accounts', [AccountsController::class, 'showForm']);

Route::get('account/{account_number}', [AccountController::class, 'index']);
Route::post('account/deposit', [AccountController::class, 'deposit']);

Route::get('/account/create', [CreateAccountController::class, 'showForm']);
Route::post('/account/create', [CreateAccountController::class, 'create']);

Route::get('/register', [RegisterController::class, 'showForm']);
Route::post('/register', [RegisterController::class, 'execute']);

Route::get('/login', [LoginController::class, 'showForm']);
Route::post('/login', [LoginController::class, 'execute']);

Route::get('/logout', [LogoutController::class, 'execute']);
