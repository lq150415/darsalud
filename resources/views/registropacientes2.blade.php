@extends('layout')
@section('contenido')

  <script type="text/javascript">
  		function asigna(id,cipac,nombrec){
  		$('#ID_PAC').val(id);
  		$('#CI_PAC').val(cipac);
  		$('#NOM_PAC').val(nombrec);

  		}
  		function reserva(id,cipac,nompac){
  		$('#ID_PACR').val(id);
  		$('#CI_PACR').val(cipac);
  		$('#NOM_PACR').val(nompac);
  		}
  		function editar(id,nompac,apapac,amapac,sexpac,cipac,fecnac,refpac,dompac,nropac,zonpac,propac){
  		$('#mnom_pac').val(nompac);
  		$('#mapa_pac').val(apapac);
  		$('#mama_pac').val(amapac);
  		var caracter=/[A-Z\s]/gi;
  		var ci= cipac.replace(caracter,'');
  		var exp=cipac.substr(cipac.length - 2);
  		$('#mci_pac').val(ci);
  		$('#mexp_pac option[value="'+exp+'"]').prop('selected','selected').change();
  		$('#mgen_pac option[value="'+sexpac+'"]').prop('selected','selected').change();
  		$('#mfec_nac').val(fecnac);

  		if (refpac!="null") {
  			$('#mtel_pac').val(refpac);
  		}
  		if (dompac!="null") {
  			$('#mdir_pac').val(dompac);
  		}
  		if (propac!="null") {
  			$('#mpro_pac').val(propac);
  		}
  		$('#id_pac').val(id);

  }</script>
<script type="text/javascript">
    function asignar(data1, data2,data3)
    {
      $('#CI_PAC').val(data1);
      $('#NOM_PAC').val(data2);
      $('#ID_PAC').val(data3);

    }
</script>
<script type="text/javascript">
    function asignar2(data1, data2,data3)
    {
      $('#CI_PACR').val(data1);
      $('#NOM_PACR').val(data2);
      $('#ID_PACR').val(data3);

    }
</script>
<script language="javascript">
  function consultorios()
  { id=1;
    $.post("consultoriosmed", { id: id }, function(data){
                $("#tablamed").html(data);
            });
      setTimeout('consultorios()',1000);
  }
  $(document).ready(function()
    {
        consultorios();
    });

</script>
<script language="javascript">
  function consultoriospac()
  { id=1;
    $.post("consultoriospac", { id: id }, function(data){
                $("#tablapac").html(data);
            });
      setTimeout('consultoriospac()',1000);
  }
  $(document).ready(function()
    {
        consultoriospac();
    });
  function medicos()
  { id=1;
    $.post("medicos", { id: id }, function(data){
                $("#cambio").html(data);
            });

  }
  $(document).ready(function()
    {
        medicos();
    });
  function medicos2()
  { id=1;
    $.post("medicos2", { id: id }, function(data){
                $("#cambios").html(data);
            });

  }
  $(document).ready(function()
    {
        medicos2();
    });
</script>
<script type="text/javascript">
  function pasadatos(data1,data2,data3,data4,data5,data6,data7,data8,data9,data10)
  {
    $('#mnom_pac').val(data2);
     $('#mapa_pac').val(data3);
      $('#mama_pac').val(data4);
      var caracter=/[A-Z\s]/gi;
      var ci= data5.replace(caracter,'');
      var exp=data5.substr(data5.length - 2);
       $('#mci_pac').val(ci);
        $('#mexp_pac option[value="'+exp+'"]').prop('selected','selected').change();
        $('#mgen_pac option[value="'+data6+'"]').prop('selected','selected').change();
         $('#mfec_nac').val(data7);
          $('#mtel_pac').val(data8);
           $('#mdir_pac').val(data9);
            $('#mpro_pac').val(data10);
             $('#id_pac').val(data1);
  }
  function cambiar() {
  $("#cambio").reload();
  }
</script>
<fieldset>
<legend>ESPECIALIDADES DARSALUD</legend>
         <?php if (Session::has('mensaje2')): ?>
            <div class="mensajewarning alert alert-danger" ><label><?php echo Session::get('mensaje2');?></label></div>
         <?php endif;?>
         <?php if (Session::has('mensaje')): ?>
            <div class="mensajewarning alert alert-success"><label><?php echo Session::get('mensaje');?></label></div>
         <?php endif;?>

