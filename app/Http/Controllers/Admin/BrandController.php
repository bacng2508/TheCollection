<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index(Request $request) {
        $this->authorize('list-brand');
        $brands = Brand::query()
            ->searchBrand($request)
            ->latest()
            ->paginate(10)
            ->withQueryString();
        return view('admin.brands.index', compact('brands'));
    }

    public function create() {
        $this->authorize('add-brand');
        return view('admin.brands.create');
    }

    public function store(Request $request) {
        $this->authorize('add-brand');
        $request->validate(
            [
                'name' => 'required|unique:brands,name',
                'slug' => 'required',
                'logo' => 'required|image'
            ],
            [
                'name.required' => 'Không được để trống tên thương hiệu',
                'name.unique' => 'Danh mục đã tồn tại, vui lòng nhập tên khác',
                'slug.required' => 'Không được để trống slug',
                'logo.required' => 'Phải upload ảnh logo',
                'logo.image' => 'Không đúng định dạng ảnh'
            ]
        );

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo')->store('upload/brands','public');
        }

        Brand::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'logo' => $logo
        ]);

        return redirect()->route('admin.brands.index')->with('msg', 'Thêm thương hiệu thành công');
    }

    public function edit(Brand $brand) {
        $this->authorize('edit-brand');
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Brand $brand, Request $request) {
        $this->authorize('edit-brand');
        $request->validate(
            [
                'name' => "required|unique:brands,name,$brand->id",
                'slug' => 'required',
                'logo' => 'nullable|image'
            ],
            [
                'name.required' => 'Không được để trống tên danh mục',
                'name.unique' => 'Danh mục đã tồn tại, vui lòng nhập tên khác',
                'slug.required' => 'Không được để trống slug',
                'logo.image' => 'Không đúng định dạng ảnh'
            ]
        );

        $formFields = [
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
        ];

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo')->store('upload/brands','public');
            $formFields['logo'] = $logo;
        }

        $brand->update($formFields);

        return back()->with('msg', 'Cập nhật thương hiệu thành công');
    }

    public function destroy(Brand $brand) {
        $this->authorize('delete-brand');
        $brand->delete();
        return redirect()->route('admin.brands.index')->with('msg', 'Xóa thương hiệu thành công');
    }
}
