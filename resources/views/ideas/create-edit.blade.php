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
                        <select name="event_id">
                            <option >Choose an Event</option>
                            @foreach ($events as $event)
                                <option required value="{{ $event->id }}" @if ($idea->event_id == $event->id)
                                    selected
                                @endif > {{ $event->name }} </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="button" onclick="conditionsModal()" class="btn btn-primary btn-ladda">Save </button>
                </div>

                <div hidden id="termsCondition">
                    <h1>Terms and Conditions</h1>
                    <p>Welcome to our website. If you continue to browse and use this website, you are agreeing to comply with and be bound by the following terms and conditions of use:</p>
                    <ul>
                        <li>Use of the Website</li>
                        <li>Disclaimer</li>
                        <li>Intellectual Property</li>
                        <li>Third-Party Links</li>
                        <li>Privacy Policy</li>
                        <li>Limitation of Liability</li>
                        <li>Governing Law</li>
                        <li>Changes to the Terms and Conditions</li>
                    </ul>
                    <p>If you disagree with any part of these terms and conditions, please do not use our website
                        <br>
                    <input type="checkbox" id="agree" onclick="enableSave()"> <label for="">Accept Terms & Condition</label>
                    <div class="d-flex justify-content-end my-2">
                        <button type="submit" class="btn btn-primary btn-ladda" id="save" disabled>Save</button>
                    </div>
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
    // Code displays the image
    imgInp.onchange = evt => {
    const [file] = imgInp.files
        if (file) {
            displayImg.src = URL.createObjectURL(file)
        }
    }
    // The terms and conditions Modal
    function conditionsModal() {
        // alert('Conditions');
        document.getElementById("termsCondition").removeAttribute('hidden');
    }

    function enableSave(){
        document.getElementById("save").removeAttribute('disabled');
    }
</script>
@endsection

