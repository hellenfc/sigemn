<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Session; //Para usar los las alertas
use Redirect;
use Carbon\Carbon;


class AdministradorController extends Controller
{
    public function registroMaestro()
    {
     return view('administrador.registro.registroMaestro');
    }



    public function guardarHorario(Request $request){
        $infohorario =  \App\Maestroseccionclase::all();
        $infoJornada =  \App\Jornada::find($request['idJornada']);

        $horario = \App\Maestroseccionclase::create(['idSeccion' => $request['idSeccion'],
              'idClase' => $request['idClase'], 'idMaestro' => $request['idMaestro'],
              'horaInicio' => $request['horaInicio'], 'horaFin' => $request['horaFin'],
              'diaClase' => $request['diaClase']
            ]);
        $horarioSeleccionado = \App\Maestroseccionclase::find($horario->id);

       if ((($request['horaInicio'] ) > ($request['horaFin']))  || (($request['horaFin']) < ($request['horaInicio'])) || (($request['horaFin']) == ($request['horaInicio'])) ) {

            $horarioSeleccionado->delete();
            return "ErrorHora";
        }

        if ((  ($horarioSeleccionado->horaInicio) < ($infoJornada->horaInicio) ) || (($horarioSeleccionado->horaFin) > ($infoJornada->horaFin)) ) {
            $horarioSeleccionado->delete();
            return "ErrorHoraJornada";

        }

        foreach ($infohorario as $info) {
          if(($info->horaInicio == $horarioSeleccionado->horaInicio || $info->horaFin == $horarioSeleccionado->horaFin)
            && $info->idSeccion == $horarioSeleccionado->idSeccion && $info->diaClase == $horarioSeleccionado->diaClase){
            $horarioSeleccionado->delete();
            // Session::flash('message-warning', 'Tienes un error');
            return "Duplicado";
          }
        }

          $seccionClase = \App\Seccionclase::create(['idSeccion' => $request['idSeccion'],
              'idClase' => $request['idClase']]);
    }

        public function guardarSeccion(Request $request){
          $flag=True;
          $seccionesBD = DB::table('seccions')
              ->select('seccions.id', 'seccions.nombre', 'seccions.aula', 'seccions.cupos', 'seccions.idCurso', 'seccions.idJornada','seccions.idSubscripcion')
              ->where('idSubscripcion', Auth::user()->idSubscripcion)
              ->get();;
          foreach ($seccionesBD as $secc) {
                      if ($secc['nombre']==$request['nombre'] && $secc['idCurso']==$request['curso']
                        && $secc['idJornada']==$request['jornadaId']) {
                        $flag=False;
                        Session::flash('message-warning', 'La sección ya existe.');

                      }
                    }
          if($flag){
            $seccion = \App\Seccion::create([
              'nombre'=>$request['nombre'],
              'cupos'=>$request['cupos'],
              'aula'=>$request['aula'],
              'idCurso'=>$request['curso'],
              'idJornada'=>$request['jornadaId'],
              'idSubscripcion'=>Auth::user()->idSubscripcion
          ]);
          Session::flash('message-success', 'Creado correctamente');

          }
          return Redirect::to('/crearSeccion');
    }

    public function guardarMaestro(Request $request)
    {
        $userType = 1;

        $usuario = DB::table('users')
            ->select('userName')
            ->where('userName',$request['nombre_usuario'])
            ->get();

        if (!$usuario)  {

        \App\User::create([
            'userName'=>$request['nombre_usuario'],
            'password'=>bcrypt($request['pass']),
            'userType'=>$userType,
            'idSubscripcion'=>Auth::user()->idSubscripcion,
            ]);
        $usuario = DB::table('users')
            ->select('id')
            ->where('userName',$request['nombre_usuario'])
            ->get();


       \App\Maestro::create([
          'primerNombre' => $request['pNombre'],
          'segundoNombre'=> $request['sNombre'],
          'primerApellido'=> $request['pApellido'],
          'segundoApellido'=> $request['sApellido'],
          'nroIdentidad'=> $request['noIdentidad'],
          'correo'=> $request['correo'],
          'direccion'=> $request['direccion'],
          'telefono'=> $request['telefono'],
          'user_id'=> $usuario[0]->id
          ]);
       Session::flash('message-success', 'Maestro creado correctamente');
   }
   else {
        Session::flash('message-warning', 'El nombre de usaurio ya existe');

   }
       return Redirect::to('/registroMaestro');

    }