<div class="row well">
<div class="col-lg-8">
	<div class="form-group">
		<button type="button" class = "btn btn-info" data-toggle = "modal" data-target = "#myModal"> <span class="glyphicon glyphicon-plus"></span>
			Registrar nuevo paciente
		</button>
	</div>
	<table class="table table-hover" id="pacientes">
	        	<thead>
	        		<tr>
	        			<th data-dynatable-column="CI_PAC">CI</th>
	        			<th data-dynatable-column="completo">Paciente</th>
	        			<th data-dynatable-column="FEC_PAC">Fecha de nacimiento</th>
	        			<th data-dynatable-column="btnasignar">Asignar</th>
	              <th data-dynatable-column="btnreservar">Reservar</th>
	              <th data-dynatable-column="btneditar">Editar</th>
	        		</tr>
	        	</thead>
	        	<tbody>
	        	</tbody>
	 </table>
</div>
<div class="col-lg-4">
	<fieldset>
	<legend class="label label-info">CONSULTORIOS</legend>
	  <table class="table table-hover" id="tablamed">
	  </table>
	  </fieldset>
	<fieldset>
	<legend class="label label-success">Pacientes en espera</legend>
	  <table class="table table-hover" id="tablapac">
	  </table>
	  </fieldset>
</div>
</div>
</fieldset>
<div class = "modal fade " id = "myModal2" tabindex = "-1" role = "dialog"
   aria-labelledby = "myModalLabel" aria-hidden = "true" >

   <div class = "modal-dialog">
      <div class = "modal-content">

         <div class = "modal-header">
            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                  &times;
            </button>

            <h4 class = "modal-title" id = "myModalLabel">
               Formulario de reserva
            </h4>
         </div>
         <div class = "modal-body">
         <form method="POST" action="reservaticket" class="form-horizontal">

            <table class="table table-hover">
                <input type="hidden" name="idr" id="ID_PACR">
            <tr class="">
              <td class="col-lg-2">CI: </td><td colspan="3"><input class="form-control col-lg-10" type="text" name="CI_PAC" id="CI_PACR" readonly="readonly"></td>

            </tr>
            <tr class="">
              <td class="col-lg-2">Paciente: </td><td colspan="3"><input class="form-control col-lg-10" name="NOM_PAC" id="NOM_PACR" type="text" readonly="readonly"></td>

            </tr>
            <tr >
              <td class="col-lg-2">Especialidad: </td><td class="col-lg-4">
                <select class="form-control" name="eva_tic" required>
                  <option value="">SELECCIONE</option>
                  <?php foreach($especialidades2 as $especialidad):?>
                  <option value="{{$especialidad->NOM_ESP}}" >{{ $especialidad->NOM_ESP }}</option>
                  <?php endforeach;?>
    </select></td>

    <td class="col-lg-1"> Medico: </td>
    <td id="" class="col-lg-4">
      <select name="id_medr" class="form-control" required>
        <option value="">SELECCIONE</option>
        <?php foreach($medicos as $medico):?>
          <option value="{{$medico->id}}"><span style="color:#F73212;">{{$medico->NOM_USU.' '.$medico->APA_USU.' '.$medico->AMA_USU.' - '.$medico->ARE_USU}}</span></option>
        <?php endforeach;?>
      </select>
    </td>


  </tr>

</table>


            <div class="form-group">
              <label class="col-lg-3">Hora de reserva:</label>
              <div class="col-lg-8">
                <input type="time" name="hor_res" class="form-control" required="yes">
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3">Fecha de reserva:</label>
              <div class="col-lg-8">
                <input type="date" min="{{ \Carbon\Carbon::now()->format('d-m-Y') }}" class="form-control" name="fec_res" required="yes">
              </div>
            </div>


         </div>
         <div class = "modal-footer">
            <button type = "button" class = "btn btn-danger" data-dismiss = "modal"> <span class="fa fa-times"></span>
              Cancelar
            </button>
            <button type = "submit" class = "btn btn-primary">
              <span class="fa fa-check"></span> Registrar
            </button>
          </form>
         </div>

      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->

</div><!-- /.modal -->


