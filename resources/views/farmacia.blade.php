@extends('layout')
@section('contenido')


<script type="text/javascript" language="javascript" class="init">
			$(document).ready(function() {
    $('#example').DataTable();
} );
		</script>
<script type="text/javascript">
	function kardex(data1,data2,data3,data4,data5,data6)
	{
		$('#cod_pro2').val(data2);
		$('#nom_pro2').val(data3);
		$('#can_pro2').val(data4);
		$('#pre_pro2').val(data5);
		$('#fec_pro2').val(data6);

	}
	function modif(data1,data2,data3,data4,data5,data6)
	{
		$('#id_pro3').val(data1)
		$('#cod_pro3').val(data2);
		$('#nom_pro3').val(data3);
		$('#can_pro3').val(data4);
		$('#pre_pro3').val(data5);
		$('#fec_pro3').val(data6);

	}
	function tipoentrada(sel)
	{
		if(sel.value==0){
			divC = document.getElementById("precio_pro");
				 divC.style.display = "none";

				 divT = document.getElementById("fecha_pro");
				 divT.style.display = "none";
		}
		if(sel.value==1){
			divC = document.getElementById("precio_pro");
           divC.style.display = "";

           divT = document.getElementById("fecha_pro");
           divT.style.display = "none";
		}
		if(sel.value==2){
			divC = document.getElementById("precio_pro");
					 divC.style.display = "none";

					 divT = document.getElementById("fecha_pro");
					 divT.style.display = "";
		}
		if(sel.value==3){
			divC = document.getElementById("precio_pro");
					 divC.style.display = "";

					 divT = document.getElementById("fecha_pro");
					 divT.style.display = "";
		}
	}
	function entrada(data1)
	{
			$('#id_pro4').val(data1);
	}
	function salida(data1)
	{
			$('#id_pro5').val(data1);
	}
</script>
<fieldset>
<legend>Inventario de farmacias</legend>
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

<button type="button" class = "btn btn-info" data-toggle = "modal" data-target = "#myModal"> <span class="glyphicon glyphicon-plus"></span>
  Nuevo producto
</button>
<br/><br/>
<div style="width:85%; margin-left:5%; ">
<table id="example" class="display" style="float:left;">
	<thead >
		<tr>
      <th>COD SAI</th>
			<th>Descripcion del producto</th>
			<th>Cantidad</th>
      <th>Precio</th>
      <th>Fecha de vencimiento</th>
			<th data-orderable="false">ACCIONES</th>
		</tr>
	</thead>

	<tbody style="font-size:11px;">
		 <?php if(count($productos)>0):?>
      <tr>
        <?php
          foreach ($productos as $producto):
          ?>
            <th width="15%"><?php echo $producto->COD_PRO;?></th>
            <th width="25%"><?php echo $producto->NOM_PRO;?></th>
            <th width="10%"><?php echo $producto->CAN_PRO; ?></th>
            <th width="10%"><?php echo $producto->PRE_PRO; ?></th>
            <th width="10%"><?php echo $producto->FEC_PRO;?></th>
						<th width="25%"><button onclick="javascript:kardex({{ "'".$producto->id."','".$producto->COD_PRO."','".$producto->NOM_PRO."','".$producto->CAN_PRO."','".$producto->PRE_PRO."','".\Carbon\Carbon::createFromFormat('Y-m-d',$producto->FEC_PRO)->format('Y-m-d')."'"}})" type="button" data-toggle = "modal" data-target = "#myModal2" class="btn btn-warning" name="button" title="Ver Kardex"><span class="fa fa-bars"></span></button> <button onclick="javascript:modif({{ "'".$producto->id."','".$producto->COD_PRO."','".$producto->NOM_PRO."','".$producto->CAN_PRO."','".$producto->PRE_PRO."','".$producto->FEC_PRO."'"}})" type="button" class="btn btn-primary" name="button" title="Modificar datos de producto" data-toggle = "modal" data-target = "#myModal3"><span class="fa fa-magic"></span></button> <button type="button" onclick="javascript:entrada({{ "'".$producto->id."'"}})" class="btn btn-success" title="Entrada de productos" data-toggle = "modal" data-target = "#myModal4" name="button"><span class="fa fa-plus"></span></button> <button onclick="javascript:salida({{ "'".$producto->id."'"}})" type="button" class="btn btn-danger" data-toggle = "modal" data-target = "#myModal5" name="button" title="Salida de productos"><span class="fa fa-minus"></span></button></th>

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

