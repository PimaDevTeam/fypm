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
                Edit School
            </div>
            {{-- @foreach ($school as $school) --}}
            <div class="card-body">
                <form action="{{route('departments.update', $department->id)}}" method="POST">
                    {{-- @method('POST') --}}
                    {{ method_field('PUT') }}
                    @csrf
                    <div class="form-group">
                        <label for="school">Name of Department</label>
                        <input type="text" name="department" id="school" class="form-control" value="{{$department->department}}">
                    </div>
                    <div class="form-group">
                        <label for="school_code">Department Code </label>
                        <input type="text" name="department_code" id="" class="form-control" value="{{$department->department_code}}">
                    </div>
                    @php
                        $selectedValue = $department->school_id
                    @endphp
                    <div class="form-group">
                      <label for="">School</label>
                      <select class="form-control" name="school" id="">
                        @foreach ($schools as $school)
                            <option value="{{$school->id}}" {{ $selectedValue == $school->id ? 'selected="selected"' : '' }} >{{$school->school}} - {{$school->school_code}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-admin"> <i class="fa fa-check" aria-hidden="true"></i> Save</button>
                    </div>
                </form>
            </div>
            {{-- @endforeach --}}

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