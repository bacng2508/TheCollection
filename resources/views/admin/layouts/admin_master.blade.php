<!DOCTYPE html>
<html lang="en">

<!-- Head -->
@include('admin.partrials.head')
<!-- /.Head -->

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        {{-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60"
                width="60">
        </div> --}}

        <!-- Navbar -->
        @include('admin.partrials.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('admin.partrials.sidebar')
        <!-- ./Main Sidebar Container -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header pb-1">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('title')</h1>
                        </div>

                        {{-- <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                                <li class="breadcrumb-item active">Danh sách danh mục</li>
                            </ol>
                        </div> --}}
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            @yield('content')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Footer -->
        @include('admin.partrials.footer')
        <!-- ./Footer -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- Script -->
    @include('admin.partrials.script')
    <!-- ./Script -->

    <!-- JsHandle -->
    @stack('jsHandle')
    <!-- ./JsHandle -->
</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</html>
