@extends('client.layouts.client_master')

@section('page-content')
    <div class="container py-5" style="min-height: 620px;">
        <div class="row">
            @include('client.profile.sidebar')
            <div class="col-9 p-5">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h3 class="mb-0">Chi tiết đơn hàng</h3>
                    <a href="{{ route('profile.my-orders') }}" class="btn btn-warning"
                        style="border-radius: 5px; padding: 8px 12px;">
                        <i class="fa-solid fa-angle-left mr-2 font-weight-bold"></i>
                        Danh sách đơn hàng
                    </a>
                </div>
                <table class="table table-bordered text-center align-middle">
                    <thead>
                        <tr>
                            <th colspan="10" class="p-3 bg__header-table">MÃ ĐƠN HÀNG: #{{ $order->order_code }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th colspan="2">Họ tên</th>
                            <td colspan="8">{{ $order->fullname }}</td>
                        </tr>
                        <tr>
                            <th colspan="2">Email</th>
                            <td colspan="8">{{ $order->email }}</td>
                        </tr>
                        <tr>
                            <th colspan="2">Số điện thoại</th>
                            <td colspan="8">{{ $order->phone_number }}</td>
                        </tr>
                        <tr>
                            <th colspan="2">Địa chỉ</th>
                            <td colspan="8">{{ $order->address }}</td>
                        </tr>
                        <tr>
                            <th colspan="2">Ghi chú</th>
                            <td colspan="8">{{ $order->note }}</td>
                        </tr>
                        <tr>
                            <th colspan="2">Ngày đặt hàng</th>
                            <td colspan="8">{{ date('H:i - d/m/Y ', strtotime($order->created_at)) }}</td>
                        </tr>
                    </tbody>

                    <thead>
                        <tr>
                            <th colspan="10" class="p-3 bg__header-table">SẢN PHẨM</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th colspan="2">Tên sản phẩm</th>
                            <th colspan="2">Giá gốc</th>
                            <th colspan="2">Giá sale</th>
                            <th colspan="1">Số lượng</th>
                            <th colspan="3">Tổng tiền</th>
                        </tr>
                        @foreach ($orderItems as $key => $item)
                            <tr>
                                <td colspan="2">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('storage/' . $item->product->thumbnail) }}" alt=""
                                            width="45px;">
                                        <span class="pl-2">{{ $item->product->name }}</span>
                                    </div>
                                </td>
                                <td colspan="2" class="align-middle">{{ number_format($item->product->price) }} đ</td>
                                <td colspan="2" class="align-middle">{{ number_format($item->product->price_sale) }} đ</td>
                                <td colspan="1" class="align-middle">{{ $item->quantity }}</td>
                                <td colspan="2" class="align-middle">
                                    {{ number_format($item->product->price_sale != 0 ? $item->product->price_sale * $item->quantity : $item->product->price * $item->quantity) }}
                                    đ</td>
                            </tr>
                        @endforeach
                    </tbody>

                    <thead>
                        <tr>
                            <th colspan="10" class="p-3 bg__header-table">TỔNG TIỀN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th colspan="4">Tạm tính</th>
                            <td colspan="6">{{ number_format($order->sub_total) }} đ</td>
                        </tr>
                        <tr>
                            <th rowspan="3" style="vertical-align: middle;">Mã giảm giá</th>
                            <td colspan="3">Tên mã giảm giá</td>
                            <td colspan="4">{{ $order->coupon_id != null ? $order->coupon->name : '' }}</td>
                        </tr>
                        <tr>
                            <td colspan="3">Giá trị</td>
                            <td colspan="4">{{ $order->coupon->value ?? '' }} </td>
                        </tr>
                        <tr>
                            <td colspan="3">Tiền giảm</td>
                            <td colspan="4">{{ number_format($order->discount) }} đ</td>
                        </tr>
                        <tr>
                            <th colspan="4">Tổng thanh toán</th>
                            <th colspan="6">{{ number_format($order->grand_total) }} đ</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


@push('jsHandle')
    <script type="text/javascript"></script>
@endpush
