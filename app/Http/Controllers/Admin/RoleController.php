<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Permission;
use App\Models\PermissionGroup;
use App\Models\Role;

class RoleController extends Controller
{
    public function index() {
        $this->authorize('list-role');
        $roles = Role::paginate(10);;
        return view('admin.roles.index', compact('roles'));
    }

    public function create() {
        $this->authorize('add-role');
        return view('admin.roles.create');
    }

    public function store(Request $request) {
        $this->authorize('add-role');
        $request->validate(
            [
                'name' => 'required|unique:roles,name',
                'display_name' => 'required|unique:roles,display_name'
            ],
            [
                'name.required' => 'Không được để trống tên role',
                'name.unique' => 'Tên role đã tồn tại, vui lòng nhập tên khác',
                'display_name.required' => 'Không được để trống tên hiển thị',
                'display_name.unique' => 'Tên hiển thị đã tồn tại, vui lòng nhập tên khác',
            ]
        );

        Role::create([
            'name' => $request->input('name'),
            'display_name' => $request->input('display_name')
        ]);

        return redirect()->route('admin.roles.index')->with('msg', 'Thêm Role thành công');
    }

    public function edit(Role $role) {
        $this->authorize('edit-role');
        return view('admin.roles.edit', compact('role'));
    }

    public function update(Role $role, Request $request) {
        $this->authorize('edit-role');
        $request->validate(
            [
                'name' => "required|unique:roles,name,$role->id",
                'display_name' => "required|unique:roles,display_name,$role->id"
            ],
            [
                'name.required' => 'Không được để trống tên role',
                'name.unique' => 'Tên role đã tồn tại, vui lòng nhập tên khác',
                'display_name.required' => 'Không được để trống tên hiển thị',
                'display_name.unique' => 'Tên hiển thị đã tồn tại, vui lòng nhập tên khác',
            ]
        );

        $role->update([
            'name' => $request->input('name'),
            'display_name' => $request->input('display_name')
        ]);

        return back()->with('msg', 'Cập nhật role thành công');
    }

    public function destroy(Role $role) {
        $this->authorize('delete-role');
        $role->delete();
        return redirect()->route('admin.roles.index')->with('msg', 'Xóa Role thành công');
    }

    public function authorization(Role $role) {
        $permissionGroups = PermissionGroup::all();
        $permissions = Permission::all();
        $permissionChecked = $role->permissions;
        return view('admin.roles.authorization', compact('role', 'permissionGroups', 'permissions', 'permissionChecked'));
    }

    public function storeAuthorization(Request $request, Role $role) {
        $role->permissions()->sync($request->permission_ids);
        return back()->with('msg', 'Cập nhật quyền thành công');
    }
}
