@extends('layouts.app')

@section('content')
    <div class="col-xs-12">
        <div class="center">
            <div class="box-content">
                <h4 class="box-title">Categories</h4>
                <div>
                    <a href="{{route('categories.create')}}" class="btn btn-success justify-content-end">+Add New</a>
                </div>
                <!-- /.box-title -->
                <!-- /.dropdown js__dropdown -->
                <div class="table-responsive table-purchases">
                    <table class="table table-bordered border-1 m-1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Deleted At</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->deleted_at }}</td>
                                <td class="flex-warp">
                                    <div class="mx-3 text-center">
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                                            @csrf @method('delete')
                                            <a href="{{ url('admin/categories/'.$category->id.'/edit') }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Edit">
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
                <!-- /.table-responsive -->
            </div>
            <!-- /.box-content -->
        </div>
    </div>
@endsection

