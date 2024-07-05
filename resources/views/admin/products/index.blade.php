@extends('admin.layouts.admin_master')

@section('title', 'Danh sách sản phẩm')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if (session('msg'))
                                <div class="alert alert-success text-center ">{{ session('msg') }}</div>
                            @endif
                            <div class="mb-3 d-flex justify-content-between ">
                                <form action="{{ route('admin.products.index') }}" method="GET" class="d-flex">
                                    <div class="form-group mb-0 mr-1" style="width: 280px;">
                                        <input type="text" class="form-control" name="q"
                                            value="{{ Request::get('q') }}" placeholder="Nhập tên sản phẩm">
                                    </div>
                                    <select class="form-control mr-1" style="width: 180px;" name="category_id">
                                        <option value="">Tất cả danh mục</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ Request::get('category_id') == $category->id ? 'selected' : false }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-info" style="width: 100px;">
                                        Tìm kiếm
                                    </button>
                                </form>
                                @can('add-product')
                                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary ">
                                        <i class="fa-solid fa-plus mr-2"></i>
                                        Thêm sản phẩm
                                    </a>
                                @endcan
                            </div>
                            <table id="example2" class="table table-bordered table-hover mb-3">
                                <thead class="text-center">
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="">Tên sản phẩm</th>
                                        <th width="20%">Hình ảnh</th>
                                        <th width="15%">Giá</th>
                                        <th width="">Thương hiệu</th>
                                        <th width="">Danh mục</th>
                                        <th width="">Nổi bật</th>
                                        @if (Gate::check('edit-product') || Gate::check('delete-product'))
                                            <th width="15%">Hành động</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($products as $key => $product)
                                        <tr>
                                            <td style="vertical-align: middle;">{{ $key + 1 }}</td>
                                            <td style="vertical-align: middle;">{{ $product->name }}</td>
                                            <td style="vertical-align: middle;">
                                                <img src="{{ asset('storage/' . $product->thumbnail) }}" width="120px"
                                                    alt="">
                                            </td>
                                            <td style="vertical-align: middle;">{{ number_format($product->price) . ' đ' }}
                                            </td>
                                            <td style="vertical-align: middle;">{{ $product->brand->name }}</td>
                                            <td style="vertical-align: middle;">{{ $product->category->name }}</td>
                                            <td style="vertical-align: middle;">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" 
                                                        @cannot('active-feature-product')
                                                            {{'disabled'}}
                                                        @endcan 
                                                    class="custom-control-input toggle-feature-product" name="product_{{$product->id}}" id="product_{{$product->id}}" data-id="{{$product->id}}" {{($product->is_featured == 1) ? "checked" : ""}}>
                                                    <label class="custom-control-label" for="product_{{$product->id}}"></label>
                                                </div>
                                            </td>
                                            @if (Gate::check('edit-product') || Gate::check('delete-product'))
                                                <td class="text-center" style="vertical-align: middle;">
                                                    <div class="d-flex justify-content-center">
                                                        @can('edit-product')
                                                            <a href="{{ route('admin.products.edit', $product) }}"
                                                                class="btn btn-warning mr-1">Sửa</a>
                                                        @endcan
                                                        @can('delete-product')
                                                            <form method="POST"
                                                                action="{{ route('admin.products.destroy', $product) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-danger deleteItemBtn">Xóa</button>
                                                            </form>
                                                        @endcan
                                                    </div>
                                                </td>
                                            @endif
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-end">
                                {{ $products->links() }}
                            </div>
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
<script type="text/javascript">
        var toggleFreatureProductBtns = document.querySelectorAll('.toggle-feature-product');
        
        toastr.options.progressBar = true;
        toastr.options.closeButton = true;
        toastr.options.showEasing = 'swing';
        
        toggleFreatureProductBtns.forEach(element => {
            element.addEventListener('click', (event) => {
                let isFeatureProduct = element.checked;
                let productId = element.dataset.id;

                console.log(isFeatureProduct);
                
                $.ajax({
                    url: "/admin/products/updateFeatureStatus",
                    type: "GET",
                    data: {
                        productId,
                        isFeatureProduct: isFeatureProduct ? 1 : 0,
                    },
                    // dataType: "json",
                    success: function(data) {
                        if (data == true) {
                            toastr.success('Thay đổi trạng thái nổi bật của sản phẩm thành công');
                        }
                    }
                });
            })
        });


        var deleteItemBtn = document.querySelectorAll('.deleteItemBtn');
        // Using SweetAlert
        deleteItemBtn.forEach((element) => {
            element.addEventListener('click', (e) => {
                e.preventDefault();
                Swal.fire({
                    title: "Bạn có chắc chắn muốn xóa không?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Đồng ý",
                    cancelButtonText: "Hủy bỏ"
                    }).then((result) => {
                    if (result.isConfirmed) {
                        element.parentElement.submit();
                    }
                });
            })
        })
    </script>
@endpush