<div class = "modal fade " id = "myModal" tabindex = "-1" role = "dialog"
   aria-labelledby = "myModalLabel" aria-hidden = "true" >

   <div class = "modal-dialog">
      <div class = "modal-content">

         <div class = "modal-header">
            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                  &times;
            </button>

            <h4 class = "modal-title" id = "myModalLabel">
               Registro de nuevo paciente
            </h4>
         </div>

         <div class = "modal-body">
            <form class="form-horizontal" method="POST" action="registrarpacientes">
            <div class="form-group">
    <label  required class="col-lg-2 control-label">CI :</label>
    <div class="col-lg-4">
      <input type="number" class="form-control" name="ci_pac" id="ci_pac"
             placeholder="Numero CI">

    </div>
    <label for="ejemplo_password_3" class="col-lg-2 control-label">Expedido </label>
    <div class="col-lg-4">
      <select class="form-control" name="exp_pac" id="exp_pac">
      <option value="LP">LP</option>
      <option value="CB">CB</option>
      <option value="SC">SC</option>
      <option value="OR">OR</option>
      <option value="PT">PT</option>
      <option value="CH">CH</option>
      <option value="TJ">TJ</option>
      <option value="BN">BN</option>
      <option value="PA">PA</option>
      </select>
    </div>
    </div>
    <div class="form-group">
     <label  class="col-lg-2 control-label">Nombre :</label>
    <div class="col-lg-10">
      <input type="text" name="nom_pac" class="form-control" id="nom_pac"
             placeholder="Nombre del paciente">
    </div>
    </div>
   <div class="form-group">
    <label for="ejemplo_password_3" class="col-lg-2 control-label">Paterno :</label>
    <div class="col-lg-4">
      <input type="text" class="form-control" name="apa_pac" id="apa_pac"
             placeholder="Apellido paterno">
    </div>

    <label  class="col-lg-2 control-label">Materno :</label>
    <div class="col-lg-4">
      <input type="text" class="form-control" name="ama_pac" id="ama_pac"
             placeholder="Apellido materno">
    </div>
    </div>


    <div class="form-group">
    <label  class="col-lg-2 control-label">Genero :</label>
    <div class="col-lg-4">
      <select class="form-control" name="gen_pac" id="gen_pac"
             >
               <option value="MASCULINO"><span class="fa fa-male"></span>MASCULINO</option>
               <option value="FEMENINO">FEMENINO</option>
             </select>
    </div>
    <label  class="col-lg-2 control-label">Nacimiento </label>
    <div class="col-lg-4">
     <input type="date" name="fec_nac" max="{{ \Carbon\Carbon::now()->format('Y-m-d')}}" class="form-control">
    </div>
    </div>
    <div class="form-group">
    <label  class="col-lg-2 control-label">Telefono</label>
    <div class="col-lg-9">
      <input type="tel" class="form-control" name="tel_pac" id="tel_pac"
             placeholder="Telefono del paciente">

    </div>
    </div>
    <div class="form-group">
    <label  class="col-lg-2 control-label">Profesion</label>
    <div class="col-lg-9">
      <textarea type="text" class="form-control" name="pro_pac" id="pro_pac"
             placeholder="Descripcion de la profesion"></textarea>
    </div>
    </div>

    <div class="form-group">
    <label  class="col-lg-2 control-label">Direccion</label>
    <div class="col-lg-9">
      <textarea type="text" class="form-control" name="dir_pac" id="dir_pac"
             placeholder="Direccion de paciente"></textarea>
    </div>
    </div>
         </div>
         <div class = "modal-footer">
            <button type = "button" class = "btn btn-danger" data-dismiss = "modal"> <span class="fa fa-times"></span>
              Cancelar
            </button>

            <button type = "submit" class = "btn btn-primary">
              <span class="fa fa-check"></span> Registrar
            </button>
            </form>
         </div>

      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->

</div><!-- /.modal -->
  </div>
</div>

