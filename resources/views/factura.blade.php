@extends('layout')
@section('contenido')
<script type="text/javascript" language="javascript" class="init">
			$(document).ready(function() {
    $('#example').DataTable();
} );
		</script>
 <form class="form-horizontal" method="POST" action="reg_solicitud">
			
     				<div class = "modal-content" style="overflow:auto;">
         			<div class = "modal-header alert-info">
         			<h4 class = "modal-title" id = "myModalLabel">
              			 DATOS FACTURA
           			</h4>
           			</div>
           			 <div class = "modal-body">
          		<div class="form-group">
            	<label class="col-lg-2 control-label">Fecha :</label>
         		
           		 <label style="color:#487B9C" class="col-lg-1 control-label">{{ \Carbon\Carbon::now()->format('d/m/Y')}}</label>
        	
        		
         		</div>
         		<div class="form-group">
            	<label class="col-lg-2 control-label">Numero de factura :</label>
           		 <label style="color:#487B9C" class="col-lg-1 control-label"> 000001</label>
         		</div>
				<div class="form-group">
            	<label class="col-md-2 control-label">NIT/CI cliente :</label>
         		<div class="col-md-3">
           		 <input type="number" name="nit" id="nit" class="form-control">
        		</div>
         		</div>		
				
				<div class="form-group">
            	<label class="col-md-2 control-label">Razon social:</label>
         		<div class="col-md-3">
           		 <input type="text" name="razon" id="razon" class="form-control">
        		</div>
              <label class="col-md-2 control-label">Categorias:</label>
            <div class="col-md-3">
               <select name="cat" id="cat" class="form-control">
                  <OPTION value="">SELECCIONE</OPTION>
                  <option value="">SEGIP</option>
                  <option value="">DAR SALUD</option>
                  <option value="">SERVICIOS</option>
                  <option value="">FARMACIA</option>
               </select>
            </div>
            
         		</div>
				<input type="hidden" value="0" name="dest"></input>
		</div>
 <div class="container-fluid">
<button type="button" id="agregar" class="btn" style="background-color: #00a65a; width:100%;" data-toggle = "modal" data-target = "#myModal"><span class="fa fa-plus" style="color:#fff;"></span></button>
					</table>
</br>
<div class="table-responsive">
				<table id="tabla" class="table table-responsive table-hover">
	<!-- Cabecera de la tabla -->
						<thead>
							<tr>
								<th width="48%">Producto</th>
								<th width="11%">Precio</th>
								<th width="9%">Cantidad</th>
								<th width="9%" class="info">Subtotal</th> 
								<th width="10%">&nbsp;</th>
							</tr>
						</thead>
 
	<!-- Cuerpo de la tabla con los campos -->
						<tbody>
		<!-- fila base para clonar y agregar al final -->
							<tr> 
								<td><input type="text" class="form-control" required="yes" id="producto" name="producto[]" readonly="readonly"/></td>
								<input type="hidden" class="form-control" id="idproducto" name="idproducto[]" required="yes" />
								<td><input type="text" required="required" class="form-control" id="pre_pro" name="pre_pro[]" readonly="readonly"/></td>
								<td><input type="number" step="1" min="0" id="can_pro" value="0" class="form-control" name="can_pro[]" /></td>
								<td class="info"><input type="text" class="form-control" id="sub_pro" name="sub_pro[]" readonly="readonly"/></td>
								<td class="btn btn-danger eliminar"><span class="glyphicon glyphicon-remove"></span> Eliminar</td>								
							</tr>
		<!-- fin de código: fila base -->
 
		<!-- Fila de ejemplo -->
							
		<!-- fin de código: fila de ejemplo -->
 
						</tbody>
					</table>
					<div id="demo" class="alert alert-danger" style="height: auto;"></div>
					</div>
<!-- Botón para agregar filas -->
				 <div class = "modal-footer" style="border-top: 0;">
            
            <button type = "submit" class = "btn btn-primary"><span style="font-size: 10px;" class="fa fa-navicon"></span>
               FACTURAR
            </button>
         </div>
         </form>						
		</div>
		</div>
</div>
</div>
 </div>


 <div class = "modal fade" id = "myModal" tabindex = "-1" role = "dialog" 
   aria-labelledby = "myModalLabel" aria-hidden = "true" >
   
   <div class = "modal-dialog">
      <div class = "modal-content">
         
         <div class = "modal-header">
            <button type = "button" class = "close eliminar2" data-dismiss = "modal" aria-hidden = "true">
                  &times;
            </button>
            
            <h4 class = "modal-title" id = "myModalLabel">
               Productos 
            </h4>
         </div>
         
         <div class = "modal-body">
           <div style="width:85%; margin-left:5%; ">
<table id="example" class="display" style="float:left;">
	<thead >
		<tr>
			<th>Producto</th>
			<th>Precio</th>
			<th data-orderable="false">Añadir</th>	
		</tr>
	</thead>
	
	<tbody style="font-size:11px;">
		
		
	</tbody>
</table>
</div>
         </div>
         
         <div class = "modal-footer">
            <button type = "button" class = "btn btn-danger" data-dismiss = "modal">
              Cancelar
            </button>
            
            <button type = "submit" class = "btn btn-primary">
               Guardar
            </button>
            </form>
         </div>
         
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
  
</div><!-- /.modal -->
@stop