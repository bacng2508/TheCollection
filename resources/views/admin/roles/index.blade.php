@extends('admin.layouts.admin_master')

@section('title', 'Danh sách Role')

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
                            <div class="mb-3 d-flex justify-content-end ">
                                @if (Gate::check('add-role'))
                                    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary ">
                                        <i class="fa-solid fa-plus mr-2"></i>
                                        Thêm Role
                                    </a>
                                @endif
                                
                            </div>
                            <table id="example2" class="table table-bordered table-hover mb-3">
                                <thead class="text-center">
                                    <tr>
                                        <th width="15%">#</th>
                                        <th width="30%">Tên Role</th>
                                        <th width="30%">Tên hiển thị</th>
                                        @if (Gate::check('edit-role') || Gate::check('delete-role') || Gate::check('authorize-role'))
                                            <th width="15%">Hành động</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($roles as $key => $role)
                                        <tr>
                                            <td style="vertical-align: middle;">{{ $key + 1 }}</td>
                                            <td style="vertical-align: middle;">{{ $role->name }}</td>
                                            <td style="vertical-align: middle;">{{ $role->display_name }}</td>
                                                @if (Gate::check('edit-role') || Gate::check('delete-role') || Gate::check('authorize-role'))
                                                    <td class="text-center" style="vertical-align: middle;">
                                                        @if ($role->name != 'super-admin')
                                                            <div class="d-flex justify-content-center">
                                                                @can('authorize-role')
                                                                    <a href="{{ route('admin.roles.authorization', $role) }}"
                                                                        class="btn btn-info mr-1">Phân quyền</a>
                                                                @endcan
                                                                @can('edit-role')
                                                                    <a href="{{ route('admin.roles.edit', $role) }}"
                                                                        class="btn btn-warning mr-1">Sửa</a>
                                                                @endcan
                                                                @can('delete-role')
                                                                    <form method="POST"
                                                                        action="{{ route('admin.roles.destroy', $role) }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="button"
                                                                            class="btn btn-danger deleteItemBtn">Xóa</button>
                                                                    </form>
                                                                @endcan
                                                            </div>
                                                        @endif
                                                    </td>
                                                @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-end">
                                {{ $roles->links() }}
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
