@extends('layouts.admin.app')

@section('content')

@if (Auth::user()->role_id <= 2)
<div class="card">
    <div class="card-header">
        Only For admin and Cordinator
    </div>
    <div class="card-body">
        <h4 class="card-title">Welcome {{ Auth::user()->name }}</h4>
        <p class="card-text">Text</p>
    </div>
    <div class="card-footer text-muted">
        Footer
    </div>
</div>
@endif
    
@endsection