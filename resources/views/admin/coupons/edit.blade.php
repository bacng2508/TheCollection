@extends('admin.layouts.admin_master')

@section('title', 'Sửa coupon')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if ($errors->any())
                                <p class="alert alert-danger text-center">Đã có lỗi xảy ra, vui lòng kiểm tra lại dữ liệu
                                    nhập vào</p>
                            @endif

                            @if (session()->has('msg'))
                                <p class="alert alert-success text-center py-2">{{session('msg')}}</p>
                            @endif

                            <form class="" method="POST" action="{{ route('admin.coupons.update', $coupon) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Tên coupon</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{$coupon->name}}"
                                        placeholder="Nhập tên coupon">
                                    @error('name')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="value">Giá trị</label>
                                    <input type="text" class="form-control" name="value" id="value" value="{{$coupon->value}}"
                                        placeholder="Nhập giá trị">
                                    @error('value')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="expire_date">Ngày hết hạn</label>
                                    <input type="date" class="form-control" name="expire_date" id="expire_date" value="{{date('Y-m-d', strtotime($coupon->expire_date))}}">
                                    @error('expire_date')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Sửa coupon</button>
                                </div>
                                <!-- /.card-body -->
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div>
    </section>
@endsection

@push('jsHandle')
    <script>
        const title = document.querySelector('#name');
        const slug = document.querySelector('#slug')
        title.addEventListener('keyup', (e) => {
            const titleValue = e.target.value;
            slug.value = getSlug(titleValue);
        })

        slug.addEventListener('change', () => {
            if (slug.value === "") {
                const title = document.querySelector("#name");
                const titleValue = title.value;
                slug.value = getSlug(titleValue);
            }
        });
    </script>
@endpush
