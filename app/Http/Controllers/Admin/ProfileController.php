<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit() {
        return view('admin.profile.index');
    }

    public function update(Request $request) {
        $administrator = Administrator::find(Auth::guard('administrator')->user()->id);
        
        $request->validate(
            [
                'avatar' => 'nullable|image|max:2000',
                'name' => 'required',
                'tel' => 'required|regex:/(09)[0-9]{8}/',
            ],
            [
                'avatar.image' => 'File tải lên phải là ảnh',
                'avatar.max' => 'Dung lượng File tải lên không được vượt quá 5MB',
                'name.required' => 'Không được để trống tên',
                'tel.required' => 'Không được để trống số điện thoại',
                'tel.regex' => 'Số điện thoại không hợp lệ',
            ]
        );

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('upload/administrator/avatar','public');
        }

        $administrator->update([
            'name' => $request->name,
            'avatar' => $avatarPath ?? 'upload/administrator/avatar/default-avatar.png',
            'tel' => $request->tel,
        ]);

        return back()->with('msg', 'Cật nhật thông tin thành công');
    }

    public function updatePassword(Request $request) {
        $administrator = Administrator::find(Auth::guard('administrator')->user()->id);
        
        $request->validate(
            [
                'old_password' => 'required',
                'new_password' => 'required|min:8|confirmed',
            ],
            [
                'old_password.required' => 'Không được để trống mật khẩu',
                'new_password.required' => 'Không được để trống mật khẩu mới',
                'new_password.min' => 'Mật khẩu phải có tối thiểu 8 ký tự',
                'new_password.confirmed' => 'Mật khẩu nhập lại không khớp',
                'new_password_confirmation.confirmed' => 'Mật khẩu nhập lại không khớp',
            ]
        );

        if(!Hash::check($request->old_password, $administrator->password)){
            return back()->with("msg", "Old Password Doesn't match!");
        }

        $administrator->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('msg', 'Đổi mật khẩu thành công');
    }
}
