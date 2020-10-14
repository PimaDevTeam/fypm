<?php 
$user = Auth::user();
?>

@extends('layouts.user.app')

@section('content') 
    <div class="row mt-4">
        @include('layouts.user.left_sidebar')
        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
            <div class="main__container bg-white rounded shadow px-2 py-2">
                <h6 class="text-blue-900 font-semibold uppercase">Coming Events</h6>
                <hr class="mt-1">
                <div class="pj__header-container ev__projects--bg h-40 rounded"></div>
                <div class="project__details-container px-2 py-2">
                    <div class="flex rounded">
                        <div class="h-20 w-20 bg-teal-700 rounded shadow text-center text-white" style="margin-top: -3rem">
                            <span class="text-5xl">
                                <i class="fas fa-calendar-day mt-3"></i>
                            </span>
                        </div>
                        <div class="ml-3">
                            <span class="text-gray-500" style="font-size: .8rem">  </span>
                        </div>
                        <div class="flex ml-auto">
                            <div class="justify-end flex project__posted-by">
                                <span class="text-gray-500">Upcoming Events Take Notes</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2 px-2 py-2">
                <h6 class="text-blue-900 font-semibold uppercase">Take Note of the date for the events</h6>
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
                    <div class="bg-teal-500 rounded shadow w-20 mr-2"></div>
                    <div class="project__topics-descriptions">
                        <div class="flex">
                            <h6 class="text-blue-900 font-semibold uppercase">
                                <a href="#">
                                    Mini Defence
                                </a>
                            </h6>
                        </div>
                        <div>
                            <h6 class="text-gray-500">Posted by - Prof. Idowu S.A - </h6>
                            <button class="btn btn-primary btn-sm btn__event">View Details</button>
                        </div>
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