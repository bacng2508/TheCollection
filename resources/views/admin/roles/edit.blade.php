@extends('admin.layouts.admin_master')

@section('title', 'Sửa Role')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if (session()->has('msg'))
                                <p class="alert alert-success text-center py-2">Cập nhật Role thành công</p>
                            @endif

                            @if ($errors->any())
                                <p class="alert alert-danger text-center">Đã có lỗi xảy ra, vui lòng kiểm tra lại dữ liệu
                                    nhập vào</p>
                            @endif

                            <form class="" method="POST" action="{{ route('admin.roles.update', $role) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Tên Role</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{$role->name}}"
                                        placeholder="Nhập tên role">
                                    @error('name')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="slug">Tên hiển thị</label>
                                    <input type="text" class="form-control" name="display_name" id="display_name" value="{{$role->display_name}}"
                                        placeholder="Nhập tên hiển thị">
                                    @error('display_name')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Cập nhật Role</button>
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

