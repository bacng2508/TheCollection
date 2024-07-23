<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\ForgotPassword;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function create() {
        return view('client.auth.forgot-password');
    }

    public function store(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ],
        [
            'email.required' => 'Không được để trống email',
            'email.email' => 'Email không hợp lệ',
            'email.exists' => 'Email chưa được đăng ký'
        ]);
        
        $token = Str::random(64);

        $checkAvailable = DB::table('password_reset_tokens')->where('email', $request->email)->exists();

        if ($checkAvailable) {
            DB::table('password_reset_tokens')->where('email', $request->email)->update([
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
        } else {
            DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        }

    
        $resetInfo = [
            'role' => 'client',
            'email' => $request->email,
            'token' => $token,
        ];

        ForgotPassword::dispatch($resetInfo)->delay(now()->addSecond(5));

        // SendEmail::dispatch($order)->delay(now()->addSecond(10));

        return back()->with('msg', 'Chúng tôi đã gửi link cập nhật mật khẩu, vui lòng kiểm tra email');
    }

    public function resetPassword(Request $request) {
        return view('client.auth.reset-password');
    }

    public function postResetPassword(Request $request) {
        $request->validate(
            [
                'password' => 'required|min:8|confirmed',
            ],
            [
                'password.required' => 'Không được để trống mật khẩu mới',
                'password.min' => 'Mật khẩu phải có tối thiểu 8 ký tự',
                'password.confirmed' => 'Mật khẩu nhập lại không khớp',
                'password_confirmation.confirmed' => 'Mật khẩu nhập lại không khớp',
            ]
        );  

        $checkValidResetRequest = DB::table('password_reset_tokens')
            ->where('email', urldecode($request->email))
            ->exists();
            

        if (!$checkValidResetRequest) {
            return back()->with('error', 'Yêu cầu không hợp lệ');
        }

        User::where("email", $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_reset_tokens')
        ->where('email', urldecode($request->email))
        ->where('token', $request->token)
        ->delete();

        return redirect()->route('login')->with('success', "Cập nhật mật khẩu thành công");


    }
}
