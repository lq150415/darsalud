@extends('../admin')
@section('contenido')
  {!! Html::script('js/pestanna.js')!!}
  {!! Html::style('css/pestanna.css')!!}
  {!! Html::style('css/card.css')!!}

    <div class="" >
      <div class="panel" style="padding:20px 30px 30px 30px; ">

        <div class="row">
          <div class="col-md-4">
            <div class="card">
                <div class="card-image">
                    <img class="img-responsive" src="{{url('img/back1.png')}}">
                    <span class="card-title"><p align="center">
                      <?php
                      $res2=\Darsalud\Ticket::where('EVA_TIC','=','Evaluacion medica')->join('users','ticket.ID_MED','=','users.id')->whereRaw('DATE(ticket.updated_at) = CURRENT_DATE')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','NOM_USU','APA_USU','AMA_USU','ticket.updated_at')->count();
                      $res3=\Darsalud\Ticket::where('EVA_TIC','=','Evaluacion psicologica')->join('users','ticket.ID_MED','=','users.id')->whereRaw('DATE(ticket.updated_at) = CURRENT_DATE')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','NOM_USU','APA_USU','AMA_USU','ticket.updated_at')->count();
                      $res4=\Darsalud\Ticket::where('EVA_TIC','=','Evaluacion oftalmologica')->join('users','ticket.ID_MED','=','users.id')->whereRaw('DATE(ticket.updated_at) = CURRENT_DATE')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','NOM_USU','APA_USU','AMA_USU','ticket.updated_at')->count();
                      $res5=\Darsalud\Ticket::where('EVA_TIC','=','Consulta externa')->join('users','ticket.ID_MED','=','users.id')->whereRaw('DATE(ticket.updated_at) = CURRENT_DATE')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','NOM_USU','APA_USU','AMA_USU','ticket.updated_at')->count();
                      $total= \Darsalud\Ticket::whereRaw('DATE(ticket.updated_at) = CURRENT_DATE')->count();
                      $totalsegip= \Darsalud\Ticket::whereRaw('DATE(ticket.updated_at) = CURRENT_DATE')->where('EVA_TIC','!=','Consulta externa')->count();
                      $totalexterna= \Darsalud\Ticket::whereRaw('DATE(ticket.updated_at) = CURRENT_DATE')->where('EVA_TIC','=','Consulta externa')->count();
                      echo $total;
                      ?>

                    </p></span>
                </div>

                <div class="card-content">
                    <p style="font-size:18px;" align="center">Evaluaciones realizadas hoy.</p>
                </div>

          </div>
        </div>
          <div class="col-md-4" >
            <div class="card">
                <div class="card-image">
                    <img class="img-responsive" src="{{url('img/back2.png')}}">
                    <span class="card-title">
                      <?php
                      echo $totalsegip;
                      ?>
                    </span>
                </div>

                <div class="card-content">
                    <p style="font-size:18px;" align="center">Evaluaciones realizadas (SEGIP).</p>
                </div>

              </div>
          </div>
          <div class="col-md-4 ">
            <a href="{{url('reportetgeva')}}" target="_blank" class="botonhover"><div class="card">
                <div class="card-image">
                    <img class="img-responsive" src="{{url('img/back3.png')}}">
                    <span class="card-title"></span>
                </div>
                <div class="card-content">
                    <p style="font-size:18px;" align="center">Generar reporte diario.</p>
                </div>
          </div></a>
        </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="card">
                <div class="card-image">
                    <img class="img-responsive" src="{{url('img/back4.png')}}">
                    <span class="card-title">$.
                      <?php
                        echo $res2*50+$res3*30+$res4*30+$res5*50;
                      ?>
                    </span>
                </div>

                <div class="card-content">
                    <p style="font-size:18px" align="center">Ingreso diario aproximado en Bs.</p>
                </div>

          </div>
        </div>
          <div class="col-md-4" >
            <div class="card">
                <div class="card-image">
                    <img class="img-responsive" src="{{url('img/back5.png')}}">
                    <span class="card-title">
                      <?php
                        echo $totalexterna;
                      ?>
                    </span>
                </div>

                <div class="card-content">
                    <p style="font-size:18px" align="center">Consultas externas realizadas</p>
                </div>

              </div>
          </div>
          <div class="col-md-4 ">
            <a href="#" data-toggle="modal" data-target="#myModal" class="botonhover"><div class="card">
                <div class="card-image">
                    <img class="img-responsive" src="{{url('img/back6.png')}}">
                    <span class="card-title"></span>
                </div>
                <div class="card-content">
                    <p style="font-size:18px;" align="center">Reportes personalizados.</p>
                </div>
          </div></a>
        </div>
        </div>
    </div>
  </div>

  <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Reportes personalizados</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" target="_blank" action="{{url('reportepersonalizado')}}" method="post">
              <div class="form-group" style="padding-left:20px;">
                <label for="" class="col-md-3" >Elija una fecha</label>
                <div class="col-md-8">
                  <select class="form-control" onChange="mostrar(this.value)" name="opcion" required>
                    <option value="">SELECCIONE</option>
                    <option value="1">Ayer</option>
                    <option value="2">Hoy</option>
                    <option value="3">Mensual</option>
                    <option value="4">Fecha especifica</option>
                    <option value="5">Rango de fechas</option>
                  </select>
                </div>
              </div>
              <div class="form-group" style="padding-left:20px;">
                <label for="" class="col-md-3">Elija una opcion</label>
                <div class="col-md-8">
                  <select class="form-control" name="tabla" onChange="mostrar2(this.value)" required>
                    <option value="">SELECCIONE</option>
                    <option value="1">Todas</option>
                    <option value="2">Solo segip</option>
                    <option value="3">Solo consultas externas</option>
                    <option value="4">Por medicos total</option>
                    <option value="5">Por medicos solo segip</option>
                    <option value="6">Por medicos solo consultas externas</option>
                  </select>
                </div>
              </div>
              <div id="div1" style="display:none;">
                <div class="form-group" style="padding-left:30px;">
                  <label for="" class="col-md-3">Elija fecha</label>
                  <div class="col-md-8">
                    <input type="date" id="fija" name="fija" class="form-control" disable required>
                  </div>
                </div>

              </div>
              <div id="div3" style="display:none;">
                <div class="form-group" style="padding-left:30px;">
                  <label for="" class="col-md-3">Medico: </label>
                  <div class="col-md-8">
                      <select class="form-control"  name="id" id="medico">
                        <?php
                        $medicos= \Darsalud\User::where('NIV_USU','=',2)->get();
                        ?>
                        <option value="">SELECCIONAR</option>
                        @foreach ($medicos as $med)
                          <option value="{{$med->id}}">{{$med->NOM_USU.' '.$med->APA_USU.' '.$med->AMA_USU.' '}}</option>
                        @endforeach
                      </select>
                  </div>
                </div>

              </div>
              <div id="div2" style="display:none;">
                <div class="form-group" style="padding-left:30px;">
                  <label for="" class="col-md-1">Inicio</label>
                  <div class="col-md-5">
                    <input type="date" name="inicio" id="inicio" class="form-control" disable required>
                  </div>
                  <label for="" class="col-md-1">Fin</label>
                  <div class="col-md-5">
                    <input type="date" name="fin" id="fin" class="form-control" disable required>
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-close"></span> Cerrar</button>
            <button type="submit" class="btn btn-primary"> <span class="fa fa-cogs"></span> Generar</button>
          </div>
        </form>
        </div>

      </div>
    </div>
    <script type="text/javascript">
        var div1 = document.getElementById("div1");
        var div2 = document.getElementById("div2");
        var fija = document.getElementById("fija");
        var inicio = document.getElementById("inicio");
        var fin = document.getElementById("fin");
        var med = document.getElementById("medico");
        function mostrar(valor) {
        switch(valor)
        {
        case '1':
         div1.style.display = "none";
         div2.style.display = "none";
         fija.required= false;
         inicio.required= false;
         fin.required= false;
         console.log(div1);
         break;
        case '2':
         div1.style.display = "none";
         div2.style.display = "none";
         fija.required= false;
         inicio.required= false;
         fin.required= false;
         break;
        case '3':
         div1.style.display = "none";
         div2.style.display = "none";
         fija.required= false;
         inicio.required= false;
         fin.required= false;
         break;
        case '4':
         div1.style.display = "block";
         div2.style.display = "none";
         fija.required= true;
         inicio.required= false;
         fin.required= false;
         break;
        case '5':
         div1.style.display = "none";
         div2.style.display = "block";
         fija.required= false;
         inicio.required= true;
         fin.required= true;
         break;
        }
        }
        function mostrar2(valor) {
        switch(valor)
        {
        case '1':
         div3.style.display = "none";
         med.required= false;
         break;
        case '2':
         div3.style.display = "none";
         med.required= false;
         break;
        case '3':
         div3.style.display = "none";
         med.required= false;
         break;
        case '4':
         div3.style.display = "block";
         med.required= true;
         break;
        case '5':
          div3.style.display = "block";
          med.required= true;
         break;
        case '6':
          div3.style.display = "block";
          med.required= true;
         break;
       }

        }
    </script>
@endsection
