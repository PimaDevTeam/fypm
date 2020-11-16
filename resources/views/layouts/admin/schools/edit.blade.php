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
                <form action="{{route('schools.update', $school->id)}}" method="POST">
                    {{-- @method('POST') --}}
                    {{ method_field('PUT') }}
                    @csrf
                    <div class="form-group">
                        <label for="school">Name of School</label>
                        <input type="text" name="school" id="school" class="form-control" value="{{$school->school}}">
                    </div>
                    <div class="form-group">
                        <label for="school_code">School Code </label>
                        <input type="text" name="school_code" id="school_code" class="form-control" value="{{$school->school_code}}">
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