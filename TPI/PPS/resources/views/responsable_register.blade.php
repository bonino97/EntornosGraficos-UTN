<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Registro</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
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
                  <a class="nav-link" href="/">Nuevas Solicitudes </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="/">Registro</a>
                </li>
            </ul>
        </div>
      </nav>
    </header>

    <!-- Begin page content -->
    <div role="main"  class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="/">Portada</a></li>
                          <li class="breadcrumb-item"><a href="/">Registro</a></li>
                        </ol>
                    </nav>

                    <div class="row mb-1">
                        <div class="col-12 text-center text-info">
                            <h3> <strong> Registro de Alumnos PPS </strong> </h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="jumbotron jumbotron-fluid shadow">
                            <div class="container">
                                <div class="col-sm-12">
                                    <h5>
                                        <strong>
                                            Activos: 
                                        </strong> 
                                    </h5>
                                </div>
                                @foreach($enableUsers as $enableUser)
                                <div class="card" >
                                    <div class="card-header">  
                                        <div class="row">
                                            <div class="col-10">
                                                <h4>{{$enableUser->name}}</h4>
                                            </div>
                                            <div class="col-2">
                                                <form method="post" action="/user/finishPPS">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id" value="{{$enableUser->id}}" />
                                                    <button type="submit" class="btn btn-outline-info shadow btn-block btn-sm">Finalizar PPS</button>
                                                </form>
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <hr>
                            <div class="container">
                                <div class="col-sm-12">
                                    <h5>
                                        <strong>
                                            Inactivos: 
                                        </strong> 
                                    </h5>
                                </div>
                                @foreach($disableUsers as $disableUser)
                                <div class="card" >
                                    <div class="card-header">  
                                        <div class="row">
                                            <div class="col-10">
                                                <h4>{{$disableUser->name}}</h4>
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
