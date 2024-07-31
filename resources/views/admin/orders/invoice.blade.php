<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Invoice</title>

    <style type="text/css">
        * {
            font-family: DejaVu Sans !important;
        }

        /* Mailing */
        .d-flex {
            display: flex !important;
        }

        .flex-col {
            flex-direction: column;
        }

        .flex-row {
            flex-direction: row;
        }

        .justify-content-center {
            justify-content: center !important;
        }

        .justify-content-between {
            justify-content: space-between !important;
        }

        .align-items-center {
            align-items: center !important;
        }

        .justify-items-center {
            justify-items: center
        }

        .align-self-center {
            align-self: center;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left !important;
        }

        .text-right {
            text-align: right !important;
        }

        .mt-5 {
            margin-top: 5rem;
        }

        .mb-16px {
            margin-bottom: 16px;
        }

        .text__main-color {
            color: #075588;
        }

        .bg__main-color {
            background-color: #075588;
        }

        table,
        th,
        td {
            border: 1px solid #dee2e6;
        }

        .table-border {
            border-collapse: collapse;
            color: #777;
        }

        .table-borderless {
            border-collapse: collapse;
            border-style: hidden ;
        }

        .vertical-align-top {
            vertical-align: top;
        }

        .vertical-align-middle {
            vertical-align: middle;
        }

        .vertical-align-bottom {
            vertical-align: bottom;
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

        .text-white {
            color: #fff !important;
        }

        .bg__body-color {
            background-color: #eceef1;
        }

        .bg-white {
            background-color: white;
        }

        .rounded-1 {
            border-radius: .25rem;
        }

        .padding-1 {
            padding: 24px;
        }

        .remove-decoration {
            text-decoration: none;
        }

        .position-relative {
            position: relative;
        }

        .position-absolute {
            position: absolute;
        }

        .position-center-x {
            left: 50%;
            transform: translateX(-50%);
        }

        .m-0 {
            margin: 0;
        }

        .mt-0 {
            margin-top: 0 !important;
        }

        .mt-1 {
            margin-top: .25rem !important;
        }

        .mb-1 {
            margin-bottom: .25rem !important;
        }

        .mt-2 {
            margin-top: .5rem !important;
        }

        .mt-3 {
            margin-top: .75rem !important;
        }

        .my-3 {
            margin-top: .75rem !important;
            margin-bottom: .75rem !important;
        }

        .pt-0 {
            padding-top: 0 !important;
        }

        .pt-1 {
            padding-top: .25rem !important;
        }

        .pt-2 {
            padding-top: .5rem !important;
        }

        .pt-3 {
            padding-top: .75rem !important;
        }

        .py-3 {
            padding-top: .75rem !important;
            padding-bottom: .75rem !important;
        }

        .rounded-1 {
            border-radius: .25rem !important;
        }

        .d-inline-block {
            display: inline-block;
        }

        .w-100 {
            width: 100% !important;
        }
    </style>

</head>

<body>
    <table class="w-100 table-borderless mb-1">
        <tr>
            <td class="text-left vertical-align-top table-borderless">
                <h1 class="m-0 text__main-color mb-1 text-left">
                    THE COLLECTION
                </h1>
            </td>
            <td class="text-right vertical-align-middle table-borderless">
                <h3 class="m-0 text__main-color text-right">Hóa đơn/Biên lai</h3>
            </td>
        </tr>
    </table>

    <hr class="my-1">

    <h3 class="mb-1">
        TỪ The Collection
    </h3>
    <table class="w-100">
        <tr class="table-borderless">
            <td class="text-left vertical-align-top">
                <strong>Email:</strong> thecollection@gmail.com <br>
                <strong>Số điện thoại:</strong> 0987927328 <br>
                <strong>Địa chỉ:</strong> Số 1, phố Trịnh Văn Bô, Nam Từ Liêm, Hà Nội<br>
            </td>
        </tr>
    </table>

    <hr class="my-1">

    <h3 class="mt-0 mb-1">ĐẾN</h3>
    <table class="w-100">
        <tr>
            <td class="text-left vertical-align-top">
                <strong>Tên khách hàng:</strong> client01<br>
                <strong>Email:</strong> client01@gmail.com <br>
                <strong>Số điện thoại:</strong> 012345678 <br>
                <strong>Địa chỉ:</strong> Hà Đông, Hà Nội<br>
            </td>
            <td class="text-right vertical-align-top">
                <strong>Mã đơn hàng:</strong> #12345<br>
                <strong>Ngày đặt hàng:</strong> 12/05/2024 <br>
                <strong>Phương thức thanh toán:</strong> VNPAY <br>
            </td>
        </tr>
    </table>

    <hr class="my-1">
    <h3 class="mb-0">CHI TIẾT HÓA ĐƠN</h3>
    <table class="table table-bordered text-center align-middle" style="width: 100%">
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
                            {{-- <img src="{{ asset('storage/' . $item->product->thumbnail) }}" alt=""
                                width="45px;"> --}}
                            <span class="pl-2">{{ $item->product->name }}</span>
                        </div>
                    </td>
                    <td colspan="2" class="align-middle">{{ number_format($item->product->price) }} đ</td>
                    <td colspan="2" class="align-middle">{{ number_format($item->product->price_sale) }} đ</td>
                    <td colspan="1" class="align-middle">{{ $item->quantity }}</td>
                    <td colspan="3" class="align-middle">
                        {{ number_format($item->product->price_sale != 0 ? $item->product->price_sale * $item->quantity : $item->product->price * $item->quantity) }}
                        đ</td>
                </tr>
            @endforeach
        </tbody>

        <thead style="width: 100%">
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
                <td colspan="6">{{ $order->coupon_id != null ? $order->coupon->name : '' }}</td>
            </tr>
            <tr>
                <td colspan="3">Giá trị</td>
                <td colspan="6">{{ $order->coupon->value ?? '' }} </td>
            </tr>
            <tr>
                <td colspan="3">Tiền giảm</td>
                <td colspan="6">{{ number_format($order->discount) }} đ</td>
            </tr>
            <tr>
                <th colspan="4">Tổng thanh toán</th>
                <th colspan="6">{{ number_format($order->grand_total) }} đ</th>
            </tr>
        </tbody>
    </table>

    <table class="w-100 table-borderless mt-2">
        <tr>
            <td class="text-right vertical-align-top">
                <span>-------------------------------------</span>
                <h3 class="m-0">Người bán hàng</h3>
                <span>Ký tên</span>
            </td>
        </tr>
    </table>
</body>

</html>
