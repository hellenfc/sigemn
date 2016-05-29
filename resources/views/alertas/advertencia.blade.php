@if(Session::has('message-warning'))

<div class="alert alert-dismissable alert-warning">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <h4>¡Advertencia!</h4>
  {{Session::get('message-warning')}}
</div>

@endif