
@foreach ($comments as $comment)
    @php
        $posted_by = App\User::where('id', $comment->user_id)->first();
    @endphp
    <div class="flex py-2 px-2">
        <div>
            <img src="{{asset('/storage/images/'.$posted_by->image)}}" onerror="this.onerror=null;this.src='/images/avatar.png';" class="rounded-full"  width="40" alt="" style="height: 40px!important">
        </div>
        <div class="ml-2 w-100">
            <div class="flex justify-between comment-header">
                <h6 class="mb-0 text-blue-800">
                    {{$posted_by->last_name}} {{$posted_by->first_name}}
                    - <small>{{ \Carbon\Carbon::parse($comment->created_at)->diffForhumans() }}</small> 
                </h6>
                @if ($comment->user_id == auth()->user()->id)
                    <div data-toggle="tooltip" data-placement="top" title="Edit reply">
                        <a href="#" id="editModal" class="text-blue-800" data-toggle="modal" data-target="#editComment" data-comment="{{$comment->comment}}" data-id="{{$comment->id}}">
                            <i class="fas fa-pen-alt text-blue-800"></i>
                        </a>
                    </div>
                @endif
            </div>
            <!-- Modal -->
            <div class="modal fade" id="editComment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title text-blue-800" id="exampleModalLabel">Editing Exiting Comment</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST" id="editForm">
                                @csrf
                                <div class="form-group">
                                    <textarea name="comment" id="comment" class="form-control" cols="30" rows="3"></textarea>
                                    <input type="hidden" name="id" id="comment_id">
                                </div>
                                <button type="submit" class="btn btn-outline-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <p class="mt-2 mb-1">
                {{$comment->comment}}
            </p>
            @if ($comment->file != '')
                <div class="flex mt-3 mb-2 p-2 rounded" style="border: 1px solid #abaeba;">
                    <div>
                        <img src="/images/microsoft-word-logo.svg" width="20" alt="">
                    </div>
                    <div class="ml-4 w-100">
                        <a href="{{route('comments.download.file', $comment->file)}}" class="mb-0 d-block hover:text-decoration" style="font-size: .8rem;">
                            {{$comment->file_name}}
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <hr class="mb-1 mt-0">
@endforeach
<form action="{{route('comments.save')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group mt-4">
        <label for="comment">Add a comment</label>
        {{-- <input type="text" name="comment" id="comment" class="form-control" placeholder="Add a comment"> --}}
        <textarea name="comment" id="comment" cols="30" rows="2" class="form-control @error('comment') is-invalid @enderror"></textarea>
        @error('comment') 
            <div id="comment" class="invalid-feedback d-block">
                {{$message}}
            </div>
        @enderror
        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
        <input type="hidden" name="project_id" value="{{$comment->project_id}}">
    </div>
    <div>
        <div class="flex justify-between py-2 px-2 rounded d-none" id="fileContainer" style="border: 1px solid #abaeba;">
            <div class="flex">
                <div class="extImgContainer"></div>
                <div class="ml-4 w-100">
                    <span class="docName">Doc.name</span>
                </div>
            </div>
            <div class="mt-1" id="remove" data-toggle="tooltip" data-placement="top" title="Remove file">
                <span>
                    <i class="fa fa-times" aria-hidden="true"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="flex justify-between mt-3">
        <div class="box" data-toggle="tooltip" data-placement="top" title="Attach file">
            <input type="file" name="file" id="file" class="projectFile inputfile-3" data-multiple-caption="{count} files selected" multiple="" aria-describedby="file">
            <label class="flex justify-center transition-all duration-200 ease-in-out" for="file"> <i class="fas fa-paperclip"></i> </label>
        </div>
        <button type="submit" class="btn btn-outline-primary" id="btn-comment">Add Comment</button>
    </div>
</form>