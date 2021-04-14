<?php

namespace App\Http\Controllers;

use App\GroupMember;
use App\Project;
use App\ProjectFile;
use App\UserProject;
use App\User;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {

        $user_id = Auth::user()->id;
        $group_member = DB::table('group_members')
            ->where('student_id', $user_id)
            ->get();
        // dd($group_member[0]->group_id);
        if (count($group_member) > 0) {
            $group_project = DB::table('group_projects')
                ->where('group_id', $group_member[0]->group_id)
                ->get();
            if (count($group_project) > 0) {
                $project = DB::table('projects')
                    ->where('id', $group_project[0]->project_id)
                    ->first();
                $project_files = DB::table('project_files')
                    ->where('project_id', $project->id)
                    ->get();
                $comments = DB::table('comments')
                    ->where('project_id', $project->id)
                    ->get();
            } else {
                $project = [];
                $project_files = [];
                $comments = [];
            }
            // dd($project);
        } else {
            $project = DB::table('user_projects')
                ->where('student_id', $user_id)
                ->where('project_id', '!=', NULL)
                ->join('projects', function ($join) {
                    $join->on('projects.id', '=', 'user_projects.project_id');
                })
                ->first();
            if ($project > 0) {
                $project_files = DB::table('project_files')
                    ->where('project_id', $project->id)
                    ->get();
                $comments = DB::table('comments')
                    ->where('project_id', $project->id)
                    ->get();
            } else {
                $project_files = [];
                $project = '';
                $comments = [];
            }
        }
        return view('layouts.user.projects.index', compact('project', 'project_files', 'comments'));
    }

    public function upload()
    {
        return view('layouts.user.projects.upload');
    }

    public function projectFile(Request $request, ProjectFile $project_file)
    {
        $student_id = Auth::user()->id;
        // selecting projects assigned to student
        $project_student = UserProject::where('student_id', $student_id)->get();
        if (count($project_student) > 0) {
            $project = Project::where('id', $project_student[0]->project_id)->first();
        } else {
            // Selecting project assigned to group
            $project_group = GroupMember::where('student_id', $student_id)
                ->join('group_projects', function ($join) {
                    $join->on('group_projects.group_id', '=', 'group_members.group_id');
                })->get();
            $project = Project::where('id', $project_group[0]->project_id)->first();
        }

        $validate = $request->validate([
            'description' => 'required|string',
            'file' => 'required|mimes:docx'
        ]);

        if ($request->hasFile('file')) {
            $project_doc = $request->file;
            $filename = $project_doc->getClientOriginalName();
            $filename = $project->topic . '_' . time() . '_' . $filename;
            // dd($filename);

            $path = $project_doc->storeAs('public/files', $filename);
            // $project->project_file = $filename;
        }
        // dd($project->id);
        // $project->save();
        $project_file->description = $request->description;
        $project_file->project_id = $project->id;
        $project_file->project_file = $filename;
        $project_file->student_id = $student_id;
        $project_file->save();
        return redirect()->back()->with('student-success', 'Project Uploaded Successfully');

        // $data = $request->all();
        // dd($project);
    }

    public function projectMembers()
    {
        $user_id = Auth::user()->id;
        $group_member = GroupMember::where('student_id', $user_id)
            ->select('student_id', 'group_id', 'program_id')
            ->get();
        $user_project = UserProject::where('student_id', Auth::user()->id)
            ->select('supervisor_id')
            ->get();
        if (count($group_member) > 0) {
            $supervisor = DB::table('group_supervisors')
                ->where('group_id', $group_member[0]->group_id)
                ->join('users', function ($join) {
                    $join->on('users.id', '=', 'group_supervisors.supervisor_id');
                })
                ->get();
            $members = DB::table('group_members')
                ->where('group_id', $group_member[0]->group_id)
                ->join('users', function ($join) {
                    $join->on('users.id', '=', 'group_members.student_id')
                        ->select('first_name', 'last_name');
                })
                ->get();
        } else {
            $supervisor = DB::table('user_projects')
                ->where('student_id', $user_id)
                ->join('users', function ($join) {
                    $join->on('users.id', '=', 'user_projects.supervisor_id');
                })
                ->get();
            $members = DB::table('user_projects')
                ->where('student_id', $user_id)
                ->join('users', function ($join) {
                    $join->on('users.id', '=', 'user_projects.student_id');
                })
                ->get();
        }
        // dd($members);

        return view('layouts.user.projects.members', compact('members', 'supervisor'));
    }

    public function projectMemberStudent($id)
    {
        $student = User::where('id', $id)
            ->select('first_name', 'last_name', 'about', 'image')
            ->get();
        return view('layouts.user.projects.show-member', compact('student'));
    }

    public function fileDownload($id)
    {

        $project = ProjectFile::find($id);
        $file = public_path() . "/storage/files/" . $project->project_file;
        $headers = array(
            'Content-Type: application/docx',
        );
        return response()->download($file, $project->description, $headers);
    }
}
