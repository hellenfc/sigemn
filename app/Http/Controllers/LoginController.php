<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session; //Para usar los las alertas
use Redirect;
use DB;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function index(){
      return view('login.login');
      //Login.login es la carpeta y el archivo creado

      //Ejemplo consulta
      //$users = \App\User::where('userType', '0')->get();
      //return $users;
    }

    public function store(Request $request)
    {
        $name = $request['name'];
        $password = $request['password'];
        $fechaActual = Carbon::now();
        if (Auth::attempt(['userName' => $name, 'password' => $password])) {
            $fechaVencimiento = DB::table('subscripcions')->select('fechaFinal')->where('id', Auth::user()->idSubscripcion)->get();
          //Auth user devuelve el usuario acutalmente logeado
            if (Auth::user()->userType == 0){ //administrador
              if(date_create($fechaVencimiento[0]->fechaFinal) < $fechaActual)
                return Redirect::to('adminSuscripcionVencida');
              return Redirect::to('inicioAdministrador');
            }elseif (Auth::user()->userType == 1) { //maestro
              if(date_create($fechaVencimiento[0]->fechaFinal) < $fechaActual)
                return Redirect::to('userSuscripcionVencida');
              return Redirect::to('inicioMaestro');
            }elseif (Auth::user()->userType == 2) { //tutor
              if(date_create($fechaVencimiento[0]->fechaFinal) < $fechaActual)
                return Redirect::to('userSuscripcionVencida');
              return Redirect::to('inicioTutor');
            }

            /*elseif(Auth::user()->userType == 1 || Auth::user()->userType == 2 && ($fechaVencimiento < $fechaActual)){
              return Redirect::to('userSuscripcionVencida');
            }*/
            //return Redirect::to('admin');
        }
        Session::flash('message-error', 'Nombre de Usuario o Contraseña Incorrecta, intentélo de nuevo');

        return Redirect::to('login');
    }

    public function logout()
   {
       Auth::logout();
       return Redirect::to('login');
   }

}
