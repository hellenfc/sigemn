
@extends('layout.menuActualizar')
@section('cuerpoPrincipalRegistro')


<form name="formulario" method="POST" action="modificarEstado">

  {!! csrf_field() !!}
<br><br>
<div class="col-md-offset-2 col-md-8">

  <div class="panel panel-warning"  >
    <div class="panel-heading">
      <h3 class="panel-title">Actualizar Estado</h3>
    </div> <br>
    <div class="panel-body">
      @if($errors->any())
      <div class="alert alert-danger">
        <p>Corrija los siguientes errores:</p>
        <ul>
          @foreach($errors->all() as $error)
          <li>{{error}}</li>
          @endforeach
        </ul>
      </div>
      @endif


      <div class="form-group">
        <div class="col-lg-4" >
          <label class="control-label" for="focusedInput">Escoja Numero de Identidad:</label>
        </div>
        <div class="col-lg-6">
          <!--<input class="form-control" id="txtBuscar" type="name" name="NoIdentidadBuscar" required pattern="([0-9]{4})-([0-9]{4})-([0-9]{5})" title="Buscar por Identidad">-->
          <select id="estudianteSelect" name="idEstudiante" class="form-control selectpicker" data-live-search="true">
            @foreach($estudiantes as $estudiante)
            <option value='{{$estudiante->id}}'>{{$estudiante->nroIdentidad}} | {{$estudiante->primerNombre}} {{$estudiante->primerApellido}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <br><br>
      <div class="form-group">
        <div class="col-lg-4" >
          <label class="control-label" for="focusedInput">Estado de pago:</label>
        </div>
        <div class="col-lg-6">
          <!--<input class="form-control" id="txtBuscar" type="name" name="NoIdentidadBuscar" required pattern="([0-9]{4})-([0-9]{4})-([0-9]{5})" title="Buscar por Identidad">-->
          <select id="pagos" name="nuevoEstado" class="form-control">
            <option value='Pagado'>Pagado</option>
            <option value='Pendiente'>Pendiente</option>
          </select>
        </div>
      </div>
      <br /><br />
      <div class="col-lg-12" style="text-align: center;">
        <button type="submit" class="btn btn-danger " style="text-align: center;">Actualizar</div>
        </div>
      </div>
</div>

</form>
@stop
