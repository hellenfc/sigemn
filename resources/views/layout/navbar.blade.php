<div class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      @if(Auth::check())

        <a class="navbar-brand " href="#">

          <img src="img/sigemn.png" alt="" style="max-width:130px;margin-top: -10px;" >

        </a>
      @else
        <a class="navbar-brand" href="inicio">
          <img src="img/sigemn.png" alt="" style="max-width:130px; margin-top: -10px;" >

        </a>
      @endif
    </div>
    <div class="navbar-collapse collapse navbar-responsive-collapse">
      <ul class="nav navbar-nav">
        @if(Auth::check() && Auth::user()->userType == 0)<!--0 es admin-->
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Registro de Usuarios<b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="registroMaestro">Registrar Maestro</a></li>
                    <li><a href="registroTutor">Registrar Tutor</a></li>
                    <li><a href="registroEstudiante">Registrar Estudiante</a></li>
                  </ul>
             </li>
             <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Actualizar Usuarios<b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="actualizarMaestro">Actualizar Maestro</a></li>
                    <li><a href="actualizarTutor">Actualizar Tutor</a></li>
                    <li><a href="actualizarEstudiante">Actualizar Estudiante</a></li>
                  </ul>
             </li>
             <li><a href="modificarEstado">Modificar estado</a></li>
             <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Crear carga<b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="crearJornada">Crear jornada</a></li>
                    <li><a href="crearClase">Crear clase</a></li>
                    <li><a href="crearCurso">Crear curso</a></li>
                    <li><a href="crearSeccion">Crear sección</a></li>
                    <li><a href="crearHorario">Crear horario</a></li>
                  </ul>
            </li>
            <li><a href="estadoSubscripcion">Estado de subscripción</a></li>
            @elseif(Auth::check() && Auth::user()->userType == 1)<!--1 es maestro-->
             <li ><a href="ingresarNotas">Ingresar Notas</a></li>
             <li><a href="verHorario">Ver Horario</a></li>
            @elseif(Auth::check() && Auth::user()->userType == 2)<!--2 es tutor-->
             <li><a href="matricula">Matricula</a></li>
             <li><a href="verNotas">Notas</a></li>
             <li><a href="verEstadoCuenta">Estado de cuenta</a></li>

            @endif

      </ul>
      @if(Auth::check())
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{Auth::user()->userName}} <b class="caret"></b></a>
          <ul class="dropdown-menu">

            <li class="divider"></li>
            <a href="{{route('logout')}}">Cerrar Sesion</a>
          </ul>
        </li>
      </ul>
      @endif
    </div>
  </div>
</div>
