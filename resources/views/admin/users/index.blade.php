@extends('admin.layouts.admin_master')

@section('title', 'Danh sách khác hàng')

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
                                <form action="{{ route('admin.users.index') }}" method="GET" class="d-flex">
                                    <div class="form-group mb-0 mr-1" style="width: 280px;">
                                        <input type="text" class="form-control" name="q"
                                            value="{{ Request::get('q') }}" placeholder="Tên/Email người dùng">
                                    </div>
                                    <select class="form-control mr-1" style="width: 180px;" name="user_status">
                                        <option value="">Tất cả trạng thái</option>
                                        <option value="1">Hoạt động</option>
                                        <option value="2">Khóa</option>
                                    </select>
                                    <button type="submit" class="btn btn-info" style="width: 100px;">
                                        Tìm kiếm
                                    </button>
                                </form>
                                @can('add-client')
                                    <div>
                                        <a href="{{ route('admin.users.export') }}" class="btn btn-success mr-1">
                                            <i class="fa-regular fa-floppy-disk"></i>
                                        </a>
                                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary ">
                                            <i class="fa-solid fa-plus mr-2"></i>
                                            Thêm khách hàng
                                        </a>
                                    </div>
                                @endcan
                            </div>
                            <table id="example2" class="table table-bordered table-hover mb-3">
                                <thead class="text-center">
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="20%">Tên người dùng</th>
                                        <th width="10%">Avatar</th>
                                        <th width="20%">Email</th>
                                        <th width="20%">SDT</th>
                                        <th width="10%">Trạng thái</th>
                                        @if (Gate::check('edit-client') || Gate::check('delete-client'))
                                            <th width="15%">Hành động</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($users as $key => $user)
                                        <tr>
                                            <td style="vertical-align: middle;">{{ $key + 1 }}</td>
                                            <td style="vertical-align: middle;">{{ $user->name }}</td>
                                            <td style="vertical-align: middle;">
                                                <img src="{{ asset('storage/' . $user->avatar) }}" width="80px"
                                                    alt="">
                                            </td>
                                            <td style="vertical-align: middle;">{{ $user->email }}</td>
                                            <td style="vertical-align: middle;">{{ $user->tel }}</td>
                                            <td style="vertical-align: middle;">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input toggle-user-status"
                                                        @cannot('status-client')
                                                            {{'disabled'}}
                                                        @endcan 
                                                        name="user_{{ $user->id }}" id="user_{{ $user->id }}"
                                                        data-id="{{ $user->id }}"
                                                        {{ $user->status == 1 ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="user_{{ $user->id }}"></label>
                                                </div>
                                            </td>
                                            @if (Gate::check('edit-client') || Gate::check('delete-client'))
                                                <td class="text-center" style="vertical-align: middle;">
                                                    <div class="d-flex justify-content-center">
                                                        @can('edit-client')
                                                            <a href="{{ route('admin.users.edit', $user) }}"
                                                                class="btn btn-warning mr-1">Sửa</a>
                                                        @endcan
                                                        @can('delete-client')
                                                            <form method="POST"
                                                                action="{{ route('admin.users.destroy', $user) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button"
                                                                    class="btn btn-danger deleteItemBtn">Xóa</button>
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
                                {{ $users->links() }}
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
        var toggleUserStatusBtns = document.querySelectorAll('.toggle-user-status');

        toastr.options.progressBar = true;
        toastr.options.closeButton = true;
        toastr.options.showEasing = 'swing';

        toggleUserStatusBtns.forEach(element => {
            element.addEventListener('click', (event) => {
                let userStatus = element.checked;
                let userId = element.dataset.id;

                $.ajax({
                    url: "/admin/users/updateStatus",
                    type: "GET",
                    data: {
                        userId,
                        userStatus: userStatus ? 1 : 2,
                    },
                    // dataType: "json",
                    success: function(data) {
                        if (data == true) {
                            toastr.success('Cập nhật trạng thái khách hàng thành công');
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
