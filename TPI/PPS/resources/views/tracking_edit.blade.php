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
                          <li class="breadcrumb-item"><a href="/">Seguimiento</a></li>
                          <li class="breadcrumb-item"><a href="/tracking/{{$student->id}}">{{$student->name}}</a></li>
                          <li class="breadcrumb-item"><a href="/tracking/{{$student->id}}/add">Editar informe</a></li>
                        </ol>
                    </nav>
                    <div class="card-body col-6" >
                      <div class="card-header">
                        Editar informe: "{{$report->name}}" del alumno {{$student->name}}
                      </div>
                        <div style="padding: 20px; background: #f7f7f7" class="shadow">
                            <div class="container">
                                <form action="/report/edit" method="post">
                                  {{ csrf_field() }}
                                  <input name="user_id"  type="hidden" value="{{$student->id}}" />
                                  <input name="report_id"  type="hidden" value="{{$report->id}}" />
                                  <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text" id="inputGroup-sizing-default">Titulo</span>
                                      </div>
                                      <input value="{{$report->name}}" name="title" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                  </div>
                                  <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text" id="inputGroup-sizing-default">Consigna:</span>
                                      </div>
                                      <input value="{{$report->slogan}}" name="slogan" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                  </div>
                                  <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text" id="inputGroup-sizing-default">Nota:</span>
                                      </div>
                                      <input value="{{$report->grade}}" name="grade" type="number" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                  </div>
                                  <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text" id="inputGroup-sizing-default">Comentarios:</span>
                                      </div>
                                      <input value="{{$report->comments}}" name="comments" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                  </div>
                                  <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text" id="inputGroup-sizing-default">Estado:</span>
                                      </div>
                                      <select name="state" class="custom-select">
                                        <option value="Aprobada">Aprobada</option> 
                                        <option value="Desaprobada">Desaprobada</option>
                                        <option value="A corregir">A corregir</option>
                                    </select>
                                  </div>
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
  </body>
</html>
