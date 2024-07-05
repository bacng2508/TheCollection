<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Administrator;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class AdministratorController extends Controller
{
    public function index(Request $request) {
        $this->authorize('list-administrator');
        $administrators = Administrator::query()
            ->searchAdministrator($request)
            ->paginate(10)
            ->withQueryString();
        return view('admin.administrator.index', compact('administrators'));
    }

    public function create() {
        $this->authorize('add-administrator');
        $roles = Role::all();
        return view('admin.administrator.create', compact('roles'));
    }

    public function store(Request $request) {
        $this->authorize('add-administrator');
        $request->validate(
            [
                'name' => 'required',
                'avatar' => 'nullable|image|max:2000',
                'email' => 'required|email|unique:administrators,email',
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required',
                'tel' => 'nullable|regex:/(09)[0-9]{8}/',
                'role_id' => 'required',
                'role_id.*' => ['required', Rule::exists('roles', 'id')],
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
                'role_id.required' => 'Phải lựa chọn role cho quản trị viên',
                'role_id.*.exists' => 'Role không hợp lệ'
            ]
        );

        // Upload file
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('upload/administrator/avatar','public');
        }

        $administrator = Administrator::create([
            'name' => $request->name,
            'avatar' => $avatarPath ?? 'upload/administrator/avatar/default-avatar.png',
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tel' => $request->tel,
        ]);

        $administrator->roles()->attach($request->role_id);

        return redirect()->route('admin.administrators.index')->with('msg', 'Thêm quản trị viên thành công');
    }

    public function edit(Administrator $administrator) {
        $this->authorize('edit-administrator');
        $roles = Role::all();
        return view('admin.administrator.edit', compact('administrator', 'roles'));
    }

    public function update(Administrator $administrator, Request $request) {
        $this->authorize('edit-administrator');
        $request->validate(
            [
                'name' => 'required',
                'avatar' => 'nullable|image|max:2000',
                'password' => 'nullable|min:8|confirmed',
                'tel' => 'nullable|regex:/(09)[0-9]{8}/',
                'role_id' => 'required',
                'role_id.*' => ['required', Rule::exists('roles', 'id')],
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
                'role_id.required' => 'Phải lựa chọn role cho quản trị viên',
                'role_id.*.exists' => 'Role không hợp lệ'
            ]
        );

        if ($request->hasFile('avatar')) {
            Storage::disk('public')->delete($administrator->avatar);
            $avatarPath = $request->file('avatar')->store('upload/administrator/avatar','public');
        }

        $administrator::updated([
            'name' => $request->name,
            'avatar' => $avatarPath ?? 'upload/administrator/avatar/default-avatar.png',
            'password' => Hash::make($request->password),
            'tel' => $request->tel,
        ]);

        $administrator->roles()->sync($request->role_id);

        return back()->with('msg', 'Cập nhật quản trị viên thành công');
    }

    public function destroy(Administrator $administrator) {
        $this->authorize('delete-administrator');
        $administrator->roles()->detach();

        if ($administrator->avatar != 'upload/administrator/avatar/default-avatar.png') {
            Storage::disk('public')->delete($administrator->avatar); 
        }

        $administrator->delete();
        return redirect()->route('admin.administrators.index')->with('msg', 'Xóa quản trị viên thành công');
    }

    public function updateStatus(Request $request) {
        $this->authorize('status-administrator');
        $administrator = Administrator::find($request->administratorId);
        $administrator->update([
            'status' => $request->administratorStatus
        ]);

        return true;
    }
}
