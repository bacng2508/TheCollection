@extends('admin.layouts.admin_master')

@section('title', 'Danh sách coupon')

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
                                <form action="{{route('admin.coupons.index')}}" class="d-flex">
                                    <div class="form-group mb-0 mr-1">
                                        <input type="text" class="form-control" name="q" placeholder="Nhập tên coupon" style="width: 280px;">
                                    </div>
                                    <button type="submit" class="btn btn-info" style="width: 100px;">
                                        Tìm kiếm
                                    </button>
                                </form>
                                @can('add-coupon')
                                    <a href="{{route('admin.coupons.create')}}" class="btn btn-primary ">
                                        <i class="fa-solid fa-plus mr-2"></i>
                                        Thêm coupon
                                    </a>
                                @endcan
                            </div>
                            <table id="example2" class="table table-bordered table-hover mb-3">
                                <thead class="text-center">
                                    <tr>
                                        <th width="15%">#</th>
                                        <th width="30%">Tên coupon</th>
                                        <th width="20%">Giá trị</th>
                                        <th width="20%">Ngày hết hạn</th>
                                        @if (Gate::check('edit-coupon') || Gate::check('delete-coupon'))
                                            <th width="25%">Hành động</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($coupons as $key => $coupon)
                                        <tr>
                                            <td style="vertical-align: middle;">{{ $key + 1 }}</td>
                                            <td style="vertical-align: middle;">{{ $coupon->name }}</td>
                                            <td style="vertical-align: middle;">{{ $coupon->value }}</td>
                                            <td style="vertical-align: middle;">{{ date('H:i:s d-m-Y ',strtotime($coupon->expire_date)) }}</td>
                                            @if (Gate::check('edit-coupon') || Gate::check('delete-coupon'))
                                                <td class="text-center" style="vertical-align: middle;">
                                                    <div class="d-flex justify-content-center">
                                                            @can('edit-coupon')
                                                                <a href="{{ route('admin.coupons.edit', $coupon) }}" class="btn btn-warning mr-1">Sửa</a>
                                                            @endcan
                                                            @can('delete-coupon')
                                                                <form method="POST" action="{{ route('admin.coupons.destroy', $coupon) }}">
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
                                {{$coupons->links()}}
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
        var deleteItemBtn = document.querySelectorAll('.deleteItemBtn');
        
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