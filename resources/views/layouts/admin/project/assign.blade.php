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
            <h3 class="text-blue-900 font-semibold mb-4">Assign Project Topics</h3>
            <hr>
            <div class="row">
                
            </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection