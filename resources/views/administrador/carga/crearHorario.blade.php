@extends('layout.menuCarga')
@section('cuerpoPrincipalCarga')
<form method="POST" action="administrador/carga/crearHorario">
	  {!! csrf_field() !!}
	<br>
	<div class="col-md-offset-2 col-md-8">
		<div ng-app="myApp" ng-controller="horarioCtrl">
		<form class="form-horizontal">
			<fieldset>
				<div class="panel panel-warning ">
		  			<div class="panel-heading">
		    			<h3 class="panel-title">Selecciona una sección</h3>
		 			</div>
		  			<div class="panel-body">
		    			<div class="form-group">
		      				<label for="select" class="col-lg-2 control-label">Sección:</label>
		      				<div class="col-lg-6">
		        				<select class="form-control" id="selectSeccion" onchange="showSelectOption()" ng-change= "findInfo()" ng-model="selectedSeccion" required>
		        					@foreach($secciones as $seccion)
						          		<option value="{{$seccion->id}}">{{$seccion->nombre}}</option>
						          @endforeach

		        				</select>
		       				</div>
		       			</div>
		       			<br><br>
		       			<div id="formularioBoton">
			       			<div class="well" ng-repeat="x in information" class="col-lg-8">
								<!--Agregar -->
				       			<p class="text-primary" >Jornada: @{{x.nombreJornada}}</p>
				       			<p class="text-primary">Curso: @{{x.nombreCursos}}</p>
				       			<p class="text-primary">Cupos: @{{x.cupos}}</p>
				       			<p class="text-primary" >Aula: @{{x.aula}}</p>
				       			<input id="idCurso" type="hidden" value="@{{x.idCurso}}"/>
				       			<input id="idJornadaSelected" type="hidden" name="idJornada" value="@{{x.idJornada}}">
			       			</div>

			       			<div style="text-align: center;">
								<button type="button" class="btn btn-danger" onclick="showIdCurso()" id="boton">Seleccionar</button>
							</div>

		       			</div>

		  			</div>
				</div>
			</fieldset>
		</form>

		<!-- Inicio form -->
		<form class="form-horizontal" id="formularioPanel">
			<fieldset>
				<div class="panel panel-warning ">
		  			<div class="panel-heading">
		    			<h3 class="panel-title">Lunes</h3>
		 			</div>

		  			<div class="panel-body">
						<table class="table table-striped table-hover ">
							<thead>
							    <tr  class="success">
							      <th>Maestro</th>
							      <th>Clase</th>
							      <th>Hora Inicio</th>
							      <th>Hora Fin</th>
							    </tr>
							</thead>
							<tbody id = "horarioFormadoLunes">
							</tbody>
						</table>
						<row >
							<div id="campos0"><!-- INicio de lo que se duplica -->
								<div class="form-group  col-md-3 col-sm-3 ">
					      			<label for="select" class="control-label">Maestro:</label>
					      			<div >
					        			<select class="form-control" id="lunesselectProfesor0" required>
					        				@foreach($maestros as $maestro)
							       				<option value="{{$maestro->id}}">{{$maestro->primerNombre}}</option>
						          			@endforeach
					        			</select>
					       			</div>
					       		</div>

					       		<div class="form-group  col-md-3 col-sm-3">
					      			<label for="select" class="control-label">Clase:</label>
					      			<div class="">
					        			<select class="form-control" id="lunesselect0" required>
					        			</select>
					       			</div>
					       		</div>


					       		<div class="form-group  col-md-3 col-sm-3">
					      			<label for="select" class="control-label">Hora Inicio:</label>
					      			<div class="">
					        			<input class="form-control" type="text" id="luneshorainicio0" name="horainicio" placeholder="12:00" required>
					       			</div>
					       		</div>

					       		<div class="form-group  col-md-3 col-sm-3">
					      			<label for="select" class="control-label">Hora Fin:</label>
					      			<div class="">
					        			<input class="form-control" type="text" id="luneshorafinal0" name='horafinal' placeholder='12:00' required>
					       			</div>
					       		</div>

					       		<div>
					       			<br>
					       			<div style="text-align: center;">
										<button type="button" class="btn btn-danger  btn-lg" id="boton" style="text-align: center;" onclick="generarNueva('campos0', 'lunes', 0)">+</button>
									</div>
		       					</div>
					       		<br>
					       		<br>
						</row>
							<!-- Fin del Row-->
					</div>
						<!-- Fin del div que se duplica -->
					<br>
					<div style="text-align: center;">
						<span class="label label-default" >Todos los campos son necesarios.</span>
					</div>
					<br>
					<div style="text-align: center;">
						<button type="button"  onclick="guardarHorario('Lunes','lunes', 0)" class="btn btn-danger" id="boton">Guardar horario</button>
					</div>
		  		</div>
			</fieldset>
			<br>



			<fieldset>
				<div class="panel panel-warning ">
		  			<div class="panel-heading">
		    			<h3 class="panel-title">Martes</h3>
		 			</div>

		  			<div class="panel-body">
						<table class="table table-striped table-hover ">
							<thead>
							    <tr  class="success">
							      <th>Maestro</th>
							      <th>Clase</th>
							      <th>Hora Inicio</th>
							      <th>Hora Fin</th>
							    </tr>
							</thead>
							<tbody id = "horarioFormadoMartes">
							</tbody>
						</table>
						<row >
							<div id="campos1"><!-- INicio de lo que se duplica -->
								<div class="form-group  col-md-3 col-sm-3 ">
					      			<label for="select" class="control-label">Maestro:</label>
					      			<div >
					        			<select class="form-control" id="martesselectProfesor0" required>
					        				@foreach($maestros as $maestro)
							       				<option value="{{$maestro->id}}">{{$maestro->primerNombre}}</option>
						          			@endforeach
					        			</select>
					       			</div>
					       		</div>

					       		<div class="form-group  col-md-3 col-sm-3">
					      			<label for="select" class="control-label">Clase:</label>
					      			<div class="">
					        			<select class="form-control" id="martesselect0" required>
					        			</select>
					       			</div>
					       		</div>


					       		<div class="form-group  col-md-3 col-sm-3">
					      			<label for="select" class="control-label">Hora Inicio:</label>
					      			<div class="">
					        			<input class="form-control" type="text" id="marteshorainicio0" name="horainicio" placeholder="12:00" required>
					       			</div>
					       		</div>

					       		<div class="form-group  col-md-3 col-sm-3">
					      			<label for="select" class="control-label">Hora Fin:</label>
					      			<div class="">
					        			<input class="form-control" type="text" id="marteshorafinal0" name='horafinal' placeholder='12:00' required>
					       			</div>
					       		</div>

					       		<div>
					       			<br>
					       			<div style="text-align: center;">
										<button type="button" class="btn btn-danger  btn-lg" id="boton" style="text-align: center;" onclick="generarNueva('campos1', 'martes', 1)">+</button>
									</div>
		       					</div>
					       		<br>
					       		<br>
						</row>
							<!-- Fin del Row-->
					</div>
						<!-- Fin del div que se duplica -->
					<br>
					<div style="text-align: center;">
						<span class="label label-default" >Todos los campos son necesarios.</span>
					</div>
					<br>
					<div style="text-align: center;">
						<button type="button"  onclick="guardarHorario('Martes','martes', 1)" class="btn btn-danger" id="boton">Guardar horario</button>
					</div>
		  		</div>
			</fieldset>
			<br>


			<fieldset>
				<div class="panel panel-warning ">
		  			<div class="panel-heading">
		    			<h3 class="panel-title">Miercoles</h3>
		 			</div>

		  			<div class="panel-body">
						<table class="table table-striped table-hover ">
							<thead>
							    <tr  class="success">
							      <th>Maestro</th>
							      <th>Clase</th>
							      <th>Hora Inicio</th>
							      <th>Hora Fin</th>
							    </tr>
							</thead>
							<tbody id = "horarioFormadoMiercoles">
							</tbody>
						</table>
						<row >
							<div id="campos2"><!-- INicio de lo que se duplica -->
								<div class="form-group  col-md-3 col-sm-3 ">
					      			<label for="select" class="control-label">Maestro:</label>
					      			<div >
					        			<select class="form-control" id="miercolesselectProfesor0" required>
					        				@foreach($maestros as $maestro)
							       				<option value="{{$maestro->id}}">{{$maestro->primerNombre}}</option>
						          			@endforeach
					        			</select>
					       			</div>
					       		</div>

					       		<div class="form-group  col-md-3 col-sm-3">
					      			<label for="select" class="control-label">Clase:</label>
					      			<div class="">
					        			<select class="form-control" id="miercolesselect0" required>
					        			</select>
					       			</div>
					       		</div>


					       		<div class="form-group  col-md-3 col-sm-3">
					      			<label for="select" class="control-label">Hora Inicio:</label>
					      			<div class="">
					        			<input class="form-control" type="text" id="miercoleshorainicio0" name="horainicio" placeholder="12:00" required>
					       			</div>
					       		</div>

					       		<div class="form-group  col-md-3 col-sm-3">
					      			<label for="select" class="control-label">Hora Fin:</label>
					      			<div class="">
					        			<input class="form-control" type="text" id="miercoleshorafinal0" name='horafinal' placeholder='12:00' required>
					       			</div>
					       		</div>

					       		<div>
					       			<br>
					       			<div style="text-align: center;">
										<button type="button" class="btn btn-danger  btn-lg" id="boton" style="text-align: center;" onclick="generarNueva('campos2', 'miercoles', 2)">+</button>
									</div>
		       					</div>
					       		<br>
					       		<br>
						</row>
							<!-- Fin del Row-->
					</div>
						<!-- Fin del div que se duplica -->
					<br>
					<div style="text-align: center;">
						<span class="label label-default" >Todos los campos son necesarios.</span>
					</div>
					<br>
					<div style="text-align: center;">
						<button type="button"  onclick="guardarHorario('Miercoles', 'miercoles', 2)" class="btn btn-danger" id="boton">Guardar horario</button>
					</div>
		  		</div>
			</fieldset>
			<br>


			<fieldset>
				<div class="panel panel-warning ">
		  			<div class="panel-heading">
		    			<h3 class="panel-title">Jueves</h3>
		 			</div>

		  			<div class="panel-body">
						<table class="table table-striped table-hover ">
							<thead>
							    <tr  class="success">
							      <th>Maestro</th>
							      <th>Clase</th>
							      <th>Hora Inicio</th>
							      <th>Hora Fin</th>
							    </tr>
							</thead>
							<tbody id = "horarioFormadoJueves">
							</tbody>
						</table>
						<row >
							<div id="campos3"><!-- INicio de lo que se duplica -->
								<div class="form-group  col-md-3 col-sm-3 ">
					      			<label for="select" class="control-label">Maestro:</label>
					      			<div >
					        			<select class="form-control" id="juevesselectProfesor0" required>
					        				@foreach($maestros as $maestro)
							       				<option value="{{$maestro->id}}">{{$maestro->primerNombre}}</option>
						          			@endforeach
					        			</select>
					       			</div>
					       		</div>

					       		<div class="form-group  col-md-3 col-sm-3">
					      			<label for="select" class="control-label">Clase:</label>
					      			<div class="">
					        			<select class="form-control" id="juevesselect0" required>
					        			</select>
					       			</div>
					       		</div>


					       		<div class="form-group  col-md-3 col-sm-3">
					      			<label for="select" class="control-label">Hora Inicio:</label>
					      			<div class="">
					        			<input class="form-control" type="text" id="jueveshorainicio0" name="horainicio" placeholder="12:00" required>
					       			</div>
					       		</div>

					       		<div class="form-group  col-md-3 col-sm-3">
					      			<label for="select" class="control-label">Hora Fin:</label>
					      			<div class="">
					        			<input class="form-control" type="text" id="jueveshorafinal0" name='horafinal' placeholder='12:00' required>
					       			</div>
					       		</div>

					       		<div>
					       			<br>
					       			<div style="text-align: center;">
										<button type="button" class="btn btn-danger  btn-lg" id="boton" style="text-align: center;" onclick="generarNueva('campos3', 'jueves', 3)">+</button>
									</div>
		       					</div>
					       		<br>
					       		<br>
						</row>
							<!-- Fin del Row-->
					</div>
						<!-- Fin del div que se duplica -->
					<br>
					<div style="text-align: center;">
						<span class="label label-default" >Todos los campos son necesarios.</span>
					</div>
					<br>
					<div style="text-align: center;">
						<button type="button"  onclick="guardarHorario('Jueves','jueves', 3)" class="btn btn-danger" id="boton">Guardar horario</button>
					</div>
		  		</div>
			</fieldset>
			<br>


			<fieldset>
				<div class="panel panel-warning ">
		  			<div class="panel-heading">
		    			<h3 class="panel-title">Viernes</h3>
		 			</div>

		  			<div class="panel-body">
						<table class="table table-striped table-hover ">
							<thead>
							    <tr  class="success">
							      <th>Maestro</th>
							      <th>Clase</th>
							      <th>Hora Inicio</th>
							      <th>Hora Fin</th>
							    </tr>
							</thead>
							<tbody id = "horarioFormadoViernes">
							</tbody>
						</table>
						<row >
							<div id="campos4"><!-- INicio de lo que se duplica -->
								<div class="form-group  col-md-3 col-sm-3 ">
					      			<label for="select" class="control-label">Maestro:</label>
					      			<div >
					        			<select class="form-control" id="viernesselectProfesor0" required>
					        				@foreach($maestros as $maestro)
							       				<option value="{{$maestro->id}}">{{$maestro->primerNombre}}</option>
						          			@endforeach
					        			</select>
					       			</div>
					       		</div>

					       		<div class="form-group  col-md-3 col-sm-3">
					      			<label for="select" class="control-label">Clase:</label>
					      			<div class="">
					        			<select class="form-control" id="viernesselect0" required>
					        			</select>
					       			</div>
					       		</div>


					       		<div class="form-group  col-md-3 col-sm-3">
					      			<label for="select" class="control-label">Hora Inicio:</label>
					      			<div class="">
					        			<input class="form-control" type="text" id="vierneshorainicio0" name="horainicio" placeholder="12:00" required>
					       			</div>
					       		</div>

					       		<div class="form-group  col-md-3 col-sm-3">
					      			<label for="select" class="control-label">Hora Fin:</label>
					      			<div class="">
					        			<input class="form-control" type="text" id="vierneshorafinal0" name='horafinal' placeholder='12:00' required>
					       			</div>
					       		</div>

					       		<div>
					       			<br>
					       			<div style="text-align: center;">
										<button type="button" class="btn btn-danger  btn-lg" id="boton" style="text-align: center;" onclick="generarNueva('campos4', 'viernes', 4)">+</button>
									</div>
		       					</div>
					       		<br>
					       		<br>
						</row>
							<!-- Fin del Row-->
					</div>
						<!-- Fin del div que se duplica -->
					<br>
					<div style="text-align: center;">
						<span class="label label-default" >Todos los campos son necesarios.</span>
					</div>
					<br>
					<div style="text-align: center;">
						<button type="button"  onclick="guardarHorario('Viernes','viernes' ,4)" class="btn btn-danger" id="boton">Guardar horario</button>
					</div>
		  		</div>
			</fieldset>
		</form>


	</div>

	</div>
