<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Xác nhận đơn hàng</title>
    <style>
        .container {
            height: 100vh;
        }

        .d-flex {
            display: flex;
        }

        .flex-col {
            flex-direction: column;
        }

        .flex-row {
            flex-direction: row;
        }

        .justify-content-center {
            justify-content: center;
        }

        .align-items-center {
            align-items: center;
        }

        .justify-items-center {
            justify-items: center
        }

        .align-self-center {
            align-self: center;
        }

        .text-center {
            text-align: center
        }

        .mt-5 {
            margin-top: 5rem;
        }

        .mb-16px {
            margin-bottom: 16px;
        }

        table {
            border-collapse: collapse;
            color: #777;
        }


        table,
        th,
        td {
            border: 1px solid #dee2e6;
        }

        .bg__header-table {
            background-color: #f4f4f4;
        }

        th,
        td {
            padding: 6px 8px;
        }

        .text-success {
            color: forestgreen;
        }
    </style>
</head>

<body>
    <div class="container d-flex flex-col">
        <h1 class="text-center text-success">Đặt hàng thành công, vui lòng kiểm tra lại thông tin đơn hàng!</h1>
        <table class="table table-bordered text-center align-middle align-self-center" border="1"
            style="width: 800px;">
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
</body>

</html>
