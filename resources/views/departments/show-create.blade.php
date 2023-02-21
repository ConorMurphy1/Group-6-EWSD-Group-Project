@extends('departments.layout')
@section('content')
    
    <div class='container'>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h3>Departments</h3>
                <form action="{{ url('departments') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="department_name">Department Name</label>
                        <input type="text" class="form-control" name="department_name" id="department_name"
                        @error('department_name')is-invalid @enderror
                        placeholder="Enter Department Name" >
                        @error('department_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                @if(Session('successAlert'))
                    <div class="alert alert-success alert-dismissible show fade">
                        <strong>{{ Session('successAlert')}}</strong>
                        <button class="close" data-dismiss="alert"> &times; </button>
                    </div>
                @endif
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Departments</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($departments as $department)
                        <tr>
                            <td>{{ $department->id }}</td>
                            <td>{{ $department->name }}</td>
                            <td>
                            <form action="{{url('departments/'.$department->id)}}" method="POST">
                                @csrf
                                @method=('DELETE')
                                <a href="{{ url('departments/'.$department->id.'/edit')}}">
                                    <button type="button" class="btn btn-success btn-sm">
                                        <i class="fa fa-edit"></i> Edit
                                    </button>
                                </a>
                                            
                                <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure?')">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

@endsection