@extends('layout.menuCarga')
@section('cuerpoPrincipalCarga')

<form method="POST" action="guardarClase">
 <script src="scripts/mostrar.js"></script>
  {!! csrf_field() !!}
  <div ng-app="myApp" ng-controller="customersCtrl">
  <form class="form-horizontal">
    <fieldset>
    <br>
    <div class="col-md-offset-2 col-md-8">

      <div class="panel panel-warning" >
        <div class="panel-heading">
           <h3 class="panel-title">Crear Clase</h3>
        </div>

        <div class="panel-body">

          <div class="form-group">
            <!-- <div class="col-lg-6 col-md-11 col-sm-11 col-xs-10" > -->
              <label class="control-label" for="focusedInput">Nombre:</label>
            <!-- </div> -->
            <!-- <div class="col-lg-6 "> -->
              <input class="form-control" id="focusedInput" type="name" name="nombre" required pattern="^\D+[a-zA-Z_]{1,}\d*$" title="Solo se permiten minusculas y mayusculas.">
            <!-- </div> -->
          <!-- </div> -->
          <br>
          <div style="text-align: center;">
            <span class="label label-default" >Todos los campos son necesarios.</span>
          </div>
          <br>
          <div class="form-group">
            <div class="col-lg-12">
              <div style="text-align: center;">
                <button type="submit" class="btn btn-danger" id="boton">Guardar</button>
              </div>
             </div>
          </div>
          <div class="form-group">
              <row align="left">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                  <label class="control-label" for="focusedInput">Clases creadas:</label>
                  <ul class="list-group" <?php echo @count($clases)?>>
                    @foreach($clases as $clase)
                      <li class="list-group-item">
                           {{$clase->nombre}}
                      </li>
                    @endforeach
                  </ul>
                </div>
              </row>
            </div>
        </div>
      </div>
    </div>
    </fieldset>
  </form>
</div>
</form>
@stop
