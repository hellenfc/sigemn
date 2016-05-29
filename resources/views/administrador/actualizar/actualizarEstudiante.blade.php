@extends('layout.menuActualizar')
@section('cuerpoPrincipalRegistro')


<form name="formulario" method="POST" action="actualizarEstudiante">

  {!! csrf_field() !!}
<br><br>
<div class="col-md-offset-2 col-md-8">

  <div class="panel panel-warning"  >
    <div class="panel-heading">
      <h3 class="panel-title">Actualizar Estudiante</h3>
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
        <div class="col-lg-4">
          <!--<input class="form-control" id="txtBuscar" type="name" name="NoIdentidadBuscar" required pattern="([0-9]{4})-([0-9]{4})-([0-9]{5})" title="Buscar por Identidad">-->
          <select id="txtBuscar" class="form-control selectpicker" data-live-search="true">
            @foreach($estudiantes as $estudiante)
            <option value='{{$estudiante->nroIdentidad}}'>{{$estudiante->nroIdentidad}} | {{$estudiante->primerNombre}} {{$estudiante->primerApellido}}</option>
            @endforeach
          </select>
        </div>
        <br>
        <div class="col-lg-4">
          <input type="button" class="btn btn-info" <?php echo "onclick='actualizarInformacion($users, $cursos, $tutors);'" ?> value="Buscar"></button>
        </div>
      </div>

      <div class="row"></div>
      <br>

      <div class="form-group">
        <div class="col-lg-4">
          <label class="control-label" for="focusedInput">Primer Nombre:<spam style="color:red;">*</spam></label>
        </div>
        <div class="col-lg-6">
          <input class="form-control" id="focusedInput" type="name" name="pNombre" required pattern="\D+[a-zA-Z_]{1,}" title="Primer Nombre">
          <input type="hidden" name="id">
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
        <div class="col-lg-4" >
          <label class="control-label" for="focusedInput">Número de Identidad:<spam style="color:red;">*</spam></label>
        </div>
        <div class="col-lg-6">
          <input class="form-control" id="focusedInput" type="name" name="noIdentidad" required pattern="([0-9]{4})-([0-9]{4})-([0-9]{5})" title="No de identidad" placeholder="Ejemplo: 0801-1980-08023">
          <br>
        </div>
      </div>

      <div class="form-group">
        <div class="col-lg-4" >
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
          Mes: <select title="Mes" name="fechaMes" id="selectMes" onchange="ponerDias();">
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
          Año: <select title="Año" name="fechaAnio" id="selectAnio">

          </select>
          <br>
        </div>
      </div>
      <br>
      <div class="row"></div>
      <br>
      <div class="form-group">
        <div class="col-lg-4" >
          <label class="control-label" for="focusedInput">Padecimiento:<spam style="color:red;">*</spam></label>
        </div>
        <div class="col-lg-6">
          <!--<input class="form-control" id="focusedInput" type="name" name="padecimiento" requerid>-->
          <label class="col-lg-5"><input class="chkPadecimiento" type="checkbox" name="p_anemia">Anemia</label>
          <label class="col-lg-5"><input class="chkPadecimiento" type="checkbox" name="p_gastritis">Gastritis</label>
          <label class="col-lg-5"><input class="chkPadecimiento" type="checkbox" name="p_asma">Asma</label>
          <label class="col-lg-5"><input class="chkPadecimiento" type="checkbox" name="p_diabetes">Diabetes</label>
          <label class="col-lg-5"><input class="chkPadecimiento" type="checkbox" name="p_bronquitis">Bronquitis</label>
          <label class="col-lg-5"><input class="chkPadecimiento" type="checkbox" name="p_estrenimiento">Estreñimiento</label>
          <label class="col-lg-5"><input class="chkPadecimiento" type="checkbox" name="p_colitis">Colitis</label>
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
          <select  id="usuarioTutor" type="name" name="usuarioTutor" class="selectpicker" data-live-search="true">
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
        <div class="col-lg-4" >
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
      <div class="col-lg-12" style="text-align: center;">
        <button id="btnActualizar" type="submit" class="btn btn-danger">Actualizar:</button>
      </div>
</div>
</form>
  </div>
</div>
@stop

