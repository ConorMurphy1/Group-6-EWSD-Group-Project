@extends('userpanel.layout.app')

@section('content')

<div class="tt-categories-list col-lg-12">
<main id="tt-pageContent">
    <div class="container">
            @if ($idea->id)
            <form action="{{ route('idea.users.update', $idea->id)}}" method="post" enctype="multipart/form-data" class="form-default form-create-topic">
            @method('PUT')
            <div class="tt-wrapper-inner">
                <h1 class="tt-title-border">
                    Edit Idea
                </h1>
            @else
                <form action="{{ route('ideas.store') }}" method="post" enctype="multipart/form-data" class="form-default form-create-topic" id="terms">
            <div class="tt-wrapper-inner">
                <h1 class="tt-title-border">
                    Create New Idea
                </h1>
            @endif
            @csrf
                <div class="form-group">
                    <label for="inputTopicTitle">Idea Title</label>
                    <div class="tt-value-wrapper">
                        <input name="title" type="text" id="title" class="form-control" required value="{{$idea->title ?? ''}}" data-word-count="99;postTitle" maxlength="99" onkeyup="count_down(this)" >
                        <span class="tt-value-input" id="postTitle">99</span>
                    </div>
                    <div class="tt-note">Describe your topic well, while keeping the subject as short as possible.</div>
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="pt-editor">
                    <h6 class="pt-title">Idea Description</h6>
                    <div class="form-group">
                        <textarea name="description" class="form-control" id="description" rows="5" placeholder="Lets get started">{{$idea->description ?? ''}}</textarea>
                    </div>
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputTopicTags">Event</label>
                                <select name="event_id" id="event_id" class="form-control">
                                    <option >Choose an Event</option>
                                    @foreach ($events as $event)
                                        <option required value="{{ $event->id }}"
                                        @if ($idea->event_id == $event->id)
                                            selected
                                        @endif > {{ $event->name }} </option>
                                    @endforeach
                                </select>
                                @error('event_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputTopicTags">Anonymous</label>
                                <select name="is_anonymous" id="is_anonymous" required class="form-control">
                                    <option value="0" {{strtolower($idea->is_anonymous) == '0' ? 'selected' : ''}}>No</option>
                                    <option value="1" {{strtolower($idea->is_anonymous) == '1' ? 'selected' : ''}}>Yes</option>
                                </select>
                                @error('is_anonymous')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputTopicTags">Department</label>
                                <input type="text" readonly class="form-control" id="inputTopicTags" value="{{auth()->user()->department->name}}">
                                <input type="hidden" readonly name="department_id" class="form-control" id="department_id" value="{{auth()->user()->department->id}}">
                            </div>
                            @error('department_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <div class="form-group">
                            <h6 class="pt-title">Category</h6>
                            @if ($idea->id)
                            <select class="form-control" id="field1" multiple onchange="console.log(Array.from(this.selectedOptions).map(x=>x.value??x.text))" multiselect-hide-x="true" name="category_ids[]" required>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}" @if(in_array($category->id, $idea->categories()->select('id')->get()->toArray())) selected @endif>{{$category->name}}</option>
                                @endforeach
                            </select>
                            @else
                            <select class="form-control" multiple onchange="console.log(Array.from(this.selectedOptions).map(x=>x.value??x.text))" multiselect-hide-x="true" name="category_ids[]" required>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}" >{{$category->name}}</option>
                                @endforeach
                            </select>
                            @endif
                            @error('category_ids')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        </div>
                    </div>
                    <div class="my-2">
                        <label for="" class="d-block text-muted">Image</label>
                        <input name="image" type="file" accept="image/*" id="image" value="{{$idea->image ?? ''}}">
                        <div class="d-flex justify-content-center">
                            <img id="displayImg" src="{{ asset('storage/images/'.$idea->image) }}" alt="your image" class="w-50" />
                        </div>
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="my-2">
                        <label for="" class="d-block text-muted">File</label>
                        <input name="document" type="file" accept="application/pdf,xls,doc" id="document" value="{{$idea->document ?? ''}}">
                    </div>
                    @error('document')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="row">
                        <div class="col-auto ml-md-auto mb-3">
                            <a href="{{route('ideas.feed')}}" class="btn btn-warning btn-width-lg">Back</a>
                            @if ($idea->id)
                            <button type="submit"  class="btn btn-secondary btn-width-lg">Edit Post</button>
                            @else
                            <button type="button" data-remodal-target="remodal" class="btn btn-secondary btn-width-lg">Create Post</button>
                            @endif
                        </div>
                    @include('ideas.modal')

                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
</div>
@endsection

@section('user-javascript')
<script src="{{ asset('usertemplate/build/js/multiselect-dropdown.js')}}" ></script>
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

    function submitForm (){
        console.log('hello')
        document.getElementById('terms').submit()
    }

    function conditionsModal(title, description, is_anonymous, category_ids, image, event_id, department_id) {
        $('#title').val(title);
        $('#description').val(description);
        $('#is_anonymous').val(is_anonymous);
    }
    function count_down(obj){
        const data_length = obj.getAttribute('data-word-count').split(";")[0];
        const postTitle = document.getElementById(obj.getAttribute('data-word-count').split(";")[1]);
        // alert(postTitle);


        postTitle.innerHTML = data_length - obj.value.length;
        // window.alert("dfad");

        if (data_length - obj.value.length < 5) {
            postTitle.style.color = 'red';
        }
        else
        {
            postTitle.style.color = 'black';
        }
    }
</script>
@endsection

