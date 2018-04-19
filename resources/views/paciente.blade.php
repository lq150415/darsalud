@extends('layoutmedicos')
@section('contenido')
<script type="text/javascript" language="javascript" class="init">
            $(document).ready(function() {
    $('#example').DataTable();
} );
        </script>
<style type="text/css">
	.shadow {
border: 1px solid #696;
padding: 60px 0;
text-align: center; width: 200px;
-webkit-border-radius: 8px;
-moz-border-radius: 8px;
border-radius: 8px;
-webkit-box-shadow: #666 3px 3px 20px;
-moz-box-shadow: #666 3px 3px 20px;
box-shadow: #666 3px 3px 20px;
background: rgb(255,255,136); /* Old browsers */
background: -moz-linear-gradient(top, rgba(255,255,136,1) 0%, rgba(255,255,136,1) 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(top, rgba(255,255,136,1) 0%,rgba(255,255,136,1) 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to bottom, rgba(255,255,136,1) 0%,rgba(255,255,136,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffff88', endColorstr='#ffff88',GradientType=0 ); /* IE6-9 */

}
.shadow:hover{
	opacity:0.95;

}

</style>
<script language="javascript">
  function atencion()
  { id=1;
    $.post("atencion", { id: id }, function(data){
                $("#atencion").html(data);
            });
      setTimeout('atencion()',6000);
  }
  $(document).ready(function()
    {
        atencion();
    });
</script>
<script type="text/javascript">
              $(document).ready(function() { setTimeout(function(){ $(".mensajewarning").fadeIn(2500); },0000); });
              $(document).ready(function() { setTimeout(function(){ $(".mensajewarning").fadeOut(2500); },5000); });
            </script>
         <?php if (Session::has('mensaje2')):
            ?>
                  <div class="mensajewarning alert alert-danger" ><label><?php echo Session::get('mensaje2');?></label></div>
         <?php endif;?>
         <?php if (Session::has('mensaje')):
            ?>
                  <div class="mensajewarning alert alert-success"><label><?php echo Session::get('mensaje');?></label></div>
         <?php endif;?>


<div style="width:100%; float:left; margin-top:5%;">
	<fieldset>
	<legend class="label label-danger" style="font-size: 20px">Pacientes</legend>
	<br/>
	<br/>
	<br/>

	<table id="example" class="table table-hover">
		<thead>
			<tr>
				<th>CI</th>
				<th>Paciente</th>
        <th>Numero de Historia clinica</th>
				<th>Ver Historial</th>
			</tr>
		</thead>
		<tbody>
			 <?php if(count($pacientes)>0):?>
      <tr>
        <?php
          foreach ($pacientes as $paciente):
            $nombre=$paciente->NOM_PAC.' '.$paciente->APA_PAC.' '.$paciente->AMA_PAC;
          ?>
            <th><?php echo $paciente->CI_PAC;?></th>
            <th><?php echo $nombre; ?></th>
            <th
              <?php
               $com=\Darsalud\Consultaext::where('ID_PAC','=',$paciente->id)->first();
                  if(isset($com))
                  {
                    echo 'class="success">'.$com->HCL_COE;
                  }
                  else
                  {
                    echo 'class="danger">NO REGISTRA';
                  }
              ?>
            </th>
            <th><a class="btn btn-success" href="pacientes/{{$paciente->id}}" title="Ver historial"> <span class="fa fa-search"> </span> </a></th>
    </tr>
        <?php endforeach; endif;

      ?>
		</tbody>
	</table>
	</fieldset>
</div>
@stop
