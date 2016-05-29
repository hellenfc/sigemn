<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Redirect;
use Session;
use DB;
use Mail;
use Carbon\Carbon;

class SubscripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pantallaSubscripcion()
    {
      return view('subscripcion');
    }

    private function randomPassword()
    {
      $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
      $pass = "";
      for($i=0;$i<12;$i++)
      {
        $pass .= substr($str,rand(0,62),1);
      }
      return $pass;
    }

    public function subscripcion(Request $request)
    {
      $subscripcion = DB::table('subscripcions')
        ->select('nombre')
        ->where('nombre',$request['institucion'])
        ->get();

      //Verificando que no exista una suscripción con el mismo nombre de institución.
      if(!$subscripcion)
      {
        //Usuario administrador
        $userType = 0;

        $nameSubscripcion = $request['institucion'];

        //Generando el userName del usuario administrador a partir del nombre de la institución.
        //Sustituyendo " " por "_", sustituyendo vocales acentuadas y eliminando caracteres especiales.
        $userName = $this->cleanString($request['institucion']);
        $userName = strtolower($userName);
        //$words = explode(" ", $userName);
        //$words = array_slice($words,0,3);
        //$userName = implode("_", $words);
        $userName = str_replace(' ', '_', $userName);

        //Generando una contraseña aleatoriamente
        $password = $this->randomPassword();

        //Estableciendo las fechas de inicio y finalización de la suscripción.
        $fechaInicio = Carbon::now();
        $fechaFinal = Carbon::now()->addMonths(1);

        //Creando una suscripción en la base de datos.
        $file = \App\Subscripcion::create([
          'nombre' => $nameSubscripcion,
          'fechaFinal' => $fechaFinal,
          'fechaInicio' => $fechaInicio,
          'correo' => $request['correo'],
        ]);

        //Creando un usuario tipo administrador para la suscripcion creada anteriormente.
        \App\User::create([
          'userName' => $userName,
          'password' => bcrypt($password),
          'userType' => $userType,
          'idSubscripcion' => $file->id,
        ]);

        //Datos de la suscripción a enviar por correo
        $data= ['institucion' => $request['institucion'],
                'user' => $userName,
                'password' => $password,
                'fechaInicio' => $fechaInicio,
                'fechaFinal' => $fechaFinal];
        //Enviando correo utilizando la view emails.subscripcion
        Mail::send('emails.subscripcion', $data, function($message) use ($request)
        {
            $message->from('sigemn@sigemn.org', 'SIGEMN');
            $message->to($request['correo'], $request['institucion'])->subject('Suscripcion exitosa!');
        });

        Session::flash('message-success', 'Suscripcion registrada exitosamente, por favor revise su correo electrónico.');
      }else
      {
        Session::flash('message-error', 'El nombre de la institucion ya existe');
      }
      return Redirect::to('/subscripcion');
    }

    //Método encargado de cambiar vocales acentuadas y eliminar caracteres especiales.
    function cleanString($string)
    {
      $string = trim($string);

      $string = str_replace(
          ['á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'],
          'a',
          $string
      );

      $string = str_replace(
          ['é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'],
          'e',
          $string
      );

      $string = str_replace(
          ['í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'],
          'i',
          $string
      );

      $string = str_replace(
          ['ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'],
          'o',
          $string
      );

      $string = str_replace(
          ['ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'],
          'u',
          $string
      );

      $string = str_replace(
          ['ñ', 'Ñ'],
          'n',
          $string
      );

      //Esta parte se encarga de eliminar cualquier caracter extraño
      $string = str_replace(
          ["\\", "¨", "º", "-", "_", "~",
               "#", "@", "|", "!", '"',
               "·", "$", "%", "&", "/",
               "(", ")", "?", "'", "¡",
               "¿", "[", "^", "<code>", "]",
               "+", "}", "{", "¨", "´",
               ">", "< ", ";", ",", ":",
               ".", 'ç', 'Ç'],
          '',
          $string
      );
      return $string;
  }
}
