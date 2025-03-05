<?php

namespace App\Http\Controllers\Client;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginCallback extends Controller
{
    public function __invoke(Request $request)
    {
        $socialiteProfile = Socialite::driver('google')->user();

        $user = User::where('email', $socialiteProfile->email)->first();
        
        //lấy thông tin username, email, avatar, social_id để lưu vào bảng users (nếu bạn cần thêm thông tin gì thì có thể lấy thêm)
        $data = [
            'name' => $socialiteProfile->name,
            'email' => $socialiteProfile->email,
            'password' => Hash::make(Str::random(10)),
            'avatar' => 'upload/client/avatar/default-avatar.png'
        ];

        $user = User::updateOrCreate(['email' => $socialiteProfile->email], $data);
        
        Auth::login($user, true);

        return redirect()->route('home');;
    }
}
