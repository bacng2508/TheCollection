@extends('client.layouts.client_master')

@section('page-content')
    <div class="home-slider slide-animate owl-carousel owl-theme show-nav-hover nav-big mb-2 text-uppercase"
        data-owl-options="{
				'loop': false
			}">
        <div class="home-slide home-slide1 banner">
            <img class="slide-bg" src="{{ asset('storage') }}/upload/slider/banner_7.jpg" height="499" alt="slider image">
        </div>
    </div>
    <!-- End .home-slider -->

    <div class="container">
        <div class="info-boxes-slider owl-carousel owl-theme mb-2"
            data-owl-options="{
					'dots': false,
					'loop': false,
					'responsive': {
						'576': {
							'items': 2
						},
						'992': {
							'items': 3
						}
					}
				}">
            <div class="info-box info-box-icon-left">
                <i class="icon-shipping"></i>

                <div class="info-box-content">
                    <h4>Vận chuyển &amp; hoàn trả miễn phí</h4>
                    <p class="text-body">Miễn phí vận chuyển cho đơn hàng trên 1 triệu</p>
                </div>
                <!-- End .info-box-content -->
            </div>
            <!-- End .info-box -->

            <div class="info-box info-box-icon-left">
                {{-- <i class="icon-money"></i> --}}
                <i class="fa-solid fa-gears"></i>

                <div class="info-box-content">
                    <h4>Bảo hành tận nơi</h4>
                    <p class="text-body">Đội ngũ kỹ thuật sẽ hộ trợ ngay tại nhà</p>
                </div>
                <!-- End .info-box-content -->
            </div>
            <!-- End .info-box -->

            <div class="info-box info-box-icon-left">
                <i class="icon-support"></i>

                <div class="info-box-content">
                    <h4>HỖ TRỢ ONLINE 24/7</h4>
                    <p class="text-body">Cam kết hỗ trợ vào mọi khung giờ</p>
                </div>
                <!-- End .info-box-content -->
            </div>
            <!-- End .info-box -->
        </div>
        <!-- End .info-boxes-slider -->

        <div class="banners-container mb-2">
            <div class="banners-slider owl-carousel owl-theme" data-owl-options="{
						'dots': false
					}">
                <div class="banner banner1 banner-sm-vw d-flex align-items-center appear-animate"
                    style="background-color: #ccc;" data-animation-name="fadeInLeftShorter" data-animation-delay="500">
                    <figure class="w-100">
                        <img src="https://fridayshopping.vn/wp-content/uploads/2022/03/10-cach-chon-dong-ho-nam-dep-don-gian-va-phu-hop-nhat.jpg"
                            alt="banner" width="380" height="175" />
                    </figure>
                    <div class="banner-layer text-center">
                        <h3 class="m-b-2 text-white ">ĐỒNG HỒ NAM</h3>
                        {{-- <h4 class="m-b-3 text-primary"><sup class="text-dark"><del>20%</del></sup>30%<sup>OFF</sup></h4> --}}
                        <a href="{{ route('client.category.index', App\Models\Category::find(1)) }}"
                            class="btn btn-sm btn-dark">Mua ngay</a>
                    </div>
                </div>
                <!-- End .banner -->

                <div class="banner banner2 banner-sm-vw text-uppercase d-flex align-items-center appear-animate"
                    data-animation-name="fadeInUpShorter" data-animation-delay="200">
                    <figure class="w-100">
                        <img src="https://fado.vn/blog/wp-content/uploads/2022/11/mua-do%CC%82%CC%80ng-ho%CC%82%CC%80-nu%CC%9B%CC%83-ma%CC%A3%CC%86t-chu%CC%9B%CC%83-nha%CC%A3%CC%82t-co%CC%82%CC%89-die%CC%82%CC%89n.jpg"
                            style="background-color: #ccc;" class="border-0" alt="banner" width="380" height="175" />
                    </figure>
                    <div class="banner-layer text-center">
                        <h3 class="m-b-2 text-white ">ĐỒNG HỒ NỮ</h3>
                        <a href="{{ route('client.category.index', App\Models\Category::find(2)) }}"
                            class="btn btn-sm btn-dark">Mua ngay</a>
                    </div>
                </div>
                <!-- End .banner -->

                <div class="banner banner3 banner-sm-vw d-flex align-items-center appear-animate"
                    style="background-color: #ccc;" data-animation-name="fadeInRightShorter" data-animation-delay="500">
                    <figure class="w-100">
                        <img src="https://mediaelly.sgp1.digitaloceanspaces.com/uploads/2022/05/20124721/tim-hieu-so-luoc-ve-thiet-ke-cua-dong-ho-unisex-hien-nay.2.jpg"
                            alt="banner" width="380" height="175" />
                    </figure>
                    <div class="banner-layer text-center">
                        <h3 class="m-b-2 text-white ">ĐỒNG HỒ UNISEX</h3>
                        <a href="{{ route('client.category.index', App\Models\Category::find(3)) }}"
                            class="btn btn-sm btn-dark">Mua ngay</a>
                    </div>
                </div>
                <!-- End .banner -->
            </div>
        </div>
    </div>
    <!-- End .container -->

    <section class="featured-products-section pt-4 pb-0">
        <div class="container">
            <h2 class="section-title heading-border ls-20 border-0 mb-4">THƯƠNG HIỆU</h2>

            <div class="brands-slider owl-carousel owl-theme images-center appear-animate" data-animation-name="fadeIn"
                data-animation-duration="500" data-owl-options="{
					'margin': 0}">
                @foreach ($brands as $brand)
                    <img src="{{ asset('storage') }}/{{ $brand->logo }}" class="px-3" width="130" height="56"
                        alt="brand">
                @endforeach
            </div>
            <!-- End .featured-proucts -->
        </div>
    </section>

    <section class="featured-products-section">
        <div class="container">
            <h2 class="section-title heading-border ls-20 border-0 mb-4">Sản phẩm nổi bật</h2>

            <div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center"
                data-owl-options="{
						'dots': false,
						'nav': true
					}">
                @foreach ($featureProducts as $featureProduct)
                    <div class="product-default appear-animate" data-animation-name="fadeInRightShorter">
                        <figure>
                            <a href="{{ route('client.product.detail', $featureProduct) }}">
                                <img src="{{ asset('storage/' . $featureProduct->thumbnail) }}" width="280" height="280" alt="product">
                            </a>
                            <div class="label-group">
                                @if ($featureProduct->is_featured)
                                    <div class="product-label label-hot">HOT</div>
                                @endif
                                @if ($featureProduct->price_sale != 0)
                                    <div class="product-label label-sale">
                                        {{ '-' . (1 - $featureProduct->price_sale / $featureProduct->price) * 100 . '%' }}</div>
                                @endif
                            </div>
                        </figure>
                        <div class="product-details">
                            <h3 class="product-title">
                                <a href="product.html">{{ $featureProduct->name }}</a>
                            </h3>
                            <!-- End .product-container -->
                            <div class="price-box">
                                @if ($featureProduct->price_sale == 0)
                                    <span
                                        class="product-price d-inline-block mb-2">{{ number_format($featureProduct->price) . ' đ' }}</span>
                                @else
                                    <div class="text-center">
                                        <span
                                            class="product-price">{{ number_format($featureProduct->price_sale) . ' đ' }}</span><br>
                                        <span class="product-price font-weight-normal d-inline-block mt-1"
                                            style="text-decoration: line-through; font-size: 12px">{{ number_format($featureProduct->price) . ' đ' }}</span>
                                    </div>
                                @endif
                            </div>
                            <!-- End .price-box -->
                            <div class="product-action">
                                @if (Auth::check())
                                    <button class="btn-icon btn-add-cart addToCart"
                                        onclick="addToCart(true,{{ $featureProduct->id }})"><i
                                            class="fa fa-arrow-right"></i><span>Thêm vào giỏ hàng</span></button>
                                    <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i
                                            class="fas fa-external-link-alt"></i></a>
                                @else
                                    <button class="btn-icon btn-add-cart addToCart"
                                        onclick="addToCart(false,{{ $featureProduct->id }})"><i
                                            class="fa fa-arrow-right"></i><span>Thêm vào giỏ hàng</span></button>
                                @endif
                            </div>
                        </div>
                        <!-- End .product-details -->
                    </div>
                @endforeach
            </div>
            <!-- End .featured-proucts -->
        </div>
    </section>

    <section class="new-products-section">
        <div class="container">
            <h2 class="section-title heading-border ls-20 border-0 mb-4">Sản phẩm khuyến mại</h2>

            <div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center"
                data-owl-options="{
						'dots': false,
						'nav': true
					}">


                @foreach ($saleProducts as $saleProduct)
                    <div class="product-default appear-animate" data-animation-name="fadeInRightShorter">
                        <figure>
                            <a href="{{ route('client.product.detail', $saleProduct) }}">
                                <img src="{{ asset('storage/' . $saleProduct->thumbnail) }}" width="280"
                                    height="280" alt="product">
                            </a>
                            <div class="label-group">
                                <div class="product-label label-hot">HOT</div>
                                @if ($saleProduct->price_sale != 0)
                                    <div class="product-label label-sale">
                                        {{ '-' . (1 - $saleProduct->price_sale / $saleProduct->price) * 100 . '%' }}</div>
                                @endif
                            </div>
                        </figure>
                        <div class="product-details">
                            <h3 class="product-title">
                                <a href="product.html">{{ $saleProduct->name }}</a>
                            </h3>
                            <!-- End .product-container -->
                            <div class="price-box">
                                @if ($saleProduct->price_sale == 0)
                                    <span
                                        class="product-price d-inline-block mb-2">{{ number_format($saleProduct->price) . ' đ' }}</span>
                                @else
                                    <div class="text-center">
                                        <span
                                            class="product-price">{{ number_format($saleProduct->price_sale) . ' đ' }}</span><br>
                                        <span class="product-price font-weight-normal d-inline-block mt-1"
                                            style="text-decoration: line-through; font-size: 12px">{{ number_format($saleProduct->price) . ' đ' }}</span>
                                    </div>
                                @endif
                            </div>
                            <!-- End .price-box -->
                            <div class="product-action">
                                @if (Auth::check())
                                    <button class="btn-icon btn-add-cart addToCart"
                                        onclick="addToCart(true,{{ $saleProduct->id }})"><i
                                            class="fa fa-arrow-right"></i><span>Thêm vào giỏ hàng</span></button>
                                    <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i
                                            class="fas fa-external-link-alt"></i></a>
                                @else
                                    <button class="btn-icon btn-add-cart addToCart"
                                        onclick="addToCart(false,{{ $saleProduct->id }})"><i
                                            class="fa fa-arrow-right"></i><span>Thêm vào giỏ hàng</span></button>
                                @endif
                            </div>
                        </div>
                        <!-- End .product-details -->
                    </div>
                @endforeach

                
            </div>
        </div>
    </section>

    <section class="feature-boxes-container">
        <div class="container appear-animate" data-animation-name="fadeInUpShorter">
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-box px-sm-5 feature-box-simple text-center">
                        <div class="feature-box-icon">
                            <i class="icon-earphones-alt"></i>
                        </div>

                        <div class="feature-box-content p-0">
                            <h3>Hỗ trợ khác hàng</h3>
                            <h5>Đội ngũ tận tình</h5>
                        </div>
                        <!-- End .feature-box-content -->
                    </div>
                    <!-- End .feature-box -->
                </div>
                <!-- End .col-md-4 -->

                <div class="col-md-4">
                    <div class="feature-box px-sm-5 feature-box-simple text-center">
                        <div class="feature-box-icon">
                            <i class="icon-credit-card"></i>
                        </div>

                        <div class="feature-box-content p-0">
                            <h3>Thanh toán thuận tiện</h3>
                            <h5>Nhiều tùy chọn thanh toán</h5>

                            {{-- <p>With Porto you can customize the layout, colors and styles within only a few minutes. Start
                                creating an amazing website right now!</p> --}}
                        </div>
                        <!-- End .feature-box-content -->
                    </div>
                    <!-- End .feature-box -->
                </div>
                <!-- End .col-md-4 -->

                <div class="col-md-4">
                    <div class="feature-box px-sm-5 feature-box-simple text-center">
                        <div class="feature-box-icon">
                            {{-- <i class="icon-action-undo"></i> --}}
                            <i class="fa-solid fa-hand-holding-dollar"></i>
                        </div>
                        <div class="feature-box-content p-0">
                            <h3>Khuyến mãi hàng tuần</h3>
                            <h5>Vô vàn khuyến mãi mỗi tuần</h5>

                            {{-- <p>Porto has very powerful admin features to help customer to build their own shop in minutes
                                without any special skills in web development.</p> --}}
                        </div>
                        <!-- End .feature-box-content -->
                    </div>
                    <!-- End .feature-box -->
                </div>
                <!-- End .col-md-4 -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container-->
    </section>
    <!-- End .feature-boxes-container -->

    <section class="promo-section bg-dark" data-parallax="{'speed': 2, 'enableOnMobile': true}"
        data-image-src="{{ asset('frontend') }}/assets/images/demoes/demo4/banners/banner-5.jpg">
        <div class="promo-banner banner container text-uppercase">
            <div class="banner-content row align-items-center text-center">
                <div class="col-md-4 ml-xl-auto text-md-right appear-animate" data-animation-name="fadeInRightShorter"
                    data-animation-delay="600">
                    <h2 class="mb-md-0 text-white">TOP xu hướng<br></h2>
                </div>
                <div class="col-md-4 col-xl-3 pb-4 pb-md-0 appear-animate" data-animation-name="fadeIn"
                    data-animation-delay="300">
                    <a href="category.html" class="btn btn-dark btn-black ls-10">Xem khuyến mãi</a>
                </div>
                <div class="col-md-4 mr-xl-auto text-md-left appear-animate" data-animation-name="fadeInLeftShorter"
                    data-animation-delay="600">
                    <h4 class="mb-1 mt-1 font1 coupon-sale-text p-0 d-block ls-n-10 text-transform-none">
                        <b>Mã giảm giá có giới hạn</b>
                    </h4>
                    <h5 class="mb-1 coupon-sale-text text-white ls-10 p-0"><i class="ls-0">Lên tới</i><b
                            class="text-white bg-secondary ls-n-10">1 triệu đồng</b></h5>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-section pb-0">
        <div class="container">
            <h2 class="section-title heading-border border-0 appear-animate pb-3" data-animation-name="fadeInUp">
                Tin mới</h2>

            <div class="owl-carousel owl-theme appear-animate" data-animation-name="fadeIn"
                data-owl-options="{
						'loop': false,
						'margin': 20,
						'autoHeight': true,
						'autoplay': false,
						'dots': false,
						'items': 2,
						'responsive': {
							'0': {
								'items': 1
							},
							'480': {
								'items': 2
							},
							'576': {
								'items': 3
							},
							'768': {
								'items': 4
							}
						}
					}">
                <article class="post">
                    <div class="post-media">
                        <a href="single.html">
                            <img src="https://i1-vnexpress.vnecdn.net/2024/05/02/waterclockset-1714639788-2771-1714639792.jpg?w=500&h=300&q=100&dpr=1&fit=crop&s=0hBqkpUF2x3s8GOCbe_g7Q" alt="Post"
                                width="225" height="280">
                        </a>
                        <div class="post-date" style="width: 75px;">
                            <span class="day">1</span>
                            <span class="month">Tháng 5</span>
                        </div>
                    </div>
                    <!-- End .post-media -->

                    <div class="post-body">
                        <h2 class="post-title">
                            <a href="single.html">Mạng lưới ngầm vận hành hàng nghìn đồng hồ khắp Paris</a>
                        </h2>
                        <div class="post-content">
                            <p>Thế kỷ 19, mạng lưới đồ sộ gồm đồng hồ chủ, hàng loạt đường khí nén ngầm và đồng hồ nhỏ giúp người Paris theo dõi thời gian chính xác. </p>
                        </div>
                        <!-- End .post-content -->
                        <a href="single.html" class="post-comment">0 bình luận</a>
                    </div>
                    <!-- End .post-body -->
                </article>
                <!-- End .post -->

                <article class="post">
                    <div class="post-media">
                        <a href="single.html">
                            <img src="https://i1-giaitri.vnecdn.net/2024/04/19/image1539781300extractword6out-726262-1713251773-1713512022.jpeg?w=500&h=300&q=100&dpr=1&fit=crop&s=VQBosd-OEyf6FtGdD7ZRuQ" alt="Post"
                                width="225" height="280">
                        </a>
                        <div class="post-date" style="width: 75px;">
                            <span class="day">4</span>
                            <span class="month">Tháng 5</span>
                        </div>
                    </div>
                    <!-- End .post-media -->

                    <div class="post-body">
                        <h2 class="post-title">
                            <a href="single.html">Tạo tác thời gian xa xỉ tại Watches & Wonders 2024</a>
                        </h2>
                        <div class="post-content">
                            <p>Hermès bổ sung vào BST đồng hồ tạo phẩm mới Hermès Cut, hòa cùng xu thế “xa xỉ thầm lặng”, đáp ứng nhu cầu đa dạng của phái đẹp. </p>
                        </div>
                        <!-- End .post-content -->
                        <a href="single.html" class="post-comment">0 bình luận</a>
                    </div>
                    <!-- End .post-body -->
                </article>
                <!-- End .post -->

                <article class="post">
                    <div class="post-media">
                        <a href="single.html">
                            <img src="https://i1-vnexpress.vnecdn.net/2024/03/20/Donghobonglanset-1710930677-3499-1710931297.jpg?w=500&h=300&q=100&dpr=1&fit=crop&s=9QxVDkrQfaaKkrPKmGfUHg" alt="Post"
                                width="225" height="280">
                        </a>
                        <div class="post-date" style="width: 75px;">
                            <span class="day">4</span>
                            <span class="month">Tháng 5</span>
                        </div>
                    </div>
                    <!-- End .post-media -->

                    <div class="post-body">
                        <h2 class="post-title">
                            <a href="single.html">Đồng hồ đo thời gian bằng bóng lăn thế kỷ 19</a>
                        </h2>
                        <div class="post-content">
                            <p>Khác với đồng hồ quả lắc phổ biến 200 năm trước, đồng hồ của nhà phát minh William Congreve đo thời gian bằng sự di chuyển của quả bóng nhỏ.</p>
                        </div>
                        <!-- End .post-content -->
                        <a href="single.html" class="post-comment">0 bình luận</a>
                    </div>
                    <!-- End .post-body -->
                </article>
                <!-- End .post -->

                <article class="post">
                    <div class="post-media">
                        <a href="single.html">
                            <img src="https://i1-kinhdoanh.vnecdn.net/2023/11/30/settop-1701332064-7592-1701333787.jpg?w=500&h=300&q=100&dpr=1&fit=crop&s=KmGFM25cjXuGwjxj97f7XQ" alt="Post"
                                width="225" height="280">
                        </a>
                        <div class="post-date" style="width: 75px;">
                            <span class="day">5</span>
                            <span class="month">Tháng 6</span>
                        </div>
                    </div>
                    <!-- End .post-media -->

                    <div class="post-body">
                        <h2 class="post-title">
                            <a href="single.html">Hơn 200 năm tôn vinh nghệ thuật độc bản của Bovet 1822</a>
                        </h2>
                        <div class="post-content">
                            <p>Suốt bề dày lịch sử hơn 200 năm, Bovet 1822 trung thành với lối chế tác đồng hồ tinh xảo, kết hợp sự sáng tạo, mang đậm dấu ấn cá nhân cho chủ sở hữu. </p>
                        </div>
                        <!-- End .post-content -->
                        <a href="single.html" class="post-comment">0 bình luận</a>
                    </div>
                    <!-- End .post-body -->
                </article>
                <!-- End .post -->
            </div>

            {{-- <hr class="mt-0 m-b-5"> --}}

            <!-- End .row -->
        </div>

        <template id="my-template">

            <swal-title>
                Save changes to "Untitled 1" before closing?
            </swal-title>
            <swal-icon type="warning" color="red"></swal-icon>
            <swal-button type="confirm">
                <a href="#" class=""></a>
            </swal-button>
            <swal-button type="cancel">
                <a href="#" class="btn btn-primary">Chuyển đến đăng nhập</a>
            </swal-button>
            <swal-button type="deny">
                Close without Saving
            </swal-button>
            <swal-param name="allowEscapeKey" value="false" />
            <swal-param name="customClass" value='{ "popup": "my-popup" }' />
            <swal-function-param name="didOpen" value="popup => console.log(popup)" />
            <a href=""></a>
        </template>
    </section>