    public function actualizarMaestro()
    {
      $idSubscripcion = Auth::user()->idSubscripcion;

      //obteniendo los id de los usuarios que son maestros
      $users = \App\User::where('userType', 1)
                            ->where('idSubscripcion',$idSubscripcion)
                            ->lists('id');

      //obteniendo los maestros que tengan un id de la lista de id´s users
      $maestros = \App\Maestro::whereIn('user_id', $users)->get();
      //$maestros = \App\Maestro::all();
      return view('administrador.actualizar.actualizarMaestro',['maestros' => $maestros]);
      //return view('administrador.actualizar.actualizarMaestro',compact('idSubscripcion','users','maestros'));
    }

    public function traerInfoMaestro($id)
    {
      // Aquí pones la consulta para obtener la info que necesitas
      $users = \App\Maestro::find($id);
      return  $users;
    }

    public function guardarMaestroActualizado(Request $request)
    {
       // $nombreUsuario = \App\User::where('userName',$request['maestro'])->get();
        // dd($nombreUsuario[0]->id)
       $result = DB::table('maestros')
        ->where('id',$request['maestro'])
        ->update(['primerNombre'=>$request['pNombre'],
          'segundoNombre' =>$request['sNombre'],
          'primerApellido'=>$request['pApellido'],
          'segundoApellido'=>$request['sApellido'],
          'correo'=>$request['correo'],
          'direccion'=>$request['direccion'],
          'nroIdentidad'=>$request['noIdentidad'],
          'telefono'=>$request['telefono']]
          );
        if($result)
        {
          Session::flash('message-success', 'Maestro actualizado correctamente');
        }
        else
        {
          Session::flash('message-warning', 'No se efectuo cambios en el registro.');
        }
        return Redirect::to('/actualizarMaestro');
    }



    public function registroEstudiante()
    {
        //obtengo los usuarios con tipo=2 que representan a los tutores
        $users = \App\User::where('userType', 2)-> where('idSubscripcion', Auth::user()->idSubscripcion)->get();
        $cursos = DB::table('cursos')
            ->select('cursos.id', 'cursos.nombre','cursos.idSubscripcion')
            ->where('idSubscripcion', Auth::user()->idSubscripcion)
            ->get();

        return view('administrador.registro.registroEstudiante', compact('users','cursos'));
        //return View::make('administrador.registro.registroEstudiante')->with(compact('users', 'cursos'));
    }


