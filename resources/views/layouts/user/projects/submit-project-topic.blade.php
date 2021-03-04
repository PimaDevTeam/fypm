<?php 
$user = Auth::user();
?>

@extends('layouts.user.app')

@section('content') 
    @include('messages')
    <div class="row mt-4">
        @include('layouts.user.left_sidebar')
        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
            <h6 class="text-blue-900 font-semibold uppercase">Project Topics Submitted</h6>
            <hr>
        @if (count($project) > 0)
            @foreach ($project as $project)
                <div class="main__container bg-white mb-2 rounded shadow px-2 py-2">
                    <div class="flex">
                        <div class="bg-blue-800 rounded shadow w-5 mr-2"></div>
                        {{-- @if (count($project) > 0) --}}
                            {{-- @foreach ($project as $project) --}}
                                <div class="project__topics-descriptions w-100">
                                    <div class="flex">
                                        <h6 class="text-blue-900 font-semibold uppercase">
                                            @php
                                                // dd($project);
                                                // if(count($project) > 0) {
                                                //     $project = App\Project::where('id', $project->project_id)->first();
                                                // } 
                                                // echo($project);
                                            @endphp
                                            <a href="#">
                                                {{$project->topic}}
                                            </a>
                                        </h6>
                                        @php
                                            $id = $project->project_status_id;
                                            $statusFound = App\ProjectStatus::find($id);
                                            $status = $statusFound->project_status;
                                        @endphp
                                            @if ($statusFound->id == 2)
                                            <small class="ml-auto bg-yellow-600 rounded text-white p-2 font-bold">
                                                Waiting for approval
                                            </small>
                                            @elseif($statusFound->id == 5)
                                            <div class="flex ml-auto dfTOFRSTU">
                                                <small class="ml-auto bg-red-600 text-white rounded p-2 font-bold">
                                                    {{$status}}
                                                </small>
                                                @php
                                                    $reason = App\ProjectReason::where('project_id', $project->id)->select('reason')->get();
                                                @endphp
                                                <small class="ml-2 bg-gray-600 text-white rounded p-2 font-bold cursor-pointer" id="viewModal" data-toggle="modal" data-target="#projectViewModal" 
                                                    data-reason="{{$reason[0]->reason}}"
                                                    > 
                                                    Reason
                                                </small>
                                            </div>
                                            @else
                                            <small class="ml-auto text-green-600 font-bold">
                                                {{$status}}
                                            </small>
                                            @endif
                                    </div>
                                    @php
                                        $name = App\User::where('id', $project->proposed_by)->select('first_name', 'last_name')->get();
                                        $fName = $name[0]->first_name .' '. $name[0]->last_name;
                                    @endphp
                                    <small class="text-gray-500">{{$fName}} </small>
                                    {{-- <p class="mt-2 text-gray-600" style="font-size: .8rem">
                                        {!!$project->project_description!!}
                                    </p> --}}
                                </div>
                            {{-- @endforeach --}}
                        {{-- @endif --}}
                    </div>
                </div>
            @endforeach
        @endif
        @php
            $rejected = DB::table('project_reasons')
                ->where('project_id', $project->id)
                ->get();
            // dd($rejected);
        @endphp
            {{-- @if (empty($project)) --}}
                <div class="main__container bg-white rounded shadow px-2 py-2 mt-4">
                    <h6 class="text-blue-900 font-semibold uppercase">Submit Project Topic</h6>
                    <hr class="mt-1">
                    <form action="{{route('student.project.submit')}}" method="POST">
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
                        <input type="hidden" class="form-control" name="proposed_by" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="program_id" value="{{Auth::user()->program_id}}">
                        <input type="submit" value="Submit" class="btn btn-primary">
                    </form>
                </div>
            {{-- @endif  --}}
        </div>
        @include('layouts.user.right_sidebar')
    </div>

<!-- View Modal -->
<div class="modal fade" id="projectViewModal" tabindex="-1" role="dialog" aria-labelledby="projectViewModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h6 class="text-uppercase">Reason:</h6>
                <p class="reason p-2 bg-gray-200 rounded"></p>
                <div class="flex justify-end mt-4">
                    <button type="button" class="btn btn-secondary ml-3" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
    @endsection

@push('script')
    <script>
        CKEDITOR.replace('editor');
        $(document).ready(function() {
            $('.toast').toast('show');

            $('.dfTOFRSTU').on('click', '#viewModal', function(data){
                $reason = $(this).data('reason');
                $('.reason').text($reason);
            });
        });
    </script>
@endpush