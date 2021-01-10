<aside class="main-sidebar sidebar-dark-primary elevation-4 bg-blue-900" style="background-color: #2A436A">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">FYPM</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/images/default-profile.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"> {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                General Actions
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Active Page</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- UnderGraduate --}}
            <li class="nav-header">Students</li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                <i class="fa fa-graduation-cap nav-icon " aria-hidden="true"></i>
                <p>
                    Undergraduate
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="#" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Programs</p>
                    </a>
                </li>
                </ul>
            </li>
          {{-- ./ UnderGraduate --}}

            {{-- Supervisors --}}
                <li class="nav-header">Supervisor</li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="fa fa-user nav-icon" aria-hidden="true"></i>
                    <p>
                        Lecturers
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Supervisors</p>
                        </a>
                    </li>
                    </ul>
                </li>
            {{-- ./ Supervisors --}}

                {{-- Supervisors --}}
                <li class="nav-header">Projects</li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="fa fa-file nav-icon" aria-hidden="true"></i>
                    <p>
                        Projects
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('project.index')}}" class="nav-link active">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Project Topics</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('project.assign.index')}}" class="nav-link active">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Assign Project Topics</p>
                        </a>
                    </li>
                    </ul>
                </li>
            {{-- ./ Supervisors --}}
            <li class="nav-item">
              <a href="{{route('assign.index')}}" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Assign Supervisor
                </p>
              </a>
            </li>
          <li class="nav-item">
            <a href="{{route('schools.index')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Schools
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('departments.index')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Departments
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('programs.index')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Programs
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>