@extends('admin.layouts.admin_master')

@section('title', "Phân quyền: $role->display_name")

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

                            <form class="" method="POST" action="{{ route('admin.roles.storeAuthorization', $role) }}">
                                @csrf
                                <table class="table table-bordered ">
                                    <thead>
                                        <tr class="text-center">
                                            <th width="15%">Module</th>
                                            <th>Quyền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permissionGroups as $permissionGroup)
                                            <tr>
                                                <td class="pl-4 font-weight-bold" style="vertical-align: middle;">{{ $permissionGroup->display_name }}</td>
                                                <td>
                                                    <div class="row pl-4 flex-grow-1">
                                                        @foreach ($permissionGroup->permissions as $permission)
                                                            <div class="col-2 d-flex align-items-center mb-2">
                                                                <input type="checkbox" name="permission_ids[]" id="permission_id_{{$permission->id}}" value="{{$permission->id}}"
                                                                {{$permissionChecked->contains('id', $permission->id) ? 'checked' : ''}} >
                                                                <label for="permission_id_{{$permission->id}}" class="pl-2 mb-0 font-weight-normal">{{ $permission->display_name }}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Lưu phân quyền</button>
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
