@php
    // $user = Auth::user()->roles[0]->id
    $user = Auth::user();
@endphp
@extends('layouts.admin.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            @include('messages')
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ $error }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endforeach
            @endif
            <h3 class="text-blue-900 font-semibold mb-4">Projects</h3>
            <hr>
            <div class="row">
                @foreach ($programs as $program)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-admin text-white">
                                {{-- <i class="far fa-envelope"></i> --}}
                                <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                            </span>
                            @php
                            @endphp
            
                            <div class="info-box-content">
                            <span class="info-box-text">{{$program->program}}</span>
                                <a href="{{route('project.topics', $program->id)}}" class="btn btn-primary btn-admin btn-sm mt-2">Project Topics</a>
                                <a href="{{route('project.topics.approve', $program->id)}}" class="btn btn-primary btn-admin btn-sm mt-2">Approve</a>

                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                @endforeach
            </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection