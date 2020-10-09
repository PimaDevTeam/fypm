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
                <h6 class="text-blue-900 font-semibold uppercase">Find Project Topics</h6>
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
                            <span class="text-gray-500" style="font-size: .8rem"> <i class="far fa-clock"></i> Sep 30, 2020 - 11:59 PM</span>
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
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Voluptates maiores eum rem quam laudantium commodi libero, alias quisquam, enim provident 
                        corrupti accusantium cumque similique sed voluptatem ea consequatur quod laboriosam!
                    </p>
                    <hr>
                    <button class="btn btn-primary btn__project-select"> <i class="fa fa-check" aria-hidden="true"></i> Select Project</button>
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