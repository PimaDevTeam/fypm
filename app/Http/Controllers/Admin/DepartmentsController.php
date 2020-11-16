<?php

namespace App\Http\Controllers\Admin;

use App\School;
use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $departments = \App\Department::paginate(20);
        $schools = School::all();
        return view('layouts.admin.department.index', compact('schools', 'departments'));
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
    public function store(Request $request, Department $department)
    {
        $validatedData = Validator::make($request->all(), [
            'department' => 'required|string|unique:departments,department',
            'department_code' => 'required|string|unique:departments,department_code',
            'school' => 'required'
        ]);

        if($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        $department->department = $request->department;
        $department->department_code = $request->department_code;
        $department->school_id = $request->school;
        $department->save();

        return redirect()->back()->with('success', 'New Department created successfully');

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
    public function edit($department_code)
    {
        $department = DB::table('departments')->where('department_code', $department_code)->first();
        $schools = School::all();
        return view('layouts.admin.department.edit', compact('department', 'schools'));
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
            'department' => 'required|string',
            'department_code' => 'required|string',
            'school' => 'required'
        ]);

        if($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        $department = Department::find($id);
        $department->department = $request->department;
        $department->department_code = $request->department_code;
        $department->school_id = $request->school;
        $department->save();

        return redirect(route('departments.index'))->with('success', 'Department Updated Successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::find($id);
        $department->delete();
        return redirect(route('departments.index'))->with('success', 'Department deleted successfully');

    }
}
