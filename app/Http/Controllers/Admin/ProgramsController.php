<?php

namespace App\Http\Controllers\Admin;

use App\Program;
use App\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProgramsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::all();
        $programs = \App\Program::paginate(20);
        return view('layouts.admin.programs.index', compact('departments', 'programs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Program $program)
    {
        // dd($request->all());

        $validatedData = Validator::make($request->all(), [
            'program' => 'required|string',
            'program_code' => 'required|string',
            'department' => 'required'
        ]);

        if($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        $program->program = $request->program;
        $program->program_code = $request->program_code;
        $program->department_id = $request->department;
        $program->save();

        return redirect()->back()->with('success', 'Program Created Successfully');

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
    public function edit($program_code)
    {
        $program = DB::table('programs')->where('program_code', $program_code)->first();
        $departments = Department::all();
        return view('layouts.admin.programs.edit', compact('departments', 'program'));
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
        $validatedData = Validator::make($request->all(), [
            'program' => 'required|string',
            'program_code' => 'required|string',
            'department' => 'required'
        ]);

        if($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        $program = Program::find($id);
        $program->program = $request->program;
        $program->program_code = $request->program_code;
        $program->department_id = $request->department;
        $program->save();

        return redirect(route('programs.index'))->with('success', 'Program Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $program = Program::find($id);
        $program->delete();
        return redirect(route('programs.index'))->with('success', 'Program deleted successfully');
    }
}
