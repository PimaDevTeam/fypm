@extends('layouts.main')
@section('content')

<div class="auth__form--container mt-10 mb-2 ml-auto mr-auto bg-white shadow rounded px-4 py-4">
    {{-- <h1 class="text-center text-2xl text-teal-700 uppercase font-semibold">Login</h1> --}}
    <div class="ml-auto mr-auto text-center flex justify-center" style="width: 200px; height: 200px">
        <img src="/images/lg-security.svg" class="img-fluid ml-auto mr-auto" alt="">
    </div>
    <div class="form__container ml-auto mr-auto mt-2">
        <h4 class="text-center text-gray-700 font-semibold mt-2">Dear, <span class="user__selected">User</span>! </h4>
        <p class="text-center text-gray-700 font-semibold">Fill the form below to access your page</p>
        <form action="{{ route('auth.login') }}" method="POST" id="loginForm" name="loginForm">
            @csrf
            @include('messages')
            <div class="form-group">
                <input type="text" class="form-control custom__form-control py-4" name="email" placeholder="Email" autofocus>
            </div>
            <div class="form-group">
                <input type="password" class="form-control custom__form-control py-4" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary btn-block btn-login py-2" value="Login">
            </div>
            <p class="text-center">
                <a href="#" class="text-center">Forgot Password</a>
            </p>
        </form>
    </div>
</div>
    
@endsection