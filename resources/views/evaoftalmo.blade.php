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
     {!! Html::style('font-awesome-4.6.3/css/font-awesome.min.css')!!}
    {!! Html::style('assets/css/sidebar.css') !!}
    {!! Html::script('assets/js/ajax.js')!!}
    {!! Html::script('assets/js/sidebar2.js')!!}
{!! Html::script('js/table/jquery.dataTables.js')!!}
    {!! Html::script('assets/js/bootstrap.js')!!}

</head>
<body style="background-color:#EFEEEE">

 <nav class="navbar navbar-inverse no-margin" style="border-radius: 0; background-color: #000;">
    <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header fixed-brand" >

                    <a class="navbar-brand" href="{{url('/')}}" style="color: #21D3F3; padding-left: 14%; font-size: 25px;"><span class="fa fa-medkit"></span> <b>DARSALUD</b></a>
                </div><!-- navbar-header-->

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                </div><!-- bs-example-navbar-collapse-1 -->
    </nav>

        <!-- Sidebar -->

        <!-- Page Content -->

    <form class="form-horizontal" action="{{$ids}}/pdfoftalmo" method="post" target="_blank">
                       <div class="container">
<div  style="width:100%; background:#fff; margin-top:1%;">
    <div class="alert alert-info" style="font-size:23px;">Evaluacion Oftalmologica <a style="margin-left:40%;" href="../../pacientes/<?php echo $id;?>" class="btn btn-warning">Ver historial clinico</a><button type = "submit" target="_blank" class = "btn btn-primary" style="margin-left:2%;" data-dismiss = "modal"><span class="fa fa-print"></span>
              Imprimir
            </button><a style="margin-left:2%;" href="<?php echo $ids;?>/finalizar" class="btn btn-danger">Finalizar</a></div>
    <div class="alert panel panel-success cuerpo" style="background:#fff; margin-top:-2.7%">

            <fieldset style="background-color:#BEEABE; padding: 2%;">
                <legend>
                    Datos del paciente
                </legend>
                <div class="form-group">
                    <label class="col-lg-2">Apellido paterno: </label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" name="" readonly="readonly" value="{{ $paciente->APA_PAC}}">
                    </div>
                    <label class="col-lg-2">Apellido materno: </label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" readonly="readonly" name="" value="{{ $paciente->AMA_PAC}}">
                    </div>

                </div>
                <div class="form-group">
                    <label class="col-lg-2">Nombres: </label>
                    <div class="col-lg-3">
                        <input type="text" readonly="readonly" class="form-control" name="" value="{{ $paciente->NOM_PAC}}">
                    </div>
                    <label class="col-lg-2">CI: </label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" readonly="readonly" name="" value="{{ $paciente->CI_PAC}}">
                    </div>
                </div>
                <div class="form-group">

                    <label class="col-lg-2">Fecha de nacimiento: </label>
                    <div class="col-lg-3">
                        <input type="text" readonly="readonly" class="form-control" name="" value="{{ $paciente->FEC_PAC}}">
                    </div>                                   <label class="col-lg-2">Edad: </label>
                    <div class="col-lg-3">
                        <input type="text" readonly="readonly" class="form-control" name="" value="<?php
      $edad = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente->FEC_PAC)->format('Y');
      $edad2 = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente->FEC_PAC)->format('m');
      $edad3 = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente->FEC_PAC)->format('d');

       echo $date = \Carbon\Carbon::createFromDate($edad,$edad3,$edad2)->age;
       ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2">Sexo : </label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" name="" readonly="readonly" value="{{ $paciente->SEX_PAC}}">
                    </div>
                    <label class="col-lg-2">Fecha del examen : </label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" readonly="readonly" name="" value="{{ \Carbon\Carbon::now()->format('d-m-Y')}}">
                    </div>

                </div>
                <div class="form-group">
                    <label class="col-lg-2">Direccion : </label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="" readonly="readonly" value="{{ $paciente->DOM_PAC}}">
                    </div>
                </div>
            </fieldset>
            <fieldset style="background-color:#B9DEE3; padding: 2%;">
                <legend style="margin-bottom: 0px; padding-bottom: 0;">Evaluacion</legend>
                 <div class="form-group">
               <label for="ejemplo_email_3" class="col-lg-11 control-label" style="text-align:left">Usa lentes</label>
                <br/><br/>
                <div class="form-control">
                    <label style="text-align:left; margin-right:10%;">
                    <input type="radio" name="opciones" id="opciones_1" value="SI" >
                     SI
                    </label>
                    <label style="margin-right:10%;">
                    <input type="radio" name="opciones" id="opciones_2" value="NO" checked>
                      NO
                    </label>
                </div>
                </div>
            <div class="form-group">
                    <label class="col-lg-2">Ultimo control visual : </label>
                    <div class="col-lg-9">
                        <input type="date" class="form-control" name="fec_con"  >
                    </div>
                </div>
            </fieldset>
            <fieldset style="background-color:#F8F8DE; padding: 2%;">
                <legend style="margin-bottom: 0px; padding-bottom: 0;">Diagnostico</legend>
                <div class="form-group">
                    <label class="col-lg-2">Vision binocular : </label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="vbi" value="">
                    </div>
                    </div>
                <div class="form-group">
                    <label class="col-lg-2">Salud ocular : </label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="soc" value="">
                    </div>
                    </div>
                <div class="form-group">
                    <label class="col-lg-2">Refractivo : </label>
                    <label class="col-lg-1">OD : </label>  <div class="col-lg-4">
                        <input type="text" class="form-control" name="rod" value="">
                    </div>
                   <br/>
                   <br/>
                    <label class="col-lg-2"> </label>
                    <label class="col-lg-1">OI : </label>
                    <div class="col-lg-4">
                        <input type="text" class="form-control" name="roi" value="">
                    </div>
                    </div>
                <div class="form-group">
                    <label class="col-lg-2">Correcion Refractiva Lejos</label>
                    <div class="col-lg-8">
                        <table class="table table-hover" border="2px">
                            <tr>
                                <td></td>
                                <td>ESFERA</td>
                                <td>CILINDRO</td>
                                <td>EJE</td>
                                <td>A.V.</td>
                                <td>DIP</td>
                            </tr>
                            <tr>
                                <td>OD</td>
                                <td><input type="text" name="cesd"></td>
                                <td><input type="text" name="ccid" value=""></td>
                                <td><input type="text" name="cejd" value=""></td>
                                <td><input type="text" name="cavd"></td>
                                <td rowspan="2"><input type="text" name="cdid"></td>
                            </tr>
                            <tr>
                                <td>OI</td>
                                <td><input type="text" name="cesi"></td>
                                <td><input type="text" name="ccii" value=""></td><td><input type="text" name="ceji" value=""></td>

                                <td><input type="text" name="cavi"></td>
                            </tr>
                        </table>
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-lg-2">Correcion Refractiva Cerca</label>
                    <div class="col-lg-9">
                        <table class="table table-hover" border="2px">
                        <tr>ADD</tr>
                        <tr><input class="form-control" type="text" name="add"></tr>
                        </table>
                        </div>
                </fieldset>
                <fieldset style="background-color:#DEF5F8; padding: 2%;">
                <legend style="margin-bottom: 0px; padding-bottom: 0;">Recomendaciones</legend>
                <div class="form-group">
                    <label class="col-lg-2">Uso : </label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="rus" value="">
                    </div>
                    </div>
                <div class="form-group">
                    <label class="col-lg-2">Material : </label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="rma" value="">
                    </div>
                    </div>
                <div class="form-group">
                    <label class="col-lg-2">Observaciones : </label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" name="robs" value="">
                    </div>
                    </div>
                    </fieldset>
<fieldset style="background-color:#E3CFD3; padding: 2%;">
    <legend>RESULTADO FINAL DE LA EVALUACION OFTALMOLOGICA</legend>
    <div class="form-group">
        <label class="col-lg-11">OBSERVACIONES:(EN ESTE ACAPITE SE DEBE INCORPORAR SI EL POSTULANTE ES APTO PARA CONDUCIR VEHICULO, SI NO FUERA APTO INDICAR LOS MOTIVOS)</label>
        <div class="col-lg-11">
            <textarea required="yes" name="rfi_psi" class="form-control" rows="3">APTO PARA CONDUCIR LA CATEGORIA " "</textarea>
        </div>
    </div>
</fieldset>
<div class = "modal-footer">
            <button type = "submit" target="_blank" class = "btn btn-primary" data-dismiss = "modal"><span class="glyphicon glyphicon-check"></span>
              IMPRIMIR EVALUACION
            </button>


         </div>
        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->


    {!! Html::script('assets/js/sidebar2.js')!!}
</body>
</html>
