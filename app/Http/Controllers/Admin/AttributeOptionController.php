<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttributeOption;
use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeOptionController extends Controller
{
    public function index(Request $request) {
        $this->authorize('list-attribute-option');
        $attributeOptions = AttributeOption::query()->searchAttributeOption($request)->paginate(10)->withQueryString();
        $attributes = Attribute::all();
        return view('admin.attributeOptions.index', compact('attributeOptions', 'attributes'));
    }

    public function create() {
        $this->authorize('add-attribute-option');
        $attributes = Attribute::all();
        return view('admin.attributeOptions.create', compact('attributes'));
    }

    public function store(Request $request) {
        $this->authorize('add-attribute-option');
        $request->validate(
            [
                'value' => 'required|unique:attribute_options,value',
                'slug' => 'required',
                'attribute_id' => 'exists:attributes,id'
            ],
            [
                'value.required' => 'Không được để trống giá trị thuộc tính',
                'value.unique' => 'Giá trị thuộc tính đã tồn tại, vui lòng nhập giá trị khác',
                'slug.required' => 'Không được để trống slug',
                'attribute_id.exists' => 'Bạn phải lựa chọn thuộc tính'
            ]
        );

        AttributeOption::create([
            'value' => $request->input('value'),
            'slug' => $request->input('slug'),
            'attribute_id' => $request->input('attribute_id')
        ]);

        return redirect()->route('admin.attributeOptions.index')->with('msg', 'Thêm giá trị thuộc tính thành công');
    }

    public function edit(AttributeOption $attributeOption) {
        $this->authorize('edit-attribute-option');
        $attributes = Attribute::all();
        return view('admin.attributeOptions.edit', compact('attributeOption', 'attributes'));
    }

    public function update(AttributeOption $attributeOption, Request $request) {
        $this->authorize('edit-attribute-option');
        $request->validate(
            [
                'value' => "required|unique:attribute_options,value, $attributeOption->id",
                'slug' => 'required',
                'attribute_id' => 'exists:attributes,id'
            ],
            [
                'value.required' => 'Không được để trống giá trị thuộc tính',
                'value.unique' => 'Giá trị thuộc tính đã tồn tại, vui lòng nhập giá trị khác',
                'slug.required' => 'Không được để trống slug',
                'attribute_id.exists' => 'Bạn phải lựa chọn thuộc tính'
            ]
        );

        $attributeOption->update([
            'value' => $request->input('value'),
            'slug' => $request->input('slug'),
            'attribute_id' => $request->input('attribute_id')
        ]);

        return back()->with('msg', 'Cập nhật giá trị thuộc tính thành công');
    }

    public function destroy(AttributeOption $attributeOption) {
        $this->authorize('delete-attribute-option');
        $attributeOption->delete();
        return redirect()->route('admin.attributeOption.index')->with('msg', 'Xóa giá trị thuộc tính thành công');
    }
}
