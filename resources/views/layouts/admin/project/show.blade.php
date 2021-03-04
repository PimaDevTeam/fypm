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
                Topics Assigned to students
                {{-- <div class="ml-auto">
                    <a class="btn btn-admin btn-sm" href="">
                        <i class="fa fa-eye mr-2" aria-hidden="true"></i>
                        View Students Assigned
                    </a>
                </div> --}}
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead class="thead-custom">
                    <tr>
                        <th>#</th>
                        <th>Student</th>
                        <th>Supervisor</th>
                        <th>Department</th>
                        <th>Project Topic</th>
                        <th>Session</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                        @php
                            $supervisor = App\User::where('id', $student->supervisor_id)->select('first_name', 'last_name')->get();
                            $program = App\Program::where('id', $student->program_id)->select('program')->get();
                            $project = App\Project::where('id', $student->project_id)->select('topic')->get();
                            $session = App\Session::where('id', $student->session_id)->select('session')->get();
                        @endphp
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$student->first_name}} {{$student->last_name}}</td>
                                <td>{{$supervisor[0]->first_name}} {{$supervisor[0]->last_name}}</td>
                                <td>{{$program[0]->program}}</td>
                                <td>{{$project[0]->topic}}</td>
                                <td>{{$session[0]->session}}</td>
                                <td>
                                    <form action="{{route('project.remove.student.topic')}}" class="mb-0" method="POST">
                                        @csrf
                                        <input type="hidden" name="student_id" value="{{$student->student_id}}">
                                        <button type="submit" class="btn btn-danger btn-sm">Remove topic</button>
                                    </form>
                                </td>
                            </tr>
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