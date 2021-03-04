<?php

namespace App\Http\Controllers;

use App\GroupMember;
use App\UserProject;
use App\User;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index() {

        $user_id = Auth::user()->id;
        $group_member = DB::table('group_members')
                            ->where('student_id', $user_id)
                            ->get();
                            // dd($group_member[0]->group_id);
        if(count($group_member) > 0) {
            $group_project = DB::table('group_projects')
                                ->where('group_id', $group_member[0]->group_id)
                                ->get();
            $project = DB::table('projects')
                            ->where('id', $group_project[0]->project_id)
                            ->first();
            // dd($project);
        } else {
            $project = DB::table('user_projects')
                            ->where('student_id', $user_id)
                            ->where('project_id', '!=', NULL)
                            ->join('projects', function($join) {
                                $join->on('projects.id', '=', 'user_projects.project_id');
                            })
                            ->first();
        }
        return view('layouts.user.projects.index', compact('project'));
    }

    public function upload() {
        return view('layouts.user.projects.upload');
    }

    public function projectMembers() {
        $user_id = Auth::user()->id;
        $group_member = GroupMember::where('student_id', $user_id)
                                    ->select('student_id', 'group_id', 'program_id')
                                    ->get();
        $user_project = UserProject::where('student_id', Auth::user()->id)
                    ->select('supervisor_id')
                    ->get();
        if(count($group_member) > 0) {
            $supervisor = DB::table('group_supervisors')
                    ->where('group_id', $group_member[0]->group_id)
                    ->join('users', function ($join) {
                        $join->on('users.id', '=', 'group_supervisors.supervisor_id');
                    })
                    ->get();
            $members = DB::table('group_members')
                    ->where('group_id', $group_member[0]->group_id)
                    ->join('users', function($join) {
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

    public function projectMemberStudent($id) {
        $student = User::where('id', $id)
                        ->select('first_name', 'last_name', 'about', 'image')
                        ->get();
        return view('layouts.user.projects.show-member', compact('student'));
    } 
} 
