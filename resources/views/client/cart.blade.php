@extends('client.layouts.client_master')

@section('page-content')
    <div class="container" style="min-height: 450px;">
        <h1 class="text-center my-4">Giỏ hàng</h1>

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="cart-table-container">
                    <table class="table table-cart table-bordered text-center">
                        <thead>
                            <tr>
                                <th class="product-col">Sản phẩm</th>
                                <th class="price-col">Giá</th>
                                <th class="qty-col" width="10%">Số lượng</th>
                                <th width="15%">Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody id="cart-in-page" class="text-center product-list-table" >
                            @foreach ($cartItems as $item)
                                <tr class="product-row">
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <figure class="product-image-container">
                                                <a href="product.html" class="product-image">
                                                    <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="product">
                                                </a>

                                                <span class="btn-remove icon-cancel" style="cursor: pointer"
                                                    onclick="removeCartItem({{ $item->product_id }})"
                                                    title="Remove Product"></span>
                                            </figure>
                                            <h5 class="product-title ml-5">
                                                <a href="product.html">{{ $item->name }}</a>
                                            </h5>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($item->price_sale != 0)
                                            <span style="text-decoration: line-through">{{ number_format($item->price) . ' đ' }}</span> 
                                            <span class="font-weight-bold" style="font-size: 18px;">{{ number_format($item->price_sale) . ' đ' }}</span>
                                        @else
                                            <span class="font-weight-bold" style="font-size: 18px;">{{ number_format($item->price) . ' đ' }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="product-single-qty m-0">
                                            <input type="number" class="productQuantity text-center p-3 font-weight-bold"
                                                min="1" style="width: 75px;" value="{{ $item->quantity }}"
                                                onChange="updateCartItem(this, {{ $item->product_id }})">
                                        </div><!-- End .product-single-qty -->
                                    </td>
                                    <td class="">
                                        @if ($item->price_sale != 0)
                                            <span class="subtotal-price">{{ number_format($item->price_sale * $item->quantity) . ' đ' }}</span>
                                        @else
                                            <span class="subtotal-price">{{ number_format($item->price * $item->quantity) . ' đ' }}</span>
                                        @endif
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- End .cart-table-container -->
                <div id="product-list-table">
                    
                </div>
            </div><!-- End .col-lg-8 -->

            <div class="col-lg-4">
                <div class="cart-summary">
                    <h3>TỔNG TIỀN</h3>

                    <table class="table table-totals">
                        <tbody>
                        </tbody>

                        <tfoot>
                            <tr>
                                <td id="cart-total-in-page">{{number_format($cartTotalMoney) . ' đ'}}</td>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="checkout-methods" id="checkout-btn">
                        <a href="{{route('client.checkout')}}" class="btn btn-block btn-dark" >Thanh toán giỏ hàng
                            <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div><!-- End .cart-summary -->
            </div>
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-6"></div><!-- margin -->
@endsection


@push('jsHandle')
    <script type="text/javascript">
        toastr.options.progressBar = true;
        toastr.options.closeButton = true;
        toastr.options.showEasing = 'swing';

        let cart = document.querySelector('#mini-cart');
        let cartAction = document.querySelector('#cart-action');
        let cartTotal = document.querySelector('#cart-total');
        let cartCount = document.querySelector('#cart-count');
        let cartInPage = document.querySelector('#cart-in-page');
        let cartTotalInPage = document.querySelector('#cart-total-in-page');
        let productQuantity = document.querySelectorAll('.productQuantity');
        let checkoutBtn = document.querySelector('#checkout-btn');
        let emptyCartAnnouce = document.querySelector('#product-list-table');

        function removeCartItem(id) {
            $.ajax({
                url: "/cart/destroy",
                data: {
                    id
                },
                method: "GET",
                success: function(data) {
                    let htmlCartItems = "";
                    let cartTotalMoney = 0;
                    let htmlCartItemsInPage = "";
                    (data).forEach(element => {
                        let priceHTML = "";
                        let pageItemHTML = "";
                        if (element.price_sale != 0) {
                            priceHTML = `
                                <span class='cart-product-qty' style='text-decoration: line-through'>${formatCash((element.price).toString())}</span>
                                <span class="cart-product-qty fs-3" style="font-size: 18px;">${formatCash((element.price_sale).toString())}</span> × ${element.quantity} 
                            `;
                            pageItemHTML = `
                                <span style="text-decoration: line-through">${formatCash((element.price).toString())}</span> 
                                <span class="font-weight-bold" style="font-size: 18px;">${formatCash((element.price_sale).toString())}</span>
                            `;
                        } else {
                            priceHTML = `
                                <span class="cart-product-qty fs-3" style="font-size: 18px;">${formatCash((element.price).toString())}</span> × ${element.quantity} 
                            `;

                            pageItemHTML = `
                                <span class="font-weight-bold" style="font-size: 18px;">${formatCash((element.price).toString())}</span>
                            `
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
                        cartTotalMoney += ((element.price_sale != 0 ? element.price_sale : element.price) * element.quantity);

                        htmlCartItemsInPage +=
                            `
                            <tr class="product-row">
                                <td class="d-flex justify-content-center align-items-center">
                                    <figure class="product-image-container">
                                        <a href="product.html" class="product-image">
                                            <img src="{{ asset('storage') }}/${element.thumbnail}" alt="product">
                                        </a>

                                        <span class="btn-remove icon-cancel" style="cursor: pointer" onclick="removeCartItem(${element.product_id})"
                                                title="Remove Product"></span>
                                    </figure>
                                    <h5 class="product-title">
                                        <a href="product.html">${element.name}</a>
                                    </h5>
                                </td>
                                <td>${pageItemHTML}</td>
                                <td>
                                    <div class="product-single-qty">
                                        <input type="number" class="productQuantity text-center p-3 font-weight-bold" style="width: 75px;" min="1" value="${element.quantity}" onChange="updateCartItem(this, ${element.product_id})"> 
                                    </div>
                                </td>
                                <td class="text-right"><span class="subtotal-price">${formatCash(((element.price_sale != 0 ? element.price_sale : element.price) * element.quantity).toString())}</span></td>
                            </tr>
                        `
                    });

                    if (data.length > 0) {
                        cartAction.innerHTML = `
                            <a href="{{ route('cart') }}" class="btn btn-gray btn-block view-cart">Xem giỏ hàng</a>
                            <a href="{{ route('client.checkout') }}" class="btn btn-dark btn-block">Thanh toán</a>
                        `;
                        cart.innerHTML = htmlCartItems;
                        emptyCartAnnouce.innerHTML = '';
                        checkoutBtn.innerHTML = `
                            <a href="{{route('client.checkout')}}" class="btn btn-block btn-dark">
                                Thanh toán giỏ hàng <i class="fa fa-arrow-right"></i>
                            </a>
                        `;
                    } else {
                        cartAction.innerHTML = "";
                        cart.innerHTML = '<p class="text-center mt-2" style="font-size: 12px;">Không có sản phẩm nào trong giỏ hàng</p>';
                        emptyCartAnnouce.innerHTML = '<p class="text-center">Không có sản phẩm nào trong giỏ hàng</p>';
                        checkoutBtn.innerHTML = "";
                    }
                    // cart.innerHTML = htmlCartItems;
                    cartCount.textContent = data.length;
                    cartTotal.textContent = formatCash((cartTotalMoney).toString());
                    cartInPage.innerHTML = htmlCartItemsInPage;
                    cartTotalInPage.textContent = formatCash((cartTotalMoney).toString());
                }
            });
        }

        function updateCartItem(event, id) {
            let productQuantity = event.value;
            $.ajax({
                url: "/cart/update",
                type: "GET",
                data: {
                    id,
                    quantity: Number(productQuantity)
                },
                dataType: "json",
                success: function(data) {
                    let htmlCartItems = "";
                    let cartTotalMoney = 0;
                    let htmlCartItemsInPage = "";
                    (data.cartItems).forEach(element => {
                        let priceHTML = "";
                        let pageItemHTML = "";
                        if (element.price_sale != 0) {
                            priceHTML = `
                                <span class='cart-product-qty' style='text-decoration: line-through'>${formatCash((element.price).toString())}</span>
                                <span class="cart-product-qty fs-3" style="font-size: 18px;">${formatCash((element.price_sale).toString())}</span> × ${element.quantity} 
                            `;
                            pageItemHTML = `
                                <span style="text-decoration: line-through">${formatCash((element.price).toString())}</span> 
                                <span class="font-weight-bold" style="font-size: 18px;">${formatCash((element.price_sale).toString())}</span>
                            `;
                        } else {
                            priceHTML = `
                                <span class="cart-product-qty fs-3" style="font-size: 18px;">${formatCash((element.price).toString())}</span> × ${element.quantity} 
                            `;

                            pageItemHTML = `
                                <span class="font-weight-bold" style="font-size: 18px;">${formatCash((element.price).toString())}</span>
                            `
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
                        cartTotalMoney += ((element.price_sale != 0 ? element.price_sale : element.price) * element.quantity);
                        
                        htmlCartItemsInPage +=
                            `
                            <tr class="product-row">
                                <td class="d-flex justify-content-center align-items-center">
                                    <figure class="product-image-container">
                                        <a href="product.html" class="product-image">
                                            <img src="{{ asset('storage') }}/${element.thumbnail}" alt="product">
                                        </a>

                                        <span class="btn-remove icon-cancel" style="cursor: pointer" onclick="removeCartItem(${element.product_id})"
                                                title="Remove Product"></span>
                                    </figure>
                                    <h5 class="product-title">
                                        <a href="product.html">${element.name}</a>
                                    </h5>
                                </td>
                                <td>${pageItemHTML}</td>
                                <td>
                                    <div class="product-single-qty">
                                        <input type="number" class="productQuantity text-center p-3 font-weight-bold" style="width: 75px;" min="1" value="${element.quantity}" onChange="updateCartItem(this, ${element.product_id})"> 
                                    </div>
                                </td>
                                <td class="text-right"><span class="subtotal-price">${formatCash(((element.price_sale != 0 ? element.price_sale : element.price) * element.quantity).toString())}</span></td>
                            </tr>
                        `
                    });

                    cart.innerHTML = htmlCartItems;
                    cartTotal.textContent = formatCash((cartTotalMoney).toString());
                    cartCount.textContent = (data.cartItems).length;
                    cartInPage.innerHTML = htmlCartItemsInPage;
                    cartTotalInPage.textContent = formatCash((cartTotalMoney).toString());
                    toastr.success('Cập nhật giỏ hàng thành công');
                }
            });
        }
    </script>
@endpush
