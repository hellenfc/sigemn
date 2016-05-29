@extends('layout.menuCarga')
@section('cuerpoPrincipalCarga')

<form method="POST" action="guardarJornada">
  <script src="scripts/mostrar.js"></script>
   {!! csrf_field() !!}
   <div ng-app="myApp" ng-controller="customersCtrl">
  <form class="form-horizontal">
    <fieldset>
      <br>
      <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-warning " >
        <div class="panel-heading">
          <h3 class="panel-title">Crear Jornada</h3>
        </div>
        <div class="panel-body">

            <div class="form-group">
              <!-- <div class="col-lg-1" > -->
                <label class="control-label" for="focusedInput">Nombre:</label>
              <!-- </div>
              <div class="col-lg-11"> -->
                <input class="form-control" id="focusedInput" type="name" name="nombre" pattern="^\D+[a-zA-Z_]{1,}\d*$" title="Solo se permiten minusculas y mayusculas.">
              <!-- </div> -->
            </div>
            <div class="form-group">
              <!-- <row> -->
                <br>
                <!-- <div class="col-lg-4" > -->
                  <label class="control-label" for="focusedInput">Hora Inicio:</label>
                <!-- </div> -->
                <br>
                <row>
                  <div class="col-lg-3 col-md-2 col-sm-2 col-xs-5" >
                  <input class="form-control" type="number"min="0" max="23" name='horai' placeholder="00" required  >
                </div>

                <div class="col-lg-3 col-md-2 col-sm-2 col-xs-5" >
                  <input class="form-control" type="number"min="0" max="59" name='mini' placeholder="00" required >
                </div>
              </row>
              <!-- </row> -->
            </div>
            <br><br>
            <div class="form-group">
              <!-- <row> -->
                <!-- <div class="col-lg-4"> -->
                  <label class="control-label" for="focusedInput">Hora Final:</label>
                <!-- </div> -->
                <br />
                <div class="col-lg-3 col-md-2 col-sm-2 col-xs-5" style="margin:0px;">
                  <input class="form-control" type="number"min="0" max="23"  name='horaf' placeholder="00" required  >
                </div>
                <div class="col-lg-3 col-md-2 col-sm-2 col-xs-5">
                  <input class="form-control" type="number"min="0" max="59"  name='minf' placeholder="00" required >
                </div>
              <!-- </row> -->
            </div>
            <br>

            <!-- <div class="form-group" >
                <div align="center" >
                  <textarea  readonly rows=<?php /*echo @count*/($jornadas)?> >
                    @foreach($jornadas as $jornada)
                      {{$jornada->nombre}}
                    @endforeach
                  </textarea>
                </div>
            </div> -->
            <br>
            <div style="text-align: center;">
              <span class="label label-default" >Todos los campos son necesarios.</span>
            </div>
            <br>
            <div class="form-group">
              <row>
                <!-- <div class="col-lg-10"> -->
                  <div style="text-align: center;">
                    <button type="submit" class="btn btn-danger" id="boton" onclick="validar()">Guardar</button>
                  </div>
                <!-- </div> -->
              </row>
            </div>
            <br>

            <div >
              <row align="left">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <label class="control-label" for="focusedInput">Jornadas creadas:</label>
                  <ul class="list-group" <?php echo @count($jornadas)?>>
                    @foreach($jornadas as $jornada)
                      <li class="list-group-item">
                            {{$jornada->nombre}}
                      </li>
                    @endforeach
                  </ul>
                </div>
                <br>
              </row>
            </div>

          </div>
        </div>
      </fieldset>

      </div>
  </form>
</div>

</form>
@include('layout.scriptsLoad')


 <script src="jquery/jquery.min.js"></script>

@stop
