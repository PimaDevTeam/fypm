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
        background-color: #cfd4dae0;
        display: flex;
        border-radius: 5px;
        padding: .4rem;
        width: 100%;
        text-align: center;
    }

    .inputfile:focus + label,
    .inputfile + label:hover {
        background-color:#c2c6ca;
    }
    .inputfile + label {
        cursor: pointer; /* "hand" cursor */
    }
    .project__upload {
        border: 1px dashed grey;
    }
    .invalid {
        border-color: #e3342f!important;
    }
</style>

@extends('layouts.user.app')

@section('content') 
    @include('messages')
    <div class="row mt-4">
        @include('layouts.user.left_sidebar')
        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
            <div class="main__container bg-white rounded shadow px-2 py-2">
                <h6 class="text-blue-900 font-semibold">UPLOAD PROJECT</h6>
                <hr class="mt-1">
                <form action="{{route('student.project.file')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Describe this project</label>
                        <input type="text" class="form-control @error ('description') is-invalid @enderror" id="description" name="description" placeholder="Chapter 1 (Introduction)" aria-describedby="description">
                        @error('description') 
                            <div id="description" class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="project__upload px-2 py-2 rounded @error ('file') invalid @enderror">
                        <div class="form-group upload-btn-wrapper">
                            <div class="extension__container"></div>
                            <div class="">
                                {{-- <input type="file" name="file" id="file" class="inputfile" />
                                <label for="file">Choose a file</label> --}}
                                <div class="box">
                                    <input type="file" name="file" id="file" class="inputfile inputfile-3" data-multiple-caption="{count} files selected" multiple="" aria-describedby="file">
                                    <label class="flex justify-center transition-all duration-200 ease-in-out" for="file"> <i class="fas fa-file fupload mr-2 mt-1"></i> <i class="fas fa-file-alt fdoc mr-2 mt-1 d-none"></i> <span>Select a file</span></label>
                                </div>
                            </div>
                        </div>
                        <p class="text-center text-gray-600">Upload your project file here</p>
                    </div>
                    <div id="file" class="invalid-feedback file-type">
                            File type must be docx
                    </div>
                    @error('file') 
                        <div id="file" class="invalid-feedback d-block">
                            {{$message}}
                        </div>
                    @enderror
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-c mt-2" id="btn-upload"> <i class="fa fa-check-circle mr-1"></i> Upload Document</button>
                    </div>
                </form>
            </div> 
        </div>
        @include('layouts.user.right_sidebar')
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('.toast').toast('show');

            $('#file').on('change', function() {
                $file = $(this).val();
                var ext = $file.split('.').pop();
                // console.log(ext);
                if(ext !== 'docx') {
                    $('.project__upload').addClass('invalid');
                    $('#btn-upload').attr('disabled', true);
                    $('.file-type').addClass('d-block')
                } else {
                    $('.project__upload').removeClass('invalid');
                    $('#btn-upload').attr('disabled', false);
                    $('.file-type').removeClass('d-block')
                }
                
            })
        });
    </script>
@endpush