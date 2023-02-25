<div class="card-body">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm border-primary p-2 position-relative">
                <div class="custom-heading bg-primary">Input Data</div>
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
        <h4 class="box-title">Basic example</h4>
        <!-- /.box-title -->
        <div class="card-content">
            @if ($idea->id)
            <form action="{{ route('ideas.update', $idea->id)}}" method="post" enctype="multipart/form-data">
                @method('PUT')
            <div class="card-header">
                <strong>Idea Edit Form</strong>
                <a href="{{ route('ideas.index') }}" class="btn btn-primary btn-sm float-right"><i class="fa fa-angle-double-left"></i> Back </a>
            @else
            <form action="{{ route('ideas.store') }}" method="post" enctype="multipart/form-data">
            <div class="card-header">
                <strong>Idea Create Form</strong>
                <a href="{{ route('ideas.index') }}" class="btn btn-primary btn-sm float-right"><i class="fa fa-angle-double-left"></i> Back </a>
            @endif
            @csrf
            </div>
            <div class="my-2">
                <label for="" class="d-block text-muted">Cover Photo</label>
                <input name="image" type="file" accept="image/*" id="imgInp" >
                <div class="d-flex justify-content-center">
                    <img id="displayImg" src="{{ asset('images/img.png') }}" alt="your image" class="w-50" />
                </div>
            </div>
            <div class="my-2">
                <label for="" class="d-block text-muted">File</label>
                <input name="document" type="file" accept="application/pdf,xls,doc" >
            </div>
            <div class="my-2">
                <label for="" class="d-block text-muted">Title</label>
                <input name="title" type="text" class="form-control" required>
            </div>
            <div class="my-2">
                <label for="" class="d-block text-muted">Anonymous</label>
                {{-- <input name="is_anonymous" type="checkbox" value="yes"> --}}
                <select name="is_anymous" id="" required>
                    <option >Choose option</option>
                    <option value="no">No</option>
                    <option value="yes">Yes</option>
                </select>
            </div>
            <div class="my-2">
                <label for="" class="d-block text-muted">Description</label>
                <textarea name="description" id="" cols="30" rows="10" class="form-control" ></textarea>
            </div>
            <div class="my-2">
                <label for="" class="d-block text-muted">Closure Date</label>
                <input name="closure_date" type="date" class="form-control">
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
@section('javascript')
<script>
    imgInp.onchange = evt => {
    const [file] = imgInp.files
        if (file) {
            displayImg.src = URL.createObjectURL(file)
        }
    }
</script>
@endsection

