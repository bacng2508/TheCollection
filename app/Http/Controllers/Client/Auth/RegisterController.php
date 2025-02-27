<?php

namespace App\Http\Controllers\Client\Auth;

use App\Models\User;
use App\Jobs\WelcomeClient;
use Illuminate\Http\Request;
use App\Events\UserRegistered;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create() {
        return view('client.auth.register');
    }

    public function store(Request $request) {
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

        // WelcomeClient::dispatch(['email' => $user->email, 'name' => $user->name])->delay(now()->addSecond(5));
        // broadcast(new UserRegistered($user))->toOthers();
        // event(new Registered($user));
        // event(new UserRegistered($user));
        // broadcast(new UserRegistered($user))->toOthers();
        UserRegistered::dispatch($user);
        // Auth::login($user);

        // Breeze
        // return redirect(RouteServiceProvider::HOME);
        return redirect('/login')->with('success', 'Tài khoản đã được đăng ký thành công');
    }
}
