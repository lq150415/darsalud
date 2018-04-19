@extends('../admin')
@section('contenido')

<div class="container panel panel-success">
  <fieldset>
  <legend>Informe medicos</legend>
  <table id="example" class="table table-hover" style="float:left;">
    <thead >
      <tr height="50px;">
        <th>Nombre</th>
        <th>Atendidos hoy</th>
        <th>Atendidos en el mes</th>
        <th>Total de Ev. Medicas</th>
        <th>Total de Ev. Psicologicas</th>
        <th>Total de Ev. Otorrino</th>
        <th>Total de Consultas externas</th>
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
              <th style=" width:85px; "><button data-toggle = "modal" data-target = "#myModal2" onclick="modificar(<?php echo "'$cliente->NOM_CLI'".','."'$cliente->APA_CLI'".','."'$cliente->AMA_CLI'".','."'$cliente->TEL_CLI'".','."'$cliente->EMA_CLI'".','."'$cliente->DIR_CLI'".','."'$cliente->id"."'";?>);" class="btn btn-primary" title="Modificar datos de cliente"> <span class="glyphicon glyphicon-pencil" style="font-size:12px;"> </span> </button> <button data-toggle = "modal" data-target = "#myModal3" onClick="eliminar(<?php echo $cliente->id;?>);" class="btn btn-danger" title="Eliminar cliente"> <span class="glyphicon glyphicon-trash"  style="font-size:12px;"></span> </button> </th>

                </tr>       </th>

                </tr>
          <?php endforeach;
          ?>
    </tbody>
  </table>
</fieldset>
</div>




@stop
