@extends('admin.layouts.admin_master')

@section('title', 'Danh sách thương hiệu')

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
                                <form action="{{route('admin.brands.index')}}" method="GET" class="d-flex">
                                    <div class="form-group mb-0 mr-1">
                                        <input type="text" class="form-control" value="{{ Request::get('q') }}" name="q" placeholder="Tên thương hiệu tìm kiếm" style="width: 280px;">
                                    </div>
                                    <button type="submit" class="btn btn-info" style="width: 100px;">
                                        Tìm kiếm
                                    </button>
                                </form>
                                @can('add-brand')
                                    <a href="{{route('admin.brands.create')}}" class="btn btn-primary ">
                                        <i class="fa-solid fa-plus mr-2"></i>
                                        Thêm thương hiệu
                                    </a>
                                @endcan
                            </div>
                            <table id="example2" class="table table-bordered table-hover mb-3">
                                <thead class="text-center">
                                    <tr>
                                        <th width="15%">#</th>
                                        <th width="35%">Tên thương hiệu</th>
                                        <th width="35%">Hình ảnh</th>
                                        @if (Gate::check('edit-brand') || Gate::check('delete-brand'))
                                            <th width="15%">Hành động</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($brands as $key => $brand)
                                        <tr>
                                            <td style="vertical-align: middle;">{{ $key + 1 }}</td>
                                            <td style="vertical-align: middle;">{{ $brand->name }}</td>
                                            <td style="vertical-align: middle;">
                                                <img src="{{ asset('storage/'.$brand->logo)}}" width="120px" alt="">
                                            </td>
                                            @if (Gate::check('edit-brand') || Gate::check('delete-brand'))
                                                <td class="text-center" style="vertical-align: middle;">
                                                    <div class="d-flex justify-content-center">
                                                        @can('edit-brand')
                                                            <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-warning mr-1">Sửa</a>
                                                        @endcan
                                                        @can('delete-brand')
                                                            <form method="POST"
                                                                action="{{ route('admin.brands.destroy', $brand) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-danger deleteItemBtn" >Xóa</button>
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
                                {{$brands->links()}}
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
