<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SavingController;
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

// -------------- Admin routes ..................
Route::prefix('admin')->group(function () {
    Route::get('login', [AdminController::class, 'loginForm'])->name('login.form');
    Route::post('login/post', [AdminController::class, 'login'])->name('admin.login');
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('admin');
    Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::post('savings/deposit', [AdminController::class, 'savingsDeposit'])->name('savings.deposit');
    Route::post('loan/create', [AdminController::class, 'loanCreate'])->name('loan.create');
});

// -------------- End Admin routes ..................

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [SavingController::class, 'index'])->name('dashboard');
    Route::post('/create', [SavingController::class, 'store'])->name('dash');
    Route::post('/update/{id}', [SavingController::class, 'edit'])->name('update');
    Route::post('/trans', [SavingController::class, 'trans'])->name('trans');
    Route::get('/savings/edit/{id}', [SavingController::class, 'savingsEdit'])->name('savings.edit');
});
