<?php

namespace App\Http\Controllers\Admin;

use App\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SchoolsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $schools = School::all();
        $schools = \App\School::paginate(10);
        return view('layouts.admin.schools.index', compact('schools'));
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
    public function store(Request $request, School $school)
    {
        // $data = $request->all();
        // dd($data);
        $validatedData = Validator::make($request->all(), [
            'school' => 'required|string',
            'school_code' => 'required|string'
        ]);

        if($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        $school->school = $request->school;
        $school->school_code = $request->school_code;
        $school->save();

        return redirect()->back()->with('success', 'New School created successfully');
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
    public function edit($school_code)
    {
        $school = DB::table('schools')->where('school_code', $school_code)->first();
        return view('layouts.admin.schools.edit', compact('school'));
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
            'school' => 'required|string',
            'school_code' => 'required|string'
        ]);

        if($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        $school = School::find($id);
        $school->school = $request->school;
        $school->school_code = $request->school_code;
        $school->save();

        return redirect(route('schools.index'))->with('success', 'School Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $school = School::find($id);
        $school->delete();     
        return redirect(route('schools.index'))->with('success', 'School deleted successfully');
    }
}