</form>
<!-- Final form -->

@include('layout.scriptsLoad')


<script>
		var app = angular.module('myApp',  []);
		app.controller('horarioCtrl', function($scope, $http) {
			var information = $scope.information;
		  	$scope.findInfo = function(){
		  	console.log('Entrando a Angular');
		    $http.get("http://localhost:8000/traerInfo/" + $scope.selectedSeccion)
		    .success(function (response) {
		    	$scope.information = response;
		    });
		  	};

		  	$scope.findCurso = function(){
		  		console.log('Buscando curso');
		  		window.alert($scope.cursoId);
		  		$http.get("http://localhost:8000/buscarClase/" + $scope.cursoId)
		    	.success(function (response) {
		    	$scope.clases = response;
		    });
		  	};
		});
	</script>

<script>

var cursos;
var counter = [0,0,0,0,0];
	if ($(document).ready){
		$('#formularioBoton').hide();
		$('#formularioPanel').hide();
	}

	function showPanel(){

  $('#formularioPanel').show();
  $('#formularioBoton').show();
}

function guardarHorario(dia, name, index){
  for(var i = 0; i <= counter[index]; i++){
    var maestro = $("#"+name+"selectProfesor"+ i +" option:selected").text();
    var clase =  $("#"+name+"select"+ i +" option:selected").text();
    var horaInicioVar = $("#"+name+'horainicio'+i).val();
    var horaFinalVar = $("#"+name+'horafinal'+i).val();
    var idClaseVar = $("#"+name+'select'+i).val();
    var idMaestroVar = $("#"+name+'selectProfesor'+i).val();
    var idSeccionVar = $('#selectSeccion').val();
	var id = name + i;
	var idJornadaVar = $('#idJornadaSelected').val();
    var validacion = /^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/;
    if(!horaInicioVar || !horaFinalVar ){
    	alert("Llenar todos los campos");
    }
    if (!validacion.test(horaFinalVar) || !validacion.test(horaInicioVar))
    {
    	alert("Ingresar campos validos");
    }
    else{
			actualizarTablaHorario(horaInicioVar, horaFinalVar, clase, maestro, dia, id);
	    $.post("http://localhost/sigemn4/public/guardarHorario", {horaInicio: horaInicioVar, horaFin: horaFinalVar,
	    idClase: idClaseVar, idMaestro: idMaestroVar, idSeccion: idSeccionVar, diaClase: dia, idJornada: idJornadaVar}, function(data){

	    if (data=='ErrorHora') {
	    	alert("Exite un error en los horarios.");
	    	 	$('#'+id).remove();

	    };
	    if (data=='ErrorHoraJornada') {
	    	alert("Exite un error en los horarios no está dentro de la jornada");
	    	 	$('#'+id).remove();

	    };
	    if (data=='Duplicado') {
    		alert("Campos existentes en la base de datos.");
				$('#'+id).remove();
    	}
    	else{
				console.log('Guardado');
    	}

	    });

    }
  }
}

