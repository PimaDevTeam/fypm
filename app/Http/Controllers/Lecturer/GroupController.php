<?php

namespace App\Http\Controllers\Lecturer;

use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class GroupController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $groups = DB::table('group_supervisors')
            ->where('supervisor_id', $user_id)
            ->join('programs', function ($join) {
                $join->on('programs.id', 'group_supervisors.program_id');
            })
            ->get();
        // dd($groups);
        return view('layouts.lecturer.groups.index', compact('groups'));
    }

    public function show($id)
    {
        // $user_id = Auth::user()->id;
        $group_members = DB::table('group_members')
            ->where('group_id', $id)
            ->join('users', function ($join) {
                $join->on('users.id', 'group_members.student_id');
            })
            ->select('student_id', 'first_name', 'last_name', 'image', 'email')
            ->get();
        $group_project = DB::table('group_projects')
            ->where('group_id', $id)
            ->join('projects', function ($join) {
                $join->on('projects.id', 'group_projects.project_id');
            })
            ->join('programs', function ($join) {
                $join->on('programs.id', 'group_projects.program_id');
            })
            ->get();
        if (count($group_project) > 0) {
            $project_files = DB::table('project_files')
                ->where('project_id', $group_project[0]->project_id)
                ->get();
            $comments = DB::table('comments')
                ->where('project_id', $group_project[0]->project_id)
                ->get();
            // ->join('users', function ($join) {
            //     $join->on('users.id', 'comments.user_id');
            // })
            // dd($comments);
        } else {
            $project_files = [];
            $comments = [];
        }
        // dd($project_files);
        return view('layouts.lecturer.groups.show', compact('group_members', 'group_project', 'project_files', 'comments'));
    }
}
