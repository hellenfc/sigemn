<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('landingPage');
});

/*Se define la ruta para el login y así poder ingresar
 por http://localhost/sigemn/public/login
 esta no es la unica manera de hacer las rutas como por ejemplo en la ruta de
arriba es hecho de manera distinta.*/
Route::resource('login', 'LoginController');

Route::get('inicio', function () {
    return view('inicio');
});

Route::get('landing', function () {
    return view('landingPage');
});


Route::get('subscripcion', [
  'as' => 'subscripcion',
  'uses' => 'SubscripcionController@pantallaSubscripcion'
]);

Route::post('subscripcion', [
	'as' => 'subscripcion',
	'uses' => 'SubscripcionController@subscripcion'
]);

Route::get('login', [
	'as' => 'login',
	'uses' => 'LoginController@index'
]);

Route::get('logout', [
	'as' => 'logout',
	'uses' => 'LoginController@logout'
]);

Route::get('registroMaestro', [
	'as' => 'registroMaestro',
	'uses' => 'AdministradorController@registroMaestro'
]);

Route::post('guardarMaestro', [
	'as' => 'guardarMaestro',
	'uses' => 'AdministradorController@guardarMaestro'
]);


Route::get('registroEstudiante', [
	'as' => 'registroEstudiante',
	'uses' => 'AdministradorController@registroEstudiante'
]);

Route::post('registroEstudiante', [
	'as' => 'registroEstudiante',
	'uses' => 'AdministradorController@guardarEstudiante'
]);

Route::get('registroTutor', [
	'as' => 'registroTutor',
	'uses' => 'AdministradorController@registroTutor'
]);

Route::post('registroTutor', [
	'as' => 'registroTutor',
	'uses' => 'AdministradorController@guardarTutor'
]);

// Route::get('crearSeccion/{id}',
// 'AdministradorController@crearSeccion');
// Route::get('crearSeccion/{id}', [
// 	'as' => 'crearSeccion',
// 	'uses' => 'AdministradorController@crearSeccion'
// ]);
Route::get('crearSeccion', [
	'as' => 'crearSeccion',
	'uses' => 'AdministradorController@crearSeccion'
]);

Route::get('traerJornada', 'AdministradorController@traerJornada');


Route::get('crearJornada', [
	'as' => 'crearJornada',
	'uses' => 'AdministradorController@crearJornada'
]);

Route::post('guardarJornada', [
	'as' => 'guardarJornada',
	'uses' => 'AdministradorController@guardarJornada'
]);


Route::get('crearCurso', [
	'as' => 'crearCurso',
	'uses' => 'AdministradorController@crearCurso'
]);

Route::post('guardarCurso', [
	'as' => 'guardarCurso',
	'uses' => 'AdministradorController@guardarCurso'
]);

Route::get('crearClase', [
	'as' => 'crearClase',
	'uses' => 'AdministradorController@crearClase'
]);



Route::post('guardarClase', [
	'as' => 'guardarClase',
	'uses' => 'AdministradorController@guardarClase'
]);

Route::get('crearHorario', [
	'as' => 'crearHorario',
	'uses' => 'AdministradorController@crearHorario'
]);

Route::get('cursos/{id}', 'AdministradorController@traerCursos');

Route::post('guardarSeccion', [
	'as' => 'guardarSeccion',
	'uses' => 'AdministradorController@guardarSeccion'
]);
// Route::resource('registroEstudiante','AdministradorController');

Route::get('traerInfo/{id}', 'AdministradorController@traerInfo');

// probando
Route::get('buscarClases/{id}', 'AdministradorController@buscarClases');

Route::get('buscarMaestros/{id}', 'AdministradorController@buscarMaestros');

Route::post('guardarHorario', [
  'as' => 'guardarHorario',
  'uses' =>'AdministradorController@guardarHorario'
  ]);

  Route::get('guardarElHorario', function(){
    return view('administrador.pruebaInsertar');
  });

  Route::get('matricula', [
  'as' => 'matricula',
  'uses' => 'TutorController@matriculaEstudiante'
  ]);

  Route::get('obtenerInformacionEstudiando/{id}', 'TutorController@informacionEstudiante');

  Route::post('cargarSecciones', 'TutorController@cargarSecciones');
  Route::get('cargarSeccion/{id}', 'TutorController@cargarSeccion');
  Route::post('insertarMatricula', [
    'as' => 'matricular',
    'uses' => 'TutorController@matricular']);

 Route::get('inicioAdministrador', [
  'as' => 'inicioAdministrador',
  'uses' => 'AdministradorController@pantallaInicio'
  ]);