@section('script')
<script type="text/javascript">
  (function(){
      var anio = document.getElementById("selectAnio");
      var htmlAnio = "";
      for(i=1970; i<=2010; i++)
          htmlAnio = htmlAnio + "<option>"+i+"</option>";
      anio.innerHTML = htmlAnio;
      ponerDias();

      deshab();
  })();

  function deshab() {
    //frm = document.forms['formulario'];
    //for(i=3; ele=frm.elements[i]; i++)
      //ele.disabled=true;
    var frm = document.getElementsByClassName("form-control");
    document.getElementById("btnActualizar").disabled=true;
    for(i=1; i<frm.length; i++){
      frm[i].disabled = true;
    }
  }

  function hab() {
   // frm = document.forms['formulario'];
    //for(i=3; ele=frm.elements[i]; i++)
     // ele.disabled=false;
    //document.getElementsByName("usuarioTutor")[0].disabled = false;
    var frm = document.getElementsByClassName("form-control");
    document.getElementById("btnActualizar").disabled=false;
    for(i=1; i<frm.length; i++){
      frm[i].disabled = false;
    }
  }


  /*$(document).ready(function(){
    alert("hola");
  });*/

  function ponerDias(){
    var diaAnterior = document.getElementById("selectDia").value;
    var mes = document.getElementById("selectMes").value;
    var selectDia = document.getElementById("selectDia");
    var htmlDia = '';
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
        for(i=1; i<=29; i++)
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

  function actualizarInformacion(users, cursos, tutors){

      var url = 'obtenerEstudiante';

      //obteniendo cada uno de los controles para llenarlos
      var noIdentidad = document.getElementById("txtBuscar").value;
      var iId = document.getElementsByName('id')[0];
      var ipNombre = document.getElementsByName('pNombre')[0];
      var isNombre = document.getElementsByName('sNombre')[0];
      var ipApellido = document.getElementsByName('pApellido')[0];
      var isApellido = document.getElementsByName('sApellido')[0];
      var inoIdentidad = document.getElementsByName('noIdentidad')[0];
      var icorreo = document.getElementsByName('correo')[0];
      var idireccion = document.getElementsByName('direccion')[0];
      var itelefono = document.getElementsByName('telefono')[0];
      var itipoSangre = document.getElementsByName('tipoSangre')[0];
      var ifechaDia = document.getElementById('selectDia');
      var ifechaMes = document.getElementsByName('fechaMes')[0];
      var ifechaAnio = document.getElementsByName('fechaAnio')[0];
      var ipadecimientos = document.getElementsByClassName('chkPadecimiento');
      var ipOtro = document.getElementsByName('p_otros')[0];
      var igenero = document.getElementsByName('genero')[0];
      var iusuarioTutor = document.getElementsByName('usuarioTutor')[0];
      var icurso = document.getElementsByName('curso')[0];
      var ipago = document.getElementsByName('pago')[0];


      //haciendo un get a url enviandole el noIdentidad
      //para obtener el estudiante con los datos completos
      $.get(url,
          {'noIdentidad': noIdentidad},
          function(data){

              //alert(data);
              //parseando la data que recogemos
              dataJ = JSON.parse(data);


              //obteniendo el usuario del tutor del estudiante
              var user = '';
              for(i=0; i< tutors.length; i++){
                  if(tutors[i].id==dataJ[0].idTutor){
                      for(j=0; j< users.length; j++){
                          if(users[j].id==tutors[i].user_id){
                              user = users[j].userName;
                              break;
                          }
                      }
                      break;
                  }
              }


              //obteniendo el curso del estudiante
              var curso = '';
              for(i=0; i< cursos.length; i++){
                  if(cursos[i].id==dataJ[0].idCurso){
                    curso = cursos[i].nombre;
                    break;
                  }
              }

              //asignando el valor a cada control del formulario
              //con la data que se obtuvo
              iId.value = dataJ[0].id;
              //alert("iId.value");
              ipNombre.value = dataJ[0].primerNombre;
              isNombre.value = dataJ[0].segundoNombre;
              ipApellido.value = dataJ[0].primerApellido;
              isApellido.value = dataJ[0].segundoApellido;
              inoIdentidad.value = dataJ[0].nroIdentidad;
              icorreo.value = dataJ[0].correo;
              idireccion.value = dataJ[0].direccion;
              itelefono.value = dataJ[0].telefono;
              itipoSangre.value = dataJ[0].tipoSangre;
              igenero.value = dataJ[0].genero;
              //alert(iusuarioTutor.value);
              //alert(user);
              iusuarioTutor.value = user;
              $("#usuarioTutor").selectpicker('val', user);
              //alert(iusuarioTutor.value);
              icurso.value = curso;
              ipago.value = dataJ[0].pago;

              //llenando los combobox de fecha
              var fecha = dataJ[0].fechaNacimiento;
              var fechaArray = fecha.split("-");
              ifechaAnio.value = fechaArray[0];
              //alert(ifechaDia.value);
              //alert(fechaArray[2]);
              ifechaDia.value = parseInt(fechaArray[2]);
              //alert(ifechaDia.value);
              ifechaMes.value = fechaArray[1];

              //llenando los checkbox
              var padecimientos = dataJ[0].padecimiento;
              var padecimientosArray = padecimientos.split(",");

              for(i=0; i<ipadecimientos.length; i++){
                  ipadecimientos[i].checked = false;
              }
              ipOtro.value="";

              for(i=0; i<padecimientosArray.length; i++){
                  switch(padecimientosArray[i]){
                    case 'anemia':
                      ipadecimientos[0].checked = true;
                      break;
                    case 'gastritis':
                      ipadecimientos[1].checked = true;
                      break;
                    case 'asma':
                      ipadecimientos[2].checked = true;
                      break;
                    case 'diabetes':
                      ipadecimientos[3].checked = true;
                      break;
                    case 'bronquitis':
                      ipadecimientos[4].checked = true;
                      break;
                    case 'estrenimiento':
                      ipadecimientos[5].checked = true;
                      break;
                    case 'colitis':
                      ipadecimientos[6].checked = true;
                      break;
                    default:
                      ipOtro.value += padecimientosArray[i] + ",";
                      break;
                  }
              }
              hab();
          }
      );
  }


</script>
@stop
