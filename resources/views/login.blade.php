<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>Iniciar sesion - Dar salud</title>
	{!! Html::style('assets/css/bootstrap.css') !!}

	  <link href="font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet">
	{!! Html::style('assets/css/login.css') !!}
	{!! Html::script('assets/js/ajax.js')!!}
	{!! Html::script('assets/js/bootstrap.js')!!}
	{!! Html::script('assets/js/sidebar2.js')!!}
</head>
<body style="background-image:url({{ asset('img/fondo.jpg') }}) ;">
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">

            <div class="account-wall" style="background-color: #AAE0F0;">
                <img class="" style="width: 55%; margin-left: 23%;" src="{{ asset('img/logo.png') }}"
                    alt="">
                <form class="form-signin" method="post" action="login">
                @if (count($errors))
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
                <h1 class="text-center login-title"><b>Inicio de sesion</b></h1>
                <input type="text" class="form-control" placeholder="Nombre de usuario" name="NIC_USU" id="NIC_USU" required autofocus>
                <br/>
                <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required>
                <br/>
                <button class="btn btn-lg btn-primary btn-block" type="submit"><span class="fa fa-sign-in"></span>
                    Ingresar</button>

                </form>
            </div>

        </div>
    </div>
</div>

    {!! Html::script('assets/js/bootstrap.js')!!}
    {!! Html::script('assets/js/bootstrap.min.js')!!}
	{!! Html::script('assets/js/sidebar2.js')!!}
</body>
</html>
