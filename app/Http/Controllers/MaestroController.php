<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Redirect;

class MaestroController extends Controller
{
      public function pantallaInicio()
    {
          return view('maestro.inicioMaestro');

    }

    public function ingresarNotas($idMaestro){
    	//buscando las secciones del maestro
    	$maestroSeccionClase = \App\Maestroseccionclase::where('idMaestro', 1)->get();

    	$idSeccions = \App\Maestroseccionclase::where('idMaestro', 1)->lists('idSeccion');
    	$seccions =  \App\Seccion::whereIn('id', $idSeccions)->get();

    	return view('maestro.ingresarNotas');
    }

    public function ingresarNotass(){
    		//debo obtener el id del maestro
        	$Maestro = \App\Maestro::where('user_id', Auth::user()->id)->get();
        	$idMaestro = $Maestro[0]->id;

	    	//buscando las secciones del maestro
	    	$idSeccions = \App\Maestroseccionclase::where('idMaestro', $idMaestro)->lists('idSeccion');
	    	$seccions =  \App\Seccion::whereIn('id', $idSeccions)->get();

            //buscando los cursos correspondientes a esas secciones
            $idCursos = \App\Seccion::whereIn('id', $idSeccions)->lists('idCurso');

            //echo $idCursos;
            $cursos =  \App\Curso::whereIn('id', $idCursos)->get();
            //echo $cursos;
            //return "";

	    	return view('maestro.ingresarNotas', compact('seccions','cursos'));
    }

    public function obtenerClases(Request $request){

        //obtengo el id de la seccion que se envio
        $idSeccion = $request["idSeccion"];

        //obtengo el id del maestro que esta autenticado
        $Maestro = \App\Maestro::where('user_id', Auth::user()->id)->get();
        $idMaestro = $Maestro[0]->id;

        $idClases = \App\Maestroseccionclase::where('idMaestro', $idMaestro)
                                            ->where('idSeccion', $idSeccion)
                                            ->lists('idClase');

        $clases = \App\Clase::whereIn('id', $idClases)->get();
        echo $clases;
    }

    public function obtenerEstudiantesSeccion(Request $request){

        //obtengo el id de la seccion que se envio
        $idSeccion = $request["idSeccion"];

        //obteniendo los estudiantes que estan matriculados en esa seccion
        $estudiantes = \App\Estudiante::where('idSeccion', $idSeccion)->get();

        echo $estudiantes;

    }


