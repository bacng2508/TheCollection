@extends('client.layouts.client_master')

@section('page-content')
    <div class="container py-5" style="min-height: 620px;">
        <div class="row">
            @include('client.profile.sidebar')
            <div class="col-9 p-5">
                <h3>Đánh giá sản phẩm</h3>
                <table id="example2" class="table table-hover text-center mb-3">
                    <thead class="text-center">
                        <tr>
                            <th width="5%">#</th>
                            <th width="30%">Tên sản phẩm</th>
                            <th width="15%">rating</th>
                            <th width="50%">Nội dung</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($myReviews as $key => $review)
                            <tr>
                                <td style="vertical-align: middle;">{{ $key + 1 }}</td>
                                <td style="vertical-align: middle;">{{ $review->product->name }}</td>
                                </td>
                                <td style="vertical-align: middle;">
                                    @for ($i = 0; $i < $review->rating; $i++)
                                        <i class="fa-solid fa-star text-warning"></i>
                                    @endfor
                                </td>
                                <td class="text-left" style="vertical-align: middle;">{{ $review->content }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    {{ $myReviews->links() }}
                </div>
                @if ($myReviews->count() == 0)
                    <div class="text-center my-4">
                        <span>Bạn chưa đánh giá sản phẩm nào</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection


@push('jsHandle')
    <script type="text/javascript"></script>
@endpush
