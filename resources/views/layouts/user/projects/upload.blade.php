<?php 
$user = Auth::user();
?>

<style>
.inputfile {
	width: 0.1px;
	height: 0.1px;
	opacity: 0;
	overflow: hidden;
	position: absolute;
	z-index: -1;
}
.inputfile + label {
    font-size: 1rem;
    font-weight: 400;
    color: white;
    background-color: #acb3ba;
    display: flex;
    border-radius: 5px;
    padding: .4rem;
    width: 100%;
    text-align: center;
}

.inputfile:focus + label,
.inputfile + label:hover {
    background-color:#6c757d;
}
.inputfile + label {
	cursor: pointer; /* "hand" cursor */
}
</style>

@extends('layouts.user.app')

@section('content') 
    <div class="row mt-4">
        @include('layouts.user.left_sidebar')
        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
            <div class="main__container bg-white rounded shadow px-2 py-2">
                <h6 class="text-blue-900 font-semibold">UPLOAD PROJECT</h6>
                <hr class="mt-1">
                <form action="">
                    <div class="project__upload px-2 py-2" style="border: 1px dashed grey;">
                        <div class="form-group upload-btn-wrapper">
                            <div class="extension__container"></div>
                            <div class="">
                                {{-- <input type="file" name="file" id="file" class="inputfile" />
                                <label for="file">Choose a file</label> --}}
                                <div class="box">
                                    <input type="file" name="file-3[]" id="file-3" class="inputfile inputfile-3" data-multiple-caption="{count} files selected" multiple="">
                                    <label class="flex justify-center transition-all duration-200 ease-in-out" for="file-3"> <i class="fas fa-upload fupload mr-2 mt-1"></i> <i class="fas fa-file-alt fdoc mr-2 mt-1 d-none"></i> <span>Select a file</span></label>
                                </div>
                            </div>
                        </div>
                        <p class="text-center text-gray-600">Upload your project file here</p>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary mt-2"> <i class="fas fa-paperclip mr-1"></i> Upload file</button>
                    </div>
                </form>
            </div> 
        </div>
        @include('layouts.user.right_sidebar')
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
        });
    </script>
@endpush