    public function guardarEstudiante(Request $request)
    {
        //return 'Hola';
          $estudiante = \App\Estudiante::where('nroIdentidad', $request['noIdentidad'])->get();
          //return count($estudiante);
          if(count($estudiante)<1){
            $user = \App\User::where('userName', $request['usuarioTutor'])->get();
            //return $user;

            $idUser = $user[0]["id"];
            $tutor = \App\Tutor::where('user_id', $idUser)->get();

            //obtengo el id del tutor con el nombre de usuario q se envio
            $idTutor = $tutor[0]["id"];

            //obtengo el id del curso con el nomnbre que se envio
            $curso = \App\Curso::where('nombre', $request['curso'])->get();
            $idCurso = $curso[0]["id"];

            //extrayendo la fecha de nacimiento
            $fechaNac = $request["fechaAnio"]."/".$request["fechaMes"]."/".$request["fechaDia"];
            //extrayendo el padecimiento
            $padecimiento = "";

            if(isset($request['p_anemia']))
              $padecimiento .= "anemia";
            if(isset($request['p_gastritis']))
              $padecimiento .= ",gastritis";
            if(isset($request['p_asma']))
              $padecimiento .= ",asma";
            if(isset($request['p_diabetes']))
              $padecimiento .= ",diabetes";
            if(isset($request['p_bronquitis']))
              $padecimiento .= ",bronquitis";
            if(isset($request['p_estrenimiento']))
              $padecimiento .= ",estrenimiento";
            if(isset($request['p_colitis']))
              $padecimiento .= ",colitis";
            $padecimiento .= ",".$request["p_otros"];


            //return $padecimiento;

            //agregando el registro a la base
            \App\Estudiante::create([
              'primerNombre' => $request['pNombre'],
              'segundoNombre'=> $request['sNombre'],
              'primerApellido'=> $request['pApellido'],
              'segundoApellido'=> $request['sApellido'],
              'nroIdentidad'=> $request['noIdentidad'],
              'correo'=> $request['correo'],
              'direccion'=> $request['direccion'],
              'telefono'=> $request['telefono'],
              'tipoSangre'=> $request['tipoSangre'],
              'fechaNacimiento'=> $fechaNac,
              'padecimiento'=> $padecimiento,
              'genero'=> $request['genero'],
              'pago'=> $request['pago'],
              'idTutor'=> $idTutor,
              'idCurso' => $idCurso,
              // 'idSeccion' => '1',
              'idSubscripcion'=>Auth::user()->idSubscripcion
            ]);
            //si todo salio bien
            Session::flash('message-success', 'Estudiante creado correctamente');

            //return 'Estudiante Registrado';
        }
        else{
          //si ya hay un estudiante con ese numero de identidad
          Session::flash('message-warning', 'Ya existe un estudiante con ese No. de Identidad');
          //return 'Ya hay registrado un estudiante con ese No de Identidad';
           //echo "<script languaje='javascript'>alert(Ya hay registrado un estudiante con ese No de Identidad)</script>";
           //$error = "Ya hay registrado un estudiante con ese No de Identidad";
           //$error = 1;
           //return view('administrador.registro.registroEstudiante', compact('error'));
        }
        //luego de finalizar lo redireccionamos nuevamente al registro
        return Redirect::to('/registroEstudiante');
    }

    public function actualizarEstudiante(Request $request){

        $user = \App\User::where('userName', $request['usuarioTutor'])->get();

        $idUser = $user[0]["id"];
        $tutor = \App\Tutor::where('user_id', $idUser)->get();

        //obtengo el id del tutor con el nombre de usuario q se envio
        $idTutor = $tutor[0]["id"];

        //obtengo el id del curso con el nomnbre que se envio
        $curso = \App\Curso::where('nombre', $request['curso'])->get();
        $idCurso = $curso[0]["id"];

        //extrayendo la fecha de nacimiento
        $fechaNac = $request["fechaAnio"]."/".$request["fechaMes"]."/".$request["fechaDia"];
        //extrayendo el padecimiento
        $padecimiento = "";

        if(isset($request['p_anemia']))
          $padecimiento .= "anemia";
        if(isset($request['p_gastritis']))
          $padecimiento .= ",gastritis";
        if(isset($request['p_asma']))
          $padecimiento .= ",asma";
        if(isset($request['p_diabetes']))
          $padecimiento .= ",diabetes";
        if(isset($request['p_bronquitis']))
          $padecimiento .= ",bronquitis";
        if(isset($request['p_estrenimiento']))
          $padecimiento .= ",estrenimiento";
        if(isset($request['p_colitis']))
          $padecimiento .= ",colitis";
        $padecimiento .= ",".$request["p_otros"];



        $id = $request["id"];
        $estudianteU = \App\Estudiante::find($id);
        $estudianteU -> fill([
          'primerNombre' => $request['pNombre'],
          'segundoNombre'=> $request['sNombre'],
          'primerApellido'=> $request['pApellido'],
          'segundoApellido'=> $request['sApellido'],
          'nroIdentidad'=> $request['noIdentidad'],
          'correo'=> $request['correo'],
          'direccion'=> $request['direccion'],
          'telefono'=> $request['telefono'],
          'tipoSangre'=> $request['tipoSangre'],
          'fechaNacimiento'=> $fechaNac,
          'padecimiento'=> $padecimiento,
          'genero'=> $request['genero'],
          'pago'=> $request['pago'],
          'idTutor'=> $idTutor,
          'idCurso' => $idCurso
        ]);

        $estudianteU -> save();
        //echo "actualizacion exitosa";

        Session::flash('message-success', 'Estudiante actualizado correctamente');

        return Redirect::to('/actualizarEstudiante');
    }

