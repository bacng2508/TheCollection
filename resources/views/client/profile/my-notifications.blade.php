@extends('client.layouts.client_master')

@section('page-content')
    <div class="container py-5" style="min-height: 620px;">
        <div class="row">
            @include('client.profile.sidebar')
            <div class="col-9 p-5">
                <h3>Danh sách Thông báo</h3>
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th width="">#</th>
                            <th width="">Tiêu đề</th>
                            <th width="">Nội dung</th>
                            <th width="">Ngày tạo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($myNotifications as $key => $notification)
                            <tr>
                                <td style="vertical-align: middle;">{{ $key + 1 }}</td>
                                <td style="vertical-align: middle;">{{ $notification->data['title'] }}</td>
                                <td style="vertical-align: middle;">{{ $notification->data['message'] }}</td>
                                <td style="vertical-align: middle;">
                                    {{ date('H:i - d/m/Y ', strtotime($notification->created_at)) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    {{ $myNotifications->links() }}
                </div>
                @if ($myNotifications->count() == 0)
                    <div class="text-center my-4">
                        <span>Không có thông báo nào</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection


@push('jsHandle')
    <script type="text/javascript"></script>
@endpush
