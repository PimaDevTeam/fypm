<?php 
$user = Auth::user();
?>

<style>
.inputfile {
	width: 0.1px;
	height: 0.1px;
	opacity: 0;
	overflow: hidden;
	position: absolute;
	z-index: -1;
}
.inputfile + label {
    font-size: 1rem;
    font-weight: 400;
    color: white;
    background-color: #acb3ba;
    display: flex;
    border-radius: 5px;
    padding: .4rem;
    width: 100%;
    text-align: center;
}

.inputfile:focus + label,
.inputfile + label:hover {
    background-color:#6c757d;
}
.inputfile + label {
	cursor: pointer; /* "hand" cursor */
}
</style>

@extends('layouts.user.app')

@section('content') 
    <div class="row mt-4">
        @include('layouts.user.left_sidebar')
        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
            <div class="main__container bg-white rounded shadow px-2 py-2">
                <h6 class="text-blue-900 font-semibold">PROJECT MEMBER</h6>
                <hr class="mt-1">
                <div class="pj__header-container h-40 pf__bg-cover rounded"></div>
                <div class="project__details-container px-2 py-2">
                    <div class="flex rounded">
                        <div class="shadow pj_member" style="margin-top: -3rem; border-radius: 50%;">
                            <img src="/images/default-profile.png" alt="">
                        </div>
                        <div class="ml-3">
                            <h6> Bright Chris</h6>
                            <small class="text-gray-500">Student Participant</small>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="project__member--about--container px-4">
                    <h6 class="text-blue-900 font-semibold uppercase">About</h6>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                        Doloremque excepturi laborum porro animi, aliquam ducimus. 
                        Recusandae consequatur unde ex beatae. Similique, 
                        repellat incidunt! Aperiam, facere voluptatibus consectetur culpa ea ipsam!
                    </p>
                    <div class="flex">
                        <span class="mt-1"><i class="fa fa-phone" aria-hidden="true"></i></span>
                        <h6 class="ml-2">08121838482</h6>
                    </div>
                    <div class="flex mt-2">
                        <span  class="mt-1"> <i class="fas fa-envelope"></i> </span>
                        <h6 class="ml-2">test@gmail.com</h6>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.user.right_sidebar')
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
        });
    </script>
@endpush