@endsection

@push('jsHandle')
    <script type="text/javascript">
        toastr.options.progressBar = true;
        toastr.options.closeButton = true;
        toastr.options.showEasing = 'swing';

        let cart = document.querySelector('#mini-cart');
        let cartTotal = document.querySelector('#cart-total');
        let cartCount = document.querySelector('#cart-count');
        let cartAction = document.querySelector('#cart-action');

        function addToCart(isAuthenticated, id, quantity = 1) {
            if (!isAuthenticated) {
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
            } else {
                $.ajax({
                    url: "/cart/store",
                    type: "GET",
                    data: {
                        id,
                        quantity
                    },
                    dataType: "json",
                    success: function(data) {
                        let htmlCartItems = "";
                        let totalMoney = 0;

                        (data.cartItems).forEach(element => {
                            let priceHTML = "";
                            if (element.price_sale != 0) {
                                priceHTML = `
                                    <span class='cart-product-qty' style='text-decoration: line-through'>${formatCash((element.price).toString())}</span>
                                    <span class="cart-product-qty fs-3" style="font-size: 18px;">${formatCash((element.price_sale).toString())}</span> × ${element.quantity} 
                                `;
                            } else {
                                priceHTML = `
                                    <span class="cart-product-qty fs-3" style="font-size: 18px;">${formatCash((element.price).toString())}</span> × ${element.quantity} 
                                `;
                            }

                            htmlCartItems +=
                                `
                                    <div class="product">
                                        <div class="product-details">
                                            <h4 class="product-title">
                                                <a href="product.html">${element.name}</a>
                                            </h4>
                                            <span class="cart-product-info">
                                                ${priceHTML}
                                            </span>

                                        </div>

                                        <figure class="product-image-container">
                                            <a href="product.html" class="product-image">
                                                <img src="{{ asset('storage') }}/${element.thumbnail}"
                                                    alt="product" width="80" height="80">
                                            </a>

                                            <span class="btn-remove" style="cursor: pointer" onclick="removeCartItem(${element.product_id})"
                                                title="Remove Product"><span>×</span></span>
                                        </figure>

                                    </div>
                                `;
                            totalMoney += ((element.price_sale != 0 ? element.price_sale : element
                                .price) * element.quantity);
                        });

                        cart.innerHTML = htmlCartItems;

                        cartAction.innerHTML = `
                            <a href="{{ route('cart') }}" class="btn btn-gray btn-block view-cart">Xem giỏ hàng</a>
                            <a href="{{ route('client.checkout') }}" class="btn btn-dark btn-block">Thanh toán</a>
                        `;

                        cartTotal.textContent = formatCash((totalMoney).toString());
                        cartCount.textContent = data.cartItems.length;


                        toastr.success('Sản phẩm đã được thêm vào giỏ hàng');
                    }
                });
            }

        }

        function removeCartItem(id) {
            $.ajax({
                url: "/cart/destroy/",
                data: {
                    id
                },
                method: "GET",
                success: function(data) {
                    let htmlCartItems = "";
                    let totalMoney = 0;
                    (data).forEach(element => {
                        let priceHTML = "";
                        if (element.price_sale != 0) {
                            priceHTML = `
                                <span class='cart-product-qty' style='text-decoration: line-through'>${formatCash((element.price).toString())}</span>
                                <span class="cart-product-qty fs-3" style="font-size: 18px;">${formatCash((element.price_sale).toString())}</span> × ${element.quantity} 
                            `;
                        } else {
                            priceHTML = `
                                <span class="cart-product-qty fs-3" style="font-size: 18px;">${formatCash((element.price).toString())}</span> × ${element.quantity} 
                            `;
                        }

                        htmlCartItems +=
                            `
                            <div class="product">
                                <div class="product-details">
                                    <h4 class="product-title">
                                        <a href="product.html">${element.name}</a>
                                    </h4>
                                    <span class="cart-product-info">
                                        ${priceHTML}
                                    </span>

                                </div>

                                <figure class="product-image-container">
                                    <a href="product.html" class="product-image">
                                        <img src="{{ asset('storage') }}/${element.thumbnail}"
                                            alt="product" width="80" height="80">
                                    </a>

                                    <span class="btn-remove" style="cursor: pointer" onclick="removeCartItem(${element.product_id})"
                                            title="Remove Product"><span>×</span></span>
                                </figure>

                            </div>
                            `
                        totalMoney += ((element.price_sale != 0 ? element.price_sale : element.price) *
                            element.quantity);
                    });


                    if (data.length > 0) {
                        cart.innerHTML = htmlCartItems;
                        cartAction.innerHTML = `
                            <a href="{{ route('cart') }}" class="btn btn-gray btn-block view-cart">Xem giỏ hàng</a>
                            <a href="{{ route('client.checkout') }}" class="btn btn-dark btn-block">Thanh toán</a>
                        `;
                    } else {
                        cart.innerHTML =
                            '<p class="text-center mt-2" style="font-size: 12px;">Không có sản phẩm nào trong giỏ hàng</p>';
                        cartAction.innerHTML = "";
                    }
                    cartTotal.textContent = formatCash((totalMoney).toString());
                    cartCount.textContent = data.length;
                }
            });
        }
    </script>
@endpush
