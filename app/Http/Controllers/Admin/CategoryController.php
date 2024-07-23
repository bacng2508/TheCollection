<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{
    public function index(Request $request) {
        $this->authorize('list-category');
        
        $categories = Category::query()
            ->searchCategory($request)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.categories.index', compact('categories'));
    }

    public function create() {
        $this->authorize('add-category');
        return view('admin.categories.create');
    }

    public function store(Request $request) {
        $this->authorize('add-category');
        $request->validate(
            [
                'name' => 'required|unique:categories,name',
                'slug' => 'required'
            ],
            [
                'name.required' => 'Không được để trống tên danh mục',
                'name.unique' => 'Danh mục đã tồn tại, vui lòng nhập tên khác',
                'slug.required' => 'Không được để trống slug'
            ]
        );

        Category::create([
            'name' => $request->input('name'),
            'slug' => $request->input('slug')
        ]);

        return redirect()->route('admin.categories.index')->with('msg', 'Thêm danh mục thành công');
    }

    public function edit(Category $category) {
        $this->authorize('edit-category');
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Category $category, Request $request) {
        $this->authorize('edit-category');
        $request->validate(
            [
                'name' => "required|unique:categories,name,$category->id",
                'slug' => 'required'
            ],
            [
                'name.required' => 'Không được để trống tên danh mục',
                'name.unique' => 'Danh mục đã tồn tại, vui lòng nhập tên khác',
                'slug.required' => 'Không được để trống slug'
            ]
        );

        $category->update([
            'name' => $request->input('name'),
            'slug' => $request->input('slug')
        ]);

        return back()->with('msg', 'Cập nhật danh mục thành công');
    }

    public function destroy(Category $category) {
        $this->authorize('delete-category');
        $category->delete();
        return redirect()->route('admin.categories.index')->with('msg', 'Xóa danh mục thành công');
    }
}
