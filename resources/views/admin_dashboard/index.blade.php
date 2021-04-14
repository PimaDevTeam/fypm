@extends('layouts.admin.app')
<style>
    .table-condensed{
        width: 100%;
    }
</style>
@section('content')

@if (Auth::user()->role_id <= 2)
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$supervisors}}</h3>

                <p>Lecturers</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$students}}</h3>

                <p>Students</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-pie"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3>{{$departments}}</h3>

                <p>Departments</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-pie"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{$programs}}</h3>

                <p>Programs</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-pie"></i>
              </div>
            </div>
          </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Projects</h3>
                {{-- <div class="card-tools">
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-bars"></i>
                  </a>
                </div> --}}
              </div>
              <div class="card-body p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Topic</th>
                    <th>Proposed By</th>
                    <th>Program</th>
                    <th>Status</th>
                    <th>Created At</th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach ($projects as $project)
                          <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                            {{$project->topic}}
                            </td>
                            <td>{{$project->last_name}}</td>
                            <td>
                            {{$project->program}}
                            </td>
                            <td>
                                @if ($project->project_status_id == 1)
                                    <div class="badge badge-success p-2">Approved</div>
                                @elseif($project->project_status_id == 2)
                                    <div class="badge badge-danger p-2">Unapproved</div>
                                @elseif($project->project_status_id == 3)
                                    <div class="badge badge-success p-2">Assigned</div>
                                @elseif($project->project_status_id == 4)
                                    <div class="badge badge-warning p-2">Not Assigned</div>
                                @elseif($project->project_status_id == 5)
                                    <div class="badge badge-danger p-2">Rejected</div>
                                @endif
                            </td>
                            <td>
                            {{\Carbon\Carbon::parse($project->created_at)->diffForHumans()}}
                            </td>
                        </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card bg-gradient-success">
              <div class="card-header border-0">

                <h3 class="card-title">
                  <i class="far fa-calendar-alt"></i>
                  Calendar
                </h3>
                <!-- tools card -->
                <div class="card-tools">
                  <!-- button with a dropdown -->
                  <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-bars"></i></button>
                    <div class="dropdown-menu float-right" role="menu">
                      <a href="#" class="dropdown-item">Add new event</a>
                      <a href="#" class="dropdown-item">Clear events</a>
                      <div class="dropdown-divider"></div>
                      <a href="#" class="dropdown-item">View calendar</a>
                    </div>
                  </div>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body pt-0">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
              </div>
              <!-- /.card-body -->
            </div>
        </div>
    </div>
@endif

@push('scripts')
    <script>
        $(document).ready(function() {
             // The Calender
            $('#calendar').datetimepicker({
                format: 'L',
                inline: true,
                icons: {
                    time:'fas fa-clock-o',
                    date:'fas fa-calendar',
                    up:'fas fa-chevron-up',
                    down:'fas fa-chevron-down',
                    previous:'fas fa-chevron-left',
                    next:'fas fa-chevron-right',
                    today:'fas fa-crosshairs',
                    clear:'fas fa-trash-o',
                    close:'fas fa-times'
                },

            })
        })
    </script>
@endpush

    
@endsection