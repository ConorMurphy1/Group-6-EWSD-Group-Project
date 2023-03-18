@extends('layouts.app')

@section('content')
    <div class="col-xs-12">
        <div class="center">
            <div class="box-content">
                <h4 class="box-title">Ideas</h4>
                <div>
                    <a href="{{route('ideas.create')}}" class="btn btn-success justify-content-end">+Add New</a>
                </div>
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
                                <th>Title</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>User</th>
                                <th>Department</th>
                                <th>Event</th>
                                <th>Anonymous</th>
                                <th>Document</th>
                                <th>Closure Date</th>
                                <th>Views</th>
                                <th>Deleted At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ideas as $idea)
                            <tr>
                                <td>{{ ($ideas->currentPage()-1) * $ideas->perPage() + $loop->index + 1 }}</td>
                                <td>{{ $idea->title }}</td>
                                <td>
                                    @if ($idea->image)
                                        <img src="{{file_exists(asset('storage/'.$idea->image))
                                            ? asset('storage/'.$idea->image) 
                                            : asset($idea->image)}}" alt="" width="200" height="200">
                                    @else
                                        <span> No image uploaded </span>
                                    @endif
                                </td>
                                <td>{{ $idea->description }}</td>
                                <td>{{ $idea->createdBy->username }}</td>
                                <td>{{ $idea->department->name }}</td>
                                <td>{{ $idea->event->name }}</td>
                                <td>{{ $idea->is_anonymous}}</td>
                                <td>@if ($idea->document)
                                        <a href="{{asset('storage/documents/'.$idea->document)}}" target="_blank" >{{$idea->document}}</a>
                                    @else
                                        <span> No Doc uploaded </span>
                                    @endif
                                </td>
                                <td>{{ $idea->closure_date }}</td>
                                <td>{{ $idea->views }}</td>
                                <td>{{ $idea->deleted_at }}</td>
                                <td class="flex-warp">
                                    <div class="mx-3 text-center">
                                        <form action="{{ route('ideas.destroy', $idea->id) }}" method="post">
                                            @csrf @method('delete')
                                            <a href="{{ route('ideas.edit', $idea->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
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
                {{ $ideas->appends(request()->query())->links() }}
                <!-- /.table-responsive -->
            </div>
            <!-- /.box-content -->
        </div>
    </div>
@endsection

