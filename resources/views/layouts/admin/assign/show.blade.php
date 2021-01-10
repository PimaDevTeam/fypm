@extends('layouts.admin.app')
@php

    // foreach ($group_id as $id) {
    //     print_r($id);
    // }
@endphp
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
                    Assign Supervisors to Students
                    <div class="ml-auto">
                        <button class="btn btn-admin btn-sm" id="btnAutomate" data-toggle="modal" data-target="#autoGroupModal">
                            <i class="fa fa-plus mr-2" aria-hidden="true"></i>
                            Automate Groupings
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead class="thead-custom">
                        <tr>
                            <th>#</th>
                            <th>Students</th>
                            <th>Supervisor</th>
                            <th>Sessions</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        @foreach ($studentsAssigned as $student)
                        <form action="{{ route('assign.assignSupervisor') }}" method="POST">
                            @csrf
                            <tbody>
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$student->first_name}} {{$student->last_name}}</td>
                                    <input type="hidden" name="student_id" value="{{$student->id}}">
                                    <td>
                                        {{-- @if ($userProject->supervisor_id == '') --}}
                                            <div class="form-group">
                                                <select class="form-control form-control-sm" name="supervisor_id" id="">
                                                <option value="" selected="true" disabled="true">Select Supervisor</option>
                                                @foreach ($supervisors as $supervisor)
                                                    <option value="{{$supervisor->id}}" id="{{$supervisor->first_name}}">{{$supervisor->first_name}} {{$supervisor->last_name}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        {{-- @else --}}
                                            {{-- <h6> Name {{$userProject->supervisor_id}}</h6> --}}
                                        {{-- @endif --}}
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <select class="form-control form-control-sm" name="session_id" id="">
                                                <option value="" selected="true" disabled="true">Select Session</option>
                                                @foreach ($sessions as $session)
                                                    <option value="{{$session->id}}" id="{{$session->session}}">{{$session->session}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-primary btn-admin btn-sm"> <i class="fa fa-plus" aria-hidden="true"></i> Assign</button>
                                    </td>
                                </tr>
                            </tbody>
                        </form>
                        @endforeach
                        {{-- {{$studentsAssigned->count()}} --}}
                    </table>
                    {{-- <form action="{{ route('assign.assign') }}" method="POST">
                        @csrf
                        <input type="hidden" name="student_id">
                        <input type="hidden" name="supervisor_id">
                        <input type="hidden" name="session_id">
                    </form> --}}
                </div>
                <div class="card-footer text-muted">
                    {{-- {{$studentsAssigned->links()}} --}}
                </div>
            </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

<div class="modal fade" id="autoGroupModal" tabindex="-1" role="dialog" aria-labelledby="autoGroupModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="createGroup" action="{{route('auto.group')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <h4 class="text-center">Create Groups</h4>
                    <h1 class="text-center mt-3 text-6xl">
                        <i class="fas fa-plus-circle"></i>
                    </h1>
                    <div class="form-group mt-4">
                        <label for="">Number of Students Per Group</label>
                        <input type="hidden" name="program_id" value="{{$student->program_id}}">
                        <input type="text" class="form-control" name="number_of_students_per_group" id="number_of_students_per_group">
                    </div>
                    <div class="flex justify-center mt-4">
                        <button type="submit" class="btn btn-primary btn-admin"> <i class="fa fa-plus" aria-hidden="true"></i> Create</button>
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

        // console.log({{ $student->count() }})
        $totalStudents = {{ $student->count() }};
        if($totalStudents < 10) {
            $('#btnAutomate').hide();
        }
        $('.toast').toast('show');

        // $arr = {!! json_encode($group_id) !!};
        // $sh = _.shuffle($arr);
        // $chunk = _.chunk($sh, '5');
        // console.log('ALL - ', $chunk);


        // $last = _.last($chunk);

        // if($last.length < 4 ) {
        //     console.log('not enough students');
        //     $inReminder = _.nth($chunk, -2);

        //     console.log('REMINDER - ',$inReminder);
        //     $union = _.union($last, $inReminder);

        //     // // $take = _.pullAll($last, $last);
        //     console.log('UNION - ' , $union);
        //     $chunk.pop()
        //     console.log($chunk.push($union))
        //     // $last = $union;
        //     // // _.remove($inReminder);s
        //     // $chunk.pop()
        //     // $chunk = $chunk.push($last)

        //     console.log('ALL - ', $chunk);

        // } else {
        //     console.log(_.last($chunk).length);
        // }



    });
</script>
@endpush