<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    function tampilRegistrasi()
    {
        return view('auth.registrasi');
    }
    function submitRegistrasi(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|confirmed'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        //dd($user);
        //session()->flash('success', 'Registrasi berhasli!, silahkan login.');
        return redirect()->route('login.tampil');
    }

    function tampilLogin()
    {
        return view('auth.login');
    }
    function submitLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $data = $request->only('email', 'password');
        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            //session()->flash('success','Login Berhasil! Selamat Datang :)');
            return redirect()->route('tampil.dashboard');
        } else {
            return redirect()->back()->with('error', 'Email atau Password anda salah. Login Gagal');
        }
    }
    function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.tampil');
    }
}
