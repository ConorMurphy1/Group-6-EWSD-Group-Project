@extends('layouts.app')
@section('content')
<div class="col-md-12">
    <div class="box-content card white">
        <h4 class="box-title">Basic example</h4>
        <!-- /.box-title -->
        <div class="card-content">
            @if ($category->id)
            <form action="{{ route('categories.update', $category->id)}}" method="post" enctype="multipart/form-data">
                @method('PUT')
            <div class="card-header">
                <strong>Category Edit Form</strong>
                <a href="{{ route('categories.index') }}" class="btn btn-primary btn-sm float-right"><i class="fa fa-angle-double-left"></i> Back </a>
            @else
            <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
            <div class="card-header">
                <strong>Category Create Form</strong>
                <a href="{{ route('categories.index') }}" class="btn btn-primary btn-sm float-right"><i class="fa fa-angle-double-left"></i> Back </a>
            @endif
            @csrf
            </div>
            <div class="my-2">
                <label for="" class="d-block text-muted">Title</label>
                <input name="name" type="text" class="form-control" required value="{{$category->name ?? ''}}">
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
</div>
@endsection

