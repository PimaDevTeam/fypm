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
                Projects 
                <div class="ml-auto">
                    <a class="btn btn-admin btn-sm" href="{{route('project.create')}}">
                        <i class="fa fa-plus mr-2" aria-hidden="true"></i>
                        Add Project Topic
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead class="thead-custom">
                    <tr>
                        <th>#</th>
                        <th>Topic</th>
                        <th>Proposed By</th>
                        <th>Program</th>
                        {{-- <th>Status</th> --}}
                        <th>Description</th>
                        <th>File</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            @php
                                $name = App\User::where('id', $project->proposed_by)->get();
                            @endphp
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <a href="#" id="viewModal" data-toggle="modal" data-target="#projectViewModal" 
                                    data-project_id="{{$project->id}}"
                                    data-project_title="{{$project->name}}"
                                    data-project_description="{{$project->project_description}}"
                                    data-project_proposed_by="{{$name[0]->first_name}} {{$name[0]->last_name}}"
                                    > 
                                    {{$project->name}}
                                </a>
                                </td>
                                <td>{{$name[0]->first_name}} {{$name[0]->last_name}}</td>
                                <td>{{$program->first()->program}}</td>
                                {{-- <td>
                                    @if ($project->project_status_id == 1) 
                                        <span class='badge badge-success p-2'>
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                            {{$project->projectStatus()->find($project->project_status_id)->project_status}}
                                            Approved
                                        </span>
                                    @else
                                        <span class='badge badge-danger p-2'>
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                            {{$project->projectStatus()->find($project->project_status_id)->project_status}}
                                        </span>
                                    @endif
                                    
                                </td> --}}
                                <td>{{$description}}</td>
                                <td>{{$project->project_file}}</td>
                                <td>{{date('d-m-Y', strtotime($project->created_at))}}</td>
                                <td>
                                    <form action="{{route('project.unapprove')}}" method="POST">
                                        @csrf
                                        {{ method_field('POST') }}
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                        @if ($project->project_status_id == 1) 
                                                <input type="hidden" name="id" value="{{$project->id}}">
                                                <button type="submit" class="btn btn-danger btn-sm"> <i class="fa fa-times" aria-hidden="true"></i> Unapprove</button>
                                        @else
                                            <button type="submit" class="btn btn-success btn-sm rounded"> 
                                                <i class="fa fa-check" aria-hidden="true"></i>    Approve
                                            </button>
                                        @endif
                                            <a href="{{route('project.edit', $project->id)}}" class="btn btn-secondary btn-admin btn-sm {{ $project->proposed_by == auth()->user()->id ? '' : 'd-none' }}"> 
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        </div>
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

<!-- View Modal -->
<div class="modal fade" id="projectViewModal" tabindex="-1" role="dialog" aria-labelledby="projectViewModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="viewModal" method="POST">
                @csrf
                {{ method_field('DELETE') }}
                <div class="modal-body">
                    <h4 class="text-center text-uppercase">PROPSED BY: <span class="proposedBy"></span></h4>
                    <h6 class="text-uppercase"> Topic: </h6>
                    <h6 class="title mb-3"></h6>
                    <h6 class="text-uppercase">Description:</h6>
                    <p class="description p-2 bg-gray-200 rounded"></p>
                    <p class="file">::file</p>
                    <input type="hidden" class="form-control" id="viewModalId">
                    <div class="flex justify-center mt-4">
                        {{-- <a href="" class="btn btn-danger btn-sm" id="deleteBtn"></a> --}}
                        {{-- <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</button> --}}
                        <button type="button" class="btn btn-secondary ml-3" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

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

        // View Modal
        $('.table').on('click', '#viewModal', function(data){
            $project_id = $(this).data('project_id');
            $project_description = $(this).data('project_description');
            $project_title = $(this).data('project_title');
            $project_proposed_by = $(this).data('project_proposed_by');

            $('.title').text($project_title);
            $('.description').text($project_description);
            $('.proposedBy').text($project_proposed_by);

            // console.log($project_proposed_by);


            // console.log($school_id);
            // $('#deleteSchoolId').val($school_id);
            // var attr = $('#deleteSchool').attr('action', route);
        });

        var deleteBtn = $('.deleteBtn')

        var route = '{{route('schools.destroy', ':id')}}';
        route = route.replace(':id', 1);
        $('.table').on('click', '#delete', function(data){
            $school_id = $(this).data('school_id');
            // console.log($school_id);
            $('#deleteSchoolId').val($school_id);
            var attr = $('#deleteSchool').attr('action', route);
        });
    });
</script>
    
@endpush