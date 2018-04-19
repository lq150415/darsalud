<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>Administrador - DARSALUD</title>
	{!! Html::style('assets/css/bootstrap.css') !!}
    {!! Html::style('css/table/jquery.dataTables.css')!!}
      <link href="font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet">
    {!! Html::style('assets/css/sidebar.css') !!}
    {!! Html::script('assets/js/ajax.js')!!}
    {!! Html::script('assets/js/sidebar2.js')!!}
{!! Html::script('js/table/jquery.dataTables.js')!!}
    {!! Html::script('assets/js/bootstrap.js')!!}
    <style type="text/css">
#grande{ 
         width:80%;
         margin-left:10%;
         height: auto;       
	}
#uno{ border:1px solid #FE2E2E;
		border-radius:15px;
		padding:30px;
      width:49%;
      height:250px;
      display:inline-block;     
	}
#dos{ border:1px solid #FE2E2E;
		border-radius:15px;
		padding:30px;
      width:49%;
      height:250px;
      display:inline-block;
	}
#tres{ border:1px solid #FE2E2E;
		border-radius:15px;
		padding:30px;
       width:49%;
       height:250px;
       display:inline-block;
	}
#cuatro{ border:1px solid #FE2E2E;
		border-radius:15px;
		padding:30px;
	width:49%;
	height:250px;
       display:inline-block;
	}       
</style>
</head>
<body>
<nav class="navbar navbar-inverse" role="navigation">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only"><b style="color: #21D3F3;">DARSALUD</b></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">DARSALUD</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			
			
			<ul class="nav navbar-nav navbar-right">
				
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-circle" style="color:#18FF00; font-size: 10px;"> </span> Usuario - <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="#">Perfil</a></li>
						<li><a href="#">Cerrar sesion</a></li>

					</ul>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div>
</nav>


    <div id="grande">
    <div id="uno">1</div>
    <div id="dos">2</div><br/><br/><br/>
    <div id="tres">3</div>
    <div id="cuatro">4</div>
   
</body>
</html>