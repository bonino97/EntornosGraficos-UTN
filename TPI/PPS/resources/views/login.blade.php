<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Login a PPS</title>
        <link href="{{ asset('css/bootstrap.min.css') }}" type="text/css" rel="stylesheet">
        <link href="{{ asset('css/login.css') }}" type="text/css" rel="stylesheet">
    </head>

    <body class="text-center">
        <form id="loginForm" class="form-signin shadow" action="/login" method="post">
        {{ csrf_field() }}
        <img alt="UTN" title="Logo de la UTN" class="mb-4 shadowS" src="{{ asset('images/utn.jpg') }}" width="200" height="200" longdesc="#LogoDeLaUTN">
        <label for="email" class="sr-only">Email</label>
        <input id="email" name="email" type="email" class="form-control" placeholder="Email" required autofocus>
        <label for="password" class="sr-only">Password</label>
        <input id="password" name="password" type="password" class="form-control" placeholder="Password" required>
        <p style="color: #CE6161;">{{ $error }}</p>
        <p style="color: #28A745;">{{ $message }}</p>
        <div class="checkbox mb-3">
            <a id="forgetPassword" href="javascript:void(0)" >¿Olvidaste tu contraseña?</a>
        </div>
        <div class="row">
            <div class="col-sm-6 btn-group-sm">
                <a class="btn btn-lg btn-outline-secondary btn-block" href="/register">Crear Cuenta</a>
            </div>
            <div class="col-sm-6 btn-group-sm">
                <button class="btn btn-lg btn-outline-secondary btn-block" type="submit">Iniciar Sesion</button>
            </div>
        </div>
        <p class="mt-5 mb-3 text-muted">© 2020</p>
        </form>
        <div id="myModal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title">Resetar clave</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/resetPassword" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            <label for="email_reset_password" class="input-group-text">Email</label>
                            </div>
                            <input id="email_reset_password" name="email_reset_password" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Resetear</button>
                    </div>
                </form>
               </div>
            </div>
        </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>   
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script>
        $('#forgetPassword').on('click', function () {
            $('#myModal').modal('show');
        })
    </script>
    </body>
</html>
