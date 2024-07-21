@extends('client.layouts.client_master')

@section('page-content')
    <div class="container login-container mt-3" >
        <div class="row " >
            <div class="col-lg-10 mx-auto" >
                <div class="row align-items-center" style="min-height: 500px;">
                    <div class="col-6 mx-auto">
                        <div class="heading mb-1">
                            <h2 class="title text-center">Lấy lại mật khẩu</h2>
                        </div>
                        @session('msg')
                            <div class="alert alert-success py-3 mb-1 justify-content-center">
                                {{session('msg')}}
                            </div>
                        @endsession
                        <form class="mb-2" method="POST" action="{{ route('forgot-password') }}">
                            @csrf
                            <div class="mb-1">
                                <label for="login-email">Email<span class="required">*</span></label>
                                <input type="text" name="email" value="{{old('email')}}" class="form-input form-wide mb-1" id="email" />
                                @error('email')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-dark btn-md w-100">
                                Gửi link cập nhật lại mật khẩu 
                            </button>
                        </form>
                        <hr class="my-3">
                        <div class="mb-3">
                            <p class="text-center">Bạn đã có tài khoản?<a href="{{route('login')}}"> Đăng nhập</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
