@extends('layouts.app')

@section('content')
    <div class="col-xs-12">
        <div class="center">
            <div class="box-content">
                <h4 class="box-title">Users</h4>
                <div>
                    <a href="{{route('admin.users.create')}}" class="btn btn-success justify-content-end">+ Add New</a>
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
                                <th>Image</th>
                                <th>Username</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Updated</th>
                                <th>Department</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ ($users->currentPage()-1) * $users->perPage() + $loop->index + 1 }}</td>
                                <td>
                                    @if ($user->image)
                                        <img src="{{file_exists(asset('storage/'.$user->image))
                                            ? asset('storage/'.$user->image) 
                                            : asset($user->image)}}" alt="" width="200" height="200">
                                    @else
                                        <span> No image uploaded </span>
                                    @endif
                                </td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->firstname }}</td>
                                <td>{{ $user->lastname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->is_updated ? 'Yes' : 'No'}}</td>
                                @if (ucfirst($user->role->role == 'Admin'))
                                <td class="text-rose-700">{{ $user->department->name }}</td>
                                <td class="text-rose-700">{{ $user->role->role }}</td>
                                @elseif(ucfirst($user->role->role == 'QA Manager'))
                                <td class="text-amber-500">{{ $user->department->name }}</td>
                                <td class="text-amber-500">{{ $user->role->role }}</td>
                                @elseif(ucfirst($user->role->role == 'QA Coordinator'))
                                <td class="text-blue-700">{{ $user->department->name }}</td>
                                <td class="text-blue-700">{{ $user->role->role }}</td>
                                @else
                                <td class="text-lime-700">{{ $user->department->name }}</td>
                                <td class="text-lime-700">{{ $user->role->role }}</td>
                                @endif
                                
                                <td class="flex-warp">
                                    <div class="mx-3 text-center">
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="post">
                                            @csrf 
                                            @method('delete')
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Edit">
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
                {{ $users->appends(request()->query())->links() }}
                <!-- /.table-responsive -->
            </div>
            <!-- /.box-content -->
            <div class="my-6 py-2 px-4 rounded-md w-fit bg-gray-300 text-gray-900 hover:bg-gray-400">
                <a href="{{ route('admin.users.deleted.index') }}" class="hover:text-gray-900">Check deactivated accounts</a>
            </div>
        </div>
    </div>
@endsection

