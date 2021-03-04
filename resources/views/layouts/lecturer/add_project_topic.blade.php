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
                <h6 class="mt-2 text-blue-800 uppercase">Topics You Uploaded</h6>
                <hr class="mt-1">
                <a href="{{route('lecturer.project.approve.show')}}" class="btn btn-primary btn-c"> <i class="fa fa-check-circle" aria-hidden="true"></i> Approve Topics</a>
            </div>
            @if (count($projects) > 0)
                @foreach ($projects as $project)
                    <div class="project__topics-descriptions bg-white rounded shadow p-2 mb-2">
                        <div class="flex">
                            <h6 class="text-blue-900 font-semibold uppercase">
                                 @php
                                    $name = App\User::where('id', $project->proposed_by)->select('first_name', 'last_name')->get();
                                    $fName = $name[0]->last_name.' '. $name[0]->first_name;
                                @endphp
                                <a href="#" id="viewModal" data-toggle="modal" data-target="#projectViewModal" 
                                    data-project_id="{{$project->id}}"
                                    data-project_title="{{$project->topic}}"
                                    data-project_description="{{$project->project_description}}"
                                    data-project_proposed_by="{{$name[0]->last_name}} {{$name[0]->first_name}}"
                                >
                                    {{$project->topic}}
                                </a>
                            </h6>
                            @php
                                $id = $project->project_status_id;
                                $statusFound = App\ProjectStatus::find($id);
                                $status = $statusFound->project_status;
                            @endphp
                                @if ($statusFound->id == 2)
                                <small class="ml-auto text-yellow-600 font-bold">
                                    Waiting for approval
                                </small>
                                @else
                                <small class="ml-auto text-green-600 font-bold">
                                    {{$status}}
                                </small>
                                @endif
                        </div>
                        <small class="text-gray-500">{{$fName}} </small>
                        <p id="desc" class="mt-2 text-gray-600" style="font-size: .8rem">
                            @php
                                $text = strip_tags($project->project_description);
                                $description = Str::limit($text, 150, '...');
                            @endphp
                            {{$description}}
                        </p>
                    </div>
                @endforeach
            @endif
            <div>
                {{ $projects->links() }}
            </div>
            <div class="main__container bg-white rounded shadow px-2 py-2 mt-5">
                <h6 class="text-blue-900 font-semibold uppercase">Submit Project Topic</h6>
                <hr class="mt-1">
                <form action="{{route('lecturer.project.upload')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="topic">Project Topic</label>
                        <input type="text" class="form-control @error('topic') is-invalid @enderror" name="topic" id="topicValidation" aria-describedby="topicValidation">
                        @error('topic') 
                            <div id="topicValidation" class="invalid-feedback">
                            {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Project Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="editor" cols="30" rows="10" id="descriptionValidation" aria-describedby="descriptionValidation"></textarea>
                        @error('description') 
                            <div id="descriptionValidation" class="invalid-feedback">
                            {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <select name="program_id" id="" class="custom-select">
                            <option value="" selected="true" disabled="true">select program</option>
                            @php
                                $selectedProgram = Auth::user()->program_id;
                                $selectedProgramName = App\Program::where('id', $selectedProgram)->select('program')->first();
                                $program = Auth::user()->program->program;
                            @endphp
                            @foreach ($programs as $program)
                                <option value="{{$program->id}}" {{ $selectedProgram == $program->id ? 'selected="selected"' : '' }} > {{ $selectedProgramName->program == $program->program ? $selectedProgramName->program : $program->program }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" class="form-control" name="proposed_by" value="{{ Auth::user()->id }}">
                    <button type="submit" class="btn btn-primary btn-c">Submit</button>
                </form>
            </div>
        </div>
        {{-- @include('layouts.user.right_sidebar') --}}
    </div>
@endsection

<!-- View Modal -->
<div class="modal fade" id="projectViewModal" tabindex="-1" role="dialog" aria-labelledby="projectViewModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h6 class="text-uppercase mb-3 text-2xl text-blue-900 text-bold"> Topic: <span class="title"></span></h6>
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

@push('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#desc').text();
        $('.toast').toast('show');
        // View Modal
        $('.project__topics-descriptions').on('click', '#viewModal', function(data){
            $project_id = $(this).data('project_id');
            $project_description = $(this).data('project_description');
            $project_title = $(this).data('project_title');
            $project_proposed_by = $(this).data('project_proposed_by');

            $('.title').text($project_title);
            $('.description').text($($project_description).text());
            $('.proposedBy').text($project_proposed_by);
        });
    })
    CKEDITOR.replace( 'description' );
</script>
@endpush