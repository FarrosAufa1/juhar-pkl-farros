<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class SiswaLoginController extends Controller
{
    public function login()
    {
        return view('auth.siswa_login');
    }

    public function auth(Request $request)
    {
        $credintials = $request->validate([
            'nisn' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('siswa')->attempt($credintials)) {
            return redirect()->route('siswa.dashboard');
        }

        return back()->withErrors(['login_error', 'NISN atau Password salah'])->onlyInput('nisn');
    }
}
