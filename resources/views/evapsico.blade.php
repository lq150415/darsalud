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
    <script language="javascript">
      function datospac()
      { var id= <?php echo $id?>;

        $.post("datospac2", { id: id }, function(data){
                    $("#datospac").html(data);
                });              }
      $(document).ready(function()
        {
            datospac();
        });
        $(document).ready(function(){
            var altura = '50';

            $(window).on('scroll', function(){
                if ( $(window).scrollTop() > altura ){
                    $('#menueva').css("top","2%");
                    $('#menueva2').css("top","0%");
                } else {
                    $('#menueva').css("top","11%");
                    $('#menueva2').css("top","8%");
                }
            });

        });
        </script>
</head>
<body style="background-color:#EFEEEE">

 <nav class="navbar navbar-inverse no-margin" style="border-radius: 0; background-color: #000;">
    <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header fixed-brand" >

                    <a class="navbar-brand" href="/" style="color: #21D3F3; padding-left: 14%; font-size: 25px;"><span class="fa fa-medkit"></span> <b>DARSALUD</b></a>
                </div><!-- navbar-header-->

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                </div><!-- bs-example-navbar-collapse-1 -->
    </nav>

        <!-- Sidebar -->

        <!-- Page Content -->
        <form class="form-horizontal" action="{{$ids}}/pdfpsico" method="post" target="_blank" accept-charset="UTF-8" name="fmedica" enctype="multipart/form-data">

                   <div id="menueva2" style="position: fixed; background-color:#B0EBEF; opacity: 100%; top: 9%; height:61px; z-index: 99; width:100%; padding:1% 8% 0 8%; font-size: 20px; ">EVALUACION PSICOLOGICA</div>


                       <div class="container">
<div  style="width:100%; background:#fff; margin-top:1%;">
  <div class="alert alert-info" style=" z-index: 1000;font-size:23px;">Evaluacion Psicologica <div id="menueva" style="right: 5%; top: 11%;  z-index: 100; position: fixed;"><button type="button" style="margin-left:-20%;" class="btn btn-success" onclick="javascript:datospac();"><span class="fa fa-refresh"></span></button><button class="btn" style="margin-left:1%; background-color: #279495; color:white" type="submit" name="guardar" formnovalidate formtarget="" ><span class="fa fa-floppy-o"></span></button><a style="margin-left:1%;" href="{{url('pacientes/'.$id)}}" class="btn btn-warning">Ver historial clinico</a> <button name="imprimir" type = "submit" target="_blank" class = "btn btn-primary" data-dismiss = "modal"><span class="fa fa-print"></span>
            Imprimir
          </button><a style="margin-left:1%;" href="<?php echo $ids;?>/finalizar" class="btn btn-danger">Finalizar</a></div></div>
  <div class="alert panel panel-success cuerpo" style="background:#fff; margin-top:-2.7%">
            <fieldset style="background-color:#BEEABE; padding: 2%;">
                <legend>
                    A) DATOS PERSONALES
                </legend>
                <div id="datospac">

                </div>
                <?php
                if(isset($datos)):
                  ?>
                <div class="form-group">

                <label class="col-lg-2">Lugar de nacimiento: </label>
                <div class="col-lg-3">
                    <input required="required" type="text" class="form-control" name="lug_nac" placeholder="LUGAR" value="{{$datos->LUG_NAC}}">
                </div>
              </div>
            </fieldset>
            <fieldset style="background-color:#B9DEE3; padding: 2%;">
                <legend>B) HISTORIA FAMILIAR</legend>

                <div class="form-group">
                    <label class="col-lg-2">DESCRIPCION : </label>
                    <div class="col-lg-9">
                        <textarea rows="10" class="form-control" name="his_psi" required="yes"  value="{{ $datos->his_psi}}">{{$datos->HIS_PSI}}</textarea>
                    </div>
            </fieldset>
            <fieldset style="background-color:#E9EBBF; padding: 2%;">
                <legend>C) EXAMEN PSICOLOGICO</legend>
                <label for="ejemplo_email_3" class="col-lg-11 control-label" style="text-align:left">1. Coordinacion visomotora</label>
