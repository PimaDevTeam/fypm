<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectResourcesController extends Controller
{
    public function index() {
        return view('layouts.user.project_resources.index');
    }

    public function showResources() {
        return view('layouts.user.project_resources.show');
    }
}
