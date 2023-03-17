@extends('layouts.app')
@section('content')
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

	<link rel="stylesheet" href="{{asset('adminpanel/assets/plugin/sweet-alert/sweetalert.css')}}">

    <title>Role Entry</title>
    <style>
        .group {
        position: relative;
        }

        .input {
        font-size: 16px;
        padding: 10px 10px 10px 5px;
        display: block;
        width: 200px;
        border: none;
        border-bottom: 1px solid #515151;
        background: transparent;
        }

        .input:focus {
        outline: none;
        }

        label {
        color: #999;
        font-size: 18px;
        font-weight: normal;
        position: absolute;
        pointer-events: none;
        left: 5px;
        top: 10px;
        transition: 0.2s ease all;
        -moz-transition: 0.2s ease all;
        -webkit-transition: 0.2s ease all;
        }

        .input:focus ~ label, .input:valid ~ label {
        top: -20px;
        font-size: 14px;
        color: #5264AE;
        }

        .bar {
        position: relative;
        display: block;
        width: 200px;
        }

        .bar:before, .bar:after {
        content: '';
        height: 2px;
        width: 0;
        bottom: 1px;
        position: absolute;
        background: #5264AE;
        transition: 0.2s ease all;
        -moz-transition: 0.2s ease all;
        -webkit-transition: 0.2s ease all;
        }

        .bar:before {
        left: 50%;
        }

        .bar:after {
        right: 50%;
        }

        .input:focus ~ .bar:before, .input:focus ~ .bar:after {
        width: 50%;
        }

        .highlight {
        position: absolute;
        height: 60%;
        width: 100px;
        top: 25%;
        left: 0;
        pointer-events: none;
        opacity: 0.5;
        }

        .input:focus ~ .highlight {
        animation: inputHighlighter 0.3s ease;
        }

        @keyframes inputHighlighter {
        from {
        background: #5264AE;
        }

        to {
        width: 0;
        background: transparent;
        }
        }
    </style>
  </head>
  <body>
    @include('sweetalert::alert')
  
    <br><br>
    <div class="modal fade" class="md" id="examplemodal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
             @csrf
                <div class="modal-body">
                <div class="group">
                    <input required="" type="text" name="role" class="input">
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label>Role</label>
                </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>

            </form>
            
            </div>
        </div>
    </div>

  <br><br><br>
    <div class="container">
        <table class="table mx-auto table-bordered table-hover table-striped" allign="center">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Role</th>
                <th scope="col">Created Time</th>
                <th scope="col">Updated Time</th>
                <th scope="col">Operations</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach($roleMembers as $roleMember)
                <tr>
                <th scope="row">{{ $i++ }}</th>
                <td>{{$roleMember['role']}}</td>

                @if($roleMember['role'] == 'QA Manager' || $roleMember['role'] == 'QA Coordinator' || $roleMember['role'] == 'Admin')
                    <td style="font-weight: bold; color: blue">Default Role</td>
                    <td style="font-weight: bold; color: blue">Default Role</td>
                    <td>Cannot Delete or Update</td>
                @else
                    <td>{{$roleMember['created_at']}}</td>
                    <td>{{$roleMember['updated_at']}}</td>
                    <td>
                        <a href="{{ url('admin/role/'.$roleMember['id'].'/edit') }}" class="text-white btn btn-success ml-2 pt-2"><i class='bx bx-edit-alt'></i></a>
                        <a  href="{{ url('admin/role/'.$roleMember['id'].'/delete') }}"  class="text-white btn btn-danger ml-2 pt-2"><i class='bx bxs-trash'></i></a>
                    </td>
                    <!-- href={{"updateRole/".$roleMember['id']}}  href={{"deleteRole/".$roleMember['id']}}  -->
                @endif   

                

                @endforeach
                </tr>
            
            </tbody>
        </table>
    </div>
    
    <div class="container ">
        <button data-loading-text="loading..." class="btn btn-warning mx-auto float-right"  type="Button" data-toggle="modal" data-target="#examplemodal">Add Role</button>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="{{asset('adminpanel/assets/plugin/sweet-alert/sweetalert.min.js')}}"></script>
  </body>
</html>
@endsection