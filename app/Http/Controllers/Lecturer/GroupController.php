<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index() {
        return view('layouts.lecturer.groups.index');
    }

    public function show() {
        return view('layouts.lecturer.groups.show');
    }
}
