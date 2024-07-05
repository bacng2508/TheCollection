<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // return view('auth.register');
        return view('client.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ],
        [
            'name.required' => 'Không được bỏ trống tên',
            'name.max' => 'Tên không được vượt quá 255 ký tự',
            'email.required' => 'Không được bỏ trống email',
            'email.lowercase' => 'Email không được viết hoa',
            'email.max' => 'Email không được vượt quá 255 ký tự',
            'email.unique' => 'Email đã được sử dụng',
            'password.required' => 'Không được bỏ trống mật khẩu',
            'password.confirmed' => 'Mật khẩu nhập lại không khớp'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => 'upload/client/avatar/default-avatar.png',
        ]);

        event(new Registered($user));

        // Auth::login($user);

        // Breeze
        // return redirect(RouteServiceProvider::HOME);
        return redirect('/login')->with('msg', 'Tài khoản đã được đăng ký thành công');
    }
}
