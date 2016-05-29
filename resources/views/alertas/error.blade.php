@if(Session::has('message-error'))
<div class="alert alert-dismissable alert-danger">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>¡Error!: </strong> {{Session::get('message-error')}}
</div>
@endif