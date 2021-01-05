@php
    $firstName = auth()->user()->first_name;
    $lastName = auth()->user()->last_name;
    $role = Auth::user()->roles[0]->id === 1;

@endphp
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
                <h5>
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    Create Project
                </h5>
            </div>
            <div class="card-body">
                <form action="{{route('project.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="topic">Project Topic</label>
                                <input type="text" class="form-control" name="topic">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="topic">Proposed By</label>
                                <input type="hidden" name="proposed_by" value="{{auth()->user()->id}}">
                                <input type="text" class="form-control" value="{{$firstName}} {{$lastName}}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="program">Program</label>
                                @if ($role)
                                    <select name="program_id" class="form-control" id="">
                                        <option value="" selected="true" disabled="true">Select Program</option>
                                        @foreach ($programs as $program)
                                            <option value="{{$program->id}}">{{$program->program}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <input type="text" class="form-control" name="program_id" value="{{auth()->user()->progam_id}}">
                                @endif
                            </div>
                        </div>
                        <div class="col">
                            <label for="">Project File</label>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" name="project_file" id="inputGroupFile02">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Project Description</label>
                        <textarea name="project_description" class="form-control" id="" cols="30" rows="10"></textarea>
                    </div>
                    @if ($role)
                        <input type="hidden" name="project_status" value="1">
                    @else
                        <input type="hidden" name="project_status" value="2">
                    @endif
                    <button type="submit" class="btn btn-primary btn-admin btn-lg">
                        {{-- <i class="fa fa-upload" aria-hidden="true"></i> --}}
                        Upload
                    </button>
                </form>
            </div>
        </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
@endsection

<!-- Delete Modal -->
<div class="modal fade" id="schoolDeleteModal" tabindex="-1" role="dialog" aria-labelledby="schoolDeleteModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="deleteSchool" method="POST">
                @csrf
                {{ method_field('DELETE') }}
                <div class="modal-body">
                    <h4 class="text-center">Are you sure you want to Delete?</h4>
                    <h1 class="text-center mt-3 text-6xl">
                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    </h1>
                    <input type="hidden" class="form-control" id="deleteSchoolId">
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
    });
</script>
    
@endpush