<div class = "modal fade " id = "myModal3" tabindex = "-1" role = "dialog"
   aria-labelledby = "myModalLabel" aria-hidden = "true" >

   <div class = "modal-dialog">
      <div class = "modal-content">

         <div class = "modal-header">
            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                  &times;
            </button>

            <h4 class = "modal-title" id = "myModalLabel">
               Modificar paciente
            </h4>
         </div>

         <div class = "modal-body">
            <form class="form-horizontal" method="POST" action="modificarpacientes">
             <input type="hidden" name="id_pac" id="id_pac">
            <div class="form-group">
    <label  required class="col-lg-2 control-label">CI :</label>
    <div class="col-lg-4">
      <input type="text" class="form-control" name="mci_pac" id="mci_pac"
             placeholder="Numero CI">
    </div>

    <label for="ejemplo_password_3" class="col-lg-2 control-label">Expedido </label>
    <div class="col-lg-4">
      <select class="form-control" name="mexp_pac" id="mexp_pac">
      <option value="LP">LP</option>
      <option value="CB">CB</option>
      <option value="SC">SC</option>
      <option value="OR">OR</option>
      <option value="PT">PT</option>
      <option value="CH">CH</option>
      <option value="TJ">TJ</option>
      <option value="BN">BN</option>
      <option value="PA">PA</option>
      </select>
    </div>
    </div>

    <div class="form-group">
     <label  class="col-lg-2 control-label">Nombre :</label>
    <div class="col-lg-10">
      <input type="text" name="mnom_pac" class="form-control" id="mnom_pac"
             placeholder="Nombre del paciente">
    </div>
    </div>
   <div class="form-group">
    <label for="ejemplo_password_3" class="col-lg-2 control-label">Paterno :</label>
    <div class="col-lg-4">
      <input type="text" class="form-control" name="mapa_pac" id="mapa_pac"
             placeholder="Apellido paterno">
    </div>

    <label  class="col-lg-2 control-label">Materno :</label>
    <div class="col-lg-4">
      <input type="text" class="form-control" name="mama_pac" id="mama_pac"
             placeholder="Apellido materno">
    </div>
    </div>


    <div class="form-group">
    <label  class="col-lg-2 control-label">Genero :</label>
    <div class="col-lg-4">
      <select class="form-control" name="mgen_pac" id="mgen_pac"
             >
               <option value="MASCULINO"><span class="fa fa-male"></span>MASCULINO</option>
               <option value="FEMENINO">FEMENINO</option>
             </select>
    </div>
    <label  class="col-lg-2 control-label">Nacimiento </label>
    <div class="col-lg-4">
     <input type="date" name="mfec_nac" max="{{ \Carbon\Carbon::now()->format('Y-m-d')}}" class="form-control" id="mfec_nac">
    </div>
    </div>
    <div class="form-group">
    <label  class="col-lg-2 control-label">Telefono</label>
    <div class="col-lg-9">
      <input type="tel" class="form-control" name="mtel_pac" id="mtel_pac"
             placeholder="Telefono del paciente">

    </div>
    </div>
    <div class="form-group">
    <label  class="col-lg-2 control-label">Profesion</label>
    <div class="col-lg-9">
      <textarea type="text" class="form-control" name="mpro_pac" id="mpro_pac"
             placeholder="Descripcion de la profesion"></textarea>
    </div>
    </div>

    <div class="form-group">
    <label  class="col-lg-2 control-label">Direccion</label>
    <div class="col-lg-9">
      <textarea type="text" class="form-control" name="mdir_pac" id="mdir_pac"
             placeholder="Direccion de paciente"></textarea>
    </div>
    </div>
         </div>
         <div class = "modal-footer">
            <button type = "button" class = "btn btn-danger" data-dismiss = "modal"> <span class="fa fa-times"></span>
              Cancelar
            </button>

            <button type = "submit" class = "btn btn-primary">
              <span class="fa fa-check"></span> Registrar
            </button>
            </form>
         </div>

      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->

</div><!-- /.modal -->
<div class = "modal fade " id = "myModal5" tabindex = "-1" role = "dialog"
   aria-labelledby = "myModalLabel" aria-hidden = "true" >

   <div class = "modal-dialog">
      <div class = "modal-content">

         <div class = "modal-header">
            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                  &times;
            </button>

            <h4 class = "modal-title" id = "myModalLabel">
               Reasignar medico
            </h4>
         </div>

         <div class = "modal-body">

<form action="{{ url('modificarticket2') }}" method="post">
<table class="table table-hover">
    <input type="hidden" name="id" id="IDS_PAC">

  <tr class="">
    <td class="col-lg-2">Paciente: </td><td colspan="3"><input class="form-control col-lg-10" name="NOM_PAC" id="NOMB_PAC" type="text" readonly="readonly"></td>

  </tr>
  <tr >
    <td class="col-lg-2">Especialidad: </td><td class="col-lg-4">
    <select class="form-control" name="eva_tic" id="ESPE" required>
      <option value="">SELECCIONE</option>
      <?php foreach($especialidades2 as $especialidad):?>
        <option value="{{$especialidad->NOM_ESP}}" >{{ $especialidad->NOM_ESP }}</option>
      <?php endforeach;?>
    </select></td>

    <td class="col-lg-1"> Medico: </td>
    <td id="cambios" class="col-lg-4">
    </td>
    <td><button type="button" class="btn btn-success" onclick="javascript:medicos2();"><span class="fa fa-refresh"></span></button></td>

  </tr>

</table>




         </div>
         <div class = "modal-footer">
            <button type = "button" class = "btn btn-danger" data-dismiss = "modal"> <span class="fa fa-times"></span>
              Cancelar
            </button>

            <button type="submit" id="btnreg" class="btn btn-success" style="float:right"><span class="fa fa-stethoscope"> </span> Asignar Medico</button>
            </form>
         </div>

      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->

