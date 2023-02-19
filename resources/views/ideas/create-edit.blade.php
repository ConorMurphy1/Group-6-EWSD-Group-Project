<div class="card-body">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm border-primary p-2 position-relative">
                <div class="custom-heading bg-primary">Input Data</div>
                <div class="card">
                    @if ($idea->id)
                    <form action="{{ url('ideas/' . $idea->id) }}" method="post">
                        @method('PATCH')
                    @else
                    <form action="{{ url('ideas') }}" method="post">
                    @endif
                    @csrf
                    <div class="card-header">
                        @if($idea->id)
                        <strong>Idea Edit Form</strong>
                        @else
                        <strong>Idea Create Form</strong>
                        @endif
                        <a href="{{ url('ideas') }}" class="btn btn-primary btn-sm float-right"><i class="fa fa-angle-double-left"></i> Back </a>
                    </div>
                    <div class="my-2">
                        <label for="" class="d-block text-muted">Cover Photo</label>
                        <input name="image_path" type="file" accept="image/*" id="imgInp" >
                    </div>
                    <div class="my-2">
                        <label for="" class="d-block text-muted">File</label>
                        <input name="document_path" type="file" accept="application/pdf,application/vnd.ms-excel" >
                    </div>
                    <div class="my-2">
                        <label for="" class="d-block text-muted">Title</label>
                        <input name="title" type="text" class="form-control" required>
                    </div>
                    <div class="my-2">
                        <label for="" class="d-block text-muted">Anonymous</label>
                        <input name="is_anonymous" type="checkbox" class="form-control">
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
                        <button class="btn btn-primary btn-ladda">Save</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="d-flex justify-content-center">
                <img id="blah" src="{{ asset('images/img.png') }}" alt="your image" class="w-50" />
            </div>
        </div>
    </div>
</div>

<script>
    imgInp.onchange = evt => {
    const [file] = imgInp.files
        if (file) {
            blah.src = URL.createObjectURL(file)
        }
    }
</script>