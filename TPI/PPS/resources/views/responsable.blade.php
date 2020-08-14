<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/screen.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d10383ab02.js" crossorigin="anonymous"></script>
  </head>

  <body>

    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a href="/">
          <img alt="UTN" title="UTN" class="img-thumbnail mb-0" src="{{ asset('images/utn.jpg') }}" width="35" height="35">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav nav mr-auto ml-3">
            <li class="nav-item">
              <a class="nav-link active" href="/">Nuevas Solicitudes </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/responsable_register">Registro</a>
            </li>
          </ul>
            <div class="btn-group dropleft">
                <button alt="Notificaciones" title="Notificaciones" id="notificationButton" type="button" class="btn btn-outline-success btn-sm @if (count($user->notifications) > 0) hasNotifications @endif" data-toggle="dropdown" aria-haspopup="true">
                    <i class="far fa-bell"></i>
                </button>
                <div class="dropdown-menu">
                  @foreach($user->notifications as $notification)
                    <a class="dropdown-item" href="{{$notification->url}}">{{$notification->title}}</a>
                  @endforeach
                </div>
              </div>
              &nbsp;
              <form action="/logout" method="post">
                {{ csrf_field() }}
                <button alt="Cerrar sesión" title="UTN" type="submit" class="btn btn-outline-danger btn-sm"><i class="fas fa-sign-out-alt"></i></button>
            </form>
        </div>
      </nav>
    </header>

    <!-- Begin page content -->
    <div role="main"  class="container-fluid" style="margin-top:4rem ;">
        <div class="row">
            <div class="col">
                <div class="card">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="#">Portada</a></li>
                          <li class="breadcrumb-item"><a href="#">Nuevas Solicitudes</a></li>
                        </ol>
                    </nav>
                    <div class="card-body">
                        <div class="jumbotron jumbotron-fluid shadow">
                            <div class="container">
                                <div id="accordion" role="tablist">
                                    @foreach ($users as $user)
                                    <div class="card">
                                      <div class="card-header" role="tab" id="headingOne">
                                          <div class="row">
                                            <div class="col-md-10">
                                                <h5 class="mb-0">
                                                    @if ($user->profile->name === "Student")
                                                        Alta de alumno: {{$user->file}} - {{$user->name}}
                                                    @else
                                                        Alta de tutor: {{$user->file}} - {{$user->name}}
                                                    @endif
                                                </h5>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="row">
                                                    <form method="post" action="/user/accept" style="margin-right: 5px;">
                                                        {{ csrf_field() }}
                                                        <input name="id" type="hidden" value="{{$user->id}}" />
                                                        <button type="submit" class="btn btn-outline-info btn-block shadow btn-sm">Registrar</button>
                                                    </form>
                                                    <form method="post" action="/user/rejected">
                                                        {{ csrf_field() }}
                                                        <input name="id" type="hidden" value="{{$user->id}}" />
                                                        <button type="submit" class="btn btn-outline-info shadow btn-block btn-sm">Rechazar</button>
                                                    </form>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="page-footer font-small p-3 mt-1 fixed-bottom" style="background-color: grey;">

    <!-- Footer Links -->
    <div class="container-fluid text-center text-md-left">
  
      <!-- Grid row -->
      <div class="row">
  
        <!-- Grid column -->
        <div class="col-md-4 mt-md-0 text-center">
  
          <!-- Content -->
          <p class="text-uppercase text-white">Facultad Regional Rosario</p>
          <p class="text-white">Universidad Tecnologica Nacional</p>
  
        </div>
        <!-- Grid column -->
  
        <hr class="clearfix w-100 d-md-none pb-3">

        <!-- Grid column -->

        <div class="col-md-4  text-center">
  
          <p class="text-uppercase text-white">ZEBALLOS 1341 - S2000BQA - ROSARIO</p>
          
  
        </div>
  
        <!-- Grid column -->
        <div class="col-md-4">
  
          <p class="text-white"> Telefono directo: 0341-4481871</p>
          <p class="text-white">Correo electronico: ppsregionalrosario@frro.utn.edu.ar</p>
  
        </div>
        <!-- Grid column -->
  
      </div>
      <!-- Grid row -->
  
    </div>
  </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script>
      $("#notificationButton").click(function() {
        $("#notificationButton").removeClass("hasNotifications");
        $.get("/user/readNotifications/{{$user->id}}");
      });
    </script>
  </body>
</html>
