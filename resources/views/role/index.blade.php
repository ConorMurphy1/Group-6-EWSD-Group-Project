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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $idea)
                            <tr>
                                <td>{{ ($roles->currentPage()-1) * $roles->perPage() + $loop->index + 1 }}</td>
                                <td>{{ $idea->role }}</td>
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

