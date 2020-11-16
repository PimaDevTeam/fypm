@if ($message = Session::get('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong> <i class="fa fa-times" aria-hidden="true"></i> Error!!</strong> {{ $message }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

@if ($message = Session::get('success'))
<div class="toast ml-auto" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="true" data-delay="6000">
    <div class="toast-header">
      <i class="far fa-check-circle mr-1 text-green-600" style=" font-size: 1.5rem"></i>
      <h6 class="mr-auto text-green-600 mt-1" style="font-size: 1.1rem;">Successful</h6>
      {{-- <small>11 mins ago</small> --}}
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
      {{ $message }}
    </div>
</div>
@endif