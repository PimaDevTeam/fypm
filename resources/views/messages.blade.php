@if ($message = Session::get('login-error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong> <i class="fa fa-times" aria-hidden="true"></i> Error!!</strong> {{ $message }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif