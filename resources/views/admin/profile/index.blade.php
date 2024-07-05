@extends('admin.layouts.admin_master')

@section('title', 'Chỉnh sửa hồ sơ')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" style="width: 200px;"
                                    src="{{ asset('storage/' . Auth::guard('administrator')->user()->avatar) }}"
                                    alt="User profile picture">
                            </div>
                            <div class="my-3">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input p-1" id="avatar" name="avatar"
                                            form="update-profile">
                                        <label class="custom-file-label" for="avatar">Chọn ảnh</label>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-2">
                            <table class="table table-borderless ml-4">
                                <tbody>
                                    <tr>
                                        <th class="text-right p-1" style="vertical-align: center; ">Họ tên:</th>
                                        <td class="p-1 pl-2">{{ Auth::guard('administrator')->user()->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-right p-1" style="vertical-align: center; ">Chức vụ:</th>
                                        <td class="p-1 pl-2">
                                            @foreach (Auth::guard('administrator')->user()->roles as $role)
                                                <span class="btn btn-primary border-0 py-1 px-2"
                                                    style="background-color: #0d6174">{{ $role->display_name }}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-3">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a
                                        class="nav-link {{ Route::current()->getName() === 'admin.profile.edit' ? 'active' : '' }}"
                                        href="#profile-infor" data-toggle="tab">Thông tin cá nhân</a></li>
                                <li class="nav-item"><a
                                        class="nav-link {{ Route::current()->getName() === 'admin.profile.change-password' ? 'active' : '' }}"
                                        href="#change-password" data-toggle="tab">Đổi mật khẩu</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane {{ Route::current()->getName() === 'admin.profile.edit' ? 'active' : '' }}"
                                    id="profile-infor">
                                    @if (session('msg'))
                                        <div class="alert alert-success text-center ">{{ session('msg') }}</div>
                                    @endif
                                    <form class="form-horizontal" action="{{ route('admin.profile.update') }}" 
                                        method="POST" id="update-profile" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-2 col-form-label">Tên</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ Auth::guard('administrator')->user()->name }}">
                                                    @error('name')
                                                        <div class="form-text text-danger">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="email" name="email"
                                                    value="{{ Auth::guard('administrator')->user()->email }}" disabled>
                                                @error('email')
                                                    <div class="form-text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="tel" class="col-sm-2 col-form-label">Số điện thoại</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="tel" name="tel"
                                                    value="{{ Auth::guard('administrator')->user()->tel }}">
                                                @error('tel')
                                                    <div class="form-text text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane {{ Route::current()->getName() === 'admin.profile.change-password' ? 'active' : '' }}"
                                    id="change-password">
                                    @if (session('msg'))
                                        <div class="alert alert-success text-center ">{{ session('msg') }}</div>
                                    @endif
                                    <form class="form-horizontal" action="{{route('admin.profile.change-password.update')}}" method="POST" id="change-password">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="password" class="col-sm-2 col-form-label">Mật khẩu cũ</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="password" name="old_password">
                                                @error('old_password')
                                                        <div class="form-text text-danger">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="new_password" class="col-sm-2 col-form-label">Mật khẩu mới</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="new_password" name="new_password">
                                                @error('new_password')
                                                        <div class="form-text text-danger">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="new_password_confirmation" class="col-sm-2 col-form-label">Nhập lại mật khẩu
                                                mới</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section>
@endsection


@push('jsHandle')
    <script type="text/javascript"></script>
@endpush