    public function guardarNotas(Request $request){

        try{
            $idSeccion = $request["seccion"];
            $idClase = $request["clases"];

            $idSeccionClase = \App\Seccionclase::where('idSeccion', $idSeccion)->
                                                 where('idClase', $idClase)->get();

            $idEstudiantes = \App\Estudiante::where('idSeccion', $idSeccion)->lists('id');

            //ingresando las notas de cada estudiante
            foreach ($idEstudiantes as $idEstudiante){
                //extrayendo los datos
                //extrayendo las notas de cada parcial
                $nota1 = $request["parcial1-".$idEstudiante];
                $nota2 = $request["parcial2-".$idEstudiante];
                $nota3 = $request["parcial3-".$idEstudiante];
                $nota4 = $request["parcial4-".$idEstudiante];


                //comprobando que no se haya registrado ya las notas del estudiante actual
                $CompNota1 = \App\Nota::where('parcial', 'I-Parcial')->
                                        where('idEstudiante', $idEstudiante)->
                                        where('idSeccionclase', $idSeccionClase[0]->id)->get();
                $CompNota2 = \App\Nota::where('parcial', 'II-Parcial')->
                                        where('idEstudiante', $idEstudiante)->
                                        where('idSeccionclase', $idSeccionClase[0]->id)->get();
                $CompNota3 = \App\Nota::where('parcial', 'III-Parcial')->
                                        where('idEstudiante', $idEstudiante)->
                                        where('idSeccionclase', $idSeccionClase[0]->id)->get();
                $CompNota4 = \App\Nota::where('parcial', 'IV-Parcial')->
                                        where('idEstudiante', $idEstudiante)->
                                        where('idSeccionclase', $idSeccionClase[0]->id)->get();

                //agregando el primer parcial a la tabla de notas
                if(count($CompNota1)<1){
                    \App\Nota::create([
                      'nota' => $nota1,
                      'parcial'=> 'I-Parcial',
                      'idEstudiante'=> $idEstudiante,
                      'idSeccionclase'=> $idSeccionClase[0]->id
                    ]);
                }else
                {   //actualizaremos esa nota
                    if($nota1!=0 && $nota1!=""){
                        $id = $request["id"];
                        $notaMod = \App\Nota::find($CompNota1[0]->id);
                        $notaMod -> fill([
                          'nota' => $nota1
                        ]);
                        $notaMod -> save();
                        echo "Ya se ingreso la nota para este estudiante del 1er parcial: ".$CompNota1[0]->id;
                    }
                }

                //agregando el segundo parcial a la tabla de notas
                if(count($CompNota2)<1){
                    \App\Nota::create([
                      'nota' => $nota2,
                      'parcial'=> 'II-Parcial',
                      'idEstudiante'=> $idEstudiante,
                      'idSeccionclase'=> $idSeccionClase[0]->id
                    ]);
                }else
                {
                    if($nota2!=0 && $nota2!=""){
                        $id = $request["id"];
                        $notaMod = \App\Nota::find($CompNota2[0]->id);
                        $notaMod -> fill([
                          'nota' => $nota2
                        ]);
                        $notaMod -> save();
                        echo "Ya se ingreso la nota para este estudiante del 1er parcial: ".$CompNota2[0]->id;
                    }
                }
                //agregando el tercer parcial a la tabla de notas
                if(count($CompNota3)<1){
                    \App\Nota::create([
                      'nota' => $nota3,
                      'parcial'=> 'III-Parcial',
                      'idEstudiante'=> $idEstudiante,
                      'idSeccionclase'=> $idSeccionClase[0]->id
                    ]);
                }else
                {
                    if($nota3!=0 && $nota3!=""){
                        $id = $request["id"];
                        $notaMod = \App\Nota::find($CompNota3[0]->id);
                        $notaMod -> fill([
                          'nota' => $nota3
                        ]);
                        $notaMod -> save();
                        echo "Ya se ingreso la nota para este estudiante del 1er parcial: ".$CompNota3[0]->id;
                    }
                }

                //agregando el cuarto parcial a la tabla de notas
                if(count($CompNota4)<1){
                    \App\Nota::create([
                      'nota' => $nota4,
                      'parcial'=> 'IV-Parcial',
                      'idEstudiante'=> $idEstudiante,
                      'idSeccionclase'=> $idSeccionClase[0]->id
                    ]);
                }else
                {
                    if($nota4!=0 && $nota4!=""){
                        $id = $request["id"];
                        $notaMod = \App\Nota::find($CompNota4[0]->id);
                        $notaMod -> fill([
                          'nota' => $nota4
                        ]);
                        $notaMod -> save();
                        echo "Ya se ingreso la nota para este estudiante del 1er parcial: ".$CompNota4[0]->id;
                    }
                }
            }
            Session::flash('message-success', 'Las notas se ingresaron correctamente');
        }catch(Exception $e){
            Session::flash('message-warning', 'Hubo un error en el ingreso de notas');
        }

        return Redirect::to('/ingresarNotas');
    }


    public function verHorario(){
        //debo obtener el id del maestro
        $Maestro = \App\Maestro::where('user_id', Auth::user()->id)->get();
        $idMaestro = $Maestro[0]->id;

        $horarios = \App\Maestroseccionclase::join('seccions', 'maestroseccionclases.idSeccion', '=', 'seccions.id')
            ->join('clases', 'maestroseccionclases.idClase', '=', 'clases.id')
            ->join('cursos', 'seccions.idCurso', '=', 'cursos.id')
            ->select('clases.nombre as nombreClase', 'seccions.nombre as nombreSeccion','cursos.nombre as nombreCurso', 'maestroseccionclases.horaInicio', 'maestroseccionclases.horaFin', 'maestroseccionclases.diaClase')
            ->where('maestroseccionclases.idMaestro', $idMaestro)
            ->get();

        return view('maestro.verHorario', compact('horarios'));
    }

    public function vistaVencidaMaestro(){
      return view('maestro.userSuscripcionVencida');      
    }

}
