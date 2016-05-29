@extends('layout.menuCarga')
@section('cuerpoPrincipalCarga')
<form method="POST" action="guardarSeccion">

  {!! csrf_field() !!}

	<script src="scripts/mostrar.js"></script>

	<br>
  <div class="col-md-offset-2 col-md-8">

    <div ng-app="myApp" ng-controller="seccCtrl" ng-init="findJornadas()">
      <form class="form-horizontal">
        <fieldset>
          <div class="panel panel-warning" >
            <div class="panel-heading" >
              <h3 class="panel-title">Crear Sección</h3>
            </div>
            <div class="panel-body">

              <div class="form-group">
                <label class="control-label" for="focusedInput">Nombre</label>
                <input class="form-control" id="nombre" type="text" name='nombre'  placeholder="Seccion A " required pattern="^\D+[a-zA-Z_]{1,}\d*$" title="Solo se permiten minusculas y mayusculas.">
              </div>

              <div class="form-group">
                <label for="select" class="control-label">Jornada</label>
                <select  name="jornadaId" class="form-control" onchange="showSelectOption()" id="jornada" ng-change= "findCursos()" ng-model="selectedJornada"  required >
                  <!-- <option ng-repeat="x in jor" value="@{{x.id}}">
                  @{{x.nombre}}
                </option> -->
                @foreach($jornadas as $jornada)
                <option value="{{$jornada->id}}" >{{$jornada->nombre}}</option>
                @endforeach
              </select>
            </div>

            <div  id = "formularioBoton">
              <div class="form-group" >
                <label for="select"  class="control-label">Curso</label>

                <select  class="form-control" name='curso' >
                  <option ng-repeat="x in names" value="@{{x.id}} " >
                    @{{x.nombre}}
                  </option>
                </select>

              </div>

              <div class="form-group">
                <label class="control-label">Cupos</label>
                <div>
                  <input class="form-control" type="number"min="1" max="100"  id="cupo" name='cupos' required >
                </div>
              </div>

              <div class="form-group">
                <label class="control-label" for="focusedInput">Aula</label>
                <input class="form-control" id="focusedInput" type="text" id="aula" name='aula' required>
              </div>
              <div style="text-align: center;">
                <span class="label label-default" >Todos los campos son necesarios.</span>
              </div>
              <br>
              <div style="text-align: center;">
                <button type="submit" class="btn btn-danger" id="boton">Guardar</button>
              </div>

            </div>
          </div>
        </div>
      </fieldset>
    </form>


  </div>
  </div>

	@include('layout.scriptsLoad')

	<script>
		var app = angular.module('myApp',  []);
		app.controller('seccCtrl', function($scope, $http) {
		  	$scope.findCursos = function(){
		  	console.log('Entrando a Angular');
		    $http.get("http://localhost:8000/cursos/" + $scope.selectedJornada)
		    .success(function (response) {$scope.names = response;});
		  	};

		  	// $scope.findJornadas = function(){
		  	// console.log('Busacando Jornadas');
		    // $http.get("/traerJornada")
		    // .success(function (response) {$scope.jor = response;});
		  	// };
		});
	</script>

	<script>
	  if ($(document).ready){
	    $('#formularioBoton').hide();
	  }
	</script>

@stop
