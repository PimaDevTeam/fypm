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
                <h6 class="text-blue-900 font-semibold uppercase">{{$project->topic}}</h6>
                <hr class="mt-1">
                <div class="pj__header-container select__pt--bg h-40 rounded"></div>
                <div class="project__details-container px-2 py-2">
                    <div class="flex rounded">
                        <div class="h-20 w-20 bg-blue-800 rounded shadow text-center text-white" style="margin-top: -3rem">
                            <span class="text-5xl">
                                <i class="fas fa-book mt-3"></i>
                            </span>
                        </div>
                        <div class="ml-3">
                            <span class="text-gray-500" style="font-size: .8rem"> <i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($project->created_at)->diffForhumans() }} </span>
                        </div>
                        <div class="flex ml-auto">
                            <div class="justify-end flex project__posted-by">
                                <img src="/images/default-profile.png" class="mr-2" alt="">
                                <div>
                                    <h6 class="mb-1">Posted by</h6>
                                    <small class="text-gray-500">Prof. Idowu S.A</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2 px-2 py-2">
                <h6 class="text-blue-900 font-semibold uppercase">What the project entails</h6>
                <hr class="mt-1">
                    <p class="">
                        @php
                            $description = strip_tags($project->project_description);
                        @endphp
                        {{$description}}
                    </p>
                    <hr>
                    @if ($assigned == false)
                        <button class="btn btn-primary btn-c" data-toggle="modal" data-target="#confirmModal" > <i class="fa fa-check" aria-hidden="true"></i> Select Project</button>                        
                    @endif
                </div>
            </div> 
        </div>
        @include('layouts.user.right_sidebar')
    </div>
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{route('user.profile.about')}}" id="confirmForm" method="POST">
                @csrf
                <div class="modal-body">
                    <h1 class="text-center text-green-600 text-6xl"><i class="fa fa-check-circle" aria-hidden="true"></i></h1>
                    <h6 class="text-center mt-2 mb-2 text-2xl">Are you sure you want to select this project as your final year project</h6>
                    <div class="flex justify-center w-100">
                        <button type="submit" class="btn btn-primary btn-c"> <i class="fa fa-check-circle mr-2" aria-hidden="true"></i> Confirm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
        });
    </script>
@endpush