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
                <h6 class="text-blue-900 font-semibold uppercase">Guides to Final year Project</h6>
                <hr class="mt-1">
                <div class="pj__header-container fyp__resources-bg h-40 rounded"></div>
                <div class="project__details-container px-2 py-2">
                    <div class="flex rounded">
                        <div class="h-20 w-20 bg-blue-800 rounded shadow text-center text-white" style="margin-top: -3rem">
                            <span class="text-5xl">
                                <i class="fas fa-book mt-3"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="mt-2 px-2 py-2">
                <h6 class="text-blue-900 font-semibold uppercase">Resources to guide you through your Final year Project</h6>
                <hr class="mt-1">
                    <p class="">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Voluptates maiores eum rem quam laudantium commodi libero, alias quisquam, enim provident 
                        corrupti accusantium cumque similique sed voluptatem ea consequatur quod laboriosam!
                    </p>
                </div>
            </div> 
            <div class="main__container bg-white mt-4 rounded shadow-sm px-2 py-2">
                <div class="flex">
                    <div class="bg-blue-800 rounded shadow w-20 mr-2"></div>
                    <div class="project__topics-descriptions">
                        <div class="flex">
                            <h6 class="text-blue-900 font-semibold uppercase">
                                <a href="{{ route('project.resources.show') }}">
                                    Steps to maximize project time
                                </a>
                            </h6>
                        </div>
                        <small class="text-gray-500">Prof. Idowu S.A - </small>
                        <p class="mt-2 text-gray-600" style="font-size: .8rem">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                            Voluptates maiores eum rem quam laudantium commodi libero,
                        </p>
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