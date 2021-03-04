@extends('layouts.admin.app')
@php

    // foreach ($group_id as $id) {
    //     print_r($id);
    // }
@endphp
<style>
    .btn-supervisor {
        padding: .1rem .5rem .1rem .1rem;
        background: var(--teal)!important;
        border-color: var(--teal)!important;
    }
    .isupervisor {
        padding: .5rem!important;
        background: var(--teal)!important;
        color: #fff!important;
        border: 0!important;
        font-size: .9rem!important;
    }
</style>
@section('content')
    <div class="content">
        <div class="container-fluid">
            @include('messages')
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ $error }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endforeach
            @endif
            <div class="card">
                <div class="card-header flex">
                    Assign Supervisors to Groups
                    <div class="ml-auto">
                    </div>
                </div>
                <div class="card-body">
                    <div class="row justify-center">
                        @foreach ($groups as $key => $group)
                            <div class="col-12 col-md-6 col-lg-6 mb-lg-3">
                                <div class="assign__card--container shadow p-4 bg-white">
                                    <h5 class="mb-4 text-2xl">Group {{$loop->iteration}}</h5>
                                    <div class="flex mb-2">
                                        @php
                                            $ids = array();
                                            array_push($ids, $key);
                                            $gPids = array();
                                            foreach($groupProject as $gPid) {
                                                array_push($gPids, $gPid->group_id);
                                            }
                                        @endphp
                                        @if (in_array($key, $gPids))
                                            @php
                                                $projectTopicId = App\GroupProject::where('group_id', $key)->get();
                                                $projectTopic = App\Project::where('id', $projectTopicId[0]->project_id)->get();
                                            @endphp
                                            <h6 class="mb-0 mr-auto">Topic: {{$projectTopic[0]->topic}}</h6>
                                        @else
                                            <form action="{{route('group.assign.topic')}}" method="POST" class="mb-0 mr-auto" style="width: 45%;">
                                                @csrf
                                                <div class="input-group">
                                                    <select class="form-control" name="project_id" id="">
                                                        <option value="" selected="true" disabled="true">Select Project Topic</option>
                                                        @foreach ($projects as $project)
                                                            <option value="{{$project->id}}">{{$project->topic}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-primary btn-sm btn-admin">Assign</button>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="group_id" value="{{$key}}">
                                                <input type="hidden" name="session_id" value="{{$group[0]->session_id}}">
                                                <input type="hidden" name="program_id" value="{{$group[0]->program_id}}">
                                            </form>
                                        @endif
                                        @php
                                            $gids = array();
                                            array_push($gids, $key);
                                            $gSids = array();
                                            foreach($groupSupervisorId as $gSid) {
                                                array_push($gSids, $gSid->group_id);
                                            }
                                        @endphp
                                        @if (in_array($key, $gSids))
                                            @php
                                                $supervisorId = App\groupSupervisor::where('group_id', $key)->get();
                                                $supervisor = App\User::where('id', $supervisorId[0]->supervisor_id)->get();
                                                $sFullname = $supervisor[0]->first_name. ' '. $supervisor[0]->last_name;
                                            @endphp
                                            <form action="{{route('group.delete.supervisor')}}" class="mb-0" method="POST">
                                                @csrf
                                                <div class="input-group">
                                                    <input type="text" class="form-control isupervisor" value="{{$sFullname}}" readonly>
                                                    <input type="hidden" value="{{$key}}" name="group_id">
                                                    <input type="hidden" name="supervisor_id" value="{{$supervisorId[0]->supervisor_id}}">
                                                    <input type="hidden" name="program_id" value="{{$group[0]->program_id}}">
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-primary btn-sm btn-supervisor" data-toggle="tooltip" data-placement="top" title="Remove Supervisor">x</button>
                                                    </div>
                                                </div>
                                            </form>
                                        @else
                                            <div class="flex">
                                                <form class="mb-0" action="{{ route("group.assign.supervisor") }}" method="POST">
                                                    @csrf
                                                    <div class="input-group">
                                                        <select class="form-control" name="supervisor_id" id="">
                                                            <option value="" selected="true" disabled="true">Select Supervisor</option>
                                                            @foreach ($supervisors as $supervisor)
                                                                <option value="{{$supervisor->id}}">{{$supervisor->first_name}} {{$supervisor->last_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="input-group-append">
                                                            <button type="submit" class="btn btn-primary btn-sm btn-admin">Assign</button>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="group_id" value="{{$key}}">
                                                    <input type="hidden" name="program_id" value="{{$group[0]->program_id}}">
                                                </form>
                                            </div>
                                        @endif
                                    <button class="btn btn-primary btn-sm btn-admin ml-1 text-cente" id="addStudent" data-toggle="modal" data-target="#studentAddModal" data-group_id="{{$key}}">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Add Student
                                    </button>
                                    </div>
                                    <table class="table table-striped">
                                        <thead class="thead-custom">
                                            <tr>
                                                <th>#</th>
                                                <th>Students</th>
                                                <th class="text-right pr-4">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($group as $student)
                                                @php
                                                    $name = App\User::where('id', $student->student_id)->get();
                                                    $fullname = $name[0]->first_name.' '.$name[0]->last_name;
                                                @endphp
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$fullname}}</td>
                                                    <td class="text-right">
                                                        <form action="{{route('group.delete.student')}}" method="POST">
                                                        @csrf
                                                            <input type="hidden" name="student_id" class="form-control" value="{{$student->student_id}}">
                                                            <input type="hidden" name="group_id" value="{{$student->group_id}}">
                                                            <input type="hidden" name="program_id" value="{{$group[0]->program_id}}">
                                                            <button type="submit" class="btn btn-danger btn-sm"> <i class="fa fa-times" aria-hidden="true"></i> Remove</button>
                                                        </form>
                                                        {{-- <a href="#" class="btn btn-danger btn-sm">Remove</a> --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer text-muted">
                    {{-- {{$studentsAssigned->links()}} --}}
                </div>
            </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

{{-- Student Add Modal --}}
<div class="modal fade" id="studentAddModal" tabindex="-1" role="dialog" aria-labelledby="studentAddModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="studentAddForm" action="{{route('group.add.student')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <h4 class="text-center">Add Student to Group <span class="group"></span> </h4>
                    <h1 class="text-center mt-3 text-2xl">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    </h1>
                    <table class="table table-striped">
                        <thead class="thead-custom">
                            <tr>
                                <th>Student</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($studentsAssigned as $student)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="student[]" value="{{$student->id}}" id="student_id">
                                        <input type="hidden" name="group[]" id="group_id" value="">
                                        <label class="form-check-label" for="student_id">
                                            {{$student->first_name}} {{$student->last_name}}
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <input type="hidden" class="form-control" id="deleteStudentId">
                    <div class="flex justify-center mt-4">
                        {{-- <a href="" class="btn btn-danger btn-sm" id="deleteBtn"></a> --}}
                        <button type="submit" class="btn btn-primary btn-admin"> <i class="fa fa-plus" aria-hidden="true"></i> Add Students</button>
                        <button type="button" class="btn btn-secondary ml-3" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('.toast').toast('show');
        $('[data-toggle="tooltip"]').tooltip();

        $('#studentAddModal').on('show.bs.modal', function(e) {
            var button = $(e.relatedTarget);
            var group_id = button.data('group_id');
            console.log(group_id);
            var modal = $(this)
            modal.find('#group_id').val(group_id);
            if(group_id == 0) {
                modal.find('.group').text(1);
            } else {
                modal.find('.group').text(group_id + 1);
            }
        })
    });
</script>
@endpush