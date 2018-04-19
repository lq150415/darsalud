@extends('historialpaciente')
@section('contenido')
{!! Html::style('css/pests.css')!!}
{!! Html::script('assets/js/pestania.js')!!}
{!! Html::style('assets/css/pestania.css') !!}
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
              $edad = \Carbon\Carbon::createFromFormat('Y-m-d', $pacientes->FEC_PAC)->format('Y');
              $edad2 = \Carbon\Carbon::createFromFormat('Y-m-d', $pacientes->FEC_PAC)->format('m');
              $edad3 = \Carbon\Carbon::createFromFormat('Y-m-d', $pacientes->FEC_PAC)->format('d');
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
<div class="container-fluid panel" style="padding:20px;">

    <div class="tab tab2">
      <button class="tablinks2" onclick="openCity2(event, 'paciente')" id="defaultOpen2">Datos de paciente</button>
      <button class="tablinks2" onclick="openCity2(event, 'historia')" >Historial</button>
      <button class="tablinks2" onclick="openCity2(event, 'antecped')" >Antec. pediatricos</button>
      <button class="tablinks2" onclick="openCity2(event, 'antecobs')" >Antec. obstectricos</button>
      <button class="tablinks2" onclick="openCity2(event, 'anticon')" >Anticoncepcion</button>
      <button class="tablinks2" onclick="openCity2(event, 'lact')">Lactancia</button>
      <button class="tablinks2" onclick="openCity2(event, 'facries')">Factor Riesgo</button>
      <button class="tablinks2" onclick="openCity2(event, 'riesgo')">Riesgos</button>
      <button class="tablinks2" onclick="openCity2(event, 'patologico')">Antec. patologicos</button>
      <button class="tablinks2" onclick="openCity2(event, 'enfcro')">Enfermedades cronicas</button>
    </div>
    <form class="" action="index.html" method="post">
    <div id="paciente" class="tabcontent2">
        <div style="padding: 2% 10% 0 10%" class="form-group">
      <fieldset class="">
        <legend>Datos personales</legend>
      <div class=" row form-group ">
        <div class="col-lg-4">
          <label for="" class="label label-primary">Nombre:</label> <span class="form-control">{{$pacientes->NOM_PAC}}</span>
        </div>
        <div class="col-lg-4">
          <label for="" class="label label-primary">Apellido paterno:</label> <span class="form-control">{{$pacientes->APA_PAC}}</span>
        </div>
        <div class="col-lg-4">
          <label for="" class="label label-primary">Apellido materno:</label> <span class="form-control">{{$pacientes->AMA_PAC}}</span>
        </div>
      </div>
      <div class=" row form-group">
        <div class="col-lg-4">
          <label for="" class="label label-success">Fecha de nacimiento:</label> <span class="form-control">{{$pacientes->FEC_PAC}}</span>
        </div>
        <div class="col-lg-2">
          <label for="" class="label label-success">Edad:</label> <span class="form-control"><?php
              $edad = \Carbon\Carbon::createFromFormat('Y-m-d', $pacientes->FEC_PAC)->format('Y');
              $edad2 = \Carbon\Carbon::createFromFormat('Y-m-d', $pacientes->FEC_PAC)->format('m');
              $edad3 = \Carbon\Carbon::createFromFormat('Y-m-d', $pacientes->FEC_PAC)->format('d');
              $categorias= \Darsalud\Categorialaboratorio::get();
              echo $date = \Carbon\Carbon::createFromDate($edad,$edad3,$edad2)->age;
              ?></span>
        </div>
        <div class="col-lg-2">
          <label for="" class="label label-success">Genero</label> <span class="form-control">{{$pacientes->SEX_PAC}}</span>
        </div>
        <div class="col-lg-4">
          <label for="" class="label label-success">Fecha de ingreso</label> <span class="form-control">{{\Carbon\Carbon::now()->format('d/m/Y H:i')}}</span>
        </div>
      </div>
      <div class=" row form-group">
        <div class="col-lg-4">
          <label for="" class="label label-warning">Profesion u oficio:</label> <span class="form-control">{{$pacientes->PRO_PAC}}</span>
        </div>
        <div class="col-lg-4">
          <label for="" class="label label-warning">Direccion:</label> <input class="form-control" type="text" placeholder="Direccion del paciente"></input>
        </div>
        <div class="col-lg-4">
          <label for="" class="label label-warning">Telefono</label> <span class="form-control">{{$pacientes->REF_PAC}}</span>
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
        <label for="" class="label label-primary">Numero de Historia clinica:</label> <span class="form-control">{{'HCL-'.$pacientes->id}}</span>
      </div>
      <div class="col-lg-8">
        <label for="" class="label label-primary">Alergias:</label> <input type="text" class="form-control" name="" placeholder="ALERGIAS" value="">
      </div>

    </div>
    <div class=" row form-group">
      <div class="col-lg-4">
        <label for="" class="label label-success">Grupo sanguineo:</label> <input type="text" class="form-control" name="" placeholder="Grupo sanguineo" value="">
      </div>
      <div class="col-lg-2">
        <label for="" class="label label-success">Factor:</label><input type="text" class="form-control" name="" placeholder="Factor" value="">
      </div>

    </div>
    <div class=" row form-group">
        <a href="#" >+ Agregar Razon de especial cuidado</a>
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
        <label for="" class="label label-primary">Peso Recien nacido:</label> <input type="text" class="form-control" name="" placeholder="Factor" value="">
      </div>
      <div class="col-lg-10">
        <a href="#">+ Agregar Observacion perinatal</a>
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
        <label for="" class="label label-primary">G:</label><input type="text" class="form-control" name="" placeholder="G" value="">
      </div>
      <div class="col-lg-3">
        <label for="" class="label label-primary">P:</label><input type="text" class="form-control" name="" placeholder="P" value="">
      </div>
      <div class="col-lg-3">
        <label for="" class="label label-primary">A:</label><input type="text" class="form-control" name="" placeholder="A" value="">
      </div>
      <div class="col-lg-3">
        <label for="" class="label label-primary">C:</label><input type="text" class="form-control" name="" placeholder="C" value="">
      </div>
    </fieldset>
    </div>
    <div class=" row form-group">
      <a href="#">+ Agregar nuevo registro </a>
    </div>
  </fieldset>
  </div>
    </div>
    <div id="anticon" class="tabcontent2">
      <div style="padding: 2% 10% 0 10%" class="form-group">
    <fieldset class="">
      <legend>Anticoncepcion</legend>
    <div class=" row form-group ">
      <a href="#">+ Agregar nuevo registro </a>
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
        <input id="checkBox" class="form-control" type="checkbox">
        <label for="">Periodica</label>
        <input id="checkBox" class="form-control" type="checkbox">
    </div>
  </fieldset>
  </div>
    </div>
    <div id="facries" class="tabcontent2">
      <div style="padding: 2% 10% 0 10%" class="form-group">
    <fieldset class="">
      <legend>Factor de riesgos sociales</legend>
    <div class=" row form-group ">
      <a href="#">+ Añadir nuevo factor de riesgo social</a>
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
              <td><input type="checkbox" class="form-control" name="" value=""></td>
              <td><input type="checkbox" class="form-control" name="" value=""></td>
              <td>Transt - SNC</td>
              <td><input type="checkbox" class="form-control" name="" value=""></td>
              <td><input type="checkbox" class="form-control" name="" value=""></td>
            </tr>
            <tr>
              <td>Hipertension</td>
              <td><input type="checkbox" class="form-control" name="" value=""></td>
              <td><input type="checkbox" class="form-control" name="" value=""></td>
              <td>Obesidad</td>
              <td><input type="checkbox" class="form-control" name="" value=""></td>
              <td><input type="checkbox" class="form-control" name="" value=""></td>
            </tr>
            <tr>
              <td>Diabetes</td>
              <td><input type="checkbox" class="form-control" name="" value=""></td>
              <td><input type="checkbox" class="form-control" name="" value=""></td>
              <td>Desnutricion</td>
              <td><input type="checkbox" class="form-control" name="" value=""></td>
              <td><input type="checkbox" class="form-control" name="" value=""></td>
            </tr>
            <tr>
              <td>Tuberculosis</td>
              <td><input type="checkbox" class="form-control" name="" value=""></td>
              <td><input type="checkbox" class="form-control" name="" value=""></td>
              <td>Drogas</td>
              <td><input type="checkbox" class="form-control" name="" value=""></td>
              <td><input type="checkbox" class="form-control" name="" value=""></td>
            </tr>
            <tr>
              <td>Sifilis</td>
              <td><input type="checkbox" class="form-control" name="" value=""></td>
              <td><input type="checkbox" class="form-control" name="" value=""></td>
              <td>Alcohol</td>
              <td><input type="checkbox" class="form-control" name="" value=""></td>
              <td><input type="checkbox" class="form-control" name="" value=""></td>
            </tr>
            <tr>
              <td>Transfuciones</td>
              <td><input type="checkbox" class="form-control" name="" value=""></td>
              <td><input type="checkbox" class="form-control" name="" value=""></td>
              <td>Tabaquismo</td>
              <td><input type="checkbox" class="form-control" name="" value=""></td>
              <td><input type="checkbox" class="form-control" name="" value=""></td>
            </tr>
            <tr>
              <td>Cirugias</td>
              <td><input type="checkbox" class="form-control" name="" value=""></td>
              <td><input type="checkbox" class="form-control" name="" value=""></td>
              <td>Otros</td>
              <td><input type="checkbox" class="form-control" name="" value=""></td>
              <td><input type="checkbox" class="form-control" name="" value=""></td>
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
      <a href="#">+ Añadir nuevo antecedente patologico</a>
    </div>
  </fieldset>
  </div>
    </div>
    <div id="enfcro" class="tabcontent2">
      <div style="padding: 2% 10% 0 10%" class="form-group">
    <fieldset class="">
      <legend>Medicamentos en enfermedades cronicas</legend>
    <div class=" row form-group ">
      <a href="#">+ Añadir nuevo medicamento</a>
    </div>
  </fieldset>
  </div>
    </div>
    <script type="text/javascript" language="javascript" class="init">
          $(document).ready(function() {
        $('#example').DataTable();
    } );
        </script>


  <div id="notas" class="row col-lg-12 table-responsive">
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
            <td>{{$nota->FEC_NEV}}</td>
            <td>{{$nota->NOM_USU.' '.$nota->APA_USU.' '.$nota->AMA_USU}}</td>
            <td><a data-toggle="modal" data-target="#myModal2"  class="btn btn-info" onclick="javascript:vernota('{{$nota->NNN_NEV}}','{{$nota->RRR_NEV}}','{{$nota->PES_NEV}}','{{$nota->TAL_NEV}}','{{$nota->PA_NEV}}','{{$nota->FC_NEV}}','{{$nota->TEM_NEV}}','{{$nota->FUM_NEV}}','{{$nota->SUB_NEV}}','{{$nota->OBJ_NEV}}','{{$nota->ANA_NEV}}','{{$nota->PLA_NEV}}');">Ver </a>
              </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    </fieldset>
  </div>
</div>

</div>
  </div>



</body>
<script>
// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen2").click();
</script>


@stop
