<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>Dar salud - SISTEMA INFORMATICO MEDICO</title>
	{!! Html::style('assets/css/bootstrap.css') !!}
    {!! Html::style('css/table/jquery.dataTables.css')!!}
    <link href="https://fonts.googleapis.com/css?family=Alef|Arsenal|Didact+Gothic|Fauna+One|Gudea|Julius+Sans+One|Poiret+One|Roboto" rel="stylesheet">
      <link href="font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet">
    {!! Html::style('assets/css/sidebar.css') !!}
    {!! Html::script('assets/js/ajax.js')!!}
    {!! Html::script('assets/js/sidebar2.js')!!}
    {!! Html::script('js/table/jquery.dataTables.js')!!}
    {!! Html::script('assets/js/bootstrap.js')!!}

    <script type="text/javascript">
 var ind=1;
 var ind2=1;
$(function(){

    // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
    $("#agregar").on('click', function(){

        if(ind<=1){
            ind=2;
        }else
        {
            ind2++;
            $("#tabla tbody tr:eq(0)").clone().prependTo("#tabla tbody");

        }
    });

    // Evento que selecciona la fila y la elimina

    $(document).on("click",".eliminar",function(){
        if(ind2==1){
            ind--;

            $('#producto').val(' ');
            $('#producto2').val(' ');
            $('#pre_pro').val(' ');
            $('#sub_pro').val(' ');
            $('#can_pro').val(' ');
            $('#total').val('0');

        }else{
        var parent = $(this).parents().get(0);
        $(parent).remove();
        ind2--;

        }
    });

    $(document).on("click",".eliminar2",function(){
        if(ind2==1){
            ind--;

            $('#producto').val(' ');
            $('#producto2').val(' ');
            $('#pre_pro').val(' ');
            $('#sub_pro').val(' ');
            $('#can_pro').val(' ');
            $('#total').val('0');

        }else{
  document.getElementById("tabla").deleteRow(1);
        ind2--;
        }
    });
});
</script>
</head>
<body style="background-color:#EFEEEE">

 <nav class="navbar navbar-inverse no-margin" style="border-radius: 0; background-color: #000;">
    <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header fixed-brand" >
                    <button type="button"  class="navbar-toggle collapsed" data-toggle="collapse"  id="menu-toggle">
                      <span  class="glyphicon glyphicon-th-large" aria-hidden="true" style="color: #fff;"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}" style="color: #21D3F3; padding-left: 14%; font-size: 25px;"><span class="fa fa-medkit"></span> <b>DARSALUD</b></a>
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
                    <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-user fa-stack-1x" style="font-size:50px; margin-top:50%; margin-left: -25%; "></i></span><b style="margin-left:10%;"> Usuario - {{Auth::user()->NOM_USU}} </b><br/><span class="fa fa-circle" style="color:#00FF06; font-size:10px; margin-left:23%;"> </span> Activo<span class="fa fa-sort-desc"></span></a>
                       <ul class="nav-pills nav-stacked" style="list-style-type:none;">
                        <li><a href="#">Ver perfil</a></li>
                        <li><a href="{{ url('logout') }}">Cerrar sesion</a></li>
                    </ul>
                </li>

                <li style="background-color:#333;">
                    <a href="#" style="pointer-events: none;"><span class="fa-stack fa-lg pull-left"><i class="fa fa-menu fa-stack-1x "></i></span>Menu</a>
                </li>
                <li>
                    <a href="#"><span class="fa-stack fa-lg pull-left"><i class="fa fa-male fa-stack-1x "></i></span> Pacientes</a>
                    <ul class="nav-pills nav-stacked" style="list-style-type:none;">
                        <li><a href="{{ url('pacientessegip') }}"><span class="fa-stack fa-lg pull-left"><i class="fa fa-keyboard-o fa-stack-1x "></i></span>Registro SEGIP</a></li>
                        <li><a href="{{ url('pacientesdarsalud') }}"><span class="fa-stack fa-lg pull-left"><i class="fa fa-keyboard-o fa-stack-1x "></i></span>Registro DAR SALUD</a></li>
                        <li><a href="{{ url('facturacion') }}"><span class="fa-stack fa-lg pull-left"><i class="fa fa-barcode fa-stack-1x "></i></span>Facturacion</a></li>

                    </ul>
                </li>
                <li>
                    <a href="{{ url('farmacia') }}"> <span class="fa-stack fa-lg pull-left"><i class="fa fa-cart-plus fa-stack-1x "></i></span>Farmacia</a>
                </li>
                <li>
                    <a href="{{ url('reservas') }}"> <span class="fa-stack fa-lg pull-left"><i class="fa fa-calendar fa-stack-1x "></i></span>Reservas</a>
                </li>
                <li>
                    <a href="{{ url('export') }}"> <span class="fa-stack fa-lg pull-left"><i class="fa fa-file-excel-o fa-stack-1x "></i></span>Lista diaria SEGIP</a>
                </li>
            </ul>
        </div><!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid xyz">
                <div class="row">
                    <div class="col-lg-12" style="overflow:auto; padding:30px;">
                        @yield('contenido')
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>

	{!! Html::script('assets/js/sidebar2.js')!!}
</body>
</html>
