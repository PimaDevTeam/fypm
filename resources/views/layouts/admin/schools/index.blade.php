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
                    <button class="btn btn-admin btn-sm" data-toggle="modal" data-target="#schoolCreateModal">
                        <i class="fa fa-plus mr-2" aria-hidden="true"></i>
                        Create New School
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead class="thead-custom">
                    <tr>
                        <th>School</th>
                        <th>School Code</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($schools as $school)
                            <tr>
                                <td>{{ $school->school }}</td>
                                <td>{{ $school->school_code }}</td>
                                <td>
                                    <div class="btn-group">
                                        {{-- Edit --}}
                                        <a href="{{route('schools.edit', $school->school_code)}}" class="btn btn-admin btn-sm edit"><i class="fas fa-edit"></i> Edit</a> 
                                        {{-- Delete --}}
                                        <button type="button" class="btn btn-danger btn-sm" id="delete" data-toggle="modal" data-target="#schoolDeleteModal" data-school_id="{{$school->id}}"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-muted">
                {{ $schools->links() }}
            </div>
        </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
@endsection

<!-- Modal -->
<div class="modal fade" id="schoolCreateModal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="schoolCreateModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title uppercase"> <i class="fa fa-plus" aria-hidden="true"></i> Create New School</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('schools.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="school">Name of School</label>
                        <input type="text" name="school" id="school" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="school_code">School Code </label>
                        <input type="text" name="school_code" id="school_code" class="form-control">
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
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div> --}}
            </form>
        </div>
    </div>
</div>

@push('scripts')

<script>
    fetch('https://api.totle.com/tokens')
        .then(response => response.json())
        // .then(data => console.log(data));


    $(document).ready(function() {
        $('.toast').toast('show');

        var deleteBtn = $('.deleteBtn')

        var route = '{{route('schools.destroy', ':id')}}';
        route = route.replace(':id', {{$school->id}});
        $('.table').on('click', '#delete', function(data){
            $school_id = $(this).data('school_id');
            // console.log($school_id);
            $('#deleteSchoolId').val($school_id);
            var attr = $('#deleteSchool').attr('action', route);
        });
    });
</script>
    
@endpush