    public function actualizaEstudiantes(){

    }

    public function obtenerEstudiante(Request $request){
      $users = \App\User::where('userType', 2)->get();
      $cursos = \App\Curso::All();

      $noIdentidad = $request['noIdentidad'];

      $estudiantes = \App\Estudiante::where('nroIdentidad', $noIdentidad)->get();

      echo $estudiantes;
    }



    public function registroTutor()
    {
        return view('administrador.registro.registroTutor');
    }

        public function guardarTutor(Request $request)
    {
        $userType = 2;

        $usuario = DB::table('users')
          ->select('userName')
          ->where('userName',$request['usuario'])
          ->get();

        if (!$usuario)  {

            \App\User::create([
                'userName'=>$request['usuario'],
                'password'=>bcrypt($request['pass']),
                'userType'=>$userType,
                'idSubscripcion'=>Auth::user()->idSubscripcion
                ]);

            $usuario = DB::table('users')
                ->select('id')
                ->where('userName',$request['usuario'])
                ->get();

           \App\Tutor::create([
              'primerNombre' => $request['pNombre'],
              'segundoNombre'=> $request['sNombre'],
              'primerApellido'=> $request['pApellido'],
              'segundoApellido'=> $request['sApellido'],
              'nroIdentidad'=> $request['noIdentidad'],
              'correo'=> $request['correo'],
              'direccion'=> $request['direccion'],
              'telefono'=> $request['telefono'],
              'user_id'=> $usuario[0]->id
              ]);
            Session::flash('message-success', 'Tutor creado correctamente');
        }
        else {
          Session::flash('message-warning', 'El nombre de usuario ya existe');

        }
       return Redirect::to('/registroTutor');
    }


    public function crearClase()
    {
        $clases = \App\Clase::all();
        return view('administrador.carga.crearClase',['clases' => $clases]);
    }

    public function guardarClase(Request $request)
    {
        $flag=True;
        $jornadas = \App\Clase::all();
        $user = \App\User::where('id',Auth::user()->id)->get();

        foreach ($jornadas as $jornada) {
            if($jornada["nombre"]==$request['nombre']){
              $flag=False; }
         }

        if($flag){
            $clase = \App\Clase::create([
            'nombre'=>$request['nombre'],
            'idSubscripcion'=>$user[0]->idSubscripcion
            ]);
            Session::flash('message-success', 'Creado correctamente');
         }else{Session::flash('message-warning', 'Nombre de clase ya existe');}



        return Redirect::to('/crearClase');
    }



    public function crearJornada()
    {
        $jornadas = \App\Jornada::all();
        return view('administrador.carga.crearJornada', ['jornadas' => $jornadas]);
    }

