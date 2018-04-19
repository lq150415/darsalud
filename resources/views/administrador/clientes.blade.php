@extends('../admin')
@section('contenido')
<script type="text/javascript" language="javascript" class="init">
            $(document).ready(function() {
    $('#example3').DataTable();
} );
        </script>
<div class="col-lg-10 panel panel-danger" style="width:100%; background:#; margin-top:1%; padding:10px;">
<fieldset class="form-group">
  <legend>Clientes</legend>
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
  <button type="button" class = "btn btn-info" data-toggle = "modal" data-target = "#myModal"> <span class="glyphicon glyphicon-plus"></span>
    Registrar nuevo paciente
  </button><br><br />
<table id="example3" class="table table-hover" style="float:left;">
  <thead >
    <tr>
      <th>Nombre</th>
      <th>Carnet</th>
      <th>Fecha de nacimiento</th>
      <th data-orderable="false"> </th>
    </tr>
  </thead>

  <tbody style="font-size:11px;">
    <tr class="table table-hover">
    <?php
          foreach ($clientes as $cliente):
          ?>
            <th>{{$cliente->NOM_PAC.' '.$cliente->APA_PAC.' '.$cliente->AMA_PAC}}</th>
            <th>{{$cliente->CI_PAC}}</th>
            <th>{{$cliente->FEC_PAC}}</th>
            <th style=" width:85px; "><button data-toggle = "modal" data-target = "#myModal3" onclick="javascript:pasadatos(<?php echo "'".$cliente->id."','".$cliente->NOM_PAC."','".$cliente->APA_PAC."','".$cliente->AMA_PAC."','".$cliente->CI_PAC."','".$cliente->SEX_PAC."','".$cliente->FEC_NAC."','".$cliente->REF_PAC."','".$cliente->DOM_PAC."','".$cliente->PRO_PAC."'"?>)" class="btn btn-primary" title="Modificar datos de cliente"> <span class="glyphicon glyphicon-pencil" style="font-size:12px;"> </span> </button> <button data-toggle = "modal" data-target = "#myModal3" onClick="eliminar(<?php echo $cliente->id;?>);" class="btn btn-danger" title="Eliminar cliente"> <span class="glyphicon glyphicon-trash"  style="font-size:12px;"></span> </button> </th>

              </tr>       </th>

              </tr>
        <?php endforeach;
        ?>

  </tbody>
</table>
</fieldset>
</div>
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
            <form class="form-horizontal" method="POST" action="admregistrarpacientes">
            <div class="form-group">
    <label  required class="col-lg-2 control-label">CI :</label>
    <div class="col-lg-4">
      <input type="text" class="form-control" name="ci_pac" id="ci_pac"
             placeholder="Numero CI">

    </div>
    <label for="ejemplo_password_3" class="col-lg-2 control-label">Expedido </label>
    <div class="col-lg-4">
      <select class="form-control" name="exp_pac" id="exp_pac">
      <option value="">Extranjero</option>
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
             placeholder="Nombre del paciente" required>
    </div>
    </div>
   <div class="form-group">
    <label for="ejemplo_password_3" class="col-lg-2 control-label">Paterno :</label>
    <div class="col-lg-4">
      <input type="text" class="form-control" name="apa_pac" id="apa_pac"
             placeholder="Apellido paterno" required>
    </div>

    <label  class="col-lg-2 control-label">Materno :</label>
    <div class="col-lg-4">
      <input type="text" class="form-control" name="ama_pac" id="ama_pac"
             placeholder="Apellido materno" required>
    </div>
    </div>


    <div class="form-group">
    <label  class="col-lg-2 control-label">Genero :</label>
    <div class="col-lg-4">
      <select class="form-control" name="gen_pac" id="gen_pac"
             required>
               <option value="">SELECCIONE</option>
               <option value="MASCULINO"><span class="fa fa-male"></span>MASCULINO</option>
               <option value="FEMENINO">FEMENINO</option>
             </select>
    </div>
    <label  class="col-lg-2 control-label">Nacimiento </label>
    <div class="col-lg-4">
     <input type="date" name="fec_nac" max="{{ \Carbon\Carbon::now()->format('Y-m-d')}}" class="form-control" required="yes">
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
            <form class="form-horizontal" method="POST" action="admmodificarpacientes">
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
      <option value="">Extranjero</option>
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
              <span class="fa fa-check"></span> Modificar
            </button>
            </form>
         </div>

      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->

</div><!-- /.modal -->
<div class = "modal fade" id = "myModal3" tabindex = "-1" role = "dialog"
   aria-labelledby = "myModalLabel" aria-hidden = "true">

   <div class = "modal-dialog">
      <div class = "modal-content">

         <div class = "modal-header">
            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                  &times;
            </button>
            <h4 class = "modal-title" id = "myModalLabel">
               Confirmar eliminacion
            </h4>
         </div>
         <form action="elicli" method="POST">
         <div class = "modal-body">
         <input type="hidden" id="ideli" name="ideli">
            <div class=" ">Desea eliminar el elemento?</div>

         <div class = "modal-footer" style="border-top: none;">
            <button type = "button" class = "btn btn-danger" data-dismiss = "modal"><span class="glyphicon glyphicon-remove" style="font-size: 10px; "></span>
               Cancelar
            </button>

            <button type = "submit" class = "btn btn-primary"> <span style="font-size: 10px; " class="glyphicon glyphicon-plus"></span>
               Aceptar
            </button>
         </div>
         </div>
         </form>
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->

</div><!-- /.modal -->

<div class = "modal fade" id = "myModal4" tabindex = "-1" role = "dialog"
   aria-labelledby = "myModalLabel" aria-hidden = "true">

   <div class = "modal-dialog">
      <div class = "modal-content">

         <div class = "modal-header">
            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                  &times;
            </button>
            <h4 class = "modal-title" id = "myModalLabel">
               Cambio de contraseña de usuario
            </h4>
         </div>
         <form action="mcousu" method="POST">
         <div class = "modal-body">
         <input type="hidden" id="idcon" name="idcon">
         <div class="form-group">
              <label class="col-lg-3 control-label">Nueva contraseña :</label>
            <div class="col-md-8">
               <input type="password" required class="form-control" name="conusu" id="conusu">
            </div>
            </div>
         <div class = "modal-footer" style="border-top: none;">
            <button type = "button" class = "btn btn-danger" data-dismiss = "modal"><span class="glyphicon glyphicon-remove" style="font-size: 10px; "></span>
               Cancelar
            </button>

            <button type = "submit" class = "btn btn-primary"> <span style="font-size: 10px; " class="glyphicon glyphicon-plus"></span>
               Aceptar
            </button>
         </div>
         </div>
         </form>
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->

</div><!-- /.modal -->
<script type="text/javascript">
  function pasadatos(data1,data2,data3,data4,data5,data6,data7,data8,data9,data10)
  {
    $('#mnom_pac').val(data2);
     $('#mapa_pac').val(data3);
      $('#mama_pac').val(data4);
      var caracter=/[A-Z\s]/gi;
      if(data5.substr(0,1)=="E"){
      var ci= data5;
      var exp='';
      }
      else{
      var ci= data5.replace(caracter,'');
      var exp=data5.substr(data5.length - 2);
      }

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
  </div>
</div>
@stop
