<?php 
$user = Auth::user();
?>

@extends('layouts.user.app')

@section('content') 
    <div class="row mt-4">
        @include('layouts.user.left_sidebar')
        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
            <div class="main__container bg-white rounded shadow px-2 py-2">
                <h6 class="text-blue-900 font-semibold uppercase">Student Groups</h6>
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
                                <span class="text-gray-500">List of groups that you have been asigned to</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2 px-2 py-2">
                <h6 class="text-blue-900 font-semibold uppercase">Groups</h6>
                <hr class="mt-1">
                    <p class="">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Voluptates maiores eum rem quam laudantium commodi libero, alias quisquam, enim provident 
                        corrupti accusantium cumque similique sed voluptatem ea consequatur quod laboriosam!
                    </p>
                </div>
            </div> 
            <a href="{{ route('lecturer.groups.show') }}" class="text-blue-800">
                <div class="flex rounded bg-white mt-2 mb-2 px-2 py-2 shadow-sm">
                    <div class="bg-red-700 mr-4 rounded" style="width: 5px; height: 30px; "></div>
                    <div class="mt-1">
                        <span>CS (GROUP A) Library Management System </span>
                    </div>
                </div>
            </a>
            <a href="{{ route('lecturer.groups.show') }}" class="text-blue-800">
                <div class="flex rounded bg-white mb-2 px-2 py-2 shadow-sm">
                    <div class="bg-red-700 mr-4 rounded" style="width: 5px; height: 30px; "></div>
                    <div class="mt-1">
                        <span>CS (GROUP A) Library Management System </span>
                    </div>
                </div>
            </a>
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