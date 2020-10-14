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

.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    background-color: #2c7a7b!important;
}
</style>

@extends('layouts.user.app')

@section('content') 
    <div class="row mt-4">
        @include('layouts.user.left_sidebar')
        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
            <div class="main__container bg-white rounded shadow px-2 py-2">
                <h6 class="text-blue-900 font-semibold uppercase">CS (GROUP A) Library Management System</h6>
                <hr class="mt-1">
                <div class="pj__header-container gp__projects--bg h-40 rounded"></div>
                <div class="project__details-container px-2 py-2">
                    <div class="flex rounded">
                        <div class="h-20 w-20 bg-teal-700 rounded shadow text-center text-white" style="margin-top: -3rem">
                            <span class="text-5xl">
                                <i class="fas fa-user-friends mt-3"></i>
                            </span>
                        </div>
                        <div class="ml-3">
                            <span class="text-gray-500" style="font-size: .8rem">  </span>
                        </div>
                        <div class="flex ml-auto">
                            <div class="justify-end flex project__posted-by">
                                <span class="text-gray-500">Memebers of the group</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2 px-2 py-2">
                <h6 class="text-blue-900 font-semibold uppercase">Description</h6>
                <hr class="mt-1">
                    <p class="">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Voluptates maiores eum rem quam laudantium commodi libero, alias quisquam, enim provident 
                        corrupti accusantium cumque similique sed voluptatem ea consequatur quod laboriosam!
                    </p>
                </div>
            </div>
            <ul class="nav nav-pills mb-1 mt-2 bg-white px-2 py-2" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" id="pills-students-tab" data-toggle="pill" href="#pills-students" role="tab" aria-controls="pills-students" aria-selected="true">Students</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="pills-project-tab" data-toggle="pill" href="#pills-project" role="tab" aria-controls="pills-project" aria-selected="false">Project </a>
                </li>
              </ul>
              <hr class="mt-1">
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-students" role="tabpanel" aria-labelledby="pills-students-tab">
                    <div class="bg-white mt-2 shadow px-2 py-2 rounded mt-2">
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
                                <h6 class="font-semibold">
                                    <a href="{{ route('project.member.student') }}">
                                        Bright Chris
                                    </a>
                                </h6>
                                <small class="text-gray-500 mt-1">Student Participant</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-project" role="tabpanel" aria-labelledby="pills-project-tab">
                    <div class="bg-white rounded px-2 py-2 shadow-sm">
                        <h6 class="text-blue-900 font-semibold uppercase">Project Folder </h6>
                        <hr>
                        <h6  class="text-center text-5xl text-teal-700">
                            <i class="fa fa-folder" aria-hidden="true"></i>
                        </h6>
                        <h6 class="text-center font-normal uppercase">Project Folder is Empty</h6>
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