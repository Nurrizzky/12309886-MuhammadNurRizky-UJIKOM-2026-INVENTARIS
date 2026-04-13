<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin() {
        return view('login');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Wajib diisi!',
            'email.email' => 'Format email salah!',
            'password.required' => 'Wajib diisi!',
        ]);

        // $credentials = $request->only('email', 'password');

        // if (Auth::attempt($credentials)) {
        //     if (Auth::user()->role == 'admin') {
        //         return redirect()->route('admin.categories.index')->with('success', 'Berhasil Login');
        //     } else {
        //         return redirect()->route('staff.items')->with('success', 'Berhasil Login');
        //     }
        // } else {
        //     return redirect()->back()->with('failed', 'Gagal login');
        // }

        // agak bisa export password tidak ke hash
        $user = User::where('email', $request->email)->where('password', $request->password)->first();

        if ($user) {
            Auth::login($user);

            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.categories.index')->with('success', 'Berhasil Login');
            } else {
                return redirect()->route('staff.items')->with('success', 'Berhasil Login');
            }
        } else {
            return redirect()->back()->with('failed', 'Gagal login');
        }
    }

    public function logout() {
        $proses = Auth::logout();

        if ($proses) {
            return redirect()->route('landing')->with('success', 'Berhasil logout');
        } else {
            return redirect()->back()->with('failed', 'Gagal logout');
        }
    }
}
