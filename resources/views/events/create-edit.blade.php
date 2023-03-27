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
<div class="col-lg-6 col-xs-12">
    <div class="box-content card white">
        <h4 class="box-title">Event</h4>
        <!-- /.box-title -->
        <div class="card-content">
            @if ($event->id)
            <form action="{{ route('events.update', $event->id)}}" method="post" enctype="multipart/form-data">
                @method('PUT')
            <div class="card-header">
                <strong>Edit Event</strong>
                <a href="{{ route('events.index') }}" class="btn btn-primary btn-sm float-right"><i class="fa fa-angle-double-left"></i> Back </a>
            @else
            <form action="{{ route('events.store') }}" method="post" enctype="multipart/form-data">
            <div class="card-header">
                <strong>Add New Event</strong>
                <a href="{{ route('events.index') }}" class="btn btn-primary btn-sm float-right"><i class="fa fa-angle-double-left"></i> Back </a>
            @endif
            @csrf
            </div>
            <div class="my-2">
                <label for="event_name" class="d-block text-muted">Event Name</label>
                <input name="name" id="name" type="text" class="form-control"
                @error('name')is-invalid @enderror
                required value="{{$event->name ?? ''}}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="my-2">
                <label for="description" class="d-block text-muted"> Description</label>
                <input name="description" id="description" type="text" class="form-control"
                @error('description')is-invalid @enderror
                required value="{{$event->description ?? ''}}">
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="my-2">
                <label for="closure" class="d-block text-muted">Closure Date</label>
                <input type="date" name="closure" id="closure" type="text" class="form-control"
                @error('closure')is-invalid @enderror
                required value="{{$event->closure ?? ''}}">
                @error('closure')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="my-2">
                <label for="final_closure" class="d-block text-muted">Final Closure Date</label>
                <input type="date" name="final_closure" id="final_closure" type="text" class="form-control"
                @error('final_closure')is-invalid @enderror
                required value="{{$event->final_closure ?? ''}}">
                @error('final_closure')
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
