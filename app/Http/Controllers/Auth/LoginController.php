<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // ===== SISWA =====

    public function showSiswaLogin()
    {
        return view('auth.login-siswa');
    }

    public function siswaLogin(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|string',
        ]);

        $siswa = \App\Models\Siswa::find($validated['nis']);

        if (! $siswa) {
            return back()->withErrors(['nis' => 'NIS tidak ditemukan.'])->onlyInput('nis');
        }

        Auth::guard('siswa')->login($siswa);
        $request->session()->regenerate();
        return redirect()->intended(route('siswa.dashboard'));
    }

    public function siswaLogout(Request $request)
    {
        Auth::guard('siswa')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('siswa.login');
    }

    // ===== ADMIN =====

    public function showAdminLogin()
    {
        return view('auth.login-admin');
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
