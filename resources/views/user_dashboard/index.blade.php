@php
    $student = Auth::user()->roles[0]->id === 4;
    $supervisor = Auth::user()->roles[0]->id === 3;
@endphp

@extends('layouts.user.app')

@section('content') 
    <div class="row mt-4">
        @include('layouts.user.left_sidebar')
        {{-- STUDENT COMPONENTS --}}
        {{-- STUDENT COMPONENTS --}}
        {{-- STUDENT COMPONENTS --}}
        @if ($student)
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <div class="main__container bg-white rounded shadow">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-2 px-3 py-3">
                        <a href="{{ route('project.index') }}">
                            <div class="project flex shadow-sm rounded">
                                <div class="md-icon bg-blue-800 rounded">
                                    <img src="/images/doc.svg" class="ml-auto mr-auto mt-3" alt="">
                                </div>
                                <h6 class="mt-2 ml-3 uppercase">Project</h6>
                            </div>
                        </a>
                        <a href="{{ route('project.members') }}">
                            <div class="members flex shadow-sm rounded">
                                <div class="md-icon bg-red-600 rounded">
                                    <img src="/images/users.svg" class="ml-auto mr-auto mt-3" alt="">
                                </div>
                                <h6 class="mt-2 ml-3 uppercase">Members</h6>
                            </div>
                        </a>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-2 px-3 py-3">
                        <a href="{{ route('project.topics.index') }}">
                            <div class="project flex shadow-sm rounded">
                                <div class="md-icon bg-teal-600 rounded">
                                    <img src="/images/text-document.svg" class="ml-auto mr-auto mt-3" alt="">
                                </div>
                                <h6 class="mt-2 ml-3 uppercase">Find Projects</h6>
                            </div>
                        </a>
                        <a href="{{ route('project.resources.index') }}">
                            <div class="members flex shadow-sm rounded">
                                <div class="md-icon bg-gray-900 rounded">
                                    <img src="/images/folder.svg" class="ml-auto mr-auto mt-3" alt="">
                                </div>
                                <h6 class="mt-2 ml-3 uppercase">Resources</h6>
                            </div>
                        </a>
                    </div>
                </div> 
            </div>   
        @endif
        {{-- STUDENT COMPONENTS --}}
        {{-- STUDENT COMPONENTS --}}
        {{-- STUDENT COMPONENTS --}}





        {{-- STAFF COMPONENTS --}}
        {{-- STAFF COMPONENTS --}}
        {{-- STAFF COMPONENTS --}}
        @if ($supervisor)
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <div class="main__container bg-white rounded shadow">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-2 px-3 py-3">
                        <a href="{{ route('lecturer.groups') }}">
                            <div class="project flex shadow-sm rounded">
                                <div class="md-icon bg-blue-800 rounded text-center text-white">
                                    {{-- <img src="/images/doc.svg" class="ml-auto mr-auto mt-3" alt=""> --}}
                                    <span class="text-center text-6xl"><i class="fas fa-user-friends mt-3"></i></span>
                                </div>
                                <h6 class="mt-2 ml-3 uppercase">Groups</h6>
                            </div>
                        </a>
                        <a href="">
                            <div class="members flex shadow-sm rounded">
                                <div class="md-icon bg-red-600 rounded">
                                    <img src="/images/users.svg" class="ml-auto mr-auto mt-3" alt="">
                                </div>
                                <h6 class="mt-2 ml-3 uppercase">Students</h6>
                            </div>
                        </a>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-2 px-3 py-3">
                        <a href="">
                            <div class="project flex shadow-sm rounded">
                                <div class="md-icon bg-teal-600 rounded">
                                    <img src="/images/text-document.svg" class="ml-auto mr-auto mt-3" alt="">
                                </div>
                                <h6 class="mt-2 ml-3 uppercase">Projects</h6>
                            </div>
                        </a>
                        <a href="">
                            <div class="members flex shadow-sm rounded">
                                <div class="md-icon bg-gray-900 rounded">
                                    <img src="/images/folder.svg" class="ml-auto mr-auto mt-3" alt="">
                                </div>
                                <h6 class="mt-2 ml-3 uppercase">Requests/ <br> Messages</h6>
                            </div>
                        </a>
                    </div>
                </div> 
            </div>
        @endif

        {{-- STAFF COMPONENTS --}}
        {{-- STAFF COMPONENTS --}}
        {{-- STAFF COMPONENTS --}}
        @include('layouts.user.right_sidebar')
    </div>
@endsection