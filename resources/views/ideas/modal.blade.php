<div class="remodal" data-remodal-id="remodal" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
	<button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
	<div class="remodal-content">
		<h2 id="modal1Title">Terms and Conditions</h2>
		<p id="modal1Desc">
		Welcome to our website. If you continue to browse and use this website, you are agreeing to comply with and be bound by the following terms and conditions of use:
		</p>
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
            @if ($idea->id)
            <form action="{{ route('ideas.update', $idea->id)}}" method="post" enctype="multipart/form-data">
                @method('PATCH')
                <div class="card-header">
                    <strong>Idea Edit Form</strong>
                @else
                <form action="{{ route('ideas.store') }}" method="post" enctype="multipart/form-data">
                <div class="card-header">
                    <strong>Idea Create Form</strong>
            @endif
                @csrf
                </div>
                <button type="submit" class="btn btn-primary btn-ladda" id="save" disabled>Save</button>
            </form>
        </div>
	</div>

</div>

@section('javascript')
    <script>
            function enableSave(){
            document.getElementById("save").removeAttribute('disabled');
        }
    </script>


<script>
    function conditionsModal(title, description, anonymous) {
        $('#title').val(title);
        $('#description').val(description);
        $('#anonymous').val(anonymous);
    }
</script>
@endsection