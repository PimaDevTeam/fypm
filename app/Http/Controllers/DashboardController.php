<?php

namespace App\Http\Controllers;

use App\GroupMember;
use App\GroupSupervisor;
use App\UserProject;
use App\Project;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        // $user_id = Auth::user()->id;
        // $group_member = GroupMember::where('student_id', $user_id)
        //                             ->select('student_id', 'group_id', 'program_id')
        //                             ->get();
        // $user_project = UserProject::where('student_id', $user_id)
        //                             ->select('supervisor_id')
        //                             ->get();

        // if(count($group_member) > 0) {
        //     $supervisor = DB::table('group_supervisors')
        //         ->where('group_id', $group_member[0]->group_id)
        //         ->join('users', function ($join) {
        //             $join->on('users.id', '=', 'group_supervisors.supervisor_id');
        //         })
        //         ->get();
        // } else {
        //     $supervisor = DB::table('user_projects')
        //         ->where('student_id', $user_id)
        //         ->join('users', function ($join) {
        //             $join->on('users.id', '=', 'user_projects.supervisor_id');
        //         })
        //         ->get();
        // }
        // $fullname = $supervisor[0]->first_name. ' '. $supervisor[0]->last_name;

        return view('user_dashboard.index');
    }
}
