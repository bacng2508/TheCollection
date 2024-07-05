<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;

class AttributeController extends Controller
{
    public function index(Request $request) {
        $this->authorize('list-attribute');
        $attributes = Attribute::query()->searchAttribute($request)->paginate(10)->withQueryString();
        
        return view('admin.attributes.index', compact('attributes'));
    }

    public function create() {
        $this->authorize('add-attribute');
        return view('admin.attributes.create');
    }

    public function store(Request $request) {
        $this->authorize('add-attribute');
        $request->validate(
            [
                'name' => 'required|unique:attributes,name',
                'slug' => 'required'
            ],
            [
                'name.required' => 'Không được để trống tên thuộc tính',
                'name.unique' => 'Thuộc tính đã tồn tại, vui lòng nhập tên khác',
                'slug.required' => 'Không được để trống slug'
            ]
        );

        Attribute::create([
            'name' => $request->input('name'),
            'slug' => $request->input('slug')
        ]);

        return redirect()->route('admin.attributes.index')->with('msg', 'Thêm thuộc tính thành công');
    }

    public function edit(Attribute $attribute) {
        $this->authorize('edit-attribute');
        return view('admin.attributes.edit', compact('attribute'));
    }

    public function update(Attribute $attribute, Request $request) {
        $this->authorize('edit-attribute');
        $request->validate(
            [
                'name' => "required|unique:attributes,name,$attribute->id",
                'slug' => 'required'
            ],
            [
                'name.required' => 'Không được để trống tên thuộc tính',
                'name.unique' => 'Thuộc tính đã tồn tại, vui lòng nhập tên khác',
                'slug.required' => 'Không được để trống slug'
            ]
        );

        $attribute->update([
            'name' => $request->input('name'),
            'slug' => $request->input('slug')
        ]);

        return back()->with('msg', 'Cập nhật thuộc tính thành công');
    }

    public function destroy(Attribute $attribute) {
        $this->authorize('delete-attribute');
        $attribute->delete();
        return redirect()->route('admin.attributes.index')->with('msg', 'Xóa thuộc tính thành công');
    }


}
