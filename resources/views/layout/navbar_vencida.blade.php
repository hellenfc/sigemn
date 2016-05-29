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
        
      </ul>
      @if(Auth::check())
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{Auth::user()->userName}} <b class="caret"></b></a>
          <ul class="dropdown-menu">

            <li class="divider"></li>
            <a href="{{route('logout')}}" style="color:#B1251E">Cerrar Sesion</a>
          </ul>
        </li>
      </ul>
      @endif
    </div>
  </div>
</div>
