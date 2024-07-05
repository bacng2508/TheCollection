@extends('client.layouts.client_master')

@section('page-content')
    <div class="container py-5" style="min-height: 620px;">
        <div class="row">
            @include('client.profile.sidebar')
            <div class="col-9 p-5">
                <h3>Danh sách đơn hàng</h3>
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th width="">#</th>
                            <th width="">Mã đơn hàng</th>
                            <th width="">Ngày tạo</th>
                            <th width="">Tổng tiền</th>
                            <th width="">Thanh toán</th>
                            <th width="">Trạng thái</th>
                            <th width=""></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($myOrders as $key => $order)
                            <tr>
                                <td style="vertical-align: middle;">{{ $key + 1 }}</td>
                                <td style="vertical-align: middle;">{{ $order->order_code }}</td>
                                <td style="vertical-align: middle;">
                                    {{ date('H:i - d/m/Y ', strtotime($order->created_at)) }}
                                </td>
                                <td style="vertical-align: middle;">
                                    {{ number_format($order->grand_total) . ' đ' }}</td>
                                <td style="vertical-align: middle;text-transform: uppercase;" width="15%">
                                    {{ $order->payment_method }}
                                </td>
                                <td style="vertical-align: middle;">
                                    @switch($order->order_status)
                                        @case(0)
                                            <span class="text-danger font-weight-bold">Hủy</span>
                                            @break
                                        @case(1)
                                            <span class="text-info font-weight-bold">Đang xử lý</span>
                                            @break
                                        @case(2)
                                            <span class="text-warning font-weight-bold">Đang vận chuyển</span>
                                            @break
                                        @case(3)
                                            <span class="text-success font-weight-bold">Thành công</span>
                                            @break
                                        @default
                                    @endswitch
                                </td>
                                <td class="text-center" style="vertical-align: middle;">
                                    <a href="{{route('profile.order-detail', $order)}}" class="btn btn-warning mr-1 order-detail px-3 py-2" style="border-radius: 5px;"
                                        data-id="{{ $order->id }}">
                                        Chi tiết
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    {{ $myOrders->links() }}
                </div>
                @if ($myOrders->count() == 0)
                    <div class="text-center my-4">
                        <span>Bạn chưa mua đơn hàng nào</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection


@push('jsHandle')
    <script type="text/javascript"></script>
@endpush
