<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectTopicsController extends Controller
{
    public function index() {
        return view('layouts.user.project_topics.index');
    }

    public function showProject() {
        return view('layouts.user.project_topics.show');
    }
}
