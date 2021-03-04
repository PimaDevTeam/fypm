<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Final Year Project Management System</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    {{-- Tailwind Css --}}
    <link rel="stylesheet" href="/css/main.css">
    {{-- Boot css --}}
    <link href="{{ asset('/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    {{-- Custom Css --}}
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">

    {{-- Editor --}}
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
</head>
@php
    $student = Auth::user()->roles[0]->id === 4;
    $supervisor = Auth::user()->roles[0]->id === 3;
    
@endphp
<body class="font-sans">
    <nav class="navbar navbar-expand-sm navbar-dark bg-secondary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('user.dashboard') }}">Project Management</a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation">
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                @if ($student)
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item {{ Request::is('project*') ? 'active' : '' }}">
                            <a href="{{ route('student.project.index') }}" class="nav-link">
                                <i class="fas fa-project-diagram mr-1"></i>
                                Project
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('resources*') ? 'active' : '' }}">
                            <a href="{{ route('project.resources.index') }}" class="nav-link">
                                <i class="fas fa-folder-open mr-1"></i>
                                Resources
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('events*') ? 'active' : '' }}">
                            <a href="{{ route('events.index') }}" class="nav-link">
                                <i class="fas fa-calendar-alt mr-1"></i>
                                Events
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('topics*') ? 'active' : '' }}">
                            <a href="{{ route('project.topics.index') }}" class="nav-link">
                                <i class="fas fa-file-alt mr-1"></i>
                                Find Projects
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('members*') ? 'active' : '' }}">
                            <a href="{{ route('project.members') }}" class="nav-link">
                                <i class="fas fa-user-friends mr-1"></i>
                                Members
                            </a>
                        </li>
                    </ul> 
                @endif
                @if ($supervisor)
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item {{ Request::is('project*') ? 'active' : '' }}">
                            <a href="{{route('lecturer.project.index')}}" class="nav-link">
                                <i class="fas fa-project-diagram mr-1"></i>
                                Project
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('resources*') ? 'active' : '' }}">
                            <a href="" class="nav-link">
                                <i class="fas fa-folder-open mr-1"></i>
                                Resources
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('events*') ? 'active' : '' }}">
                            <a href="{{ route('events.index') }}" class="nav-link">
                                <i class="fas fa-calendar-alt mr-1"></i>
                                Events
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('topics*') ? 'active' : '' }}">
                            <a href="" class="nav-link">
                                <i class="fas fa-file-alt mr-1"></i>
                                Find Projects
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('group*') ? 'active' : '' }}">
                            <a href="{{route('lecturer.groups') }}" class="nav-link">
                                <i class="fas fa-user-friends mr-1"></i>
                                Groups
                            </a>
                        </li>
                    </ul>
                @endif

                <ul class="navbar-nav">
                    <li class="nav-item dropdown bg-gray-200 text-center" style="width: 40px; height: 40px; border-radius: 50%; ">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user text-gray-600 mt-1" aria-hidden="true"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="{{ route('user.profile') }}"> <i class="far fa-user" aria-hidden="true"></i> Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('auth.logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="fa fa-power-off" aria-hidden="true"></i>
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                    </li>
                    <li class="nav-item dropdown notification__container bg-gray-500 text-center ml-2" style="width: 40px; height: 40px; border-radius: 50%; ">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell mt-1" aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mb-5">
        @yield('content')
    </div>
    
</body>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/custom-file-input.js') }}"></script>
@stack('script')
</html>