@extends('layout.layout') <!--Extiende de layout-->
@section('cuerpo') <!--Va en la seccion donde dice cuerpo-->
<br />
<div class="col-md-offset-2 col-md-8">
  <div class="panel panel-warning">
      <div class="panel-heading">
        <h3 class="panel-title">Conoce información de tu subscripción</h3>
      </div>
      <form method="POST" action="renovarSubscripcion">
        {!! csrf_field() !!}
        <div class="panel-body">
          <div class="form-group">
            <label class="control-label" for="disabledInput">Cantidad de días restantes:</label>
            <input class="form-control" id="diasRestantes" type="text" placeholder="Disabled input here..." disabled="" value="{{$interval->format('%R%a días')}}">
          </div>
          <div class="col-md-4 col-lg-push-4">
            <div class="well well-lg " style="text-align: center;">
              Aumenta tu subscripción un mes más y sigue disfrutando de nuestros servicios.
              <br />
              <br />
              <button type="submit" class="btn btn-info">Obtener</button>
            </div>

          </div>
        </div>
      </form>
  </div>
</div>
<script type="text/javascript">
  function actualizarSubscripcion() {
    //alert("yesss");
    var url = 'renovarSubscripcion';
    var noIdentidad;

    $.post(url,
        {},
        function(data){
          alert(data);
        });
  }

</script>
@stop
