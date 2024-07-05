@extends('client.layouts.client_master')

@section('page-content')
    <div class="container checkout-container">
        <h1 class="text-center my-5">Thông tin đặt hàng</h1>
        @if (session()->has('msg'))
            <p class="alert alert-danger text-center py-3">{{ session('msg') }}</p>
        @endif
        <form action="{{ route('client.checkout.store') }}" id="checkout-form" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <ul class="checkout-steps">
                        <li>
                            <h2 class="step-title mt-0 mb-2">Thông tin vận chuyển</h2>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="client_fullname">Họ tên <strong class="text-danger">*</strong></label>
                                        <input type="text" class="form-control" name="fullname" id="client_fullname" value="{{Auth::user()->name}}"/>
                                        @error('fullname')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="client_phoneNumber">Số điện thoại <strong
                                                class="text-danger">*</strong></label>
                                        <input type="text" name="phone_number" class="form-control"
                                            id="client_phoneNumber" value="{{Auth::user()->tel ?? ""}}"/>
                                        @error('phone_number')
                                            <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>



                            <div class="form-group">
                                <label for="client_email">Email <strong class="text-danger">*</strong></label>
                                <input type="text" name="email" class="form-control" id="client_email" value="{{Auth::user()->email}}"/>
                                @error('email')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="client_address">Địa chỉ <strong class="text-danger">*</strong></label>
                                <input type="text" name="address" class="form-control" id="client_address"  value="{{Auth::user()->address ?? ""}}"/>
                                @error('address')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="order-comments">Ghi chú đơn hàng</label>
                                <textarea class="form-control" name="note"></textarea>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-6">
                    <div class="order-summary">
                        <h3>Thông tin đơn hàng</h3>

                        <table class="table table-mini-cart">
                            <thead>
                                <tr>
                                    <th colspan="" width="60%">Sản phẩm</th>
                                    <th colspan="" class="text-right" width="20%">Đơn giá</th>
                                    <th colspan="" class="text-right" width="20%">Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $item)
                                    <tr>
                                        <td class="product-col py-2">
                                            <h3 class="product-title d-flex align-items-center">
                                                <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="" width="45px;">
                                                <span class="pl-3">{{ $item->name }} × {{ $item->quantity }}</span>
                                            </h3>
                                        </td>

                                        <td class="price-col py-2 text-right">
                                            @if ($item->price_sale != 0)
                                                <span style="text-decoration: line-through">{{ number_format($item->price) . ' đ' }}</span>
                                                <span class="">{{ number_format($item->price_sale) . ' đ' }}</span>
                                            @else
                                                <span class="">{{ number_format($item->price) . ' đ' }}</span>
                                            @endif
                                        </td>
                                        <td class="price-col py-2 text-right">
                                            @if ($item->price_sale != 0)
                                                <span>{{ number_format($item->price_sale * $item->quantity) . ' đ' }}</span>
                                            @else
                                                <span>{{ number_format($item->price * $item->quantity) . ' đ' }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="cart-subtotal border-bottom-0 border-top">
                                    <td class="pb-1 pt-4">
                                        <h4>Tạm tính</h4>
                                    </td>

                                    <td class="pb-1 pt-4"></td>

                                    <td class="price-col py-1">
                                        <span id="order-sub-total">{{ number_format($subTotalMoney) . ' đ' }}</span>
                                    </td>
                                </tr>
                                <tr class="cart-subtotal">
                                    <td class="py-3">
                                        <h4>Giảm giá</h4>
                                    </td>

                                    <td class="pb-1 pt-4"></td>


                                    <td class="price-col pt-1 pb-4">
                                        <span id="discount">0 đ</span>
                                    </td>
                                </tr>
                                <tr class="order-shipping">
                                    <td class="text-left" colspan="3">
                                        <h4 class="m-b-sm">Mã giảm giá</h4>

                                        <div>
                                            {{-- <form action="#" class="mb-2"> --}}
                                            <div class="input-group">
                                                <input type="text" name="coupon_name"
                                                    class="form-control form-control-sm" placeholder="Nhập mã giảm giá"
                                                    id="coupon-input" value="{{ old('coupon_name') }}">
                                                <div class="input-group-append">
                                                    <button class="btn btn-sm" type="button" id="apply-coupon-btn">Áp
                                                        dụng</button>
                                                </div>
                                            </div><!-- End .input-group -->
                                            <p class="my-2" id="coupon-notification">
                                                @error('coupon_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </p>
                                            {{-- </form> --}}
                                        </div>
                                    </td>

                                </tr>

                                <tr class="order-total">
                                    <td>
                                        <h4>Tổng thanh toán</h4>
                                    </td>
                                    {{-- <td></td> --}}
                                    <td colspan="2">
                                        <b class="total-price"
                                            id="order-grand-total"><span>{{ number_format($subTotalMoney) . ' đ' }}</span></b>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="payment-methods mb-2">
                            <h4 class="">Phương thức thanh toán</h4>
                            <div class="">
                                {{-- <form action="" class="mb-2"> --}}
                                <div class="form-group form-group-custom-control">
                                    <div class="custom-control custom-radio d-flex my-2">
                                        <input type="radio" class="custom-control-input" name="payment_method"
                                            value="cod" checked />
                                        <label class="custom-control-label">Thanh toán khi nhận hàng</label>
                                    </div>
                                    <!-- End .custom-checkbox -->
                                </div>
                                <!-- End .form-group -->

                                <div class="form-group form-group-custom-control mb-0">
                                    <div class="custom-control custom-radio d-flex mb-0 my-2">
                                        <input type="radio" name="payment_method" value="vnpay"
                                            class="custom-control-input">
                                        <label class="custom-control-label">Thanh toán qua VNPAY</label>
                                    </div>
                                    <!-- End .custom-checkbox -->
                                </div>
                                <!-- End .form-group -->
                            </div>
                        </div>

                        <button type="submit" class="btn btn-dark btn-place-order" form="checkout-form">
                            ĐẶT HÀNG
                        </button>
                    </div>
                    <!-- End .cart-summary -->
                </div>
            </div>
        </form>

        <!-- End .row -->
    </div>
@endsection


@push('jsHandle')
    <script type="text/javascript">
        let applyCouponBtn = document.querySelector('#apply-coupon-btn');
        let couponInput = document.querySelector('#coupon-input');
        let couponNotification = document.querySelector('#coupon-notification');
        let orderSubTotal = document.querySelector('#order-sub-total');
        let orderSubTotalNumber = orderSubTotal.textContent.replace('đ', '').replaceAll(',', '').trim();
        let orderGrandTotal = document.querySelector('#order-grand-total');
        let discount = document.querySelector('#discount');
        applyCouponBtn.addEventListener('click', function() {
            if (couponInput.value == "") {
                discount.textContent = formatCash((0).toString());
                orderGrandTotal.textContent = orderSubTotal.textContent;

                couponNotification.textContent = "Bạn phải nhập coupon";
                couponNotification.className = '';
                couponNotification.classList.add("my-2", "text-danger");
            } else {
                $.ajax({
                    url: "/order/apply-coupon",
                    data: {
                        coupon: couponInput.value
                    },
                    method: "GET",
                    success: function(data) {
                        console.log(data);
                        if (data.status == true) {
                            let discountNumber = Math.round((orderSubTotalNumber * (data.discount_value) / 100));
                            console.log(orderSubTotalNumber);
                            discount.textContent = formatCash((discountNumber).toString());

                            let orderGrandTotalNumber = Math.round((orderSubTotalNumber * (100 - data.discount_value) / 100));
                            console.log(formatCash((orderGrandTotalNumber).toString()));
                            orderGrandTotal.textContent = formatCash((orderGrandTotalNumber).toString());

                            couponNotification.textContent = "Áp dụng coupon thành công";
                            couponNotification.className = '';
                            couponNotification.classList.add("my-2", "text-success");
                        } else {
                            discount.textContent = formatCash((0).toString());
                            orderGrandTotal.textContent = orderSubTotal.textContent;

                            couponNotification.textContent = "Coupon không hợp lệ";
                            couponNotification.className = '';
                            couponNotification.classList.add("my-2", "text-danger");
                        }
                    }
                });
            }
        })
    </script>
@endpush
