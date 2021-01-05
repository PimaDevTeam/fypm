<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\User;
use App\Program;
use App\Session;
use App\RoleUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\UserProject;
use Illuminate\Support\Facades\Validator;

class AssignSupervisor extends Controller
{
    public function index() {
        $programs = Program::all();
        $studentsRoleId = DB::table('role_user')->where('role_id', 4)->get();
        // dd(json_decode($studentsRoleId));
        // $students = DB::table('users')->where('id', $studentsRoleId['user_id']);
        // dd(json_decode($students));
        return view('layouts.admin.assign.index', compact('programs'));
    }

    public function assignCategory($name) {
        $program = Program::where('program', $name)->get();
        // dd($program);
        
        return view('layouts.admin.assign.assignUnsign', ['program' => $program]);
    }

    public function assign($id) {
        $roleStudent = Role::where('id', 4)->first();
        $students = $roleStudent->users()->where('program_id', $id)->get();

        $studentIdUserProject = UserProject::pluck('student_id')->all();
        $studentsUnassigned = $students->whereNotIn('id', $studentIdUserProject)->all();
        
        // dd($studentsUnassigned);
        $sessions = Session::all(); 
        
        // $userProject = UserProject::all();

        // dd(json_decode($userProject));

        $roleSupervisor = Role::where('id', 3)->first();
        $supervisors = $roleSupervisor->users()->where('program_id', $id)->get();

        return view('layouts.admin.assign.show', compact('studentsUnassigned', 'supervisors', 'sessions'));
    }

    public function unAssign($id) {
        $roleStudent = Role::where('id', 4)->first();
        $students = $roleStudent->users()->where('program_id', $id)->get();

        $studentIdUserProject = UserProject::pluck('student_id')->all();
        $studentsAssigned = $students->whereIn('id', $studentIdUserProject)->all();
        
        // dd($studentsAssigned);
        $sessions = Session::all(); 

        $roleSupervisor = Role::where('id', 3)->first();
        $supervisors = $roleSupervisor->users()->where('program_id', $id)->get();

        $supervisorIdUserProject = UserProject::pluck('supervisor_id')->all();
        $supervisorAssigned = $supervisors->whereIn('id', $supervisorIdUserProject);

        $sessionIdUserProject = UserProject::pluck('session_id')->all();
        $sessionId = $sessions->whereIn('id', $sessionIdUserProject);

        return view('layouts.admin.assign.showAssigned', compact('studentsAssigned','supervisorAssigned', 'sessionId'));
    }

    public function assignSupervisor(Request $request, UserProject $userProject) {
        $validatedData = Validator::make($request->all(), [
            'student_id' => 'required|integer',
            'supervisor_id' => 'required|integer',
            'session_id' => 'required|integer'
        ]);

        if($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        $userProject->student_id = $request->student_id;
        $userProject->supervisor_id = $request->supervisor_id;
        $userProject->session_id = $request->session_id;
        $userProject->save();

        return redirect()->back()->with('success', 'Supervisor Successfully Assigned');


    }

    public function unassignSupervisor($id) {
        $studentAssigned = UserProject::where('student_id', $id)->first();
        // dd($studentAssigned);
        $studentAssigned->delete();

        return redirect(route('assign.unassign'))->with('success', 'Student has been unassigned');
    }
}
