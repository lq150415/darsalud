@extends('layout')
@section('contenido')
 <style type="text/css">
#grande{ 
         width:80%;
         margin-left:10%;
         height: 600px; 
         overflow:auto;      
	}
#uno{ 
	  border-radius:15px;
	  padding:30px;
      width:49%;
      height:45%;
      display:inline-block;   
      background: url('img/segip.jpg') no-repeat; 
      background-size: 100% 100%; 
	}
#uno:hover{
	opacity:0.80;
}
#dos{  
	  border-radius:15px;
	  padding:30px;
      width:49%;
      height:45%;
      display:inline-block;
      background: url('img/descarga.png'); 
      background-size: 100% 156%; 
	}
#dos:hover{
	opacity:0.80;
}
#tres{ 
		border-radius:15px;
		padding:30px;
       width:49%;
       height:45%;
       display:inline-block;
       background: url('img/farmacias.jpg') no-repeat; 
       background-size: 100% 150%; 
	}
	#tres:hover{
	opacity:0.80;
}
#cuatro{ 		border-radius:15px;
		padding:30px;
	  width:49%;
	  height:45%;
    display:inline-block;
    background: url('img/Factura.jpg') no-repeat; 
    background-size: 100% 100%; 
	}     
  #cuatro:hover{
  opacity:0.80;
}  
</style>

    <div id="grande">
    <a href="pacientessegip"><div id="uno"></div></a>
    <a href="pacientesdarsalud"><div id="dos"></div></a><br/><br/><br/>
    <a href="farmacia"><div id="tres"></div></a>
    <a href="facturacion"><div id="cuatro"></div></a>
   


@stop