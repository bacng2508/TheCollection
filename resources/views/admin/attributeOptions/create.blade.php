@extends('admin.layouts.admin_master')

@section('title', 'Thêm giá trị thuộc tính')

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

                            <form class="" method="POST" action="{{ route('admin.attributeOptions.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="value">Giá trị thuộc tính</label>
                                    <input type="text" class="form-control" name="value" id="value"
                                        value="{{ old('value') }}" placeholder="Nhập giá trị thuộc tính">
                                    @error('value')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control" name="slug" id="slug" value="{{old('slug')}}"
                                        placeholder="Slug">
                                    @error('slug')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="attribute_id">Thuộc tính</label>
                                    <select class="form-control" name="attribute_id" id="attribute_id">
                                        <option value="0">Chọn thuộc tính</option>
                                        @foreach ($attributes as $attribute)
                                            <option value="{{$attribute->id}}" {{old('attribute_id')==$attribute->id?'selected':false}}>{{$attribute->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('attribute_id')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Thêm giá trị thuộc tính</button>
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
        const title = document.querySelector('#value');
        const slug = document.querySelector('#slug')
        title.addEventListener('keyup', (e) => {
            const titleValue = e.target.value;
            slug.value = getSlug(titleValue);
        })

        slug.addEventListener('change', () => {
            if (slug.value === "") {
                const title = document.querySelector("#value");
                const titleValue = title.value;
                slug.value = getSlug(titleValue);
            }
        });
    </script>
@endpush


