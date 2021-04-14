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

    {{-- ADMINLTE JS --}}
    <link rel="stylesheet" href="{{asset('css/adminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/icons.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/datepicker.css')}}">
    {{-- ./ ADMINLTE JS --}}

    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css"> --}}
    <link rel="stylesheet" href="{{asset('fortawesome/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.css">
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
              <a href="index3.html" class="nav-link">Home</a>
            </li>
          </ul>
      
          <!-- SEARCH FORM -->
          {{-- <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </form> --}}
      
          <!-- Right navbar links -->
          <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#">
                {{-- <i class="far fa-comments"></i> --}}
                <i class="fa fa-user" aria-hidden="true"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <i class="fa fa-user" aria-hidden="true"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('auth.logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                     <i class="fa fa-power-off" aria-hidden="true"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              </div>
            </li>
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="fas fa-envelope mr-2"></i> 4 new messages
                  <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="fas fa-users mr-2"></i> 8 friend requests
                  <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="fas fa-file mr-2"></i> 3 new reports
                  <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i class="fas fa-th-large"></i></a>
            </li>
          </ul>
        </nav>
        <!-- /.navbar -->
      
        <!-- Main Sidebar Container -->
        @include('layouts.admin.leftSidebar')
      
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="min-height: 205px;">
          <!-- Content Header (Page header) -->
          <div class="content-header">
            <div class="container-fluid">
              {{-- <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0 text-dark">Starter Page</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Starter Page</li>
                  </ol>
                </div><!-- /.col -->
              </div><!-- /.row --> --}}
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->
      
          <!-- Main content -->
          <div class="content">
            <div class="container-fluid">
                @yield('content')
              <!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
      
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark" style="display: none;">
          <!-- Control sidebar content goes here -->
          <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
          </div>
        </aside>
        <!-- /.control-sidebar -->
      
        <!-- Main Footer -->
        <footer class="main-footer">
          <!-- To the right -->
          <div class="float-right d-none d-sm-inline">
            Anything you want
          </div>
          <!-- Default to the left -->
          <strong class="text-blue-800">Final Year Project Management System.</strong> All rights reserved.
        </footer>
      <div id="sidebar-overlay"></div></div>
    {{-- <nav class="navbar navbar-expand-sm navbar-dark bg-teal-500">
        <a class="navbar-brand" href="#">Admin Dashboard</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation"></button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            </ul>
            <ul class="navbar-nav">
                @if (!Auth::check())
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('auth.home')}}">Login <span class="sr-only">(current)</span></a>
                    </li>
                @else 
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('auth.logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endif
           </ul>
        </div>
    </nav> --}}
    
</body>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/adminLTE.min.js') }}" ></script>
<script src="{{ asset('js/demo.js') }}" ></script>
<script src="{{ asset('js/loadash.min.js') }}" ></script>
<script src="{{ asset('js/datepicker.js') }}" ></script>
<script src="{{asset('js/moment.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/underscore@1.12.0/underscore-min.js"></script> --}}
@stack('scripts')
</html>