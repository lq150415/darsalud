@extends('../admin')
@section('contenido')
  <div class="col-lg-10 panel panel-danger" style="width:100%; background:#; margin-top:1%; padding:10px;">
  <fieldset class="form-group">
    <legend>Usuarios</legend>
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
      Registrar nuevo usuario
    </button><br><br />
  <table id="example" class="table table-hover" style="" >
    <thead >
      <tr>
        <th>Nombre</th>
        <th>Especialidad</th>
        <th>Tipo de cuenta</th>
        <th>Centro</th>
        <th>Telefono</th>
        <th>Nick</th>
        <th data-orderable="false"> </th>
      </tr>
    </thead>

    <tbody >
      <tr class="table table-hover">
      <?php
            foreach ($users as $user):
            ?>
              <th>{{$user->NOM_USU.' '.$user->APA_USU.' '.$user->AMA_USU}}</th>
              <th>{{$user->ARE_USU}}</th>
              <th>{{$user->NIV_USU}}</th>
              <th>{{$user->EST_USU}}</th>
              <th>{{$user->TEL_USU}}</th>
              <th>{{$user->NIC_USU}}</th>
              <th width="15%"><button data-toggle = "modal" data-target = "#myModal2"  class="btn btn-primary" title="Modificar datos de usuario"  onclick="javascript:pasadatos(<?php echo "'".$user->id."','".$user->NOM_USU."','".$user->APA_USU."','".$user->AMA_USU."','".$user->EST_USU."','".$user->NIV_USU."','".$user->TEL_USU."','".$user->ARE_USU."','".$user->NIC_USU."'"?>)"> <span class="glyphicon glyphicon-pencil" style="font-size:12px;"> </span> </button> <button data-toggle = "modal" data-target = "#myModal4" onClick="pasarcont({{$user->id}})" class="btn btn-warning" title="Modificar contraseña"> <span class="fa fa-key"  style="font-size:12px;"></span> </button> <button data-toggle = "modal" data-target = "#myModal3" onClick="pasarid({{$user->id}})" class="btn btn-danger" title="Eliminar usuario"> <span class="glyphicon glyphicon-trash"  style="font-size:12px;"></span> </button></th>

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
                 Registro de nuevo usuario
              </h4>
           </div>

           <div class = "modal-body">
           <form class="form-horizontal" method="POST" action="admregistrarusuarios">
              <div class="form-group">
               <label  class="col-lg-2 control-label">Nombre :</label>
              <div class="col-lg-10">
                <input type="text" name="nom_usu" class="form-control" id="nom_usu"
                       placeholder="Nombre del usuario" required>
              </div>
              </div>
             <div class="form-group">
              <label for="ejemplo_password_3" class="col-lg-2 control-label">Paterno :</label>
              <div class="col-lg-4">
                <input type="text" class="form-control" name="apa_usu" id="apa_usu"
                       placeholder="Apellido paterno" required>
              </div>

              <label  class="col-lg-2 control-label">Materno :</label>
              <div class="col-lg-4">
                <input type="text" class="form-control" name="ama_usu" id="ama_usu"
                       placeholder="Apellido materno" required>
              </div>
              </div>
              <div class="form-group">
               <label  class="col-lg-2 control-label">Centro :</label>
              <div class="col-lg-4">
                    <select class="form-control" name="esp_usu" id="esp_usu">
                      <option value="">SELECCIONE</option>
                      <option value="20 de octubre">Darsalud - 20 de octubre</option>
                      <option value="Mexico">Darsalud - Mexico</option>
                      <option value="Satelite">Darsalud - Satelite</option>
                      <option value="Calacoto">Darsalud - Calacoto</option>
                      <option value="Ferropetrol">Darsalud - Ferropetrol</option>
                    </select>
              </div>
               <label  class="col-lg-2 control-label">Cuenta :</label>
              <div class="col-lg-4">
                    <select class="form-control" name="niv_usu" id="niv_usu">
                      <option value="">SELECCIONE</option>
                      <option value="3">Cuenta de recepcion</option>
                      <option value="2">Cuenta para el personal medico</option>
                      <option value="1">Super usuario - Administrador</option>
                    </select>
              </div>
              </div>
              <div class="form-group">
              <label  class="col-lg-2 control-label">Telefono:</label>
              <div class="col-lg-9">
                <input type="tel" class="form-control" name="tel_usu" id="tel_usu"
                       placeholder="Telefono del usuario">
              </div>
              </div>
              <div class="form-group">
              <label  class="col-lg-2 control-label">Especialidad:</label>
              <div class="col-lg-9">
                <textarea type="text" class="form-control" name="are_usu" id="are_usu"
                       placeholder="Descripcion de la especialidad"></textarea>
              </div>
              </div>
              <div class="form-group">
               <label  class="col-lg-2 control-label">Nick:</label>
              <div class="col-lg-10">
                <input type="text" name="nic_usu" class="form-control" id="nic_usu"
                       placeholder="Nombre del usuario para ingresar al sistema" required>
              </div>
              </div>
              <div class="form-group">
               <label  class="col-lg-2 control-label">Contraseña:</label>
              <div class="col-lg-10">
                <input type="password" name="pas_usu" class="form-control" id="pas_usu"
                       placeholder="Contraseña para ingresar al sistema" required>
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

    <div class = "modal fade  " id = "myModal2" tabindex = "-1" role = "dialog"
       aria-labelledby = "myModalLabel" aria-hidden = "true" >
       <div class = "modal-dialog modal-lg">
          <div class = "modal-content">
             <div class = "modal-header">
                <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">
                      &times;
                </button>
                <h4 class = "modal-title" id = "myModalLabel">
                   Modificar
                </h4>
             </div>
             <div class = "modal-body">
             <form class="form-horizontal" method="POST" action="admmodificarusuarios">
               <input type="hidden" name="id_usu" id="id_usu">
                <div class="form-group">
                 <label  class="col-lg-2 control-label">Nombre :</label>
                <div class="col-lg-10">
                  <input type="text" name="nom_usu" class="form-control" id="mnom_usu"
                         placeholder="Nombre del usuario" required>
                </div>
                </div>
               <div class="form-group">
                <label for="ejemplo_password_3" class="col-lg-2 control-label">Paterno :</label>
                <div class="col-lg-4">
                  <input type="text" class="form-control" name="apa_usu" id="mapa_usu"
                         placeholder="Apellido paterno" required>
                </div>

                <label  class="col-lg-2 control-label">Materno :</label>
                <div class="col-lg-4">
                  <input type="text" class="form-control" name="ama_usu" id="mama_usu"
                         placeholder="Apellido materno" required>
                </div>
                </div>
                <div class="form-group">
                 <label  class="col-lg-2 control-label">Centro :</label>
                <div class="col-lg-4">
                      <select class="form-control" name="est_usu" id="mest_usu">
                        <option value="">SELECCIONE</option>
                        <option value="20 de octubre">Darsalud - 20 de octubre</option>
                        <option value="Darsalud - Mexico">Darsalud - Mexico</option>
                        <option value="Darsalud - Satelite">Darsalud - Satelite</option>
                        <option value="Darsalud - Calacoto">Darsalud - Calacoto</option>
                        <option value="Darsalud - Ferropetrol">Darsalud - Ferropetrol</option>
                      </select>
                </div>
                 <label  class="col-lg-2 control-label">Cuenta :</label>
                <div class="col-lg-4">
                      <select class="form-control" name="niv_usu" id="mniv_usu">
                        <option value="">SELECCIONE</option>
                        <option value="3">Cuenta de recepcion</option>
                        <option value="2">Cuenta para el personal medico</option>
                        <option value="1">Super usuario - Administrador</option>
                      </select>
                </div>
                </div>
                <div class="form-group">
                <label  class="col-lg-2 control-label">Telefono:</label>
                <div class="col-lg-9">
                  <input type="tel" class="form-control" name="tel_usu" id="mtel_usu"
                         placeholder="Telefono del usuario">
                </div>
                </div>
                <div class="form-group">
                <label  class="col-lg-2 control-label">Especialidad:</label>
                <div class="col-lg-9">
                  <textarea type="text" class="form-control" name="are_usu" id="mare_usu"
                         placeholder="Descripcion de la especialidad"></textarea>
                </div>
                </div>
                <div class="form-group">
                 <label  class="col-lg-2 control-label">Nick:</label>
                <div class="col-lg-10">
                  <input type="text" name="nic_usu" class="form-control" id="mnic_usu"
                         placeholder="Nombre del usuario para ingresar al sistema" required>
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
             <form action="admeliminarusuario" method="POST">
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
             <form action="admmodificarpass" method="POST">
             <div class = "modal-body">
             <input type="hidden" id="idcon" name="idcon">
             <div class="form-group">
                  <label class="col-lg-3 control-label">Nueva contraseña :</label>
                <div class="col-md-8">
                   <input type="password" required class="form-control" name="conusu" id="conusu">
                </div>
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
        $('#id_usu').val(data1);
        $('#mnom_usu').val(data2);
        $('#mapa_usu').val(data3);
        $('#mama_usu').val(data4);
        $('#mest_usu option[value="'+data5+'"]').prop('selected','selected').change();
        $('#mniv_usu option[value="'+data6+'"]').prop('selected','selected').change();
        $('#mtel_usu').val(data7);
        $('#mare_usu').val(data8);
        $('#mnic_usu').val(data9);
      }
      function pasarcont(data1)
      {
        $('#idcon').val(data1);
      }
      function pasarid(data1)
      {
        $('#ideli').val(data1);
      }
    </script>
@endsection
