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
                Assign Topics 
                <div class="ml-auto">
                    <a class="btn btn-admin btn-sm" href="{{route('project.assigned.students', $studentProgram[0]->id)}}">
                        <i class="fa fa-eye mr-2" aria-hidden="true"></i>
                        View Students Assigned
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead class="thead-custom">
                    <tr>
                        <th>#</th>
                        <th>Student</th>
                        <th>Supervisor</th>
                        <th>Department</th>
                        {{-- <th>Status</th> --}}
                        <th>Projects Available</th>
                        <th>Session</th>
                        {{-- <th>Created At</th> --}}
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($Userprojects as $Userproject)
                            <form action="{{route('project.assign.topic', $Userproject->student_id)}}" method="POST">
                                @csrf
                                {{ method_field('POST') }}
                                @php
                                    $student = App\User::where('id', $Userproject->student_id)->get();
                                    $supervisor = App\User::where('id', $Userproject->supervisor_id)->get();
                                    $session = App\Session::where('id', $Userproject->session_id)->get()
                                @endphp
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$student[0]->first_name}} {{$student[0]->last_name}}</td>
                                    <td>{{$supervisor[0]->first_name}} {{$supervisor[0]->last_name}}</td>
                                    <td>{{$studentProgram[0]->program}}</td>
                                    {{-- <td>{{$Userproject->project_id}}</td> --}}
                                    <td>
                                        <select class="form-control" name="project_id" id="">
                                            <option value="" selected="true" disabled="true">Select Topic</option>
                                            @foreach ($projects as $project)
                                                <option value="{{$project->id}}">{{$project->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>{{$session[0]->session}}</td>
                                    <td>
                                        <button type="submit" class="btn btn-primary btn-admin"> <i class="fa fa-plus" aria-hidden="true"></i> Assign Topic</button>
                                    </td>
                            </form>
                        @endforeach

                    </tbody>
                </table>
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