<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TutorController extends Controller
{
    public function matriculaEstudiante()
    {
      $jornadas = DB::table('jornadas')
          ->select('jornadas.id', 'jornadas.nombre', 'jornadas.horaInicio', 'jornadas.horaFin','jornadas.idSubscripcion')
          ->where('idSubscripcion', Auth::user()->idSubscripcion)
          ->get();
      $tutor = \App\Tutor::where('user_id', Auth::user()->id)->get();
      $estudiantes = \App\Estudiante::where('idTutor', $tutor[0]->id)->get();
      return view('tutor.matricula', ['jornadas' => $jornadas, 'estudiantes' => $estudiantes]);
    }

    public function informacionEstudiante($id){
      // return \App\Estudiante::find($id);
       $users = DB::table('cursos')
            ->join('estudiantes', 'cursos.id', '=', 'estudiantes.idCurso')
            ->select('estudiantes.primerNombre','estudiantes.pago', 'estudiantes.primerApellido', 'cursos.nombre as nombreCurso', 'cursos.id as idCurso')
            ->where('estudiantes.id', $id)
            ->get();
            return $users;

    }

    public function cargarSecciones(Request $request){
      return \App\Seccion::where('idCurso', $request['idCurso'])->where('idJornada', $request['idJornada'])->get();
    }

    public function cargarSeccion($id){
      return \App\Seccion::find($id);
    }

    public function matricular(Request $request){
      $seccion = \App\Seccion::find($request['idSeccion']);
      if($seccion->cupos <= 0){
        return "error";
      }
      $estudiante = \App\Estudiante::find($request['idEstudiante']);
      $estudiante->idSeccion = $request['idSeccion'];
      $estudiante->save();
      $seccion->cupos = $seccion->cupos - 1;
      $seccion->save();
      return "ok";
    }

       public function pantallaInicio()
    {
          return view('tutor.inicioTutor');

    }

    public function verEstadoCuenta()
    {
      $tutor = \App\Tutor::where('user_id', Auth::user()->id)->get();
      $estudiantes = \App\Estudiante::where('idTutor', $tutor[0]->id)->get();
      return view('tutor.verEstado', ['estudiantes' => $estudiantes]);
    }

    public function verNotas()
    {
      $tutor = \App\Tutor::where('user_id', Auth::user()->id)->get();
      $estudiantes = \App\Estudiante::where('idTutor', $tutor[0]->id)->get();
      return view('tutor.verNotas', ['estudiantes' => $estudiantes]);

    }

    public function cargarNotas($id)
    {
      return \App\Nota::where('idEstudiante', $id)->get();

    }

    public function buscarClase($id)
    {
      $seccionClase = \App\Seccionclase::where('id',$id)->get();
      return  \App\Clase::where('id', $seccionClase[0]->idClase)->get();
    }

    public function vistaVencidaTutor(){
      return view('tutor.userSuscripcionVencida');      
    }
}
