@extends('layouts.app')

@section('content')
    <div class="col-xs-12">
        <div class="center">
            <div class="box-content">
                <h4 class="box-title">Roles</h4>
                <div>
                    <a href="{{route('roles.create')}}" class="btn btn-success justify-content-end" @if (Auth::user()->role->id  != 3)
                        onclick="return false;" disabled
                    @endif>+Add New</a>
                </div>
                <!-- /.box-title -->
                <!-- /.dropdown js__dropdown -->
                <div class="table-responsive table-purchases">
                    <table class="table table-bordered border-1 m-1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Role</th>
                                <th>Deleted At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $idea)
                            <tr>
                                <td>{{ ($roles->currentPage()-1) * $roles->perPage() + $loop->index + 1 }}</td>
                                <td>{{ $idea->role }}</td>
                                <td>{{ $idea->deleted_at }}</td>
                                <td class="flex-warp">
                                    <div class="mx-3 text-center">
                                        <form action="{{ route('roles.destroy', $idea->id) }}" method="post">
                                            @csrf @method('delete')
                                            <a @if (Auth::user()->role->id  != 3)
                                                onclick="return false;" disabled
                                            @endif href="{{ route('roles.edit', $idea->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button @if (Auth::user()->role->id  != 3)
                                                disabled
                                            @endif type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')" data-toggle="tooltip" data-placement="top" title="Delete">
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
                {{ $roles->appends(request()->query())->links() }}
                <!-- /.table-responsive -->
            </div>
            <!-- /.box-content -->
        </div>
    </div>
@endsection

