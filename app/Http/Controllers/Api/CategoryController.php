<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $arr = [
            'data' => CategoryResource::collection($categories)
        ];
        return response()->json($arr, 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|unique',
        ]);

        if ($validator->fails()) {
            $arr = [
                'success' => false,
                'message' => 'Lỗi kiểm tra dữ dữ liệu',
                'data' => $validator->errors()
            ];
            return response()->json($arr, 200);
        }

        $category = Category::create($input);
        $arr = [
            'status' => true,
            'message' => 'Thêm danh mục thành công',
            'data' => new CategoryResource($category),        
        ];
        return response()->json($arr, 201);
    }

    // public function show($id)
    // {
    //     $product = Product::find($id);
    //     if (is_null($product)) {
    //         $arr = [
    //             'success' => false,
    //             'message' => 'Không có sản phẩm này',
    //             'data' => []
    //         ];
    //         return response()->json($arr, 200);
    //     }
    //     $arr = [
    //         'status' => true,
    //         'message' => 'Chi tiết sản phẩm',
    //         'data' => new ProductRecource($product),
    //     ];
    //     return response()->json($arr, 201);
    // }

    // public function edit(string $id)
    // {
    //     //
    // }

    // public function update(Request $request, Product $product)
    // {
    //     $input = $request->all();
    //     $validator = Validator::make($input, [
    //         'ten_sp' => 'required',
    //         'gia' => 'required'
    //     ]);

    //     if ($validator->fails()) {
    //         $arr = [
    //             'success' => false,
    //             'message' => 'Lỗi kiểm tra dữ dữ liệu',
    //             'data' => $validator->errors()
    //         ];
    //         return response()->json($arr, 200);
    //     }

    //     $product->ten_sp = $input['ten_sp'];
    //     $product->gia = $input['gia'];
    //     $product->save();
    //     $arr = [
    //         'status' => true,
    //         'message' => 'Sản phẩm cập nhật thành công',
    //         'data' => new ProductRecource($product),        
    //     ];
    //     return response()->json($arr, 201);
    // }

    // public function destroy(Product $product)
    // {
    //     $product->delete();
    //     $arr = [
    //         'status' => true,
    //         'message' => 'Sản phẩm đã được xóa',
    //         'data' => [],
    //     ];
    //     return response()->json($arr, 200);
    // }
}
