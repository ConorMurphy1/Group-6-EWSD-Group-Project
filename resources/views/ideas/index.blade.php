<div class="card-body border-1">
    <table class="table table-bordered border-1 m-1">
        <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Image</th>
                <th>Description</th>
                <th>User</th>
                <th>Department</th>
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
                <td>{{$idea->id}}</td>
                <td>image</td>
                <td>{{$idea->description}}</td>
                <td>{{$idea->user->name}}</td>
                <td>{{$idea->department->name}}</td>
                <td>checkbox</td>
                <td>document</td>
                <td>{{ $idea->closure_date }}</td>
                <td>{{ $idea->views }}</td>
                <td class="flex-warp">
                    <div class="mx-3 text-center">
                        <form action="{{ url('ideas/' . $idea->id) }}" method="post">
                            @csrf @method('delete')
                            <a href="{{ url('ideas/'.$idea->id.'/edit') }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Edit">
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