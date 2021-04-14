<?php

namespace App\Http\Controllers\Admin;

use App\Department;
use App\Http\Controllers\Controller;
use App\Program;
use App\Project;
use App\RoleUser;
use App\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $students = DB::table('role_user')
            ->where('role_id', 4)->count();
        $supervisors = DB::table('role_user')
            ->where('role_id', 3)->count();
        $programs = Program::count();
        $departments = Department::count();
        $schools = School::count();

        $projects = DB::table('projects')
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'projects.proposed_by')
                    ->select('first_name', 'last_name');
            })
            ->join('programs', function ($join) {
                $join->on('programs.id', '=', 'projects.project_program_id');
            })
            ->get();
        return view('admin_dashboard.index', compact('supervisors', 'programs', 'departments', 'schools', 'students', 'projects'));
    }
}
