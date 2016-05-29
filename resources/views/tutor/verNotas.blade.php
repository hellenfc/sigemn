
@extends('layout.layout') <!--Extiende de layout-->
@section('cuerpo') <!--Va en la seccion donde dice cuerpo-->

<form method="POST" action="">
	{!! csrf_field() !!}
	 <br>
	<form class="form-horizontal">
		<div class="panel panel-primary">
	  		<div class="panel-heading">
           		<h3 class="panel-title">Ver notas</h3>
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
			     		<button type="button" class="btn btn-primary" onclick="VisualizarNotas()" id="seleccionar">Seleccionar</button>
			            <br>
			            <div  id="verNotas" class="col-lg-8 col-xs-6">
			            	<!--Muestra las notas del estudiante-->
		            	</div>

		            </div>

		            <div class="col-lg-12" style="text-align:center;" id="mostrarTabla">
		            	<br><br><br>
		            	<table class="table table-bordered" border="1" align="center">
			            	<thead>
				            		<tr>
				            			<th>Materia</th>
				            			<th>Primer Parcial</th>
				            			<th>Segundo Parcial</th>
				            			<th>Tercer Parcial</th>
				            			<th>Cuarto Parcial</th>
				            			<th>Promedio</th>
				            		</tr>
			            	</thead>
			            	<tbody id="desplegarNotas">

			            	</tbody>
			        	</table>
				    </div>
	     		</div>
	     	</div>

		</div>

	</form>
	@include('layout.scriptsLoad')
</form>
<script>
	if ($(document).ready){
		$('#verNotas').hide();
		$('#mostrarTabla').hide();


	}

	function BuscarClase(idClaseSeccion, info)
	{
		var info = info;

		var datosCompletos=" ";
		var count = 0;
		for (var i = 0; i < idClaseSeccion.length; i++) {

			$.get('http://localhost:8000/buscarClase/' + idClaseSeccion[i], function(data)
			{
				datosCompletos += "<tr> <td>" + data[0].nombre + "</td>";
				var promedio=0;
				//Para poder visulizar notas se debe ir ordenado con el mimo alumno
				for (var i = 0; i < 4; i++) {

					datosCompletos += "<td>"+ info[count + i].nota + "</td>";
					promedio += parseInt(info[count + i].nota);
					alert(promedio);
				}
				//Saca el promedio

				count+=4;
				datosCompletos += "<td>"+ promedio/4 + "</td> </tr>";

				$('#desplegarNotas').html(datosCompletos);
				console.log(datosCompletos);
	        //$('#estadoCuenta').append($("<input type='text' readonly style='text-align:center'> ").val(data.pago).html(data.pago));
	        //$('#estadoCuenta').show();
	   		});

		};

		$('#mostrarTabla').show();
	}



	function VisualizarNotas()
	{

		$('#verNotas').html("<br>");
		//$('#estadoCuenta').append($("<input  type='text' readonly>").val("pago").html("pago"));
		var idEstudiante = $('#seleccionarEstudiante').val();

		$.get('http://localhost:8000/cargarNotas/' + idEstudiante, function(data){
			var count=0;
			var listIdSeccionclase = [];

			for (var i = 0 ; i < data.length; i++) {
				count = count +1;
				if(( count == 3)){
					listIdSeccionclase.push(data[i].idSeccionclase);
					count=0;
				}
			};

			BuscarClase(listIdSeccionclase, data);
			       //$('#estadoCuenta').append($("<nput type='text' readonly style='text-align:center'> ").val(data.pago).html(data.pago));
        	$('#verNotas').show();
   		});
		//$result = DB :: select('select pago from estudiantes where id = ?', array(idEstudiante));

	}


</script>
@stop