//Ruta para las vistas con suscripcion vencida
 Route::get('adminSuscripcionVencida', [
  'as' => 'adminSuscripcionVencida',
  'uses' => 'AdministradorController@vistaVencidaAdmin'//Metodo para dirigirme a la vista
  ]);

 Route::get('userSuscripcionVencida', [
  'as' => 'userSuscripcionVencida',
  'uses' => 'MaestroController@vistaVencidaMaestro'//Metodo para dirigirme a la vista
  ]);

 Route::get('userSuscripcionVencida', [
  'as' => 'userSuscripcionVencida',
  'uses' => 'TutorController@vistaVencidaTutor'//Metodo para dirigirme a la vista
  ]);
 Route::get('inicioTutor', [
  'as' => 'inicioTutor',
  'uses' => 'TutorController@pantallaInicio'
  ]);

  Route::get('pruebaMat', function(){
    return view('tutor.pruebaMat');
  });

 Route::get('inicioMaestro', [
  'as' => 'inicioMaestro',
  'uses' => 'MaestroController@pantallaInicio'
  ]);

Route::get('actualizarEstudiante', [
  'as' => 'actualizarEstudiante',
  'uses' => 'AdministradorController@actualizarE'
  ]);

Route::post('actualizarEstudiante', [
	'as' => 'actualizarEstudiante',
	'uses' => 'AdministradorController@actualizarEstudiante'
]);

Route::get('obtenerEstudiante', [
	'as' => 'obtenerEstudiante',
	'uses' => 'AdministradorController@obtenerEstudiante'
]);

  Route::get('actualizarMaestro', [
  'as' => 'actualizarMaestro',
  'uses' => 'AdministradorController@actualizarM'
  ]);

   Route::get('actualizarTutor', [
  'as' => 'actualizarTutor',
  'uses' => 'AdministradorController@actualizarT'
  ]);

	Route::get('verEstadoCuenta',[
    'as' => 'verEstadoCuenta',
    'uses' => 'TutorController@verEstadoCuenta'
    ]);

   Route::get('verNotas',[
    'as' => 'verNotas',
    'uses' => 'TutorController@verNotas']);

   Route::get('cargarSeccion/{id}', 'TutorController@cargarSeccion');

   Route::get('cargarNotas/{id}', 'TutorController@cargarNotas');

   Route::get('buscarClase/{id}', 'TutorController@buscarClase');

     Route::get('actualizarMaestro', [
  'as' => 'actualizarMaestro',
  'uses' => 'AdministradorController@actualizarMaestro'
]);


Route::post('guardarMaestroActualizado', [
  'as' => 'guardarMaestroActualizado',
  'uses' => 'AdministradorController@guardarMaestroActualizado'
]);

   Route::get('traerInfoMaestro/{id}', 'AdministradorController@traerInfoMaestro');


Route::get('ingresarNotas', [
  'as' => 'ingresarNotas',
  'uses' => 'MaestroController@ingresarNotass'
]);

Route::get('obtenerClases', [
  'as' => 'obtenerClases',
  'uses' => 'MaestroController@obtenerClases'
]);

Route::get('obtenerEstudiantesSeccion', [
  'as' => 'obtenerEstudiantesSeccion',
  'uses' => 'MaestroController@obtenerEstudiantesSeccion'
]);

Route::post('guardarNotas', [
  'as' => 'guardarNotas',
  'uses' => 'MaestroController@guardarNotas'
]);

Route::post('guardarTutorActualizado', 'AdministradorController@guardarTutorActualizado');

Route::get('traerInfoTutor/{id}', 'AdministradorController@traerInfotutor');

Route::get('modificarEstado','AdministradorController@modificarEstado');
Route::post('modificarEstado', 'AdministradorController@modificandoEstado');

Route::get('verHorario', [
  'as' => 'verHorario',
  'uses' => 'MaestroController@verHorario'
]);

Route::get('estadoSubscripcion', [
	'as' => 'estadoSubscripcion',
	'uses' => 'AdministradorController@estadoSubscripcion'
]);

Route::post('renovarSubscripcion', [
	'as' => 'estadoSubscripcion',
	'uses' => 'AdministradorController@renovarSubscripcion'
]);
