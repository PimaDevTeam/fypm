<?php

namespace App\Http\Controllers;

use App\Project;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;



class ProjectTopicsController extends Controller
{
    public function index()
    {
        $user_program_id = Auth::user()->program_id;
        $projects = DB::table('projects')
            ->where('project_program_id', $user_program_id)
            ->where('project_status_id', [1])
            ->join('users', function ($join) {
                $join->on('users.id', 'projects.proposed_by');
            })
            ->get();
        // dd($projects);
        return view('layouts.user.project_topics.index', compact('projects'));
    }

    public function showProject($show)
    {
        $user_id = Auth::user()->id;
        $group_member = DB::table('group_members')
            ->where('student_id', $user_id)
            ->get();
        if (count($group_member) > 0) {
            $group_project = DB::table('group_projects')
                ->where('group_id', $group_member[0]->group_id)
                ->get();
            if (count($group_project) > 0) {
                $assigned = true;
            } else {
                $assigned = false;
            }
        } else {
            $user_project = DB::table('user_projects')
                ->where('student_id', $user_id)
                ->where('project_id', '!=', NULL)
                ->first();
            if ($user_project > 0) {
                $assigned = true;
            } else {
                $assigned = false;
            }
        }
        // grayce.fisher@hotmail.com
        //  ggoldner@kihn.org
        $project = Project::where('topic', $show)->first();

        return view('layouts.user.project_topics.show', compact('project', 'assigned'));
    }

    public function submitProjectTopic()
    {
        $userId = Auth::user()->id;
        $project = Project::where('proposed_by', $userId)
            ->select('id', 'topic', 'project_description', 'project_status_id', 'proposed_by')
            ->get();
        if (count($project) < 0) {
            $project = DB::table('group_members')
                ->where('student_id', $userId)
                ->join('group_projects', function ($join) {
                    $join->on('group_projects.group_id', '=', 'group_members.group_id');
                })
                ->get();
        }
        return view('layouts.user.projects.submit-project-topic', compact('project'));
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

        $project->topic = $request->topic;
        $project->project_description = $request->description;
        $project->proposed_by = $request->proposed_by;
        $project->project_program_id = $request->program_id;
        $project->project_status_id = 2;
        $project->save();
        return redirect()->back()->with('student-success', 'Project Topic Submitted Successfully');
    }
}
