@extends('client.layouts.client_master')

@section('page-content')
    <div class="container py-5">
        <div class="row">
            <div class="col-3 border border-black px-5 py-4">
                <div>
                    <h5 class="mb-1">Danh mục</h5>
                    <ul class="list-group rounded-0 ml-4">
                        @foreach ($categories as $category)
                            <li class="mb-1">
                                <a href="{{ route('client.category.index', $category) }}"
                                    class="{{ $category->id == $categoryShow->id ? 'text__main-color font-weight-bold' : 'text-dark' }}">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <hr class="my-4">
                <div>
                    <form action="{{ route('client.category.index', $categoryShow) }}" method="GET" id="filter-form">
                        <div class="mb-2">
                        </div>

                        <div class="mb-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-1">Thương hiệu</h5>
                                <button type="submit" class="btn btn-primary px-3 py-1 mb-1"
                                    style="border-radius: 5px;">Lọc</button>
                            </div>
                            <div class="px-4">
                                @foreach ($brands as $brand)
                                    <div class="form-group form-check mb-1">
                                        <input type="checkbox" class="form-check-input" id="brand_{{ $brand->id }}"
                                            name="brands[]" value="{{ $brand->id }}"
                                            @isset($_GET['brands'])
                                                @if (in_array($brand->id, $_GET['brands'])) checked @endif
                                            @endisset 
                                        >
                                        <label class="form-check-label font-weight-normal ml-3"
                                            for="brand_{{ $brand->id }}">{{ $brand->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <hr class="my-3">

                        @foreach ($attributes as $key => $attribute)
                            <div class="mb-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-1">{{$attribute->name}}</h5>
                                </div>
                                <div class="px-4">
                                    @foreach ($attributeOptions->where('attribute_id', $attribute->id) as $attributeOption)
                                        <div class="form-group form-check mb-1">
                                            <input type="checkbox" class="form-check-input"
                                                id="attribute_option_{{ $attributeOption->id }}"
                                                name="attribute_options[]"
                                                value="{{ $attributeOption->id }}"
                                                @isset($_GET['attribute_options'])
                                                    @if (in_array($attributeOption->id, $_GET['attribute_options'])) checked @endif
                                                @endisset 
                                            >
                                            <label class="form-check-label font-weight-normal ml-3"
                                                for="attribute_option_{{ $attributeOption->id }}">{{ $attributeOption->value }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </form>
                </div>
            </div>
            <div class="col-9">
                <div class="row px-5 justify-content-end align-items-center mb-2">
                    <div class="">
                        <select id="sortProduct" name="sortBy" class="px-3 py-2 bg-white border mr-3" form="filter-form">
                            <option value="price-asc">Sắp xếp theo</option>
                            <option value="price-asc">Giá tăng dần</option>
                            <option value="price-desc">Giá giảm dần</option>
                            <option value="name-asc">Tên từ A-Z</option>
                            <option value="name-desc">Tên từ Z-A</option>
                        </select>
                    </div>
                </div>
                <div class="row px-5">
                    @foreach ($products as $product)
                        <div class="col-4 px-3">
                            <div class="product-default p-3 border border-black">
                                <figure>
                                    <a href="{{ route('client.product.detail', $product) }}">
                                        <img src="{{ asset('storage/' . $product->thumbnail) }}" width="280"
                                            height="280" alt="product">
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
                                        <a href="product.html">{{ $product->name }}</a>
                                    </h3>
                                    <!-- End .product-container -->
                                    <div class="price-box">
                                        @if ($product->price_sale == 0)
                                            <span
                                                class="product-price d-inline-block mb-2">{{ number_format($product->price) . ' đ' }}</span>
                                        @else
                                            <div class="text-center">
                                                <span
                                                    class="product-price">{{ number_format($product->price_sale) . ' đ' }}</span><br>
                                                <span class="product-price font-weight-normal d-inline-block mt-1"
                                                    style="text-decoration: line-through; font-size: 12px">{{ number_format($product->price) . ' đ' }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- End .price-box -->
                                    <div class="product-action">
                                        @if (Auth::check())
                                            <button class="btn-icon btn-add-cart addToCart"
                                                onclick="addToCart(true,{{ $product->id }})"><i
                                                    class="fa fa-arrow-right"></i><span>Thêm vào giỏ hàng</span></button>
                                            <a href="ajax/product-quick-view.html" class="btn-quickview"
                                                title="Quick View"><i class="fas fa-external-link-alt"></i></a>
                                        @else
                                            <button class="btn-icon btn-add-cart addToCart"
                                                onclick="addToCart(false,{{ $product->id }})"><i
                                                    class="fa fa-arrow-right"></i><span>Thêm vào giỏ hàng</span></button>
                                        @endif
                                    </div>
                                </div>
                                <!-- End .product-details -->
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-end">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection


@push('jsHandle')
    <script type="text/javascript">
        toastr.options.progressBar = true;
        toastr.options.closeButton = true;
        toastr.options.showEasing = 'swing';

        let cart = document.querySelector('#mini-cart');
        let cartTotal = document.querySelector('#cart-total');
        let cartCount = document.querySelector('#cart-count');

        
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

                    cart.innerHTML = htmlCartItems;
                    cartTotal.textContent = formatCash((totalMoney).toString());
                    cartCount.textContent = data.length;
                }
            });
        }

        let filterForm = document.querySelector('#filter-form')
        let sortProduct = document.querySelector('#sortProduct');
        sortProduct.addEventListener('change', (e) => {
            filterForm.submit();
        });
        
        </script>
@endpush