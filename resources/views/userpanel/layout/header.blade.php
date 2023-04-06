<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Forum - Responsive HTML5 Template</title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Forum - Responsive HTML5 Template">
    <meta name="author" content="Forum">
    <link rel="shortcut icon" href="favicon/favicon.ico">

    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{asset('usertemplate/build/css/style.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://cdn.tailwindcss.com"></script>

    <style>
        .fix-left {
            top: 0;
            bottom: 0;
            width: 100%;
        }
        /* .fix-right {
            position: relative;
        } */

        .vertical-scrollable {
            position: sticky;
            top: 10px;
            width: 100%;
        }
    </style>
</head>
<body>
    <!-- header -->
    <nav class="panel-menu" id="mobile-menu">
        <ul>

        </ul>
        <div class="mm-navbtn-names">
            <div class="mm-closebtn">
                Close
                <div class="tt-icon">
                    <svg>
                        <use xlink:href="#icon-cancel"></use>
                    </svg>
                </div>
            </div>
            <div class="mm-backbtn">Back</div>
        </div>
    </nav>

    <header id="tt-header">
        <div class="container">
            <div class="row tt-row no-gutters">
                <div class="col-auto">
                    <!-- toggle mobile menu -->
                    <a class="toggle-mobile-menu" href="#">
                        <svg class="tt-icon">
                            <use xlink:href="#icon-menu_icon"></use>
                        </svg>
                    </a>
                    <!-- /toggle mobile menu -->
                    <!-- logo -->
                    <div class="tt-logo">
                        <a href="index.html"><img src="images/logo.png" alt=""></a>
                    </div>
                    <!-- /logo -->
                    <!-- desctop menu -->
                    <div class="tt-desktop-menu">
                        <nav>
                                <ul>
                                    @if (auth()->user()->role->role == 'Admin' || auth()->user()->role->role == 'QA Manager')
                                    <li><a href="{{ route('home') }}"><span>Dashboard</span></a></li>
                                    @endif
                                    <li><a href="{{ route('ideas.feed') }}"><span>NewsFeed</span></a></li>
                                    @if (auth()->user()->role->role == 'Staff')
                                    <li><a href="{{route('idea.users.create')}}"><span>Create</span></a></li>
                                    @endif
                                    <li><a href="{{route('events.newsfeed')}}"><span>Event</span></a></li>
                                </ul>
                        </nav>
                    </div>
                    <!-- /desctop menu -->
                </div>
                <div class="col-auto ml-auto">
                    <div class="tt-user-info d-flex justify-content-center">
                        <div class="tt-avatar-icon tt-size-md">
                            {{-- <button type="button" data-toggle="modal" data-target="#modalAdvancedSearch" class="tt-btn-icon"> <i class="tt-icon"><svg>
                                <use xlink:href="#icon-search"></use>
                            </svg></i>
                            </button> --}}
                            <a href="{{ route('user.profile', auth()->user()->username) }}" class="tt-btn-icon">
                                <i class="tt-icon"><svg>
                                    <use xlink:href="#icon-ava-a"></use>
                                </svg></i>
                            </a>
                        </div>
                        <div class="custom-select-01" id="js-settings-btn">
                            <select disabled>
                                <option value="">{{ auth()->user()->full_name }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- account silde show -->

    <div id="js-popup-settings" class="tt-popup-settings">
        <div class="tt-btn-col-close">
            <a href="{{ route('user.profile', auth()->user()->username) }}"href="{{ route('user.profile', auth()->user()->username) }}">
                <span class="tt-icon-text">
                    Profile
                </span>
                <span class="tt-icon-close">
                    <svg>
                        <use xlink:href="#icon-cancel"></use>
                    </svg>
                </span>
            </a>
        </div>
        <form class="form-default" action="{{route('logout')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="settingsUserName">Username</label>
                <input type="text" class="form-control" id="settingsUserName" readonly value="{{auth()->user()->username}}">
            </div>
            <div class="form-group">
                <label for="settingsUserEmail">Email</label>
                <input type="text" name="name" class="form-control" id="settingsUserEmail" readonly value="{{auth()->user()->email}}">
            </div>
            <div class="form-group">
                <label for="settingsUserLocation">Department</label>
                <input type="text" name="name" class="form-control" id="settingsUserLocation" readonly value="{{auth()->user()->department->name}}">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-secondary">Logout</button>
            </div>
        </form>
    </div>

    <!-- close header -->