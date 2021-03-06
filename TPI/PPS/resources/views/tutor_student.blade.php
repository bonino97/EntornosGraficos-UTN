<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tutor</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/screen.min.css') }}" rel="stylesheet">
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
        </div>
      </nav>
    </header>

    <!-- Begin page content -->
    <div role="main" class="container-fluid" style="margin-top:4rem ;">
        <div class="row">
            <div class="col">
                <div class="card">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="/">Portada</a></li>
                          <li class="breadcrumb-item"><a href="/tutor">Tutor</a></li>
                        </ol>
                    </nav>

                    <div class="card-body">
                        <div class="jumbotron jumbotron-fluid shadow">
                            <div class="container">
                                <div class="card border-dark">
                                    <div class="media">
                                      <img class="d-flex align-self-center mr-3" src="{{ asset('images/utn.jpg') }}" width="180" height="180" alt="Generic placeholder image">
                                      <div class="media-body">
                                        <ul class="list-group list-group-flush">
                                          <li class="list-group-item border-dark"><h5 class="card-title text-center">{{$tutor->name}}</h5></li>
                                          <li class="list-group-item border-dark"><p class="card-title text-center">{{$tutor->email}}</p></li>
                                          <li class="list-group-item border-dark"><p class="card-title text-center">{{$tutor->file}}</p></li>
                                        </ul>
                                      </div>
                                    </div>
 
                                    <div class="card-body">
                                      <a style="text-decoration: none;" href = "mailto:{{$tutor->email}}?subject=Contacto">
                                        <button type="button" class="btn btn-outline-dark btn-block">Contactar</button>
                                      </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 ">
              <h4 class="mb-4">
                <form class="form-inline mt-2 mt-md-0" action="/">
                    <input class="form-control mr-sm-2 col-9 mr-1" type="text" name="name" placeholder="Buscar">
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
  </body>
</html>
