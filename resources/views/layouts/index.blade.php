@extends('layouts.main')

@section('content')
    <section class="desc-section pt-10">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-5 col-lg-5">
                    <img src="{{asset('/images/sbg-rmbg.png')}}" class="img-responsive d-none d-lg-block" alt="" style="margin-top: 180px">
                </div>
                <div class="col-sm-12 col-md-7 col-lg-7">
                    <div class="container webDESC">
                        <h1 class="font-weight-bold text-white text-5xl">
                            Final Year Project Mangement System
                        </h1>
                        <h2 class="text-2xl text-white font-w-300 m-25px-b mt-4">It's time to simplify final year project<br>
                            <span class="typed font-w-700 text-teal-200" data-elements="Grouping, Assigning Topics, Assigning Supervisors, Repository, Events, Resources "></span>.
                        </h2>
                        <p class="text-white text-lg">
                            A modern way of managing final year projects for universities.
                        </p>
                        <div class="app descIOCS">
                            <div class="grid sm:grid-cols-3 md:grid-cols-3 grid-cols-3 gap-4">
                                <div class="">
                                    <div class="descIOCN w-20 h-20 sm:w-24 sm:h-24 md:w-32 md:h-32 rounded-full shaodw-lg text-center text-white bg bg-gradient-to-r from-blue-400 via-blue-500 to-blue-700">
                                        <i class="fas fa-project-diagram text-6xl" aria-hidden="true"></i>
                                    </div>
                                    <h6 class="text-white text-lg">Project Repository</h6>
                                </div>
                                <div class="" style="margin-top: 2rem">
                                    <div class="descIOCN w-20 h-20 sm:w-24 sm:h-24 md:w-32 md:h-32 rounded-full shaodw-lg text-center text-white bg bg-gradient-to-r from-blue-400 via-blue-500 to-blue-700">
                                        <i class="fas fa-users text-6xl" aria-hidden="true"></i>
                                    </div>
                                    <h6 class="text-white text-lg">Group Students</h6>
                                </div>
                                <div class="" style="margin-top: 4rem;">
                                    <div class="descIOCN w-20 h-20 sm:w-24 sm:h-24 md:w-32 md:h-32 rounded-full shaodw-lg text-center text-white bg bg-gradient-to-r from-blue-400 via-blue-500 to-blue-700">
                                        <i class="fas fa-check-circle text-6xl" aria-hidden="true"></i>
                                    </div>
                                    <h6 class="text-white text-lg">Assign Topics</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-10 fSECTY pb-10">
        <div class="container mt-10">
            <h1 class="text-4xl text-white text-center">Functionalities</h1>
            <div class="grid sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 grid-cols-1 gap-4 mt-10 justify-content-center">
                <div class="card p-4 hover:shadow-lg rounded">
                    <div class="icon-container text-white rounded-full w-20 h-20 descIOCN" style="background: linear-gradient(to right, #9733EE, #DA22FF);">
                        <i class="fas fa-project-diagram" aria-hidden="true"></i>
                    </div>
                    <h6 class="mt-3 uppercase">Project Repository</h6>
                    <p>
                        Previously done projects are available and can be downloaded if approved
                    </p>
                </div>
                <div class="card p-4 hover:shadow-lg rounded">
                    <div class="icon-container text-white rounded-full w-20 h-20 descIOCN" style="background: linear-gradient(to right, #F37335, #FDC830);">
                        <i class="fa fa-paperclip" aria-hidden="true"></i>
                    </div>
                    <h6 class="mt-3 uppercase">Assigning Topics</h6>
                    <p>
                        Project Coordinators can assign topics to different groups and students
                    </p>
                </div>
                <div class="card p-4 hover:shadow-lg rounded">
                    <div class="icon-container text-white rounded-full w-20 h-20 descIOCN" style="background: linear-gradient(to right, #0072ff, #00c6ff);">
                        <i class="fa fa-user-friends" aria-hidden="true"></i>
                    </div>
                    <h6 class="mt-3 uppercase">Assigning Supervisor</h6>
                    <p>
                        Project Coordinators can assign supervisor to students
                    </p>
                </div>
                <div class="card p-4 hover:shadow-lg rounded">
                    <div class="icon-container text-white rounded-full w-20 h-20 descIOCN" style="background: linear-gradient(to right, #2948ff, #396afc);">
                        <i class="fa fa-users" aria-hidden="true"></i>
                    </div>
                    <h6 class="mt-3 uppercase"> Grouping Students</h6>
                    <p>
                        Project Coordinators can group students together
                    </p>
                </div>
                <div class="card p-4 hover:shadow-lg rounded">
                    <div class="icon-container text-white rounded-full w-20 h-20 descIOCN" style="background: linear-gradient(to right, #4A00E0, #8E2DE2);">
                        <i class="fas fa-calendar-alt" aria-hidden="true"></i>
                    </div>
                    <h6 class="mt-3 uppercase"> Project Events</h6>
                    <p>
                        Project Coordinators create events about project defence dates and venues
                    </p>
                </div>
                <div class="card p-4 hover:shadow-lg rounded">
                    <div class="icon-container text-white rounded-full w-20 h-20 descIOCN" style="background: linear-gradient(to bottom right, #2EAD96, #34CC5B);">
                        <i class="fas fa-file-alt" aria-hidden="true"></i>
                    </div>
                    <h6 class="mt-3 uppercase">Project Resources</h6>
                    <p>
                        Resources on how to write and documentation projects are available for students
                    </p>
                </div>
                <div class="card p-4 hover:shadow-lg rounded">
                    <div class="icon-container text-white rounded-full w-20 h-20 descIOCN" style="background: linear-gradient(to right, #F16529, #E44D26);">
                        <i class="fas fa-comments" aria-hidden="true"></i>
                    </div>
                    <h6 class="mt-3 uppercase">Chat</h6>
                    <p>
                        Students and supervisors can communicate with each other
                    </p>
                </div>
                <div class="card p-4 hover:shadow-lg rounded">
                    <div class="icon-container text-white rounded-full w-20 h-20 descIOCN" style="background: linear-gradient(to left, #f80759, #bc4e9c);">
                        <i class="fas fa-check-circle" aria-hidden="true"></i>
                    </div>
                    <h6 class="mt-3 uppercase">Approve Topics</h6>
                    <p>
                        Project Coordinators approve topics
                    </p>
                </div>
            </div>
            <p class="text-center text-white mt-10">
                Copyright ©
                <script type="text/javascript"> document.write(new Date().getFullYear())</script>
                Babcock University. All Rights Reserved
            </p>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            var typedjs = jQuery('.typed');
            if(typedjs.length > 0) {  
                $.getScript('/js/typed.js', function() {
                    typedjs.each(function () {
                        var $this = $(this);
                        $this.typed({
                        strings: $this.attr('data-elements').split(','),
                        typeSpeed: 150, // typing speed
                        backDelay: 500 // pause before backspacing
                        });
                    }); 
                });
            }
        })
    </script>
@endpush