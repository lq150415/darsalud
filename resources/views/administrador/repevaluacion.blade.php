@extends('../admin')
@section('contenido')
  {!! Html::script('js/pestanna.js')!!}
  {!! Html::style('css/pestanna.css')!!}
  {!! Html::style('css/card.css')!!}
    <div class="" >
      <div class="panel" style="padding:20px 30px 30px 30px; ">
        <fieldset>
          <legend>Evaluaciones - Reportes Darsalud</legend>
          <table id="example" class="table table-hover">
            <thead>
              <tr>
                <td>Evaluacion</td>
                <td>Diario</td>
                <td>Mensual</td>
                <td>General</td>
              </tr>
            </thead>
            <tbody>
              @foreach ($especialidad as $esp)
              <tr>
                <td>{{$esp->NOM_ESP}}</td>
                <td><a href="{{url('reportedeva/'.$esp->id)}}" target="_blank" class="btn btn-danger" >
                <?php
                $diario=\Darsalud\Ticket::where('EVA_TIC','=',$esp->NOM_ESP)->whereRaw('DATE(ticket.updated_at) = CURRENT_DATE')->join('users','ticket.ID_MED','=','users.id')->count();
                echo $diario;
                ?></a></td>
                <td><a href="{{url('reportemeva/'.$esp->id)}}" target="_blank" class="btn btn-info" >
                <?php
                $diario=\Darsalud\Ticket::where('EVA_TIC','=',$esp->NOM_ESP)->whereRaw('MONTH(ticket.updated_at) = MONTH(CURRENT_DATE())')->count();
                echo $diario;
                ?></a></td>
                <td><a href="{{url('reporteteva/'.$esp->id)}}" target="_blank" class="btn btn-primary" >
                <?php
                $diario=\Darsalud\Ticket::where('EVA_TIC','=',$esp->NOM_ESP)->count();
                echo $diario;
                ?></a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </fieldset>
      </div>
    </div>
@endsection
