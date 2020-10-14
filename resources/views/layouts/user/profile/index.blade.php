<?php 
$user = Auth::user();
?>


@extends('layouts.user.app')

@section('content') 
    <div class="row mt-4">
        @include('layouts.user.left_sidebar')
        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
            <div class="main__container bg-white rounded shadow px-2 py-2">
                <h6 class="text-blue-900 font-semibold uppercase">User Profile</h6>
                <hr class="mt-1">
                <div class="pj__header-container h-40 pf__bg-cover rounded"></div>
                <div class="project__details-container px-2 py-2">
                    <div class="flex rounded">
                        <div class="shadow pj_member" style="margin-top: -3rem; border-radius: 50%;">
                            <img src="/images/default-profile.png" alt="">
                        </div>
                        <div class="ml-3">
                            <h6 class="mb-0">Nwachukwu Sabastine</h6>
                            <span class="text-gray-500" style="font-size: .8rem">Software Engineering</span>
                        </div>
                        <div class="flex ml-auto">

                        </div>
                    </div>
                </div>
                {{-- <div class="mt-2 px-2 py-2">
                <h6 class="text-blue-900 font-semibold uppercase">Project Description (sub-header)</h6>
                <hr class="mt-1">
                    <p class="">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Voluptates maiores eum rem quam laudantium commodi libero, alias quisquam, enim provident 
                        corrupti accusantium cumque similique sed voluptatem ea consequatur quod laboriosam!
                    </p>
                </div> --}}
            </div> 
            <div class="main__container bg-white mt-4 rounded shadow px-2 py-2">
                <h6 class="text-blue-900 font-semibold uppercase">About</h6>
                <hr class="mt-1">
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