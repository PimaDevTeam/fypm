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
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
</head>
<body class="font-sans bg-gray-300">
    <div class="container">
        <nav class="navbar navbar-expand-sm">
            <a class="navbar-brand" href="{{route('frontend.index')}}">
                <img src="{{asset('/images/bu_logo.png')}}" width="200" alt="">
            </a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation"></button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                </ul>
            <ul class="navbar-nav">
                    @if (!Auth::check())
                        <li class="nav-item active">
                            <a class="nav-link text-white" href="{{route('auth.home')}}">
                                <i class="fa fa-sign-in-alt" aria-hidden="true"></i>
                                Login <span class="sr-only">(current)</span></a>
                        </li>
                    @else 
                        @if (Auth::user()->roles[0]->id === 4)
                            <li class="nav-item active">
                                <a class="nav-link text-white" href="{{route('user.dashboard')}}">Dashboard</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('auth.logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="fa fa-power-off" aria-hidden="true"></i>
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @endif
            </ul>
            </div>
        </nav>
    </div>
    <div class="container-fluid pl-0 pr-0" style="margin-top: -7rem">
        @yield('content')
    </div>
    
</body>
<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</html>