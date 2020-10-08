<div class="col-12 col-sm-12 col-md-3 col-lg-3">
    <div class="left__sidebar--container">
        <div class="user__sidebar-profile flex rounded shadow px-2 py-2 bg-white mb-4">
            <img src="/images/default-profile.png" class="img-fluid" alt="">
            <div class="ml-3">
                <h6 class="font-semibold mb-1"> {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} </h6>
                <span class="text-gray-500">Software Engineering</span>
            </div>
        </div>
        {{-- Group Members Names --}}
        <div class="sidebar__contents rounded shadow px-2 py-2 bg-white">
            <h6 class="font-semi-bold uppercase sidebar__header">Group Members</h6>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"> <i class="fas fa-signature mr-2"></i> Orolobo Lawrence</li>
                <li class="list-group-item"> <i class="fas fa-signature mr-2"></i> Bright Chris</li>
                <li class="list-group-item"> <i class="fas fa-signature mr-2"></i> Morbi leo risus</li>
              </ul>
              <hr>
            <h6 class="font-semi-bold uppercase sidebar__header">My Project</h6>
            <a href="{{ route('project.index') }}" class="btn btn-primary btn-block">Upload Project</a>
        </div>
    </div>
</div>