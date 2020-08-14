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
      <img class="img-thumbnail mb-0" src="{{ asset('images/utn.jpg') }}" width="35" height="35">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav nav nav-pills mr-auto ml-3">
            <li class="nav-item">
              <a class="nav-link" href="#">Perfil </a>
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
                          <li class="breadcrumb-item"><a href="/">Seguimiento</a></li>
                          <li class="breadcrumb-item"><a href="/tracking/{{$student->id}}">{{$student->name}}</a></li>
                        </ol>
                    </nav>
                    <div class="card-body">
                      <div class="card-header">
                        <a href="/tracking/{{$student->id}}/add">
                          <button type="button" class="btn btn-primary">Nuevo</button>
                        </a>
                        @if($message)
                        <p style="color: #28A745; display: initial; margin-left: 10px;">{{$message}}</p>
                        @endif
                      </div>
                        <div class="jumbotron jumbotron-fluid shadow">
                            <div class="container">
                                @foreach ($student->reports as $report)
                                <div class="card mt-1" >
                                    <div class="card-header">  
                                        <div class="row">
                                            <div class="col-12" style="display: flex; justify-content: space-between;">
                                                <h4>Informe: {{$report->name}}</h4>
                                                <div style="display:flex;">
                                                  <a href="/tracking/{{$student->id}}/edit/{{$report->id}}" style="margin-right: 5px;">
                                                    <button type="button" class="btn btn-outline-warning btn-sm" data-toggle="dropdown" aria-haspopup="true" style="">
                                                      <i class="fas fa-edit"></i>
                                                    </button>
                                                  </a>
                                                  <form method="post" action="/report/remove">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" value="{{$report->id}}" name="id" />
                                                    <button type="submit" class="btn btn-outline-danger btn-sm" data-toggle="dropdown" aria-haspopup="true" style="">
                                                      <i class="fas fa-trash"></i>
                                                    </button>
                                                  </form>
                                                </div>
                                            </div>
                                        </div>                                  
                                    </div>
                                    <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Consigna: {{$report->slogan}}</li>
                                        <li class="list-group-item">Estado: {{$report->state}}</li>
                                        @if ($report->grade === null)
                                            <li class="list-group-item">Nota: -</li>
                                        @else
                                            <li class="list-group-item">Nota: {{$report->grade}}</li>
                                        @endif
                                        @if ($report->comments === null)
                                          <li class="list-group-item">Comentarios: -</li>
                                        @else
                                          <li class="list-group-item">Comentarios: {{$report->comments}}</li>
                                        @endif
                                        @if ($report->file === null)
                                        <li class="list-group-item">Archivo: -</li>
                                        @else
                                        <li class="list-group-item">Archivo: <a href="/storage/{{$report->file}}">{{$report->file}}</a></li>
                                        @endif
                                      </ul>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
  </body>
  <footer class="page-footer font-small p-3 mt-1" style="background-color: grey;">

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
</html>
