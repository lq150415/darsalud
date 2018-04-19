<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>Dar salud - SISTEMA INFORMATICO MEDICO</title>
	{!! Html::style('assets/css/bootstrap.css') !!}
    {!! Html::style('css/table/jquery.dataTables.css')!!}
    {!! Html::style('font-awesome-4.6.3/css/font-awesome.css')!!}
    {!! Html::style('assets/css/sidebar.css') !!}
    {!! Html::script('assets/js/ajax.js')!!}
    {!! Html::script('assets/js/sidebar2.js')!!}
{!! Html::script('js/table/jquery.dataTables.js')!!}
    {!! Html::script('assets/js/bootstrap.js')!!}
<script type="text/javascript">
function limita(elEvento, maximoCaracteres) {
  var elemento = document.getElementById("texto");

  // Obtener la tecla pulsada
  var evento = elEvento || window.event;
  var codigoCaracter = evento.charCode || evento.keyCode;
  // Permitir utilizar las teclas con flecha horizontal
  if(codigoCaracter == 37 || codigoCaracter == 39) {
    return true;
  }

  // Permitir borrar con la tecla Backspace y con la tecla Supr.
  if(codigoCaracter == 8 || codigoCaracter == 46) {
    return true;
  }
  else if(elemento.value.length >= maximoCaracteres ) {
    return false;
  }
  else {
    return true;
  }
}
 </script>

<script type="text/javascript">
  function pdfreceta()
  {
    document.fmedica.submit();


  }
</script>
<script language="Javascript">
function preguntar(data1){

if (confirm("¿Esta seguro/a de salir?. Los datos se perderan!?")==true){
location='/pacientes/'+data1;
}
else{
return false;
}
}
</script>
 <script type="text/javascript">
    function showContent() {
        element = document.getElementById("especialidades");
        if (document.fmedica.opciones7[1].checked == true) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }
</script>

</head>
<body style="background-color:#EFEEEE">

 <nav class="navbar navbar-inverse no-margin" style="border-radius: 0; background-color: #000;">
    <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header fixed-brand" >

                    <a class="navbar-brand" href="{{ url('pacientes/'.$id)}}" style="color: #21D3F3; padding-left: 14%; font-size: 25px;"><span class="fa fa-medkit"></span> <b>DARSALUD</b></a>
                </div><!-- navbar-header-->

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                </div><!-- bs-example-navbar-collapse-1 -->
    </nav>

        <!-- Sidebar -->

        <!-- Page Content -->

        <form class="form-horizontal" action="pdfreceta" method="post" target="_blank" accept-charset="UTF-8" name="fmedica" enctype="multipart/form-data">

                       <div class="container">
<div  style="width:100%; background:#fff; margin-top:1%;">
    <div class="alert alert-info" style="font-size:23px;">Recetas<a style="margin-left:50%;" onclick='javascript:preguntar({{ $id }});'  class="btn btn-warning">Volver al historial</a> <a target="_blank" style="margin-left:1%;" class = "btn btn-primary" onclick="javascript:pdfreceta();"><span class="fa fa-print"></span>
              Imprimir
            </a>

            <button type="submit" name="finreceta" style="margin-left:1%;" formtarget="" class = "btn btn-danger"  ><span class="fa fa-print"></span>
                      Finalizar
                    </button></div>
    <div class="alert panel panel-success cuerpo" style="background:#fff; margin-top:-2.7%">
            <fieldset style="background-color:#BEEABE; padding: 2%;">
                <legend>
                     Paciente
                </legend>
                <div class="form-group">
                    <label class="col-lg-2">Apellido paterno: </label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" name="" readonly="readonly" value="{{ $paciente->APA_PAC}}">
                    </div>
                    <label class="col-lg-2">Apellido materno: </label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" readonly="readonly" name="" value="{{ $paciente->AMA_PAC}}">
                    </div>
                    <div style="float:right; margin-right:2%; margin-top: -5%; height:50px;"><output id="list"></output></div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2">Nombres: </label>
                    <div class="col-lg-3">
                        <input type="text" readonly="readonly" class="form-control" name="" value="{{ $paciente->NOM_PAC}}">
                    </div>
                    <label class="col-lg-2">CI: </label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" readonly="readonly" name="" value="{{ $paciente->CI_PAC}}">
                    </div>
                </div>
                <div class="form-group">

                    <label class="col-lg-2">Sexo: </label>
                    <div class="col-lg-3">
                        <input type="text" readonly="readonly" class="form-control" name="" value="{{ $paciente->SEX_PAC}}">
                    </div>                                   <label class="col-lg-2">Edad: </label>
                    <div class="col-lg-3">
                        <input type="text" readonly="readonly" class="form-control" name="" value="<?php
      $edad = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente->FEC_PAC)->format('Y');
      $edad2 = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente->FEC_PAC)->format('m');
      $edad3 = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente->FEC_PAC)->format('d');

       echo $date = \Carbon\Carbon::createFromDate($edad,$edad3,$edad2)->age;
       ?>">
                    </div>
                </div>
                </fieldset>
            <fieldset style="background-color:#B9DEE3; padding: 2%;">
                <legend>Receta medica</legend>
                <div class="form-group">
                    <div class="col-lg-12">
                        <textarea rows="15" id="texto"  class="form-control" name="rec_med" ></textarea>
                    </div>
                   </div>
                   </fieldset>
                   <div class = "modal-footer">
            <button type = "submit" target="_blank" class = "btn btn-primary" data-dismiss = "modal"><span class="fa fa-print"></span>
              Imprimir receta
            </button>


         </div>
        </form>
            </form>
</body>
</html>
