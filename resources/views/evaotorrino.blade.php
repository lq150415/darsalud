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
      <link href="font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet">
    {!! Html::style('assets/css/sidebar.css') !!}
    {!! Html::script('assets/js/ajax.js')!!}
    {!! Html::script('assets/js/sidebar2.js')!!}
{!! Html::script('js/table/jquery.dataTables.js')!!}
    {!! Html::script('assets/js/bootstrap.js')!!}

</head>
<body style="background-color:#EFEEEE">

 <nav class="navbar navbar-inverse no-margin" style="border-radius: 0; background-color: #000;">
    <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header fixed-brand" >

                    <a class="navbar-brand" href="{{url('/')}}" style="color: #21D3F3; padding-left: 14%; font-size: 25px;"><span class="fa fa-medkit"></span> <b>DARSALUD</b></a>
                </div><!-- navbar-header-->

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                </div><!-- bs-example-navbar-collapse-1 -->
    </nav>

        <!-- Sidebar -->

        <!-- Page Content -->


                       <div class="container">
<div  style="width:100%; background:#fff; margin-top:1%;">
    <div class="alert alert-info" style="font-size:23px;">Evaluacion Otorrinolaringologica <a style="margin-left:45%;" href="../../<?php echo $id;?>" class="btn btn-primary">Ver historial clinico</a><a style="margin-left:2%;" href="<?php echo $ids;?>/finalizar" class="btn btn-danger">Finalizar</a></div>
    <div class="alert panel panel-success cuerpo" style="background:#fff; margin-top:-2.7%">
        <form class="form-horizontal" action="{{$ids}}/pdfotorrino" method="post" target="_blank">
            <fieldset style="background-color:#BEEABE; padding: 2%;">
                <legend>
                    A) DATOS PERSONALES
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
                    <label class="col-lg-2">Lugar de nacimiento: </label>
                    <div class="col-lg-3">
                        <input required="required" type="text" class="form-control" name="lug_nac" placeholder="LUGAR">
                    </div>
                    <label class="col-lg-2">Fecha de nacimiento: </label>
                    <div class="col-lg-2">
                        <input type="text" readonly="readonly" class="form-control" name="" value="{{ $paciente->FEC_PAC}}">
                    </div>                                   <label class="col-lg-1">Edad: </label>
                    <div class="col-lg-1">
                        <input type="text" readonly="readonly" class="form-control" name="" value="<?php
      $edad = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente->FEC_PAC)->format('Y');
      $edad2 = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente->FEC_PAC)->format('m');
      $edad3 = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente->FEC_PAC)->format('d');

       echo $date = \Carbon\Carbon::createFromDate($edad,$edad3,$edad2)->age;
       ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2">Profesion : </label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" name="" readonly="readonly" value="{{ $paciente->PRO_PAC}}">
                    </div>
                    <label class="col-lg-2">Fecha del examen : </label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" readonly="readonly" name="" value="{{ \Carbon\Carbon::now()->format('d-m-Y')}}">
                    </div>

                </div>
                <div class="form-group">
                    <label class="col-lg-2">Direccion : </label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="" readonly="readonly" value="{{ $paciente->DOM_PAC}}">
                    </div>
                </div>
            </fieldset>
            <fieldset style="background-color:#B9DEE3; padding: 2%;">
                <legend>B) ANTECEDENTES</legend>
                <div class="form-group">
                    <div class="col-lg-11">
                        <textarea rows="10" class="form-control" name="ant_oto" required="yes"  ></textarea>
                    </div>
                    </div>
            </fieldset>
            <fieldset style="background-color:#E9EBBF; padding: 2%;">
                <legend>C) EXAMEN FISICO</legend>
               <div class="form-group">
                    <div class="col-lg-11">
                        <textarea rows="10" class="form-control" name="efi_oto" required="yes" > </textarea>
                    </div>
                    </div>
            </fieldset>
            <fieldset style="background-color:#CDBFEB; padding: 2%;">
                <legend>D) CONCLUSION</legend>
               <div class="form-group">
                    <div class="col-lg-11">
                        <textarea rows="10" class="form-control" name="con_oto" required="yes"  ></textarea>
                    </div>
                    </div>
            </fieldset>
             <br/><br/><br/>
<fieldset style="background-color:#E3CFD3; padding: 2%;">
    <legend>RESULTADO FINAL DE LA EVALUACION OTORRINOLARINGOLOGICA</legend>
    <div class="form-group">
        <label class="col-lg-11">OBSERVACIONES:(EN ESTE ACAPITE SE DEBE INCORPORAR SI EL POSTULANTE ES APTO PARA CONDUCIR VEHICULO, SI NO FUERA APTO INDICAR LOS MOTIVOS)</label>
        <div class="col-lg-11">
            <textarea required="yes" name="rfi_oto" class="form-control" rows="3">APTO PARA CONDUCIR CATEGORIA " " </textarea>
        </div>
    </div>
</fieldset>
<div class = "modal-footer">
            <button type = "submit" target="_blank" class = "btn btn-primary" data-dismiss = "modal"><span class="glyphicon glyphicon-check"></span>
              IMPRIMIR EVALUACION
            </button>


         </div>
        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->


	{!! Html::script('assets/js/sidebar2.js')!!}
</body>
</html>