</div><!-- /.modal -->

<div class = "modal fade " id = "myModal4" tabindex = "-1" role = "dialog"
   aria-labelledby = "myModalLabel" aria-hidden = "true" >

   <div class = "modal-dialog">
      <div class = "modal-content">

         <div class = "modal-header">
            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                  &times;
            </button>

            <h4 class = "modal-title" id = "myModalLabel">
               Asignar medico
            </h4>
         </div>

         <div class = "modal-body">

<form action="{{ url('registroticket2') }}" method="post">
<table class="table table-hover">
    <input type="hidden" name="id" id="ID_PAC">
  <tr class="">
    <td class="col-lg-2">CI: </td><td colspan="3"><input class="form-control col-lg-10" type="text" name="CI_PAC" id="CI_PAC" readonly="readonly"></td>

  </tr>
  <tr class="">
    <td class="col-lg-2">Paciente: </td><td colspan="3"><input class="form-control col-lg-10" name="NOM_PAC" id="NOM_PAC" type="text" readonly="readonly"></td>

  </tr>
  <tr >
    <td class="col-lg-2">Especialidad: </td><td class="col-lg-4">
    <select class="form-control" name="eva_tic" required>
      <option value="">SELECCIONE</option>
      <?php foreach($especialidades2 as $especialidad):?>
        <option value="{{$especialidad->NOM_ESP}}" >{{ $especialidad->NOM_ESP }}</option>
      <?php endforeach;?>
    </select></td>

    <td class="col-lg-1"> Medico: </td>
    <td id="cambio" class="col-lg-4">
    </td>
    <td><button type="button" class="btn btn-success" onclick="javascript:medicos();"><span class="fa fa-refresh"></span></button></td>

  </tr>

</table>




         </div>
         <div class = "modal-footer">
            <button type = "button" class = "btn btn-danger" data-dismiss = "modal"> <span class="fa fa-times"></span>
              Cancelar
            </button>

            <button type="submit" id="btnreg" class="btn btn-success" style="float:right"><span class="fa fa-stethoscope"> </span> Asignar Medico</button>
            </form>
         </div>

      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->

</div><!-- /.modal -->
<script type="text/javascript">
  	$(document).on('ready', function(){
  		var pacientes={!! json_encode($pacientes->toArray())!!};
  		for (var i = 0; i < pacientes.length; i++) {

  			var id=pacientes[i].id;
  			var nompac=pacientes[i].NOM_PAC;
  			var apapac=pacientes[i].APA_PAC;
  			var amapac=pacientes[i].AMA_PAC;
  			var sexpac=pacientes[i].SEX_PAC;
  			var cipac=pacientes[i].CI_PAC;
  			var fecnac=pacientes[i].FEC_PAC;
  			var refpac=pacientes[i].REF_PAC;
  			var dompac=pacientes[i].DOM_PAC;
  			var nropac=pacientes[i].NRO_PAC;
  			var zonpac=pacientes[i].ZON_PAC;
  			var propac=pacientes[i].PRO_PAC;

        var nombrec=nompac+" "+apapac+" "+amapac;

        var b="'"+id+"','"+nompac+"','"+apapac+"','"+amapac+"','"+sexpac+"','"+cipac+"','"+fecnac+"','"+refpac+"','"+dompac+"','"+nropac+"','"+zonpac+"','"+propac+"'";
        var asig="'"+id+"','"+cipac+"','"+nombrec+"'";
        var res="'"+id+"','"+cipac+"','"+nombrec+"'";

        pacientes[i].completo=nombrec;
        pacientes[i].btnasignar='<a onclick="javascript:asigna('+asig+');" class="btn btn-success  active" role="button" data-toggle="modal" data-target="#myModal4" title="Asignar medico"><span class="fa fa-check"> </span></a>';
        pacientes[i].btnreservar='<a onclick="javascript:reserva('+res+');" class="btn btn-primary  active" role="button" data-toggle="modal" data-target="#myModal2" title="Reservar"><span class="fa fa-table"> </span></a>';
        pacientes[i].btneditar='<a onclick="javascript:editar('+b+');" class="btn btn-danger  active" role="button" data-toggle="modal" data-target="#myModal3" title="Eliminar datos del paciente" ><span class="fa fa-magic"> </span></a>';
      }
  		console.log(pacientes);
  		$('#pacientes').dynatable({
  			dataset:{records:pacientes},
  		});
  	});
  </script>
	{!! Html::style('dynatable/jquery.dynatable.css')!!}

	{!! Html::script('dynatable/jquery.dynatable.js')!!}

@stop
