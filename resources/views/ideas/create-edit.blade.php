@extends('layouts.app')
@section('content')
<div class="card-body">
    <div class="col-md-12">
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
                    <form action="{{ route('ideas.store') }}" method="post" enctype="multipart/form-data" id="terms">
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
                        <!-- <label for="" class="d-block text-muted">Anonymous</label> -->
                        <label for="" class="block mb-2 font-medium text-gray-900 dark:text-white">Anonymous</label>
                        <!-- <input name="is_anonymous" type="checkbox" value="yes"> -->
                        <!-- <select name="is_anonymous" id="" required>
                            <option >Choose option</option>
                            <option value="no" {{strtolower($idea->is_anonymous) == 'no' ? 'selected' : ''}}>No</option>
                            <option value="yes" {{strtolower($idea->is_anonymous) == 'yes' ? 'selected' : ''}}>Yes</option>
                        </select> -->
                        
                       <!------------------------------------------------------------------->

                        <select name="is_anonymous" id="" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option >Choose Option</option>
                        <option value="no" {{strtolower($idea->is_anonymous) == 'no' ? 'selected' : ''}}>No</option>
                            <option value="yes" {{strtolower($idea->is_anonymous) == 'yes' ? 'selected' : ''}}>Yes</option>
                </select>
                    </div>
                    <div class="my-2">
                        <label for="" class="d-block text-muted">Description</label>
                        <textarea name="description" id="" cols="30" rows="10" class="form-control" >{{$idea->description ?? ''}}</textarea>
                    </div>
                    <div class="my-2">
                        <p class="margin-top-20">Category</p>
                        <select class="select2_2 form-control" multiple="multiple" name="category_ids[]" required>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="my-2">
                        <!-- <label for="" class="d-block text-muted">Events</label> -->
                        <label for="event_id" class="block mb-2 font-medium text-gray-900 dark:text-white">Events</label>
                        <!-- <select name="event_id">
                            <option >Choose an Event</option>
                            @foreach ($events as $event)
                                <option required value="{{ $event->id }}" @if ($idea->event_id == $event->id)
                                    selected
                                @endif > {{ $event->name }} </option>
                            @endforeach
                        </select> -->

                        <select name="event_id" id="event_id" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option >Choose an Event</option>
                        @foreach ($events as $event)
                        <option required value="{{ $event->id }}" @if ($idea->event_id == $event->id)
                                    selected
                                @endif > {{ $event->name }} </option>
                    @endforeach
                </select>
                    </div>

                    <!-- <button type="button" onclick="conditionsModal()" class="btn btn-primary btn-ladda" data-toggle="modal" data-target="#termsCondition">Save </button> -->
                    @if ($idea->id)
                        <button type="submit"  data-remodal-target="remodal" class="btn btn-primary waves-effect waves-light">Save</button>
                    @else
                        <button type="button"  data-remodal-target="remodal" class="btn btn-primary waves-effect waves-light">Save</button>
                    @endif
                    <!-- <button type="button" onclick="conditionsModal()" class="btn btn-primary margin-bottom-10 waves-effect waves-light" data-toggle="modal" data-target="#termsCondition">Save</button> -->
                </div>
    
                    @include('ideas.modal')

                </form>
            </div>
            <!-- /.card-content -->
            </div>
        <!-- /.box-content -->


        
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
        

        const submitForm = ()=>{
            // console.log('hello')
            document.getElementById('terms').submit()
        }

    function enableSave(){
            document.getElementById("save").removeAttribute('disabled');
        }

    function conditionsModal(title, description, anonymous) {
        $('#title').val(title);
        $('#description').val(description);
        $('#anonymous').val(anonymous);
    }
    </script>
@endsection

