@extends('layouts.app')

@section('content')
    <div class="col-xs-12">
        <div class="center">
            <div class="box-content">
                <h4 class="box-title">Idea Reports</h4>
                
                <!-- /.box-title -->
                <div class="dropdown js__drop_down">
                    <a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
                    <ul class="sub-menu">
                        <li><a href="#">Product</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else there</a></li>
                        <li class="split"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                    <!-- /.sub-menu -->
                </div>
                <!-- /.dropdown js__dropdown -->
                <div class="table-responsive table-purchases">
                    <table class="table table-bordered border-1 m-1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Idea</th>
                                <th>Posted By</th>
                                <th>Reported By</th>
                                <th>Reason</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reportedIdeas as $report)
                            <tr>
                                <td>{{ ($reportedIdeas->currentPage()-1) * $reportedIdeas->perPage() + $loop->index + 1 }}</td>
                                @if ($idea->image ?? false)
                                <td>
                                    <img src="{{ asset('storage/images/' . $report->idea->image) }}" alt="" width="200" height="200">
                                </td> 
                                @else
                                <td>No image uploaded</td>
                                @endif

                                <td>{{ $report->idea->title }}</td>
                                <td>{{ $report->idea->user->full_name }}</td>
                                <td>{{ $report->reporter->full_name }}</td>
                                <td>{{ $report->description }}</td>
                                <td>{{ $report->created_at->format('d M Y'); }}</td>
                                <td class="flex-warp">
                                    <div class="mx-3 text-center">
                                        <form action="{{ route('admin.reports.ideas.destroy', $report->id) }}" method="post">
                                            @csrf 
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="fa fa-trash-o text-dark"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $reportedIdeas->appends(request()->query())->links() }}
                <!-- /.table-responsive -->
            </div>
        </div>
    </div>
@endsection

