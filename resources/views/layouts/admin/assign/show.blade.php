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
                            <th>Action</th>
                        </tr>
                        </thead>
                        @foreach ($students as $student)
                            <tbody>
                                <tr>
                                    <td>{{$student->first_name}} {{$student->first_name}}</td>
                                    <td>
                                        <div class="form-group">
                                          <select class="form-control form-control-sm" name="" id="">
                                            <option value="" selected="true" disabled="true">Select Supervisor</option>
                                            @foreach ($supervisors as $supervisor)
                                                <option value="{{$supervisor->id}}">{{$supervisor->first_name}} {{$supervisor->first_name}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-admin btn-sm">Assign</button>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
                <div class="card-footer text-muted">
                </div>
            </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection