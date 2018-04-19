@extends('../admin')
@section('contenido')
  {!! Html::script('js/pestanna.js')!!}
  {!! Html::style('css/pestanna.css')!!}
<div class="container-fluid">
    <div class="panel">
      <div id="contenedor">
    <input id="tab-1" type="radio" name="radio-set" class="tab-selector-1" checked="checked" />
    <label for="tab-1" class="tab-label-1">Evaluaciones Medicas</label>

    <input id="tab-2" type="radio" name="radio-set" class="tab-selector-2" />
    <label for="tab-2" class="tab-label-2">Evaluaciones Psicologicas</label>

    <input id="tab-3" type="radio" name="radio-set" class="tab-selector-3" />
    <label for="tab-3" class="tab-label-3">Evaluaciones Oftalmologicas</label>

    <input id="tab-4" type="radio" name="radio-set" class="tab-selector-4" />
    <label for="tab-4" class="tab-label-4">Consulta externa</label>

    <div class="content">
        <div class="content-1">
            <fieldset>
              <legend>Lista de medicos - Evaluaciones medicas</legend>
              <table id="example"  class="table table-hover " >
              <thead>
                <tr>
                  <td width="30%">Nombre</td>
                  <td width="10%">Diario</td>
                  <td width="10%">Mensual</td>
                  <td width="10%">Total</td>
                  <td width="10%">Total General</td>
                  <td width="10%">Mensual General</td>
                  <td width="15%">Aprox. Bs.(Diario)</td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  @foreach ($usuario as $user)
                    <td>{{$user->NOM_USU.' '.$user->APA_USU.' '.$user->AMA_USU}}</td>
                    <td><a target="_blank" href="{{url('reportedmedico/'.$user->id)}}" title="Detalles" class="btn btn-warning" name="button">
                      <span style="font-size: 18px;"><?php
                        $res1=\Darsalud\Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Evaluacion medica')->whereRaw('DATE(updated_at) = CURRENT_DATE')->count();
                        echo $res1;
                      ?></span>
                    </a></td>
                    <td><a target="_blank" href="{{url('reportemmedico/'.$user->id)}}" title="Detalles" class="btn btn-info" name="button">
                      <span style="font-size: 18px;"><?php
                      $res2=\Darsalud\Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Evaluacion medica')->whereRaw('MONTH(updated_at) = MONTH(CURRENT_DATE())')->count();
                      echo $res2;
                      ?></span>
                    </a></td>
                    <td><a target="_blank" href="{{url('reportetmedico/'.$user->id)}}" title="Detalles" class="btn btn-danger" name="button">
                      <span style="font-size: 18px;"><?php
                      $res3=\Darsalud\Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Evaluacion medica')->count();
                      echo $res3;
                      ?></span>
                    </a></td>
                    <td><a target="_blank" href="{{url('reportetgmedico/'.$user->id)}}" title="Detalles" class="btn btn-success" name="button">
                      <span style="font-size: 18px;"><?php
                      $res3=\Darsalud\Ticket::where('ID_MED','=',$user->id)->count();
                      echo $res3;
                      ?></span>
                    </a></td>
                    <td><a target="_blank" href="{{url('reportetgmmedico/'.$user->id)}}" title="Detalles" class="btn btn-primary" name="button">
                      <span style="font-size: 18px;"><?php
                      $res3=\Darsalud\Ticket::where('ID_MED','=',$user->id)->whereRaw('MONTH(updated_at) = MONTH(CURRENT_DATE())')->count();
                      echo $res3;
                      ?></span>
                    </a></td>
                    <td>
                      <?php  echo $res1*50; ?>
                      Bs.</td>
                  </tr>
                  @endforeach
              </tbody>
              </table>
            </fieldset>
        </div>
        <div class="content-2">
          <fieldset>
            <legend>Lista de medicos - Evaluaciones Psicologicas</legend>
            <table id="example2" style="width:60vw" class="table table-hover">
            <thead>
              <tr>
                <td width="50%">Nombre</td>
                <td width="10%">Diario</td>
                <td width="10%">Mensual</td>
                <td width="10%">Total</td>
                <td width="20%">Aprox. Bs.(Diario)</td>
              </tr> 
            </thead>
            <tbody>
              <tr>
                @foreach ($usuario as $user)
                  <td>{{$user->NOM_USU.' '.$user->APA_USU.' '.$user->AMA_USU}}</td>
                  <td><a target="_blank" href="{{url('reportedpsicologia/'.$user->id)}}" type="button" title="Detalles" class="btn btn-warning" name="button">
                    <span style="font-size: 18px;"><?php
                      $res11=\Darsalud\Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Evaluacion psicologica')->whereRaw('DATE(updated_at) = CURRENT_DATE')->count();
                      echo $res11;
                    ?></span>
                  </a></td>
                  <td><a target="_blank" href="{{url('reportempsicologia/'.$user->id)}}" type="button" title="Detalles" class="btn btn-info" name="button">
                    <span style="font-size: 18px;"><?php
                    $res21=\Darsalud\Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Evaluacion psicologica')->whereRaw('MONTH(updated_at) = MONTH(CURRENT_DATE())')->count();
                    echo $res21;
                    ?></span>
                  </a></td>
                  <td><a target="_blank" href="{{url('reportetpsicologia/'.$user->id)}}" type="button" title="Detalles" class="btn btn-danger" name="button">
                    <span style="font-size: 18px;"><?php
                    $res31=\Darsalud\Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Evaluacion psicologica')->count();
                    echo $res31;
                    ?></span>
                  </a></td>
                  <td>
                    <?php  echo $res11*30; ?>
                    Bs.</td>
                </tr>
                @endforeach
            </tbody>
            </table>
          </fieldset>
        </div>
        <div class="content-3">
          <fieldset>
            <legend>Lista de medicos - Evaluaciones oftalmologicas</legend>
            <table id="example3" style="width:60vw" class="table table-hover " >
            <thead>
              <tr>
                <td width="50%">Nombre</td>
                <td width="10%">Diario</td>
                <td width="10%">Mensual</td>
                <td width="10%">Total</td>
                <td width="20%">Aprox. Bs.(Diario)</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                @foreach ($usuario as $user)
                  <td>{{$user->NOM_USU.' '.$user->APA_USU.' '.$user->AMA_USU}}</td>
                  <td><a target="_blank" href="{{url('reportedoftalmo/'.$user->id)}}" type="button" title="Detalles" class="btn btn-warning" name="button">
                    <span style="font-size: 18px;"><?php
                      $res12=\Darsalud\Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Evaluacion oftalmologica')->whereRaw('DATE(updated_at) = CURRENT_DATE')->count();
                      echo $res12;
                    ?></span>
                  </a></td>
                  <td><a target="_blank" href="{{url('reportemoftalmo/'.$user->id)}}" type="button" title="Detalles" class="btn btn-info" name="button">
                    <span style="font-size: 18px;"><?php
                    $res22=\Darsalud\Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Evaluacion oftalmologica')->whereRaw('MONTH(updated_at) = MONTH(CURRENT_DATE())')->count();
                    echo $res22;
                    ?></span>
                  </a></td>
                  <td><a target="_blank" href="{{url('reportetoftalmo/'.$user->id)}}" type="button" title="Detalles" class="btn btn-danger" name="button">
                    <span style="font-size: 18px;"><?php
                    $res32=\Darsalud\Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Evaluacion oftalmologica')->count();
                    echo $res32;
                    ?></span>
                  </a></td>
                  <td>
                    <?php  echo $res12*30; ?>
                    Bs.</td>
                </tr>
                @endforeach
            </tbody>
            </table>
          </fieldset>
        </div>
        <div class="content-4">
          <fieldset>
            <legend>Lista de medicos - Consultas externas</legend>
            <table id="example4" style="width:60vw" class="table table-hover " >
            <thead>
              <tr>
                <td width="50%">Nombre</td>
                <td width="10%">Diario</td>
                <td width="10%">Mensual</td>
                <td width="10%">Total</td>
                <td width="20%">Aprox. Bs.(Diario)</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                @foreach ($usuario as $user)
                  <td>{{$user->NOM_USU.' '.$user->APA_USU.' '.$user->AMA_USU}}</td>
                  <td><a target="_blank" href="{{url('reportedexterna/'.$user->id)}}" type="button" title="Detalles" class="btn btn-warning" name="button">
                    <span style="font-size: 18px;"><?php
                      $res13=\Darsalud\Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Consulta externa')->whereRaw('DATE(updated_at) = CURRENT_DATE')->count();
                      echo $res13;
                    ?></span>
                  </a></td>
                  <td><a target="_blank" href="{{url('reportemexterna/'.$user->id)}}" type="button" title="Detalles" class="btn btn-info" name="button">
                    <span style="font-size: 18px;"><?php
                    $res23=\Darsalud\Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Consulta externa')->whereRaw('MONTH(updated_at) = MONTH(CURRENT_DATE())')->count();
                    echo $res23;
                    ?></span>
                  </a></td>
                  <td><a target="_blank" href="{{url('reportetexterna/'.$user->id)}}" type="button" title="Detalles" class="btn btn-danger" name="button">
                    <span style="font-size: 18px;"><?php
                    $res33=\Darsalud\Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Consulta externa')->count();
                    echo $res33;
                    ?></span>
                  </a></td>
                  <td>
                    <?php  echo $res13*50; ?>
                    Bs.</td>
                </tr>
                @endforeach
            </tbody>
            </table>
          </fieldset>
        </div>
    </div>
</div>
    </div>
</div>
@endsection