    public function guardarJornada(Request $request)
    {    $flag=True;
         $flagH=True;
         $jornadas = \App\Jornada::all();
         $user = \App\User::where('id',Auth::user()->id)->get();

         foreach ($jornadas as $jornada) {
            if($jornada["nombre"]==$request['nombre']){
            $flag=False; }
         }

         if($request['horaf'] < $request['horai']){
          $flagH = False;
         }

        if ($flag) {
          if($flagH){
            $jornada = \App\Jornada::create([
            'nombre'=>$request['nombre'],
            'horaInicio'=>$request['horai'] . ":" . $request['mini'],
            'horaFin'=>$request['horaf'] . ":" . $request['minf'],
            'idSubscripcion'=> $user[0]->idSubscripcion
            //'idSubscripcion'=>Auth::user()->idSubscripcion
        ]);
            Session::flash('message-success', 'Creado correctamente');
          }else {Session::flash('message-warning', 'La hora de inicio es mayor que la hora final,
            No se creó la jornada');}
        }else{ Session::flash('message-warning', 'Nombre de jornada ya existe');}

        return Redirect::to('/crearJornada');

    }

    public function crearCurso()
    {
        $clases = DB::table('clases')
            ->select('clases.id', 'clases.nombre', 'clases.idSubscripcion')
            ->where('idSubscripcion', Auth::user()->idSubscripcion)
            ->get();;
        $jornadas = DB::table('jornadas')
            ->select('jornadas.id', 'jornadas.nombre', 'jornadas.horaInicio', 'jornadas.horaFin','jornadas.idSubscripcion')
            ->where('idSubscripcion', Auth::user()->idSubscripcion)
            ->get();
        return view('administrador.carga.crearCurso',['jornadas'=>$jornadas,'clases'=>$clases]);
    }

    public function guardarCurso(Request $request)
    {
      $clases = $request['clases'];
      if($clases !=null)
      {
       $curso = DB:: table('cursos')
      ->select('id')
      ->where('nombre',$request['nombre_curso'])
      ->get();
      //Compruebo si existe el curso
      $jornadaId = DB::table('jornadas')
                ->select('id')
                ->where('nombre',$request['jornada'])
                ->get();

      if ($curso){
       $jornadaCurso = DB::select('SELECT * FROM jornadacursos where idJornada = (SELECT id From jornadas where nombre="' . $request["jornada"].'") and idCurso = (SELECT id FROM cursos where id ='. $curso[0]->id . ')');
       //Compruebo si existe en esa jornada
       if ($jornadaCurso){
        Session::flash('message-warning', 'El curso ya existe en esta jornada');
      }
      else
      {

        \App\Jornadacurso::create([
            'idJornada'=>$jornadaId[0]->id,
            'idCurso'=>$curso[0]->id

            ]);
        foreach($clases as $idClase)
       {
            \App\Cursoclase::create([
              'idCurso'=>$curso[0]->id,
              'idClase'=>$idClase
              ]);
       }

        Session::flash('message-success', 'EL curso se ha agregado a la jornada correctamente');
      }
    }
    else
    {
     \App\Curso::create([
            'nombre'=>$request['nombre_curso'],
            'idSubscripcion'=>Auth::user()->idSubscripcion
            ]);
      $jornadaId = DB::table('jornadas')
                ->select('id')
                ->where('nombre',$request['jornada'])
                ->get();

        $cursoId = DB::table('cursos')
            ->where('nombre',$request['nombre_curso'])
            ->get();

        \App\Jornadacurso::create([
            'idJornada'=>$jornadaId[0]->id,
            'idCurso'=>$cursoId[0]->id

            ]);
        foreach($clases as $idClase)
        {
            \App\Cursoclase::create([
              'idCurso'=>$cursoId[0]->id,
              'idClase'=>$idClase
              ]);
        }


       Session::flash('message-success', 'EL curso se ha creado correctamente');

   }
 }
 else
 {
       Session::flash('message-warning', 'Debe selecionar al menos una clase.');

 }

   return Redirect::to('/crearCurso');
 }

 public function crearSeccion()
 {
  $jornadas = DB::table('jornadas')
      ->select('jornadas.id', 'jornadas.nombre', 'jornadas.horaInicio', 'jornadas.horaFin','jornadas.idSubscripcion')
      ->where('idSubscripcion', Auth::user()->idSubscripcion)
      ->get();
  return view('administrador.carga.crearSeccion', ['jornadas' => $jornadas]);
}

//  public function traerJornada()
//  {
//
//    $jornadas = DB::table('jornadas')
//        ->select('jornadas.id', 'jornadas.nombre', 'jornadas.horaInicio', 'jornadas.horaFin','jornadas.idSubscripcion')
//        ->where('idSubscripcion', Auth::user()->idSubscripcion)
//        ->get();
//   return $jornadas;
// }

    public function crearHorario()
    {
        $secciones= DB::table('seccions')
            ->select('seccions.id', 'seccions.nombre', 'seccions.aula', 'seccions.cupos','seccions.idCurso','seccions.idJornada', 'seccions.idSubscripcion')
            ->where('idSubscripcion', Auth::user()->idSubscripcion)
            ->get();
        $maestros = DB::table('maestros')
            ->join('users', 'maestros.user_id','=', 'users.id')
            ->select('maestros.id', 'maestros.primerNombre', 'maestros.segundoNombre', 'maestros.primerApellido','maestros.segundoApellido','maestros.nroIdentidad')
            ->where('users.idSubscripcion', Auth::user()->idSubscripcion)
            ->get();
        return view('administrador.carga.crearHorario', ['secciones' => $secciones, 'maestros' => $maestros]);
    }


    public function traerCursos($id)
    {
    //return "Hola Mundo";
        $users = DB::table('cursos')
            ->join('jornadacursos', 'cursos.id', '=', 'jornadacursos.idCurso')
            ->select('cursos.id', 'cursos.nombre')
            ->where('jornadacursos.idJornada', $id)
            ->get();
            return $users;
    }


// agregar
    public function traerInfo($id)
    {

        $users = DB::table('seccions')
        ->join('cursos', 'seccions.idCurso', '=', 'cursos.id')
        ->join('jornadas', 'seccions.idJornada', '=', 'jornadas.id')
        ->where('seccions.id', $id)
        ->select('seccions.cupos', 'seccions.aula', 'cursos.nombre as nombreCursos', 'cursos.id as idCurso', 'seccions.idJornada', 'jornadas.nombre as nombreJornada')
        ->get();
        return  $users;
    }

    public function buscarClases($id)
    {
        $users = DB::table('clases')
        ->join('cursoclases', 'clases.id', '=', 'cursoclases.idClase')
        ->where('cursoclases.idCurso', $id)
        ->select('clases.nombre', 'clases.id as claseId')
        ->get();
        return $users;

    }

    public function pantallaInicio()
    {
          return view('administrador.inicioAdministrador');

    }


    public function actualizarE()
    {
        //return view('administrador.actualizar.actualizarEstudiante');
        //obtengo los usuarios con tipo=2 que representan a los tutores
        //echo "hola";
        $idSubscripcion = Auth::user()->idSubscripcion;

        /*$users = DB::table('users')
                    ->whereIn('id', array(1, 2, 3))->get();*/

        $users = \App\User::where('userType', 2)
                            ->where('idSubscripcion',$idSubscripcion)->get();
        $cursos = \App\Curso::where('idSubscripcion',$idSubscripcion)->get();


        //obteniendo los id de los usuarios que son tutores
        $idUser = \App\User::where('userType', 2)
                            ->where('idSubscripcion',$idSubscripcion)
                            ->lists('id');
        $tutors = \App\Tutor::whereIn('user_id', $idUser)->get();
        //$estudiantes = \App\Estudiante::All();

        $estudiantes = DB::table('estudiantes')
                    ->where('idSubscripcion',$idSubscripcion)
                    ->orderBy('nroIdentidad', 'asc')->get();
        //$estudiantes = \App\Estudiante::where('nroIdentidad', $noIdentidad)->get();

        return view('administrador.actualizar.actualizarEstudiante', compact('users','cursos','tutors','estudiantes'));

    }

    public function actualizarM()
    {
          return view('administrador.actualizar.actualizarMaestro');

    }

    public function actualizarT()
    {
       //obteniendo los id de los usuarios que son tutor
        //$users = \App\Tutor::all();
        $users = DB::table('tutors')
                 ->join('users','users.id','=','tutors.user_id')
                 ->where('users.idSubscripcion',Auth::user()->idSubscripcion)
                 ->select('tutors.*')
                 ->get();

        //obteniendo los tutores que tengan un id de la lista de id´s users
        //$tutores = \App\Tutor::whereIn('user_id', $users)->get();
        //return view('administrador.actualizar.actualizarTutor',['tutors' => $tutores]);
        return view('administrador.actualizar.actualizarTutor', ['users' => $users]);

    }



public function modificarEstado ()
    {
      $idSubscripcion = Auth::user()->idSubscripcion;
      $estudiantes = \App\Estudiante::where('idSubscripcion',$idSubscripcion)->get();
      return view('administrador.modificarEstado',compact('estudiantes'));
    }

    public function modificandoEstado(Request $request)
    {

      $estudiante = \App\Estudiante::find($request['idEstudiante']);
      $estudiante->pago = $request['nuevoEstado'];
      $estudiante->save();
      Session::flash('message-success', 'Estado actualizado correctamente');
      return Redirect::to('/modificarEstado');

    }

public function guardarTutorActualizado(Request $request)
    {
       // $nombreUsuario = \App\User::where('userName',$request['maestro'])->get();
        // dd($nombreUsuario[0]->id)
       $result = DB::table('tutors')
        ->where('id',$request['tutors'])
        ->update(['primerNombre'=>$request['pNombre'],
          'segundoNombre' =>$request['sNombre'],
          'primerApellido'=>$request['pApellido'],
          'segundoApellido'=>$request['sApellido'],
          'correo'=>$request['correo'],
          'direccion'=>$request['direccion'],
          'nroIdentidad'=>$request['noIdentidad'],
          'telefono'=>$request['telefono']]
          );
        if($result)
        {
          Session::flash('message-success', 'Tutor actualizado correctamente');
        }
        else
        {
          Session::flash('message-warning', 'No se efectuo cambios en el registro.');
        }
        return Redirect::to('/actualizarTutor');
    }

    public function traerInfotutor($id)
    {

      $users = \App\Tutor::find($id);
      return  $users;
    }

    public function estadoSubscripcion()
    {
      //obteniendo la subscripcion del usuario logeado
        $idSubscripcion = Auth::user()->idSubscripcion;
      //obteniendo los datos de la subscripcion
        $subscripcion = DB::table('subscripcions')->where('id', '=', $idSubscripcion)->get();

        $fechaActual = Carbon::now();
        //$fechaInicio = date_create($subscripcion[0]->fechaInicio);
        $fechaFinal = date_create($subscripcion[0]->fechaFinal);
        $interval = $fechaActual->diff($fechaFinal);
        //echo $interval->format('%R%a días');
        return view('administrador.estadoSubscripcion', compact('interval'));
    }

    public function renovarSubscripcion(){
      //return "yess!!";
    //obteniendo la subscripcion del usuario logeado
      $idSubscripcion = Auth::user()->idSubscripcion;
    //obteniendo los datos de la subscripcion
      $subscripcion = DB::table('subscripcions')->where('id', '=', $idSubscripcion)->get();
      $fechaFinal = date_create($subscripcion[0]->fechaFinal);


      date_add($fechaFinal, date_interval_create_from_date_string('1 months'));
      //echo date_format($fecha, 'Y-m-d');

      DB::table('subscripcions')
            ->where('id', $idSubscripcion)
            ->update(['fechaFinal' => $fechaFinal]);


      Session::flash('message-success', '¡Felicidades, Acabas de reanudar tu subscripción por 1 mes más! ');
      return Redirect::to('/estadoSubscripcion');
    }

    public function vistaVencidaAdmin(){
      return view('administrador.adminSuscripcionVencida');
    }

}
