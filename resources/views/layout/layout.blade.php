<!--Este es el layout principal-->
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="theme/bootstrap.css" media="screen">
  <link rel="stylesheet" href="theme/usebootstrap.css">
  <title>SIGEMN</title>
  <link rel="icon" type="image/png" href="img/p.png"/>
</head>
<body>

@include('layout.navbar')

@include('alertas.error')
@include('alertas.advertencia')
@include('alertas.exito')

  @yield('cuerpo') <!--Yield es generico para poder insertar a este layout -->

@include('layout.footer')
	
<script src="jquery/jquery.min.js"></script>
<script src="bootstrap/bootstrap.min.js"></script>
<script src="bootstrap/usebootstrap.js"></script>
<link rel="stylesheet" href="dist/css/bootstrap-select.css">
<script src="dist/js/bootstrap-select.js"></script>
@yield('script')
</body>
</html>
