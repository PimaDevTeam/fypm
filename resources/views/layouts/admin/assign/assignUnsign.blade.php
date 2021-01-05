@php
    // $user = Auth::user()->roles[0]->id
    $user = Auth::user();
@endphp
@extends('layouts.admin.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            @include('messages')
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ $error }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endforeach
            @endif
            <h3 class="text-blue-900 font-semibold mb-4 text-center">Select One</h3>
            <hr>
            <div class="row justify-center mt-5">
                @foreach ($program as $program)
                    @php
                        $id = $program->id
                    @endphp
                @endforeach
                <div class="col-lg-4">
                    <a href="{{route('assign.show', $program->id)}}" class="text-decoration-none aSTUD">
                        <div class="assign__card--container shadow p-10 bg-white">
                            <div class="ml-auto mr-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                    width="80" height="80"
                                    viewBox="0 0 226 226"
                                    style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,226v-226h226v226z" fill="none"></path><g fill="#2a4365"><circle cx="12" cy="7" transform="scale(9.41667,9.41667)" r="4" opacity="0.35"></circle><circle cx="20" cy="9" transform="scale(9.41667,9.41667)" r="3" opacity="0.35"></circle><circle cx="4" cy="9" transform="scale(9.41667,9.41667)" r="3" opacity="0.35"></circle><path d="M178.91667,131.83333c-25.99942,0 -47.08333,21.08392 -47.08333,47.08333c0,25.99942 21.08392,47.08333 47.08333,47.08333c25.99942,0 47.08333,-21.08392 47.08333,-47.08333c0,-25.99942 -21.08392,-47.08333 -47.08333,-47.08333z" opacity="0.35"></path><path d="M131.83333,178.91667c0,-22.85425 16.29083,-41.88533 37.89267,-46.1605c-5.97017,-6.328 -14.36042,-10.3395 -23.76767,-10.3395h-65.91667c-13.12683,0 -24.36092,7.73108 -29.6625,18.83333h-17.42083c-13.00442,0 -23.54167,10.53725 -23.54167,23.54167c0,13.00442 10.53725,23.54167 23.54167,23.54167c0,0 54.43775,0 99.82608,0c-0.6215,-3.04158 -0.95108,-6.18675 -0.95108,-9.41667z"></path><path d="M154.25442,173.08775c-3.21108,3.2205 -3.21108,8.43733 0,11.65783l14.125,14.125c1.55375,1.55375 3.62542,2.41067 5.82892,2.41067c2.2035,0 4.27517,-0.85692 5.82892,-2.41067l23.54167,-23.54167c3.21108,-3.2205 3.21108,-8.43733 0,-11.65783c-3.21108,-3.20167 -8.43733,-3.20167 -11.64842,0l-17.72217,17.72217l-8.29608,-8.3055c-3.21108,-3.20167 -8.44675,-3.20167 -11.65783,0z"></path></g></g>
                                </svg>
                            </div>
                            <h6 class="text-center text-uppercase mt-4">Assign Supervisor to Students</h6>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4">
                    <a href="{{route('assign.unassign', $program->id)}}" class="text-decoration-none aSTUD">
                        <div class="assign__card--container shadow p-10 bg-white">
                            <div class="ml-auto mr-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                width="80" height="80"
                                viewBox="0 0 172 172"
                                style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#2a4365"><rect x="8" y="15" transform="scale(7.16667,7.16667)" width="5" height="6" opacity="0.35"></rect><circle cx="11" cy="7" transform="scale(7.16667,7.16667)" r="5" opacity="0.35"></circle><path d="M74.132,117.57633l-6.04867,-10.07633c-16.76283,0 -31.20367,0 -32.25,0c-11.87517,0 -21.5,9.62483 -21.5,21.5c0,11.87517 9.62483,21.5 21.5,21.5c0.98183,0 13.83883,0 29.31883,0z"></path><path d="M100.33333,129c0,8.09833 2.65167,15.55167 7.16667,21.5h-14.97833l-8.95833,-32.895l6.02,-10.105h17.91667c-4.515,5.94833 -7.16667,13.40167 -7.16667,21.5z"></path><path d="M136.16667,93.16667c-19.78,0 -35.83333,16.05333 -35.83333,35.83333c0,19.78 16.05333,35.83333 35.83333,35.83333c19.78,0 35.83333,-16.05333 35.83333,-35.83333c0,-19.78 -16.05333,-35.83333 -35.83333,-35.83333z" opacity="0.35"></path><path d="M154.08333,136.16667h-35.83333c-3.956,0 -7.16667,-3.21067 -7.16667,-7.16667v0c0,-3.956 3.21067,-7.16667 7.16667,-7.16667h35.83333c3.956,0 7.16667,3.21067 7.16667,7.16667v0c0,3.956 -3.21067,7.16667 -7.16667,7.16667z"></path></g></g>
                            </svg>
                            </div>
                            <h6 class="text-center text-uppercase mt-4">Unassign Supervisor to Students</h6>
                        </div>
                    </a>
                </div>
            </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection