<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\RoleUser;
use App\User;

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

    public function assign($id) {
        $roleStudent = Role::where('id', 4)->first();
        $students = $roleStudent->users()->where('program_id', $id)->get();

        $supervisor = User::with('roles')->get();
        $roleSupervisor = Role::where('id', 3)->first();
        $supervisors = $roleSupervisor->users()->where('program_id', $id)->get();


        
        return view('layouts.admin.assign.show', compact('students', 'supervisors'));
    }
}
