@extends('layout.layout') <!--Extiende de layout-->
@section('cuerpo') <!--Va en la seccion donde dice cuerpo-->

<form method="POST" action="">
  {!! csrf_field()!!}

  <script src="scripts/mostrar.js"></script>
  <br>
  <div ng-app="myApp" ng-controller="customersCtrl">
    <form class="form-horizontal">
      <fieldset>
        <div class="panel panel-primary" >
          <div class="panel-heading" >
             <h3 class="panel-title">Matricula</h3>
          </div>
          <div class="panel-body">
            <div class="form-group">

              <row>
                <div >
                  <label class="control-label" for="focusedInput">Estudiante:</label>
                  <select class="form-control" id="estudianteSelect" ng-change= "findInfoEstu()" ng-model="selectedEstudiante" >
                    @if (Auth::check())
                      @foreach($estudiantes as $estudiante)
                        <option value="{{$estudiante->id}}">{{$estudiante->primerNombre}}</option>
                      @endforeach
                    @endif
                  </select>
                </div>
              </row>
              <br>

              <row>
                <button type="button" class="btn btn-primary" onclick="showSelectOption(), desplegarMatricula()"id="seleccionarEstudiante">Seleccionar</button>
              </row>
              <br><br>
              <row>
                <div class="well" ng-repeat="x in information"  id = "formularioBoton">
                  <p class="text-primary" >Estudiante: @{{x.primerNombre}} @{{x.primerApellido}}  </p>
                  <p class="text-primary" >Curso: @{{x.nombreCurso}}</p>
                   <input id="idCursoEstudiante" type="hidden" value="@{{x.idCurso}}"/>
                </div>
              </row>
              <br>

              <row>

                <div ng-repeat="x in information" id="jornadasShow">
                  <label class="control-label" for="focusedInput">Jornada:</label>
                  <select class="form-control" onchange="cargarSecciones()" id="jornadasSelect" required>

                      <option>

                      </option>
                    @foreach($jornadas as $jornada)
                      <option value="{{$jornada->id}}">{{$jornada->nombre}}</option>
                    @endforeach
                  </select>
                </div>
              </row>
              <br>

              <!-- <row>
                <select class="form-control" onchange="cargarSecciones()" id="cursosSelect" required>
                </select>
              </row>
              <br> -->
              <div id="seccionesShow">

                <row>
                  <label class="control-label" for="focusedInput">Seccion:</label>

                  <select class="form-control" onchange="mostrarInformacionSeccion()" id="seccionesSelect" required>
                    <option>

                    </option>
                  </select>
                </row>
                <br>
                <div id="botonShow">
                    <row >
                      <div>
                        <div class="well" id="informacionSeccion">
                        </div>
                      </div>

                    </row>
                  </div>
                  <br>

                  <div style="text-align: center;">
                    <button type="button" class="btn btn-info" id="botonMatricula"  onclick="matricular()">Matricular</button>
                  </div>                  
                </div>
            </div>
          </div>
        </div>
      <fieldset>
    </form>
  </div>
</form>
@include('layout.scriptsLoad')
<script>

if ($(document).ready){
      $('#formularioBoton').hide();
    }

if ($(document).ready){
  $('#desplegarEstudiante').hide();
  $('#jornadasShow').hide();
  $('#cursosSelect').hide();
  $('#seccionesShow').hide();
  $('#botonShow').hide();
}

var app = angular.module('myApp',  []);
    app.controller('customersCtrl', function($scope, $http) {
        $scope.findInfoEstu = function(){
        console.log('Entrando a Angular');
        $http.get("http://localhost:8000/obtenerInformacionEstudiando/" + $scope.selectedEstudiante)
        .success(function (response) {$scope.information = response;});
        };
    });

    function desplegarMatricula(){
      $('#jornadasShow').show();
    }


  function cargarSecciones(){
//Debe llevar como id el del curso y de la jornada .
$('#seccionesSelect')
    .find('div')
    .remove()
    .end()
;
    var idJornada = $('#jornadasSelect').val();
    var idCurso = $('#idCursoEstudiante').val();
    $('#seccionesShow').show();
    $('#botonShow').show();
    $.post('http://localhost:8000/cargarSecciones/',{idJornada:idJornada, idCurso:idCurso}, function(data){
      for(var i = 0; i < data.length; i++){
        $("#seccionesSelect").append($("<option></option>").val(data[i].id).html(data[i].nombre));
      }
    });
  }

  function mostrarInformacionSeccion(){
    var id = $('#seccionesSelect').val();
    var idWell = "desplegarSeccionInformacion";
    $('#' + idWell).remove();
    $.get('http://localhost:8000/cargarSeccion/' + id, function(data){
      var html = "<div id =\"" + idWell + "\">";
      html += "Cupos: " + data.cupos + "<br>";
      html += "Aula: " + data.aula + "<br>";
      html += "</div>";
      $('#informacionSeccion').append(html);

    });
  }

  function matricular(){
    var idEstudiante = $('#estudianteSelect').val();
    var idSeccion = $('#seccionesSelect').val();
    $.post('http://localhost:8000/insertarMatricula', {idEstudiante : idEstudiante,idSeccion : idSeccion}, function(response){
      if(response == "error"){
        alert('No hay cupos disponibles en esa sección');
      }else{
        alert('Alumno Matriculado');
        console.log('Matriculado');
      }

    })
  }


</script>
@stop
