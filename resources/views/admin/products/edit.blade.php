@extends('admin.layouts.admin_master')

@section('title', 'Sửa sản phẩm')

@push('styles')
    <style>
        .ck-editor__editable {
            min-height: 200px;
        }
    </style>
@endpush


@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if (session()->has('msg'))
                                <p class="alert alert-success text-center py-2">Cập nhật sản phẩm thành công</p>
                            @endif

                            @if ($errors->any())
                                <p class="alert alert-danger text-center">Đã có lỗi xảy ra, vui lòng kiểm tra lại dữ liệu nhập vào</p>
                            @endif

                            

                            <form class="" method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" >
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Tên sản phẩm</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{ $product->name }}" placeholder="Nhập tên sản phẩm">
                                    @error('name')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control" name="slug" id="slug"
                                        value="{{ $product->slug }}" placeholder="Slug">
                                    @error('slug')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="thumbnail">Ảnh đại diện</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="thumbnail" name="thumbnail">
                                            <label class="custom-file-label" for="thumbnail">Chọn ảnh</label>
                                        </div>
                                    </div>
                                    @error('thumbnail')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="mt-3">
                                        <img src="{{ asset('storage/'.$product->thumbnail)}}" width="200px;" alt="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="images">Ảnh sản phẩm</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="images" name="images[]" multiple>
                                            <label class="custom-file-label" for="images">Chọn ảnh</label>
                                        </div>
                                    </div>
                                    @error('images')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                    @error('images.*')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="mt-3">
                                        @foreach ($productImages as $productImage)
                                            <img src="{{ asset('storage/'.$productImage->image)}}" class="mx-2" width="200px;" alt="">
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="price">Giá</label>
                                    <input type="text" class="form-control" name="price" id="price"
                                        value="{{ $product->price }}" placeholder="Nhập giá">
                                    @error('price')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="price_sale">Giá sale</label>
                                    <input type="text" class="form-control" name="price_sale" id="price_sale"
                                        value="{{ $product->price_sale }}" placeholder="Nhập giá giảm">
                                </div>
                                <hr>
                                <div>
                                    <h5 class="font-weight-bold">Thuộc tính</h5>
                                    <div class="row">
                                        @foreach ($attributes as  $key => $attribute)
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label
                                                        for="product_attribute_{{ $attribute->id }}">{{ $attribute->name }}</label>

                                                    <select class="form-control"
                                                        name="product_attribute_{{ $attribute->id }}"
                                                        id="product_attribute_{{ $attribute->id }}">

                                                        <option value="">Chọn {{ $attribute->name }}</option>

                                                        @foreach ($attribute->attributeOptions as $option)
                                                            <option value="{{ $option->id }}" {{ $productAttributeOptions[$key]->attribute_option_id == $option->id ? 'selected' : false }}>
                                                                {{ $option->value }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('product_attribute_' . $attribute->id)
                                                        <div class="form-text text-danger">{{ $message }}</div>
                                                    @enderror

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="description">Mô tả</label>
                                    <textarea class="form-control" rows="3" placeholder="Nhập mô tả sản phẩm" id="myEditor" class="myEditor" name="description">{{ $product->description }}</textarea>
                                    @error('description')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="brand_id">Thương hiệu</label>
                                    <select class="form-control" name="brand_id" id="brand_id">
                                        <option value="">Chọn thương hiệu</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : false }}>{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('brand_id')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Danh mục</label>
                                    <select class="form-control" name="category_id" id="category_id">
                                        <option value="">Chọn danh mục</option>
                                         @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : false }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Số lượng</label>
                                    <input type="text" class="form-control" name="quantity" id="quantity"
                                        value="{{ $product->quantity }}" placeholder="Nhập số lượng">
                                    @error('quantity')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
                                </div>
                                <!-- /.card-body -->
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div>
    </section>
@endsection

@push('jsHandle')
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };

        CKEDITOR.replace( 'myEditor', options );
        
        const title = document.querySelector('#name');
        const slug = document.querySelector('#slug')
        title.addEventListener('keyup', (e) => {
            const titleValue = e.target.value;
            slug.value = getSlug(titleValue);
        })


        slug.addEventListener('change', () => {
            if (slug.value === "") {
                const title = document.querySelector("#name");
                const titleValue = title.value;
                slug.value = getSlug(titleValue);
            }
        });

    </script>
@endpush
