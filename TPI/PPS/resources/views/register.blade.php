<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Register</title>
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    </head>

    <body class="text-center">
        <form id="registerForm" class="form-signin shadow" action="{{URL::to('/register')}}" method="post">
            {{ csrf_field() }}
            <img class="mb-4 shadowS" src="{{ asset('images/utn.jpg') }}" alt="" width="200" height="200">
            <label class="sr-only">Nombre</label>
            <input name="name" type="name" class="form-control" placeholder="Nombre" required="" autofocus="">
            <label class="sr-only">Email</label>
            <input name="email" type="email" class="form-control" placeholder="Email" required="" autofocus="">
            <label for="inputPassword" class="sr-only">Password</label>
            <input name="password" type="password" class="form-control" placeholder="Password" required="">
            <!-- <input type="text" name="_token" value="{{csrf_token()}}"> -->
            <p style="color: #CE6161;">{{ $error ?? '' }}</p>

            <div class="row">
                <div class="col-sm-12 btn-group-sm">
                    <button class="btn btn-lg btn-outline-secondary btn-block" type="submit">Aceptar</button>
                </div>
            </div>
 
            <p class="mt-5 mb-3 text-muted">© 2020</p>
        </form>
    </body>
</html>