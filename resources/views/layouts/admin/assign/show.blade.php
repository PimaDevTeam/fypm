@extends('layouts.admin.app')

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
                    {{-- <div class="ml-auto">
                        <button class="btn btn-admin btn-sm" data-toggle="modal" data-target="#programCreateModal">
                            <i class="fa fa-plus mr-2" aria-hidden="true"></i>
                            Create New Program
                        </button>
                    </div> --}}
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead class="thead-custom">
                        <tr>
                            <th>Students</th>
                            <th>Supervisor</th>
                            <th>Sessions</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        @foreach ($studentsUnassigned as $student)
                        <form action="{{ route('assign.assignSupervisor') }}" method="POST">
                            @csrf
                            <tbody>
                                <tr>
                                    <td>{{$student->first_name}} {{$student->last_name}}</td>
                                    <input type="hidden" name="student_id" value="{{$student->id}}">
                                    <td>
                                        {{-- @if ($userProject->supervisor_id == '') --}}
                                            <div class="form-group">
                                                <select class="form-control form-control-sm" name="supervisor_id" id="">
                                                <option value="" selected="true" disabled="true">Select Supervisor</option>
                                                @foreach ($supervisors as $supervisor)
                                                    <option value="{{$supervisor->id}}">{{$supervisor->first_name}} {{$supervisor->last_name}}</option>
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
                                                    <option value="{{$session->id}}">{{$session->session}}</option>
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
                    </table>
                    {{-- <form action="{{ route('assign.assign') }}" method="POST">
                        @csrf
                        <input type="hidden" name="student_id">
                        <input type="hidden" name="supervisor_id">
                        <input type="hidden" name="session_id">
                    </form> --}}
                </div>
                <div class="card-footer text-muted">
                </div>
            </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection


@push('scripts')
<script>
    $(document).ready(function() {
        $('.toast').toast('show');
    });
</script>
@endpush