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
                List of schools
                <div class="ml-auto">
                    <button class="btn btn-admin btn-sm" data-toggle="modal" data-target="#departmentCreateModal">
                        <i class="fa fa-plus mr-2" aria-hidden="true"></i>
                        Create New Department
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead class="thead-custom">
                    <tr>
                        <th>Department</th>
                        <th>Department Code</th>
                        <th>School</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($departments as $department)
                            <tr>
                                <td>{{$department->department}}</td>
                                <td>{{$department->department_code}}</td>
                                <td>{{$department->school->school}}</td>
                                <td>
                                    <div class="btn-group">
                                        {{-- Edit --}}
                                        <a href="{{route('departments.edit', $department->department_code)}}" class="btn btn-admin btn-sm edit"><i class="fas fa-edit"></i> Edit</a> 
                                        {{-- Delete --}}
                                        <button type="button" class="btn btn-danger btn-sm" id="delete" data-toggle="modal" data-target="#departmentDeleteModal" data-department_id="{{$department->id}}"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-muted">
            </div>
        </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
@endsection

<!-- Modal -->
<div class="modal fade" id="departmentCreateModal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="departmentCreateModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title uppercase"> <i class="fa fa-plus" aria-hidden="true"></i> Create New Department</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('departments.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="school">Name of Department</label>
                        <input type="text" name="department" id="school" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="school_code">Department Code </label>
                        <input type="text" name="department_code" id="" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="">School</label>
                      <select class="form-control" name="school" id="">
                          <option value="" selected="true" disabled="true">Select School</option>
                        @foreach ($schools as $school)
                            <option value="{{$school->id}}">{{$school->school}} - {{$school->school_code}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-admin"> <i class="fa fa-check" aria-hidden="true"></i> Save</button>
                    </div>
                </form>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div> --}}
        </div>
    </div>
</div>

{{-- Delete Modal --}}
<div class="modal fade" id="departmentDeleteModal" tabindex="-1" role="dialog" aria-labelledby="departmentDeleteModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="deleteDepartment" method="POST">
                @csrf
                {{ method_field('DELETE') }}
                <div class="modal-body">
                    <h4 class="text-center">Are you sure you want to Delete?</h4>
                    <h1 class="text-center mt-3 text-6xl">
                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    </h1>
                    <input type="hidden" class="form-control" id="deleteDepartmentId">
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

        var route = '{{route('departments.destroy', ':id')}}';
        route = route.replace(':id', {{$department->id}});
        $('.table').on('click', '#delete', function(data){
            $department_id = $(this).data('department_id');
            // console.log($school_id);
            $('#deleteDepartmentId').val($department_id);
            var attr = $('#deleteDepartment').attr('action', route);
        }); 
    });
</script>
    
@endpush