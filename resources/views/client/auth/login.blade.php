@extends('client.layouts.client_master')

@section('page-content')
    <div class="container login-container mt-3">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="row">
                    <div class="col-6 mx-auto">
                        <div class="heading mb-1">
                            <h2 class="title text-center">Đăng nhập</h2>
                        </div>
                        @session('success')
                            <div class="alert alert-success py-3 mb-1 justify-content-center">
                                {{session('success')}}
                            </div>
                        @endsession
                        @session('error')
                            <div class="alert alert-danger py-3 mb-1 justify-content-center">
                                {{session('error')}}
                            </div>
                        @endsession
                        @error('loginFail')
                            <div class="alert alert-danger py-3 mb-1 justify-content-center">
                                {{ $message }}
                            </div>
                        @enderror
                        <form class="mb-2" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-1">
                                <label for="login-email">
                                    Email
                                    <span class="required">*</span>
                                </label>
                                <input type="text" name="email" value="{{old('email')}}" class="form-input form-wide mb-1" id="login-email" />
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

                            <div class="form-footer align-items-center mt-0 mb-2">
                                <div class="custom-control custom-checkbox mb-0 mt-0">
                                    <input type="checkbox" class="custom-control-input" id="remember" name="remember"/>
                                    <label class="custom-control-label mb-0" for="remember">Ghi nhớ đăng nhập</label>
                                </div>

                                <a href="{{ route('forgot-password') }}" class="forget-password text-dark form-footer-right">Quên mật khẩu ?</a>
                            </div>
                            <button type="submit" class="btn btn-dark btn-md w-100">
                                ĐĂNG NHẬP
                            </button>
                        </form>
                        <hr class="my-3">
                        <div class="mb-3">
                            <p class="text-center">Bạn chưa có tài khoản? <a href="{{route('register')}}"> Đăng ký</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
