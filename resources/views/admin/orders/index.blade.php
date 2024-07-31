@extends('admin.layouts.admin_master')

@section('title', 'Danh sách đơn hàng')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if (session('msg'))
                                <div class="alert alert-success text-center ">{{ session('msg') }}</div>
                            @endif
                            <div class="mb-3 d-flex justify-content-between ">
                                <form action="{{ route('admin.orders.index') }}" method="GET" class="d-flex">
                                    <div class="form-group mb-0 mr-1" style="width: 180px;">
                                        <input type="date" class="form-control" name="order_date"
                                            value="{{ Request::get('order_date') }}">
                                    </div>
                                    <select class="form-control mr-1" style="width: 180px;" name="order_status">
                                        <option value="">Tất cả trạng thái</option>
                                        <option value="0"
                                            {{ Request::get('order_status') == '0' ? 'selected' : false }}>Hủy</option>
                                        <option value="1"
                                            {{ Request::get('order_status') == '1' ? 'selected' : false }}>Đang xử lý
                                        </option>
                                        <option value="2"
                                            {{ Request::get('order_status') == '2' ? 'selected' : false }}>Đang vận chuyển
                                        </option>
                                        <option value="3"
                                            {{ Request::get('order_status') == '3' ? 'selected' : false }}>Thành công
                                        </option>
                                    </select>
                                    <button type="submit" class="btn btn-info ">
                                        <i class="fa-solid fa-filter pr-1"></i>
                                        <span>Lọc</span>
                                    </button>
                                </form>
                            </div>
                            <table id="example2" class="table table-bordered table-hover mb-3">
                                <thead class="text-center">
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="">Mã đơn hàng</th>
                                        <th width="">Ngày tạo</th>
                                        <th width="">Tổng tiền</th>
                                        <th width="">Phương thức thanh toán</th>
                                        @if (Gate::check('status-order'))
                                            <th width="">Trạng thái</th>
                                        @endif
                                        <th width="20%">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($orders as $key => $order)
                                        <tr>
                                            <td style="vertical-align: middle;">{{ $key + 1 }}</td>
                                            <td style="vertical-align: middle;">{{ $order->order_code }}</td>
                                            <td style="vertical-align: middle;">
                                                {{ date('H:i:s d-m-Y ', strtotime($order->created_at)) }}</td>
                                            <td style="vertical-align: middle;">
                                                {{ number_format($order->grand_total) . ' đ' }}</td>
                                            <td style="vertical-align: middle;" width="15%">
                                                {{ $order->payment_method }}
                                            </td>
                                            @if (Gate::check('status-order'))
                                                <td style="vertical-align: middle;">
                                                    <form action="{{ route('admin.orders.updateStatus', $order) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <select class="form-select p-1 changeOrderStatus"
                                                            aria-label="Default select example" name="order_status">
                                                            <option class="text-center" value="0"
                                                                {{ $order->order_status == 0 ? 'selected' : false }}>Hủy
                                                            </option>
                                                            <option class="text-center" value="1"
                                                                {{ $order->order_status == 1 ? 'selected' : false }}>Đang
                                                                xử lý
                                                            </option>
                                                            <option class="text-center" value="2"
                                                                {{ $order->order_status == 2 ? 'selected' : false }}>Đang
                                                                vận
                                                                chuyển</option>
                                                            <option class="text-center" value="3"
                                                                {{ $order->order_status == 3 ? 'selected' : false }}>Thành
                                                                công
                                                            </option>
                                                        </select>
                                                    </form>
                                                </td>
                                            @endif
                                            <td class="text-center" style="vertical-align: middle;">
                                                @if (Gate::check('detail-order'))
                                                    <div class="d-flex justify-content-center">
                                                        <button type="button" class="btn btn-info mr-1 order-detail"
                                                            data-id="{{ $order->id }}">
                                                            Chi tiết
                                                        </button>
                                                        <a href="{{ route('admin.orders.exportInvoice', $order) }}" class="btn btn-danger">
                                                            <i class="fa-solid fa-download pr-2"></i>
                                                            Xuất hóa đơn
                                                        </a>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-end">
                                {{ $orders->links() }}
                            </div>
                        </div>
                        <!-- /.card-body -->


                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
        </div>
    </section>
    <div>
        <div class="modal p-5" id="myModal">
            <div class="modal-content mx-auto p-2" style="width: 1000px; height: 90%">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Chi tiết đơn hàng</h4>
                    <button type="button" class="close" data-dismiss="modal" id="close-modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div style="overflow-y: auto" class="p-3">
                    <div class="modal-body">
                        {{-- <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th colspan="10">Mã đơn hàng: #3</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th colspan="2">Họ tên</th>
                                    <td colspan="8">Nguyễn Hùng Bắc</td>
                                </tr>
                                <tr>
                                    <th colspan="2">Email</th>
                                    <td colspan="8">bacnguyenfsd@gmail.com</td>
                                </tr>
                                <tr>
                                    <th colspan="2">Số điện thoại</th>
                                    <td colspan="8">0968 521 625</td>
                                </tr>
                                <tr>
                                    <th colspan="2">Địa chỉ</th>
                                    <td colspan="8">Gia Lâm, Hà Nội</td>
                                </tr>
                                <tr>
                                    <th colspan="2">Ghi chú</th>
                                    <td colspan="8"></td>
                                </tr>
                            </tbody>

                            <thead>
                                <tr>
                                    <th colspan="10">Chi tiết sản phẩm</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th colspan="2">Tên sản phẩm</th>
                                    <th colspan="1">Số lượng</th>
                                    <th colspan="3">Giá</th>
                                    <th colspan="4">Tổng tiền</th>
                                </tr>
                            </tbody>

                            <thead>
                                <tr>
                                    <th colspan="10">Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th colspan="4">Tạm tính</th>
                                    <td colspan="6">12,000,000 đ</td>
                                </tr>
                                <tr>
                                    <th rowspan="3" style="vertical-align: middle;">Mã giảm giá</th>
                                    <td colspan="3">Tên mã giảm giá</td>
                                    <td colspan="3">KHAITRUONG01</td>
                                </tr>
                                <tr>
                                    <td colspan="3">Giá trị</td>
                                    <td colspan="3">15%</td>
                                </tr>
                                <tr>
                                    <td colspan="3">Tiền giảm</td>
                                    <td colspan="3">12,000,000 đ</td>
                                </tr>
                                <tr>
                                    <th colspan="4">Tổng thanh toán</th>
                                    <td colspan="6">12,000,000 đ</td>
                                </tr>
                            </tbody>
                        </table> --}}
                    </div>
                </div>

                <!-- Modal footer -->
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="close-modal">Close</button>
                </div> --}}

            </div>
        </div>
    </div>

