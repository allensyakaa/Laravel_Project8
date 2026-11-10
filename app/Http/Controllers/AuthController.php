<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(string $role): View
    {
        return view('auth.login', ['role' => $role]);
    }

    public function login(Request $request, string $role): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Login hanya berhasil kalau role akun cocok dengan halaman login yang dipakai
        $attempt = Auth::attempt(
            [...$credentials, 'role' => $role],
            $request->boolean('remember')
        );

        if (! $attempt) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Email atau password salah, atau akun ini bukan akun '.$role.'.']);
        }

        $request->session()->regenerate();

        return redirect()->route(Auth::user()->dashboardRoute());
    }

    public function showRegister(): View
    {
        return view('auth.register');
    }

    // Hanya pelanggan yang boleh daftar sendiri. Kasir & owner dibuat lewat seeder / owner.
    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = new User($data);
        $user->role = User::ROLE_PELANGGAN;
        $user->save();

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route($user->dashboardRoute());
    }

    public function logout(Request $request): RedirectResponse
    {
        $role = $request->user()?->role ?? User::ROLE_PELANGGAN;

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login', $role);
    }
}
