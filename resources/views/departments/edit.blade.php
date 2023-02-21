@extends('categories.layout')
@section('content')

    <div class='container'>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <h3>Update Departments</h3>
                <form action="{{ url('departments/'.$department->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="department_name">Department Name</label>
                        <input type="text" class="form-control" name="department_name" id="department_name"
                        @error('department_name')is-invalid @enderror
                        value="{{ $department->name ?? old('department_name')}}"
                        placeholder="Enter Department Name" >
                        @error('department_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

@stop