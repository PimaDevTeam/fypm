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
                <h6 class="text-blue-900 font-semibold uppercase">Find Project Topics</h6>
                <hr class="mt-1">
                <div class="pj__header-container fd__projects--bg h-40 rounded"></div>
                <div class="project__details-container px-2 py-2">
                    <div class="flex rounded">
                        <div class="h-20 w-20 bg-blue-800 rounded shadow text-center text-white" style="margin-top: -3rem">
                            <span class="text-5xl">
                                <i class="fas fa-book mt-3"></i>
                            </span>
                        </div>
                        <div class="ml-3">
                            <span class="text-gray-500" style="font-size: .8rem">  </span>
                        </div>
                        <div class="flex ml-auto">
                            <div class="justify-end flex project__posted-by">
                                @php
                                    $program_id = Auth::user()->program_id;
                                    $program = App\Program::where('id', $program_id)->first();
                                    // dd($projects);
                                @endphp
                                <span class="text-gray-500">All available project topics for <span>{{$program->program}}</span> </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2 px-2 py-2">
                <h6 class="text-blue-900 font-semibold uppercase">Project Topics That are available for selection</h6>
                <hr class="mt-1">
                    <p class="">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Voluptates maiores eum rem quam laudantium commodi libero, alias quisquam, enim provident 
                        corrupti accusantium cumque similique sed voluptatem ea consequatur quod laboriosam!
                    </p>
                </div>
            </div> 
            @foreach ($projects as $project)
                <div class="main__container bg-white mt-4 rounded shadow-sm px-2 py-2">
                    <div class="flex">
                        <div class="bg-blue-800 rounded shadow mr-2" style="width: 10px;"></div>
                        <div class="project__topics-descriptions w-100">
                            <div class="flex justify-content-between w-100">
                                <h6 class="text-blue-900 font-semibold uppercase">
                                    <a href="{{ route('project.topics.show', $project->topic) }}">
                                        {{$project->topic}}
                                    </a>
                                </h6>
                                <small class="text-green-600 font-bold">Available</small>
                            </div>
                            <small class="text-gray-500">{{$project->last_name}} {{$project->last_name}} </small>
                            <p class="mt-2 text-gray-600" style="font-size: .8rem">
                                @php
                                    $description = Str::limit(strip_tags($project->project_description), 150, '...')
                                @endphp
                                {{$description}}
                            </p>
                        </div>
                    </div>
                </div> 
            @endforeach
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