@if (count($project_files) > 0)
    @foreach ($project_files as $file)
        <div>
            <div class="flex py-2 px-2 rounded" style="border: 1px solid #abaeba;">
                <div>
                    <img src="/images/microsoft-word-logo.svg" width="30" alt="">
                </div>
                <div class="ml-4 w-100">
                    <div class="flex justify-between">
                        <small>{{$file->description}}</small>
                        {{-- <a href="#" class="comment">Comment</a> --}}
                    </div>
                    <a href="{{route('student.file.download', $file->id)}}" class="mb-0 d-block" style="font-size: .8rem;">{{$file->project_file}}</a>
                </div>
            </div>
        </div>
        <hr>
    @endforeach
@else
    <h6  class="text-center text-5xl text-teal-700">
        <i class="fa fa-folder" aria-hidden="true"></i>
    </h6>
    <h6 class="text-center font-normal uppercase">Project Folder is Empty</h6>
@endif