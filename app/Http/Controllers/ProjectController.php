<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index() {
        return view('layouts.user.projects.index');
    }

    public function upload() {
        return view('layouts.user.projects.upload');
    }

    public function projectMembers() {
        return view('layouts.user.projects.members');
    }

    public function projectMemberStudent() {
        return view('layouts.user.projects.show-member');
    } 
}
