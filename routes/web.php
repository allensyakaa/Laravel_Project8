<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PelangganController;

// Halaman awal: pilih masuk sebagai siapa
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route(auth()->user()->dashboardRoute())
        : view('home');
})->name('home');

// ---------- Login / register ----------
Route::middleware('guest')->group(function () {
    Route::get('/login/{role}', [AuthController::class, 'showLogin'])
        ->whereIn('role', User::ROLES)->name('login');
    Route::post('/login/{role}', [AuthController::class, 'login'])
        ->whereIn('role', User::ROLES)->name('login.attempt');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// ---------- Dashboard per role ----------
Route::middleware(['auth', 'role:pelanggan'])->prefix('pelanggan')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'pelanggan'])->name('pelanggan.dashboard');
    Route::get('/pesanan/buat', [PesananController::class, 'create'])->name('pelanggan.pesanan.create');
    Route::post('/pesanan', [PesananController::class, 'store'])->name('pelanggan.pesanan.store');
});

Route::middleware(['auth', 'role:kasir'])->prefix('kasir')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'kasir'])->name('kasir.dashboard');
});

Route::middleware(['auth', 'role:owner'])->prefix('owner')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'owner'])->name('owner.dashboard');
});
Route::resource('produk', ProdukController::class)
    ->except('show')
    ->parameters(['produk' => 'product'])
    ->names('owner.produk');
Route::get('/pelanggan', [PelangganController::class, 'index'])->name('owner.pelanggan.index');
Route::get('/pelanggan/{user}', [PelangganController::class, 'show'])->name('owner.pelanggan.show');
Route::patch('/pelanggan/{user}/langganan', [PelangganController::class, 'toggleLangganan'])->name('owner.pelanggan.langganan');
Route::patch('/pesanan/{order}/terima', [PelangganController::class, 'terimaPesanan'])->name('owner.pesanan.terima');

// ---------- Halaman demo bawaan template Dasher ----------
Route::view('/demo', 'dashboard-demo')->name('dashboard');
Route::view('/blank', 'pages.blank')->name('blank');
Route::view('/sign-in', 'auth.sign-in')->name('sign-in');
Route::view('/sign-up', 'auth.sign-up')->name('sign-up');
Route::view('/forget-password', 'auth.forget-password')->name('forget-password');
Route::view('/reset-password', 'auth.reset-password')->name('reset-password');
Route::view('/otp-verification', 'auth.otp-verification')->name('otp-verification');
Route::view('/404-error', 'errors.404-error')->name('404-error');
Route::view('/maintenance', 'errors.maintenance')->name('maintenance');
