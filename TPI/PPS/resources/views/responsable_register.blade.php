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
        <img class="img-thumbnail mb-0" src="{{ asset('images/utn.jpg') }}" width="35" height="35">
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
  </body>
</html>
