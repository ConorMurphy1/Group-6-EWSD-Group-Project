<div class="card-body">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm border-primary p-2 position-relative">
                <div class="custom-heading bg-primary">Role</div>
                <div class="card">

            </div>
        </div>
        <div class="col-md-4">

        </div>
    </div>
</div>

@extends('layouts.app')
@section('content')
<div class="col-lg-6 col-xs-12">
    <div class="box-content card white">
        <h4 class="box-title">Role</h4>
        <!-- /.box-title -->
        <div class="card-content">
            @if ($role->id)
            <form action="{{ route('roles.update', $role->id)}}" method="post" enctype="multipart/form-data">
                @method('PUT')
            <div class="card-header">
                <strong>Edit Role</strong>
                <a href="{{ route('roles.index') }}" class="btn btn-primary btn-sm float-right"><i class="fa fa-angle-double-left"></i> Back </a>
            @else
            <form action="{{ route('roles.store') }}" method="post" enctype="multipart/form-data">
            <div class="card-header">
                <strong>Create Role</strong>
                <a href="{{ route('roles.index') }}" class="btn btn-primary btn-sm float-right"><i class="fa fa-angle-double-left"></i> Back </a>
            @endif
            @csrf
            </div>
            <div class="my-2">
                <label for="role_name" class="d-block text-muted">Role Name</label>
                <input name="role" id="role" type="text" class="form-control"
                @error('role')is-invalid @enderror
                required value="{{$role->role ?? ''}}">
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex justify-content-end my-2">
                <button type="submit" class="btn btn-primary btn-ladda">Save</button>
            </div>
        </form>
        </div>

        <!-- /.card-content -->
    </div>
    <!-- /.box-content -->
</div>
@endsection
