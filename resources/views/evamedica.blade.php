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
   function validar(){
     console.log($('#img').val());
     if($('#img').val()==''){
        return false;
      }
   }
 </script>
<script language="javascript">
  function datospac()
  { var id= <?php echo $id?>;

    $.post("datospac", { id: id }, function(data){
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
$(document).ready(function(){
    $('#apto').change(function ()
    {
        $('#apto option:selected').each(function()
        {
          if (($(this).val()).length >0) {
            if($(this).val()==1){
            $('#catapto').css("display","block");
             $('#noapto').css("display","none");
            }
            if($(this).val()==2){
            $('#noapto').css("display","block");
             $('#catapto').css("display","none");
            }
          }
        });
    });

});
</script>
 <script type="text/javascript">
    function showContent() {
        element = document.getElementById("especialidades");
        if ($('#opciones_11').checked == true) {
            element.style.display='none';
        }
        else {
            element.style.display='block';
        }
    }
    function editar(var1){
      var parametros = {
                "id" : var1
        };
        $.ajax({
          url:'consultapaciente',
          type:'POST',
          data: parametros,
          success: function(data){
            console.log(data);
            var caracter=/[A-Z\s]/gi;
        		var ci= data.datos.CI_PAC.replace(caracter,'');
        		var exp=data.datos.CI_PAC.substr(data.datos.CI_PAC.length - 2);
            console.log(exp);
            var dhtml='<div class="form-group"><label  required class="col-lg-2 control-label">CI :</label><div class="col-lg-4"><input type="text" class="form-control" name="ci_pac" id="ci_pac" value="'+ci+'" placeholder="Numero CI"> </div>';
            var dhtml= dhtml+'<label for="ejemplo_password_3" class="col-lg-2 control-label">Expedido </label>    <div class="col-lg-4">      <select readonly class="form-control" name="exp_pac" id="exp_pac">      <option value="">Extranjero</option>      <option value="LP">LP</option>      <option value="CB">CB</option>      <option value="SC">SC</option>      <option value="OR">OR</option>      <option value="PT">PT</option>      <option value="CH">CH</option>      <option value="TJ">TJ</option>      <option value="BN">BN</option>      <option value="PA">PA</option>      </select>   </div>    </div>';
            var dhtml= dhtml+'<div class="form-group">     <label  class="col-lg-2 control-label">Nombre :</label>    <div class="col-lg-10">      <input value="'+data.datos.NOM_PAC+'" type="text" name="nom_pac" class="form-control" id="nom_pac"             placeholder="Nombre del paciente" required>    </div>    </div>   <div class="form-group">    <label for="ejemplo_password_3" class="col-lg-2 control-label">Paterno :</label>    <div class="col-lg-4">      <input type="text" class="form-control" name="apa_pac" value="'+data.datos.APA_PAC+'" id="apa_pac"             placeholder="Apellido paterno" required>    </div>    <label  class="col-lg-2 control-label">Materno :</label>    <div class="col-lg-4">      <input type="text" class="form-control" name="ama_pac" id="ama_pac"     value="'+data.datos.AMA_PAC+'"        placeholder="Apellido materno" required>    </div>    </div>';
            var dhtml= dhtml+'<div class="form-group">    <label  class="col-lg-2 control-label">Genero :</label>    <div class="col-lg-4">      <select class="form-control" name="gen_pac" id="gen_pac" required>               <option value="">SELECCIONE</option>               <option value="MASCULINO"><span class="fa fa-male"></span>MASCULINO</option>               <option value="FEMENINO">FEMENINO</option>             </select>    </div>    <label  class="col-lg-2 control-label">Nacimiento </label>    <div class="col-lg-4">';
            var dhtml= dhtml+'<input type="date" value="'+data.datos.FEC_PAC+'" name="fec_nac" id="fec_pac" max="" class="form-control" required="yes">   </div></div>';

            $('#actualizarpac').html(dhtml);

            $('#exp_pac option[value="'+exp+'"]').prop('selected','selected').change();
            $('#gen_pac option[value="'+data.datos.SEX_PAC+'"]').prop('selected','selected').change();

          }
        });
    }
    function modificardatos(var1){
      var parametros = {
                "id" : var1,
                "ci": $('#ci_pac').val()+' '+$('#exp_pac').val(),
                "nom": $('#nom_pac').val(),
                "apa": $('#apa_pac').val(),
                "ama": $('#ama_pac').val(),
                "sex": $('#gen_pac').val(),
                "fec": $('#fec_pac').val()
        };
      $.ajax({
        url:'modificardatos',
        type:'POST',
        data: parametros,
        success: function(data){
            $('#divalert').html('<div class="alert alert-success">DATOS DE PACIENTE MODIFICADO CIERRE ESTA VENTANA Y PRESIONE EL SIGNO <span class="fa fa-refresh"></span></div>')
        }
      });
    }
</script>
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
         <form class="form-horizontal" action="{{$ids}}/pdfmedi" method="post" target="_blank" accept-charset="UTF-8" name="fmedica" enctype="multipart/form-data">
                    <div id="menueva2" style="position: fixed; background-color:#B0EBEF; opacity: 100%; top: 9%; height:61px; z-index: 99; width:100%; padding:1% 8% 0 8%; font-size: 20px; ">EVALUACION MEDICA</div>
<div class="container">
<div  style="width:100%; background:#fff; margin-top:1%;">
    <div class="alert alert-info" style=" z-index: 1000;font-size:23px;">Evaluacion Medica
      <div id="menueva" style="right: 5%; top: 11%;  z-index: 100; position: fixed;">
        <button type="button" style="margin-left:-20%;" class="btn btn-success" onclick="javascript:datospac();"><span class="fa fa-refresh"></span></button>
        <button type="button" style="margin-left:1%;" class="btn btn-info"  data-toggle = "modal" data-target = "#myModal" onclick="javascript:editar('{{$id}}');"><span class="fa fa-pencil"></span></button>
        <button class="btn" style="margin-left:1%; background-color: #279495; color:white" type="submit" name="guardar" formnovalidate formtarget="">
        <span class="fa fa-floppy-o"></span></button>
        <a style="margin-left:1%;" href="../../<?php echo 'pacientes/'.$id;?>" class="btn btn-warning">Ver historial clinico</a>
        <button name="imprimir" type = "submit" target="_blank" onclick="validar();" class = "btn btn-primary" data-dismiss = "modal"><span class="fa fa-print"></span>
              Imprimir
            </button><a style="margin-left:1%;" href="<?php echo $ids;?>/finalizar" class="btn btn-danger">Finalizar</a></div></div>
    <div class="alert panel panel-success cuerpo" style="background:#fff; margin-top:-2.7%">

            <fieldset style="background-color:#BEEABE; padding: 2%;">
                <legend>
                     DATOS PERSONALES
                </legend>
                <div id="datospac" class="col-lg-10">

                </div>

      <?php
    if(isset($datos)):
     ?>
     <input type="hidden" style="opacity:100%" id="img" name="img" value="{{$datos->IMG_MED}}">
     <script type="text/javascript">
           $( document ).ready(function() {
            $('#divfoto').append('<img width="160px" src="'+window.location.origin+'/Darsalud/public/storage/{{$datos->FOT_PAC}}"/>');
            document.getElementById("canvasdiv").style.display = "none";
            var apto = <?php if ($datos->APT_MED):
                              echo $datos->APT_MED;
                            else:
                              echo 3;
                            endif; ?>;
              if(apto==1){
                $('#catapto').css("display","block");
                $('#noapto').css("display","none");
              }else{
                if(apto==3){

                }
                else{
                  $('#catapto').css("display","none");
                  $('#noapto').css("display","block");
                }
              }
            });
     </script>
     <div class="col-lg-2" >
       <div class="" id="divfoto">

       </div>
       <div class="" id="canvasdiv">
       <input type="hidden" id="img2" name="img2" value="">
       <canvas id="foto" style="width:160px;"></canvas>
       </div>
     </div>
           <div class="col-lg-10">
             <div class="form-group">

                    <label class="col-lg-3">Lugar del examen : </label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" name="lug_med" value="<?php echo $datos->LUG_MED?>" placeholder="Lugar del examen">
                    </div>
                    <label class="col-lg-3">Fecha del examen : </label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" readonly="readonly" name="" value="{{ \Carbon\Carbon::now()->format('d-m-Y')}}">
                    </div>

                </div>
               <div class="form-group">
               <label class="col-lg-3">Foto : </label>
               <div class="col-lg-8">
                 <div id='botonera'>
                    <button id='botonIniciar' style="padding-left:15px;" class="btn btn-raised btn-success" type='button' data-toggle="modal" data-target="#miModal4"><i class="fa fa-play" ></i> Iniciar camara</button>
                  </div>
               </div>
             </div>


    </div>
            </fieldset>
            <fieldset style="background-color:#B9DEE3; padding: 2%;">
                <legend>I. ANTECEDENTES</legend>
                <div class="form-group">
                    <label class="col-lg-4">ANTECEDENTES RELACIONADOS CON LA CONDUCCION : </label>
                    <div class="col-lg-8">
                        <textarea rows="5" id="texto" onkeypress="return limita(event, 212);" class="form-control" name="aco_med" value="{{ $datos->ACO_MED}}">{{$datos->ACO_MED}}</textarea>
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-lg-4">ANTECEDENTES PERSONALES PATOLOGICOS : </label>
                    <div class="col-lg-8">
                        <textarea rows="5" id="texto" onkeypress="return limita(event, 212);" class="form-control" name="apa_med" required="yes"  value="{{ $datos->PRO_PAC}}">{{ $datos->APA_MED}}</textarea>
                    </div>
                    </div>
                     <label class="col-lg-11 control-label" style="text-align:left">Hábitos</label>
<br/><br/>
    <div class="form-control"  style="height:auto;">
    <label class="col-lg-3">BEBE:</label>
  <label style="text-align:left; margin-right:10%;">
    <input type="radio" name="opciones" id="opciones_1" value="NUNCA" <?php if($datos->HBE_MED=='NUNCA'){
                      echo 'checked'; }?> >
    NUNCA
  </label>
  <label style="margin-right:10%;">
    <input type="radio" name="opciones" id="opciones_2" value="OCASIONALMENTE" <?php if($datos->HBE_MED=='OCASIONALMENTE'){
                      echo 'checked'; }?> >
    OCASIONALMENTE
  </label>
    <label>
    <input type="radio" name="opciones" id="opciones_3" value="UNA O MAS A LA SEMANA" <?php if($datos->HBE_MED=='UNA O MAS A LA SEMANA'){
                      echo 'checked'; }?>>
    UNA O MAS A LA SEMANA
  </label>

</div>
<br/>
<br/>
 <div class="form-control" style="height:auto;">
    <label class="col-lg-3">FUMA:</label>
  <label style="text-align:left; margin-right:10%;">
    <input type="radio" name="opciones2" id="opciones_1" value="NUNCA" <?php if($datos->HFU_MED=='NUNCA'){
                      echo 'checked'; }?>>
    NUNCA
  </label>
  <label style="margin-right:10%;">
    <input type="radio" name="opciones2" id="opciones_2" value="OCASIONALMENTE" <?php if($datos->HFU_MED=='OCASIONALMENTE'){
                      echo 'checked'; }?>>
    OCASIONALMENTE
  </label>
    <label>
    <input type="radio" name="opciones2" id="opciones_3" value="UNA O MAS A LA SEMANA" <?php if($datos->HFU_MED=='UNA O MAS A LA SEMANA'){
                      echo 'checked'; }?>>
    UNA O MAS A LA SEMANA
  </label>

</div>
    <label class="col-lg-11 control-label" style="text-align:left">Vacunas</label>
<br/><br/>
    <div class="form-control"  style="height:auto;">
    <label class="col-lg-3">ANTIAMARILLICA:</label>
  <label style="text-align:left; margin-right:10%;">
    <input type="radio" name="opciones3" id="opciones_1" value="SI" <?php if($datos->VAM_MED=='SI'){
                      echo 'checked'; }?>>
    SI
  </label>
  <label style="margin-right:10%;">
    <input type="radio" name="opciones3" id="opciones_2" value="NO" <?php if($datos->VAM_MED=='NO'){
                      echo 'checked'; }?>>
    NO
  </label>
</div>
<br/>
 <div class="form-control"  style="height:auto;">
    <label class="col-lg-3">ANTITETANICA:</label>
  <label style="text-align:left; margin-right:10%;">
    <input type="radio" name="opciones4" id="opciones_1" value="SI" <?php if($datos->VTE_MED=='SI'){
                      echo 'checked'; }?>>
    SI
  </label>
  <label style="margin-right:10%;">
    <input type="radio" name="opciones4" id="opciones_2" value="NO" <?php if($datos->VTE_MED=='NO'){
                      echo 'checked'; }?>>
    NO
  </label>
</div>
            </fieldset>
            <fieldset style="background-color:#E9EBBF; padding: 2%;">
                <legend>II. EXAMEN CLINICO</legend>
                <div class="form-group">
                    <label class="col-lg-2">GRUPO SANGUINEO</label>
                    <div class="col-lg-3">
                        <select class="form-control" name="gsa_med">
                            <option value="O" <?php if($datos->GSA_MED=='O RH (+) POSITIVO'||$datos->GSA_MED=='O RH (-) NEGATIVO'){
                      echo 'selected'; }?>>O</option>
                            <option value="A" <?php if($datos->GSA_MED=='A RH (+) POSITIVO'||$datos->GSA_MED=='A RH (-) NEGATIVO'){
                      echo 'selected'; }?>>A</option>
                            <option value="B" <?php if($datos->GSA_MED=='B RH (+) POSITIVO'||$datos->GSA_MED=='B RH (-) NEGATIVO'){
                      echo 'selected'; }?>>B</option>
                            <option value="AB" <?php if($datos->GSA_MED=='AB RH (+) POSITIVO'||$datos->GSA_MED=='AB RH (-) NEGATIVO'){
                      echo 'selected'; }?>>AB</option>

                        </select>
                    </div>
                    <label class="col-lg-2">FACTOR RH</label>
                    <div class="col-lg-3">
                        <select class="form-control" name="rh_med">
                            <option value="RH (+) POSITIVO" <?php if($datos->GSA_MED=='O RH (+) POSITIVO'||$datos->GSA_MED=='A RH (+) POSITIVO'||$datos->GSA_MED=='B RH (+) POSITIVO'||$datos->GSA_MED=='AB RH (+) POSITIVO'){
                      echo 'selected'; }?>>(+) POSITIVO</option>
                            <option value="RH (-) NEGATIVO" <?php if($datos->GSA_MED=='O RH (-) NEGATIVO'||$datos->GSA_MED=='A RH (-) NEGATIVO'||$datos->GSA_MED=='B RH (-) NEGATIVO'||$datos->GSA_MED=='AB RH (-) NEGATIVO'){
                      echo 'selected'; }?>>(-) NEGATIVO</option>


                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2">SIGNOS VITALES</label>

                    <label class="col-lg-2">TEMPERATURA</label>
                    <div class="col-lg-2">
                        <input type="number" step="0.01" name="tem_med" class="form-control" value="{{ $datos->TEM_MED}}" placeholder="°C">
                    </div>
                    <label class="col-lg-2">PRESION ARTERIAL</label>
                    <div class="col-lg-2">
                        <input type="text" name="pre_med" class="form-control" value="{{ $datos->PRE_MED}}" placeholder="mmHg">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2">FRECUENCIA CARDIACA</label>
                    <div class="col-lg-3">
                        <input type="number" name="frc_med" class="form-control" placeholder="por minuto" value="{{ $datos->FRC_MED}}">
                    </div>
                    <label class="col-lg-2">FRECUENCIA RESPIRATORIA</label>
                    <div class="col-lg-3">
                        <input type="number" name="frr_med" class="form-control" placeholder="por minuto" value="{{$datos->FRR_MED}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2">SOMATOMETRIA</label>

                    <label class="col-lg-1">TALLA</label>
                    <div class="col-lg-2">
                        <input type="number" name="tal_med" placeholder="cm" value="{{$datos->TAL_MED}}" required="yes" class="form-control">
                    </div>
                    <label class="col-lg-1">PESO</label>
                    <div class="col-lg-2">
                        <input type="number" required="yes" name="pes_med" value="{{$datos->PES_MED}}" placeholder="Kg" step="0.01" class="form-control">
                    </div>
                </div>
               </fieldset>
               <fieldset style="background-color:#C6C1C7; padding: 2%;">
                <legend>III. EXAMEN FÍSICO</legend>
                <div class="form-group">
                    <label class="col-lg-5">1. EXPLORACION DE CABEZA, CARA ,CUELLO</label>
                    <br/><br/>
                    <label class="col-lg-2"> Cabeza:</label>
                    <div class="col-lg-8">
                        <input type="text" name="eca_med" class="form-control" value="{{$datos->ECA_MED}}"></div>
                    <br/><br/>
                    <label class="col-lg-2"> Cara:</label>
                    <div class="col-lg-8">
                        <input type="text" name="ecr_med" class="form-control" value="{{$datos->ECR_MED}}"></div>
                    <br/><br/>
                    <label class="col-lg-2"> Cuello:</label>
                    <div class="col-lg-8">
                        <input type="text" name="ecu_med" class="form-control" value="{{$datos->ECU_MED}}"></div>
                </div>
                </fieldset>
                 <fieldset style="background-color:#FCE1B6; padding: 2%;">
                <legend>EVALUACION OFTALMOLOGICA</legend>
                <div class="form-group">
                    <label class="col-lg-4">Examen general de ojos</label>
                    <div class="col-lg-6">
                        <input type="text" name="ego_med" placeholder="" class="form-control" value="{{$datos->EGO_MED}}">
                    </div>
                    </div>
                <div class="form-group">
                    <label class="col-lg-4">Movimientos oculares</label>
                    <div class="col-lg-6">
                        <input type="text" name="moc_med" placeholder="" class="form-control" value="{{$datos->MOC_MED}}">
                    </div>
                    </div>
                <div class="form-group">
                    <label class="col-lg-4">Reflejo luminoso corneal</label>
                    <div class="col-lg-6">
                        <input type="text" name="rec_med" placeholder="" class="form-control" value="{{$datos->REC_MED}}">
                    </div>
                    </div>
                <div class="form-group">
                    <label class="col-lg-5">ESTRABISMO:</label>
                    <label style="text-align:left; margin-right:10%;">
                    <input type="radio" name="opciones5" id="opciones_1" value="SI" <?php if($datos->ETR_MED=='SI'){
                      echo 'checked'; }?>>
                    SI
                    </label>
                    <label style="margin-right:10%;">
                    <input type="radio" name="opciones5" id="opciones_2" value="NO" <?php if($datos->ETR_MED=='NO'){
                      echo 'checked'; }?>>
                    NO
                    </label>
                </div>

                <div class="form-group">
                    <label class="col-lg-5">USA LENTES:</label>
                    <label style="text-align:left; margin-right:10%;">
                    <input type="radio" name="opciones6" id="opciones_1" value="SI" <?php if($datos->LEN_MED=='SI'){
                      echo 'checked'; }?>>
                    SI
                    </label>
                    <label style="margin-right:10%;">
                    <input type="radio" name="opciones6" id="opciones_2" value="NO" <?php if($datos->LEN_MED=='NO'){
                      echo 'checked'; }?>>
                    NO
                    </label>
                </div>
                <div class="form-group">
                    <label class="col-lg-4">Campimetría</label>
                    <div class="col-lg-6">
                        <input type="text" name="cam_med" placeholder="" class="form-control" value="{{$datos->CAM_MED}}">
                    </div>
                    </div>
                <div class="form-group">
                    <label class="col-lg-4">Colorimetría</label>
                    <div class="col-lg-6">
                        <input type="text" name="col_med" placeholder="" class="form-control" value="{{$datos->COL_MED}}">
                    </div>
                    </div>
                <div class="form-group">
                    <label class="col-lg-4">Vision profunda</label>
                    <div class="col-lg-6">
                        <input type="text" name="vpr_med" placeholder="" class="form-control" value="{{$datos->VPR_MED}}">
                    </div>
                    </div>
                <div class="form-group">
                    <label class="col-lg-4">Agudeza visual</label>
                    <div class="col-lg-6 table-responsive">
                        <table class="table table-hover" border="2px">
                            <tr>
                                <td></td>
                                <td>CON LENTES</td>
                                <td>SIN LENTES</td>
                                <td>CORRECCION</td>
                            </tr>
                            <tr>
                                <td>OD</td>
                                <td><input type="text" name="ald_med" value="{{$datos->ALD_MED}}"></td>
                                <td><input type="text" name="asd_med" value="{{$datos->ASD_MED}}" required></td>
                                <td><input type="text" name="acd_med" value="{{$datos->ACD_MED}}"></td>
                            </tr>
                            <tr>
                                <td>OI</td>
                                <td><input type="text" name="ali_med" value="{{$datos->ALI_MED}}"></td>
                                <td><input type="text" name="asi_med" value="{{$datos->ASI_MED}}" required></td>
                                <td><input type="text" name="aci_med" value="{{$datos->ACI_MED}}"></td>
                            </tr>
                        </table>
                    </div>
                    </div>
                </fieldset>
                 <fieldset style="background-color:#FCC8B6; padding: 2%;">
                <legend>APARATO AUDITIVO</legend>
                <div class="form-group">
                    <label class="col-lg-4">EXAMEN DE OIDO EXTERNO</label>
                    <div class="col-lg-6">
                        <input type="text" name="eoe_med" placeholder="" class="form-control" value="{{$datos->EOE_MED}}">
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-lg-2">Otoscopia</label>
                    <div class="col-lg-2">
                        <input type="text" name="oto_med" placeholder="" class="form-control" value="{{$datos->OTO_MED}}">
                    </div>
                    <label class="col-lg-2">T-Weber</label>
                    <div class="col-lg-2">
                        <input type="text" name="twe_med" placeholder="" class="form-control" value="{{$datos->TWE_MED}}">
                    </div>
                    <label class="col-lg-2">T-Rinne</label>
                    <div class="col-lg-2">
                        <input type="text" name="tri_med" placeholder="" class="form-control" value="{{$datos->TRI_MED}}">
                    </div>
                    </div>
                    </fieldset>
                    <fieldset style="background-color:#8FB687; padding: 2%;">
                    <label class="col-lg-9">2. EXPLORACION DEL APARATO CARDIO CIRCULATORIO Y RESPIRATORIO</label>
                    <br/><br/>
                    <div class="form-group">
                    <label class="col-lg-3">Exploracion del torax</label>
                    <div class="col-lg-9">
                        <input type="text" name="ext_med" placeholder="" class="form-control" value="{{$datos->EXT_MED}}">
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-lg-3">Exploracion del area cardiopulmonar</label>
                    <div class="col-lg-9">
                     <input type="text" name="exc_med" placeholder="" class="form-control" value="{{$datos->EXC_MED}}">
                     </div>
                     </div>
                    <label class="col-lg-11">3. EXPLORACION DEL APARATO DIGESTIVO</label>
                    <br/><br/>
                    <div class="form-group">
                    <label class="col-lg-3">Exploracion del abdomen</label>
                    <div class="col-lg-9">
                        <input type="text" name="exa_med" placeholder="" class="form-control" value="{{$datos->EXA_MED}}">
                    </div>
                    </div>
                    <label class="col-lg-9">4. EXPLORACION DEL APARATO LOCOMOTOR</label>
                    <br/><br/>
                    <label class="col-lg-9">MIEMBROS SUPERIORES</label>
                    <br/><br/>
                    <div class="form-group">
                    <label class="col-lg-1">Trofismo: </label>
                    <div class="col-lg-3">
                        <input type="text" name="trs_med" placeholder="" class="form-control" value="{{$datos->TRS_MED}}">
                    </div>
                    <label class="col-lg-1">Tono muscular: </label>
                    <div class="col-lg-3">
                        <input type="text" name="tms_med" placeholder="" class="form-control" value="{{$datos->TMS_MED}}">
                    </div>
                    <label class="col-lg-1">Fuerza muscular: </label>
                    <div class="col-lg-3">
                        <input type="text" name="fms_med" placeholder="" class="form-control" value="{{$datos->FMS_MED}}">
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-lg-1">Otros: </label>
                    <div class="col-lg-9">
                        <input type="text" name="obs_med" placeholder="OBSERVACIONES" class="form-control" value="{{$datos->OBS_MED}}">
                    </div>
                    </div>
                    <label class="col-lg-9">MIEMBROS INFERIORES</label>
                    <br/><br/>
                    <div class="form-group">
                    <label class="col-lg-1">Trofismo: </label>
                    <div class="col-lg-3">
                        <input type="text" name="tin_med" placeholder="" class="form-control" value="{{$datos->TIN_MED}}">
                    </div>
                    <label class="col-lg-1">Tono muscular: </label>
                    <div class="col-lg-3">
                        <input type="text" name="tmi_med" placeholder="" class="form-control" value="{{$datos->TMI_MED}}">
                    </div>
                    <label class="col-lg-1">Fuerza muscular: </label>
                    <div class="col-lg-3">
                        <input type="text" name="fmi_med" placeholder="" class="form-control" value="{{$datos->FMI_MED}}">
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-lg-1">Otros: </label>
                    <div class="col-lg-9">
                        <input type="text" name="obi_med" placeholder="OBSERVACIONES" class="form-control" value="{{$datos->OBI_MED}}">
                    </div>
                    </div>
                    <label class="col-lg-11">5. SISTEMA NEUROLOGICO</label>
                    <br/><br/>
                    <div class="form-group">
                    <label class="col-lg-3">Coordinacion y marcha</label>
                    <div class="col-lg-9">
                        <input type="text" name="cma_med" placeholder="" class="form-control" value="{{$datos->CMA_MED}}"></div></div>
                    <div class="form-group">
                    <label class="col-lg-3">Reflejos osteotendinosos</label>
                    <div class="col-lg-9">
                        <input type="text" name="ref_med" placeholder="" class="form-control" value="{{$datos->REF_MED}}"></div></div>
                        <label class="col-lg-9">PRUEBAS DE COORDINACION</label>
                    <br/><br/>
                    <div class="form-group">
                    <label class="col-lg-3">Prueba talon-rodilla: </label>
                    <div class="col-lg-9">
                        <input type="text" name="ptr_med" placeholder="" class="form-control" value="{{$datos->PTR_MED}}">
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-lg-3">Prueba dedo-nariz: </label>
                    <div class="col-lg-9">
                        <input type="text" name="pdn_med" placeholder="" class="form-control" value="{{$datos->PDN_MED}}">
                    </div>
                    </div>
                     <label class="col-lg-9">PRUEBAS DE EQUILIBRIO</label>
                    <br/><br/>
                    <div class="form-group">
                    <label class="col-lg-3">Prueba Romberg: </label>
                    <div class="col-lg-9">
                        <input type="text" name="prg_med" placeholder="" class="form-control" value="{{$datos->PRG_MED}}">
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-lg-4">Fallas motoras y sensitivas diagnosticadas </label>
                    <div class="col-lg-8">
                        <input type="text" name="fam_med" placeholder="" class="form-control" value="{{$datos->FAM_MED}}">
                    </div>
                    </div>
                     <label class="col-lg-9">RESULTADOS DE EVALUACION</label>
                    <br/><br/>
                    <div class="form-group">
                    <div class="col-lg-6"><label class="col-lg-5">Requiere de evaluacion de especialidad: </label>
                    <label style="text-align:left; margin-right:10%;">
                    <input type="radio" name="opciones7" id="opciones_11" value="SI" <?php if($datos->REE_MED=='SI'){
                      echo 'checked'; }?>>
                    SI
                    </label>
                    <label style="margin-right:10%;">
                    <input type="radio" name="opciones7" id="opciones_21" value="NO" <?php if($datos->REE_MED=='NO'){
                      echo 'checked'; }?>>
                    NO
                    </label>
                    </div>
                    <div class="col-lg-5">
                    <label class="col-lg-11">Especialidades (en caso de marcar como si): </label>
                    <input type="text" class="form-control" name="esp_med" value="{{$datos->ESP_MED}}">
                    </div>
                    </div>
                    <div id="especialidades" style="display: none;">
                     contenido del div escondido<br/>
                     contenido del div escondido<br/>
                     contenido del div escondido<br/>
                    </div>
                    <div class="form-group">
                    <label class="col-lg-4">Motivo de la referencia a la especialidad </label>
                    <div class="col-lg-8">
                        <textarea name="mre_med" placeholder="" class="form-control" value="">{{$datos->MRE_MED}}</textarea>
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-lg-4">Resultado de la evaluacion de especialidad </label>
                    <div class="col-lg-8">
                        <textarea name="rev_med" placeholder="" class="form-control" value="">{{$datos->REV_MED}}</textarea>
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-lg-5">Requiere de evaluacion psicosensometríca: </label>
                    <label style="text-align:left; margin-right:10%;">
                    <input type="radio" name="opciones8" id="opciones_1" value="SI" <?php if($datos->REP_MED=='SI'){
                      echo 'checked'; }?> >
                    SI
                    </label>
                    <label style="margin-right:10%;">
                    <input type="radio" name="opciones8" id="opciones_2" value="NO" <?php if($datos->REP_MED=='NO'){
                      echo 'checked'; }?>>
                    NO
                    </label>
                    </div>
                </fieldset>
                 <br/><br/>
<fieldset style="background-color:#E3CFD3; padding: 2%;">
    <legend>RESULTADO FINAL DE LA CERTIFICACION MEDICA</legend>
    <div class="form-group">
        <label class="col-lg-11">OBSERVACIONES:(EN ESTE ACAPITE SE DEBE INCORPORAR SI EL POSTULANTE ES APTO PARA CONDUCIR VEHICULO, SI NO FUERA APTO INDICAR LOS MOTIVOS)</label>
        <div class="col-lg-4">
           <select class="form-control" id="apto" name="apt_med" required>
            <option value="">SELECCIONE</option>
            <option value="1" <?php if($datos->APT_MED=='1'){
                      echo 'selected'; }?> >APTO PARA CONDUCIR LA CATEGORIA</option>
            <option value="2" <?php if($datos->APT_MED=='2'){
                      echo 'selected'; }?> >NO APTO PARA CONDUCIR</option>
            </select>
            </div>
        <div style="display: none;" id="catapto" name="rfi_med">
        <div class="col-lg-1">
            <select class="form-control" name="rfi_med" >
            <option value="A" <?php if($datos->RFI_MED=='A'){
                      echo 'selected'; }?> >A</option>
            <option value="B" <?php if($datos->RFI_MED=='B'){
                      echo 'selected'; }?> >B</option>
            <option value="C" <?php if($datos->RFI_MED=='C'){
                      echo 'selected'; }?> >C</option>
            <option value="P" <?php if($datos->RFI_MED=='P'){
                      echo 'selected'; }?> >P</option>
            <option value="M" <?php if($datos->RFI_MED=='M'){
                      echo 'selected'; }?> >M</option>
            <option value="T" <?php if($datos->RFI_MED=='T'){
                      echo 'selected'; }?> >T</option>
            </select>
        </div>
        <div class="col-lg-3" >
        SEGUNDA CATEGORIA
            <select class="form-control" id="segundacat" name="rfs_med" >
            <option value="">SELECCIONE</option>
           <option value="A" <?php if($datos->RFS_MED=='A'){
                      echo 'selected'; }?> >A</option>
            <option value="B" <?php if($datos->RFS_MED=='B'){
                      echo 'selected'; }?> >B</option>
            <option value="C" <?php if($datos->RFS_MED=='C'){
                      echo 'selected'; }?> >C</option>
            <option value="P" <?php if($datos->RFS_MED=='P'){
                      echo 'selected'; }?> >P</option>
            <option value="M" <?php if($datos->RFS_MED=='M'){
                      echo 'selected'; }?> >M</option>
            <option value="T" <?php if($datos->RFS_MED=='T'){
                      echo 'selected'; }?> >T</option>
            </select>
        </div>
        <div class="col-lg-3">
        TERCERA CATEGORIA
            <select class="form-control" id="terceracat" name="rft_med">
            <option value="">SELECCIONE</option>
            <option value="A" <?php if($datos->RFT_MED=='A'){
                      echo 'selected'; }?>>A</option>
            <option value="B" <?php if($datos->RFT_MED=='B'){
                      echo 'selected'; }?>>B</option>
            <option value="C" <?php if($datos->RFT_MED=='C'){
                      echo 'selected'; }?>>C</option>
            <option value="P" <?php if($datos->RFT_MED=='P'){
                      echo 'selected'; }?>>P</option>
            <option value="M" <?php if($datos->RFT_MED=='M'){
                      echo 'selected'; }?>>M</option>
            <option value="T" <?php if($datos->RFT_MED=='T'){
                      echo 'selected'; }?>>T</option>
            </select>
        </div>
        </div>
        <div style="display:none;" id="noapto">
            <textarea cols="70" rows="4" name="mna_med">{{$datos->MNA_MED}}</textarea>
        </div>
    </div>
</fieldset>
    <?php else: ?>
      <div class="col-lg-2">
        <input type="hidden" style="opacity:100%" id="img" name="img" value="">
        <canvas id="foto" style="width:160px" ></canvas>
      </div>
      <div class="col-lg-10">

      <div class="form-group">
         <label class="col-lg-3">Lugar del examen : </label>
        <div class="col-lg-3">
        <input type="text" class="form-control" name="lug_med" value="LA PAZ" placeholder="Lugar del examen">
        </div>
        <label class="col-lg-3">Fecha del examen : </label>
            <div class="col-lg-3">
                <input type="text" class="form-control" readonly="readonly" name="" value="{{ \Carbon\Carbon::now()->format('d-m-Y')}}">
            </div>

                </div>
               <div class="form-group">
               <label class="col-lg-2">Foto : </label>
               <div class="col-lg-8">
                 <div id='botonera'>
                    <button id='botonIniciar' style="padding-left:15px;" class="btn btn-raised btn-success" type='button' data-toggle="modal" data-target="#miModal4"><i class="fa fa-play" ></i> Iniciar camara</button>
                  </div>
               </div>
             </div>
             </div>
            </fieldset>
            <fieldset style="background-color:#B9DEE3; padding: 2%;">
                <legend>I. ANTECEDENTES</legend>
                <div class="form-group">
                    <label class="col-lg-4">ANTECEDENTES RELACIONADOS CON LA CONDUCCION : </label>
                    <div class="col-lg-8">
                        <textarea rows="5" id="texto" onkeypress="return limita(event, 212);" class="form-control" name="aco_med" value="{{ $paciente->PRO_PAC}}"></textarea>
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-lg-4">ANTECEDENTES PERSONALES PATOLOGICOS : </label>
                    <div class="col-lg-8">
                        <textarea rows="5" id="texto" onkeypress="return limita(event, 212);" class="form-control" name="apa_med" required="yes"  value="{{ $paciente->PRO_PAC}}"></textarea>
                    </div>
                    </div>
                     <label class="col-lg-11 control-label" style="text-align:left">Hábitos</label>
<br/><br/>
    <div class="form-control"  style="height:auto;">
    <label class="col-lg-3">BEBE:</label>
  <label style="text-align:left; margin-right:10%;">
    <input type="radio" name="opciones" id="opciones_1" value="NUNCA" >
    NUNCA
  </label>
  <label style="margin-right:10%;">
    <input type="radio" name="opciones" id="opciones_2" value="OCASIONALMENTE" checked >
    OCASIONALMENTE
  </label>
    <label>
    <input type="radio" name="opciones" id="opciones_3" value="UNA O MAS A LA SEMANA">
    UNA O MAS A LA SEMANA
  </label>

</div>
<br/>
<br/>
 <div class="form-control" style="height:auto;">
    <label class="col-lg-3">FUMA:</label>
  <label style="text-align:left; margin-right:10%;">
    <input type="radio" name="opciones2" id="opciones_1" value="NUNCA" checked>
    NUNCA
  </label>
  <label style="margin-right:10%;">
    <input type="radio" name="opciones2" id="opciones_2" value="OCASIONALMENTE" >
    OCASIONALMENTE
  </label>
    <label>
    <input type="radio" name="opciones2" id="opciones_3" value="UNA O MAS A LA SEMANA">
    UNA O MAS A LA SEMANA
  </label>

</div>
    <label class="col-lg-11 control-label" style="text-align:left">Vacunas</label>
<br/><br/>
    <div class="form-control"  style="height:auto;">
    <label class="col-lg-3">ANTIAMARILLICA:</label>
  <label style="text-align:left; margin-right:10%;">
    <input type="radio" name="opciones3" id="opciones_1" value="SI" checked>
    SI
  </label>
  <label style="margin-right:10%;">
    <input type="radio" name="opciones3" id="opciones_2" value="NO" >
    NO
  </label>
</div>
<br/>
 <div class="form-control"  style="height:auto;">
    <label class="col-lg-3">ANTITETANICA:</label>
  <label style="text-align:left; margin-right:10%;">
    <input type="radio" name="opciones4" id="opciones_1" value="SI" checked>
    SI
  </label>
  <label style="margin-right:10%;">
    <input type="radio" name="opciones4" id="opciones_2" value="NO" >
    NO
  </label>
</div>
            </fieldset>
            <fieldset style="background-color:#E9EBBF; padding: 2%;">
                <legend>II. EXAMEN CLINICO</legend>
                <div class="form-group">
                    <label class="col-lg-2">GRUPO SANGUINEO</label>
                    <div class="col-lg-3">
                        <select class="form-control" name="gsa_med">
                            <option value="O">O</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="AB">AB</option>

                        </select>
                    </div>
                    <label class="col-lg-2">FACTOR RH</label>
                    <div class="col-lg-3">
                        <select class="form-control" name="rh_med">
                            <option value="RH (+) POSITIVO">(+) POSITIVO</option>
                            <option value="RH (-) NEGATIVO">(-) NEGATIVO</option>


                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2">SIGNOS VITALES</label>

                    <label class="col-lg-2">TEMPERATURA</label>
                    <div class="col-lg-2">
                        <input type="number" step="0.01" name="tem_med" class="form-control" value="36.5" placeholder="°C">
                    </div>
                    <label class="col-lg-2">PRESION ARTERIAL</label>
                    <div class="col-lg-2">
                        <input type="text" name="pre_med" class="form-control" value="120/70" placeholder="mmHg">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2">FRECUENCIA CARDIACA</label>
                    <div class="col-lg-3">
                        <input type="number" name="frc_med" class="form-control" placeholder="por minuto" value="76">
                    </div>
                    <label class="col-lg-2">FRECUENCIA RESPIRATORIA</label>
                    <div class="col-lg-3">
                        <input type="number" name="frr_med" class="form-control" placeholder="por minuto" value="20">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2">SOMATOMETRIA</label>

                    <label class="col-lg-1">TALLA</label>
                    <div class="col-lg-2">
                        <input type="number" name="tal_med" placeholder="cm" required="yes" class="form-control">
                    </div>
                    <label class="col-lg-1">PESO</label>
                    <div class="col-lg-2">
                        <input type="number" required="yes" name="pes_med" placeholder="Kg" step="0.01" class="form-control">
                    </div>
                </div>
               </fieldset>
               <fieldset style="background-color:#C6C1C7; padding: 2%;">
                <legend>III. EXAMEN FÍSICO</legend>
                <div class="form-group">
                    <label class="col-lg-5">1. EXPLORACION DE CABEZA, CARA ,CUELLO</label>
                    <br/><br/>
                    <label class="col-lg-2"> Cabeza:</label>
                    <div class="col-lg-8">
                        <input type="text" name="eca_med" class="form-control" value="NORMOCEFALICO"></div>
                    <br/><br/>
                    <label class="col-lg-2"> Cara:</label>
                    <div class="col-lg-8">
                        <input type="text" name="ecr_med" class="form-control" value="SIMETRICA MIMICA FACIAL CONSERVADA"></div>
                    <br/><br/>
                    <label class="col-lg-2"> Cuello:</label>
                    <div class="col-lg-8">
                        <input type="text" name="ecu_med" class="form-control" value="SIMETRICO SIN ALTERACIONES"></div>
                </div>
                </fieldset>
                 <fieldset style="background-color:#FCE1B6; padding: 2%;">
                <legend>EVALUACION OFTALMOLOGICA</legend>
                <div class="form-group">
                    <label class="col-lg-4">Examen general de ojos</label>
                    <div class="col-lg-6">
                        <input type="text" name="ego_med" placeholder="" class="form-control" value="NORMAL">
                    </div>
                    </div>
                <div class="form-group">
                    <label class="col-lg-4">Movimientos oculares</label>
                    <div class="col-lg-6">
                        <input type="text" name="moc_med" placeholder="" class="form-control" value="CONSERVADOS">
                    </div>
                    </div>
                <div class="form-group">
                    <label class="col-lg-4">Reflejo luminoso corneal</label>
                    <div class="col-lg-6">
                        <input type="text" name="rec_med" placeholder="" class="form-control" value="CONSERVADO">
                    </div>
                    </div>
                <div class="form-group">
                    <label class="col-lg-5">ESTRABISMO:</label>
                    <label style="text-align:left; margin-right:10%;">
                    <input type="radio" name="opciones5" id="opciones_1" value="SI" checked>
                    SI
                    </label>
                    <label style="margin-right:10%;">
                    <input type="radio" name="opciones5" id="opciones_2" value="NO" checked>
                    NO
                    </label>
                </div>

                <div class="form-group">
                    <label class="col-lg-5">USA LENTES:</label>
                    <label style="text-align:left; margin-right:10%;">
                    <input type="radio" name="opciones6" id="opciones_1" value="SI" checked>
                    SI
                    </label>
                    <label style="margin-right:10%;">
                    <input type="radio" name="opciones6" id="opciones_2" value="NO" checked>
                    NO
                    </label>
                </div>
                <div class="form-group">
                    <label class="col-lg-4">Campimetría</label>
                    <div class="col-lg-6">
                        <input type="text" name="cam_med" placeholder="" class="form-control" value="NORMAL">
                    </div>
                    </div>
                <div class="form-group">
                    <label class="col-lg-4">Colorimetría</label>
                    <div class="col-lg-6">
                        <input type="text" name="col_med" placeholder="" class="form-control" value="NORMAL">
                    </div>
                    </div>
                <div class="form-group">
                    <label class="col-lg-4">Vision profunda</label>
                    <div class="col-lg-6">
                        <input type="text" name="vpr_med" placeholder="" class="form-control" value="CONSERVADA">
                    </div>
                    </div>
                <div class="form-group">
                    <label class="col-lg-4">Agudeza visual</label>
                    <div class="col-lg-6 table-responsive">
                        <table class="table table-hover" border="2px">
                            <tr>
                                <td></td>
                                <td>CON LENTES</td>
                                <td>SIN LENTES</td>
                                <td>CORRECCION</td>
                            </tr>
                            <tr>
                                <td>OD</td>
                                <td><input type="text" name="ald_med"></td>
                                <td><input type="text" name="asd_med" value="20/25" required></td>
                                <td><input type="text" name="acd_med"></td>
                            </tr>
                            <tr>
                                <td>OI</td>
                                <td><input type="text" name="ali_med"></td>
                                <td><input type="text" name="asi_med" value="20/25" required></td>
                                <td><input type="text" name="aci_med"></td>
                            </tr>
                        </table>
                    </div>
                    </div>
                </fieldset>
                 <fieldset style="background-color:#FCC8B6; padding: 2%;">
                <legend>APARATO AUDITIVO</legend>
                <div class="form-group">
                    <label class="col-lg-4">EXAMEN DE OIDO EXTERNO</label>
                    <div class="col-lg-6">
                        <input type="text" name="eoe_med" placeholder="" class="form-control" value="CAES PERMEABLES AGUDEZA AUDITIVA CONSERVADA">
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-lg-2">Otoscopia</label>
                    <div class="col-lg-2">
                        <input type="text" name="oto_med" placeholder="" class="form-control" value="NORMAL">
                    </div>
                    <label class="col-lg-2">T-Weber</label>
                    <div class="col-lg-2">
                        <input type="text" name="twe_med" placeholder="" class="form-control" value="NO LATERALIZA">
                    </div>
                    <label class="col-lg-2">T-Rinne</label>
                    <div class="col-lg-2">
                        <input type="text" name="tri_med" placeholder="" class="form-control" value="POSITIVO">
                    </div>
                    </div>
                    </fieldset>
                    <fieldset style="background-color:#8FB687; padding: 2%;">
                    <label class="col-lg-9">2. EXPLORACION DEL APARATO CARDIO CIRCULATORIO Y RESPIRATORIO</label>
                    <br/><br/>
                    <div class="form-group">
                    <label class="col-lg-3">Exploracion del torax</label>
                    <div class="col-lg-9">
                        <input type="text" name="ext_med" placeholder="" class="form-control" value="SIMETRICO SIN ALTERACIONES">
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-lg-3">Exploracion del area cardiopulmonar</label>
                    <div class="col-lg-9">
                     <input type="text" name="exc_med" placeholder="" class="form-control" value="RUIDOS CARDIACOS RITMICOS, MURMULLO VESICULAR CONSERVADO">
                     </div>
                     </div>
                    <label class="col-lg-11">3. EXPLORACION DEL APARATO DIGESTIVO</label>
                    <br/><br/>
                    <div class="form-group">
                    <label class="col-lg-3">Exploracion del abdomen</label>
                    <div class="col-lg-9">
                        <input type="text" name="exa_med" placeholder="" class="form-control" value="RHA +, BLANDO, NO DOLOROSO ">
                    </div>
                    </div>
                    <label class="col-lg-9">4. EXPLORACION DEL APARATO LOCOMOTOR</label>
                    <br/><br/>
                    <label class="col-lg-9">MIEMBROS SUPERIORES</label>
                    <br/><br/>
                    <div class="form-group">
                    <label class="col-lg-1">Trofismo: </label>
                    <div class="col-lg-3">
                        <input type="text" name="trs_med" placeholder="" class="form-control" value="CONSERVADO">
                    </div>
                    <label class="col-lg-1">Tono muscular: </label>
                    <div class="col-lg-3">
                        <input type="text" name="tms_med" placeholder="" class="form-control" value="CONSERVADO">
                    </div>
                    <label class="col-lg-1">Fuerza muscular: </label>
                    <div class="col-lg-3">
                        <input type="text" name="fms_med" placeholder="" class="form-control" value="5/5">
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-lg-1">Otros: </label>
                    <div class="col-lg-9">
                        <input type="text" name="obs_med" placeholder="OBSERVACIONES" class="form-control" value="">
                    </div>
                    </div>
                    <label class="col-lg-9">MIEMBROS INFERIORES</label>
                    <br/><br/>
                    <div class="form-group">
                    <label class="col-lg-1">Trofismo: </label>
                    <div class="col-lg-3">
                        <input type="text" name="tin_med" placeholder="" class="form-control" value="CONSERVADO">
                    </div>
                    <label class="col-lg-1">Tono muscular: </label>
                    <div class="col-lg-3">
                        <input type="text" name="tmi_med" placeholder="" class="form-control" value="CONSERVADO">
                    </div>
                    <label class="col-lg-1">Fuerza muscular: </label>
                    <div class="col-lg-3">
                        <input type="text" name="fmi_med" placeholder="" class="form-control" value="5/5">
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-lg-1">Otros: </label>
                    <div class="col-lg-9">
                        <input type="text" name="obi_med" placeholder="OBSERVACIONES" class="form-control" value="">
                    </div>
                    </div>
                    <label class="col-lg-11">5. SISTEMA NEUROLOGICO</label>
                    <br/><br/>
                    <div class="form-group">
                    <label class="col-lg-3">Coordinacion y marcha</label>
                    <div class="col-lg-9">
                        <input type="text" name="cma_med" placeholder="" class="form-control" value="NO CLAUDICA"></div></div>
                    <div class="form-group">
                    <label class="col-lg-3">Reflejos osteotendinosos</label>
                    <div class="col-lg-9">
                        <input type="text" name="ref_med" placeholder="" class="form-control" value="SIN ALTERACIONES"></div></div>
                        <label class="col-lg-9">PRUEBAS DE COORDINACION</label>
                    <br/><br/>
                    <div class="form-group">
                    <label class="col-lg-3">Prueba talon-rodilla: </label>
                    <div class="col-lg-9">
                        <input type="text" name="ptr_med" placeholder="" class="form-control" value="SIN ALTERACIONES">
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-lg-3">Prueba dedo-nariz: </label>
                    <div class="col-lg-9">
                        <input type="text" name="pdn_med" placeholder="" class="form-control" value="SIN ALTERACIONES">
                    </div>
                    </div>
                     <label class="col-lg-9">PRUEBAS DE EQUILIBRIO</label>
                    <br/><br/>
                    <div class="form-group">
                    <label class="col-lg-3">Prueba Romberg: </label>
                    <div class="col-lg-9">
                        <input type="text" name="prg_med" placeholder="" class="form-control" value="NEGATIVO">
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-lg-4">Fallas motoras y sensitivas diagnosticadas </label>
                    <div class="col-lg-8">
                        <input type="text" name="fam_med" placeholder="" class="form-control" value="NINGUNO">
                    </div>
                    </div>
                     <label class="col-lg-9">RESULTADOS DE EVALUACION</label>
                    <br/><br/>
                    <div class="form-group">
                    <div class="col-lg-6"><label class="col-lg-5">Requiere de evaluacion de especialidad: </label>
                    <label style="text-align:left; margin-right:10%;">
                    <input type="radio" name="opciones7" id="opciones_11" value="SI">
                    SI
                    </label>
                    <label style="margin-right:10%;">
                    <input type="radio" name="opciones7" id="opciones_21" value="NO" checked >
                    NO
                    </label>
                    </div>
                    <div class="col-lg-5">
                    <label class="col-lg-11">Especialidades (en caso de marcar como si): </label>
                    <input type="text" class="form-control" name="esp_med">
                    </div>
                    </div>
                    <div id="especialidades" style="display: none;">
                     contenido del div escondido<br/>
                     contenido del div escondido<br/>
                     contenido del div escondido<br/>
                    </div>
                    <div class="form-group">
                    <label class="col-lg-4">Motivo de la referencia a la especialidad </label>
                    <div class="col-lg-8">
                        <textarea name="mre_med" placeholder="" class="form-control" value=""></textarea>
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-lg-4">Resultado de la evaluacion de especialidad </label>
                    <div class="col-lg-8">
                        <textarea name="rev_med" placeholder="" class="form-control" value=""></textarea>
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-lg-5">Requiere de evaluacion psicosensometríca: </label>
                    <label style="text-align:left; margin-right:10%;">
                    <input type="radio" name="opciones8" id="opciones_1" value="SI" >
                    SI
                    </label>
                    <label style="margin-right:10%;">
                    <input type="radio" name="opciones8" id="opciones_2" value="NO" checked>
                    NO
                    </label>
                    </div>
                </fieldset>
                 <br/><br/>
<fieldset style="background-color:#E3CFD3; padding: 2%;">
    <legend>RESULTADO FINAL DE LA CERTIFICACION MEDICA</legend>
    <div class="form-group">
        <label class="col-lg-11">OBSERVACIONES:(EN ESTE ACAPITE SE DEBE INCORPORAR SI EL POSTULANTE ES APTO PARA CONDUCIR VEHICULO, SI NO FUERA APTO INDICAR LOS MOTIVOS)</label>
        <div class="col-lg-4">
           <select class="form-control" id="apto" name="apt_med" required>
            <option value="">SELECCIONE</option>
            <option value="1">APTO PARA CONDUCIR LA CATEGORIA</option>
            <option value="2">NO APTO PARA CONDUCIR</option>
            </select>
            </div>
        <div style="display: none;" id="catapto" name="rfi_med">
        <div class="col-lg-1">
            <select class="form-control" name="rfi_med" >
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="P">P</option>
            <option value="M">M</option>
            <option value="T">T</option>
            </select>
        </div>
        <div class="col-lg-3" >
        SEGUNDA CATEGORIA
            <select class="form-control" name="rfs_med" >
            <option value="">SELECCIONE</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="P">P</option>
            <option value="M">M</option>
            <option value="T">T</option>
            </select>
        </div>
        <div class="col-lg-3">
        TERCERA CATEGORIA
            <select class="form-control" name="rft_med">
            <option value="">SELECCIONE</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="P">P</option>
            <option value="M">M</option>
            <option value="T">T</option>
            </select>
        </div>
        </div>
        <div style="display:none;" id="noapto">
            <textarea cols="70" rows="4" name="mna_med"></textarea>
        </div>
    </div>
</fieldset>
<?php endif;?>
        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
        <div class="modal fade" id="miModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Fotografia</h4>
              </div>
              <div class="modal-body">
        				<div class="contenedor well col-lg-12 col-md-12 col-xs-12">
        						<div class="titulo" class="col-lg-12 col-md-12 col-xs-12">Cámara</div>
        						<video id="camara" autoplay controls class="col-lg-12 col-md-12 col-xs-12"></video>
        				</div>
                <div id='botonera' >
                  <button id='botonFoto' type='button' class="btn btn-block btn-raised btn-primary"><i class="fa fa-camera"></i> Tomar Foto</button>
                </div>

             </div>
             <div class="modal-footer">

              </div>
            </div>

          </div>
        </div>

        </div>
        <!-- Modal !-->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Editar datos de paciente</h4>
              </div>
              <div id="divalert">
              </div>
              <div class="modal-body">
                <form class="form-horizontal" action="index.html" method="post">
                <div id="actualizarpac">

                </div>

              </form>
             </div>
             <div class="modal-footer">
               <button type="button" class="btn btn-success" name="button" onclick="javascript:modificardatos('{{$id}}')"><span class="fa fa-pencil"></span> Modificar datos</button>
              </div>
            </div>

          </div>
        </div>

        </div>
        <!-- Modal !-->
	{!! Html::script('assets/js/sidebar2.js')!!}
  <script type="text/javascript">
			//Nos aseguramos que estén definidas
//algunas funciones básicas
window.URL = window.URL || window.webkitURL;
navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || function(){alert('Su navegador no soporta navigator.getUserMedia().');};
jQuery(document).ready(function(){
	//Este objeto guardará algunos datos sobre la cámara
	window.datosVideo = {
			'StreamVideo': null,
			'url' : null
	};

	jQuery('#botonIniciar').on('click', function(e){
			//Pedimos al navegador que nos de acceso a
			//algún dispositivo de video (la webcam)
			navigator.getUserMedia({'audio':false, 'video':true}, function(streamVideo){
					datosVideo.StreamVideo = streamVideo;
					datosVideo.url = window.URL.createObjectURL(streamVideo);
					jQuery('#camara').attr('src', datosVideo.url);
			}, function(){
					alert('No fue posible obtener acceso a la cámara.');
			});
	});
	jQuery('#botonDetener').on('click', function(e){
			if(datosVideo.StreamVideo){
					datosVideo.StreamVideo.stop();
					window.URL.revokeObjectURL(datosVideo.url);
			};
	});

	jQuery('#botonFoto').on('click', function(e){
			var oCamara,
					oFoto,
					oContexto,
					w, h;

			oCamara = jQuery('#camara');
			oFoto = jQuery('#foto');
			w = oCamara.width();
      console.log(w);
			h = oCamara.height();
			oFoto.attr({'width': 600, 'height': 600});
			oContexto = oFoto[0].getContext('2d');
			oContexto.drawImage(oCamara[0], 0, 0, 600, 600);
			foto= document.getElementById('foto')
			img=foto.toDataURL();
			$('#img').val(img);
			$('#img2').val(img);
      document.getElementById("canvasdiv").style.display = "block";
      document.getElementById("divfoto").style.display = "none";
	});
});

	</script>


</body>
</html>
