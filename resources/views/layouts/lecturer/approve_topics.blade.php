<?php 
$user = Auth::user();
?>

@extends('layouts.user.app')

@section('content') 
    @include('messages')
    <div class="row mt-4">
        @include('layouts.user.left_sidebar')
        <div class="col-12 col-sm-12 col-md-9 col-lg-9">
            <div class="flex mb-2 justify-between">
                <h6 class="mt-2 text-blue-800 uppercase">Approve Topics</h6>
            </div>
            {{-- <div class="flex flex-col"> --}}
                <div class="overflow-x-auto ">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-2 lg:px-2">
                    <div class="shadow-md overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                            <th scope="col" class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                            <th scope="col" class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Project Title
                            </th>
                            <th scope="col" class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Program
                            </th>
                            <th scope="col" class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Posted
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($projects as $project)
                                <tr>
                                    <td class="px-2 py-2 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60" alt="">
                                            </div>
                                            <div class="ml-1">
                                                <div class="text-sm font-medium text-gray-900">
                                                {{$project->last_name}} {{$project->first_name}}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                {{$project->email}}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 pTOFRSTU">
                                            <a href="#" id="viewModal" data-toggle="modal" data-target="#projectViewModal" 
                                            data-project_id="{{$project->id}}"
                                            data-project_title="{{$project->topic}}"
                                            data-project_description="{{$project->project_description}}"
                                            data-project_proposed_by="{{$project->last_name}} {{$project->first_name}}"
                                            > {{$project->topic}}</a>
                                        </div>
                                        <div class="text-sm text-gray-500">Optimization</div>
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm">
                                        {{$project->program}}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-sm text-gray-500">
                                        {{\Carbon\Carbon::parse($project->created_at)->format("m/d/Y H:i a")}}
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900"></a>
                                        <div class="btn-group pTOFORM" role="group" aria-label="Basic example">
                                            <form action="{{route('lecturer.project.approve.update')}}" method="POST" class="mb-0">
                                                @csrf
                                                <input type="hidden" name="student_id" value="{{$project->student_id}}">
                                                <input type="hidden" name="program_id" value="{{$project->project_program_id}}">
                                                <input type="hidden" name="topic" value="{{$project->topic}}">
                                                <button type="submit" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Approve"> <i class="fa fa-check-circle" aria-hidden="true"></i> </button>
                                            </form>
                                            <button type="button" class="btn btn-danger" id="rejectModal" data-toggle="modal" data-target="#projectRejected"
                                                data-project_title="{{$project->topic}}"
                                                data-project_program_id="{{$project->program_id}}"
                                            > 
                                            <i class="fa fa-times-circle" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Reject"></i> 
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            {{-- </div> --}}

        </div>
        {{-- @include('layouts.user.right_sidebar') --}}
    </div>
@endsection

<!-- View Modal -->
<div class="modal fade" id="projectViewModal" tabindex="-1" role="dialog" aria-labelledby="projectViewModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h6 class="text-uppercase mb-3 text-lg text-blue-900 font-bold"> Topic: <span class="title"></span></h6>
                <h6 class="text-uppercase">Description:</h6>
                <p class="description p-2 bg-gray-200 rounded"></p>
                <input type="hidden" class="form-control" id="viewModalId">
                <div class="flex justify-center mt-4">
                    <button type="button" class="btn btn-secondary ml-3" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Rejected Modal -->
<div class="modal fade" id="projectRejected" tabindex="-1" role="dialog" aria-labelledby="projectRejected" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form action="{{route('lecturer.project.reject')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Reason:</label>
                        <input type="hidden" class="program_id" name="program_id">
                        <input type="hidden" class="topic"  name="topic" >
                        <textarea name="reason" class="form-control" id="" cols="30" rows="2"></textarea>
                        <small class="text-muted">Reason for rejecting the topic</small>
                    </div>
                    <div class="flex justify-end mt-4">
                        <button class="btn btn-success">Submit</button>
                        <button type="button" class="btn btn-secondary ml-2" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('.toast').toast('show');
        // View Modal
        $('.pTOFRSTU').on('click', '#viewModal', function(data){
            $project_id = $(this).data('project_id');
            $project_description = $(this).data('project_description');
            $project_title = $(this).data('project_title');
            $project_proposed_by = $(this).data('project_proposed_by');

            $('.title').text($project_title);
            $('.description').text($($project_description).text());
            $('.proposedBy').text($project_proposed_by);
        });

        // Reject Modal
        $('.pTOFORM').on('click', '#rejectModal', function(data){
            $project_title = $(this).data('project_title');
            $program_id = $(this).data('project_program_id');

            $('.topic').val($project_title);
            $('.program_id').val($program_id);
        });

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
    })
</script>
@endpush