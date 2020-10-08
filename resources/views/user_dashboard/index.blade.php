<?php 
$user = Auth::user();
?>

@extends('layouts.user.app')

@section('content') 
    <div class="row mt-4">
        @include('layouts.user.left_sidebar')
        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
            <div class="main__container bg-white rounded shadow">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-2 px-3 py-3">
                    <div class="project flex shadow-sm rounded">
                        <div class="md-icon bg-blue-800 rounded">
                            <img src="/images/doc.svg" class="ml-auto mr-auto mt-3" alt="">
                        </div>
                        <h6 class="mt-2 ml-3 uppercase">Project</h6>
                    </div>
                    <div class="members flex shadow-sm rounded">
                        <div class="md-icon bg-red-600 rounded">
                            <img src="/images/users.svg" class="ml-auto mr-auto mt-3" alt="">
                        </div>
                        <h6 class="mt-2 ml-3 uppercase">Members</h6>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-2 px-3 py-3">
                    <div class="project flex shadow-sm rounded">
                        <div class="md-icon bg-teal-600 rounded">
                            <img src="/images/text-document.svg" class="ml-auto mr-auto mt-3" alt="">
                        </div>
                        <h6 class="mt-2 ml-3 uppercase">Find Projects</h6>
                    </div>
                    <div class="members flex shadow-sm rounded">
                        <div class="md-icon bg-gray-900 rounded">
                            <img src="/images/folder.svg" class="ml-auto mr-auto mt-3" alt="">
                        </div>
                        <h6 class="mt-2 ml-3 uppercase">Resources</h6>
                    </div>
                </div>
            </div> 
        </div>
        @include('layouts.user.right_sidebar')
    </div>
@endsection