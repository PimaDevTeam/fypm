<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\User;
use App\Program;
use App\Session;
use App\RoleUser;
use App\UserProject;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;

class AssignSupervisor extends Controller
{


    public function index() {
        $programs = Program::all();
        $studentsRoleId = DB::table('role_user')->where('role_id', 4)->get();
        // dd(json_decode($studentsRoleId));
        // $students = DB::table('users')->where('id', $studentsRoleId['user_id']);
        // dd(json_decode($students));
        return view('layouts.admin.assign.index', compact('programs'));
    }

    public function assignCategory($name) {
        $program = Program::where('program', $name)->get();
        // dd($program);

        return view('layouts.admin.assign.assignUnsign', ['program' => $program]);
    }

    public function assign($id) {
        $roleStudent = Role::where('id', 4)->first();
        $students = $roleStudent->users()->where('program_id', $id)->get();

        $studentIdUserProject = UserProject::pluck('student_id')->all();
        $studentsAssigned = $students->whereNotIn('id', $studentIdUserProject)->all();

        $group_id = $students->whereNotIn('id', $studentIdUserProject)->pluck('id')->all();
        $sessions = Session::all(); 
        
        // $userProject = UserProject::all();

        // dd(json_decode($userProject));

        $roleSupervisor = Role::where('id', 3)->first();
        $supervisors = $roleSupervisor->users()->where('program_id', $id)->get();

        return view('layouts.admin.assign.show', compact('studentsAssigned', 'supervisors', 'sessions', 'group_id'));
    }

    public function unAssign($id) {
        $roleStudent = Role::where('id', 4)->first();
        $students = $roleStudent->users()->where('program_id', $id)->get();

        $studentIdUserProject = UserProject::pluck('student_id')->all();
        $studentsAssigned = $students->whereIn('id', $studentIdUserProject)->all();
        
        // dd($studentsAssigned);
        $sessions = Session::all(); 

        $roleSupervisor = Role::where('id', 3)->first();
        $supervisors = $roleSupervisor->users()->where('program_id', $id)->get();

        $supervisorIdUserProject = UserProject::pluck('supervisor_id')->all();
        $supervisorAssigned = $supervisors->whereIn('id', $supervisorIdUserProject);

        $sessionIdUserProject = UserProject::pluck('session_id')->all();
        $sessionId = $sessions->whereIn('id', $sessionIdUserProject);

        return view('layouts.admin.assign.showAssigned', compact('studentsAssigned','supervisorAssigned', 'sessionId'));
    }

    public function assignSupervisor(Request $request, UserProject $userProject) {
        $validatedData = Validator::make($request->all(), [
            'student_id' => 'required|integer',
            'supervisor_id' => 'required|integer',
            'session_id' => 'required|integer'
        ]);

        if($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        $userProject->student_id = $request->student_id;
        $userProject->supervisor_id = $request->supervisor_id;
        $userProject->session_id = $request->session_id;
        $userProject->save();

        return redirect()->back()->with('success', 'Supervisor Successfully Assigned');


    }

    public function unassignSupervisor($id) {
        $studentAssigned = UserProject::where('student_id', $id)->first();
        // dd($studentAssigned);
        $studentAssigned->delete();

        return redirect(route('assign.unassign'))->with('success', 'Student has been unassigned');
    }

    public function autoGrouping(Request $request) {
        $validatedData = Validator::make($request->all(), [
            'number_of_students_per_group' => 'required|integer'
        ]);

        if($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        $studentsPerGroup = $request->number_of_students_per_group;
        // program ID
        $id = $request->program_id;

        $roleStudent = Role::where('id', 4)->first();
        $students = $roleStudent->users()->where('program_id', $id)->get();

        $studentIdUserProject = UserProject::pluck('student_id')->all();
        $studentsAssigned = $students->whereNotIn('id', $studentIdUserProject)->all();

        $group_id = $students->whereNotIn('id', $studentIdUserProject)->pluck('id')->all();

        // Shuffle an array function
        function shuffle_array($a, $limit) {
            $result = $a ;
            $shuffled_index = array() ; // list of already shuffled elements
        
            $n = count($result);
            for($i = 0 ; $i < $n ; ++$i)
            {
                if( in_array($i, $shuffled_index) ) continue ; // already shuffled, go to the next elements
        
                $possibleIndex = array_diff( range($i, min($i + $limit, $n-1)), $shuffled_index) ; // get all the possible "jumps", minus the already- shuffled index
                $selectedIndex = $possibleIndex[ array_rand($possibleIndex) ]; // randomly choose one of the possible index
        
                // swap the two elements
                $tmp = $result[$i] ;
                $result[$i] = $result[$selectedIndex] ;
                $result[$selectedIndex] = $tmp ;
        
                // element at position $selectedIndex is already shuffled, it needs no more processing
                $shuffled_index[] = $selectedIndex ; 
            }
        
            return $result ;
        }
        // ---------------------
        
            $array = $group_id;
            $limit = sizeof($array);

            $data = shuffle_array($array, $limit);
            //grouping the ids [5] in a group
            // size of group must be greater than 2
            if($studentsPerGroup < 2) {
                return redirect()->back()->withErrors('Number of students per group must be greater than 2');
            }
            $chunk = array_chunk($data, $studentsPerGroup, true);
            //getting the last item in the array
            $end = end($chunk);

            // dd(sizeof($chunk) -1);

            // dd($chunk);

            // checking size of the last array
            if(sizeof($end) < 4) {
                // print_r('less students');
                $slast = sizeof($chunk) - 2;
                // array_push($chunk[$slast], $end);
                foreach ($end as $value) {
                    array_push($chunk[$slast], $value);
                }
                array_pop($chunk);
            }
            // dd($chunk[0]);

            // dd($chunk);

            $groups = [];
            $r = (int) count($chunk);
            // for($i = 0; $i <= $r; $i++) {
                // echo($i);
                // for($j = 0; $j <= $r[$i]; $j++) {
                    foreach ($chunk as $key => $value) {
                        // $groups = [
                            // 'group_id' => $key,
                            // 'student_id' => $value[$j],
                            // 'program_id' => $id
                        // ];
                        foreach ($value as $groupStudent => $student) {
                            array_push($groups, [
                                'group_id' => $key,
                                'student_id' => $student,
                                'program_id' => $id,
                                'created_at' => now(),
                                'updated_at' => now()
                            ]);   
                        }
                    }
                // }
            // }
            // dd($groups);
            DB::table('group_members')->insert($groups);
            return redirect()->back()->with('success', 'Groups Created');
    }
}
