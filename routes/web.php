<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\CryptoMarketController;
use App\Http\Controllers\CryptoSearchController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransferController;
use App\Http\Middleware\Authenticate;
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

Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/accounts', [AccountsController::class, 'showForm'])->middleware(Authenticate::class)->name('accounts');

Route::post('/account/create', [AccountsController::class, 'createAccount'])->middleware(Authenticate::class);
Route::get('/account/{account_number}', [AccountController::class, 'showForm'])->middleware(Authenticate::class);
Route::post('/account/{account_number}/deposit', [AccountController::class, 'deposit'])->middleware(Authenticate::class);
Route::post('/account/{account_number}/withdraw', [AccountController::class, 'withdraw'])->middleware(Authenticate::class);
Route::delete('/account/{account_number}/close', [AccountController::class, 'close'])->middleware(Authenticate::class);

Route::get('/crypto', [CryptoMarketController::class, 'showMainPage']);
Route::get('/crypto/search', [CryptoSearchController::class, 'showCrypto']);
Route::get('/crypto/{cryptoId}/buy', [CryptoMarketController::class, 'buyCrypto'])->middleware(Authenticate::class);
//Route::get('/crypto/{cryptoId}/sell', [CryptoMarketController::class, 'sellCrypto']);
Route::get('/crypto/{cryptoId}', [CryptoMarketController::class, 'showCrypto']);

Route::get('/crypto/portfolio/{account_id}', [PortfolioController::class, 'showForm'])->middleware(Authenticate::class);

Route::get('/transactions', [TransactionController::class, 'showForm'])->middleware(Authenticate::class);

Route::get('/transfer', [TransferController::class, 'showForm'])->middleware(Authenticate::class);
Route::post('/transfer', [TransferController::class, 'execute'])->middleware(Authenticate::class);

Route::get('/register', [RegisterController::class, 'showForm']);
Route::post('/register', [RegisterController::class, 'execute']);

Route::get('/login', [LoginController::class, 'showForm']);
Route::post('/login', [LoginController::class, 'execute']);

Route::get('/logout', [LogoutController::class, 'execute'])->middleware(Authenticate::class);
