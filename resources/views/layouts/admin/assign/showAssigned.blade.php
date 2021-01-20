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
                    Unassign Supervisor from Students
                </div>
                {{-- @if (!isset($studentsUnassigned ))
                    <div class="container">
                        <h1 class="text-center">No Student</h1>
                    </div>
                @else --}}
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
                            @if (count($studentsAssigned) > 0) 
                                @foreach ($studentsAssigned as $student)
                                    <tbody>
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$student->first_name}} {{$student->last_name}}</td>
                                            <input type="hidden" name="student_id" value="{{$student->id}}">
                                            <td>
                                                @foreach ($supervisorAssigned as $supervisor)
                                                    {{$supervisor->first_name}} {{$supervisor->last_name}}
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($sessionId as $session)
                                                    {{$session->session}}
                                                @endforeach
                                            </td>
                                            <td>
                                                <form action="{{route('unassign.supervisor', $student->id)}}" method="POST">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <input type="hidden" class="form-control" id="deleteStudentId" name="student_id" value="{{$student->id}}">
                                                    <button type="submit" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-user-minus"></i> Unassign</button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            @else
                                <h6 class="text-center text-2xl">No Student Found</h6>
                            @endif
                        </table>
                    </div>
                {{-- @endif --}}
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