<br/><br/>
    <div class="form-control">
  <label style="text-align:left; margin-right:10%;">
    <input type="radio" name="opciones" id="opciones_1" value="ADECUADO" <?php if($datos->EX1_PSI=='ADECUADO'){ echo 'checked'; }?> >
    ADECUADO
  </label>
  <label style="margin-right:10%;">
    <input type="radio" name="opciones" id="opciones_2" value="INADECUADO" <?php if($datos->EX1_PSI=='INADECUADO'){ echo 'checked'; }?> >
    INADECUADO
  </label>
    <label>
    <input type="radio" name="opciones" id="opciones_3" value="OBSERVACION" <?php if($datos->EX1_PSI=='OBSERVACION'){ echo 'checked'; }?> >
    OBSERVACION
  </label>

</div>
 <label for="ejemplo_email_3" class="col-lg-11 control-label" style="text-align:left">2. Personalidad</label>
<br/><br/>
    <div class="form-control">
  <label style="text-align:left; margin-right:10%;">
    <input type="radio" name="opciones1" id="opciones_1" value="ADECUADO" <?php if($datos->EX2_PSI=='ADECUADO'){ echo 'checked'; }?> >
    ADECUADO
  </label>
  <label style="margin-right:10%;">
    <input type="radio" name="opciones1" id="opciones_2" value="INADECUADO" <?php if($datos->EX2_PSI=='INADECUADO'){ echo 'checked'; }?> >
    INADECUADO
  </label>
    <label>
    <input type="radio" name="opciones1" id="opciones_3" value="OBSERVACION" <?php if($datos->EX2_PSI=='OBSERVACION'){ echo 'checked'; }?> >
    OBSERVACION
  </label>

</div>
 <label for="ejemplo_email_3" class="col-lg-11 control-label" style="text-align:left">3. Atencion, concentracion, memoria y coordinacion</label>
<br/><br/>
    <div class="form-control">
  <label style="text-align:left; margin-right:10%;">
    <input type="radio" name="opciones2" id="opciones_1" value="ADECUADO" <?php if($datos->EX3_PSI=='ADECUADO'){ echo 'checked'; }?> >
    ADECUADO
  </label>
  <label style="margin-right:10%;">
    <input type="radio" name="opciones2" id="opciones_2" value="INADECUADO" <?php if($datos->EX3_PSI=='INADECUADO'){ echo 'checked'; }?> >
    INADECUADO
  </label>
    <label style="margin-right:10%;">
    <input type="radio" name="opciones2" id="opciones_3" value="OBSERVACION" <?php if($datos->EX3_PSI=='OBSERVACION'){ echo 'checked'; }?> >
    OBSERVACION
  </label>

</div>
 <label for="ejemplo_email_3" class="col-lg-11 control-label" style="text-align:left">4. Prueba de reaccion ante situaciones de estres y riesgo</label>
<br/><br/>
    <div class="form-control">
  <label style="text-align:left; margin-right:10%;">
    <input type="radio" name="opciones3" id="opciones_1" value="OPTIMO" <?php if($datos->EX4_PSI=='OPTIMO'){ echo 'checked'; }?> >
    OPTIMO
  </label>
  <label style="margin-right:10%;">
    <input type="radio" name="opciones3" id="opciones_2" value="MEDIO" <?php if($datos->EX4_PSI=='MEDIO'){ echo 'checked'; }?> >
    MEDIO
  </label>
    <label>
    <input type="radio" name="opciones3" id="opciones_3" value="INADECUADO" <?php if($datos->EX4_PSI=='INADECUADO'){ echo 'checked'; }?> >
    INADECUADO
  </label>
  <label style="text-align:left; margin-right:10%;">
    <input type="radio" name="opciones3" id="opciones_1" value="OBSERVACION" <?php if($datos->EX4_PSI=='OBSERVACION'){ echo 'checked'; }?> >
    OBSERVACION
  </label>

</div></fieldset> <br/><br/><br/>
<fieldset style="background-color:#E3CFD3; padding: 2%;">
    <legend>RESULTADO FINAL DE LA EVALUACION PSICOLOGICA</legend>
    <div class="form-group">
        <label class="col-lg-11">OBSERVACIONES:(EN ESTE ACAPITE SE DEBE INCORPORAR SI EL POSTULANTE ES APTO PARA CONDUCIR VEHICULO, SI NO FUERA APTO INDICAR LOS MOTIVOS)</label>
        <div class="col-lg-11">
            <textarea required="yes" name="rfi_psi" class="form-control" rows="3">{{$datos->RFI_PSI}}</textarea>
        </div>
    </div>
</fieldset>

