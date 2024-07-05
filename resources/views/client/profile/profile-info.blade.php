@extends('client.layouts.client_master')

@section('page-content')
    <div class="container py-5" style="min-height: 620px;">
        <div class="row">
            @include('client.profile.sidebar')
            <div class="col-9 p-5">
                @if (session('msg'))
                    <div class="alert alert-success text-center ">{{ session('msg') }}</div>
                @endif
                <div>
                    <h4 class="mb-0">Ảnh đại diện</h4>
                    <div class="d-flex flex-column align-items-center">
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" width="200px;" alt="">
                        <div class="custom-file mt-1" style="width: 200px;">
                            <input type="file" class="custom-file-input" id="avatar" name="avatar"
                                form="update-client-profile">
                            <label class="custom-file-label" for="avatar">Chọn ảnh</label>
                        </div>
                    </div>
                </div>
                <hr class="my-5">
                <form class="form-horizontal" action="{{ route('profile.update') }}" method="POST"
                    id="update-client-profile" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Tên</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ Auth::user()->name }}">
                            @error('name')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ Auth::user()->email }}" disabled>
                            @error('email')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tel" class="col-sm-2 col-form-label">Số điện thoại</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="tel" name="tel"
                                value="{{ Auth::user()->tel }}">
                            @error('tel')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tel" class="col-sm-2 col-form-label">Địa chỉ</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="address">{{ Auth::user()->address }}</textarea>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary p-3" style="font-size: 12px;">Cập nhật thông tin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('jsHandle')
    <script type="text/javascript"></script>
@endpush
