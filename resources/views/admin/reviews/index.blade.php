@extends('admin.layouts.admin_master')

@section('title', 'Danh sách đánh giá')

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
                                <form action="{{ route('admin.reviews.index') }}" method="GET" class="d-flex">
                                    <div class="form-group mb-0 mr-1" style="width: 280px;">
                                        <input type="text" class="form-control" name="search"
                                            value="{{ Request::get('search') }}" placeholder="Nhập tên sản phẩm">
                                    </div>
                                    <select class="form-control mr-1" style="width: 160px;" name="rating">
                                        <option value="0" class="text-center">Tất cả rating</option>
                                        <option value="1" class="text-center">1</option>
                                        <option value="2" class="text-center">2</option>
                                        <option value="3" class="text-center">3</option>
                                        <option value="4" class="text-center">4</option>
                                        <option value="5" class="text-center">5</option>
                                    </select>
                                    <button type="submit" class="btn btn-info" style="width: 100px;">
                                        Tìm kiếm
                                    </button>
                                </form>
                            </div>
                            <table id="example2" class="table table-bordered table-hover mb-3">
                                <thead class="text-center">
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="20%">Tên sản phẩm</th>
                                        <th width="20%">Người đánh giá</th>
                                        <th width="15%">rating</th>
                                        <th width="">Nội dung</th>
                                        @if (Gate::check('status-review'))
                                            <th width="10%">Hành động</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($reviews as $key => $review)
                                        <tr>
                                            <td style="vertical-align: middle;">{{ $key + 1 }}</td>
                                            <td style="vertical-align: middle;">{{ $review->product->name }}</td>
                                            <td style="vertical-align: middle;">{{ $review->user->name }}
                                            </td>
                                            <td style="vertical-align: middle;">
                                                @for ($i = 0; $i < $review->rating; $i++)
                                                    <i class="fa-solid fa-star text-warning"></i>
                                                @endfor
                                            </td>
                                            <td style="vertical-align: middle;">{{ $review->content }}</td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                @if (Gate::check('status-review'))
                                                    <form action="{{ route('admin.reviews.changeStatus', $review) }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="status" value="{{ $review->status }}">
                                                        <button type="submit" class="btn btn-warning">
                                                            @if ($review->status == 1)
                                                                <i class="fa-solid fa-eye"></i>
                                                            @else
                                                                <i class="fa-solid fa-eye-slash"></i>
                                                            @endif
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-end">
                                {{ $reviews->links() }}
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
                            toastr.success(
                                'Thay đổi trạng thái nổi bật của sản phẩm thành công');
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