<?php else: ?>

  <div class="form-group">

  <label class="col-lg-2">Lugar de nacimiento: </label>
  <div class="col-lg-3">
      <input required="required" type="text" class="form-control" name="lug_nac" placeholder="LUGAR">
  </div>
</div>
</fieldset>
<fieldset style="background-color:#B9DEE3; padding: 2%;">
  <legend>B) HISTORIA FAMILIAR</legend>

  <div class="form-group">
      <label class="col-lg-2">DESCRIPCION : </label>
      <div class="col-lg-9">
          <textarea rows="10" class="form-control" name="his_psi" required="yes"  value="{{ $paciente->PRO_PAC}}"></textarea>
      </div>
</fieldset>
<fieldset style="background-color:#E9EBBF; padding: 2%;">
  <legend>C) EXAMEN PSICOLOGICO</legend>
  <label for="ejemplo_email_3" class="col-lg-11 control-label" style="text-align:left">1. Coordinacion visomotora</label>
<br/><br/>
<div class="form-control">
<label style="text-align:left; margin-right:10%;">
<input type="radio" name="opciones" id="opciones_1" value="ADECUADO" >
ADECUADO
</label>
<label style="margin-right:10%;">
<input type="radio" name="opciones" id="opciones_2" value="INADECUADO" >
INADECUADO
</label>
<label>
<input type="radio" name="opciones" id="opciones_3" value="OBSERVACION">
OBSERVACION
</label>

</div>
<label for="ejemplo_email_3" class="col-lg-11 control-label" style="text-align:left">2. Personalidad</label>
<br/><br/>
<div class="form-control">
<label style="text-align:left; margin-right:10%;">
<input type="radio" name="opciones1" id="opciones_1" value="ADECUADO" >
ADECUADO
</label>
<label style="margin-right:10%;">
<input type="radio" name="opciones1" id="opciones_2" value="INADECUADO" >
INADECUADO
</label>
<label>
<input type="radio" name="opciones1" id="opciones_3" value="OBSERVACION">
OBSERVACION
</label>

</div>
<label for="ejemplo_email_3" class="col-lg-11 control-label" style="text-align:left">3. Atencion, concentracion, memoria y coordinacion</label>
<br/><br/>
<div class="form-control">
<label style="text-align:left; margin-right:10%;">
<input type="radio" name="opciones2" id="opciones_1" value="ADECUADO" >
ADECUADO
</label>
<label style="margin-right:10%;">
<input type="radio" name="opciones2" id="opciones_2" value="INADECUADO" >
INADECUADO
</label>
<label style="margin-right:10%;">
<input type="radio" name="opciones2" id="opciones_3" value="OBSERVACION">
OBSERVACION
</label>

</div>
<label for="ejemplo_email_3" class="col-lg-11 control-label" style="text-align:left">4. Prueba de reaccion ante situaciones de estres y riesgo</label>
<br/><br/>
<div class="form-control">
<label style="text-align:left; margin-right:10%;">
<input type="radio" name="opciones3" id="opciones_1" value="OPTIMO" >
OPTIMO
</label>
<label style="margin-right:10%;">
<input type="radio" name="opciones3" id="opciones_2" value="MEDIO" >
MEDIO
</label>
<label>
<input type="radio" name="opciones3" id="opciones_3" value="INADECUADO">
INADECUADO
</label>
<label style="text-align:left; margin-right:10%;">
<input type="radio" name="opciones3" id="opciones_1" value="OBSERVACION" >
OBSERVACION
</label>

</div></fieldset> <br/><br/><br/>
<fieldset style="background-color:#E3CFD3; padding: 2%;">
<legend>RESULTADO FINAL DE LA EVALUACION PSICOLOGICA</legend>
<div class="form-group">
<label class="col-lg-11">OBSERVACIONES:(EN ESTE ACAPITE SE DEBE INCORPORAR SI EL POSTULANTE ES APTO PARA CONDUCIR VEHICULO, SI NO FUERA APTO INDICAR LOS MOTIVOS)</label>
<div class="col-lg-11">
<textarea required="yes" name="rfi_psi" class="form-control" rows="3">*** APTO PARA CONDUCIR VEHICULO TERRESTRE CATEGORIA " " ***</textarea>
</div>
</div>
</fieldset> <?php endif;?>       </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->


	{!! Html::script('assets/js/sidebar2.js')!!}
</body>
</html>
