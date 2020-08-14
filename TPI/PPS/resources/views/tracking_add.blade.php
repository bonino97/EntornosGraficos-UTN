<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Seguimiento: {{$student->name}}</title>
    
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
                <a class="nav-link" href="/">Alumnos</a>
            </li>
          </ul>
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
                          <li class="breadcrumb-item"><a href="#">Seguimiento</a></li>
                          <li class="breadcrumb-item"><a href="/tracking/{{$student->id}}">{{$student->name}}</a></li>
                          <li class="breadcrumb-item"><a href="/tracking/{{$student->id}}/add">Agregar informe</a></li>
                        </ol>
                    </nav>
                    <div class="card-body col-6" >
                      <div class="card-header">
                        Agregar informe al alumno: {{$student->name}}
                      </div>
                        <div style="padding: 20px; background: #f7f7f7" class="shadow">
                            <div class="container">
                                <form action="/report/store" method="post">
                                  {{ csrf_field() }}
                                  <input name="user_id"  type="hidden" value="{{$student->id}}" />
                                  <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text" id="inputGroup-sizing-default">Titulo</span>
                                      </div>
                                      <input name="title" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
                                  </div>
                                  <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text" id="inputGroup-sizing-default">Consigna:</span>
                                      </div>
                                      <input name="slogan" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
                                  </div>
                                  @if($error)
                                    <p style="color: #CE6161;">{{ $error }}</p>
                                  @endif
                                  <div class="text-right">
                                      <button type="submit" class="btn btn-success end">Guardar</button>
                                  </div>
                                </form>
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
