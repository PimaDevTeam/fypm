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
    color: #2b4364;
    background-color: transparent;
    display: flex;
    border-radius: 5px;
    padding: .4rem;
    width: 40%;
    text-align: center;
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
}

.inputfile:focus + label,
.inputfile + label:hover {
    background-color:transparent;
}
.inputfile + label {
	cursor: pointer; /* "hand" cursor */
}
</style>


@extends('layouts.user.app')

@section('content') 
    @include('messages')
    <div class="row mt-4">
        @include('layouts.user.left_sidebar')
        <div class="col-12 col-sm-12 col-md-9 col-lg-9">
            <div class="main__container bg-white rounded shadow px-2 py-2">
                <h6 class="text-blue-900 font-semibold uppercase">User Profile</h6>
                <hr class="mt-1">
                <div class="pj__header-container h-40 pf__bg-cover rounded"></div>
                <div class="project__details-container px-2 py-2">
                    <div class="flex rounded">
                        <div class="shadow pj_member" style="margin-top: -3rem; border-radius: 50%; width: 100px;">
                            <img src="{{asset('/storage/images/'.$user->image)}}" onerror="this.onerror=null;this.src='/images/avatar.png';" alt="avatar">
                        </div>
                        <div class="ml-3">
                            <h6 class="mb-0">
                                {{$user->last_name}} {{$user->first_name}}
                                <a href="#" data-toggle="modal" data-target="#uploadAvatar" >
                                    <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                                </a>
                            </h6> 
                            <span class="text-gray-500" style="font-size: .8rem">
                                @php
                                    $program = App\Program::where('id', $user->program_id)->first();
                                    echo($program->program);
                                @endphp
                            </span>
                        </div>
                        <div class="flex ml-auto">

                        </div>
                    </div>
                </div>
            </div> 
            <div class="container bg-white mt-4 rounded shadow pt-2">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="flex">
                            <h6 class="text-blue-900 font-semibold uppercase">About</h6>
                            <div class="ml-auto">
                                <a href="#" data-toggle="modal" data-target="#editAbout" >
                                    <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <hr class="mt-1">
                        <p>
                            {{$user->about}}
                        </p>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <h6 class="text-blue-900 font-semibold uppercase">Details</h6>
                        <hr class="mt-1">
                        <ul>
                            <li>
                                <i class="fa fa-phone mr-2" aria-hidden="true"></i> {{$user->phone_number}}
                            </li>
                            <li>
                                <i class="fa fa-envelope mr-2" aria-hidden="true"></i> {{$user->email}}
                            </li>
                        </ul>
                    </div>
                </div>
            </div> 
        </div>
        {{-- @include('layouts.user.right_sidebar') --}}
    </div>
@endsection

<!-- About Modal -->
<div class="modal fade" id="editAbout" tabindex="-1" role="dialog" aria-labelledby="editAbout" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{route('user.profile.about')}}" id="editAboutForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                      <label for="about">About</label>
                      <textarea class="form-control  @error('about') is-invalid @enderror" id="aboutValidation" name="about" cols="1" rows="5" aria-describedby="helpId">
                          @if ($user->about !== NULL)
                              {{$user->about}}
                          @endif
                      </textarea>
                        @error('about') 
                            <div id="aboutValidation" class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                      <small id="helpId" class="text-muted">Small description about yourself</small>
                    </div>
                    <button type="submit" class="btn btn-primary btn-c"> <i class="fas fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Upload Modal -->
<div class="modal fade" id="uploadAvatar" tabindex="-1" role="dialog" aria-labelledby="uploadAvatar" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{route('user.profile.avatar')}}" id="editAboutForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="md__custom--container p-2 bg-gray-200 rounded">
                        <div class="form-group mb-0" id="preImage">
                        {{-- <input type="file" name="image" id="avatar" class="form-control" aria-describedby="helpId"> --}}
                        <img id="ig" src="{{asset('/storage/images/'.$user->image)}}" onerror="this.onerror=null;this.src='/images/avatar.png';" class="ml-auto mr-auto mb-2" alt="" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">
                            <div class="box">
                                <input type="file" name="image" id="file-3" class="inputfile inputfile-3" data-multiple-caption="{count} files selected" multiple="">
                                <label class="flex text-center ml-auto mr-auto transition-all duration-200 ease-in-out" for="file-3"> 
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                        width="20" height="20"
                                        viewBox="0 0 172 172"
                                        style=" fill:#000000; margin-top: .2rem; margin-left: 1.5rem;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g><path d="M139.75,143.78125h-107.5c-2.28438,0 -4.03125,-1.74687 -4.03125,-4.03125v-26.875c0,-2.28437 1.74687,-4.03125 4.03125,-4.03125c2.28437,0 4.03125,1.74688 4.03125,4.03125v22.84375h99.4375v-22.84375c0,-2.28437 1.74687,-4.03125 4.03125,-4.03125c2.28438,0 4.03125,1.74688 4.03125,4.03125v26.875c0,2.28438 -1.74687,4.03125 -4.03125,4.03125z" fill="#2a4365"></path><path d="M86,103.46875c-2.28437,0 -4.03125,-1.74688 -4.03125,-4.03125v-67.1875c0,-2.28438 1.74688,-4.03125 4.03125,-4.03125c2.28437,0 4.03125,1.74687 4.03125,4.03125v67.1875c0,2.28437 -1.74688,4.03125 -4.03125,4.03125z" fill="#444b54"></path><path d="M106.15625,56.4375c-1.075,0 -2.01562,-0.40312 -2.82187,-1.20938l-17.33438,-17.33438l-17.33437,17.33438c-1.6125,1.6125 -4.16563,1.6125 -5.64375,0c-1.6125,-1.6125 -1.6125,-4.16562 0,-5.64375l20.15625,-20.15625c1.6125,-1.6125 4.16563,-1.6125 5.64375,0l20.15625,20.15625c1.6125,1.6125 1.6125,4.16562 0,5.64375c-0.80625,0.80625 -1.74687,1.20938 -2.82187,1.20938z" fill="#444b54"></path></g></g></svg>
                                     Upload image
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center mt-2">
                        <button type="submit" class="btn btn-primary btn-c"> <i class="fas fa-save"></i> Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script')
    <script>
        $(document).ready(function() {
            $('.toast').toast('show');

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    
                    reader.onload = function(e) {
                        // $('#preImage').prepend(`<img id="blah" src="#" alt="" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">`)
                        $('#ig').attr('src', e.target.result);
                    }
                    
                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            $("#file-3").change(function() {
                readURL(this);
            });
        });

    </script>
@endpush