<div class = "modal fade" id = "myModal2" tabindex = "-1" role = "dialog"
   aria-labelledby = "myModalLabel" aria-hidden = "true" >

   <div class = "modal-dialog">
      <div class = "modal-content">

         <div class = "modal-header">
            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                  &times;
            </button>

            <h4 class = "modal-title" id = "myModalLabel">
             Kardex del producto
            </h4>
         </div>
				 <form class="form-horizontal" method="POST" action="registrarproducto">

         <div class = "modal-body">
            <div class="form-group">
              <label  class="col-lg-4 control-label">Codigo SAI :</label>
          <div class="col-lg-5">
              <input readonly="yes" type="text" class="form-control" name="cod_pro2" id="cod_pro2"
             placeholder="Codigo">

    	 		</div>

</div>
          <div class="form-group">
              <label  class="col-lg-4 control-label">Nombre del producto :</label>
          <div class="col-lg-5">
              <input readonly="yes" type="text" class="form-control" name="nom_pro2" id="nom_pro2"
             placeholder="Nombre del medicamento">

    </div>

         </div>
         <div class="form-group">
              <label  class="col-lg-4 control-label">Fecha de vencimiento :</label>
          <div class="col-lg-5">
              <input readonly="yes" type="date" class="form-control" name="fec_pro2" id="fec_pro2"
             placeholder="Nombre del medicamento">

    </div>

         </div>
         <div class="form-group">
              <label  class="col-lg-4 control-label">Cantidad :</label>
          <div class="col-lg-5">
              <input readonly="yes" type="number" min="1" class="form-control" name="can_pro2" id="can_pro2"
             placeholder="Cantidad del producto">

    </div>
    </div>
<div class="form-group">
              <label  class="col-lg-4 control-label">Precio :</label>
          <div class="col-lg-5">
              <input readonly="yes" type="number" min="0.01" step="any" class="form-control" name="pre_pro2" id="pre_pro2"
             placeholder="Precio del producto en Bs.">

    </div>

         </div>



         <div class = "modal-footer">
            <button type = "button" class = "btn btn-success" data-dismiss = "modal">
            <span class="fa fa-check"></span>  Aceptar
            </button>


            </form>
         </div>

      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->

</div><!-- /.modal -->
  </div>
</div>

<div class = "modal fade" id = "myModal3" tabindex = "-1" role = "dialog"
   aria-labelledby = "myModalLabel" aria-hidden = "true" >

   <div class = "modal-dialog">
      <div class = "modal-content">

         <div class = "modal-header">
            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                  &times;
            </button>

            <h4 class = "modal-title" id = "myModalLabel">
             Modificar datos de producto
            </h4>
         </div>

         <div class = "modal-body">
            <form class="form-horizontal" method="POST" action="modificarproducto">
        <div class="form-group">
							<input type="hidden" name="id_pro3" id="id_pro3" value="">
              <label  class="col-lg-4 control-label">Codigo SAI :</label>
          <div class="col-lg-5">
              <input type="text" class="form-control" name="cod_pro3" id="cod_pro3"
             placeholder="Codigo">

    </div>

         </div>
          <div class="form-group">
              <label  class="col-lg-4 control-label">Nombre del producto :</label>
          <div class="col-lg-5">
              <input type="text" class="form-control" name="nom_pro3" id="nom_pro3"
             placeholder="Nombre del medicamento">

    </div>

         </div>
         <div class="form-group">
              <label  class="col-lg-4 control-label">Fecha de vencimiento :</label>
          <div class="col-lg-5">
              <input type="date" class="form-control" name="fec_pro3" id="fec_pro3"
             placeholder="Nombre del medicamento">

    </div>

         </div>
         <div class="form-group">
              <label  class="col-lg-4 control-label">Cantidad :</label>
          <div class="col-lg-5">
              <input type="number" min="1" class="form-control" name="can_pro3" id="can_pro3"
             placeholder="Cantidad del producto">

    </div>
    </div>
