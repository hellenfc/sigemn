
@extends('layout.layout') <!--Extiende de layout-->
@section('cuerpo') <!--Va en la seccion donde dice cuerpo-->


<form name="formulario" method="POST" action="guardarNotas">

  {!! csrf_field() !!}


  <br><br>
  <div class="panel panel-warning"  >
  <div class="panel-heading">
    <h3 class="panel-title">Ingresar Notas</h3>
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
    <label class="control-label" for="focusedInput">Secciones <spam style="color:red;">*</spam></label>
    </div>
    <div class="col-lg-6">
      <select class="form-control" id="focusedInput" type="name" name="seccion" onchange="cambiarClases();">
        @foreach($cursos as $curso)
          @foreach($seccions as $seccion)
            @if($curso->id==$seccion->idCurso)
            <option value="{{$seccion->id}}">{{$curso->nombre}} : {{$seccion->nombre}}</option>
            @endif  
          @endforeach
        @endforeach
      </select>
      <br>
    </div>
  </div>


<div class="form-group">
    <div class="col-lg-4" >
    <label class="control-label" for="focusedInput">Clases <spam style="color:red;">*</spam></label>
    </div>
    <div class="col-lg-6">
      <select class="form-control" id="focusedInput" type="name" name="clases">
      <!--Aqui se insertaran las clases de la seccion seleccionada-->
      </select>
      <br>
    </div>
  </div>


		

  


    <style type="text/css">

      .datagrid table { border-collapse: collapse; text-align: left; width: 100%; } 
      .datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; border: 1px solid #006699; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }
      .datagrid table td, .datagrid table th { padding: 3px 10px; }
      .datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; color:#FFFFFF; font-size: 15px; font-weight: bold; border-left: 1px solid #0070A8; } 
      .datagrid table thead th:first-child { border: none; }
      .datagrid table tbody td { color: #00496B; border-left: 1px solid #E1EEF4;font-size: 12px;font-weight: normal; }
      .datagrid table tbody .alt td { background: #E1EEF4; color: #00496B; }
      .datagrid table tbody td:first-child { border-left: none; }
      .datagrid table tbody tr:last-child td { border-bottom: none; }
      .datagrid table tfoot td div { border-top: 1px solid #006699;background: #E1EEF4;} 
      .datagrid table tfoot td { padding: 0; font-size: 12px } 
      .datagrid table tfoot td div{ padding: 2px; }
      .datagrid table tfoot td ul { margin: 0; padding:0; list-style: none; text-align: right; }
      .datagrid table tfoot  li { display: inline; }
      .datagrid table tfoot li a { text-decoration: none; display: inline-block;  padding: 2px 8px; margin: 1px;color: #FFFFFF;border: 1px solid #006699;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; }
      .datagrid table tfoot ul.active, .datagrid table tfoot ul a:hover { text-decoration: none;border-color: #006699; color: #FFFFFF; background: none; background-color:#00557F;}
      div.dhtmlx_window_active, div.dhx_modal_cover_dv { position: fixed !important; }

    </style>
 	<!--luego llenar la tabla con los estudiantes de sa seccion-->

  <div class="row"></div>
  <br>

  
	<div class="form-group datagrid">
		<table>
			<thead>
				<th>Nombre</th>
				<th>Parcial I</th>
				<th>Parcial II</th>
				<th>Parcial III</th>
				<th>Parcial IV</th>
			</thead>
			<tbody name="tblEstudiantes"> 
			<!--aqui va el for para llenar los datos-->
			
			</tbody>
		</table>
  </div>

  <div style="text-align: center;">
    <button type="submit" class="btn btn-info" id="botonMatricula"  onclick="matricular()">Ingresar Notas</button>
  </div>

    @section('script')


    <script type="text/javascript">

    //actualiza el comboBox de clases
      (function(){
          cambiarClases();        
      })();

      function cambiarClases(){

          var idSeccion = document.getElementsByName("seccion")[0].value;
          var cbClases = document.getElementsByName("clases")[0];
          var tblEstudiantes = document.getElementsByName("tblEstudiantes")[0];
          var url = "obtenerClases";
          var urlEst = "obtenerEstudiantesSeccion";

          //cambiando datos de las clases
          var htmlClases = "";
          $.get(url,
            {
                "idSeccion" : idSeccion
            },
            function(data){
              //  alert(data);
                var dataJ = JSON.parse(data);
                //alert(dataJ);
                for(i=0; i<dataJ.length; i++){
                  //alert("<option value="+dataJ[i].id+">"+dataJ[i].nombre+"</option>");

                  htmlClases += "<option value="+dataJ[i].id+">"+dataJ[i].nombre+"</option>";
                }
                cbClases.innerHTML = htmlClases;
            }
          );

          //cambiando datos de estudiantes
          var htmlEst = "";
          $.get(urlEst,
            {
                "idSeccion" : idSeccion
            },
            function(data){
                //alert(data);
                var dataS = JSON.parse(data);
                for(i=0; i<dataS.length; i++){
                    htmlEst += "<tr>";
                    htmlEst += "<td>"+dataS[i].primerNombre+" "+dataS[i].segundoNombre+" "+dataS[i].primerApellido+" "+dataS[i].segundoApellido  
                             + "<input type='hidden' name='idEstudiante-"+dataS[i].id+"' value='"+dataS[i].id+"'></input>"
                             + "</td>";
                    //htmlEst += "<input type='text' name='parcial1'></input>";
                    htmlEst += "<td><input class='form-control' type='number' min='1' max='100' name='parcial1-"+dataS[i].id+"'></input></td>";  
                    htmlEst += "<td><input class='form-control' type='number' min='1' max='100' name='parcial2-"+dataS[i].id+"'></input></td>"; 
                    htmlEst += "<td><input class='form-control' type='number' min='1' max='100' name='parcial3-"+dataS[i].id+"'></input></td>"; 
                    htmlEst += "<td><input class='form-control' type='number' min='1' max='100' name='parcial4-"+dataS[i].id+"'></input></td>"; 
                    htmlEst += "</tr>";
                }
                tblEstudiantes.innerHTML = htmlEst;
            }
          );

      }        

    </script>

    @stop
	</div>


@stop
