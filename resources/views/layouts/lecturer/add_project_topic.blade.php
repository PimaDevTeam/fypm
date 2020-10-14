<?php 
$user = Auth::user();
?>

@extends('layouts.user.app')

@section('content') 
    <div class="row mt-4">
        @include('layouts.user.left_sidebar')
        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
            <div class="main__container bg-white rounded shadow px-2 py-2">
                <h6 class="text-blue-900 font-semibold">UPLOAD PROJECT TOPIC</h6>
                <hr class="mt-1">
                <form action="">
                    <div class="form-group">
                        <label for="title">Project Title</label>
                        <input type="text" name="title" id="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <textarea name="description" class="editor form-control" id="" cols="30" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <select name="department" id="" class="custom-select">
                            <option value="">Computer Science (CS)</option>
                            <option value="">Computer Information System (CIS) </option>
                            <option value="">Computer Tech. (CT) </option>
                        </select>
                    </div>
                    <div class="form-group">
                        {{-- <input type="submit" value="Save" class="btn btn-primary"> --}}
                        <button type="submit" class="btn btn-primary"> <i class="fa fa-check" aria-hidden="true"></i> Save</button>
                    </div>
                </form>
            </div> 
        </div>
        @include('layouts.user.right_sidebar')
    </div>
@endsection

@push('script')
<script type="text/javascript">
    // $('textarea').ckeditor();
    CKEDITOR.replace( 'description' );
</script>
@endpush