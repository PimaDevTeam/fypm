<?php

namespace App\Http\Controllers\Lecturer;

use App\User;
use App\Department;
use App\Project;


use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\ProjectReason;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class ProjectController extends Controller
{
    public function index()
    {
        $program_id = Auth::user()->program_id;
        $programs = DB::table('programs')
            ->select('id', 'program', 'department_id')
            ->get();
        // dd($programs);
        $projects = DB::table('projects')
            ->where('proposed_by', Auth::user()->id)
            ->paginate(5);
        return view('layouts.lecturer.add_project_topic', compact('programs', 'projects'));
    }

    public function projectTopic(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'topic' => ['required', 'string', Rule::unique('projects')->where(function ($query) use ($request) {
                return $query->where('project_program_id', $request->program_id);
            })],
            'description' => 'required|string',
            'proposed_by' => 'required|integer',
            'program_id' => 'required|integer'
        ]);
        // dd($validatedData);
        $project->topic = $request->topic;
        $project->project_description = $request->description;
        $project->proposed_by = $request->proposed_by;
        $project->project_program_id = $request->program_id;
        $project->project_status_id = 1;
        $project->save();
        return redirect()->back()->with('student-success', 'Project Topic Saved Successfully');
    }

    public function approveTopics()
    {
        $user_id = Auth::user()->id;
        $projects = DB::table('user_projects')
            ->where('supervisor_id', $user_id)
            ->join('projects', function ($join) {
                $join->on('projects.proposed_by', '=', 'user_projects.student_id')
                    ->where('project_status_id', 2)
                    ->select('id', 'topic', 'proposed_by', 'project_description', 'project_program_id', 'project_status_id');
            })
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'user_projects.student_id');
            })
            ->join('programs', function ($join) {
                $join->on('programs.id', '=', 'users.program_id');
            })
            ->get();
        // dd($projects);
        return view('layouts.lecturer.approve_topics', compact('projects'));
    }

    public function approve(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'topic' => 'required|string',
            'student_id' => 'required|integer',
            'program_id' => 'required|integer'
        ]);
        $project = Project::where('topic', $request->topic)
            ->where('proposed_by', $request->student_id)
            ->where('project_program_id', $request->program_id)
            ->first();
        $project->project_status_id = 1;
        $project->update();
        return redirect()->back()->with('student-success', 'Project has been approved');
    }

    public function reject(Request $request, ProjectReason $reason)
    {
        // dd($request->all());
        $request->validate([
            'topic' => 'required|string',
            'program_id' => 'required|integer',
            'reason' => 'required|string'
        ]);
        $project = Project::where('topic', $request->topic)
            ->first();
        $user_id = Auth::user()->id;
        // dd($project->id);
        //Updating project status
        $project->project_status_id = 5;
        $project->update();

        $reason->supervisor_id = $user_id;
        $reason->reason = $request->reason;
        $reason->project_id = $project->id;
        $reason->program_id = $request->program_id;
        $reason->save();
        return redirect()->back()->with('student-success', 'Project has rejected successfully');
    }
}
