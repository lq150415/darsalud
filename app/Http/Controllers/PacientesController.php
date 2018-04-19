<?php

namespace Darsalud\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Darsalud\Http\Requests;
use Darsalud\Http\Controllers\Controller;
use Darsalud\Paciente;
use Darsalud\Reserva;
use Darsalud\Producto;
use Darsalud\Especialidad;
use Darsalud\User;
use Activity;
use Darsalud\Ticket;
use Darsalud\EvaMedi;
use Darsalud\EvaPsico;
use Darsalud\EvaOto;
use Darsalud\EvaOftalmo;
use Darsalud\Receta;
use Darsalud\Categorialaboratorio;
use Darsalud\Consultaext;
use Darsalud\Antecobs;
use Darsalud\Embarazo;
use Darsalud\Lactancia;
use Darsalud\Factoriesgo;
use Darsalud\Anticoncepcion;
use Darsalud\Antecpedia;
use Darsalud\Antecpat;
use Darsalud\Medcronic;
use Darsalud\Razoncuidado;
use Darsalud\Riesgos;
use Darsalud\Observacionesper;
use Darsalud\Notasevolucion;
use Carbon\Carbon;

class PacientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {      $pacientes = Paciente::OrderBy('updated_at','DESC')->get();
           $actividades = Activity::users(600)->get();
           $especialidades = Especialidad::where('TIP_ESP','=',1)->get();
            $especialidades2 = Especialidad::where('TIP_ESP','=',2)->get();
            $medicos = User::where('NIV_USU','=',2)->get();
           return view('registropacientes')->with('pacientes',$pacientes)->with('actividades',$actividades)->with('especialidades',$especialidades)->with('especialidades2',$especialidades2)->with('medicos',$medicos);
    }
    public function adminpacientes()
    {
      $clientes= Paciente::get();
      return view('administrador/clientes')->with('clientes',$clientes);
    }
    public function informemedico()
    {
      $tickets= Ticket::groupBy('ID_MED','')->get();
      dd($tickets);
      return view('administrador/informemedico')->with('tickets',$tickets);
    }
    public function modificar(Request $request)
    {
      $paciente= Paciente::find($request->input('id_pac'));
      $paciente->NOM_PAC= $request->input('mnom_pac');
      $paciente->APA_PAC= $request->input('mapa_pac');
      $paciente->AMA_PAC= $request->input('mama_pac');
      $paciente->CI_PAC= $request->input('mci_pac').' '.$request->input('mexp_pac');
      $paciente->FEC_PAC= $request->input('mfec_nac');
      $paciente->DOM_PAC= $request->input('mdir_pac');
      $paciente->PRO_PAC= $request->input('mpro_pac');
      $paciente->REF_PAC= $request->input('mtel_pac');
      $paciente->SEX_PAC= $request->input('mgen_pac');
      $paciente->save();
      $mensaje="Datos de paciente modificados";
      return redirect()->route('pacientessegip')->with('mensaje',$mensaje);

    }
    public function admmodificar(Request $request)
    {
      $paciente= Paciente::find($request->input('id_pac'));
      $paciente->NOM_PAC= $request->input('mnom_pac');
      $paciente->APA_PAC= $request->input('mapa_pac');
      $paciente->AMA_PAC= $request->input('mama_pac');
      $paciente->CI_PAC= $request->input('mci_pac').' '.$request->input('mexp_pac');
      $paciente->FEC_PAC= $request->input('mfec_nac');
      $paciente->DOM_PAC= $request->input('mdir_pac');
      $paciente->PRO_PAC= $request->input('mpro_pac');
      $paciente->REF_PAC= $request->input('mtel_pac');
      $paciente->SEX_PAC= $request->input('mgen_pac');
      $paciente->save();
      $mensaje="Datos de cliente modificados";
      return redirect()->route('adminpaciente')->with('mensaje',$mensaje);

    }

    public function consultasmed()
    {
        $actividades = Activity::users(600)->get();
        echo '<thead>
        <tr>
        <th> </th>
        <th>MEDICO</th>
        </tr>
        </thead>
        <tbody>';

         foreach ($actividades as $activity):
            if($activity->user->NIV_USU==2){
          echo '<tr>
          <td><span class="fa fa-stop-circle-o" style="';
          $tickets=Ticket::where('ID_MED','=',$activity->user->id)->where('EST_TIC','<=',1)->get();

          if(count($tickets)==0)
          {
          echo 'color:#1BF510';
          }elseif(count($tickets)==1)
          {
          echo 'color:#FCA720';
          }elseif (count($tickets)>1) {
              echo 'color:#FA0303';
          }
          echo'"></span></td>
          <td>'.$activity->user->NOM_USU.' '.$activity->user->APA_USU.' '.$activity->user->AMA_USU.' - '.count($tickets).' Pacientes</td>';}
           endforeach;
      echo '</tr>
    </tbody>';
    }
     public function consultaspac()
    {
        $ticket= Ticket::where('EST_TIC','=',0)->join('pacientes','pacientes.id','=','ticket.ID_PAC')->join('users','users.id','=','ticket.ID_MED')->select('ticket.id','NOM_PAC','APA_PAC','AMA_PAC','ID_MED','EVA_TIC','NOM_USU','AMA_USU','APA_USU')->get();

        echo '<thead>
        <tr>
        <th>Paciente</th>
        <th>Medico</th>
        <th>Acciones</th>
        </tr>
        </thead>
        <tbody>';
      echo '
    <script type="text/javascript">
    function reasignar(data1,data2,data3,data4)
    {
      $('."'#NOMB_PAC').val(data1);
      $('#IDS_PAC').val(data2);
       $('#ESPE option[value=".'"'."'".'+data3+'."'".'"]'."').prop('selected','selected').change();
       $('#idmedico option[value=".'"'."'".'+data4+'."'".'"]'."').prop('selected','selected').change();


    }
    function elitic(data1){
      $('#idtic').val(data1);
    }
        </script>";
         foreach ($ticket as $tic):
          echo '<tr>
          <td>'.$tic->NOM_PAC.' '.$tic->APA_PAC.' '.$tic->AMA_PAC.'</td>
          <td>'.$tic->NOM_USU.' '.$tic->APA_USU.' '.$tic->AMA_USU.'</td>
          <td>
            <button type="button" data-toggle = "modal" data-target = "#myModal5" onclick="javascript:reasignar('."'".$tic->NOM_PAC.' '.$tic->APA_PAC.' '.$tic->AMA_PAC."',"."'".$tic->id."',"."'".$tic->EVA_TIC."',"."'".$tic->ID_MED."');".'" class="btn btn-success" href=""><span class="fa fa-check"></span></button>
            <button type="button" data-toggle = "modal" data-target = "#myModal6" onclick="javascript:elitic('."'".$tic->id."');".'" class="btn btn-danger" href=""><span class="fa fa-close"></span></button>
          </td>';
           endforeach;
      echo '</tr>
    </tbody>';
    }
    public function eliminarticket(Request $request){
      $id= $request->input('idtic');
      $ticket= Ticket::find($id);
      $ticket->delete();
      $mensaje='Ticket eliminado';
      return redirect()->back()->with('mensaje2',$mensaje);
    }
    public function atencion()
    {
        $tickets= Ticket::join('pacientes','pacientes.id','=','ticket.ID_PAC')->where('ID_MED','=',Auth::user()->id)->where('EST_TIC','<=',1)->orderBy('ticket.created_at','ASC')->select('ticket.id','NOM_PAC','CI_PAC','APA_PAC','AMA_PAC','EST_TIC','EVA_TIC','ID_PAC')->get();

        echo ' <div style=" width:25%; height:auto;float:left; padding: 2%; margin-top: 15%;" class="shadow">
        <div style="border: 3px red solid; margin-left: 41%; margin-top: -32%; width: 18%; color:red; font-weight: bolder;  border-radius:100%; font-size: 24px;">2</div>
        <div style=" margin-top:10%; margin-left: auto; font-size:12px;" class="form-group"><label style="">CI: ';
          if(count($tickets)>1){
            echo $tickets[1]->CI_PAC.'</label><br/>
            <label style="">NOMBRE: '.$tickets[1]->NOM_PAC.'</label>
            <br/>
            <label style="">AP. PATERNO:'.$tickets[1]->APA_PAC.'</label>
            <br/>
            <label style="">AP. MATERNO: '.$tickets[1]->AMA_PAC.'</label>
            <br/>
            <label style="">EVALUACION:'.$tickets[1]->EVA_TIC.'</label>';
            }else{
                   echo '---</label><br/>
            <label style="">NOMBRE: ---</label>
            <br/>
            <label style="">AP. PATERNO:---</label>
            <br/>
            <label style="">AP. MATERNO: ---</label>
            <br/>
            <label style="">EVALUACION:---</label>';
            }
          echo '</div>
          </div>
          <div style="width:25%; height:auto; float:left; padding: 2%;  margin-left:10%; margin-top: 5%;" class="shadow">
              <div style="border: 3px red solid; float: none; margin-left: 41%; margin-top: -32%; width: 18%; color:red; font-weight: bolder;  border-radius:100%; font-size: 24px;">1</div>
              <div style=" margin-top:10%; margin-left: auto; font-size:12px;" class="form-group"><label style="">CI: ';
          if(count($tickets)>0)
            {
             echo   $tickets[0]->CI_PAC.'</label><br/>
        <label style="">NOMBRE:'.$tickets[0]->NOM_PAC.'</label>
        <br/>
        <label style="">AP. PATERNO: '.$tickets[0]->APA_PAC.'</label>
        <br/>
        <label style="">AP. MATERNO: '.$tickets[0]->AMA_PAC.'</label>
        <br/>
        <label style="">EVALUACION: '.$tickets[0]->EVA_TIC.'</label></div>';
        if($tickets[0]->EST_TIC ==1){
            echo '<a  href="';
        if($tickets[0]->EVA_TIC=='Evaluacion medica' ||$tickets[0]->EVA_TIC=='Evaluacion otorrinolaringologica' || $tickets[0]->EVA_TIC=='Evaluacion psicologica' || $tickets[0]->EVA_TIC=='Evaluacion oftalmologica')
        {
            $nombre=  preg_replace('[\s+]','', $tickets[0]->EVA_TIC).'/'.$tickets[0]->id;

            echo $tickets[0]->ID_PAC.'/'.strtolower($nombre);
        }else
        {
            $nombre=  preg_replace('[\s+]','', $tickets[0]->EVA_TIC).'/'.$tickets[0]->id;
            echo $tickets[0]->ID_PAC.'/'.strtolower($nombre);
        }
        echo '" class="btn btn-warning">ATENDIENDO</a></div>';
        }else{
        echo '<a href="';
        if($tickets[0]->EVA_TIC=='Evaluacion medica' ||$tickets[0]->EVA_TIC=='Evaluacion otorrinolaringologica' || $tickets[0]->EVA_TIC=='Evaluacion psicologica' || $tickets[0]->EVA_TIC=='Evaluacion oftalmologica')
        {
            $nombre=  preg_replace('[\s+]','', $tickets[0]->EVA_TIC);

            echo $tickets[0]->ID_PAC.'/'.strtolower($nombre).'/'.$tickets[0]->id;
        }else
        {
          $nombre=  preg_replace('[\s+]','', $tickets[0]->EVA_TIC).'/'.$tickets[0]->id;
          echo $tickets[0]->ID_PAC.'/'.strtolower($nombre);
        }
        echo '" class="btn btn-primary">ATENDER</a><br/>
        <br/>
        <form action="ausente" method="post">
        <input type="hidden" name="idtic" value="'.$tickets[0]->id.'"></input>
        <button class="btn btn-danger">AUSENTE</button>
        </form>
    </div>';}}else{
          echo  '---</label><br/>
        <label style="">NOMBRE:---</label>
        <br/>
        <label style="">AP. PATERNO: ---</label>
        <br/>
        <label style="">AP. MATERNO: ---</label>
        <br/>
        <label style="">EVALUACION:---</label></div></div>';
    }
    echo '<div style=" width:25%; height:auto;float:left; padding: 2%; margin-left:10%; margin-top: 15%;" class="shadow">
        <div style="border: 3px red solid; margin-left: 41%; margin-top: -32%; width: 18%; color:red; font-weight: bolder;  border-radius:100%; font-size: 24px;">3</div>
        <div style=" margin-top:10%; margin-left: auto; font-size:12px;" class="form-group"><label style="">CI: ';
        if( count($tickets)>2)
            {  echo $tickets[2]->CI_PAC.'</label><br/>
        <label style="">NOMBRE: '.$tickets[2]->NOM_PAC.'</label>
        <br/>
        <label style="">AP. PATERNO:'.$tickets[2]->APA_PAC.'</label>
        <br/>
        <label style="">AP. MATERNO:'.$tickets[2]->AMA_PAC.'</label>
        <br/>
        <label style="">EVALUACION:'.$tickets[2]->EVA_TIC.'</label>';
            }else
            {
                echo '---</label><br/>
        <label style="">NOMBRE: ---</label>
        <br/>
        <label style="">AP. PATERNO:---</label>
        <br/>
        <label style="">AP. MATERNO:---</label>
        <br/>
        <label style="">EVALUACION:---</label>';
            }
        echo '</div>
    </div>';
        }

    public function historial($id)
    {
        $pacientes= Paciente::find($id);
        $evamedi=Evamedi::where('ID_PAC','=',$id)->join('users','ID_USU','=','users.id')->select('FEC_MED','evaluacionmedica.id','NOM_USU','APA_USU','AMA_USU')->get();
        $evapsi=EvaPsico::where('ID_PAC','=',$id)->join('users','ID_MED','=','users.id')->select('FEC_PSI','evaluacionpsicologica.id','NOM_USU','APA_USU','AMA_USU')->get();
        $evaoto=EvaOto::where('ID_PAC','=',$id)->join('users','ID_MED','=','users.id')->select('FEC_OTO','evaluacionotorrino.id','NOM_USU','APA_USU','AMA_USU')->get();
        $evaoft=EvaOftalmo::where('ID_PAC','=',$id)->join('users','ID_MED','=','users.id')->select('FEC_OFT','evaluacionoftalmo.id','NOM_USU','APA_USU','AMA_USU')->get();
        $recetas=Receta::where('ID_PAC','=',$id)->join('users','ID_MED','=','users.id')->select('FEC_REC','recetas.id','NOM_USU','APA_USU','AMA_USU')->get();
        return view('historialpaciente2')->with('pacientes',$pacientes)->with('id',$id)->with('evamedi',$evamedi)->with('evapsi',$evapsi)->with('evaoto',$evaoto)->with('evaoft',$evaoft)->with('recetas',$recetas);
    }
    public function ausente(Request $request)
    {
        $id=$request->input('idtic');
        $ticket= Ticket::find($id);
        $ticket->EST_TIC=3;
        $ticket->save();
        $mensaje='El paciente fue marcado como ausente';
         return redirect()->route('/')->with('mensaje2',$mensaje);
    }
    public function ticket(Request $request)
    {
        $ticket= new Ticket;
        $ticket->EST_TIC=0;
        $ticket->ID_PAC= $request->input('id');
        $ticket->ID_MED= $request->input('id_med');
        $ticket->EVA_TIC=$request->input('eva_tic');
        $ticket->IMP_TIC=0;
        $ticket->save();
        $mensaje='Medico asignado a paciente';
        return redirect()->route('pacientessegip')->with('mensaje',$mensaje);
    }
    public function ticket2(Request $request)
    {
        $ticket= new Ticket;
        $ticket->EST_TIC=0;
        $ticket->ID_PAC= $request->input('id');
        $ticket->ID_MED= $request->input('id_med');
        $ticket->EVA_TIC=$request->input('eva_tic');
        $ticket->IMP_TIC=0;
        $ticket->save();
        $mensaje='Medico asignado a paciente';
        return redirect()->route('pacientesdarsalud')->with('mensaje',$mensaje);
    }
    public function mticket(Request $request)
    {
        $id= $request->input('id');
        $ticket= Ticket::find($id);
        $ticket->EST_TIC=0;
        $ticket->ID_MED= $request->input('id_med');
        $ticket->EVA_TIC=$request->input('eva_tic');
        $ticket->IMP_TIC=0;
        $ticket->save();
        $mensaje='Reasignacion realizada correctamente';
        return redirect()->route('pacientessegip')->with('mensaje',$mensaje);
    }
    public function mticket2(Request $request)
    {
        $id= $request->input('id');
        $ticket= Ticket::find($id);
        $ticket->EST_TIC=0;
        $ticket->ID_MED= $request->input('id_med');
        $ticket->EVA_TIC=$request->input('eva_tic');
        $ticket->IMP_TIC=0;
        $ticket->save();
        $mensaje='Reasignacion realizada correctamente';
        return redirect()->route('pacientesdarsalud')->with('mensaje',$mensaje);
    }
    public function reservaticket(Request $request)
    {
        $ticket= new Ticket;
        $ticket->EST_TIC=5;
        $ticket->ID_PAC= $request->input('idr');
        $ticket->ID_MED= $request->input('id_medr');
        $ticket->EVA_TIC=$request->input('eva_tic');
        $ticket->IMP_TIC=0;
        $ticket->save();
        $reserva= new Reserva;
        $reserva->FEC_RES=$request->input('fec_res');
        $reserva->HOR_RES=$request->input('hor_res');
        $reserva->ID_TIC=$ticket->id;
        $reserva->save();
        $mensaje='Reserva realizada correctamente';
        return redirect()->route('pacientessegip')->with('mensaje',$mensaje);
    }
    public function producto(Request $request)
    {
        $productos= new Producto;
        $productos->COD_PRO=$request->input('cod_pro');
        $productos->NOM_PRO= $request->input('nom_pro');
        $productos->DES_PRO= $request->input('des_pro');
        $productos->PRE_PRO= $request->input('pre_pro');
        $productos->CAN_PRO= $request->input('can_pro');
        $productos->FEC_PRO= $request->input('fec_pro');
        $productos->ID_USU= Auth::user()->id;
        $productos->save();
        $mensaje='Producto registrado correctamente';
        return redirect()->route('farmacia')->with('mensaje',$mensaje);
    }

    public function modificarproducto(Request $request)
    {
        $id=$request->input('id_pro3');
        $productos= Producto::find($id);
        $productos->COD_PRO=$request->input('cod_pro3');
        $productos->NOM_PRO= $request->input('nom_pro3');
        $productos->DES_PRO= $request->input('des_pro3');
        $productos->PRE_PRO= $request->input('pre_pro3');
        $productos->CAN_PRO= $request->input('can_pro3');
        $productos->FEC_PRO= $request->input('fec_pro3');
        $productos->ID_USU= Auth::user()->id;
        $productos->save();
        $mensaje='Producto modificado correctamente';
        return redirect()->route('farmacia')->with('mensaje',$mensaje);
    }

    public function entradaproducto(Request $request)
    {
      if($request->input('tip_ent')==0){
        $id=$request->input('id_pro4');
        $productos= Producto::find($id);
        $productos->CAN_PRO= $productos->CAN_PRO + $request->input('can_pro4');
        $productos->save();
        $mensaje='Entrada registrada correctamente';
        return redirect()->route('farmacia')->with('mensaje',$mensaje);
      }
      if($request->input('tip_ent')==1){
        $id=$request->input('id_pro4');
        $productos= Producto::find($id);
        $producto= new Producto;
        $producto->COD_PRO=$productos->COD_PRO;
        $producto->NOM_PRO= $productos->NOM_PRO;
        $producto->DES_PRO= $productos->DES_PRO;
        $producto->PRE_PRO= $request->input('pre_pro4');
        $producto->CAN_PRO= $request->input('can_pro4');
        $producto->FEC_PRO= $productos->FEC_PRO;
        $producto->ID_USU= Auth::user()->id;
        $producto->save();
        $mensaje='Producto modificado correctamente';
        return redirect()->route('farmacia')->with('mensaje',$mensaje);
    }
    if($request->input('tip_ent')==2){
      $id=$request->input('id_pro4');
      $productos= Producto::find($id);
      $producto= new Producto;
      $producto->COD_PRO=$productos->COD_PRO;
      $producto->NOM_PRO= $productos->NOM_PRO;
      $producto->DES_PRO= $productos->DES_PRO;
      $producto->PRE_PRO= $productos->PRE_PRO;
      $producto->CAN_PRO= $request->input('can_pro4');
      $producto->FEC_PRO= $request->input('fec_pro4');
      $producto->ID_USU= Auth::user()->id;
      $producto->save();
      $mensaje='Producto modificado correctamente';
      return redirect()->route('farmacia')->with('mensaje',$mensaje);
    }
    if($request->input('tip_ent')==3){
      $id=$request->input('id_pro4');
      $productos= Producto::find($id);
      $producto= new Producto;
      $producto->COD_PRO=$productos->COD_PRO;
      $producto->NOM_PRO= $productos->NOM_PRO;
      $producto->DES_PRO= $productos->DES_PRO;
      $producto->PRE_PRO= $request->input('pre_pro4');
      $producto->CAN_PRO= $request->input('can_pro4');
      $producto->FEC_PRO= $request->input('fec_pro4');
      $producto->ID_USU= Auth::user()->id;
      $producto->save();
      $mensaje='Producto modificado correctamente';
      return redirect()->route('farmacia')->with('mensaje',$mensaje);
    }
  }
  public function salidaproducto(Request $request)
  {
      $id=$request->input('id_pro5');
      $productos= Producto::find($id);
      $productos->CAN_PRO= $productos->CAN_PRO - $request->input('can_pro5');
      $productos->save();
      $mensaje='Salida registrada correctamente';
      return redirect()->route('farmacia')->with('mensaje2',$mensaje);
    }

    public function reservar(Request $request)
    {
        $ticket= new Ticket;
        $ticket->EST_TIC=5;
        $ticket->ID_PAC= $request->input('id');
        $ticket->ID_MED= $request->input('id_med');
        $ticket->EVA_TIC=$request->input('eva_tic');
        $ticket->IMP_TIC=0;
        $ticket->save();
        $mensaje='Reserva satisfactoria';
        return redirect()->route('pacientessegip')->with('mensaje',$mensaje);
    }
    public function psicologica($id, $ids)
    {   $paciente= Paciente::find($id);
        $tickets= Ticket::find($ids);
        $iddatos= EvaPsico::where('ID_TIC','=',$ids)->select('id')->first();

        if($iddatos){
        $idmed = $iddatos->id;
        $datos= EvaPsico::find($idmed);

        $tickets->EST_TIC=1;
        $tickets->save();
        return view('evapsico')->with('paciente',$paciente)->with('id',$id)->with('ids',$ids)->with('datos',$datos);
        }else{
          $tickets->EST_TIC=1;
          $tickets->save();
          return view('evapsico')->with('paciente',$paciente)->with('id',$id)->with('ids',$ids);

        }
    }
    public function externa($id, $ids)
    {   $paciente= Paciente::find($id);
        $tickets= Ticket::find($ids);
        $notas= Notasevolucion::where('ID_PAC','=',$id)->join('users','ID_MED','=','users.id')->get();
        $hisold= Consultaext::where('ID_PAC','=',$id)->orderby('id','DESC')->first();
        if(count($hisold)==0):
          $tickets->EST_TIC=1;
          $tickets->save();
          return view('consultaext')
            ->with('paciente',$paciente)
            ->with('notas',$notas)
            ->with('id',$id)
            ->with('ids',$ids);
        else:
        $hisold= Consultaext::find($hisold->id);
        //dd($hisold->id);
        $razold= Razoncuidado::where('ID_COE','=',$hisold->id)->get();
        $apeold= Antecpedia::where('ID_COE','=',$hisold->id)->get();
        $obsold= Observacionesper::where('ID_ANP','=',$apeold[0]->id)->get();
        $cobold= Antecobs::where('ID_COE','=',$hisold->id)->get();
        $embold= Embarazo::where('ID_ACO','=',$cobold[0]->id)->get();
        $antold= Anticoncepcion::where('ID_COE','=',$hisold->id)->get();
        $lacold= Lactancia::where('ID_COE','=',$hisold->id)->get();
        $facold= Factoriesgo::where('ID_COE','=',$hisold->id)->get();
        $rieold= Riesgos::where('ID_COE','=',$hisold->id)->get();
        $patold= Antecpat::where('ID_COE','=',$hisold->id)->get();
        $antecobs= Antecobs::where('ID_COE','=',$hisold->id)->get();
        $medold= Medcronic::where('ID_COE','=',$hisold->id)->get();
          $tickets->EST_TIC=1;
          $tickets->save();
          return view('consultaext')
            ->with('paciente',$paciente)
            ->with('notas',$notas)
            ->with('hisold',$hisold)
            ->with('razold',$razold)
            ->with('apeold',$apeold)
            ->with('obsold',$obsold)
            ->with('cobold',$cobold)
            ->with('embold',$embold)
            ->with('antold',$antold)
            ->with('lacold',$lacold)
            ->with('facold',$facold)
            ->with('rieold',$rieold)
            ->with('patold',$patold)
            ->with('antecobs',$antecobs)
            ->with('medold',$medold)
            ->with('id',$id)
            ->with('ids',$ids);
          endif;
    }


    public function medica($id, $ids)
    {   $paciente= Paciente::find($id);
        $tickets= Ticket::find($ids);
        $iddatos= EvaMedi::where('ID_TIC','=',$ids)->select('id')->first();
        //dd($iddatos);
        if($iddatos){
        $idmed = $iddatos->id;
        }else{
            $idmed=1929203734729;
        }
        $datos= EvaMedi::find($idmed);
        //dd($datos);
        $tickets->EST_TIC=1;
        $tickets->save();
        return view('evamedica')->with('paciente',$paciente)->with('id',$id)->with('ids',$ids)->with('datos',$datos);
    }
    public function modificardatos(){
      $id=$_POST['id'];
      $pac= Paciente::find($id);
      $pac->NOM_PAC=$_POST['nom'];
      $pac->APA_PAC=$_POST['apa'];
      $pac->AMA_PAC=$_POST['ama'];
      $pac->CI_PAC=$_POST['ci'];
      $pac->SEX_PAC=$_POST['sex'];
      $pac->FEC_PAC=$_POST['fec'];
      $pac->save();
    }
    public function oftalmo($id, $ids)
    {   $paciente= Paciente::find($id);
        $tickets= Ticket::find($ids);
        $tickets->EST_TIC=1;
        $tickets->save();
        return view('evaoftalmo')->with('paciente',$paciente)->with('id',$id)->with('ids',$ids);
    }
    public function recetas($id)
    {   $paciente= Paciente::find($id);
        return view('recetas')->with('paciente',$paciente)->with('id',$id);
    }
    public function laboratorios($id)
    {   $paciente= Paciente::find($id);
        $categorias = Categorialaboratorio::get();
        return view('laboratorios')->with('paciente',$paciente)->with('id',$id)->with('categorias',$categorias);
    }

     public function otorrino($id, $ids)
    {   $paciente= Paciente::find($id);
        $tickets= Ticket::find($ids);
        $tickets->EST_TIC=1;
        $tickets->save();
        return view('evaotorrino')->with('paciente',$paciente)->with('id',$id)->with('ids',$ids);
    }

    public function finalizar($id,$ids)
    {
        $tickets= Ticket::find($ids);
        $tickets->EST_TIC=2;
        $tickets->save();
        $mensaje='Consulta finalizada';
         return redirect()->route('/')->with('mensaje2',$mensaje);
    }
    public function externafin($id,$ids)
    {
        $tickets= Ticket::find($ids);
        $tickets->EST_TIC=2;
        $tickets->save();
        $mensaje='Consulta finalizada';
         return redirect()->route('/')->with('mensaje2',$mensaje);
    }
    public function medicosact()
    {   $actividades = Activity::users(600)->get();
        $html= '<select class="form-control" id="ID_MED" name="id_med" required>
      <option value="">SELECCIONE</option>';
      $html2='';
        foreach($actividades as $actividad):
        if($actividad->user->NIV_USU==2):
        $html2 =$html2.'<option value="'.$actividad->user->id.'">'.$actividad->user->NOM_USU.' '.$actividad->user->APA_USU.' '.$actividad->user->AMA_USU.'</option>';
        endif;
        endforeach;
        $html3='</select>';
        echo $html.$html2.$html3;
    }
    public function medicosact2()
    {   $actividades = Activity::users(600)->get();
        $html= '<select class="form-control" id="idmedico" name="id_med" required>
      <option value="">SELECCIONE</option>';
      $html2='';
        foreach($actividades as $actividad):
        if($actividad->user->NIV_USU==2):
        $html2 =$html2.'<option value="'.$actividad->user->id.'">'.$actividad->user->NOM_USU.' '.$actividad->user->APA_USU.' '.$actividad->user->AMA_USU.'</option>';
        endif;
        endforeach;
        $html3='</select>';
        echo $html.$html2.$html3;
    }
    public function datospac2()
    { $id= $_POST['id'];
      $paciente=Paciente::find($id);
      $html= '<div class="form-group">
          <label class="col-lg-2">Apellido paterno: </label>
          <div class="col-lg-3">
              <input type="text" class="form-control" name="" readonly="readonly" value=" '.$paciente->APA_PAC.'">
          </div>
          <label class="col-lg-2">Apellido materno: </label>
          <div class="col-lg-3">
              <input type="text" class="form-control" readonly="readonly" name="" value="'.$paciente->AMA_PAC.'">
          </div>

      </div>
      <div class="form-group">
          <label class="col-lg-2">Nombres: </label>
          <div class="col-lg-3">
              <input type="text" readonly="readonly" class="form-control" name="" value=" '.$paciente->NOM_PAC.'">
          </div>
          <label class="col-lg-2">CI: </label>
          <div class="col-lg-3">
              <input type="text" class="form-control" readonly="readonly" name="" value=" '.$paciente->CI_PAC.'">
          </div>
      </div>
      <div class="form-group">

          <label class="col-lg-2">Fecha de nacimiento: </label>
          <div class="col-lg-3">
              <input type="text" readonly="readonly" class="form-control" name="" value=" '.$paciente->FEC_PAC.'">
          </div>                                   <label class="col-lg-2">Edad: </label>
          <div class="col-lg-3">
              <input type="text" readonly="readonly" class="form-control" name="" value="';
      $edad = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente->FEC_PAC)->format('Y');
      $edad2 = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente->FEC_PAC)->format('m');
      $edad3 = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente->FEC_PAC)->format('d');

      $date = \Carbon\Carbon::createFromDate($edad,$edad2,$edad3)->age;
       $html=$html.$date.'">
                    </div>
                </div>              <div class="form-group">
                                  <label class="col-lg-2">Profesion : </label>
                                  <div class="col-lg-3">
                                      <input type="text" class="form-control" name="" readonly="readonly" value=" '.$paciente->PRO_PAC.'">
                                  </div>
                                  <label class="col-lg-2">Fecha del examen : </label>
                                  <div class="col-lg-3">
                                      <input type="text" class="form-control" readonly="readonly" name="" value="'. \Carbon\Carbon::now()->format('d-m-Y').'">
                                  </div>

                              </div>
                              <div class="form-group">
                                  <label class="col-lg-2">Direccion : </label>
                                  <div class="col-lg-9">
                                      <input type="text" class="form-control" name="" readonly="readonly" value=" '.$paciente->DOM_PAC.'">
                                  </div>
                              </div>';
        echo $html;
    }

    public function datospac()
    { $id= $_POST['id'];
      $paciente=Paciente::find($id);
      $html= '<div class="form-group">
                    <label class="col-lg-3">Apellido paterno: </label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" name="" readonly="readonly" value="'.$paciente->APA_PAC.'">
                    </div>
                    <label class="col-lg-3">Apellido materno: </label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" readonly="readonly" name="" value="'.$paciente->AMA_PAC.'">
                    </div>

                </div>
                <div class="form-group">
                    <label class="col-lg-3">Nombres: </label>
                    <div class="col-lg-3">
                        <input type="text" readonly="readonly" class="form-control" name="" value="'.$paciente->NOM_PAC.'">
                    </div>
                    <label class="col-lg-3">CI: </label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" readonly="readonly" name="" value="'.$paciente->CI_PAC.'">
                    </div>
                </div>
                <div class="form-group">

                    <label class="col-lg-3">Sexo: </label>
                    <div class="col-lg-3">
                        <input type="text" readonly="readonly" class="form-control" name="" value="'.$paciente->SEX_PAC.'">
                    </div>                                   <label class="col-lg-3">Edad: </label>
                    <div class="col-lg-3">
                        <input type="text" readonly="readonly" class="form-control" name="" value="';
      $edad = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente->FEC_PAC)->format('Y');
      $edad2 = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente->FEC_PAC)->format('m');
      $edad3 = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente->FEC_PAC)->format('d');

      $date = \Carbon\Carbon::createFromDate($edad,$edad2,$edad3)->age;
       $html=$html.$date.'">
                    </div>
                </div>';
        echo $html;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
     {
         $pacientes = new Paciente;
         $pacientes->NOM_PAC= $request->input('nom_pac');
         $pacientes->APA_PAC= $request->input('apa_pac');
         $pacientes->AMA_PAC= $request->input('ama_pac');
         $pacientes->CI_PAC= $request->input('ci_pac').' '.$request->input('exp_pac');
         $pacientes->SEX_PAC= $request->input('gen_pac');
         $pacientes->FEC_PAC= $request->input('fec_nac');
         $pacientes->REF_PAC= $request->input('tel_pac');
         $pacientes->PRO_PAC= $request->input('pro_pac');
         $pacientes->DOM_PAC= $request->input('dir_pac');
         $pacientes->ID_USU= Auth::user()->id;
         $pacientes->save();
         $mensaje='Usuario registrado correctamente';
          return redirect()->route('pacientessegip')->with('mensaje',$mensaje);
     }
     public function admregistrarpacientes(Request $request)
     {
         $pacientes = new Paciente;
         $pacientes->NOM_PAC= $request->input('nom_pac');
         $pacientes->APA_PAC= $request->input('apa_pac');
         $pacientes->AMA_PAC= $request->input('ama_pac');
         $pacientes->CI_PAC= $request->input('ci_pac').' '.$request->input('exp_pac');
         $pacientes->SEX_PAC= $request->input('gen_pac');
         $pacientes->FEC_PAC= $request->input('fec_nac');
         $pacientes->REF_PAC= $request->input('tel_pac');
         $pacientes->PRO_PAC= $request->input('pro_pac');
         $pacientes->DOM_PAC= $request->input('dir_pac');
         $pacientes->ID_USU= Auth::user()->id;
         $pacientes->save();
         $mensaje='Cliente registrado correctamente';
          return redirect()->route('adminpaciente')->with('mensaje',$mensaje);
     }

    public function listapacientes()
    {
        $pacientes=Paciente::get();
        return view('paciente')->with('pacientes',$pacientes);
    }
    public function listapendientes()
    {
         $pendientes=Ticket::where('EST_TIC','>=',3)->where('EST_TIC','<',5)->join('pacientes','ID_PAC','=','pacientes.id')->join('users','ID_MED','=','users.id')->select('NOM_PAC','APA_PAC','AMA_PAC','ticket.id','EST_TIC','EVA_TIC','CI_PAC','ID_PAC','NOM_USU','APA_USU','AMA_USU','ARE_USU')->get();
        return view('pendientes')->with('pendientes',$pendientes);
    }

    public function guardarnota($id, $ids){
      $fecnev=$_POST['fecnev'];
      $nnnnev=$_POST['nnnnev'];
      $rrrnev=$_POST['rrrnev'];
      $eacnev=$_POST['eacnev'];
      $pesnev=$_POST['pesnev'];
      $talnev=$_POST['talnev'];
      $panev=$_POST['panev'];
      $fcnev=$_POST['fcnev'];
      $temnev=$_POST['temnev'];
      $fumnev=$_POST['fumnev'];
      $subnev=$_POST['subnev'];
      $objnev=$_POST['objnev'];
      $ananev=$_POST['ananev'];
      $planev=$_POST['planev'];
      $idtic=$_POST['var1'];
      $idpac=$_POST['var2'];
      $idmed=$_POST['idmed'];
      if(($_POST['nnnnev'] =='' || $_POST['rrrnev']=='' || $_POST['pesnev']='' || $_POST['talnev']=='' || $_POST['panev']=='' || $_POST['fcnev']=='' || $_POST['fumnev']=='' || $_POST['temnev']=='' || $_POST['subnev']=='' || $_POST['objnev']=='' || $_POST['ananev']=='' || $_POST['planev']=='' )){
        $response = array(
                'msg2' => 'A ocurrido un error, complete todos los campos.',
                'conf'=>0,
              );
            return \Response::json($response);
      }else{
      $nota= Notasevolucion::where('ID_TIC','=',$idtic)->first();
      if(count($nota)==0):
      $externa= new Notasevolucion;
      else:
      $externa= Notasevolucion::find($nota->id);
      endif;
      $externa->FEC_NEV= Carbon::now();
      $externa->NNN_NEV= $nnnnev;
      $externa->RRR_NEV= $rrrnev;
      $externa->EAC_NEV= $eacnev;
      $externa->PES_NEV= $pesnev;
      $externa->TAL_NEV= $talnev;
      $externa->PA_NEV= $panev;
      $externa->FC_NEV= $fcnev;
      $externa->TEM_NEV= $temnev;
      $externa->FUM_NEV= $fumnev;
      $externa->SUB_NEV= $subnev;
      $externa->OBJ_NEV= $objnev;
      $externa->ANA_NEV= $ananev;
      $externa->PLA_NEV= $planev;
      $externa->ID_TIC= $idtic;
      $externa->ID_PAC= $idpac;
      $externa->ID_MED= $idmed;
      $externa->save();
      $response = array(
              'msg' => 'Nota de evolucion guardada correctamente',
              'conf'=>1,
            );
          return \Response::json($response);
      }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
