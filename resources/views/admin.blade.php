<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>Panel de administrador - Dar salud</title>
    {!! Html::style('assets/css/bootstrap.css') !!}
    {!! Html::style('css/table/jquery.dataTables.css')!!}
      <link href="font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet">
    {!! Html::style('assets/css/sidebar.css') !!}
    {!! Html::script('assets/js/ajax.js')!!}
    {!! Html::script('assets/js/sidebar2.js')!!}
    {!! Html::script('js/table/jquery.dataTables.js')!!}
    <link href="https://fonts.googleapis.com/css?family=Alef|Arsenal|Didact+Gothic|Fauna+One|Gudea|Julius+Sans+One|Poiret+One|Roboto" rel="stylesheet">
<script type="text/javascript" language="javascript" class="init">
            $(document).ready(function() {
    $('#example').DataTable();
} );
        </script>
<script type="text/javascript" language="javascript" class="init">
            $(document).ready(function() {
    $('#example2').DataTable();
} );
        </script>
<script type="text/javascript" language="javascript" class="init">
            $(document).ready(function() {
    $('#example3').DataTable();
} );
        </script>
<script type="text/javascript" language="javascript" class="init">
            $(document).ready(function() {
    $('#example4').DataTable();
} );
        </script>
</head>
<body style="background-image:url({{ asset('img/fondo.jpg') }});">

 <nav class="navbar navbar-inverse no-margin" style="border-radius: 0; background-color: #000;">
    <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header fixed-brand" >
                    <button type="button"  class="navbar-toggle collapsed" data-toggle="collapse"  id="menu-toggle">
                      <span  class="glyphicon glyphicon-th-large" aria-hidden="true" style="color: #fff;"></span>
                    </button>
                    <a class="navbar-brand" href="{{url('/')}}" style="color: #21D3F3; padding-left: 14%; font-size: 25px;"><span class="fa fa-medkit"></span> <b>DARSALUD</b></a>
                </div><!-- navbar-header-->

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li class="active" ><button class="navbar-toggle collapse in" data-toggle="collapse" id="menu-toggle-2"> <span class="fa fa-reorder" aria-hidden="true" style="color: #fff;"></span></button></li>
                            </ul>
                            <a class="btn btn-danger" style="float:right; margin-top:1%;" href="{{ url('logout') }}">CERRAR SESION</a>
                </div><!-- bs-example-navbar-collapse-1 -->
    </nav>
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav nav-pills nav-stacked" id="menu">

                <li class="active" style="height:auto;">
                    <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-user fa-stack-1x" style="font-size:50px; margin-top:50%; margin-left: -25%; "></i></span><b style="margin-left:10%;"> Administrador </b><br/><b style="margin-left:30%; font-size:12px;"> {{Auth::user()->NOM_USU.' '.Auth::user()->APA_USU}} </b><br/><span class="fa fa-circle" style="color:#00FF06; font-size:10px; margin-left:23%;"> </span> Activo<span class="fa fa-sort-desc"></span></a>
                       <ul class="nav-pills nav-stacked" style="list-style-type:none;">
                        <li><a href="#">Ver perfil</a></li>
                        <li><a href="#">Cerrar sesion</a></li>
                    </ul>
                </li>

                <li style="background-color:#333;">
                    <a href="#" style="pointer-events: none;"><span class="fa-stack fa-lg pull-left"><i class="fa fa-menu fa-stack-1x "></i></span>Menu</a>
                </li>
                <li>
                    <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-male fa-stack-1x "></i></span> Administrar contenido <span class="fa-stack fa-lg pull-right"><i class="fa fa-caret-down fa-stack-1x "></i></span></a>
                    <ul class="nav-pills nav-stacked" style="list-style-type:none;">
                      <li><a href="adminpaciente"><span class="fa-stack fa-lg pull-left"><i class="fa fa-edit fa-stack-1x "></i></span>Clientes</a></li>
                      <li><a href="adminusuarios"><span class="fa-stack fa-lg pull-left"><i class="fa fa-users fa-stack-1x "></i></span>Usuarios</a></li>

                    </ul>
                </li>
                <li>
                    <a href="{{url('repventas')}}"> <span class="fa-stack fa-lg pull-left"><i class="fa fa-usd fa-stack-1x "></i></span>Reporte de ventas</a>
                </li>
                <li>
                    <a href="{{url('repmedicos')}}"><span class="fa-stack fa-lg pull-left"><i class="fa fa-info fa-stack-1x "></i></span>Informe por medicos</a>
                </li>
                <li>
                    <a href="{{url('repevaluacion')}}"><span class="fa-stack fa-lg pull-left"><i class="fa fa-folder-open-o fa-stack-1x "></i></span>Informe por evaluaciones</a>
                </li>
                <li>
                    <a href="{{url('graficos')}}"><span class="fa-stack fa-lg pull-left"><i class="fa fa-bar-chart-o fa-stack-1x "></i></span>Cuadros estadisticos</a>
                </li>
            </ul>
        </div><!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid"  >
                <div class="row">
                    <div class="col-lg-12"  >
                            @yield('contenido')
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    {!! Html::script('assets/js/bootstrap.min.js')!!}
	{!! Html::script('assets/js/sidebar2.js')!!}
</body>
</html>
