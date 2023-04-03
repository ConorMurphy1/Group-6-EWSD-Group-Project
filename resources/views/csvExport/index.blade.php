@extends('layouts.app')
@section('style')
    <!-- Bootstrap CSS file -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap JavaScript file -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">


    <style>
        .container-box {
            border: 1px solid #ccc;
            padding: 10px;
            margin-top: 10px;
        }

        .d-none {
            display: none;
        }


        .chartCard {

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chartBox {
            width: 700px;
            padding: 20px;
            border-radius: 20px;
            border: solid 3px rgba(54, 162, 235, 1);
            background: white;
        }
    </style>
@endsection
@section('content')
<div class="col-xs-12">
    <div class="center">
        <div class="box-content">
            <h4 class="box-title">Export CSV</h4>
            <div class="container">
                <form method="GET" action="{{ route('export-csv-download') }}">
                    @csrf
                    <div class="form-group">
                        <label for="options">Choose an event:</label>
                        <select class="form-control" id="event-select" name="event" style="max-width: 800px;">
                            <option value="">Select Event to export</option>
                            @foreach (\App\Models\Event::all() as $event)
                                @if ($event->end_date < today())
                                    @if (auth()->user()->role_id == 1)
                                        <option value="{{ $event->id }}">{{ $event->name }} (Finished Event)</option>
                                    @endif
                                @else
                                    <option value="{{ $event->id }}">{{ $event->name }} (Active Event)</option>
                                @endif
                            @endforeach
                        </select>
                        <input type="hidden" id="selected-event" value="" name="event">
                        <br>
                        <div class="row" style="max-width: 800px;">
                            <div class="col-sm-6">
                                <button class="btn btn-primary" type="submit" name="exportBtn" value="ExportBtn"
                                    title="Export Idea Post from Event in CSV Format">Export</button>
                            </div>
                            <div class="col-sm-6 text-right">
                                <button class="btn btn-secondary" id="downloadDocBtn" type="button" name="downloadDocBtn"
                                    title="Download Attached Document from Event">Download Attached Document</button>
                            </div>
                        </div>
                    </div>

                    @if (session('error'))
                        <div class="alert alert-danger" id="alert_error">{{ session('error') }}<i class="bi bi-x"
                                style="float:right; cursor:pointer;" onclick="closeAlert()"></i></div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>

<script>
    function closeAlert() {
        var alertDiv = document.getElementById('alert_error');
        if (alertDiv) {
            alertDiv.style.visibility = 'hidden';
        }
    }
    // Get the download button element
    const downloadBtn = document.getElementById('downloadDocBtn');

    // Add an event listener to the button
    downloadBtn.addEventListener('click', function() {

        // Get the selected event id from the dropdown
        const eventId = document.getElementById('selected-event').value;

        // Redirect to the download-document route with the event id parameter
        window.location.href = "{{ route('download-document', ['event' => '']) }}" + eventId;
    });
    
    document.getElementById('event-select').addEventListener('change', function() {
        document.getElementById('selected-event').value = this.value;
    });
</script>

@endsection
