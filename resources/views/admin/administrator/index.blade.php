@extends('admin.layouts.admin_master')

@section('title', 'Danh sách quản trị viên')

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
                                <form action="{{ route('admin.administrators.index') }}" method="GET" class="d-flex">
                                    <div class="form-group mb-0 mr-1" style="width: 280px;">
                                        <input type="text" class="form-control" name="q"
                                            value="{{ Request::get('q') }}" placeholder="Tên/Email quản trị viên">
                                    </div>
                                    <select class="form-control mr-1" style="width: 180px;" name="administrator_status">
                                        <option value="">Tất cả trạng thái</option>
                                        <option value="1">Hoạt động</option>
                                        <option value="2">Khóa</option>
                                    </select>
                                    <button type="submit" class="btn btn-info" style="width: 100px;">
                                        Tìm kiếm
                                    </button>
                                </form>
                                @if (Gate::check('add-role'))
                                    <a href="{{ route('admin.administrators.create') }}" class="btn btn-primary ">
                                        <i class="fa-solid fa-plus mr-2"></i>
                                        Thêm quản trị viên
                                    </a>
                                @endif
                                
                            </div>
                            <table id="example2" class="table table-bordered table-hover mb-3">
                                <thead class="text-center">
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="15%">Tên quản trị viên</th>
                                        <th width="10%">Avatar</th>
                                        <th width="20%">Email</th>
                                        <th width="25%">Roles</th>
                                        @if (Gate::check('edit-administrator') || Gate::check('delete-administrator'))
                                            <th width="10%">Trạng thái</th>
                                            <th width="30%">Hành động</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($administrators as $key => $administrator)
                                        <tr>
                                            <td style="vertical-align: middle;">{{ $key + 1 }}</td>
                                            <td style="vertical-align: middle;">{{ $administrator->name }}</td>
                                            <td style="vertical-align: middle;">
                                                <img src="{{ asset('storage/' . $administrator->avatar) }}" width="80px"
                                                    alt="">
                                            </td>
                                            <td style="vertical-align: middle;">{{ $administrator->email }}</td>
                                            <td style="vertical-align: middle;">
                                                @foreach ($administrator->roles as $role)
                                                    <span class="btn text-white"
                                                        style="background-color: #0d6174">{{ $role->display_name }}</span>
                                                @endforeach
                                            </td>
                                            <td style="vertical-align: middle;">
                                                @if (!$administrator->roles->contains('name', 'super-admin'))
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox"
                                                            @cannot('status-administrator')
                                                                {{'disabled'}}
                                                            @endcan
                                                            class="custom-control-input toggle-administrator-status"
                                                            name="administrator_{{ $administrator->id }}"
                                                            id="administrator_{{ $administrator->id }}"
                                                            data-id="{{ $administrator->id }}"
                                                            {{ $administrator->status == 1 ? 'checked' : '' }}>
                                                        <label class="custom-control-label"
                                                            for="administrator_{{ $administrator->id }}"></label>
                                                    </div>
                                                @endif
                                            </td>
                                            

                                            @if (Gate::check('edit-administrator') || Gate::check('delete-administrator'))
                                                <td class="text-center" style="vertical-align: middle;">
                                                    @if (!$administrator->roles->contains('name', 'super-admin'))
                                                        <div class="d-flex justify-content-center">
                                                            <a href="{{ route('admin.administrators.edit', $administrator) }}"
                                                                class="btn btn-warning mr-1">Sửa</a>
                                                            <form method="POST"
                                                                action="{{ route('admin.administrators.destroy', $administrator) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button"
                                                                    class="btn btn-danger deleteItemBtn">Xóa</button>
                                                            </form>
                                                        </div>
                                                    @endif
                                                </td>
                                            @endif

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-end">
                                {{ $administrators->links() }}
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
        var toggleAdministratorStatusBtns = document.querySelectorAll('.toggle-administrator-status');

        toastr.options.progressBar = true;
        toastr.options.closeButton = true;
        toastr.options.showEasing = 'swing';

        toggleAdministratorStatusBtns.forEach(element => {
            element.addEventListener('click', (event) => {
                let administratorStatus = element.checked;
                let administratorId = element.dataset.id;

                $.ajax({
                    url: "/admin/administrators/updateStatus",
                    type: "GET",
                    data: {
                        administratorId,
                        administratorStatus: administratorStatus ? 1 : 2,
                    },
                    success: function(data) {
                        if (data == true) {
                            toastr.success('Cập nhật trạng thái quản trị viên thành công');
                        }
                    }
                });
            })
        });


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
