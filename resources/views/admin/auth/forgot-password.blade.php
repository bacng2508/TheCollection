<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quên mật mật khẩu</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('company') }}/logo/company_white_icon.jpg">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    {{-- <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    {{-- <link rel="stylesheet" href="../../dist/css/adminlte.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('backend/assets/dist/css/adminlte.min.css') }}">
	<link rel="stylesheet" href="{{asset("backend")}}/css/style.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box" style="min-width: 450px;">
        <div class="login-logo">
            <h1 class="font-weight-bold text-center text__main-color mb-0">THE COLLECTION</h1>
        </div>
        <div class="card">
            <div class="card-body login-card-body p-4" style="border-radius: 8px;">
                <h5 class="login-box-msg p-0 mb-4 font-weight-bold">Lấy lại mật khẩu</h5>
                @session('success')
                    <p class="text-success text-center mb-2">{{session('success')}}</p>
                @endsession
                <form action="" method="POST">
                    @csrf
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        @error('email')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <button class="btn btn-primary w-100 bg__main-color border__main-color">Gửi link cập nhật mật khẩu</button>
                    </div>
                    <hr class="my-3">
                    <div class="mb-3">
                        <p class="text-center">Bạn đã có tài khoản? <a href="{{route('admin.login')}}"> Đăng nhập</a></p>
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    {{-- <script src="../../plugins/jquery/jquery.min.js"></script>--}}
    <script src="{{ asset('backend/assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    {{-- <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script> --}}
    <script src="{{ asset('backend/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    {{-- <script src="../../dist/js/adminlte.min.js"></script> --}}
    <script src="{{ asset('backend/assets/dist/js/adminlte.js') }}"></script>
     
</body>

</html>