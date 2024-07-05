@extends('admin.layouts.admin_master')

@section('title', 'Sửa danh mục')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if (session()->has('msg'))
                                <p class="alert alert-success text-center py-2">Cập nhật thương hiệu thành công</p>
                            @endif

                            @if ($errors->any())
                                <p class="alert alert-danger text-center">Đã có lỗi xảy ra, vui lòng kiểm tra lại dữ liệu nhập vào</p>
                            @endif

                            <form class="" method="POST" action="{{route('admin.brands.update', $brand)}}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Tên thương hiệu</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{$brand->name}}" placeholder="Nhập tên thương hiệu">
                                    @error('name')
                                        <div class="form-text text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control" name="slug" id="slug" value="{{$brand->slug}}" placeholder="Slug">
                                </div>
                                <div class="form-group">
                                    <label for="logo">Logo</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="logo" name="logo">
                                            <label class="custom-file-label" for="logo">Chọn ảnh</label>
                                        </div>
                                    </div>
                                    @error('logo')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="mt-3">
                                        <img src="{{ asset('storage/'.$brand->logo)}}" width="300px;" alt="">
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
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
