@extends('admin.layouts.admin_master')

@section('title', 'Dashboard')

@section('content')
    <!-- Main content -->
    <section class="content">
        @can('dashboard-statistic')
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ number_format($orders->sum('grand_total')) }} đ</h3>

                                <p>DOANH THU</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-money-bill"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $orders->count() }}</h3>
                                <p>ĐƠN HÀNG</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3 class="text-white">{{ $products->count() }}</h3>

                                <p class="text-white">SẢN PHẨM</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-box-archive"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $users->count() }}</h3>

                                <p>KHÁCH HÀNG</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-users"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>

                <div class="row">
                    <div class="col-12 px-0">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fa-solid fa-money-bill-trend-up mr-1"></i>
                                    Thống kê doanh thu
                                </h3>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 p-5">
                                        <div>
                                            <h3 class="font-weight-bold">Doanh thu ngày</h3>
                                            <p>{{ number_format($revenueByDate) }} đ</p>
                                        </div>
                                        <hr>
                                        <div>
                                            <h3 class="font-weight-bold">Doanh thu tuần</h3>
                                            <p>{{ number_format($revenueByWeek) }} đ</p>
                                        </div>
                                        <hr>
                                        <div>
                                            <h3 class="font-weight-bold">Doanh thu tháng</h3>
                                            <p>{{ number_format($revenueByMonth) }} đ</p>
                                        </div>
                                        <hr>
                                        <div>
                                            <h3 class="font-weight-bold">Doanh thu năm</h3>
                                            <p>{{ number_format($revenueByYear) }} đ</p>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="tab-content p-0">
                                            <h4 class="mb-4 font-weight-bold text-center">Doanh thu theo tháng năm 2024</h4>
                                            <canvas id="myChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.card-body -->
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 px-0">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fa-solid fa-chart-line mr-1"></i>
                                    Thống kê người dùng
                                </h3>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 px-5">
                                        <h4 class="mb-4 font-weight-bold">Đánh giá sản phẩm</h4>
                                        <div class="tab-content p-0 pt-3">
                                            <canvas id="reviewProductChart"></canvas>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="tab-content p-0">
                                            <h4 class="mb-4 font-weight-bold text-center">Người dùng đăng ký theo tháng</h4>
                                            <canvas id="mostBuyProductChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.card-body -->
                        </div>
                    </div>
                </div>

                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-7 connectedSortable">
                    </section>
                    <!-- /.Left col -->
                    <!-- right col (We are only adding the ID to make the widgets sortable)-->
                    <section class="col-lg-5 connectedSortable">
                    </section>
                    <!-- right col -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        @endcan
    </section>
    <!-- /.content -->
@endsection


@push('jsHandle')
    <script type="text/javascript">
        const ctx = document.getElementById('myChart');

        const plugin = {
            id: 'customCanvasBackgroundColor',
            beforeDraw: (chart, args, options) => {
                const {
                    ctx
                } = chart;
                ctx.save();
                ctx.globalCompositeOperation = 'destination-over';
                ctx.fillStyle = options.color || '#99ffff';
                ctx.fillRect(0, 0, chart.width, chart.height);
                ctx.restore();
            }
        };

        // const labels = Utils.months({count: 7});
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    'Tháng 1',
                    'Tháng 2',
                    'Tháng 3',
                    'Tháng 4',
                    'Tháng 5',
                    'Tháng 6',
                    'Tháng 7',
                    'Tháng 8',
                    'Tháng 9',
                    'Tháng 10',
                    'Tháng 11',
                    'Tháng 12',
                ],
                datasets: [{
                    label: 'Thống kê doanh thu',
                    data: {!! $revenueInMonths !!},
                    fill: false,
                    borderColor: '#00559f',
                    tension: 0.1,
                    pointBackgroundColor: '#ccc',
                    fill: true,
                    backgroundColor: '#00559f',
                    tension: 0.4,
                    pointRadius: 0,
                    hoverPointRadius: 0
                }],
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        min: 0,
                        max: 100000000,
                        ticks: {
                            stepSize: 10000000
                        }
                    },
                    x: {
                        beginAtZero: true,
                        grid: {
                          display: false,
                        }
                    }
                }
            }
        });


        const ctx2 = document.getElementById('reviewProductChart');
        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: [
                    '1',
                    '2',
                    '3',
                    '4',
                    '5',
                ],
                datasets: [{
                    label: 'My First Dataset',
                    data: {!! $clientRatings !!},
                    backgroundColor: [
                        '#ef476f',
                        '#ffd166',
                        '#06d6a0',
                        '#118ab2',
                        '#073b4c',
                    ],
                    hoverOffset: 4
                }]
            }
            


        });

        const ctx3 = document.getElementById('mostBuyProductChart');
        new Chart(ctx3, {
            type: 'line',
            data: {
                labels: [
                    'Tháng 1',
                    'Tháng 2',
                    'Tháng 3',
                    'Tháng 4',
                    'Tháng 5',
                    'Tháng 6',
                    'Tháng 7',
                    'Tháng 8',
                    'Tháng 9',
                    'Tháng 10',
                    'Tháng 11',
                    'Tháng 12',
                ],
                datasets: [{
                    label: 'Thống kê người dùng đăng ký',
                    data: {!! $clientRegistedInMonths !!},
                    fill: false,
                    borderColor: '#00559f',
                    fill: false,
                    backgroundColor: '#fff',
                }],
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        min: 0,
                        max: 100,
                        ticks: {
                            stepSize: 10
                        }

                    }
                }
            }
        });
    </script>
@endpush
