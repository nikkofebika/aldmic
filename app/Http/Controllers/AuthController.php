<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller {
    public function index() {
        if (session()->get('auth')) {
            return redirect('dashboard/pegawai');
        }
        return view('dashboard.auth.login');
    }

    public function login(Request $request) {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
        if ($request->username == 'admin' && $request->password == 'admin') {
            $request->session()->put('auth', ['username' => 'admin', 'password' => 'admin']);
            return redirect()->intended('dashboard/pegawai');
        }
        return back()->withInput()->with('error','Kombinasi Username dan Password tidak cocok!');
    }

    public function logout() {
        session()->flush();
        return redirect('login');
    }
}
