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
            <div class="btn-group dropleft">
                <button type="button" class="btn btn-outline-success btn-sm" data-toggle="dropdown" aria-haspopup="true" style="">
                  <i class="far fa-bell"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="#"> Notificacion 1 </a>
                  <a class="dropdown-item" href="#"> Notificacion 2 </a>
                  <a class="dropdown-item" href="#"> Notificacion 3 </a>
                </div>
              </div>
              &nbsp;
              <form action="/logout" method="post">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fas fa-sign-out-alt"></i></button>
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
                          <li class="breadcrumb-item"><a href="#">Seguimiento</a></li>
                          <li class="breadcrumb-item"><a href="/tracking/{{$student->id}}">{{$student->name}}</a></li>
                        </ol>
                    </nav>
                    <div class="card-body">
                      <div class="card-header">
                        <a href="/tracking/{{$student->id}}/add">
                          <button type="button" class="btn btn-primary">Nuevo</button>
                        </a>
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

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="./js/vendor/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
  </body>

</html>
