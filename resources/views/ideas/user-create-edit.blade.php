@extends('userpanel.layout.app')

@section('content')

<main id="tt-pageContent">
    <div class="container">
            <form class="form-default form-create-topic">
        @if ($idea->id)
        <form action="{{ route('ideas.update', $idea->id)}}" method="post" enctype="multipart/form-data" class="form-default form-create-topic">
            @method('PATCH')
            <div class="tt-wrapper-inner">
                <h1 class="tt-title-border">
                    Edit Idea
                </h1>
            @else
            <form action="{{ route('ideas.store') }}" method="post" enctype="multipart/form-data" class="form-default form-create-topic">
            <div class="tt-wrapper-inner">
                <h1 class="tt-title-border">
                    Create New Idea
                </h1>
            @endif
            @csrf
                <div class="form-group">
                    <label for="inputTopicTitle">Idea Title</label>
                    <div class="tt-value-wrapper">
                        <input name="title" type="text" class="form-control" required value="{{$idea->title ?? ''}}" >
                        <span class="tt-value-input">99</span>
                    </div>
                    <div class="tt-note">Describe your topic well, while keeping the subject as short as possible.</div>
                </div>
                <div class="pt-editor">
                    <h6 class="pt-title">Idea Description</h6>
                    <div class="form-group">
                        <textarea name="description" class="form-control" rows="5" placeholder="Lets get started">{{$idea->description ?? ''}}</textarea>
                    </div>
                    <div class="row">
                        <div class="form-group ">
                            <p class="margin-top-20">Category</p>
                            <select class="select2_2" multiple="multiple" name="category_ids[]">
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputTopicTitle">Event</label>
                                <select name="event_id" class="form-control">
                                    <option >Choose an Event</option>
                                    @foreach ($events as $event)
                                        <option required value="{{ $event->id }}" @if ($idea->event_id == $event->id)
                                            selected
                                        @endif > {{ $event->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputTopicTags">Anonymous</label>
                                <select name="is_anonymous" id="" required class="form-control">
                                    <option >Choose option</option>
                                    <option value="no" {{strtolower($idea->is_anonymous) == 'no' ? 'selected' : ''}}>No</option>
                                    <option value="yes" {{strtolower($idea->is_anonymous) == 'yes' ? 'selected' : ''}}>Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputTopicTags">Department</label>
                                <input type="text" readonly name="name" class="form-control" id="inputTopicTags" value="{{auth()->user()->department->name}}">
                            </div>
                        </div>
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
                    <div class="row">
                        <div class="col-auto ml-md-auto">
                            <button type="submit" class="btn btn-secondary btn-width-lg">Create Post</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

@endsection

@section('user-javascript')
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

