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
                Edit Program
            </div>
            {{-- @foreach ($school as $school) --}}
            <div class="card-body">
                <form action="{{route('programs.update', $program->id)}}" method="POST">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="program">Name of Program</label>
                        <input type="text" name="program" id="program" class="form-control" value="{{$program->program}}">
                    </div>
                    <div class="form-group">
                        <label for="program_code">Program Code </label>
                        <input type="text" name="program_code" id="" class="form-control" value="{{$program->program_code}}">
                    </div>
                    @php
                        $selectedValue = $program->department_id
                    @endphp
                    <div class="form-group">
                      <label for="">School</label>
                      <select class="form-control" name="department" id="">
                          <option value="" selected="true" disabled="true">Select School</option>
                        @foreach ($departments as $department)
                            <option value="{{$department->id}}" {{ $selectedValue == $department->id ? 'selected="selected"' : ''  }}>{{$department->department}} - {{$department->department_code}}</option>
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