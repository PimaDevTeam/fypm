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
                            <h6 class="font-semibold">{{$supervisor[0]->first_name}} {{$supervisor[0]->last_name}}</h6>
                            @php
                                $program = App\Program::where('id', $supervisor[0]->program_id)->first();
                            @endphp
                            <small class="text-gray-500 mt-1">{{$program->program}} <small>Lecturer</small> </small>
                        </div>
                    </div>
                </div>
                <hr>
                @php
                    // dd($supervisor);
                @endphp
                <h6 class="text-blue-900 font-semibold uppercase">Project STUDENTS </h6>
                @foreach ($members as $member)
                    <div class="flex">
                        <div class="project-member__image-container">
                            {{-- <img src="/images/default-profile.png" alt=""> --}}
                            <img src="{{asset('/storage/images/'.$member->image)}}" onerror="this.onerror=null;this.src='/images/avatar.png';" alt="avatar">
                        </div>
                        <div class="ml-3 mt-2">
                            <h6 class="font-semibold">
                                <a href="{{ route('project.member.student', $member->id) }}" class="text-blue-900">
                                    {{$member->first_name}} {{$member->last_name}}
                                </a>
                            </h6>
                            <i class="text-gray-500 mt-1" style="font-size: .75rem">Student Participant</i>
                        </div>
                    </div>
                    <hr>
                @endforeach
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