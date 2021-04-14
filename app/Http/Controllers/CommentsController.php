<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CommentsController extends Controller
{
    public function comments()
    {
        $user_id = Auth::user()->id;
        $project = DB::table('group_supervisors')
            ->where('supervisor_id', $user_id)
            ->join('group_projects', function ($join) {
                $join->on('group_projects.group_id', 'group_supervisors.group_id');
            })
            ->get();
        if (count($project) > 0) {
            return DB::table('comments')
                ->where('project_id', $project[0]->project_id)
                ->join('users', function ($join) {
                    $join->on('users.id', 'comments.user_id');
                })->get();
        } else {
            return [];
        }
    }
    public function save(Request $request, Comment $comment)
    {
        $request->validate([
            'comment' => 'required|string'
        ]);
        if ($request->hasFile('file')) {
            $comment_file = $request->file;
            $filename = $comment_file->getClientOriginalName();
            $filename = time() . '_' . $filename;
            // dd($filename);

            $path = $comment_file->storeAs('public/files', $filename);
            $comment->file = $filename;
            $comment->file_name = $comment_file;

            // $project->project_file = $filename;
        }
        $comment->user_id = $request->user_id;
        $comment->project_id = $request->project_id;
        $comment->comment = $request->comment;
        $comment->save();
        // return $comment;
        return redirect()->back()->with('student-success', 'Comment Posted');
    }

    public function edit(Request $request, $id)
    {
        $comment = Comment::find($id);
        $request->validate([
            'comment' => 'string'
        ]);

        if ($request->comment == '') {
            $comment->comment = $comment->comment;
        } else {
            $comment->comment = $request->comment;
        }
        $comment->save();
        return redirect()->back()->with('student-success', 'Comment Updated');
    }

    public function commentFileDownload($file)
    {
        $comment = Comment::where('file', $file)->first();
        $file = public_path() . "/storage/files/" . $comment->file;
        $headers = array(
            'Content-Type: application/docx',
        );
        return response()->download($file, $comment->file_name, $headers);
    }
}