@endsection


@push('jsHandle')
    <script type="text/javascript">
        var changeOrderStatusList = document.querySelectorAll('.changeOrderStatus');
        var modalBody = document.querySelector('.modal-body');
        // var closeModal = document.querySelector('#close-modal');
        changeOrderStatusList.forEach((selectBox) => {
            selectBox.addEventListener('change', (item) => {
                selectBox.parentElement.submit();
            });
        });

        $('#close-modal').click(function() {
            $('#myModal').css("display", "none");
        })

        $('.order-detail').click(function() {
            let orderId = $(this).attr("data-id");
            $.ajax({
                url: "/admin/orders/" + orderId,
                type: "GET",
                data: {
                    id: orderId,
                },
                dataType: "json",
                success: function(data) {
                    let orderItemHTML = "";

                    for (let itemDetail of data.orderItemDetails) {
                        let itemQuantity = data.orderItems.find(obj => obj.product_id == itemDetail.id)
                            .quantity;
                        orderItemHTML += `
                            <tr>
                                <td colspan="2">${itemDetail.name}</td>
                                <td colspan="1">${itemQuantity}</td>
                                <td colspan="2">${formatCash(itemDetail.price)}</td>
                                <td colspan="2">${formatCash(itemDetail.price_sale)}</td>
                                <td colspan="3">${formatCash(itemDetail.price_sale != 0 ? itemDetail.price_sale*itemQuantity : itemDetail.price*itemQuantity)}</td>
                            </tr>
                        `
                    }

                    modalBody.innerHTML = `
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th colspan="10">MÃ ĐƠN HÀNG: ${data.order.order_code}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th colspan="2">Họ tên</th>
                                    <td colspan="8">${data.order.fullname}</td>
                                </tr>
                                <tr>
                                    <th colspan="2">Email</th>
                                    <td colspan="8">${data.order.email}</td>
                                </tr>
                                <tr>
                                    <th colspan="2">Số điện thoại</th>
                                    <td colspan="8">${data.order.phone_number}</td>
                                </tr>
                                <tr>
                                    <th colspan="2">Địa chỉ</th>
                                    <td colspan="8">${data.order.address}</td>
                                </tr>
                                <tr>
                                    <th colspan="2">Ghi chú</th>
                                    <td colspan="8">${data.order.note}</td>
                                </tr>
                            </tbody>

                            <thead>
                                <tr>
                                    <th colspan="10">CHI TIẾT SẢN PHẨM</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th colspan="2">Tên sản phẩm</th>
                                    <th colspan="1">Số lượng</th>
                                    <th colspan="2">Giá gốc</th>
                                    <th colspan="2">Giá sale</th>
                                    <th colspan="3">Tổng tiền</th>
                                </tr>
                                ${orderItemHTML}
                            </tbody>

                            <thead>
                                <tr>
                                    <th colspan="10">TỔNG TIỀN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th colspan="4">Tạm tính</th>
                                    <td colspan="6">${formatCash(data.order.sub_total)}</td>
                                </tr>
                                <tr>
                                    <th rowspan="3" style="vertical-align: middle;">Mã giảm giá</th>
                                    <td colspan="3">Tên mã giảm giá</td>
                                    <td colspan="4">${data.order.coupon_id != null ? data.coupon.name : ""}</td>
                                </tr>
                                <tr>
                                    <td colspan="3">Giá trị</td>
                                    <td colspan="4">${formatCash(data.coupon.value, "%")}</td>
                                </tr>
                                <tr>
                                    <td colspan="3">Tiền giảm</td>
                                    <td colspan="4">${formatCash(data.order.discount)}</td>
                                </tr>
                                <tr>
                                    <th colspan="4">Tổng thanh toán</th>
                                    <td colspan="6">${formatCash(data.order.grand_total)}</td>
                                </tr>
                            </tbody>
                        </table>
                    `;
                }
            });

            $('#myModal').show("slow");
        })
    </script>
@endpush
