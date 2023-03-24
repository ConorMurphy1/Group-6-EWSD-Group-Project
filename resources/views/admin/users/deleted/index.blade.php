@extends('layouts.app')

@section('content')
    <div class="col-xs-12">
        <div class="center">
            <div class="box-content">
                <a href="{{ route('admin.users.index') }}" class="space-x-1 text-blue-500 hover:text-blue-700 block mb-10">
                    <svg class="w-4 h-4 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                    </svg>
                    <span>back</span>
                </a>
                <h4 class="box-title">Deleted Accounts</h4>
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
                                <th>Deleted At</th>
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
                                <td>{{ $user->department->name }}</td>
                                <td>{{ $user->role->role }}</td>
                                <td>{{ $user->deleted_at }}</td>
                                <td class="flex-warp">
                                    <div class="mx-3 text-center">
                                        <form action="{{ route('admin.users.deleted.destroy', $user->id) }}" method="post">
                                            @csrf 
                                            @method('delete')
                                            <button type="submit" class="custom-button btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="fa fa-trash-o text-white"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.users.deleted.reactivate', $user->id) }}" method="POST" class="mt-3">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="custom-button-green px-3 py-2 rounded-lg text-white">
                                                <span>Reactivate</span>
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
        </div>
    </div>
@endsection

