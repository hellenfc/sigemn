@extends('layout.menuRegistro')
@section('cuerpoPrincipalRegistro')

<form method="POST" action="registroEstudiante">

  {!! csrf_field() !!}
<br>
<div class="col-md-offset-2 col-md-8">
  <div class="panel panel-warning" >
    <div class="panel-heading">
      <h3 class="panel-title">Registrar Estudiantes</h3>
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
          <label class="control-label" for="focusedInput">Primer Nombre:<spam style="color:red;">*</spam></label>
        </div>
        <div class="col-lg-6">
          <input class="form-control" id="focusedInput" type="name" name="pNombre" required pattern="\D+[a-zA-Z_]{1,}" title="Primer Nombre">
          <br>
        </div>
      </div>

      <div class="form-group">
        <div class="col-lg-4" >
          <label class="control-label" for="focusedInput">Segundo Nombre:</label>
        </div>
        <div class="col-lg-6">
          <input class="form-control" id="focusedInput" type="name" name="sNombre" pattern="\D+[a-zA-Z_]{0,}" title="Segundo Nombre">
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
          <input class="form-control" id="focusedInput" type="name" name="noIdentidad" required pattern="([0-9]{4})-([0-9]{4})-([0-9]{5})" title="No de identidad" placeholder="Ejemplo: 0801-1980-08023">
          <br>
        </div>
      </div>

      <div class="form-group">
        <div class="col-lg-4">
          <label class="control-label" for="focusedInput">Correo Electrónico:</label>
        </div>
        <div class="col-lg-6">
          <input class="form-control" id="focusedInput" type="text" name="correo" pattern="^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})" placeholder="Ejemplo: juan@dominio.com" title="Correo incorrecto">
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


      <div class="form-group">
        <div class="col-lg-4" >
          <label class="control-label" for="focusedInput">Tipo de Sangre:<spam style="color:red;">*</spam></label>
        </div>
        <div class="col-lg-6">
          <input class="form-control" id="focusedInput" type="name" name="tipoSangre" required>
          <br>
        </div>
      </div>

      <div class="form-group">
        <div class="col-lg-4" >
          <label class="control-label" for="focusedInput">Fecha de Nacimiento:<spam style="color:red;">*</spam></label>
        </div>
        <div class="col-lg-6" class="form-control">
          <!--<input class="form-control" id="focusedInput" type="name" name="fechaNac" required pattern="([0-9]{4})\/((0[1-9]{1})|(1[0-2]{1}))\/((0[1-9])|([1-2][0-9])|(3[0-1]))" title="Fecha de Nacimiento" placeholder="AAAA/MM/DD">-->
          Dia: <select title="Dia" name="fechaDia" id="selectDia">

          </select>
          Mes: <select title="Dia" name="fechaMes" id="selectMes" onchange="ponerDias();">
            <option>01</option>
            <option>02</option>
            <option>03</option>
            <option>04</option>
            <option>05</option>
            <option>06</option>
            <option>07</option>
            <option>08</option>
            <option>09</option>
            <option>10</option>
            <option>11</option>
            <option>12</option>
          </select>
          Año: <select title="Dia" name="fechaAnio" id="selectAnio">

          </select>
          <br>
        </div>
      </div>
      <br>
      <div class="row"></div>
      <br>
      <div class="form-group">
        <div class="col-lg-4">
          <label class="control-label" for="focusedInput">Padecimiento:<spam style="color:red;">*</spam></label>
        </div>
        <div class="col-lg-6">
          <!--<input class="form-control" id="focusedInput" type="name" name="padecimiento" requerid>-->
          <label class="col-lg-5"><input type="checkbox" name="p_anemia">Anemia</label>
          <label class="col-lg-5"><input type="checkbox" name="p_gastritis">Gastritis</label>
          <label class="col-lg-5"><input type="checkbox" name="p_asma">Asma</label>
          <label class="col-lg-5"><input type="checkbox" name="p_diabetes">Diabetes</label>
          <label class="col-lg-5"><input type="checkbox" name="p_bronquitis">Bronquitis</label>
          <label class="col-lg-5"><input type="checkbox" name="p_estrenimiento">Estreñimiento</label>
          <label class="col-lg-5"><input type="checkbox" name="p_colitis">Colitis</label>
          <label class="col-lg-5">Otros: <input type="textbox" name="p_otros"></label>
          <br>
        </div>
      </div>
      <div class="row"></div>
      <br>

      <div class="form-group">
        <div class="col-lg-4" >
          <label class="control-label" for="focusedInput">Género:<spam style="color:red;">*</spam></label>
        </div>
        <div class="col-lg-6">
          <select class="form-control" id="focusedInput" type="name" name="genero" required>
            <option>Masculino</option>
            <option>Femenino</option>
          </select>
          <br>
        </div>
      </div>

      <div class="form-group">
        <div class="col-lg-4" >
          <label class="control-label" for="focusedInput">Usuario del Tutor:<spam style="color:red;">*</spam></label>
        </div>
        <div class="col-lg-6">
          <select class="form-control selectpicker" id="lunch" type="name" name="usuarioTutor"  data-live-search="true">
            @foreach($users as $user)
            <option>{{$user->userName}}</option>
            @endforeach
          </select>
          <br>
        </div>
      </div>
      <div class="row"></div>
      <br>

      <div class="form-group">
        <div class="col-lg-4">
          <label class="control-label" for="focusedInput">Curso:<spam style="color:red;">*</spam></label>
        </div>
        <div class="col-lg-6">
          <!--<input class="form-control" id="focusedInput" type="name" name="curso" requerid>-->
          <select class="form-control" id="focusedInput" type="name" name="curso">
            @foreach($cursos as $curso)
            <option>{{$curso->nombre}}</option>
            @endforeach
          </select>
          <br>
        </div>
      </div>

      <div class="form-group">
        <div class="col-lg-4" >
          <label class="control-label" for="focusedInput">Pago:<spam style="color:red;">*</spam></label>
        </div>
        <div class="col-lg-6">
          <!--<input class="form-control" id="focusedInput" type="name" name="pago" required patter="^[0-9]+(.[0-9])
          " placeholder="Ejemplo: 225.00" title="Numeracion incorrecta">-->
          <select name="pago" class="form-control">
            <option value="pagado">Pagado</option>
            <option value="pendiente">Pendiente</option>
          </select>
          <br>
        </div>
      </div>

      <br>
      <div class="col-lg-12 " style="text-align: center;" >
        <button type="submit" class="btn btn-danger">Registrar</button>
      </div>

</div>
</form>
  </div>
</div>
<script type="text/javascript">
  (function(){
      //alert("Hola");
      var anio = document.getElementById("selectAnio");
      var htmlAnio = "";
      for(i=1970; i<=2010; i++)
          htmlAnio = htmlAnio + "<option>"+i+"</option>";
      anio.innerHTML = htmlAnio;
      ponerDias();
  })();

  function ponerDias(){
    var diaAnterior = document.getElementById("selectDia").value;
    var mes = document.getElementById("selectMes").value;
    var selectDia = document.getElementById("selectDia");
    var htmlDia = '';
    //alert(mes);
    switch(mes){
      case '01':
      case '03':
      case '05':
      case '07':
      case '08':
      case '10':
      case '12':
        for(i=1; i<=31; i++)
          htmlDia = htmlDia + "<option>"+i+"</option>";
        break;
      case '02':
        for(i=1; i<=28; i++)
          htmlDia = htmlDia + "<option>"+i+"</option>";
        break;
      default:
        for(i=1; i<=30; i++)
          htmlDia = htmlDia + "<option>"+i+"</option>";
        break;

    }
    selectDia.innerHTML = htmlDia;
    selectDia.value = diaAnterior;
  }
</script>
@stop
