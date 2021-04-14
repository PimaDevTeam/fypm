@php
$user = Auth::user();
    $student = Auth::user()->roles[0]->id === 4;
    // $supervisor = Auth::user()->roles[0]->id === 3;

    $user_id = Auth::user()->id;
    $group_member = App\GroupMember::where('student_id', Auth::user()->id)
                                ->select('student_id', 'group_id', 'program_id')
                                ->get();
    $user_project = App\UserProject::where('student_id', Auth::user()->id)
                                ->select('supervisor_id')
                                ->get();
    // dd($group_member[0]->program_id);
    if(count($group_member) > 0) {
        $supervisor = DB::table('group_supervisors')
            ->where('group_id', $group_member[0]->group_id)
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'group_supervisors.supervisor_id');
            })
            ->get();
        $my_group_members = DB::table('group_members')
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
    }
    if (count($supervisor) > 0) {
        $fullname = $supervisor[0]->first_name. ' '. $supervisor[0]->last_name;
    } else {
        $fullname = 'Not Assigned Yet';
    }
@endphp
<div class="col-12 col-sm-12 col-md-3 col-lg-3">
    <div class="left__sidebar--container">
        <div class="user__sidebar-profile flex rounded shadow px-2 py-2 bg-white mb-4">
            {{-- <img src="/images/default-profile.png" class="img-fluid" alt=""> --}}
            <img src="{{asset('/storage/images/'.$user->image)}}" onerror="this.onerror=null;this.src='/images/avatar.png';" alt="avatar">
            <div class="ml-3">
                <h6 class="font-semibold mb-1">
                     <a class="text-blue-800" href="{{ route('user.profile') }}">
                         {{ Auth::user()->last_name }} {{ Auth::user()->first_name }}
                    </a>
                </h6>
                <span class="text-gray-500">
                    @php
                        $program = App\Program::where('id', $user->program_id)->first();
                        echo($program->program);
                    @endphp
                </span>
            </div>
        </div>
        {{-- STUDENT COMPONENT --}}
        {{-- STUDENT COMPONENT --}}
        @if ($student)
            <div class="sidebar__contents rounded shadow px-2 py-2 bg-white mb-3">
                <h6 class="font-semi-bold uppercase sidebar__header">Supervisor</h6>
                <h6 class="ml-2 text-gray-600 uppercase">
                   {{$fullname}}
                </h6>
                @if (count($user_project) > 0)
                    <hr>
                    <h6 class="font-semi-bold uppercase sidebar__header">My Project Topic</h6>
                    <a href="{{ route('project.topic.upload') }}" class="btn btn-primary btn-block">Suggest Project Topic</a>
                @endif
            </div>
            @if (count($group_member) > 0)
                <div class="sidebar__contents rounded shadow px-2 py-2 bg-white">
                    <h6 class="font-semi-bold uppercase sidebar__header">Group Members</h6>
                    <ul class="list-group list-group-flush">
                        @foreach ($my_group_members as $member)
                        <a href="{{route('project.member.student', $member->id)}}" class="aSTLi text-blue-900">
                            <li class="list-group-item uppercase hover:bg-gray-200">
                                 {{$member->last_name}} {{$member->first_name}}
                            </li>
                        </a>
                            {{-- <li class="list-group-item"> {{$member->first_name}} {{$member->last_name}}</li>                    --}}
                        @endforeach
                    </ul>
                </div>
            @endif
            {{-- <hr>
            <h6 class="font-semi-bold uppercase sidebar__header">My Project Document</h6>
            <a href="{{ route('student.project.upload') }}" class="btn btn-primary btn-block btn-c">Upload Project Document</a> --}}
        @endif
        {{-- STUDENT COMPONENT --}}
        {{-- STUDENT COMPONENT --}}



        {{-- STAFF COMPONENT --}}
        @if (Auth::user()->roles[0]->id === 3)
        @php
            $group = DB::table('group_supervisors')
                        ->where('supervisor_id', Auth::user()->id)
                        // ->select('group_id', 'program_id')
                        ->join('programs', function($join) {
                            $join->on('programs.id', '=', 'group_supervisors.program_id');
                        })
                        ->get();


            $student_projects = DB::table('user_projects') 
                        ->where('supervisor_id', Auth::user()->id)
                        ->join('users', function($join) {
                            $join->on('users.id', '=', 'user_projects.student_id');
                        })
                        ->join('programs', function($join) {
                            $join->on('programs.id', '=', 'users.program_id');
                        })
                        ->get();
                        // dd($student_projects);
                        // dd($group);
            if(count($group) > 0) {
                $group_students = DB::table('group_members')
                                ->where('group_id', $group[0]->group_id)
                                ->join('users', function($join) {
                                    $join->on('users.id', '=', 'group_members.student_id');
                                })
                                ->limit(5)
                                ->get();
            } else {
                $group_students = [];
            }
            // dd($group);
        @endphp
            <div class="sidebar__contents rounded shadow px-2 py-2 bg-white">
                <h6 class="font-semi-bold uppercase sidebar__header">Groups</h6>
                <ul class="list-group list-group-flush">
                    @if (count($group) > 0) 
                        @foreach ($group as $group)
                            <li class="list-group-item">
                                <a href="{{route('lecturer.groups.show', $group->group_id)}}" class="list-group-link">{{$group->program}} Group {{$group->group_id +1}}</a>
                            </li>                        
                        @endforeach                        
                    @endif
                </ul>
                <hr>
                <h6 class="font-semi-bold uppercase sidebar__header" style="font-size: .6rem">students</h6>
                <ul class="list-group list-group-flush">
                    @if ($group)
                        @foreach ($group_students as $student)
                            <a href="{{route('project.member.student', $student->id)}}" class="aSTLi text-blue-900">
                                <li class="list-group-item uppercase hover:bg-gray-200">
                                    {{$student->last_name}}  {{$student->first_name}}
                                </li>
                            </a>
                        @endforeach
                    @else
                        <li class="list-group-item uppercase hover:bg-gray-200">
                                No Student
                        </li>
                    @endif
                    @if ($student_projects)
                        @foreach ($student_projects as $student_project)
                            <a href="{{route('project.member.student', $student_project->student_id)}}" class="aSTLi text-blue-900">
                                <li class="list-group-item uppercase hover:bg-gray-200">
                                    {{$student_project->last_name}}  {{$student_project->first_name}}
                                </li>
                            </a>
                        @endforeach
                    @endif
                    {{-- <a href="{{route('project.member.student', $member->id)}}" class="lSBBvibtn text-xl uppercase sidebar__header text-center text-blue-900 mt-2 w-45 hover:bg-blue-100 transition duration-150 ease-in-out ">
                        <i class="fa fa-eye" aria-hidden="true"></i> View all
                    </a> --}}
                </ul>
                <hr>
                <h6 class="font-semi-bold uppercase sidebar__header">Project</h6>
                <a href="{{ route('lecturer.project.index') }}" class="w-100 no-underline">
                    <li class="nav-item list-none p-2 text-blue-900 hover:bg-gray-200">
                        Project Topic
                    </li>
                </a>
                <small class="text-mute text-center text-gray-600">Upload, view and approve project topics</small>
                <hr>
                <h6 class="font-semi-bold uppercase sidebar__header mt-4">Resources</h6>
                <a href="" class="btn btn-primary btn-block btn-c">Upload Project Resources</a>
            </div>
        @endif
    </div>
</div>