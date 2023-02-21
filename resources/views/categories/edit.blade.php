@extends('categories.layout')
@section('content')
<div class="card">
  <div class="card-header">Edit Page</div>
  <div class="card-body">
      
  <form action="{{ url('category/' .$category->id) }}" method="post">
        {!! csrf_field() !!}
        {{ method_field('PUT') }}
        <label>Name</label></br>
        <input type="text" name="name" id="name" value="{{$category->name}}" class="form-control"></br>
        <button type="submit" class="btn btn-success btn-sm" title="Update Category"><i class="fa fa-trash-o" aria-hidden="true"></i> Update</button>
    </form>
  </div>
</div>
@stop