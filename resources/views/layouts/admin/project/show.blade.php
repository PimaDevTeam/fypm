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
                Students Assigned
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
                        @foreach ($Userprojects as $project)
                            <td>{{$loop->iteration}}</td>
                            <td>{{$student[0]->first_name}} {{$student[0]->last_name}}</td>
                            <td>{{$supervisor[0]->first_name}} {{$supervisor[0]->last_name}}</td>
                            <td>{{$studentProgram[0]->program}}</td>
                            <td>{{$projectTopic[0]->name}}</td>
                            <td>{{$session[0]->session}}</td>
                            <td>Action</td>
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