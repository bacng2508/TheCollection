<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request) {
        $this->authorize('list-product');
        $categories = Category::all();

        $products = Product::query()
            ->searchProduct($request)
            ->paginate(10)
            ->withQueryString();
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create() {
        $this->authorize('add-product');
        $attributes = Attribute::all();
        $attributeOptions = AttributeOption::all();
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.products.create', compact('attributes', 'attributeOptions', 'brands', 'categories'));
    }

    public function store(Request $request) {
        $this->authorize('add-product');

        $attributes = Attribute::all();
        $attribute_rules = array();
        $attribute_messages = array();

        foreach($attributes as $attribute) {
            $rules = "required";
            foreach($attribute->attributeOptions as $option) {
                // $attribute_messages = array( "product_attribute_$attribute->id.in" => "Phải lựa chọn $attribute->name");
                // $rules .= "$option->id,";
            }
            $rules = rtrim($rules, ",");
            $attribute_rules["product_attribute_$attribute->id"] = $rules;

            $attribute_messages["product_attribute_$attribute->id.required"] = "Phải lựa chọn $attribute->name";
        }

        $validateRules = array_merge([
            'name' => 'required|unique:products,name',
            'slug' => 'required|unique:products,slug',
            'thumbnail' => 'required|image|max:2000',
            // 'image' => ['required', 'image', File::image()->smallerThan(20000)],
            'images' => 'required',
            'images.*' => 'image|max:2000',
            'price' => 'required|integer|min:1',
            'description' => 'required',
            'brand_id' => 'required',
            'category_id' => 'required',
            'quantity' => 'required|integer|min:0'
        ], $attribute_rules);

        $validateMessages = array_merge([
            'name.required' => 'Không được để trống tên danh mục',
            'name.unique' => 'Tên sản phẩm đã tồn tại, vui lòng nhập tên khác',
            'slug.required' => 'Không được để trống slug',
            'slug.unique' => 'Slug đã tồn tại, vui lòng nhập tên khác',
            'thumbnail.required' => 'Không được để trống ảnh đại diện',
            'thumbnail.image' => 'Ảnh không đúng định dạng',
            'thumbnail.max' => 'Dung lượng ảnh không được vượt quá 2MB',
            'images.required' => 'Không được để trống ảnh sản phẩm',
            // 'images.image' => 'Ảnh không đúng định dạng',
            // 'images.size' => 'Dung lượng ảnh không được vượt quá 2MB',
            'images.*.image' => 'Ảnh sản phẩm không đúng định dạng',
            'images.*.max' => 'Dung lượng ảnh không được vượt quá 2MB',
            'price.required' => 'Không được để trống giá',
            'price.integer' => 'Giá phải là số',
            'price.min' => 'Giá phải lớn hơn 0',
            'price.required' => 'Không được để trống giá',
            'description.required' => 'Không được để trống mô tả sản phẩm',
            'brand_id.required' => 'Phải lựa chọn thương hiệu',
            'category_id.required' => 'Phải lựa chọn danh mục',
            'quantity.required' => 'Không được để trống số lượng sản phẩm',
            'quantity.integer' => 'Số lượng phải là số',
            'quantity.min' => 'Số lượng phải lớn hơn hoặc bằng 0'
        ],$attribute_messages);

        $request->validate(
            $validateRules,
            $validateMessages
        );
        
        // Upload file
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('upload/product/thumbnails','public');
        }

        if ($request->hasFile('images')) {
            foreach($request->images as $image) {
                $imagesPath[] = $image->store('upload/product/images','public');
            }
        }

        $product = new Product();

        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->thumbnail = $thumbnailPath;
        $product->price = $request->price;
        $product->price_sale = $request->price_sale ?? 0;
        $product->description = $request->description;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->quantity = $request->quantity;
        $product->save();

        // Insert Product Images
        foreach($imagesPath as $image) {
            $productImage = new ProductImage();
            $productImage->product_id = $product->id;
            $productImage->image = $image;
            $productImage->save();
        }


        // Insert Attribute
        foreach($attributes as $attribute) {
            $productAttribute = new ProductAttribute();
            $productAttribute->product_id = $product->id;
            $productAttribute->attribute_option_id = $request->input('product_attribute_'.$attribute->id);
            $productAttribute->save();
        }

        return redirect()->route('admin.products.index')->with('msg', 'Thêm sản phẩm thành công');
    }

    public function edit(Product $product) {
        $this->authorize('edit-product');
        $attributes = Attribute::all();
        $attributeOptions = AttributeOption::all();
        $productAttributeOptions = ProductAttribute::where('product_id', $product->id)->get();
        $productImages = ProductImage::where('product_id', $product->id)->get();
        $brands = Brand::all();
        $categories = Category::all();

        return view('admin.products.edit', compact('attributes', 'attributeOptions', 'brands', 'categories', 'product', 'productImages', 'productAttributeOptions'));

    }

    public function update(Product $product, Request $request) {
        $this->authorize('edit-product');
        $attributes = Attribute::all();
        $attribute_rules = array();
        $attribute_messages = array();
        

        foreach($attributes as $attribute) {
            $rules = "required";
            
            $rules = rtrim($rules, ",");
            $attribute_rules["product_attribute_$attribute->id"] = $rules;

            $attribute_messages["product_attribute_$attribute->id.required"] = "Phải lựa chọn $attribute->name";
        }

        $validateRules = array_merge([
            'name' => "required|unique:products,name,$product->id",
            'slug' => "required|unique:products,slug,$product->id",
            'thumbnail' => 'image|max:2000',
            'images.*' => 'image|max:2000',
            'price' => 'required|integer|min:1',
            'description' => 'required',
            'brand_id' => 'required',
            'category_id' => 'required',
            'quantity' => 'required|integer|min:0'
        ], $attribute_rules);

        $validateMessages = array_merge([
            'name.required' => 'Không được để trống tên danh mục',
            'name.unique' => 'Tên sản phẩm đã tồn tại, vui lòng nhập tên khác',
            'slug.required' => 'Không được để trống slug',
            'slug.unique' => 'Slug đã tồn tại, vui lòng nhập tên khác',
            'thumbnail.image' => 'Ảnh không đúng định dạng',
            'thumbnail.max' => 'Dung lượng ảnh không được vượt quá 2MB',
            'images.*.image' => 'Ảnh sản phẩm không đúng định dạng',
            'images.*.max' => 'Dung lượng ảnh không được vượt quá 2MB',
            'price.required' => 'Không được để trống giá',
            'price.integer' => 'Giá phải là số',
            'price.min' => 'Giá phải lớn hơn 0',
            'price.required' => 'Không được để trống giá',
            'description.required' => 'Không được để trống mô tả sản phẩm',
            'brand_id.required' => 'Phải lựa chọn thương hiệu',
            'category_id.required' => 'Phải lựa chọn danh mục',
            'quantity.required' => 'Không được để trống số lượng sản phẩm',
            'quantity.integer' => 'Số lượng phải là số',
            'quantity.min' => 'Số lượng phải lớn hơn hoặc bằng 0'
        ],$attribute_messages);

        $request->validate(
            $validateRules,
            $validateMessages
        );
        
        // Upload file
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('upload/product/thumbnails','public');
            $product->thumbnail = $thumbnailPath;
        }

        if ($request->hasFile('images')) {
            foreach($request->images as $image) {
                $imagesPath[] = $image->store('upload/product/images','public');
            }
            // Insert Product Images
            foreach($imagesPath as $image) {
                $productImage = new ProductImage();
                $productImage->product_id = $product->id;
                $productImage->image = $image;
                $productImage->save();
            }
        }

        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->price = $request->price;

        $product->price_sale = $request->price_sale ?? 0;
        $product->description = $request->description;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->quantity = $request->quantity;
        $product->save();

    
        // Insert Attribute
        foreach($attributes as $attribute) {
            $productAttribute = new ProductAttribute();
            $productAttribute->product_id = $product->id;
            $productAttribute->attribute_option_id = $request->input('product_attribute_'.$attribute->id);
            $productAttribute->save();
        }

        return back()->with('msg', 'Sửa sản phẩm thành công');
    }

    public function destroy(Product $product) {
        $this->authorize('delete-product');
        // Delete product_images from server
        $productImages = ProductImage::where('product_id', $product->id)->get();
        foreach ($productImages as $productImage) {
            Storage::disk('public')->delete($productImage->image);
        }

        // Delete product thumbnail from server
        Storage::disk('public')->delete($product->thumbnail);      
        
        // Delete Product Image & Product Attribute of Product form DB
        ProductImage::where('product_id', $product->id)->delete();
        ProductAttribute::where('product_id', $product->id)->delete();

        // Delete product
        $product->delete();

        return redirect()->route('admin.products.index')->with('msg', 'Xóa sản phẩm thành công');
    }

    public function updateFeatureStatus(Request $request) {
        $product = Product::find($request->productId);
        $product->update([
            'is_featured' => $request->isFeatureProduct,
        ]);

        return true;
    }
}
