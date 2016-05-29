@if(Session::has('message-success'))


<div class="alert alert-dismissable alert-info">
  <button type="button" class="close" data-dismiss="alert">×</button>  
  <strong>¡Éxito!: </strong> {{Session::get('message-success')}}
</div>


@endif