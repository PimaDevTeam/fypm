<?php 
$user = Auth::user();
?>

<style>
    .projectFile {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
    }
    .projectFile + label {
        font-size: 1rem;
        font-weight: 400;
        color: #6c757d;
        background-color: #fff;
        display: flex;
        border-radius: 5px;
        padding: .4rem;
        width: 100%;
        text-align: center;
    }

    .projectFile:focus + label,
    .projectFile + label:hover {
        background-color:#ffff;
        color: var(--admin-blue);
    }
    .projectFile + label {
        cursor: pointer; /* "hand" cursor */
    }

    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        color: #fff!important;
        background-color: #2c7a7b!important;
        border-color: #2c7a7b!important;
    }
    .ext_img {
        width: 20px;
        height: 30px;
    }
</style>

@extends('layouts.user.app')

@section('content') 
    @include('messages')
    <div class="row mt-4">
        {{-- @include('layouts.user.left_sidebar') --}}
        @php
            // dd($project);
        @endphp
        <div class="col-12 col-sm-12 col-md-9 col-lg-9">
            @if ($project !=  NULL)
                <div class="main__container bg-white rounded shadow px-2 py-2">
                    <h6 class="text-blue-900 font-semibold uppercase">Project Topic: {{$project->topic}}</h6>
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
                                <span class="text-gray-500" style="font-size: .8rem"> <i class="far fa-clock"></i> {{\Carbon\Carbon::parse($project->created_at)->diffForHumans()}}</span>
                            </div>
                            <div class="flex ml-auto">
                                <div class="justify-end flex project__posted-by">
                                    <div class="mr-2">
                                        <h6 class="mb-1">Posted by</h6>
                                        @php
                                            $proposed = App\User::where('id', $project->proposed_by)->select('first_name', 'last_name', 'image')->first();
                                        @endphp
                                        <small class="text-gray-500">
                                            @if ($proposed->first_name == 'Super')
                                                Administrator
                                            @else
                                                {{$proposed->last_name}} {{$proposed->first_name}}
                                            @endif
                                        </small>
                                    </div>
                                    <img src="{{asset('/storage/images/'.$proposed->image)}}" onerror="this.onerror=null;this.src='/images/avatar.png';" class="mr-2" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 px-2 py-2">
                    <h6 class="text-blue-900 font-semibold uppercase">Project Description</h6>
                    <hr class="mt-1">
                        <p class="">
                        {{$project->project_description}}
                        </p>
                        <hr>
                        <h6 class="font-semi-bold uppercase sidebar__header">My Project Document</h6>
                        <a href="{{ route('student.project.upload') }}" class="btn btn-primary btn-c">Upload Project Document</a>
                    </div>
                </div>  
                <div class="main_container rounded bg-white shadow px-2 py-2 mt-4">
                    <h6 class="text-blue-900 font-semibold uppercase">Project Folder </h6>
                    <hr class="mt-1">
                    @include('includes.project_files')
                </div>
                @if (count($comments) > 0)
                    <div class="main__container bg-white mt-4 rounded shadow px-2 py-2">
                        <h6 class="text-blue-900 font-semibold uppercase">Comments</h6>
                        <hr class="mt-1">
                        @include('includes.comment')
                    </div>  
                @endif
            @else
                <div class="main__container bg-white rounded shadow px-2 py-2">
                    <h6 class="text-center uppercase">You have not been assinged topic yet</h6>
                </div>
            @endif
            
        </div>
        @include('layouts.user.right_sidebar')
    </div>
@endsection

@push('script')
    <script src="{{asset('/js/comments.js')}}"></script>
        <script>
        $(document).ready(function() {
            // Edit Modal
            $('.comment-header').on('click', '#editModal', function(data) {
                $comment = $(this).data('comment');
                $id = $(this).data('id');
                // console.log($comment);
                // console.log($id);
                $('#editForm #comment_id').val($id);
                $('#editForm #comment').val($comment);

                var route = '{{route('comments.edit', ':id')}}';
                route = route.replace(':id', $id);
                $('#editForm').attr('action', route);
                // console.log(route);
            })
        })
    </script>
@endpush