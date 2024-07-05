@extends('admin.layouts.admin_master')

@section('title', 'Sửa thông tin quản trị viên')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        .select2-selection__choice {
            background-color: #0d6174 !important;
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
                            @if ($errors->any())
                                <p class="alert alert-danger text-center">Đã có lỗi xảy ra, vui lòng kiểm tra lại dữ liệu
                                    nhập vào</p>
                            @endif

                            @if (session()->has('msg'))
                                <p class="alert alert-success text-center py-2">{{session('msg')}}</p>
                            @endif

                            <form class="" method="POST" action="{{ route('admin.administrators.update', $administrator) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Tên <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{ $administrator->name }}" placeholder="Nhập tên quản trị viên">
                                    @error('name')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="avatar">Ảnh đại diện</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="avatar" name="avatar">
                                            <label class="custom-file-label" for="avatar">Chọn ảnh</label>
                                        </div>
                                    </div>
                                    @error('avatar')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="mt-3">
                                        <img src="{{ asset('storage/'.$administrator->avatar)}}" width="300px;" alt="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="email" id="email"
                                        value="{{ $administrator->email }}" placeholder="Nhập email" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="password">Mật khẩu <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password" id="password"
                                         placeholder="Nhập mật khẩu">
                                    @error('password')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Nhập lại mật khẩu <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"
                                        placeholder="Nhập lại mật khẩu">
                                    @error('password_confirmation')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tel">Số điện thoại</label>
                                    <input type="text" class="form-control" name="tel" id="tel"
                                        value="{{ $administrator->tel }}" placeholder="Nhập số điện thoại">
                                    @error('tel')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="role_id">Role <span class="text-danger">*</span></label>
                                    <select class="form-control multiple_select_box" multiple name="role_id[]" id="role_id">
                                        <option value="">Chọn Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" {{ ($administrator->roles->contains('id',$role->id)) ? 'selected':'' }}>{{ $role->display_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                    @error('role_id.*')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
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
        $(document).ready(function() {
            $('.multiple_select_box').select2();
        });
    </script>

@endpush
