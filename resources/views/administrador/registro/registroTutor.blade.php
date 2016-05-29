@extends('layout.menuRegistro')
@section('cuerpoPrincipalRegistro')

<form method="POST" action="registroTutor">

  {!! csrf_field() !!}
<br>
<div class="col-md-offset-2 col-md-8">
  <div class="panel panel-warning"  >
    <div class="panel-heading" >
      <h3 class="panel-title">Registrar Tutor</h3>
    </div>
    <br>
    <div class="panel-body">
      <div class="form-group">

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
            <label class="control-label" for="focusedInput" >Usuario:<spam style="color:red;">*</spam></label>
          </div>
          <div class="col-lg-6">
            <input class="form-control" id="focusedInput" type="text" name="usuario" required pattern="\D+[a-zA-Z_]{1,}" title="Solo se permiten minusculas, mayusculas y _">
            <br>
          </div>
        </div>
        <div class="form-group">
          <div class="col-lg-4" >
            <label class="control-label" for="focusedInput">Contraseña:<spam style="color:red;">*</spam></label>
          </div>
          <div class="col-lg-6">
            <input class="form-control" id="focusedInput" type="password" name=pass required/>
            <br>
          </div>
        </div>
        <div class="col-lg-4" >
          <label class="control-label" for="focusedInput">Primer Nombre:<spam style="color:red;">*</spam></label>
        </div>
        <div class="col-lg-6">
          <input class="form-control" id="focusedInput" type="name" name="pNombre" required pattern="\D+[a-zA-Z_]{1,}" title="Nombre mal formado">
          <br>
        </div>
      </div>

      <div class="form-group">
        <div class="col-lg-4" >
          <label class="control-label" for="focusedInput">Segundo Nombre:</label>
        </div>
        <div class="col-lg-6">
          <input class="form-control" id="focusedInput" type="name" name="sNombre" pattern="\D+[a-zA-Z_]{0,}" title="Nombre mal formado">
          <br>
        </div>
      </div>

      <div class="form-group">
        <div class="col-lg-4" >
          <label class="control-label" for="focusedInput">Primer Apellido:<spam style="color:red;">*</spam></label>
        </div>
        <div class="col-lg-6">
          <input class="form-control" id="focusedInput" type="name" name="pApellido" required pattern="\D+[a-zA-Z_]{1,}" title="Apellido mal formado">
          <br>
        </div>
      </div>

      <div class="form-group">
        <div class="col-lg-4" >
          <label class="control-label" for="focusedInput">Segundo Apellido:</label>
        </div>
        <div class="col-lg-6">
          <input class="form-control" id="focusedInput" type="name" name="sApellido" pattern="\D+[a-zA-Z_]{0,}" title="Apellido mal formado">
          <br>
        </div>
      </div>

      <div class="form-group">
        <div class="col-lg-4">
          <label class="control-label" for="focusedInput">Número de Identidad:<spam style="color:red;">*</spam></label>
        </div>
        <div class="col-lg-6">
          <input class="form-control" id="focusedInput" type="name" name="noIdentidad" required pattern="([0-9]{4})-([0-9]{4})-([0-9]{5})" title="No de identidad mal formado" placeholder="Ejemplo: 0801-1980-08023">
          <br>
        </div>
      </div>

      <div class="form-group">
        <div class="col-lg-4">
          <label class="control-label" for="focusedInput">Correo Electrónico:</label>
        </div>
        <div class="col-lg-6">
          <input class="form-control" id="focusedInput" type="text" name="correo" pattern="^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})" placeholder="Ejemplo: juan@dominio.com" title="Correo Electronico">
          <br>
        </div>
      </div>

      <div class="form-group">
        <div class="col-lg-4" >
          <label class="control-label" for="focusedInput">Dirección:<spam style="color:red;">*</spam></label>
        </div>
        <div class="col-lg-6">
          <input class="form-control" id="focusedInput" type="name" name="direccion" required>
          <br>
        </div>
      </div>

      <div class="form-group">
        <div class="col-lg-4" >
          <label class="control-label" for="focusedInput">Teléfono:<spam style="color:red;">*</spam></label>
        </div>
        <div class="col-lg-6">
          <input class="form-control" id="focusedInput" type="number" name="telefono" required patter="[0-9]{8}" placeholder="Ejemplo: 22678300" title="No telefonico incorrecto">
          <br>
        </div>
      </div>

      <div class="col-lg-12" style="text-align: center;">
        <button type="submit" class="btn btn-danger" style="text-align: center;">Registrar</button>
      </div>

</div>
</div>
</div>
</form>

@stop
