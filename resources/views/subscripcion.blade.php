<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <link rel="icon" type="image/png" href="img/p.png"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>SIGEMN</title>
    <!--REQUIRED STYLE SHEETS-->
    <!-- BOOTSTRAP CORE STYLE CSS -->
    <link href="css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLE CSS -->
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <!-- VEGAS STYLE CSS -->
    <link href="scripts/vegas/jquery.vegas.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLE CSS -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Ruluko' rel='stylesheet' type='text/css' />
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="landing">
                  <img src="img/sigemn.png" style="position:fixed; width: 110px; top: 7px">

                </a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav navbar-right">

                  <li><a href="login">Login</a>
                  </li>

                </ul>
            </div>
        </div>
        <!-- /.container -->
    </nav>
    <!--End Navigation -->
    <div style="margin-top:55px;">
      @include('alertas.error')
      @include('alertas.advertencia')
      @include('alertas.exito')
    </div>
    <br><br><br><br>

    <form  action="{{route('subscripcion')}}" method="POST">
      <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-info">
          <div class="panel-heading ">
            <h3 >Comienza a utilizar SIGEMN</h3>
          </div>
          <div class="panel-body">
            <p>
              Llena este simple formulario y se te enviará un correo con tu usuario y
              contraseña para que puedas comenzar a utilizar SIGEMN.
            </p>
            <div class="form-group">
              <label for="inputEmail"  for="focusedInput">Nombre de institución:</label>
              <input class="form-control" id="idInstitucion" name='institucion'type="text" required>
            </div>
            <div class="form-group">
              <label class="control-label" for="focusedInput">Correo electrónico:</label>
              <input class="form-control" id="idCorreo" type="text" name='correo' placeholder="correo@proveedor.com" required>
            <br />
            </div>
            <button type="submit" class="btn btn-primary center">Enviar</button>
          </div>
        </div>
      </div>
    </form>





    <!--footer Section -->
    <br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br>
    <div class="for-full-back color-white" id="footer">
        © 2015|SIGEMN
    </div>
    <!--End footer Section -->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="plugins/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP CORE SCRIPT   -->
    <script src="plugins/bootstrap.js"></script>

    <!-- CUSTOM SCRIPTS -->
    <script src="js/custom.js"></script>

</body>
</html>
