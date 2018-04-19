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
    {!! Html::script('assets/js/pestania.js')!!}
    {!! Html::style('assets/css/pestania.css') !!}
    <style type="text/css">
    .fila-base{ display: none; } /* fila base oculta */
    .eliminar{ cursor: pointer; color: #000; }
    </style>
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
    <script type="text/javascript">
              $(document).ready(function() { setTimeout(function(){ $(".mensajewarning").fadeIn(2500); },0000); });
              $(document).ready(function() { setTimeout(function(){ $(".mensajewarning").fadeOut(2500); },5000); });
    </script>
    <script type="text/javascript" language="javascript" class="init">
    			$(document).ready(function() {
        $('#example').DataTable();
    } );
    		</script>
</head>
<body style="background-color:#EFEEEE">

  <!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->

      <div class="modal-content" >

        <form name="formulario" action="">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nota de evolucion</h4>
        </div>
        <div class="alert alert-success bnota" id="bnota"  style=" border-radius: 7px; display:none">
          <button type="button" class="close" data-dismiss="alert">&times; </button>
          <strong>Exito! </strong>
          <div class="alertanota" id="alertanota">
          </div>
        </div>
        <div class="alert alert-danger bnota2" id="bnota2"  style=" border-radius: 7px; display:none">
          <button type="button" class="close" data-dismiss="alert">&times; </button>
          <strong>Alerta! </strong>
          <div class="alertanota" id="alertanota2">
          </div>
        </div>
        <div class="modal-body" id="notaevol">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="">Fecha:</label>
                <span class=""> {{\Carbon\Carbon::now()->format('d-m-Y')}}</span>
              </div>
              <div class="row form-group">
                <label for="" class="col-md-1">R:</label>
                <span class="col-md-4"><input id="inputR" type="text" class="form-control" name="" value="" required></span>
                <label for="" class="col-md-1">N:</label>
                <span class="col-md-4 "><input id="inputN" type="text" class="form-control" name="" value="" required></span>
              </div>
              <div class="row form-group">
                <label for="" class="col-md-7">Edad actual:</label>
                <span class="col-md-5">
                <?php
                $edad = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente->FEC_PAC)->format('Y');
                $edad2 = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente->FEC_PAC)->format('m');
                $edad3 = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente->FEC_PAC)->format('d');
                $date = \Carbon\Carbon::createFromDate($edad,$edad2,$edad3)->age;
                ?>{{$date}}</span>
              </div>
              <div class="row form-group">
                <label for="" class="col-md-3">Peso:</label>
                <span class="col-md-9"><input id="inputPeso" type="text" class="form-control" name="" value="" required></span>
              </div>
              <div class="row form-group">
                <label for="" class="col-md-3">Talla:</label>
                <span class="col-md-9"><input type="text" id="inputTalla" class="form-control" name="" value="" required></span>
              </div>
              <div class="row form-group">
                <label for="" class="col-md-3">P.A.:</label>
                <span class="col-md-9"><input type="text" id="inputPA" class="form-control" name="" value="" required></span>
              </div>
              <div class="row form-group">
                <label for="" class="col-md-3">F.C.:</label>
                <span class="col-md-9"><input type="text" id="inputFC" class="form-control" name="" value="" required></span>
              </div>
              <div class="row form-group">
                <label for="" class="col-md-6">Temperatura:</label>
                <span class="col-md-6"><input type="text" id="inputTem" class="form-control" name="" value="" required></span>
              </div>
              <div class="row form-group">
                <label for="" class="col-md-3">F.U.M:</label>
                <span class="col-md-9"><input type="text" id="inputFUM" class="form-control" name="" value="" required></span>
              </div>
            </div>
            <div class="col-md-9">
              <div class="row form-group">
                <label for="" class="col-md-3">Subjetivo:</label>
                <span class="col-md-9"><textarea name="name" id="inputSub" rows="4" cols="80" class="form-control" required></textarea></span>
              </div>
              <div class="row form-group">
                <label for="" class="col-md-3">Objetivo:</label>
                <span class="col-md-9"><textarea name="name" rows="4" id="inputObj" cols="80" class="form-control" required></textarea></span>
              </div>
              <div class="row form-group">
                <label for="" class="col-md-3">Analisis:</label>
                <span class="col-md-9"><textarea name="name" id="inputAna" rows="4" cols="80" class="form-control" required></textarea></span>
              </div>
              <div class="row form-group">
                <label for="" class="col-md-3">Plan de acción:</label>
                <span class="col-md-9"><textarea name="name" rows="4" id="inputPlan" cols="80" class="form-control" required></textarea></span>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="guardarnota" onclick="javascript:nota();"><span class="fa fa-save"></span> Guardar</button>
          <button type="button" class="btn btn-info" data-dismiss="modal"><span class="fa fa-close"></span> Listo!</button>
        </div>
      </div>
    </form>
    </div>
  </div>

  <!-- Modal -->
  <div id="myModal2" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content" >
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nota de evolucion</h4>
        </div>
        <div class="modal-body" >
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="">Fecha:</label>
                <span class=""> {{\Carbon\Carbon::now()->format('d-m-Y')}}</span>
              </div>
              <div class="row form-group">
                <label for="" class="col-md-1">R:</label>
                <span class="col-md-4"><input id="inputR2" type="text" class="form-control" name="" value="" readonly></span>
                <label for="" class="col-md-1">N:</label>
                <span class="col-md-4 "><input id="inputN2" type="text" class="form-control" name="" value="" readonly></span>
              </div>
              <div class="row form-group">
                <label for="" class="col-md-7">Edad actual:</label>
                <span class="col-md-5">
                <?php
                $edad = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente->FEC_PAC)->format('Y');
                $edad2 = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente->FEC_PAC)->format('m');
                $edad3 = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente->FEC_PAC)->format('d');
                $date = \Carbon\Carbon::createFromDate($edad,$edad2,$edad3)->age;
                ?>{{$date}}</span>
              </div>
              <div class="row form-group">
                <label for="" class="col-md-3">Peso:</label>
                <span class="col-md-9"><input id="inputPeso2" type="text" class="form-control" name="" value="" readonly></span>
              </div>
              <div class="row form-group">
                <label for="" class="col-md-3">Talla:</label>
                <span class="col-md-9"><input type="text" id="inputTalla2" class="form-control" name="" value="" readonly></span>
              </div>
              <div class="row form-group">
                <label for="" class="col-md-3">P.A.:</label>
                <span class="col-md-9"><input type="text" id="inputPA2" class="form-control" name="" value="" readonly></span>
              </div>
              <div class="row form-group">
                <label for="" class="col-md-3">F.C.:</label>
                <span class="col-md-9"><input type="text" id="inputFC2" class="form-control" name="" value="" readonly></span>
              </div>
              <div class="row form-group">
                <label for="" class="col-md-6">Temperatura:</label>
                <span class="col-md-6"><input type="text" id="inputTem2" class="form-control" name="" value="" readonly></span>
              </div>
              <div class="row form-group">
                <label for="" class="col-md-3">F.U.M:</label>
                <span class="col-md-9"><input type="text" id="inputFUM2" class="form-control" name="" value="" readonly></span>
              </div>
            </div>
            <div class="col-md-9">
              <div class="row form-group">
                <label for="" class="col-md-3">Subjetivo:</label>
                <span class="col-md-9"><textarea name="name" id="inputSub2" rows="4" cols="80" class="form-control" readonly></textarea></span>
              </div>
              <div class="row form-group">
                <label for="" class="col-md-3">Objetivo:</label>
                <span class="col-md-9"><textarea name="name" rows="4" id="inputObj2" cols="80" class="form-control" readonly></textarea></span>
              </div>
              <div class="row form-group">
                <label for="" class="col-md-3">Analisis:</label>
                <span class="col-md-9"><textarea name="name" id="inputAna2" rows="4" cols="80" class="form-control" readonly></textarea></span>
              </div>
              <div class="row form-group">
                <label for="" class="col-md-3">Plan de acción:</label>
                <span class="col-md-9"><textarea name="name" rows="4" id="inputPlan2" cols="80" class="form-control" readonly></textarea></span>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal"><span class="fa fa-close"></span> Listo!</button>
        </div>
      </div>
    </div>
  </div>
  <nav class="navbar navbar-inverse no-margin" style="border-radius: 0; background-color: #000;">
     <!-- Brand and toggle get grouped for better mobile display -->
                 <div class="navbar-header fixed-brand" >
                     <button type="button"  class="navbar-toggle collapsed" data-toggle="collapse"  id="menu-toggle">
                       <span  class="glyphicon glyphicon-th-large" aria-hidden="true" style="color: #fff;"></span>
                     </button>
                     <a class="navbar-brand" href="{{ url('/') }}" style="color: #21D3F3; padding-left: 14%; font-size: 25px;"><span class="fa fa-medkit"></span> <b>DARSALUD</b></a>
                 </div><!-- navbar-header-->
                 <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <a class="btn btn-danger" style="float:right; margin-top:0.5%;" href="{{ url('logout') }}">CERRAR SESION</a>
                 </div><!-- bs-example-navbar-collapse-1 -->
     </nav>
    <div class="container-fluid panel" style="padding:20px;">
      <?php if (Session::has('mensaje2')): ?>
         <div class="mensajewarning alert alert-danger" ><label><?php echo Session::get('mensaje2');?></label></div>
      <?php endif;?>
      <?php if (Session::has('mensaje')): ?>
         <div class="mensajewarning alert alert-success"><label><?php echo Session::get('mensaje');?></label></div>
      <?php endif;?>
      <div class="tab">
        <button class="tablinks" type="button" onclick="openCity(event, 'Consulta')" id="defaultOpen">Historia basica</button>
        <button class="tablinks" type="button" onclick="openCity(event, 'Laboratorios')">Laboratorios</button>
        <button class="tablinks" type="button" onclick="openCity(event, 'Recetas')">Recetas</button>
          <div class="col-md-offset-8" style="padding:5px;">
            <a style="margin-left:1%;" href="../../<?php echo 'pacientes/'.$id;?>" class="btn btn-warning">Ver historial clinico</a>
          <a class="btn btn-danger" href="{{url($id.'/'.'consultaexterna/'.$ids.'/finalizar')}}" type="button">Finalizar consulta</a>
        </div>
      </div>
    <form class="" action="{{url($id.'/consultaexterna'.'/'.$ids.'/pdfconsultaext')}}"  accept-charset="UTF-8"  enctype="multipart/form-data" method="post">
      <div id="Consulta" class="tabcontent">
        <div class="tab tab2">
          <button class="tablinks2" type="button" onclick="openCity2(event, 'paciente')" id="defaultOpen2">Datos de paciente</button>
          <button class="tablinks2" type="button" onclick="openCity2(event, 'historia')" >Historial</button>
          <button class="tablinks2" type="button" onclick="openCity2(event, 'antecped')" >Antec. pediatricos</button>
          <button class="tablinks2" type="button" onclick="openCity2(event, 'antecobs')" >Antec. obstectricos</button>
          <button class="tablinks2" type="button" onclick="openCity2(event, 'anticon')" >Anticoncepcion</button>
          <button class="tablinks2" type="button" onclick="openCity2(event, 'lact')">Lactancia</button>
          <button class="tablinks2" type="button" onclick="openCity2(event, 'facries')">Factor Riesgo</button>
          <button class="tablinks2" type="button" onclick="openCity2(event, 'riesgo')">Riesgos</button>
          <button class="tablinks2" type="button" onclick="openCity2(event, 'patologico')">Antec. patologicos</button>
          <button class="tablinks2" type="button" onclick="openCity2(event, 'enfcro')">Enfermedades cronicas</button>
        </div>
        <form class="" action="index.html" method="post">
        <div id="paciente" class="tabcontent2">
            <div style="padding: 2% 10% 0 10%" class="form-group">
          <fieldset class="">
            <legend>Datos personales</legend>
          <div class=" row form-group ">
            <div class="col-lg-4">
              <label for="" class="label label-primary">Nombre:</label> <span class="form-control">{{$paciente->NOM_PAC}}</span>
            </div>
            <div class="col-lg-4">
              <label for="" class="label label-primary">Apellido paterno:</label> <span class="form-control">{{$paciente->APA_PAC}}</span>
            </div>
            <div class="col-lg-4">
              <label for="" class="label label-primary">Apellido materno:</label> <span class="form-control">{{$paciente->AMA_PAC}}</span>
            </div>
          </div>
          <div class=" row form-group">
            <div class="col-lg-4">
              <label for="" class="label label-success">Fecha de nacimiento:</label> <span class="form-control">{{$paciente->FEC_PAC}}</span>
            </div>
            <div class="col-lg-2">
              <label for="" class="label label-success">Edad:</label> <span class="form-control"><?php
                  $edad = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente->FEC_PAC)->format('Y');
                  $edad2 = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente->FEC_PAC)->format('m');
                  $edad3 = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente->FEC_PAC)->format('d');
                  $categorias= \Darsalud\Categorialaboratorio::get();
                  echo $date = \Carbon\Carbon::createFromDate($edad,$edad3,$edad2)->age;
                  ?></span>
            </div>
            <div class="col-lg-2">
              <label for="" class="label label-success">Genero</label> <span class="form-control">{{$paciente->SEX_PAC}}</span>
            </div>
            <div class="col-lg-4">
              <label for="" class="label label-success">Fecha de ingreso</label> <span class="form-control">{{\Carbon\Carbon::now()->format('d/m/Y H:i')}}</span>
            </div>
          </div>
          <div class=" row form-group">
            <div class="col-lg-4">
              <label for="" class="label label-warning">Profesion u oficio:</label> <span class="form-control">{{$paciente->PRO_PAC}}</span>
            </div>
            <div class="col-lg-4">
              <label for="" class="label label-warning">Direccion:</label> <span class="form-control">{{$paciente->DOM_PAC}}</span>
            </div>
            <div class="col-lg-4">
              <label for="" class="label label-warning">Telefono</label> <span class="form-control">{{$paciente->REF_PAC}}</span>
            </div>
          </div>
        </fieldset>
        </div>
        </div>
        <div id="historia" class="tabcontent2">
          <div style="padding: 2% 10% 0 10%" class="form-group">
        <fieldset class="">
          <legend>Datos generales</legend>
        <div class=" row form-group ">
          <div class="col-lg-4">
            <label for="" class="label label-primary">Numero de Historia clinica:</label> <span class="form-control">{{'HCL-'.$paciente->id}}</span>
          </div>
          <div class="col-lg-8">
            <label for="" class="label label-primary">Alergias:</label> <input type="text" class="form-control"
            name="gla_coe" placeholder="ALERGIAS"
            value="<?php if(isset($hisold)){
              echo $hisold->GLA_COE;}?>"></div>
        </div>
        <div class=" row form-group">
          <div class="col-lg-4">
            <label for="" class="label label-success">Grupo sanguineo:</label> <input type="text" class="form-control" name="san_coe" placeholder="Grupo sanguineo" value="<?php if(isset($hisold)){
              echo $hisold->SAN_COE;
            }
            ?>">
          </div>
          <div class="col-lg-2">
            <label for="" class="label label-success">Factor:</label><input type="text" class="form-control" name="fac_coe" placeholder="Factor" value="<?php if(isset($hisold)){
              echo $hisold->FAC_COE;
            }
            ?>">
          </div>
        </div>
        <div class=" row form-group">
            <a  id="agregar" >+ Agregar Razon de especial cuidado</a>
            <table id="tabla" class="table table-hover">
            	<thead>
            		<tr>
            			<th>Razon</th>
            			<th>Eliminar</th>
            		</tr>
            	</thead>
            	<tbody>
            		<tr class="fila-base">
            			<td><input type="text" class="form-control" name="rcu[]" placeholder="Razon de especial cuidado" /></td>
            			<td class="eliminar"><button type="button" class="btn btn-danger" name="button"><span class="fa fa-close"></span></button></td>
            		</tr>
                <?php if(isset($razold)): ?>
                  <?php foreach ($razold as $raz){ ?>
                    <tr class="">
                			<td><input type="text" class="form-control" name="rcu[]" placeholder="Razon de especial cuidado" value="{{$raz->DES_RUC}}"/></td>
                			<td class="eliminar"><button type="button" class="btn btn-danger" name="button"><span class="fa fa-close"></span></button></td>
                		</tr>
                  <?php }
                endif;?>

            	</tbody>
            </table>
        </div>
      </fieldset>
      </div>
        </div>
        <div id="antecped" class="tabcontent2">
          <div style="padding: 2% 10% 0 10%" class="form-group">
        <fieldset class="">
          <legend>Antecedentes pediatricos</legend>
        <div class=" row form-group ">
          <div class="col-lg-2">
            <label for="" class="label label-primary">Peso Recien nacido:</label> <input type="text" class="form-control" name="pes_anp" placeholder="Peso" value="<?php if(isset($apeold)){
              echo $apeold[0]->PES_ANP;
            }
            ?>">
          </div>
          <div class="col-lg-10">
            <a id="agregar2">+ Agregar Observacion perinatal</a>
            <table id="tabla2" class="table table-hover">
            	<thead>
            		<tr>
            			<th>Observaciones perinatales</th>
            			<th>Eliminar</th>
            		</tr>
            	</thead>
            	<tbody>
            		<tr class="fila-base">
            			<td><input type="text" name="obs_per[]" class="form-control" placeholder="Observaciones perinatales" /></td>
            			<td class="eliminar"><button type="button" class="btn btn-danger" name="button"><span class="fa fa-close"></span></button></td>
            		</tr>
                <?php if(isset($obsold)): ?>
                  <?php foreach ($obsold as $ape){ ?>
                    <tr class="">
                			<td><input type="text" name="obs_per[]" class="form-control" placeholder="Observaciones perinatales" value="{{$ape->DES_OBP}}" /></td>
                			<td class="eliminar"><button type="button" class="btn btn-danger" name="button"><span class="fa fa-close"></span></button></td>
                		</tr>
                  <?php }
                endif;?>
            	</tbody>
            </table>
          </div>
        </div>

      </fieldset>
      </div>
        </div>
        <div id="antecobs" class="tabcontent2">
          <div style="padding: 2% 10% 0 10%" class="form-group">
        <fieldset class="">
          <legend>Antecedentes obstetricos</legend>
        <div class=" row form-group ">
            <fieldset>
              <legend>Embarazo</legend>
          <div class="col-lg-3">
            <label for="" class="label label-primary">G:</label><input type="text" class="form-control" name="emg_aob" placeholder="G" value="<?php if(isset($antecobs)){
              echo $antecobs[0]->EMG_AOB;
            }
            ?>">
          </div>
          <div class="col-lg-3">
            <label for="" class="label label-primary">P:</label><input type="text" class="form-control" name="emp_aob" placeholder="P" value="<?php if(isset($antecobs)){
              echo $antecobs[0]->EMP_AOB;
            }
            ?>">
          </div>
          <div class="col-lg-3">
            <label for="" class="label label-primary">A:</label><input type="text" class="form-control" name="ema_aob" placeholder="A" value="<?php if(isset($antecobs)){
              echo $antecobs[0]->EMA_AOB;
            }
            ?>">
          </div>
          <div class="col-lg-3">
            <label for="" class="label label-primary">C:</label><input type="text" class="form-control" name="emc_aob" placeholder="C" value="<?php if(isset($antecobs)){
              echo $antecobs[0]->EMC_AOB;
            }
            ?>">
          </div>
        </fieldset>
        </div>
        <div class=" row form-group">
          <a  id="agregar3">+ Agregar nuevo registro </a>
          <table id="tabla3" class="table table-hover">
            <thead>
              <tr >
                <th rowspan="2"><center>Año</center></th>
                <th rowspan="2"><center>Duracion meses</center></th>
                <th colspan="2" class="danger"><center>Tipo de parto</center></th>
                <th colspan="2" class="success"><center>Nro de recien nacidos</center></th>
                <th colspan="2" class="info"><center>PAP Colposcopia</center></th>
                <th rowspan="2"><center>Eliminar</center></th>
              </tr>
              <tr>
                <th class="danger"><center>Vaginal</center></th>
                <th class="danger"><center>Cesarea</center></th>
                <th class="success"><center>Vivos</center></th>
                <th class="success"><center>Muertos</center></th>
                <th class="info"><center>Fecha</center></th>
                <th class="info"><center>Resultado</center></th>
              </tr>
            </thead>
            <tbody>
              <tr class="fila-base">
                <td><input type="text" class="form-control" name="ani_emb[]" placeholder="Año" /></td>
                <td><input type="text" class="form-control" name="dur_emb[]" placeholder="Duracion meses" /></td>
                <td><input type="text" class="form-control" name="vag_emb[]" placeholder="Parto vaginal" /></td>
                <td><input type="text" class="form-control" name="ces_emb[]" placeholder="Parto cesarea" /></td>
                <td><input type="number" class="form-control" name="viv_emb[]" placeholder="Vivos" /></td>
                <td><input type="number" class="form-control" name="mue_emb[]" placeholder="Muertos" /></td>
                <td><input type="date" class="form-control" name="fpa_emb[]" placeholder="Fecha" /></td>
                <td><input type="text" class="form-control" name="res_emb[]" placeholder="Resultado" /></td>
                <td class="eliminar"><button type="button" class="btn btn-danger" name="button"><span class="fa fa-close"></span></button></td>
              </tr>
              <?php if(isset($embold)): ?>
                <?php foreach ($embold as $emb){ ?>
                  <tr class="">
                    <td><input type="text" class="form-control" name="ani_emb[]" placeholder="Año" value="{{$emb->ANI_EMB}}"/></td>
                    <td><input type="text" class="form-control" name="dur_emb[]" placeholder="Duracion meses" value="{{$emb->DUR_EMB}}" /></td>
                    <td><input type="text" class="form-control" name="vag_emb[]" placeholder="Parto vaginal" value="{{$emb->VAG_EMB}}"/></td>
                    <td><input type="text" class="form-control" name="ces_emb[]" placeholder="Parto cesarea" value="{{$emb->CES_EMB}}"/></td>
                    <td><input type="number" class="form-control" name="viv_emb[]" placeholder="Vivos" value="{{$emb->VIV_EMB}}"/></td>
                    <td><input type="number" class="form-control" name="mue_emb[]" placeholder="Muertos" value="{{$emb->MUE_EMB}}"/></td>
                    <td><input type="date" class="form-control" name="fpa_emb[]" placeholder="Fecha" value="{{$emb->FPA_EMB}}"/></td>
                    <td><input type="text" class="form-control" name="res_emb[]" placeholder="Resultado" value="{{$emb->RES_EMB}}"/></td>
                    <td class="eliminar"><button type="button" class="btn btn-danger" name="button"><span class="fa fa-close"></span></button></td>
                  </tr>
                <?php }
              endif;?>
            </tbody>
          </table>
        </div>
      </fieldset>
      </div>
        </div>
        <div id="anticon" class="tabcontent2">
          <div style="padding: 2% 10% 0 10%" class="form-group">
        <fieldset class="">
          <legend>Anticoncepcion</legend>
        <div class=" row form-group ">
          <a id="agregar4">+ Agregar nuevo registro </a>
          <table id="tabla4" class="table table-hover">
            <thead>
              <tr>
                <th>Inicio</th>
                <th>Metodo</th>
                <th>Control</th>
                <th>Orientacion</th>
                <th>Eliminar</th>
              </tr>
            </thead>
            <tbody>
              <tr class="fila-base">
                <td><input type="date" class="form-control" name="ini_anc[]" placeholder="Inicio" /></td>
                <td><input type="text" class="form-control" name="met_anc[]" placeholder="Metodo" /></td>
                <td><input type="text" class="form-control" name="con_anc[]" placeholder="Control" /></td>
                <td><input type="text" class="form-control" name="ori_anc[]" placeholder="Orientacion" /></td>
                <td class="eliminar"><button type="button" class="btn btn-danger" name="button"><span class="fa fa-close"></span></button></td>
              </tr>
              <?php if(isset($antold)): ?>
                <?php foreach ($antold as $ant){ ?>
                  <tr class="">
                    <td><input type="date" class="form-control" name="ini_anc[]" placeholder="Inicio" value="{{$ant->INI_ANC}}"/></td>
                    <td><input type="text" class="form-control" name="met_anc[]" placeholder="Metodo" value="{{$ant->MET_ANC}}"/></td>
                    <td><input type="text" class="form-control" name="con_anc[]" placeholder="Control" value="{{$ant->CON_ANC}}"/></td>
                    <td><input type="text" class="form-control" name="ori_anc[]" placeholder="Orientacion" value="{{$ant->ORI_ANC}}"/></td>
                    <td class="eliminar"><button type="button" class="btn btn-danger" name="button"><span class="fa fa-close"></span></button></td>
                  </tr>
                <?php }
              endif;?>
            </tbody>
          </table>
        </div>
      </fieldset>
      </div>
        </div>
        <div id="lact" class="tabcontent2">
          <div style="padding: 2% 10% 0 10%" class="form-group">
        <fieldset class="">
          <legend>Lactancia</legend>
        <div class=" row form-group ">
            <label for="">Exclusiva</label>
            <input id="radio" class="form-control" name="lac" type="radio" value="Exclusiva">
            <label for="">Periodica</label>
            <input id="radio2" class="form-control" name="lac" type="radio" value="Periodica">
        </div>
      </fieldset>
      </div>
        </div>
        <div id="facries" class="tabcontent2">
          <div style="padding: 2% 10% 0 10%" class="form-group">
        <fieldset class="">
          <legend>Factor de riesgos sociales</legend>
        <div class=" row form-group ">
          <a id="agregar5">+ Añadir nuevo factor de riesgo social</a><br/><br/>
          <table id="tabla5" class="table table-hover">
            <thead>
              <tr>
                <th>Factor de riesgo social</th>
                <th>Eliminar</th>
              </tr>
            </thead>
            <tbody>
              <tr class="fila-base">
                <td><input type="text" class="form-control" placeholder="Factor de riesgo social" name="des_far[]"/></td>
                <td class="eliminar"><button type="button" class="btn btn-danger" name="button"><span class="fa fa-close"></span></button></td>
              </tr>
              <?php if(isset($facold)): ?>
                <?php foreach ($facold as $fac){ ?>
                  <tr class="">
                    <td><input type="text" class="form-control" placeholder="Factor de riesgo social" name="des_far[]" value="{{$fac->DES_FAR}}"/></td>
                    <td class="eliminar"><button type="button" class="btn btn-danger" name="button"><span class="fa fa-close"></span></button></td>
                  </tr>
                <?php }
              endif;?>
            </tbody>
          </table>
        </div>
      </fieldset>
      </div>
        </div>
        <div id="riesgo" class="tabcontent2">
          <div style="padding: 2% 10% 0 10%" class="form-group">
        <fieldset class="">
          <legend>Riesgos</legend>
        <div class=" row form-group ">
          <table class="table table-hover">
              <thead >
                <tr class="danger">
                  <td>RIESGO</td>
                  <td>Personal</td>
                  <td>Familiar</td>
                  <td>RIESGO</td>
                  <td>Personal</td>
                  <td>Familiar</td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Ninguno</td>
                  <td><input type="checkbox" class="form-control" name="nip_rie"></td>
                  <td><input type="checkbox" class="form-control" name="nif_rie"></td>
                  <td>Transt - SNC</td>
                  <td><input type="checkbox" class="form-control" name="snp_rie"></td>
                  <td><input type="checkbox" class="form-control" name="snf_rie"></td>
                </tr>
                <tr>
                  <td>Hipertension</td>
                  <td><input type="checkbox" class="form-control" name="hip_rie"></td>
                  <td><input type="checkbox" class="form-control" name="hif_rie"></td>
                  <td>Obesidad</td>
                  <td><input type="checkbox" class="form-control" name="obp_rie"></td>
                  <td><input type="checkbox" class="form-control" name="obf_rie"></td>
                </tr>
                <tr>
                  <td>Diabetes</td>
                  <td><input type="checkbox" class="form-control" name="dip_rie"></td>
                  <td><input type="checkbox" class="form-control" name="dif_rie"></td>
                  <td>Desnutricion</td>
                  <td><input type="checkbox" class="form-control" name="dep_rie"></td>
                  <td><input type="checkbox" class="form-control" name="def_rie"></td>
                </tr>
                <tr>
                  <td>Tuberculosis</td>
                  <td><input type="checkbox" class="form-control" name="tup_rie"></td>
                  <td><input type="checkbox" class="form-control" name="tuf_rie"></td>
                  <td>Drogas</td>
                  <td><input type="checkbox" class="form-control" name="drp_rie"></td>
                  <td><input type="checkbox" class="form-control" name="drf_rie"></td>
                </tr>
                <tr>
                  <td>Sifilis</td>
                  <td><input type="checkbox" class="form-control" name="sip_rie"></td>
                  <td><input type="checkbox" class="form-control" name="sif_rie"></td>
                  <td>Alcohol</td>
                  <td><input type="checkbox" class="form-control" name="alp_rie"></td>
                  <td><input type="checkbox" class="form-control" name="alf_rie"></td>
                </tr>
                <tr>
                  <td>Transfuciones</td>
                  <td><input type="checkbox" class="form-control" name="trp_rie"></td>
                  <td><input type="checkbox" class="form-control" name="trf_rie"></td>
                  <td>Tabaquismo</td>
                  <td><input type="checkbox" class="form-control" name="tap_rie"></td>
                  <td><input type="checkbox" class="form-control" name="taf_rie"></td>
                </tr>
                <tr>
                  <td>Cirugias</td>
                  <td><input type="checkbox" class="form-control" name="cip_rie"></td>
                  <td><input type="checkbox" class="form-control" name="cif_rie"></td>
                  <td>Otros</td>
                  <td><input type="checkbox" class="form-control" name="otp_rie"></td>
                  <td><input type="checkbox" class="form-control" name="otf_rie"></td>
                </tr>
              </tbody>
          </table>
        </div>
      </fieldset>
      </div>
        </div>
        <div id="patologico" class="tabcontent2">
          <div style="padding: 2% 10% 0 10%" class="form-group">
        <fieldset class="">
          <legend>Antecedentes patologicos</legend>
        <div class=" row form-group ">
          <a id="agregar6">+ Añadir nuevo antecedente patologico</a>
          <table id="tabla6" class="table table-hover">
            <thead>
              <tr>
                <th>Hospitalizado por</th>
                <th>Año</th>
                <th>Evaluacion</th>
                <th>Eliminar</th>
              </tr>
            </thead>
            <tbody>
              <tr class="fila-base">
                <td><input type="text" class="form-control" name="hos_apa[]" placeholder="Hospitalizado por" /></td>
                <td><input type="number" class="form-control" name="ani_apa[]" placeholder="Año" /></td>
                <td><input type="text" class="form-control" name="eva_apa[]" placeholder="Evaluacion" /></td>
                <td class="eliminar"><button type="button" class="btn btn-danger" name="button"><span class="fa fa-close"></span></button></td>
              </tr>
              <?php if(isset($patold)): ?>
                <?php foreach ($patold as $pat){ ?>
                  <tr class="">
                    <td><input type="text" class="form-control" name="hos_apa[]" placeholder="Hospitalizado por" value="{{$pat->HOS_APA}}"/></td>
                    <td><input type="number" class="form-control" name="ani_apa[]" placeholder="Año" value="{{$pat->ANI_APA}}"/></td>
                    <td><input type="text" class="form-control" name="eva_apa[]" placeholder="Evaluacion" value="{{$pat->EVA_APA}}"/></td>
                    <td class="eliminar"><button type="button" class="btn btn-danger" name="button"><span class="fa fa-close"></span></button></td>
                  </tr>
                <?php }
              endif;?>
            </tbody>
          </table>
        </div>
      </fieldset>
      </div>
        </div>
        <div id="enfcro" class="tabcontent2">
          <div style="padding: 2% 10% 0 10%" class="form-group">
        <fieldset class="">
          <legend>Medicamentos en enfermedades cronicas</legend>
        <div class=" row form-group ">
          <a id="agregar7">+ Añadir nuevo medicamento</a><br><br>
          <table id="tabla7" class="table table-hover">
            <thead>
              <tr>
                <th>Medicamentos</th>
                <th>Dosificacion</th>
                <th>Final</th>
                <th>Eliminar</th>
              </tr>
            </thead>
            <tbody>
              <tr class="fila-base">
                <td><input type="text" class="form-control" name="med_mcr[]" placeholder="Medicamentos" /></td>
                <td><input type="text" class="form-control" name="dos_mcr[]" placeholder="Dosificacion" /></td>
                <td><input type="text" class="form-control" name="fin_mcr[]" placeholder="Final" /></td>
                <td class="eliminar"><button type="button" class="btn btn-danger" name="button"><span class="fa fa-close"></span></button></td>
              </tr>
              <?php if(isset($medold)): ?>
                <?php foreach ($medold as $med){ ?>
                  <tr class="">
                    <td><input type="text" class="form-control" name="med_mcr[]" placeholder="Medicamentos" value="{{$med->MED_MCR}}"/></td>
                    <td><input type="text" class="form-control" name="dos_mcr[]" placeholder="Dosificacion" value="{{$med->DOS_MCR}}"/></td>
                    <td><input type="text" class="form-control" name="fin_mcr[]" placeholder="Final" value="{{$med->FIN_MCR}}"/></td>
                    <td class="eliminar"><button type="button" class="btn btn-danger" name="button"><span class="fa fa-close"></span></button></td>
                  </tr>
                <?php }
              endif;?>
            </tbody>
          </table>
        </div>
      </fieldset>
      </div>
        </div>

        <div class="modal-footer col-lg-12">
          <button type="submit" class="btn btn-success" id="guardar" name="guardar">Guardar</button>
          <button class="btn btn-warning" type="submit" formtarget="_blank">Imprimir Historia basica</button>
          <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary" name="button">+ Nueva nota de evolucion</button>
          <br /><div id="notas" class="row col-lg-12 table-responsive">
            <fieldset>
              <legend>Notas de evolucion</legend>
            <table class="table table-hover" id="example">
              <thead>
                <tr class="">
                  <td>Fecha</td>
                  <td>Medico</td>
                  <td>Acciones</td>
                </tr>
              </thead>
              <tbody>
                @foreach ($notas as $nota)
                  <tr>
                    <td>{{\Carbon\Carbon::parse($nota->FEC_NEV)->format('m/d/Y')}}</td>
                    <td>{{$nota->NOM_USU.' '.$nota->APA_USU.' '.$nota->AMA_USU}}</td>
                    <td><a data-toggle="modal" data-target="#myModal2"  class="btn btn-info" onclick="javascript:vernota('{{$nota->NNN_NEV}}','{{$nota->RRR_NEV}}','{{$nota->PES_NEV}}','{{$nota->TAL_NEV}}','{{$nota->PA_NEV}}','{{$nota->FC_NEV}}','{{$nota->TEM_NEV}}','{{$nota->FUM_NEV}}','{{$nota->SUB_NEV}}','{{$nota->OBJ_NEV}}','{{$nota->ANA_NEV}}','{{$nota->PLA_NEV}}');">Ver </a>
                      <a data-target="#myModal" data-toggle="modal" class="btn btn-success" onclick="javascript:pasarnota('{{$nota->NNN_NEV}}','{{$nota->RRR_NEV}}','{{$nota->PES_NEV}}','{{$nota->TAL_NEV}}','{{$nota->PA_NEV}}','{{$nota->FC_NEV}}','{{$nota->TEM_NEV}}','{{$nota->FUM_NEV}}','{{$nota->SUB_NEV}}','{{$nota->OBJ_NEV}}','{{$nota->ANA_NEV}}','{{$nota->PLA_NEV}}');">Editar</a></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            </fieldset>
          </div>
        </div>

      </div>

    </form>
        <div id="Laboratorios" class="tabcontent">
          <form class="form-horizontal" action="{{$ids}}/pdflaboratorio" method="post" target="_blank" accept-charset="UTF-8" >
              <div class="alert panel panel-success cuerpo">
                      <fieldset style="background-color:#B9DEE3; padding: 2%;">
                          <legend>Lista de laboratorios</legend>
                          <div class="form-group">
                              <label class="col-lg-2 control-label">Categoria:</label>
                              <div class="col-lg-3">
                                  <select class="form-control" id="categoria" >
                                    <option value="">SELECCIONE</option>
                                    @foreach($categorias as $cat)
                                      <option value="{{$cat->id}}">{{$cat->DES_CAL}}</option>
                                    @endforeach
                                  </select>
                              </div>
                              <label class="col-lg-2 control-label">Laboratorio:</label>
                              <div class="col-lg-3">
                                  <select class="form-control" name="" id="lab">
                                  </select>
                              </div>
                              <div class="col-lg-2">
                                <button type="button" onclick="javascript:agregavalor('1','23','23');" class="btn btn-primary" name="button">Añadir Laboratorio</button>
                              </div>
                             </div>
                             </fieldset>
                             <div class = "modal-footer">
                               <div class="form-group ">
                                 <table id="labo" class="table table-responsive table-hover">
          	                        <!-- Cabecera de la tabla -->
          						               <thead>
                    							     <tr class="active">
                          								<th width="50%">Laboratorio</th>
                          								<th width="15%" class="info">Categoria</th>
                          								<th width="2%">&nbsp;</th>
                  							       </tr>
          						              </thead></table>
                               </div>
                   </div>
                   <button type="submit" style="margin-left:85%;" class = "btn btn-primary"><span class="fa fa-print"></span>
                             Imprimir laboratorio
                           </button>
                   </div></form>
                   </div>
        <div id="Recetas" class="tabcontent">
          <form class="form-horizontal" action="{{$ids}}/pdfreceta" method="post" target="_blank" accept-charset="UTF-8" name="fmedica" enctype="multipart/form-data">
                <div class="alert panel panel-success cuerpo">
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
        </div>
      </form>
      </div>
      </div>
    </body>
    <script>
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
    document.getElementById("defaultOpen2").click();
    </script>
    <script type="text/javascript">
       $(document).ready(function(){

       $("#categoria").change(function () {
               $("#categoria option:selected").each(function () {
                id = $(this).val();
                $.post('cargarlaboratorios', { id: id }, function(data){
                    $("#lab").html(data);
                });
            });
           });
       });

      </script>
      <script type='text/javascript' language='javascript' class='init'>
           function elimina(data)
           {
           $('#'+data).remove();
           }
      </script>
     <script type='text/javascript'>
           var cont=0;
          function agregavalor(data1,data2,data3){
            cont++;
          var fila="<tr id=fila"+cont+"><td>"+data1+" <input  type='hidden' name='idproducto[]' value="+data3+"></td><td><input type='text' readonly='yes' class='form-control' value="+data2+" name='pre_pro[]'></td><td><button type='button' class='btn btn-danger btn-circle btn-lg2' onclick='javascript:elimina("+"'"+"fila"+cont+"');' ><i class='fa fa-minus'></i></button></td></tr>'";
              $('#labo').append(fila);
            }
      </script>
    <script type="text/javascript">
      $(function(){
        	$("#agregar").on('click', function(){
      		$("#tabla tbody tr:eq(0)").clone().removeClass('fila-base').appendTo("#tabla tbody");
      	});
    	$(document).on("click",".eliminar",function(){
        		var parent = $(this).parents().get(0);
        		$(parent).remove();
        	});
      });
      $(function(){
        	$("#agregar2").on('click', function(){
      		$("#tabla2 tbody tr:eq(0)").clone().removeClass('fila-base').appendTo("#tabla2 tbody");
      	});
    	$(document).on("click",".eliminar",function(){
        		var parent = $(this).parents().get(0);
        		$(parent).remove();
        	});
      });
      $(function(){
        	$("#agregar3").on('click', function(){
      		$("#tabla3 tbody tr:eq(0)").clone().removeClass('fila-base').appendTo("#tabla3 tbody");
      	});
    	$(document).on("click",".eliminar",function(){
        		var parent = $(this).parents().get(0);
        		$(parent).remove();
        	});
      });
      $(function(){
        	$("#agregar4").on('click', function(){
      		$("#tabla4 tbody tr:eq(0)").clone().removeClass('fila-base').appendTo("#tabla4 tbody");
      	});
    	$(document).on("click",".eliminar",function(){
        		var parent = $(this).parents().get(0);
        		$(parent).remove();
        	});
      });
      $(function(){
        	$("#agregar5").on('click', function(){
      		$("#tabla5 tbody tr:eq(0)").clone().removeClass('fila-base').appendTo("#tabla5 tbody");
      	});
    	$(document).on("click",".eliminar",function(){
        		var parent = $(this).parents().get(0);
        		$(parent).remove();
        	});
      });
      $(function(){
        	$("#agregar6").on('click', function(){
      		$("#tabla6 tbody tr:eq(0)").clone().removeClass('fila-base').appendTo("#tabla6 tbody");
      	});
    	$(document).on("click",".eliminar",function(){
        		var parent = $(this).parents().get(0);
        		$(parent).remove();
        	});
      });
      $(function(){
        	$("#agregar7").on('click', function(){
      		$("#tabla7 tbody tr:eq(0)").clone().removeClass('fila-base').appendTo("#tabla7 tbody");
      	});
    	$(document).on("click",".eliminar",function(){
        		var parent = $(this).parents().get(0);
        		$(parent).remove();
        	});
      });
    </script>
    <script type="text/javascript">
      function nota(){
        var parametros = {
                "fecnev" : "{{\Carbon\Carbon::now()->format('d-m-Y')}}",
                "nnnnev" : document.formulario.inputN.value,
                "rrrnev" : document.formulario.inputR.value,
                "eacnev" : {{$date}},
                "pesnev" : document.formulario.inputPeso.value,
                "talnev" : document.formulario.inputTalla.value,
                "panev" : document.formulario.inputPA.value,
                "fcnev" : document.formulario.inputFC.value,
                "temnev" : document.formulario.inputTem.value,
                "fumnev" : document.formulario.inputFUM.value,
                "subnev" : document.formulario.inputSub.value,
                "objnev" : document.formulario.inputObj.value,
                "ananev" : document.formulario.inputAna.value,
                "planev" : document.formulario.inputPlan.value,
                "var1" : {{$ids}},
                "var2" : {{$id}},
                "idmed": {{Auth::user()->id}},
                "_token": "{{ csrf_token() }}"
        };
        console.log(parametros);
        $.ajax({
            type: "POST",
            url: {{$ids}}+'/guardarnota',
            data: parametros,
            success: function( data ) {
              if(data.conf==1){
              document.getElementById("bnota").style.display="block";
              $('#notaevol').load(self)
              setTimeout(function(){
				         $(".bnota").fadeIn(2500); },0000);
              setTimeout(function(){
				         $(".bnota").fadeOut(2500); },5000);
                 var dhtml='<div>"'+data.msg+'"</div>';
                $("#alertanota").html(dhtml);
              }else{
                document.getElementById("bnota2").style.display="block";
                $('#notaevol').load(self)
                setTimeout(function(){
                  $(".bnota2").fadeIn(2500); },0000);
                  setTimeout(function(){
                    $(".bnota2").fadeOut(2500); },5000);
                    var dhtml='<div>"'+data.msg2+'"</div>';
                    $("#alertanota2").html(dhtml);
              }
            }
        });

      }
    </script>
    <script type="text/javascript">
      function pasarnota(var1,var2,var3,var4,var5,var6,var7,var8,var9,var10,var11,var12){
        $('#inputN').val(var1);
        $('#inputR').val(var2);
        $('#inputPeso').val(var3);
        $('#inputTalla').val(var4);
        $('#inputPA').val(var5);
        $('#inputFC').val(var6);
        $('#inputTem').val(var7);
        $('#inputFUM').val(var8);
        $('#inputSub').val(var9);
        $('#inputObj').val(var10);
        $('#inputAna').val(var11);
        $('#inputPlan').val(var12);
      }
      function vernota(var1,var2,var3,var4,var5,var6,var7,var8,var9,var10,var11,var12){
        $('#inputN2').val(var1);
        $('#inputR2').val(var2);
        $('#inputPeso2').val(var3);
        $('#inputTalla2').val(var4);
        $('#inputPA2').val(var5);
        $('#inputFC2').val(var6);
        $('#inputTem2').val(var7);
        $('#inputFUM2').val(var8);
        $('#inputSub2').val(var9);
        $('#inputObj2').val(var10);
        $('#inputAna2').val(var11);
        $('#inputPlan2').val(var12);
      }
    </script>
    </html>
