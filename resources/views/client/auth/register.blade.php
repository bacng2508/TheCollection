@extends('client.layouts.client_master')

@section('page-content')
    <div class="container login-container mt-3">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="row">
                    <div class="col-6 mx-auto">
                        <div class="heading mb-1">
                            <h1 class="title text-center">Đăng ký tài khoản</h1>
                        </div>

                        <form class="mb-3" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-1">
                                <label for="login-email">
                                    Tên
                                    <span class="required">*</span>
                                </label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                    class="form-input form-wide mb-1" id="login-email" />
                                @error('name')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-1">
                                <label for="login-email">
                                    Email
                                    <span class="required">*</span>
                                </label>
                                <input type="text" name="email" class="form-input form-wide mb-1" id="login-email"  value="{{ old('email') }}"/>
                                @error('email')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-1">
                                <label for="login-password">
                                    Mật khẩu
                                    <span class="required">*</span>
                                </label>
                                <input type="password" name="password" class="form-input form-wide mb-1" id="login-password" />
                                @error('password')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-0">
                                <label for="login-password-confirmation">
                                    Nhập lại mật khẩu
                                    <span class="required">*</span>
                                </label>
                                <input type="password" name="password_confirmation" class="form-input form-wide mb-1"
                                    id="login-password" />
                            </div>

                            <button type="submit" class="btn btn-dark btn-md w-100 my-3">
                                Đăng ký
                            </button>
                            <hr class="my-3">
                            <div class="form-footer justify-content-center mt-2" style="font-size: 14px;">
                                Bạn đã có tài khoản? <a href="{{route('login')}}" class="ml-2">Đăng nhập</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
