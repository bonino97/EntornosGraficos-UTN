<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mapa de sitio</title>
    
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
                          <li class="breadcrumb-item"><a href="/site-map">Mapa de sitio</a></li>
                        </ol>
                    </nav>
                    <div class="card-body col-12">
                        <div style="padding: 20px; background: #f7f7f7" class="shadow">
                            <div class="container">
                            <div class="just-padding">
                                @if ($user->profile->name === "Student")
                                <div class="list-group list-group-root well">
                                    <a href="/" class="list-group-item">Portada</a>
                                    <div class="list-group">
                                        <a href="/" class="list-group-item">Mis informes</a>
                                        <a href="/profile" class="list-group-item">Perfil</a>
                                        <a href="/tutor" class="list-group-item">Tutor</a>
                                    </div>
                                </div>
                                @endif
                                @if ($user->profile->name === "Responsable")
                                <div class="list-group list-group-root well">
                                    <a href="/" class="list-group-item">Portada</a>
                                    <div class="list-group">
                                        <a href="/" class="list-group-item">Nuevas solicitudes</a>
                                        <a href="/responsable_register" class="list-group-item">Registro</a>
                                    </div>
                                </div>
                                @endif
                                @if ($user->profile->name === "Tutor")
                                <div class="list-group list-group-root well">
                                    <a href="/" class="list-group-item">Portada</a>
                                    <div class="list-group">
                                        <a href="/" class="list-group-item">Alumnos</a>
                                        <a href="/profile" class="list-group-item">Perfil</a>
                                    </div>
                                </div>
                                @endif
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
  </body>
</html>
