@extends('client.layouts.client_master')

@section('page-content')
    <div class="container login-container mt-3">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="row align-items-center" style="min-height: 500px;">
                    <div class="col-6 mx-auto">
                        <div class="heading mb-1">
                            <h2 class="title text-center">Thiết lập mật khẩu mới</h2>
                        </div>
                        @session('error')
                            <div class="alert alert-danger py-3 mb-1 justify-content-center">
                                {{session('error')}}
                            </div>
                        @endsession
                        <form class="mb-2" method="POST" action="{{ route('reset-password') }}">
                            @csrf
                            <input type="hidden" name="email" value="{{ request()->get('email') }}">
                            <input type="hidden" name="token" value="{{ request()->get('token') }}">
                            <div class="mb-1">
                                <label for="login-password">
                                    Mật khẩu mới
                                    <span class="required">*</span>
                                </label>
                                <input type="password" name="password" class="form-input form-wide mb-1" id="password" />
                                @error('password')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-1">
                                <label for="password-confirmation">
                                    Nhập lại mật khẩu mới
                                    <span class="required">*</span>
                                </label>
                                <input type="password" name="password_confirmation" class="form-input form-wide mb-1"
                                    id="password" />
                            </div>

                            <button type="submit" class="btn btn-dark btn-md w-100">
                                Cập nhật mật khẩu mới
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
