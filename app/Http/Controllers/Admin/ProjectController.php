<?php

namespace App\Http\Controllers\Admin;

use App\Program;
use App\Project;
use App\User;
use App\UserProject;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;



class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programs = Program::all();
        
        return view('layouts.admin.project.index', compact('programs'));
    }

    public function topics($id) {
        $projects = DB::table('projects')
        ->where('project_status_id', 1)
        ->where('project_program_id', $id)
        ->get();
        foreach($projects as $project) {
            $program = Program::where('id', $project->project_program_id)->get();
            $proposed = DB::table('users')
                            ->where('id', $project->proposed_by)->get();
            $description = Str::limit($project->project_description, 50, '...');
            // dd($projects);
        }
        return view('layouts.admin.project.topics', compact('projects', 'program', 'proposed', 'description'));
    }

    public function topicsToApprove($id) {
        $projects = DB::table('projects')
        ->where('project_status_id', 2)
        ->where('project_program_id', $id)
        ->get();
        foreach($projects as $project) {
            $program = Program::where('id', $project->project_program_id)->get();
            $proposed = DB::table('users')
                            ->where('id', $project->proposed_by)->get();
            $description = Str::limit($project->project_description, 50, '...');
            // dd($projects);
        }
        return view('layouts.admin.project.approve', compact('projects', 'program', 'proposed', 'description'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programs = Program::all();
        return view('layouts.admin.project.create', compact('programs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project)
    {
        $data = $request->all();

        $validatedData = Validator::make($request->all(), [
            'topic' => 'required|string',
            'proposed_by' => 'required|integer',
            'program_id' => 'required|integer',
            'project_description' => 'required|string',
            'project_status' => 'required|integer'
        ]);

        if(Auth::user()->roles[0]->id == 1) {
            $request->project_status = 1;
        } else {
            $request->project_status = 2;
        }

        $project->name = $request->topic;
        $project->proposed_by = $request->proposed_by;
        $project->project_program_id = $request->program_id;
        $project->project_description = $request->project_description;
        $project->project_status_id = $request->project_status;
        $project->save();

        return redirect()->back()->with('success', 'Project Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        // dd($projects);
        $programs = Program::all();
        return view('layouts.admin.project.edit', compact('project', 'programs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validatedData = Validator::make($request->all(), [
            'topic' => 'required|string',
            'proposed_by' => 'required|integer',
            'program_id' => 'required|integer',
            'project_description' => 'required|string',
            'project_status' => 'required|integer'
        ]);

        if(Auth::user()->roles[0]->id == 1) {
            $request->project_status = 1;
        } else {
            $request->project_status = 2;
        }

        $project = Project::find($id);
        $project->name = $request->topic;
        $project->proposed_by = $request->proposed_by;
        $project->project_program_id = $request->program_id;
        $project->project_description = $request->project_description;
        $project->project_status_id = $request->project_status;
        $project->save();

        return redirect()->back()->with('success', 'Project Created Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function unapprove(Request $request) {
        // dd($request->all());
        $id = $request->id;
        $project = Project::find($id);
        $project->project_status_id = 2;
        $project->save();
        return redirect()->back()->with('success', 'Project has been unapproved');
    }

    public function approve(Request $request) {
        // dd($request->all());
        $id = $request->id;
        $project = Project::find($id);
        $project->project_status_id = 1;
        $project->save();
        return redirect()->back()->with('success', 'Project has been approved');
    }

    //Assign Topics
    public function assignIndex() {
        $programs = Program::all();
        return view('layouts.admin.project.assign', compact('programs'));
    }

    public function getProgramIdAttribute()
    {
        return $this->program_id;
    }

    public function assignTopics($id) {
        $program = DB::table('users')
                        ->where('program_id', $id)
                        ->where('matric_number', '!=', '')
                        ->select('id', 'program_id')
                        ->get();
        // $program = DB::table('programs')
        //             ->where('id', $id)
        //             ->get();
        $studentId = $program[0]->id;
        $programId = $program[0]->program_id;


        $Userprojects = DB::table('user_projects')
                        ->where('student_id', $studentId)
                        ->where('project_id', NULL)
                        ->get();
        
        $projects = DB::table('projects')
                    ->where('project_program_id', $programId)
                    ->where('project_status_id', 1)
                    ->get();
                        
        // dd($projects);
        $studentProgram = DB::table('programs')
                            ->where('id', $program[0]->program_id)
                            ->get();
        // dd($studentProgram);


        return view('layouts.admin.project.assignTopics', compact('Userprojects', 'studentProgram', 'projects'));
    }

    public function assignTopicToStudent(Request $request, $id) {
        $project = DB::table('user_projects')
                    ->where('student_id', $id)
                    ->pluck('id');
                    
        $userProject = UserProject::find($id);
        $userProject->project_id = $request->project_id;
        $userProject->save();
        return redirect()->back()->with('success', 'Project topic has been assigned');

        // dd($userProject);
    }

    public function showStudentsAssignedTopic($id) {
        // $programId = auth()->user()->program_id;
        // $studentId = auth()->user()->id;
        $program = DB::table('users')
                ->where('program_id', $id)
                ->where('matric_number', '!=', '')
                ->select('id', 'program_id')
                ->get();


        $studentId = $program[0]->id;
        // $programId = $program[0]->program_id;


        $Userprojects = DB::table('user_projects')
                ->where('student_id', $studentId)
                ->where('project_id', '!=', NULL)
                ->get();

        // dd($Userprojects);  
                
        // dd($projects);
        $studentProgram = DB::table('programs')
                    ->where('id', $id)
                    ->get();
        // dd($studentProgram);

        foreach ($Userprojects as $project) {
            $student = DB::table('users')
                        ->where('id', $project->student_id)
                        ->select('first_name', 'last_name')
                        ->get();
            $supervisor = DB::table('users')
                        ->where('id', $project->supervisor_id)
                        ->select('first_name', 'last_name')
                        ->get();
            $session = DB::table('sessions')
                        ->where('id', $project->session_id)
                        ->get();
            
            $projectTopic = DB::table('projects')
                        ->where('id', $project->project_id)
                        ->where('project_status_id', 1)
                        ->get();
        }
        return view('layouts.admin.project.show', compact('Userprojects', 'projects', 'projectTopic', 'studentProgram', 'student', 'supervisor', 'session'));
    }
}
