<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item d-flex align-items-center ">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Messages Dropdown Menu -->
        <li class="nav-item d-flex align-items-center dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Brad Diesel
                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">Call me whenever you can...</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                John Pierce
                                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">I got your message bro</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Nora Silvester
                                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">The subject goes here</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown d-flex align-items-center">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge" id="total-unread-notification">{{ $unReadNotifications }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="min-width: 380px">
                <div class="d-flex justify-content-between align-items-center px-3 py-2">
                    <span class="font-weight-bold" style="font-size: 18px">Thông báo</span>
                    @if ($hasNewNotification)
                        <a href="{{ route('admin.notification.read-all') }}" class="text-secondary" style="font-size: 14px">Đánh dấu đã đọc</a>
                    @endif
                </div>
                <div class="dropdown-divider"></div>
                @if ($totalNotifications != 0)
                    <div id="notification-list">
                        @foreach ($notifications as $notification)
                            <div class="dropdown-item d-flex justify-content-between align-items-center notification-item">
                                <div class="d-flex justify-content-start align-items-start">
                                    <i class="fas fa-bell mr-3 mt-2 text-warning" style="font-size: 22px"></i>
                                    <div>
                                        <h5 class="my-0 font-weight-bold" style="font-size: 16px">{{ $notification->data['title'] }}</h5>
                                        <span style="font-size: 12px" class="text-muted">{{ $notification->data['message'] }}</span>
                                        <p style="font-size: 12px" class="text-muted mt-1">{{ date('H:i d-m-Y ', strtotime($notification->created_at)) }}</p>
                                    </div>
                                </div>
                                @if ($notification->read_at == null)
                                    <i class="fa-solid fa-circle text-primary" style="font-size: 10px;"></i>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-3 text-center text-secondary" style="font-size: 14px">
                        Không có thông báo mới
                    </div>
                @endif
                <div class="dropdown-divider"></div>
                <a href="{{ route('admin.notification.index') }}" class="dropdown-item dropdown-footer">Xem tất cả thông báo</a>
            </div>
        </li>
        <li class="nav-item d-flex align-items-center">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item mr-2">
            <div class="dropdown" style="position: relative">
                <button class="border-0 rounded p-2" style="background-color: rgb(243, 243, 243);" type="button" data-toggle="dropdown"
                    aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('storage/'.Auth::guard('administrator')->user()->avatar)}}" width="35px;">
                        <p class="mb-0 ml-2 d-flex align-items-center ">{{ Auth::guard('administrator')->user()->name }} <i class="fa-solid fa-sort-down ml-2 pb-1"></i></p>
                    </div>
                </button>
                <div class="dropdown-menu p-0 rounded-0 mr-3 border-0"
                    style="position: absolute; top: 98%; left: -60px; width: 200px;"
                    data-popper-placement="bottom-end">
                    <div class="card mb-0">
                        <div class="card-body p-0">
                            <div class="list-group rounded">
                                <a href="{{route('admin.profile.edit')}}"
                                    class="list-group-item list-group-item-action border-0 py-2 px-3">
                                    <div class="d-inline-block text-end me-2" style="width: 25px">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </div>
                                    <span>Chỉnh sửa hồ sơ</span>
                                </a>
                                <a href="{{route('admin.profile.change-password')}}"
                                    class="list-group-item list-group-item-action border-0 py-2 px-3">
                                    <div class="d-inline-block text-end me-2" style="width: 25px">
                                        <i class="fa-solid fa-key"></i>
                                    </div>
                                    <span>Đổi mật khẩu</span>
                                </a>
                                <div class="list-group-item list-group-item-action rounded-0 border-0 py-2 px-3 d-flex">
                                    <div class="d-inline-block text-end me-2" style="width: 25px">
                                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                    </div>
                                    <span>
                                        <form method="POST" action="{{route('admin.logout')}}">
                                            @csrf
                                            <button class="border-0 bg-transparent" style="color: #495057" type="submit">Đăng xuất</button>
                                        </form>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something</a>
                </div> --}}
            </div>
            {{-- <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#"
                role="button">
                here
                <i class="fas fa-th-large"></i>
            </a> --}}
        </li>
    </ul>
</nav>
