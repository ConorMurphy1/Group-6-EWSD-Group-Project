<div class="card-body">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm border-primary p-2 position-relative">
                <div class="custom-heading bg-primary">Department</div>
                <div class="card">

            </div>
        </div>
        <div class="col-md-4">

        </div>
    </div>
</div>

@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="box-content card white">
        <h4 class="box-title">Department</h4>
        <!-- /.box-title -->
        <div class="card-content">
            @if ($department->id)
            <form action="{{ route('departments.update', $department->id)}}" method="post" enctype="multipart/form-data">
                @method('PUT')
            <div class="card-header">
                <strong>Edit Department</strong>
                <a href="{{ route('departments.index') }}" class="btn btn-primary btn-sm float-right"><i class="fa fa-angle-double-left"></i> Back </a>
            @else
            <form action="{{ route('departments.store') }}" method="post" enctype="multipart/form-data">
            <div class="card-header">
                <strong>Add New Department</strong>
                <a href="{{ route('departments.index') }}" class="btn btn-primary btn-sm float-right"><i class="fa fa-angle-double-left"></i> Back </a>
            @endif
            @csrf
            </div>
            <div class="my-2">
                <label for="name" class="d-block text-muted">Department Name</label>
                <input name="name" id="name" type="text" class="form-control"
                @error('name')is-invalid @enderror
                required value="{{$department->name ?? ''}}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="my-2">
                <label for="description" class="d-block text-muted">Department Description</label>
                <input name="description" id="description" type="text" class="form-control"
                @error('description')is-invalid @enderror
                required value="{{$department->description ?? ''}}">
                @error('description')
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
