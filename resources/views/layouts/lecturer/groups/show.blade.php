<?php 
$user = Auth::user();
// $fileComment = Model::ProjectFile;
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
        <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
            @php
                // dd($group_project);
            @endphp
            <div class="main__container bg-white rounded shadow px-2 py-2">
                <h6 class="text-blue-900 font-semibold uppercase"> {{$group_project[0]->topic}}  </h6>
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
                                <span class="text-gray-500">Group Project</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2 px-2 py-2">
                <h6 class="text-blue-900 font-semibold uppercase">Description</h6>
                <hr class="mt-1">
                    <p class="">
                        {{$group_project[0]->project_description}}
                    </p>
                </div>
            </div>
            <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#student" role="tab" aria-controls="student" aria-selected="true">Students</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#project" role="tab" aria-controls="project" aria-selected="false">Project</a>
                </li>
            </ul>
            <div class="tab-content mt-4" id="myTabContent">
                <div class="tab-pane fade show active" id="student" role="tabpanel" aria-labelledby="student-tab">
                    <div class="bg-white mt-2 shadow px-2 py-2 rounded mt-2">
                        <h6 class="text-blue-900 font-semibold uppercase">Project Students </h6>
                        @foreach ($group_members as $member)
                            <div class="flex">
                                <div class="project-member__image-container">
                                    <img src="{{asset('/storage/images/'.$member->image)}}" onerror="this.onerror=null;this.src='/images/avatar.png';" alt="">
                                </div>
                                <div class="ml-3 mt-2">
                                    <h6 class="font-semibold mb-0">
                                        <a href="#">
                                            {{$member->last_name}} {{$member->first_name}}
                                        </a>
                                    </h6>
                                    <small class="text-gray-500 mt-1">Student Participant</small>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="project" role="tabpanel" aria-labelledby="project-tab">
                    <div class="bg-white rounded px-2 py-2 shadow-sm">
                        <h6 class="text-blue-900 font-semibold uppercase">Project Folder </h6>
                        <hr>
                        @include('includes.project_files')
                        @if (count($comments) > 0)
                            @include('includes.comment')    
                        @endif
                    </div>
                    {{-- Vue Comments --}}
                            {{-- <div class="mt-5">
                                <comments-list :project="{{$group_project}}" :user="{{auth()->user()->id}}"></comments-list>
                            </div> --}}
                </div>
            </div>
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