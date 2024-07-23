<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard.index') }}" class="brand-link">
        <img src="{{ asset('company/logo/logo_removeBg2.png') }}" alt="AdminLTE Logo" class="brand-image "
            style="opacity: .8">
        <span class="brand-text font-weight-bold pl-2">THE COLLECTION</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-1 pb-2 mb-3 d-flex align-items-center ">
            <div class="image">
                <img src="{{ asset('storage/' . Auth::guard('administrator')->user()->avatar) }}" width="50px;"
                    alt="User Image">
            </div>
            <div class="info pl-3">
                <span class="d-block text-white font-weight-bold"
                    style="font-size: 20px;">{{ Auth::guard('administrator')->user()->name }}</span>
                <div class="">
                    @foreach (Auth::guard('administrator')->user()->roles as $role)
                        <span class="text-white" style="font-size: 14px;">{{ $role->display_name }}</span>
                    @endforeach
                </div>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

                @can('dashboard-statistic')
                    <li class="nav-item sidebar-nav">
                        <a href="{{ route('admin.dashboard.index') }}" class="nav-link ">
                            <i class="nav-icon fa-solid fa-chart-pie mr-2"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                @endcan


                @if (Gate::check('list-category') || Gate::check('add-category'))
                    <li class="nav-item sidebar-nav">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fa-solid fa-list mr-2"></i>
                            <p>
                                Quản lý danh mục
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('list-category')
                                <li class="nav-item">
                                    <a href="{{ route('admin.categories.index') }}" class="nav-link">
                                        <p>Danh sách danh mục</p>
                                    </a>
                                </li>
                            @endcan
                            @can('add-category')
                                <li class="nav-item">
                                    <a href="{{ route('admin.categories.create') }}" class="nav-link">
                                        <p>Thêm danh mục</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif



                @if (Gate::check('list-brand') || Gate::check('add-brand'))
                    <li class="nav-item sidebar-nav">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fa-regular fa-bookmark mr-2"></i>
                            <p>
                                Quản lý thương hiệu
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('list-brand')
                                <li class="nav-item">
                                    <a href="{{ route('admin.brands.index') }}" class="nav-link">
                                        <p>Danh sách thương hiệu</p>
                                    </a>
                                </li>
                            @endcan
                            @can('add-brand')
                                <li class="nav-item sidebar-nav">
                                    <a href="{{ route('admin.brands.create') }}" class="nav-link">
                                        <p>Thêm thương hiệu</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif

                @if (Gate::check('list-attribute') || Gate::check('add-attribute'))
                    <li class="nav-item sidebar-nav">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fa-brands fa-codepen mr-2"></i>
                            <p>
                                Quản lý thuộc tính
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('list-attribute')
                                <li class="nav-item">
                                    <a href="{{ route('admin.attributes.index') }}" class="nav-link">
                                        <p>Danh sách thuộc tính</p>
                                    </a>
                                </li>
                            @endcan
                            @can('add-attribute')
                                <li class="nav-item">
                                    <a href="{{ route('admin.attributes.create') }}" class="nav-link">
                                        <p>Thêm thuộc tính</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif

                @if (Gate::check('list-attribute-option') || Gate::check('add-attribute-option'))
                    <li class="nav-item sidebar-nav">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fa-regular fa-object-group mr-2"></i>
                            <p>
                                Quản lý giá trị thuộc tính
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('list-attribute-option')
                                <li class="nav-item sidebar-nav">
                                    <a href="{{ route('admin.attributeOptions.index') }}" class="nav-link">
                                        <p>Danh sách giá trị</p>
                                    </a>
                                </li>
                            @endcan
                            @can('add-attribute-option')
                                <li class="nav-item sidebar-nav">
                                    <a href="{{ route('admin.attributeOptions.create') }}" class="nav-link">
                                        <p>Thêm giá trị</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif

                @if (Gate::check('list-product') || Gate::check('add-product'))
                    <li class="nav-item sidebar-nav">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fa-solid fa-boxes-stacked mr-2"></i>
                            <p>
                                Quản lý sản phẩm
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('list-product')
                                <li class="nav-item sidebar-nav">
                                    <a href="{{ route('admin.products.index') }}" class="nav-link">
                                        <p>Danh sách sản phẩm</p>
                                    </a>
                                </li>
                            @endcan
                            @can('add-product')
                                <li class="nav-item sidebar-nav">
                                    <a href="{{ route('admin.products.create') }}" class="nav-link">
                                        <p>Thêm sản phẩm</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif

                @if (Gate::check('list-coupon') || Gate::check('add-coupon'))
                    <li class="nav-item sidebar-nav">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fa-solid fa-ticket mr-2"></i>
                            <p>
                                Quản lý coupon
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('list-coupon')
                                <li class="nav-item sidebar-nav">
                                    <a href="{{ route('admin.coupons.index') }}" class="nav-link">
                                        <p>Danh sách coupon</p>
                                    </a>
                                </li>
                            @endcan
                            @can('add-coupon')
                                <li class="nav-item sidebar-nav">
                                    <a href="{{ route('admin.coupons.create') }}" class="nav-link">
                                        <p>Thêm coupon</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif

                @if (Gate::check('list-client') || Gate::check('add-client'))
                    <li class="nav-item sidebar-nav">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fa-solid fa-users mr-2"></i>
                            <p>
                                Quản lý khách hàng
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('list-client')
                                <li class="nav-item">
                                    <a href="{{ route('admin.users.index') }}" class="nav-link">
                                        <p>Danh sách khách hàng</p>
                                    </a>
                                </li>
                            @endcan
                            @can('add-client')
                                <li class="nav-item">
                                    <a href="{{ route('admin.users.create') }}" class="nav-link">
                                        <p>Thêm khách hàng</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif

                @if (Gate::check('list-review'))
                    <li class="nav-item sidebar-nav">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fa-solid fa-ranking-star mr-2"></i>
                            <p>
                                Quản lý đánh giá
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.reviews.index') }}" class="nav-link">
                                    <p>Danh sách đánh giá</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (Gate::check('list-order'))
                    <li class="nav-item sidebar-nav">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fa-solid fa-cart-flatbed mr-2"></i>
                            <p>
                                Quản lý đơn hàng
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.orders.index') }}" class="nav-link">
                                    <p>Danh sách đơn hàng</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (Gate::check('list-role') || Gate::check('add-role'))
                    <li class="nav-item sidebar-nav">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fa-regular fa-id-card mr-2"></i>
                            <p>
                                Quản lý Roles
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('list-role')
                                <li class="nav-item">
                                    <a href="{{ route('admin.roles.index') }}" class="nav-link">
                                        <p>Danh sách Roles</p>
                                    </a>
                                </li>
                            @endcan
                            @can('add-role')
                                <li class="nav-item">
                                    <a href="{{ route('admin.roles.create') }}" class="nav-link">
                                        <p>Thêm Role</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif


                @if (Gate::check('list-administrator') || Gate::check('add-administrator'))
                    <li class="nav-item sidebar-nav">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fa-solid fa-users-gear mr-2"></i>
                            <p>
                                Quản lý quản trị viên
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('list-administrator')
                                <li class="nav-item">
                                    <a href="{{ route('admin.administrators.index') }}" class="nav-link">
                                        <p>Danh sách quản trị viên</p>
                                    </a>
                                </li>
                            @endcan
                            @can('add-administrator')
                                <li class="nav-item">
                                    <a href="{{ route('admin.administrators.create') }}" class="nav-link">
                                        <p>Thêm quản trị viên</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
