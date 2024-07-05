
@extends('admin.layouts.admin_master')

@section('title', 'Sửa thuộc tính')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if (session()->has('msg'))
                                <p class="alert alert-success text-center py-2">Cập nhật thuộc tính thành công</p>
                            @endif

                            @if ($errors->any())
                                <p class="alert alert-danger text-center">Đã có lỗi xảy ra, vui lòng kiểm tra lại dữ liệu
                                    nhập vào</p>
                            @endif

                            <form 
                                method="POST"
                                action="{{ route('admin.attributes.update', $attribute) }}"
                            >
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label for="name">Tên thuộc tính</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{ $attribute->name }}" placeholder="Nhập tên nhóm thuộc tính">
                                    @error('name')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" class="form-control" name="slug" id="slug" value="{{$attribute->slug}}" placeholder="Slug">
                                    @error('slug')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Cập nhật thuộc tính</button>
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



















{{-- @extends('admin.layouts.admin_master')

@section('title', 'Sửa thuộc tính')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if (session()->has('msg'))
                                <p class="alert alert-success text-center py-2">Cập nhật thuộc tính thành công</p>
                            @endif

                            @if ($errors->any())
                                <p class="alert alert-danger text-center">Đã có lỗi xảy ra, vui lòng kiểm tra lại dữ liệu
                                    nhập vào</p>
                            @endif

                            <form class="" method="POST"
                                action="{{ route('admin.attributes.update', $attribute) }}">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label for="name">Tên nhóm thuộc tính</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{ $attribute->name }}" placeholder="Nhập tên thuộc tính">
                                    @error('name')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="group_attribute_id">Nhóm thuộc tính</label>
                                    <select class="form-control" name="group_attribute_id" id="group_attribute_id">
                                        @foreach ($groupAttributes as $groupAttribute)
                                            <option 
                                                value="{{$groupAttribute->id}}"
                                                {{$attribute->groupAttribute->id==$groupAttribute->id ? 'selected' : false}}
                                            >{{$groupAttribute->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('group_attributes')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Cập nhật thuộc tính</button>
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
@endsection --}}