function actualizarTablaHorario(horaInicio, horaFin, clase, maestro, nombreDia, id){
    var html = "<tr id = \""+id+"\"><td>"+maestro+"</td><td>"+clase+"</td><td>"+horaInicio+"</td><td>"+horaFin+"</td><tr>"
    $('#horarioFormado'+nombreDia).append(html);
}

function showIdCurso(){
	var id = $('#idCurso').val();
	$.get("http://localhost/sigemn4/public/buscarClases/"+id, function(data){
     cursos = data;
		 for(var i = 0; i < data.length; i++){
		 	$("#lunesselect0").append($("<option></option>").val(data[i].claseId).html(data[i].nombre));
			$("#martesselect0").append($("<option></option>").val(data[i].claseId).html(data[i].nombre));
			$("#miercolesselect0").append($("<option></option>").val(data[i].claseId).html(data[i].nombre));
			$("#juevesselect0").append($("<option></option>").val(data[i].claseId).html(data[i].nombre));
			$("#viernesselect0").append($("<option></option>").val(data[i].claseId).html(data[i].nombre));
		 }
	});
	showPanel();
}

function agregarClases(field){
  for(var i = 0; i < cursos.length; i++){
   $("#"+field).append($("<option></option>").val(cursos[i].claseId).html(cursos[i].nombre));
  }
}

  function generarNueva(value, name, index){
    ++counter[index];
    var nombre = name + "select" + counter[index];
    var htmlCode = "";
    htmlCode += "<div class=\"form-group  col-md-3 col-sm-3 \"><label for=\"select\" class=\"control-label\">Maestro:</label><div><select class=\"form-control\" id=\"" + name + "selectProfesor"+counter[index]+"\" required>@foreach($maestros as $maestro)<option value=\"{{$maestro->id}}\">{{$maestro->primerNombre}}</option>@endforeach</select></div></div>";
    htmlCode += "<div class=\"form-group  col-md-3 col-sm-3\"><label for=\"select\" class=\"control-label\">Clase:</label><div class=\"\"><select class=\"form-control\" id=\""+ nombre +"\" required></select></div></div>";
    htmlCode += "<div class=\"form-group  col-md-3 col-sm-3\"><label for=\"select\" class=\"control-label\">Hora Inicio:</label><div class=\"\"><input class=\"form-control\" type=\"text\" id=\"" + name + "horainicio"+counter[index]+"\" name=\"horainicio\" placeholder=\"12:00\" required></div></div>";
    htmlCode += "<div class=\"form-group  col-md-3 col-sm-3\"><label for=\"select\" class=\"control-label\">Hora Fin:</label><div class=\"\"><input class=\"form-control\" type=\"text\" id=\"" + name + "horafinal"+counter[index]+"\" name=\"horafinal\" placeholder=\"12:00\" required></div></div>";
    htmlCode += "<div><br><div style=\"text-align: center;\"><button type=\"button\" class=\"btn btn-danger  btn-lg\" id=\"boton\" style=\"text-align: center;\" onclick=\"generarNueva('campos"+ index + "'" + ",'" + name + "'," + index + ")\">+</button></div></div><br><br>";
    $("#"+value).append(htmlCode);
    agregarClases(nombre);
  }
</script>
<script src="scripts/mostrar.js">
</script>

@stop
