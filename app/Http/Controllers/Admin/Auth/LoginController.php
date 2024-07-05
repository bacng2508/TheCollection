<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create() {
        return view('admin.auth.login');
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

        $check = $request->all();
        $data = [
            'email' => $check['email'],
            'password' => $check['password']
        ];

        if (Auth::guard('administrator')->attempt($data)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard.index');
        } else {
            return redirect()->back()->withInput()->with('msg', 'Email hoặc mật khẩu không chính xác');
        }
    }

    public function destroy(Request $request) {
        Auth::guard('administrator')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
