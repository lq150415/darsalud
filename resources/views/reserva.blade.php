@extends('layout')
@section('contenido')


<script type="text/javascript" language="javascript" class="init">
			$(document).ready(function() {
    $('#example').DataTable();
} );
		</script>
		
<fieldset>
<legend>Reservas</legend>
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
                  <div class="mensajewarning alert alert-info"><label><?php echo Session::get('mensaje');?></label></div>
         <?php endif;?>

<br/><br/>
<div style="width:85%; margin-left:5%; ">
<table id="example" class="table table-hover table-bordered" style="float:left;">
	<thead >
		<tr class="danger">
      <th>Fecha de reserva</th>
			<th>Hora de reserva</th>
			<th>Paciente</th>
      <th>Evaluacion</th>
      <th>Medico asignado</th>
		</tr>
	</thead>
	
	<tbody style="font-size:14px;">
		 <?php if(count($reservas)>0):?>
      <tr>
        <?php  
          foreach ($reservas as $reservas):
          ?>
            <th><?php echo $reservas->FEC_RES;?></th>
            <th><?php echo $reservas->HOR_RES;?></th>
            <th><?php echo $reservas->NOM_PAC.' '.$reservas->APA_PAC.' '.$reservas->AMA_PAC; ?></th>
            <th><?php echo $reservas->EVA_TIC; ?></th>
            <th><?php echo $reservas->NOM_USU.' '.$reservas->APA_USU.' '.$reservas->AMA_USU;?></th>
            
    </tr>
        <?php endforeach; endif;
      
      ?>
		
	</tbody>
</table>
</div>




<div class = "modal fade" id = "myModal" tabindex = "-1" role = "dialog" 
   aria-labelledby = "myModalLabel" aria-hidden = "true" >
   
   <div class = "modal-dialog">
      <div class = "modal-content">
         
         <div class = "modal-header">
            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                  &times;
            </button>
            
            <h4 class = "modal-title" id = "myModalLabel">
             Nuevo producto
            </h4>
         </div>
         
         <div class = "modal-body">
            <form class="form-horizontal" method="POST" action="registrarproducto">
        <div class="form-group">
              <label  class="col-lg-4 control-label">Codigo SAI :</label>
          <div class="col-lg-5">
              <input type="text" class="form-control" name="cod_pro" id="cod_pro"
             placeholder="Codigo">

    </div>

         </div>   
          <div class="form-group">
              <label  class="col-lg-4 control-label">Nombre del producto :</label>
          <div class="col-lg-5">
              <input type="text" class="form-control" name="nom_pro" id="nom_pro"
             placeholder="Nombre del medicamento">

    </div>

         </div>
         <div class="form-group">
              <label  class="col-lg-4 control-label">Fecha de vencimiento :</label>
          <div class="col-lg-5">
              <input type="date" class="form-control" name="fec_pro" id="fec_pro"
             placeholder="Nombre del medicamento">

    </div>

         </div>
         <div class="form-group">
              <label  class="col-lg-4 control-label">Cantidad :</label>
          <div class="col-lg-5">
              <input type="number" min="1" class="form-control" name="can_pro" id="can_pro"
             placeholder="Cantidad del producto">

    </div>
    </div>
<div class="form-group">
              <label  class="col-lg-4 control-label">Precio :</label>
          <div class="col-lg-5">
              <input type="number" min="0.01" step="any" class="form-control" name="pre_pro" id="pre_pro"
             placeholder="Precio del producto en Bs.">

    </div>

         </div>


         
         <div class = "modal-footer">
            <button type = "button" class = "btn btn-danger" data-dismiss = "modal">
            <span class="fa fa-stick"></span>  Cancelar
            </button>
            
            <button type = "submit" class = "btn btn-primary">
               Guardar
            </button>
            </form>
         </div>
         
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
  
</div><!-- /.modal -->
  </div>
</div>

@stop