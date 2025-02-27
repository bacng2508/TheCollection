<?php

namespace App\Http\Controllers\Client\Auth;

use Illuminate\Http\Request;
use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create() {
        return view('client.auth.login');
    }

    public function store(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ],
        [
            'email.required' => 'Không được để trống email',
            'email.email' => 'Email không hợp lệ',
            'password.required' => 'Không được để trống mật khẩu',
        ]);

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $remember = $request->remember ? true : false;

        if (Auth::guard('web')->attempt($data, $remember)) {
            // UserRegistered::dispatch(Auth::user());
            $request->session()->regenerate();
            return redirect()->route('home');
        } else {
            return redirect()->back()->withInput()->with('error', 'Email hoặc mật khẩu không chính xác');
        }
    }

    public function destroy(Request $request) {
        Auth::guard('web')->logout();

        // $request->session()->invalidate();
        // $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
