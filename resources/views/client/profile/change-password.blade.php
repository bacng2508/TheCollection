@extends('client.layouts.client_master')

@section('page-content')
    <div class="container py-5" style="min-height: 620px;">
        <div class="row">
            @include('client.profile.sidebar')
            <div class="col-9 p-5">
                @if (session('msg'))
                    <div class="alert alert-success justify-content-center">{{ session('msg') }}</div>
                @endif
                <form class="form-horizontal" action="{{ route('profile.update-password') }}" method="POST"
                    id="change-password">
                    @csrf
                    <div class="form-group row">
                        <label for="password" class="col-3 col-form-label">Mật khẩu cũ</label>
                        <div class="col-9">
                            <input type="password" class="form-control" id="password" name="old_password">
                            @error('old_password')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="new_password" class="col-3 col-form-label">Mật khẩu mới</label>
                        <div class="col-9">
                            <input type="password" class="form-control" id="new_password" name="new_password">
                            @error('new_password')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="new_password_confirmation" class="col-3 col-form-label">Nhập lại mật khẩu
                            mới</label>
                        <div class="col-9">
                            <input type="password" class="form-control" id="new_password_confirmation"
                                name="new_password_confirmation">
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary p-3" style="font-size: 12px;">Đổi mật khẩu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('jsHandle')
    <script type="text/javascript"></script>
@endpush
