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
                    UnAssign Supervisor from Students
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
                                <th>Students</th>
                                <th>Supervisor</th>
                                <th>Sessions</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @foreach ($studentsAssigned as $student)
                                <tbody>
                                    <tr>
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
                                            <button type="button" class="btn btn-danger btn-sm" id="delete" data-toggle="modal" data-target="#deleteModal" data-student_id="{{$student->id}}"><i class="fas fa-user-minus"></i> Unassign</button>
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
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

{{-- Delete Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="deleteStudentAssigned" method="POST">
                @csrf
                {{ method_field('DELETE') }}
                <div class="modal-body">
                    <h4 class="text-center">Are you sure you want to Unassign?</h4>
                    <h1 class="text-center mt-3 text-6xl">
                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    </h1>
                    <input type="hidden" class="form-control" id="deleteStudentId">
                    <div class="flex justify-center mt-4">
                        {{-- <a href="" class="btn btn-danger btn-sm" id="deleteBtn"></a> --}}
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</button>
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

        var route = '{{route('unassign.supervisor', ':id')}}';
        route = route.replace(':id', {{$student->id}});
        $('.table').on('click', '#delete', function(data){
            $student_id = $(this).data('student_id');
            // console.log($school_id);
            $('#deleteStudentId').val($student_id);
            var attr = $('#deleteStudentAssigned').attr('action', route);
        }); 
    });
</script>
@endpush