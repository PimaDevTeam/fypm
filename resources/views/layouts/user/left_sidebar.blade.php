<div class="col-12 col-sm-12 col-md-3 col-lg-3">
    <div class="left__sidebar--container">
        <div class="user__sidebar-profile flex rounded shadow px-2 py-2 bg-white mb-4">
            <img src="/images/default-profile.png" class="img-fluid" alt="">
            <div class="ml-3">
                <h6 class="font-semibold mb-1">
                     <a class="text-blue-800" href="{{ route('user.profile') }}">
                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                    </a>
                </h6>
                <span class="text-gray-500">Software Engineering</span>
            </div>
        </div>
        {{-- STUDENT COMPONENT --}}
        {{-- STUDENT COMPONENT --}}
        @if (Auth::user()->role_id === 4)
            <div class="sidebar__contents rounded shadow px-2 py-2 bg-white">
                <h6 class="font-semi-bold uppercase sidebar__header">Group Members</h6>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"> <i class="fas fa-signature mr-2"></i> Orolobo Lawrence</li>
                    <li class="list-group-item"> <i class="fas fa-signature mr-2"></i> Bright Chris</li>
                    <li class="list-group-item"> <i class="fas fa-signature mr-2"></i> Morbi leo risus</li>
                </ul>
                <hr>
                <h6 class="font-semi-bold uppercase sidebar__header">My Project</h6>
                <a href="{{ route('project.upload') }}" class="btn btn-primary btn-block">Upload Project</a>
            </div>
        @endif
        {{-- STUDENT COMPONENT --}}
        {{-- STUDENT COMPONENT --}}



        {{-- STAFF COMPONENT --}}
        @if (Auth::user()->role_id === 3)
            <div class="sidebar__contents rounded shadow px-2 py-2 bg-white">
                <h6 class="font-semi-bold uppercase sidebar__header">Groups</h6>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"> <i class="fas fa-signature mr-2"></i> CSA GROUP 3</li>
                    <li class="list-group-item"> <i class="fas fa-signature mr-2"></i> CSA GROUP 5</li>
                    <li class="list-group-item"> <i class="fas fa-signature mr-2"></i> CIS GROUP 4</li>
                </ul>
                <hr>
                <h6 class="font-semi-bold uppercase sidebar__header">students</h6>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"> <i class="fas fa-signature mr-2"></i> Bright Chris</li>
                    <li class="list-group-item"> <i class="fas fa-signature mr-2"></i> Orolobo Lawrence</li>
                    <li class="list-group-item"> <i class="fas fa-signature mr-2"></i> Abraham Olaobaju</li>
                </ul>
                <hr>
                <h6 class="font-semi-bold uppercase sidebar__header">Project</h6>
                <a href="{{ route('lecturer.project.upload') }}" class="btn btn-primary btn-block">Upload Project Topic</a>
                <h6 class="font-semi-bold uppercase sidebar__header mt-2">Resources</h6>
                <a href="" class="btn btn-primary btn-block">Upload Project Resources</a>
            </div>
        @endif
    </div>
</div>