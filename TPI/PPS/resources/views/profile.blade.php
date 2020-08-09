<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Perfil</title>

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
              <a class="nav-link" href="#">Tutor</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/">Mis Informes</a>
            </li>
          </ul>
          <form class="form-inline mt-2 mt-md-0">
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
              <button type="button" class="btn btn-outline-danger btn-sm"><i class="fas fa-sign-out-alt"></i></button>
          </form>
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
                          <li class="breadcrumb-item"><a href="#">Perfil</a></li>
                        </ol>
                    </nav>

                    <div class="card-body">
                        <div class="jumbotron jumbotron-fluid shadow">
                            <div class="container">
                                <div class="card mx-auto border-dark" style="width: 25rem;">
                                    <img class="card-img-top img-thumbnail" src="{{ asset('images/utn.jpg') }}">
                                    <form method="post" action="/profile">
                                        {{ csrf_field() }}
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">
                                                    <input name="name" class="form-control modify" type="text" placeholder="Nombre" value="{{ $user->name }}">
                                                    <h5 class="card-title text-center data">{{ $user->name }}</h5>
                                                </li>
                                                <li class="list-group-item">
                                                    <input name="email" class="form-control modify" type="text" placeholder="Email" value="{{ $user->email }}">
                                                    <p class="card-title text-center data">{{ $user->email }}</p>
                                                </li>
                                                <li class="list-group-item">
                                                    <p class="card-title text-center">{{ $user->file }}</p>
                                                </li>
                                            </ul>
                                            <p style="color: {{ $color }}; text-align: center;">{{ $message }}</p>
                                        </div>
    
                                        <div class="card-body">
                                            <button type="button" class="btn btn-outline-dark btn-block data btn-data">Editar Perfil</button>
                                            <button type="submit" class="btn btn-outline-dark btn-block modify">Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-3 ">
              <h4 class="mb-4">
                <form class="form-inline mt-2 mt-md-0">
                    <input class="form-control mr-sm-2 col-9 mr-1" type="text" placeholder="Buscar">
                    <button class="btn btn-outline-danger my-2 my-sm-0 col-2" type="submit"><i class="fas fa-search"></i></button>
                </form>
              </h4>
                <div class="card shadow">
                    <h4 class="card-header">Actividad Reciente</h4>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Contenido 1</li>
                            <li class="list-group-item">Contenido 2</li>
                            <li class="list-group-item">Contenido 3</li>
                            <li class="list-group-item">Contenido 4</li>
                            <li class="list-group-item">Contenido 5</li>
                            <li class="list-group-item">Contenido 6</li>
                            <li class="list-group-item">Contenido 7</li>
                            <li class="list-group-item">Contenido 8</li>
                            <li class="list-group-item">Contenido 9</li>
                            <li class="list-group-item">Contenido 10</li>
                        </ul>
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
    <script>
        $(".btn-data").click(function() {
            $(".data").hide();
            $(".modify").show();
        });
    </script>
  </body>
</html>