<div class="form-group">
              <label  class="col-lg-4 control-label">Precio :</label>
          <div class="col-lg-5">
              <input type="number" min="0.01" step="any" class="form-control" name="pre_pro3" id="pre_pro3"
             placeholder="Precio del producto en Bs.">

    </div>

         </div>



         <div class = "modal-footer">
            <button type = "button" class = "btn btn-danger" data-dismiss = "modal">
            <span class="fa fa-stick"></span>  Cancelar
            </button>

            <button type = "submit" class = "btn btn-primary"><span class="fa fa-pencil"></span>
               Guardar cambios
            </button>
            </form>
         </div>

      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->

</div><!-- /.modal -->
  </div>
</div>

<div class = "modal fade" id = "myModal4" tabindex = "-1" role = "dialog"
   aria-labelledby = "myModalLabel" aria-hidden = "true" >

   <div class = "modal-dialog">
      <div class = "modal-content">

         <div class = "modal-header">
            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                  &times;
            </button>

            <h4 class = "modal-title" id = "myModalLabel">
             Entrada de productos
            </h4>
         </div>

         <div class = "modal-body">
            <form class="form-horizontal" method="POST" action="entradaproducto">
							<input type="hidden" name="id_pro4" id="id_pro4" value="">
        <div class="form-group">
              <label  class="col-lg-4 control-label">Tipo de entrada :</label>
          <div class="col-lg-5">
              <select class="form-control" name="tip_ent" onChange="tipoentrada(this)">
								<option value="0">MISMO PRODUCTO</option>
								<option value="1">NUEVO PRECIO</option>
								<option value="2">NUEVA FECHA DE VENCIMIENTO</option>
								<option value="3">NUEVA FECHA DE VENCIMIENTO Y PRECIO</option>

              </select>
    </div>

         </div>

         <div class="form-group">
              <label  class="col-lg-4 control-label">Cantidad :</label>
          <div class="col-lg-5">
              <input required="yes" type="number" min="1" class="form-control" name="can_pro4" id="can_pro4"
             placeholder="Cantidad del producto">

    </div>
    </div>
			<div class="form-group" id="precio_pro" style="display:none;">
              <label  class="col-lg-4 control-label">Precio :</label>
          <div class="col-lg-5">
              <input  type="number" min="0.01" step="any" class="form-control" name="pre_pro4" id="pre_pro4"
             placeholder="Precio del producto en Bs.">

    </div>

         </div>
				 <div class="form-group" id="fecha_pro" style="display:none;">
              <label  class="col-lg-4 control-label">Fecha de vencimiento :</label>
          <div class="col-lg-5">
              <input  type="date" class="form-control" name="fec_pro4" id="fec_pro4"
             placeholder="Nombre del medicamento">

    </div>

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

<div class = "modal fade" id = "myModal5" tabindex = "-1" role = "dialog"
   aria-labelledby = "myModalLabel" aria-hidden = "true" >

   <div class = "modal-dialog">
      <div class = "modal-content">

         <div class = "modal-header">
            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                  &times;
            </button>

            <h4 class = "modal-title" id = "myModalLabel">
             Salida de productos
            </h4>
         </div>

         <div class = "modal-body">
            <form class="form-horizontal" method="POST" action="salidaproducto">
							<input type="hidden" name="id_pro5" id="id_pro5" value="">
         <div class="form-group">
              <label  class="col-lg-4 control-label">Cantidad de salida :</label>
          <div class="col-lg-5">
              <input type="number" min="1" class="form-control" name="can_pro5" id="can_pro5"
             placeholder="Cantidad del producto">

    </div>
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
