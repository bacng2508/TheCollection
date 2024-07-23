@extends('client.layouts.client_master')

@section('page-content')
    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="demo4.html"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="#">Chi tiết sản phẩm</a></li>
            </ol>
        </nav>

        <div class="product-single-container product-single-default">
            <div class="cart-message d-none">
                <strong class="single-cart-notice">“Men Black Sports Shoes”</strong>
                <span>has been added to your cart.</span>
            </div>

            <div class="row">
                <div class="col-lg-5 col-md-6 product-single-gallery">
                    <div class="product-slider-container">
                        <div class="label-group">
                            @if ($product->is_featured)
                                <div class="product-label label-hot">HOT</div>
                            @endif
                            @if ($product->price_sale != 0)
                                <div class="product-label label-sale">
                                    {{ '-' . (1 - $product->price_sale / $product->price) * 100 . '%' }}</div>
                            @endif
                        </div>

                        <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                            <div class="product-item">
                                <img class="product-single-image" src="{{ asset('storage/' . $product->thumbnail) }}"
                                    width="468" height="468" alt="product" />
                            </div>
                        </div>
                        <!-- End .product-single-carousel -->
                        <span class="prod-full-screen">
                            <i class="icon-plus"></i>
                        </span>
                    </div>
                </div>
                <!-- End .product-single-gallery -->

                <div class="col-lg-7 col-md-6 product-single-details">
                    <h1 class="product-title">{{ $product->name }}</h1>

                    <div class="ratings-container">
                        <div class="product-ratings">
                            @if ($reviews->count() != 0)
                                <span class="ratings" style="width:{{($reviews->sum('rating')/($reviews->count()*5))*100}}%"></span>
                            @else
                                <span class="ratings" style="width:0%"></span>
                            @endif
                                
                            
                            <!-- End .ratings -->
                            <span class="tooltiptext tooltip-top"></span>
                        </div>
                        <!-- End .product-ratings -->

                        <a href="#" class="rating-link">( {{$reviews->count()}} đánh giá )</a>
                    </div>
                    <!-- End .ratings-container -->

                    <hr class="short-divider">

                    <div class="price-box">
                        @if ($product->price_sale != 0)
                            <span class="old-price">{{ number_format($product->price) . ' đ' }}</span>
                            <span class="new-price">{{ number_format($product->price_sale) . ' đ' }}</span>
                        @else
                            <span class="new-price">{{ number_format($product->price) . ' đ' }}</span>
                        @endif
                    </div>
                    <!-- End .price-box -->

                    <div class="product-desc">
                        <p>
                            {!! $product->description !!}
                        </p>
                    </div>
                    <!-- End .product-desc -->

                    <ul class="single-info-list">

                        {{-- <li>
                            SKU: <strong>654613612</strong>
                        </li> --}}

                        <li>
                            Danh mục: <strong><a href="#"
                                    class="product-category">{{ $product->category->name }}</a></strong>
                        </li>

                        {{-- <li>
                            TAGs: <strong><a href="#" class="product-category">CLOTHES</a></strong>,
                            <strong><a href="#" class="product-category">SWEATER</a></strong>
                        </li> --}}
                    </ul>

                    <div class="product-action">
                        <div class="product-single-qty">
                            <input class="horizontal-quantity form-control" id="product_quantity" type="number">
                        </div>
                        <!-- End .product-single-qty -->

                        @if (Auth::check())
                            <button class="btn btn-dark mr-2" onclick="addToCart(true, {{ $product->id }})">Thêm vào giỏ
                                hàng</button>
                        @else
                            <button class="btn btn-dark mr-2" onclick="addToCart(false, {{ $product->id }})">Thêm vào giỏ
                                hàng</button>
                        @endif


                        {{-- <a href="cart.html" class="btn btn-gray view-cart d-none">View cart</a> --}}
                    </div>
                    <!-- End .product-action -->

                    <hr class="divider mb-0 mt-0">

                    <!-- End .product single-share -->
                </div>
                <!-- End .product-single-details -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .product-single-container -->

        <div class="product-single-tabs">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content"
                        role="tab" aria-controls="product-desc-content" aria-selected="true">Thông tin chi tiết</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="product-tab-size" data-toggle="tab" href="#product-size-content" role="tab"
                        aria-controls="product-size-content" aria-selected="true">Hướng dẫn chọn size</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="product-tab-reviews" data-toggle="tab" href="#product-reviews-content"
                        role="tab" aria-controls="product-reviews-content" aria-selected="false">Đánh giá ({{$reviews->count()}})</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel"
                    aria-labelledby="product-tab-desc">
                    <div class="product-desc-content text-center">
                        <div class="d-flex justify-content-center">
                            <table class="table table-bordered" style="width: 50%">
                                <thead>
                                    <tr>
                                        <th scope="col" width="40%">Thông số</th>
                                        <th scope="col" width="60%">chi tiết</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Thương hiệu</th>
                                        <td>{{ $product->brand->name }}</td>
                                    </tr>
                                    @foreach ($productAttributeOptions as $productAttributeOption)
                                        <tr>
                                            <th>{{ $productAttributeOption->attributeOption->attribute->name }}</th>
                                            <td>{{ $productAttributeOption->attributeOption->value }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- End .product-desc-content -->
                </div>
                <!-- End .tab-pane -->

                <div class="tab-pane fade" id="product-size-content" role="tabpanel" aria-labelledby="product-tab-size">
                    <div class="product-size-content">
                        <h3>Cách đo và chọn size đồng hồ theo kích thước cổ tay</h3>

                        <p><strong>Bước 1:</strong> Đo “size tay” của bạn (Chu vi cổ tay) theo 1 trong 2 cách:</p>

                        <ul>
                            <li>Cách 1: Dùng thước dây đo 1 vòng quanh cổ tay tại vị trí đeo đồng hồ.</li>
                            <li>Cách 2: Dùng một tờ giấy quấn quanh cổ tay và đánh dấu. Sau đó, đo lại bằng thước kẻ
                                thông thường.</li>
                        </ul>

                        <div class="wp-block-image">
                            <figure class="aligncenter"><img class="entered pmloaded lazy-load-active" decoding="async"
                                    src="https://image.donghohaitrieu.com/wp-content/uploads/2023/09/cach-chon-mua-dong-ho-deo-tay-nam-phu-hop-voi-ban-2.jpg"
                                    data-src="https://image.donghohaitrieu.com/wp-content/uploads/2023/09/cach-chon-mua-dong-ho-deo-tay-nam-phu-hop-voi-ban-2.jpg"
                                    alt="cach chon mua dong ho deo tay nam phu hop voi ban 2" data-ll-status="loaded">
                            </figure>
                        </div>

                        <p class="text-center"><em>Cách đo chu vi cổ tay bằng thước dây</em></p>
                        <p class="has-text-align-left"><strong>Bước 2:</strong> Sau khi xác định được chu vi cổ tay,
                            bạn dùng nó để đối chiếu với bảng Size đồng hồ đeo tay ở bên dưới (áp dụng cho nam và nữ)
                        </p>

                        <div class="wp-block-image">
                            <figure class="aligncenter"><img class="entered pmloaded lazy-load-active" decoding="async"
                                    src="https://image.donghohaitrieu.com/wp-content/uploads/2023/09/cach-chon-mua-dong-ho-deo-tay-nam-phu-hop-voi-ban-3.jpg"
                                    data-src="https://image.donghohaitrieu.com/wp-content/uploads/2023/09/cach-chon-mua-dong-ho-deo-tay-nam-phu-hop-voi-ban-3.jpg"
                                    alt="Bảng kích cỡ đồng hồ cho chu vi cổ tay từ 13 - 15.5 cm" data-ll-status="loaded">
                            </figure>
                        </div>

                        <p class="text-center"><em>Bảng size đồng hồ cho tay có chu vi từ 13 – 15.5 cm</em></p>
                        <div class="wp-block-image">
                            <figure class="aligncenter"><img class="entered pmloaded lazy-load-active" decoding="async"
                                    src="https://image.donghohaitrieu.com/wp-content/uploads/2023/09/cach-chon-mua-dong-ho-deo-tay-nam-phu-hop-voi-ban-4.jpg"
                                    data-src="https://image.donghohaitrieu.com/wp-content/uploads/2023/09/cach-chon-mua-dong-ho-deo-tay-nam-phu-hop-voi-ban-4.jpg"
                                    alt="Bảng kích cỡ đồng hồ cho chu vi cổ tay từ 16 - 18.5 cm" data-ll-status="loaded">
                            </figure>
                        </div>

                        <p class="text-center"><em>Bảng size đồng hồ cho tay có chu vi từ 16 – 18.5 cm</em>
                        </p>

                        <div class="wp-block-image">
                            <figure class="aligncenter"><img class="entered pmloaded lazy-load-active" decoding="async"
                                    src="https://image.donghohaitrieu.com/wp-content/uploads/2023/09/cach-chon-mua-dong-ho-deo-tay-nam-phu-hop-voi-ban-5.jpg"
                                    data-src="https://image.donghohaitrieu.com/wp-content/uploads/2023/09/cach-chon-mua-dong-ho-deo-tay-nam-phu-hop-voi-ban-5.jpg"
                                    alt="Bảng kích cỡ đồng hồ cho chu vi cổ tay từ 19 - 21.5 cm" data-ll-status="loaded">
                            </figure>
                        </div>

                        <p class="text-center"><em>Bảng size đồng hồ cho tay có chu vi từ 19 – 21.5 cm</em>
                        </p>
                        {{-- <div class="row">
                        </div> --}}
                        <!-- End .row -->
                    </div>
                    <!-- End .product-size-content -->
                </div>
                <!-- End .tab-pane -->

                <div class="tab-pane fade" id="product-tags-content" role="tabpanel" aria-labelledby="product-tab-tags">
                    <table class="table table-striped mt-2">
                        <tbody>
                            <tr>
                                <th>Weight</th>
                                <td>23 kg</td>
                            </tr>

                            <tr>
                                <th>Dimensions</th>
                                <td>12 × 24 × 35 cm</td>
                            </tr>

                            <tr>
                                <th>Color</th>
                                <td>Black, Green, Indigo</td>
                            </tr>

                            <tr>
                                <th>Size</th>
                                <td>Large, Medium, Small</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- End .tab-pane -->

                <div class="tab-pane fade" id="product-reviews-content" role="tabpanel"
                    aria-labelledby="product-tab-reviews">
                    <div class="product-reviews-content">
                        <h3 class="reviews-title">{{$reviews->count()}} đánh giá với sản phẩm {{ $product->name }}</h3>

                        <div class="comment-list">
                            @foreach ($reviews as $key => $review)
                                <div class="comments {{$key+1 != $reviews->count() ? 'mb-2' : ''}}">
                                    <figure class="img-thumbnail">
                                        <img src="{{ asset('storage/' . $review->user->avatar) }}" alt="author"
                                            width="80" height="80">
                                    </figure>

                                    <div class="comment-block">
                                        <div class="comment-header">
                                            <div class="comment-arrow"></div>
                                            <div class="ratings-container float-sm-right">
                                                <div class="product-ratings">
                                                    <span class="ratings" style="width:{{$review->rating*2*10}}%"></span>
                                                    <!-- End .ratings -->
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                                <!-- End .product-ratings -->
                                            </div>

                                            <span class="comment-by">
                                                <strong>{{$review->user->name}}</strong> – {{date('d/m/Y ',strtotime($review->created_at))}}
                                            </span>
                                        </div>

                                        <div class="comment-content">
                                            <p>{{$review->content}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                        @if ($wasBoughtByUser)
                            <div class="divider"></div>
                            <div class="add-product-review">
                                <h3 class="review-title">Viết đánh giá</h3>

                                <form action="{{ route('client.review.store', $product) }}" class="comment-form m-0"
                                    method="POST">
                                    @csrf
                                    <div class="rating-form">
                                        <div class="mb-2">
                                            <label for="rating">Xếp hạng của bạn <span
                                                    class="text-danger">*</span></label>
                                            <span class="rating-stars">
                                                <a class="star-1" href="#">1</a>
                                                <a class="star-2" href="#">2</a>
                                                <a class="star-3" href="#">3</a>
                                                <a class="star-4" href="#">4</a>
                                                <a class="star-5" href="#">5</a>
                                            </span>
                                            @error('rating')
                                                <div class="form-text text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <select name="rating" id="rating" style="display: none;">
                                            <option value="">Rate…</option>
                                            <option value="5">Perfect</option>
                                            <option value="4">Good</option>
                                            <option value="3">Average</option>
                                            <option value="2">Not that bad</option>
                                            <option value="1">Very poor</option>
                                        </select>

                                    </div>

                                    <div class="form-group">
                                        <label>Nội dung đánh giá <span class="text-danger">*</span></label>
                                        <textarea cols="5" rows="6" class="form-control form-control-sm mb-1" name="content"></textarea>
                                        @error('content')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- End .form-group -->

                                    <div class="text-right">
                                        <button class="btn btn-primary">Gửi đánh giá</button>
                                    </div>
                                </form>
                            </div>
                        @endif

                        <!-- End .add-product-review -->
                    </div>
                    <!-- End .product-reviews-content -->
                </div>
                <!-- End .tab-pane -->
            </div>
            <!-- End .tab-content -->
        </div>
        <!-- End .product-single-tabs -->

        <div class="products-section pt-0">
            <h2 class="section-title">Sản phẩm liên quan</h2>

            <div class="products-slider owl-carousel owl-theme dots-top dots-small">
                @foreach ($relateProducts as $relateProduct)
                    <div class="product-default">
                        <figure>
                            <a href="product.html">
                                <img src="{{ asset('storage/' . $relateProduct->thumbnail) }}" width="150"
                                    alt="product">
                            </a>
                            <div class="label-group">
                                @if ($product->is_featured)
                                    <div class="product-label label-hot">HOT</div>
                                @endif
                                @if ($product->price_sale != 0)
                                    <div class="product-label label-sale">
                                        {{ '-' . (1 - $product->price_sale / $product->price) * 100 . '%' }}</div>
                                @endif
                            </div>
                        </figure>
                        <div class="product-details">
                            <h3 class="product-title">
                                <a href="product.html">{{ $relateProduct->name }}</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:80%"></span>
                                    <!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <!-- End .product-ratings -->
                            </div>
                            <!-- End .product-container -->
                            <div class="price-box mb-1">
                                @if ($relateProduct->price_sale == 0)
                                    <span
                                        class="product-price d-inline-block mb-2">{{ number_format($relateProduct->price) . ' đ' }}</span>
                                @else
                                    <div class="text-center">
                                        <span
                                            class="product-price">{{ number_format($relateProduct->price_sale) . ' đ' }}</span><br>
                                        <span class="product-price font-weight-normal d-inline-block mt-1"
                                            style="text-decoration: line-through; font-size: 12px">{{ number_format($relateProduct->price) . ' đ' }}</span>
                                    </div>
                                @endif
                            </div>
                            <!-- End .price-box -->
                            <div class="product-action">
                                @if (Auth::check())
                                    <button class="btn-icon btn-add-cart addToCart"
                                        onclick="addToCart(true,{{ $product->id }})"><i
                                            class="fa fa-arrow-right"></i><span>Thêm vào giỏ hàng</span></button>
                                    <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i
                                            class="fas fa-external-link-alt"></i></a>
                                @else
                                    <button class="btn-icon btn-add-cart addToCart"
                                        onclick="addToCart(false,{{ $product->id }})"><i
                                            class="fa fa-arrow-right"></i><span>Thêm vào giỏ hàng</span></button>
                                @endif
                            </div>
                        </div>
                        <!-- End .product-details -->
                    </div>
                @endforeach
            </div>
            <!-- End .products-slider -->
        </div>
        <!-- End .products-section -->
        <!-- End .row -->
    </div>
@endsection


@push('jsHandle')
    <script type="text/javascript">
        toastr.options.progressBar = true;
        toastr.options.closeButton = true;
        toastr.options.showEasing = 'swing';

        let cart = document.querySelector('#mini-cart');
        let cartTotal = document.querySelector('#cart-total');
        let cartCount = document.querySelector('#cart-count')
        let productQuantity = document.querySelector('#product_quantity');
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
                        quantity: Number(productQuantity.value)
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
                        // cart.innerHTML = htmlCartItems;

                        if ((data.cartItems).length > 0) {
                            cart.innerHTML = htmlCartItems;
                            cartAction.innerHTML = `
                                <a href="{{ route('cart') }}" class="btn btn-gray btn-block view-cart">Xem giỏ hàng</a>
                                <a href="{{ route('client.checkout') }}" class="btn btn-dark btn-block">Thanh toán</a>
                            `;
                        } else {
                            cart.innerHTML = '<p class="text-center mt-2" style="font-size: 12px;">Không có sản phẩm nào trong giỏ hàng</p>';
                            cartAction.innerHTML = "";
                        }

                        cartTotal.textContent = formatCash((totalMoney).toString());
                        cartCount.textContent = data.cartItems.length;
                        toastr.success('Sản phẩm đã được thêm vào giỏ hàng');
                    }
                });
            }

        }

        function removeCartItem(id) {
            $.ajax({
                url: "/cart/destroy",
                method: "GET",
                data: {
                    id,
                },
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
                        cart.innerHTML = '<p class="text-center mt-2" style="font-size: 12px;">Không có sản phẩm nào trong giỏ hàng</p>';
                        cartAction.innerHTML = "";
                    }

                    // cart.innerHTML = htmlCartItems;
                    cartTotal.textContent = formatCash((totalMoney).toString());
                    cartCount.textContent = data.length;
                }
            });
        }
    </script>
@endpush
