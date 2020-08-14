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
          <ul class="navbar-nav nav nav-pills mr-auto ml-3">
            <li class="nav-item">
              <a class="nav-link" href="/profile">Perfil </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/tutor">Tutor</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/">Mis Informes</a>
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
                <button alt="Cerrar sesión" title="Cerrar sesión" type="submit" class="btn btn-outline-danger btn-sm"><i class="fas fa-sign-out-alt"></i></button>
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
                          <li class="breadcrumb-item"><a href="/">Portada</a></li>
                          <li class="breadcrumb-item"><a href="/">Mis Informes</a></li>
                        </ol>
                    </nav>
                    <div class="card-body">
                        <div class="jumbotron jumbotron-fluid shadow">
                            <div class="container">
                              @foreach ($reports as $report)
                              <div class="card mt-1" >
                                  <div class="card-header">  
                                      <div class="row">
                                          <div class="col-6">
                                              <h4>Informe: {{$report->name}}</h4>
                                          </div>
                                      </div>                                  
                                  </div>
                                  <form action="/uploadFile" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id" value="{{$report->id}}" />
                                    <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Consigna: {{$report->slogan}}</li>
                                      <li class="list-group-item">Estado: {{$report->state}}</li>
                                      @if ($report->grade === null)
                                        <li class="list-group-item">Nota: -</li>
                                      @else
                                        <li class="list-group-item">Nota: {{$report->grade}}</li>
                                      @endif
                                      <li class="list-group-item">Comentarios: {{$report->comments}}</li>
                                      @if ($report->state === "A corregir")
                                        <li class="list-group-item">Archivo: <a href="/storage/{{$report->file}}">{{$report->file}}</a></li>
                                        <input name="reportFile" onclick="showButtonSave(this)" type="file" class="list-group-item">
                                        @else
                                          @if ($report->file === null)
                                            <input name="reportFile" onclick="showButtonSave(this)" type="file" class="list-group-item">
                                          @else
                                            <li class="list-group-item">Archivo: <a href="/storage/{{$report->file}}">{{$report->file}}</a></li>
                                          @endif
                                      @endif
                                    </ul>
                                    <div class="card-footer text-muted text-right save-file">
                                        <button type="submit" class="btn btn-success end">Guardar</button>
                                    </div>
                                  </form>
                              </div>
                              @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 ">
              <h4 class="mb-4">
                <form class="form-inline mt-2 mt-md-0" method="get" action="/">
                    <input class="form-control mr-sm-2 col-9 mr-1" name="name" type="text" placeholder="Buscar">
                    <button class="btn btn-outline-danger my-2 my-sm-0 col-2" type="submit"><i class="fas fa-search"></i></button>
                </form>
              </h4>
                <div class="card shadow">
                    <h4 class="card-header">Actividad Reciente</h4>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @foreach ($recentActivity as $activity)
                            <li class="list-group-item">
                                <a style="text-decoration: none; color: black; border: none;" href="/?name={{$activity->name}}">{{$activity->name}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="page-footer font-small p-3 mt-1 @if(count($reports) <= 1) fixed-bottom @endif" style="background-color: grey;">

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

      function showButtonSave(input) {
        if(input) {
          $($(input.parentElement.parentElement).find('.save-file')[0]).show();
        }
      }
    </script>
  </body>
</html>