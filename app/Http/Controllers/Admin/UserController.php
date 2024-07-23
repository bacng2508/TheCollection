<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;

class UserController extends Controller
{
    public function index(Request $request) {
        $this->authorize('list-client');
        $users = User::query()
            ->searchUser($request)
            ->orderBy('name', 'asc')
            ->paginate(10)
            ->withQueryString();
        return view('admin.users.index', compact('users'));
    }

    public function create() {
        $this->authorize('add-client');
        return view('admin.users.create');
    }

    public function store(Request $request) {
        $this->authorize('add-client');
        $request->validate(
            [
                'name' => 'required',
                'avatar' => 'nullable|image|max:2000',
                'email' => 'required|email|unique:administrators,email',
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required',
                'tel' => 'nullable|regex:/(09)[0-9]{8}/',
            ],
            [
                'name.required' => 'Không được để trống tên',
                'avatar.image' => 'File tải lên phải là ảnh',
                'avatar.max' => 'Dung lượng File tải lên không được vượt quá 2MB',
                'email.required' => 'Không được để trống email',
                'email.email' => 'Email không đúng định dạng',
                'email.unique' => 'Email đã được sử dụng với tài khoản khác',
                'password.required' => 'Không được để trống mật khẩu',
                'password.min' => 'Mật khẩu phải có tối thiểu 8 ký tự',
                'password.confirmed' => 'Mật khẩu nhập lại không khớp',
                'password_confirmation.required' => 'Không được để trống nhập lại mật khẩu',
                // 'password_confirmation.confirmed' => 'Mật khẩu nhập lại không khớp',
                'tel.regex' => 'Số điện thoại không hợp lệ',
                'display_name.required' => 'Không được để trống tên hiển thị',
                'display_name.unique' => 'Tên hiển thị đã tồn tại, vui lòng nhập tên khác',
            ]
        );

        // Upload file
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('upload/client/avatar','public');
        }

        User::create([
            'name' => $request->name,
            'avatar' => $avatarPath ?? 'upload/client/avatar/default-avatar.png',
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tel' => $request->tel,
        ]);

        return redirect()->route('admin.users.index')->with('msg', 'Thêm quản khách hàng thành công');
    }

    public function edit(User $user) {
        $this->authorize('edit-client');
        return view('admin.users.edit', compact('user'));
    }

    public function update(User $user, Request $request) {
        $this->authorize('edit-client');
        $request->validate(
            [
                'name' => 'required',
                'avatar' => 'nullable|image|max:2000',
                'password' => 'nullable|min:8|confirmed',
                'tel' => 'nullable|regex:/(09)[0-9]{8}/',
            ],
            [
                'name.required' => 'Không được để trống tên',
                'avatar.image' => 'File tải lên phải là ảnh',
                'avatar.max' => 'Dung lượng File tải lên không được vượt quá 2MB',
                'password.min' => 'Mật khẩu phải có tối thiểu 8 ký tự',
                'password.confirmed' => 'Mật khẩu nhập lại không khớp',
                // 'password_confirmation.confirmed' => 'Mật khẩu nhập lại không khớp',
                'tel.regex' => 'Số điện thoại không hợp lệ',
                'display_name.required' => 'Không được để trống tên hiển thị',
                'display_name.unique' => 'Tên hiển thị đã tồn tại, vui lòng nhập tên khác',
            ]
        );

        if ($request->hasFile('avatar')) {
            Storage::disk('public')->delete($user->avatar);
            $avatarPath = $request->file('avatar')->store('upload/client/avatar','public');
        }

        $user->update([
            'name' => $request->name,
            'avatar' => $avatarPath ?? 'upload/client/avatar/default-avatar.png',
            'password' => Hash::make($request->password),
            'tel' => $request->tel,
        ]);

        return back()->with('msg', 'Cập nhật khách hàng thành công');
    }

    public function destroy(User $user) {
        $this->authorize('delete-client');
        if ($user->avatar != 'upload/client/avatar/default-avatar.png') {
            Storage::disk('public')->delete($user->avatar); 
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('msg', 'Xóa khách hàng thành công');
    }

    public function updateStatus(Request $request) {
        $user = User::find($request->userId);
        $user->update([
            'status' => $request->userStatus
        ]);

        return true;
    }

    public function export() {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function import() {
        Excel::import(new UsersImport, 'users.xlsx');
        
        return redirect()->back()->with('msg', 'Nhập dữ liệu thành công');
    }
}
