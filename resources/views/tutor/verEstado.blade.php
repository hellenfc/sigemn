
@extends('layout.layout') <!--Extiende de layout-->
@section('cuerpo') <!--Va en la seccion donde dice cuerpo-->

<form method="POST" action="">
	{!! csrf_field() !!}
	 <br>
	<form class="form-horizontal"z>
		<div class="col-md-offset-2 col-md-8">
			<div class="panel panel-primary">

				<div class="panel-heading">
					<h3 class="panel-title">Estado de cuenta</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<div class="col-lg-2" >
							<label class="control-label" for="focusedInput">Seleccione a un Estudiante</label>
						</div>
						<div class="col-lg-4 col-md-6 col-md-6 col-xs-8">
							<select class="form-control" id="seleccionarEstudiante" type="name" name="estudiantes">
								@if (Auth::check())
								@foreach($estudiantes as $estudiante)
								<option value="{{$estudiante->id}}">{{$estudiante->primerNombre}}</option>
								@endforeach
								@endif
							</select>
							<br>
							<button type="button" class="btn btn-primary" onclick="EstadoCuenta()" id="seleccionar">Seleccionar</button>
							<br>
							<div  id="estadoCuenta" class="col-lg-8  col-md-6 col-md-6 col-xs-12">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


	</form>
	@include('layout.scriptsLoad')
</form>


<script>
	if ($(document).ready){
		$('#estadoCuenta').hide();


}

	function EstadoCuenta()
	{

		$('#estadoCuenta').html("<br>")
		//$('#estadoCuenta').append($("<input  type='text' readonly>").val("pago").html("pago"));
		var idEstudiante = $('#seleccionarEstudiante').val();

		$.get('http://localhost:8000/obtenerInformacionEstudiando/' + idEstudiante, function(data)
		{
				$('#estadoCuenta').append($("<input type='text' class='form-control' readonly style='text-align:center'>").val(data[0].pago).html(data[0].pago));
        $('#estadoCuenta').show();
   		});

		//$result = DB :: select('select pago from estudiantes where id = ?', array(idEstudiante));


	}
</script>
@stop
