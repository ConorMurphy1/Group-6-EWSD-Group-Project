@extends('layouts.app')
@section('content')
<div class="card-body">
    <div class="col-lg-6 col-xs-12">
        <div class="box-content card white">
            <h4 class="box-title">Basic example</h4>
            <!-- /.box-title -->
            <div class="card-content">
                @if ($idea->id)
                <form action="{{ route('ideas.update', $idea->id)}}" method="post" enctype="multipart/form-data">
                    @method('PATCH')
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
                        <label for="" class="d-block text-muted">Image</label>
                        <input name="image" type="file" accept="image/*" id="imgInp" value="{{$idea->image ?? ''}}">
                        <div class="d-flex justify-content-center">
                            <img id="displayImg" src="{{ asset('storage/images/'.$idea->image) }}" alt="your image" class="w-50" />
                        </div>
                    </div>
                    <div class="my-2">
                        <label for="" class="d-block text-muted">File</label>
                        <input name="document" type="file" accept="application/pdf,xls,doc" value="{{$idea->document ?? ''}}">
                    </div>
                    <div class="my-2">
                        <label for="" class="d-block text-muted">Title</label>
                        <input name="title" type="text" class="form-control" required value="{{$idea->title ?? ''}}">
                    </div>
                    <div class="my-2">
                        <label for="" class="d-block text-muted">Anonymous</label>
                        {{-- <input name="is_anonymous" type="checkbox" value="yes"> --}}
                        <select name="is_anonymous" id="" required>
                            <option >Choose option</option>
                            <option value="no" {{strtolower($idea->is_anonymous) == 'no' ? 'selected' : ''}}>No</option>
                            <option value="yes" {{strtolower($idea->is_anonymous) == 'yes' ? 'selected' : ''}}>Yes</option>
                        </select>
                    </div>
                    <div class="my-2">
                        <label for="" class="d-block text-muted">Description</label>
                        <textarea name="description" id="" cols="30" rows="10" class="form-control" >{{$idea->description ?? ''}}</textarea>
                    </div>
                    <div class="my-2">
                        <label for="" class="d-block text-muted">Events</label>
                        <select name="event_id" required>
                            <option >Choose an Event</option>
                            @foreach ($events as $event)
                                <option value="{{ $event->id }}" @if ($idea->event_id == $event->id)
                                    selected
                                @endif > {{ $event->name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="my-2">
                        <label for="" class="d-block text-muted">Closure Date</label>
                        <input name="closure_date" type="date" class="form-control" value="{{$idea->closure_date ?? ''}}">
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

