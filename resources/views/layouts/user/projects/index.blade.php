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
                <h6 class="text-blue-900 font-semibold">LIBRARY MANAGEMENT SYSTEM (LMS) SOFTWARE</h6>
                <hr class="mt-1">
                <div class="pj__header-container h-20 bg-gradient-to-r from-teal-400 to-blue-500 rounded"></div>
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
                <h6 class="text-blue-900 font-semibold uppercase">Project Description (sub-header)</h6>
                <hr class="mt-1">
                    <p class="">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Voluptates maiores eum rem quam laudantium commodi libero, alias quisquam, enim provident 
                        corrupti accusantium cumque similique sed voluptatem ea consequatur quod laboriosam!
                    </p>
                </div>
            </div> 
            <div class="main__container bg-white mt-4 rounded shadow px-2 py-2">
                <h6 class="text-blue-900 font-semibold">DOWNLOAD PROJECT</h6>
                <hr class="mt-1">
                <form action="">
                    <div class="project__upload px-2 py-2" style="border: 1px dashed grey;">
                        <div class="form-group upload-btn-wrapper">
                            <div class="extension__container"></div>
                            <div class="">
                                <div class="box">
                                    <input type="file" name="file-3[]" id="file-3" class="inputfile inputfile-3" data-multiple-caption="{count} files selected" multiple="">
                                    <label class="flex justify-center transition-all duration-200 ease-in-out" for="file-3"><i class="fas fa-file-alt fdoc mr-2 mt-1"></i> <span>filename.docx</span></label>
                                </div>
                            </div>
                        </div>
                        <p class="text-center text-gray-600">Download Yoir Project</p>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary mt-2"> <i class="fas fa-download mr-1"></i> Download</button>
                    </div>
                </form>
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