@extends('admin.layouts.admin_master')

@section('title', 'Danh sách thông báo')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-6">
                    <div class="mb-3 text-right">
                        @if ($hasNewNotification)
                            <a href="{{ route('admin.notification.read-all') }}">Đánh dấu tất cả đã đọc</a>
                        @endif
                    </div>
                    <div class="card p-2">
                        @foreach ($notificationList as $notification)
                            <div class="py-2 dropdown-item d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-start align-items-start">
                                    <i class="fas fa-bell mr-3 mt-2 text-warning" style="font-size: 26px"></i>
                                    <div>
                                        <h5 class="my-0 font-weight-bold" style="font-size: 20px">{{ $notification->data['title'] }}</h5>
                                        <span style="font-size: 12px" class="text-muted">{{ $notification->data['message'] }}</span>
                                    </div>
                                </div>
                                @if ($notification->read_at == null)
                                    <i class="fa-solid fa-circle text-primary" style="font-size: 10px;"></i>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <!-- /.card -->
                    <div class="d-flex justify-content-end">
                        {{$notificationList->links()}}
                    </div>
                </div>
                <!-- /.col -->
            </div>
        </div>
    </section>
@endsection


@push('jsHandle')
    <script type="text/javascript">
        var deleteItemBtn = document.querySelectorAll('.deleteItemBtn');
        
        deleteItemBtn.forEach((element) => {
            element.addEventListener('click', (e) => {
                e.preventDefault();
                Swal.fire({
                    title: "Bạn có chắc chắn muốn xóa không?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Đồng ý",
                    cancelButtonText: "Hủy bỏ"
                    }).then((result) => {
                    if (result.isConfirmed) {
                        element.parentElement.submit();
                    }
                });
            })
        })
    </script>
@endpush