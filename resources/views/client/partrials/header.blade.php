<header class="header">
    <!-- End .header-top -->

    <div class="header-middle sticky-header" data-sticky-options="{'mobile': true}">
        <div class="container">
            <div class="header-left col-lg-2 w-auto pl-0">
                <button class="mobile-menu-toggler text-primary mr-2" type="button">
                    <i class="fas fa-bars"></i>
                </button>
                <a href="{{ route('home') }}" class="logo d-flex justify-content-center align-items-center">
                    {{-- <img src="{{ asset('frontend') }}/assets/images/logo.png" width="111" height="44"
                        alt="Porto Logo"> --}}
                    <img src="{{ asset('company') }}/logo/company_black_icon.png" class="ml-5" width="62"
                        alt="THE COLLECTION logo">
                    <h4 class="text__main-color mb-0">THE COLLECTION</h4>
                </a>
            </div>
            <!-- End .header-left -->

            <div class="header-right w-lg-max">
                <div
                    class="header-icon header-search header-search-inline header-search-category w-lg-max text-right mt-0">
                    <a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
                    <form action="{{ route('client.product.search') }}" method="GET">
                        {{-- @csrf --}}
                        <div class="header-search-wrapper position-relative">
                            <input type="search" class="form-control" name="q" id="q"
                                placeholder="Tìm kiếm">
                            <div class="select-custom" style="width: 100px;">
                                <select id="cat" name="cat">
                                    <option value="0">Tất cả danh mục</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- End .select-custom -->
                            <button class="btn icon-magnifier p-0" title="search" type="submit"></button>
                            <div class="position-absolute"  style="border-radius: 10px; top: 100%; width: 100%; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                                <ul class="bg-light mb-0" id="search-result-container" style="border-radius: 10px; overflow: hidden">
                                </ul>
                            </div>
                        </div>
                        <!-- End .header-search-wrapper -->
                    </form>
                </div>
                <!-- End .header-search -->

                <div class="header-contact d-none d-lg-flex pl-4 pr-4">
                    <img alt="phone" src="{{ asset('frontend') }}/assets/images/phone.png" width="30"
                        height="30" class="pb-1">
                    <h6><span>Gọi chúng tôi ngay</span><a href="tel:#" class="text-dark font1">+ 098 662 662</a></h6>
                </div>


                @guest
                    <a href="{{ route('login') }}" class="header-icon" title="login"><i class="icon-user-2"></i></a>
                @endguest

                @auth
                    <div class="dropdown mr-4" style="position: relative">
                        <button class="border-0 rounded-circle p-2" style="background-color: rgb(243, 243, 243);"
                            type="button" data-toggle="dropdown" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" width="35px;">
                            </div>
                        </button>
                        <div class="dropdown-menu p-0 rounded-0 mr-3 border-0"
                            style="position: absolute; top: 95%; left: -60px; width: 200px;"
                            data-popper-placement="bottom-end">
                            <div class="card mb-0">
                                <div class="card-body p-0" style="min-height: 0;">
                                    <div class="list-group rounded">
                                        <a href="{{route('profile.my-orders')}}"
                                            class="list-group-item list-group-item-action border-0 py-3 px-3"
                                            style="text-decoration: none;">
                                            <div class="d-inline-block text-end me-2" style="width: 25px">
                                                <i class="fa-solid fa-boxes-packing"></i>
                                            </div>
                                            <span>Đơn hàng của tôi</span>
                                        </a>
                                        <a href="{{route('profile.edit')}}"
                                            class="list-group-item list-group-item-action border-0 py-3 px-3"
                                            style="text-decoration: none;">
                                            <div class="d-inline-block text-end me-2" style="width: 25px">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </div>
                                            <span>Chỉnh sửa hồ sơ</span>
                                        </a>
                                        <a href="{{route('profile.change-password')}}"
                                            class="list-group-item list-group-item-action border-0 py-3 px-3"
                                            style="text-decoration: none;">
                                            <div class="d-inline-block text-end me-2" style="width: 25px">
                                                <i class="fa-solid fa-key"></i>
                                            </div>
                                            <span>Đổi mật khẩu</span>
                                        </a>
                                        <div class="list-group-item list-group-item-action rounded-0 border-0 py-3 px-3 d-flex"
                                            style="text-decoration: none;">
                                            <div class="d-inline-block text-end me-2" style="width: 25px">
                                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                            </div>
                                            <span>
                                                <form method="POST" action="{{ route('logout') }}" class="mb-0">
                                                    @csrf
                                                    <button class="border-0 bg-transparent"
                                                        style="color: #495057; cursor: pointer" type="submit">Đăng
                                                        xuất</button>
                                                </form>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endauth



                <div class="position-relative home__nav-item mr-5">
                    <div class="position-relative p-1">
                        <i class="fa-regular fa-bell" style="font-size: 24px"></i></a>
                        <span id="total-unread-notification" class="badge-circle " style="position: absolute; top: -5px; right: -8px;">{{ Auth::user() ? Auth::user()->unreadNotifications()->count() : '' }}</span>
                    </div>
                    @auth
                        <div class="border border-black position-absolute home__sub-nav-item bg-white d-none rounded"
                            style="z-index: 100; width: 400px; top: 120%">
                            <div class="d-flex justify-content-between px-4 py-2 border-bottom align-items-center">
                                <h5 class="mb-0">Thông báo</h5>
                                <a class="text-center text-primary" href="{{ route('client.notification.read-all') }}">
                                    Đánh dấu đã đọc tất cả
                                </a>
                            </div>
                            <div class="dropdown-item d-flex flex-column justify-content-between notification-items p-0" id="notification-list">
                                @foreach (Auth::user()->notifications()->take(5)->get() as $notification)
                                    <div class="d-flex justify-content-start align-items-start p-3 border-bottom notification-item">
                                        <div class="align-self-start p-2">
                                            <i class="fas fa-bell mr-3 mt-2 text-warning" style="font-size: 22px"></i>
                                        </div>
                                        <div>
                                            <h5 class="my-0 font-weight-bold" style="font-size: 16px">{{ $notification->data['title'] }}</h5>
                                            <span style="font-size: 12px" class="text-muted">{{ $notification->data['message'] }}</span>
                                            <p style="font-size: 12px" class="text-muted mt-1">{{ date('H:i d-m-Y ', strtotime($notification->created_at)) }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <a class="dropdown-item text-center p-2 d-block" href="{{ route('profile.my-orders') }}">
                                Xem tất cả thông báo
                            </a>
                        </div>
                    @endauth
                </div>
                @auth
                    @if (request()->path() == 'check-out')
                        <div class="dropdown cart-dropdown">
                            <a href="{{ route('cart') }}" class=" dropdown-arrow" role="button">
                                <i class="minicart-icon"></i>
                                @isset($cartItems)
                                    <span class="badge-circle" id="cart-count">{{ $cartItems->count() }}</span>
                                @endisset

                                @guest
                                    <span class="badge-circle" id="cart-count">0</span>
                                @endguest
                            </a>
                        </div>
                    @else
                        <div class="dropdown cart-dropdown" id="cart-container">
                            <a href="#" title="Cart" class="dropdown-toggle dropdown-arrow cart-toggle"
                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                data-display="static">
                                <i class="minicart-icon" id="mini-cart-icon"></i>
                                @isset($cartItems)
                                    <span class="badge-circle" id="cart-count">{{ $cartItems->count() }}</span>
                                @endisset

                                @guest
                                    <span class="badge-circle" id="cart-count">0</span>
                                @endguest
                            </a>

                            <div class="cart-overlay"></div>

                            <div class="dropdown-menu mobile-cart">
                                <a href="#" title="Close (Esc)" class="btn-close">×</a>

                                <div class="dropdownmenu-wrapper custom-scrollbar">
                                    <div class="dropdown-cart-header mb-0">GIỎ HÀNG</div>
                                    <!-- End .dropdown-cart-header -->

                                    <div class="dropdown-cart-products" id="mini-cart">
                                        @if ($cartItems->count() == 0)
                                            <p class="text-center mt-2" style="font-size: 12px;">Không có sản phẩm nào trong giỏ hàng</p>
                                        @endif
                                        @isset($cartItems)
                                            @foreach ($cartItems as $item)
                                                <div class="product">
                                                    <div class="product-details">
                                                        <h4 class="product-title">
                                                            <a href="product.html">{{ $item->name }}</a>
                                                        </h4>
                                                        <span class="cart-product-info">
                                                            @if ($item->price_sale == 0)
                                                                <span class="cart-product-qty fs-3"
                                                                    style="font-size: 18px;">{{ number_format($item->price) . ' đ' }}</span>
                                                                × {{ $item->quantity }}
                                                            @else
                                                                <span class="cart-product-qty"
                                                                    style="text-decoration: line-through">{{ number_format($item->price) . ' đ' }}</span>
                                                                <span class="cart-product-qty fs-3"
                                                                    style="font-size: 18px;">{{ number_format($item->price_sale) . ' đ' }}</span>
                                                                × {{ $item->quantity }}
                                                            @endif
                                                        </span>

                                                    </div>
                                                    <!-- End .product-details -->
                                                    <figure class="product-image-container">
                                                        <a href="product.html" class="product-image">
                                                            <img src="{{ asset('storage/' . $item->thumbnail) }}"
                                                                alt="product" width="80" height="80">
                                                        </a>

                                                        {{-- <button onclick="removeCartItem({{$item->product_id}})" class="remove-cart-item">x</button> --}}

                                                        <span class="btn-remove" style="cursor: pointer"
                                                            onclick="removeCartItem({{ $item->product_id }})"
                                                            title="Remove Product"><span>×</span></span>
                                                    </figure>

                                                </div>
                                            @endforeach
                                        @endisset
                                    </div>
                                    <!-- End .cart-product -->

                                    <div class="dropdown-cart-total">
                                        <span>Tổng tiền: </span>
                                        @isset($cartItems)
                                            <span class="cart-total-price float-right"
                                                id="cart-total">{{ number_format($cartTotalMoney) . ' đ' }}</span>
                                        @endisset

                                    </div>
                                    <!-- End .dropdown-cart-total -->

                                    <div class="dropdown-cart-action" id="cart-action">
                                        @if ($cartItems->count() != 0)
                                            <a href="{{ route('cart') }}" class="btn btn-gray btn-block view-cart">Xem giỏ hàng</a>
                                            <a href="{{ route('client.checkout') }}" class="btn btn-dark btn-block">Thanh toán</a>
                                        @endif
                                    </div>
                                    <!-- End .dropdown-cart-total -->
                                </div>
                                <!-- End .dropdownmenu-wrapper -->
                            </div>
                            <!-- End .dropdown-menu -->
                        </div>
                    @endif
                @endauth

                @guest
                    <div class="dropdown cart-dropdown">
                        <a href="#" title="Cart" id="cartLogin"
                            class="dropdown-toggle dropdown-arrow cart-toggle" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" data-display="static">
                            <i class="minicart-icon"></i>
                        </a>
                    </div>
                @endguest
                <!-- End .dropdown -->
            </div>
            <!-- End .header-right -->
        </div>
        <!-- End .container -->
    </div>
    <!-- End .header-middle -->

    <div class="header-bottom sticky-header d-none d-lg-block" data-sticky-options="{'mobile': false}">
        <div class="container">
            <nav class="main-nav w-100">
                <ul class="menu">
                    <li class="mr-5 {{ Route::current()->getName() === 'home' ? 'active' : '' }}">
                        <a href="{{ route('home') }}">Trang chủ</a>
                    </li>
                    <li class="position-relative home__nav-item {{ Route::current()->getName() === 'client.category.index' ? 'active' : '' }}">
                        <a href="{{ route('home') }}">Danh mục <i class="fa-solid fa-chevron-down pl-2"></i></a>
                        <div class="border border-black position-absolute home__sub-nav-item bg-white d-none"
                            style="z-index: 100; width: 150px;">
                            @foreach ($categories as $category)
                                <a href="{{ route('client.category.index', $category) }}"
                                    class="d-block py-3 px-3">{{ $category->name }}</a>
                                <hr class="my-0">
                            @endforeach
                        </div>
                    </li>
                    <li class="position-relative home__nav-item mr-5">
                        <a href="{{ route('home') }}">Thương hiệu <i class="fa-solid fa-chevron-down pl-2"></i></a>
                        <div class="border border-black position-absolute home__sub-nav-item bg-white d-none"
                            style="z-index: 100; width: 160px;">
                            @foreach ($brands as $brand)
                                <a href="" class="d-block py-3 px-3">
                                    <div class="p-2">
                                        <img src="{{ asset('storage') }}/{{ $brand->logo }}" class="px-3"
                                            width="150" alt="brand">
                                    </div>
                                    {{-- {{$brand->name}} --}}
                                </a>
                                <hr class="my-0">
                            @endforeach
                        </div>
                    </li>
                    <li class="mr-5"><a href="blog.html">Blog</a></li>
                    <li class="mr-5"><a href="contact.html">Liên hệ</a></li>
                </ul>
            </nav>
        </div>
        <!-- End .container -->
    </div>
    <!-- End .header-bottom -->
</header>

@push('jsHandle')
    <script>
        let cartLogin = document.querySelector('#cartLogin');
        cartLogin.addEventListener("click", function() {
            Swal.fire({
                text: 'Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng',
                icon: 'warning',
                confirmButtonText: 'Đăng nhập',
                showCloseButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "http://127.0.0.1:8000/login";
                }
            });
        });
    </script>
@endpush
