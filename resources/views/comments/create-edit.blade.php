<div class="card-body">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm border-primary p-2 position-relative">
                <div class="custom-heading bg-primary">Comment</div>
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
        <h4 class="box-title">Comment</h4>
        <!-- /.box-title -->
        <div class="card-content">
            @if ($comment->id)
            <form action="{{ route('comments.update', $comment->id)}}" method="post" enctype="multipart/form-data">
                @method('PUT')
            <div class="card-header">
                <strong>Comment</strong>
                <a href="{{ route('comments.index') }}" class="btn btn-primary btn-sm float-right"><i class="fa fa-angle-double-left"></i> Back </a>
            @else
            <form action="{{ route('comments.store') }}" method="post" enctype="multipart/form-data">
            <div class="card-header">
                <strong>Comment</strong>
                <a href="{{ route('comments.index') }}" class="btn btn-primary btn-sm float-right"><i class="fa fa-angle-double-left"></i> Back </a>
            @endif
            @csrf
            </div>

            <div class="my-2">
                <label for="" class="d-block text-muted">Anonymous</label>
                {{-- <input name="is_anonymous" type="checkbox" value="yes"> --}}
                <select name="is_anonymous" id="" required>
                    <option >Choose option</option>
                    <option value="no" {{strtolower($comment->is_anonymous) == 'no' ? 'selected' : ''}}>No</option>
                    <option value="yes" {{strtolower($comment->is_anonymous) == 'yes' ? 'selected' : ''}}>Yes</option>
                </select>
            </div>
            <div class="my-2">
                <label for="" class="d-block text-muted">Select ideas</label>
                {{-- <input name="is_anonymous" type="checkbox" value="yes"> --}}
                <select name="id" id="" required>
                    <option >Choose Ideas</option>
                    @foreach ($ideas as $idea)
                        <option value="{{$idea->id}}">{{$idea->id}}</option>
                    @endforeach
                </select>
            </div>

            <div class="my-2">
                <label for="comment" class="d-block text-muted">Comment</label>
                <textarea name="comment" id="comment" cols="30" rows="10" class="form-control" >{{$comment->comment ?? ''}}</textarea>
            </div>

            <div class="d-flex justify-content-end my-2">
                <button type="submit" class="btn btn-primary btn-ladda">Comment</button>
            </div>
        </form>
        </div>
        
        <!-- /.card-content -->
    </div>
    <!-- /.box-content -->
</div>
@endsection