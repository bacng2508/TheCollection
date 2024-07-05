
@extends('admin.layouts.admin_master')

@section('title', 'Danh sách giá trị thuộc tính')

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
                                <form action="{{route('admin.attributeOptions.index')}}" method="GET" class="d-flex">
                                    <div class="form-group mb-0 mr-1" style="width: 280px;">
                                        <input type="text" class="form-control" name="q" value="{{ Request::get('q')}}" placeholder="Nhập tên giá trị thuộc tính">
                                    </div>
                                    <select class="form-control mr-1" style="width: 180px;" name="attribute_id">
                                        <option value="">Tất cả thuộc tính</option>
                                        @foreach ($attributes as $attribute)
                                            <option value="{{$attribute->id}}" {{ Request::get('attribute_id') == $attribute->id ? "selected" : false}}>{{$attribute->name}}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-info" style="width: 100px;">
                                        Tìm kiếm
                                    </button>
                                </form>
                                @can('add-attribute-option')
                                    <a href="{{route('admin.attributeOptions.create')}}" class="btn btn-primary ">
                                        <i class="fa-solid fa-plus mr-2"></i>
                                        Thêm giá trị thuộc tính
                                    </a>
                                @endcan
                            </div>
                            <table id="example2" class="table table-bordered table-hover mb-3">
                                <thead class="text-center">
                                    <tr>
                                        <th width="15%">#</th>
                                        <th width="35%">Giá trị</th>
                                        <th width="35%">Thuộc tính</th>
                                        @if (Gate::check('edit-attribute-option') || Gate::check('delete-attribute-option'))
                                            <th width="15%">Hành động</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($attributeOptions as $key => $option)
                                        <tr>
                                            <td style="vertical-align: middle;">{{ $key + 1 }}</td>
                                            <td style="vertical-align: middle;">{{ $option->value }}</td>
                                            <td style="vertical-align: middle;">
                                                {{$option->attribute->name}}
                                            </td>
                                            @if (Gate::check('edit-attribute-option') || Gate::check('delete-attribute-option'))
                                                <td class="text-center" style="vertical-align: middle;">
                                                    <div class="d-flex justify-content-center">
                                                        @can('edit-attribute-option')
                                                            <a href="{{route('admin.attributeOptions.edit', $option)}}" class="btn btn-warning mr-1">Sửa</a>
                                                        @endcan
                                                        @can('delete-attribute-option')
                                                            <form method="POST"
                                                                action="{{ route('admin.attributeOptions.destroy', $option) }}">
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
                                {{$attributeOptions->links()}}
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
