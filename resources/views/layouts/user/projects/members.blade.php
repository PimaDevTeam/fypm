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
                <h6 class="text-blue-900 font-semibold">PROJECT GROUP MEMBERS</h6>
                <hr class="mt-1">
                <div class="pj__header-container h-20 bg-gradient-to-r from-teal-400 to-blue-500 rounded"></div>
                <div class="project__details-container px-2 py-2">
                    <div class="flex rounded">
                        <div class="h-20 w-20 bg-blue-800 rounded shadow text-center text-white" style="margin-top: -3rem">
                            <span class="text-5xl">
                                <i class="fas fa-users mt-3"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <h6 class="text-blue-900 font-semibold uppercase">Project Supervisor</h6>
                    <div class="flex">
                        <div class="project-member__image-container">
                            <img src="/images/default-profile.png" alt="">
                        </div>
                        <div class="ml-3 mt-2">
                            <h6 class="font-semibold">Prof. J.V Joshua</h6>
                            <small class="text-gray-500 mt-1">Software Engineering <small>Lecturer</small> </small>
                        </div>
                    </div>
                </div>
                <hr>
                <h6 class="text-blue-900 font-semibold uppercase">Project STUDENTS </h6>
                <div class="flex">
                    <div class="project-member__image-container">
                        <img src="/images/default-profile.png" alt="">
                    </div>
                    <div class="ml-3 mt-2">
                        <h6 class="font-semibold">
                            <a href="{{ route('project.member.student') }}">
                                Bright Chris
                            </a>
                        </h6>
                        <small class="text-gray-500 mt-1">Student Participant</small>
                    </div>
                </div>
                <hr>
                <div class="flex">
                    <div class="project-member__image-container">
                        <img src="/images/default-profile.png" alt="">
                    </div>
                    <div class="ml-3 mt-2">
                        <h6 class="font-semibold">Bright Chris</h6>
                        <small class="text-gray-500 mt-1">Student Participant</small>
                    </div>
                </div>
                <hr>
                <div class="flex">
                    <div class="project-member__image-container">
                        <img src="/images/default-profile.png" alt="">
                    </div>
                    <div class="ml-3 mt-2">
                        <h6 class="font-semibold">Bright Chris</h6>
                        <small class="text-gray-500 mt-1">Student Participant</small>
                    </div>
                </div>
                <hr>
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