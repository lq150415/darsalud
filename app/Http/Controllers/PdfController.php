<?php

namespace Darsalud\Http\Controllers;

use Illuminate\Http\Request;

use Darsalud\Http\Requests;
use Darsalud\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use TCPDF;
use PDF;
use DB;
use Darsalud\Paciente;
use Darsalud\User;
use Darsalud\Especialidad;
use Darsalud\TIcket;
use Carbon\Carbon;

class PdfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    public function pdflaboratorios(Request $request,$id)
    {
    //  $receta=new Receta;
    //  $receta->DES_REC=$request->input('rec_med');
    //  $receta->ID_PAC=$id;
    //  $receta->FEC_REC=Carbon::now();

  /*      if(isset($_POST['finreceta'])){
          $receta->save();
          $pacientes= Paciente::find($id);
          $evamedi=Evamedi::where('ID_PAC','=',$id)->join('users','ID_USU','=','users.id')->select('FEC_MED','evaluacionmedica.id','EVA_TIC')->get();
          $evapsi=EvaPsico::where('ID_PAC','=',$id)->join('users','ID_MED','=','users.id')->select('FEC_PSI','evaluacionpsicologica.id','EVA_TIC')->get();
          $evaoto=EvaOto::where('ID_PAC','=',$id)->join('users','ID_MED','=','users.id')->select('FEC_OTO','evaluacionotorrino.id','EVA_TIC')->get();
          $evaoft=EvaOftalmo::where('ID_PAC','=',$id)->join('users','ID_MED','=','users.id')->select('FEC_OFT','evaluacionoftalmo.id','EVA_TIC')->get();
          $recetas=Receta::where('ID_PAC','=',$id)->join('users','ID_MED','=','users.id')->select('FEC_REC','recetas.id','EVA_TIC')->get();
          return redirect()->route('pacientes/{id}',['id'=>$id])->with('pacientes',$pacientes)->with('id',$id)->with('evamedi',$evamedi)->with('evapsi',$evapsi)->with('evaoto',$evaoto)->with('evaoft',$evaoft)->with('recetas',$recetas);
        }else{*/
        $pagelayout = array('165', '216');
        $pdf = new TCPDF('P','mm',$pagelayout, true, 'UTF-8', false);
        $pdf->SetTitle('LABORATORIOS');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetAutoPageBreak(TRUE, 10);
        $pdf->SetMargins(15, 15, 10);
        $pdf->AddPage();
        $pdf->Image('img/logo.png', 140, 2, 25, 25, 'PNG', '', '', true, 250, '', false, false, false, false, false, false);
        $pdf->Image('img/laboratorio.png', 2, 2, 20, 25, 'PNG', '', '', true, 250, '', false, false, false, false, false, false);
        $pdf->SetFont('','B','15');
        $pdf->SetXY(65, 8);
        $pdf->Write(0,'Laboratorios','','',false);
        $pdf->SetFont('','B','12');
        $pdf->SetXY(52, 17);
        $pdf->Write(0,'Centro de salud - DARSALUD','','',false);
        $pdf->SetFont('','B','11');
        $pdf->SetXY(10, 30);
        $pdf->Write(0,'Paciente:','','',false);


        $paciente=Paciente::where('id','=',$id)->first();

        $nom=$paciente->NOM_PAC.' '.$paciente->APA_PAC.' '.$paciente->AMA_PAC;
        $pdf->SetXY(30, 30);
        $pdf->SetFont('','','10');
        $pdf->Write(0,ucwords(strtolower($nom)),'','',false);

        $pdf->SetFont('','B','11');
        $pdf->SetXY(10, 35);
        $pdf->Write(0,'Medico:','','',false);

        $pdf->SetXY(30, 35);
        $pdf->SetFont('','','10');
        $pdf->Write(0,Auth::user()->NOM_USU.' '.Auth::user()->APA_USU.' '.Auth::user()->AMA_USU,'','',false);

        $pdf->SetXY(10, 45);
        $pdf->SetFont('','B','11');
        $pdf->Write(0,'Detalles de laboratorio','','',false);

        $pdf->SetXY(10, 65);
        $pdf->SetFont('','','10');
        $pdf->MultiCell(150, 10,'', 0, 'L', 0, 0, '', '', true);

        $pdf->write2DBarcode ( 'Paciente :'.$paciente->NOM_PAC.' '.$paciente->APA_PAC.' '.$paciente->AMA_PAC.' | Medico: '.Auth::user()->NOM_USU.' '.Auth::user()->APA_USU.' '.Auth::user()->AMA_USU.' | Fecha:'.'', 'QRCODE,M', 130, 180, 25, 25, '','','');


        $pdf->Output('Receta.pdf');
  //    }
    }
    public function pdfhistoriabasica()
    {

    }
    public function pdf()
    {

    }

    public function dmedica($id)
    {
      $user = User::find($id);
      $res1=Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Evaluacion medica')->whereRaw('DATE(ticket.created_at) = CURRENT_DATE')->join('users','ticket.ID_MED','=','users.id')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','ticket.created_at')->get();
      $res2=Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Evaluacion medica')->whereRaw('DATE(ticket.created_at) = CURRENT_DATE')->join('users','ticket.ID_MED','=','users.id')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','ticket.created_at')->count();
      $pagelayout = array('165', '216');
      $pdf = new TCPDF('P','mm','LETTER', true, 'UTF-8', false);
      $pdf->SetTitle('REPORTE');
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);
      $pdf->SetAutoPageBreak(TRUE, 10);
      $pdf->SetMargins(15, 15, 10);
      $pdf->AddPage();
      $pdf->Image('img/logo.png', 5, 5, 25, 25, 'PNG', '', '', true, 250, '', false, false, false, false, false, false);
      $pdf->Line ( 35, 25,205,25 ,array('width' => 0.5,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
      $pdf->SetFont('','B','15');
      $pdf->SetXY(65, 8);
      $pdf->Write(0,'Reporte diario - Evaluaciones medicas','','',false);
      $pdf->SetFont('','B','12');
      $pdf->SetXY(87, 17);
      $pdf->Write(0,'Centro de salud - DARSALUD','','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(15, 35);
      $pdf->Write(0,'Medico:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(35, 35);
      $pdf->Write(0,$user->NOM_USU.' '.$user->APA_USU.' '.$user->AMA_USU.' ','','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(125, 35);
      $pdf->Write(0,'Fecha:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(140, 35);
      $pdf->Write(0,Carbon::now()->format('d/m/Y'),'','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(15, 40);
      $pdf->Write(0,'Especialidad:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(45, 40);
      $pdf->Write(0,$user->ARE_USU,'','',false);
      $pdf->SetXY(15, 50);
      $html='
      <table class="table table-hover" border="1" cellpadding="4">
      <tr>
      <td><b>Paciente</b></td>
      <td><b>Especialidad</b></td>
      <td><b>Fecha y hora</b></td>
      </tr>';
      if(count($res1)>0):
      foreach ($res1 as $r) {
        $html=$html.'
        <tr>
        <td>'.$r->NOM_PAC.' '.$r->APA_PAC.' '.$r->AMA_PAC.' '.'</td>
        <td>'.$r->EVA_TIC.'</td>
        <td>'.$r->created_at->format('d/m/Y H:i:s').'</td>
        </tr>';
      }
    else:
      $html=$html.'
      <tr>
      <td colspan="3" >
      <center>
      No hay registros recientes
      </center>
      </td>
      </tr>';
    endif;
      $html=$html.'</table>
      <br /><br /><br /> TOTAL MONETARIO: Bs.'.$res2*50;
      $pdf->writeHTML($html, true, false, true, false, '');
      $pdf->SetFont('','BI','7');
      $pdf->SetXY(15, 265);
      $pdf->Write(0,'Generado por:'.Auth::user()->NOM_USU.' '.Auth::user()->APA_USU.' '.Auth::user()->AMA_USU.' - Administrador '.Carbon::now(),'','',false);
      $pdf->Output('Reportediariomedico.pdf');

    }
    public function tgmedica($id)
    {
      $user = User::find($id);
      $res1=Ticket::where('ID_MED','=',$user->id)->join('users','ticket.ID_MED','=','users.id')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','ticket.created_at')->get();
      $res2=Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Evaluacion medica')->join('users','ticket.ID_MED','=','users.id')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','ticket.created_at')->count();
      $res3=Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Evaluacion psicologica')->join('users','ticket.ID_MED','=','users.id')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','ticket.created_at')->count();
      $res4=Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Evaluacion oftalmologica')->join('users','ticket.ID_MED','=','users.id')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','ticket.created_at')->count();
      $res5=Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Consulta externa')->join('users','ticket.ID_MED','=','users.id')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','ticket.created_at')->count();
      $pagelayout = array('165', '216');
      $pdf = new TCPDF('P','mm','LETTER', true, 'UTF-8', false);
      $pdf->SetTitle('REPORTE');
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);
      $pdf->SetAutoPageBreak(TRUE, 10);
      $pdf->SetMargins(15, 15, 10);
      $pdf->AddPage();
      $pdf->Image('img/logo.png', 5, 5, 25, 25, 'PNG', '', '', true, 250, '', false, false, false, false, false, false);
      $pdf->Line ( 35, 25,205,25 ,array('width' => 0.5,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
      $pdf->SetFont('','B','15');
      $pdf->SetXY(60, 8);
      $pdf->Write(0,'Reporte general total - Evaluaciones medicas','','',false);
      $pdf->SetFont('','B','12');
      $pdf->SetXY(87, 17);
      $pdf->Write(0,'Centro de salud - DARSALUD','','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(15, 35);
      $pdf->Write(0,'Medico:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(35, 35);
      $pdf->Write(0,$user->NOM_USU.' '.$user->APA_USU.' '.$user->AMA_USU.' ','','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(125, 35);
      $pdf->Write(0,'Fecha:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(140, 35);
      $pdf->Write(0,Carbon::now()->format('d/m/Y'),'','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(15, 40);
      $pdf->Write(0,'Especialidad:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(45, 40);
      $pdf->Write(0,$user->ARE_USU,'','',false);
      $pdf->SetXY(15, 50);
      $html='
      <table class="table table-hover" border="1" cellpadding="4">
      <tr>
      <td><b>Paciente</b></td>
      <td><b>Especialidad</b></td>
      <td><b>Fecha y hora</b></td>
      </tr>';
      if(count($res1)>0):
      foreach ($res1 as $r) {
        $html=$html.'
        <tr>
        <td>'.$r->NOM_PAC.' '.$r->APA_PAC.' '.$r->AMA_PAC.' '.'</td>
        <td>'.$r->EVA_TIC.'</td>
        <td>'.$r->created_at->format('d/m/Y H:i:s').'</td>
        </tr>';
      }
    else:
      $html=$html.'
      <tr>
      <td colspan="3" >
      <center>
      No hay registros recientes
      </center>
      </td>
      </tr>';
    endif;
      $html=$html.'</table>
      <br /><br /><br /> TOTAL MONETARIO: Bs. '.($res2*50+$res3*30+$res4*30).' (Nota. solo SEGIP)';
      $pdf->writeHTML($html, true, false, true, false, '');
      $pdf->SetFont('','BI','7');
      $pdf->SetXY(15, 265);
      $pdf->Write(0,'Generado por:'.Auth::user()->NOM_USU.' '.Auth::user()->APA_USU.' '.Auth::user()->AMA_USU.' - Administrador '.Carbon::now(),'','',false);
      $pdf->Output('Reportediariomedico.pdf');

    }
    public function tgmmedica($id)
    {
      $user = User::find($id);
      $res1=Ticket::where('ID_MED','=',$user->id)->join('users','ticket.ID_MED','=','users.id')->whereRaw('MONTH(ticket.created_at) = MONTH(CURRENT_DATE())')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','ticket.created_at')->get();
      $res2=Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Evaluacion medica')->join('users','ticket.ID_MED','=','users.id')->whereRaw('MONTH(ticket.created_at) = MONTH(CURRENT_DATE())')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','ticket.created_at')->count();
      $res3=Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Evaluacion psicologica')->join('users','ticket.ID_MED','=','users.id')->whereRaw('MONTH(ticket.created_at) = MONTH(CURRENT_DATE())')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','ticket.created_at')->count();
      $res4=Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Evaluacion oftalmologica')->join('users','ticket.ID_MED','=','users.id')->whereRaw('MONTH(ticket.created_at) = MONTH(CURRENT_DATE())')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','ticket.created_at')->count();
      $res5=Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Consulta externa')->join('users','ticket.ID_MED','=','users.id')->whereRaw('MONTH(ticket.created_at) = MONTH(CURRENT_DATE())')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','ticket.created_at')->count();
      $pagelayout = array('165', '216');
      $pdf = new TCPDF('P','mm','LETTER', true, 'UTF-8', false);
      $pdf->SetTitle('REPORTE');
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);
      $pdf->SetAutoPageBreak(TRUE, 10);
      $pdf->SetMargins(15, 15, 10);
      $pdf->AddPage();
      $pdf->Image('img/logo.png', 5, 5, 25, 25, 'PNG', '', '', true, 250, '', false, false, false, false, false, false);
      $pdf->Line ( 35, 25,205,25 ,array('width' => 0.5,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
      $pdf->SetFont('','B','15');
      $pdf->SetXY(60, 8);
      $pdf->Write(0,'Reporte general mensual - Evaluaciones medicas','','',false);
      $pdf->SetFont('','B','12');
      $pdf->SetXY(87, 17);
      $pdf->Write(0,'Centro de salud - DARSALUD','','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(15, 35);
      $pdf->Write(0,'Medico:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(35, 35);
      $pdf->Write(0,$user->NOM_USU.' '.$user->APA_USU.' '.$user->AMA_USU.' ','','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(125, 35);
      $pdf->Write(0,'Fecha:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(140, 35);
      $pdf->Write(0,Carbon::now()->format('d/m/Y'),'','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(15, 40);
      $pdf->Write(0,'Especialidad:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(45, 40);
      $pdf->Write(0,$user->ARE_USU,'','',false);
      $pdf->SetXY(15, 50);
      $html='
      <table class="table table-hover" border="1" cellpadding="4">
      <tr>
      <td><b>Paciente</b></td>
      <td><b>Especialidad</b></td>
      <td><b>Fecha y hora</b></td>
      </tr>';
      if(count($res1)>0):
      foreach ($res1 as $r) {
        $html=$html.'
        <tr>
        <td>'.$r->NOM_PAC.' '.$r->APA_PAC.' '.$r->AMA_PAC.' '.'</td>
        <td>'.$r->EVA_TIC.'</td>
        <td>'.$r->created_at->format('d/m/Y H:i:s').'</td>
        </tr>';
      }
    else:
      $html=$html.'
      <tr>
      <td colspan="3" >
      <center>
      No hay registros recientes
      </center>
      </td>
      </tr>';
    endif;
      $html=$html.'</table>
      <br /><br /><br /> TOTAL MONETARIO: Bs. '.($res2*50+$res3*30+$res4*30).'(Nota: solo EVALUACIONES DE SEGIP)';
      $pdf->writeHTML($html, true, false, true, false, '');
      $pdf->SetFont('','BI','7');
      $pdf->SetXY(15, 265);
      $pdf->Write(0,'Generado por:'.Auth::user()->NOM_USU.' '.Auth::user()->APA_USU.' '.Auth::user()->AMA_USU.' - Administrador '.Carbon::now(),'','',false);
      $pdf->Output('Reportediariomedico.pdf');

    }
    public function mmedica($id)
    {
      $user = User::find($id);
      $res1=Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Evaluacion medica')->whereRaw('MONTH(ticket.created_at) = MONTH(CURRENT_DATE())')->join('users','ticket.ID_MED','=','users.id')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','ticket.created_at')->get();
      $res2=Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Evaluacion medica')->whereRaw('MONTH(ticket.created_at) = MONTH(CURRENT_DATE())')->join('users','ticket.ID_MED','=','users.id')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','ticket.created_at')->count();
      $pagelayout = array('165', '216');
      $pdf = new TCPDF('P','mm','LETTER', true, 'UTF-8', false);
      $pdf->SetTitle('REPORTE');
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);
      $pdf->SetAutoPageBreak(TRUE, 10);
      $pdf->SetMargins(15, 15, 10);
      $pdf->AddPage();
      $pdf->Image('img/logo.png', 5, 5, 25, 25, 'PNG', '', '', true, 250, '', false, false, false, false, false, false);
      $pdf->Line ( 35, 25,205,25 ,array('width' => 0.5,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
      $pdf->SetFont('','B','15');
      $pdf->SetXY(65, 8);
      $pdf->Write(0,'Reporte mensual - Evaluaciones medicas','','',false);
      $pdf->SetFont('','B','12');
      $pdf->SetXY(87, 17);
      $pdf->Write(0,'Centro de salud - DARSALUD','','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(15, 35);
      $pdf->Write(0,'Medico:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(35, 35);
      $pdf->Write(0,$user->NOM_USU.' '.$user->APA_USU.' '.$user->AMA_USU.' ','','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(125, 35);
      $pdf->Write(0,'Fecha:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(140, 35);
      $pdf->Write(0,Carbon::now()->format('d/m/Y'),'','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(15, 40);
      $pdf->Write(0,'Especialidad:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(45, 40);
      $pdf->Write(0,$user->ARE_USU,'','',false);
      $pdf->SetXY(15, 50);
      $html='
      <table class="table table-hover" border="1" cellpadding="4">
      <tr>
      <td><b>Paciente</b></td>
      <td><b>Especialidad</b></td>
      <td><b>Fecha y hora</b></td>
      </tr>';
      if(count($res1)>0):
      foreach ($res1 as $r) {
        $html=$html.'
        <tr>
        <td>'.$r->NOM_PAC.' '.$r->APA_PAC.' '.$r->AMA_PAC.' '.'</td>
        <td>'.$r->EVA_TIC.'</td>
        <td>'.$r->created_at->format('d/m/Y H:i:s').'</td>
        </tr>';
      }
    else:
      $html=$html.'
      <tr>
      <td colspan="3" >
      <center>
      No hay registros recientes
      </center>
      </td>
      </tr>';
    endif;
      $html=$html.'</table>
      <br /><br /><br /> TOTAL MONETARIO: Bs. '.$res2*50;
      $pdf->writeHTML($html, true, false, true, false, '');
      $pdf->SetFont('','BI','7');
      $pdf->SetXY(15, 265);
      $pdf->Write(0,'Generado por:'.Auth::user()->NOM_USU.' '.Auth::user()->APA_USU.' '.Auth::user()->AMA_USU.' - Administrador '.Carbon::now(),'','',false);
      $pdf->Output('Reportediariomedico.pdf');

    }
    public function tmedica($id)
    {
      $user = User::find($id);
      $res1=Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Evaluacion medica')->join('users','ticket.ID_MED','=','users.id')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','ticket.created_at')->get();
      $res2=Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Evaluacion medica')->join('users','ticket.ID_MED','=','users.id')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','ticket.created_at')->count();
      $pagelayout = array('165', '216');
      $pdf = new TCPDF('P','mm','LETTER', true, 'UTF-8', false);
      $pdf->SetTitle('REPORTE');
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);
      $pdf->SetAutoPageBreak(TRUE, 10);
      $pdf->SetMargins(15, 15, 10);
      $pdf->AddPage();
      $pdf->Image('img/logo.png', 5, 5, 25, 25, 'PNG', '', '', true, 250, '', false, false, false, false, false, false);
      $pdf->Line ( 35, 25,205,25 ,array('width' => 0.5,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
      $pdf->SetFont('','B','15');
      $pdf->SetXY(65, 8);
      $pdf->Write(0,'Reporte diario - Evaluaciones medicas','','',false);
      $pdf->SetFont('','B','12');
      $pdf->SetXY(87, 17);
      $pdf->Write(0,'Centro de salud - DARSALUD','','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(15, 35);
      $pdf->Write(0,'Medico:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(35, 35);
      $pdf->Write(0,$user->NOM_USU.' '.$user->APA_USU.' '.$user->AMA_USU.' ','','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(125, 35);
      $pdf->Write(0,'Fecha:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(140, 35);
      $pdf->Write(0,Carbon::now()->format('d/m/Y'),'','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(15, 40);
      $pdf->Write(0,'Especialidad:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(45, 40);
      $pdf->Write(0,$user->ARE_USU,'','',false);
      $pdf->SetXY(15, 50);
      $html='
      <table class="table table-hover" border="1" cellpadding="4">
      <tr>
      <td><b>Paciente</b></td>
      <td><b>Especialidad</b></td>
      <td><b>Fecha y hora</b></td>
      </tr>';
      if(count($res1)>0):
      foreach ($res1 as $r) {
        $html=$html.'
        <tr>
        <td>'.$r->NOM_PAC.' '.$r->APA_PAC.' '.$r->AMA_PAC.' '.'</td>
        <td>'.$r->EVA_TIC.'</td>
        <td>'.$r->created_at->format('d/m/Y H:i:s').'</td>
        </tr>';
      }
    else:
      $html=$html.'
      <tr>
      <td colspan="3" >
      <center>
      No hay registros recientes
      </center>
      </td>
      </tr>';
    endif;
      $html=$html.'</table>
      <br /><br /><br /> TOTAL MONETARIO: Bs. '.$res2*50;
      $pdf->writeHTML($html, true, false, true, false, '');
      $pdf->SetFont('','BI','7');
      $pdf->SetXY(15, 265);
      $pdf->Write(0,'Generado por:'.Auth::user()->NOM_USU.' '.Auth::user()->APA_USU.' '.Auth::user()->AMA_USU.' - Administrador '.Carbon::now(),'','',false);
      $pdf->Output('Reportediariomedico.pdf');

    }
    public function dpsicologia($id)
    {
      $user = User::find($id);
      $res1=Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Evaluacion psicologica')->whereRaw('DATE(ticket.created_at) = CURRENT_DATE')->join('users','ticket.ID_MED','=','users.id')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','ticket.created_at')->get();
      $res2=Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Evaluacion psicologica')->whereRaw('DATE(ticket.created_at) = CURRENT_DATE')->join('users','ticket.ID_MED','=','users.id')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','ticket.created_at')->count();
      $pagelayout = array('165', '216');
      $pdf = new TCPDF('P','mm','LETTER', true, 'UTF-8', false);
      $pdf->SetTitle('REPORTE');
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);
      $pdf->SetAutoPageBreak(TRUE, 10);
      $pdf->SetMargins(15, 15, 10);
      $pdf->AddPage();
      $pdf->Image('img/logo.png', 5, 5, 25, 25, 'PNG', '', '', true, 250, '', false, false, false, false, false, false);
      $pdf->Line ( 35, 25,205,25 ,array('width' => 0.5,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
      $pdf->SetFont('','B','15');
      $pdf->SetXY(65, 8);
      $pdf->Write(0,'Reporte diario - Evaluaciones psicologicas','','',false);
      $pdf->SetFont('','B','12');
      $pdf->SetXY(87, 17);
      $pdf->Write(0,'Centro de salud - DARSALUD','','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(15, 35);
      $pdf->Write(0,'Medico:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(35, 35);
      $pdf->Write(0,$user->NOM_USU.' '.$user->APA_USU.' '.$user->AMA_USU.' ','','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(125, 35);
      $pdf->Write(0,'Fecha:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(140, 35);
      $pdf->Write(0,Carbon::now()->format('d/m/Y'),'','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(15, 40);
      $pdf->Write(0,'Especialidad:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(45, 40);
      $pdf->Write(0,$user->ARE_USU,'','',false);
      $pdf->SetXY(15, 50);
      $html='
      <table class="table table-hover" border="1" cellpadding="4">
      <tr>
      <td><b>Paciente</b></td>
      <td><b>Especialidad</b></td>
      <td><b>Fecha y hora</b></td>
      </tr>';
      if(count($res1)>0):
      foreach ($res1 as $r) {
        $html=$html.'
        <tr>
        <td>'.$r->NOM_PAC.' '.$r->APA_PAC.' '.$r->AMA_PAC.' '.'</td>
        <td>'.$r->EVA_TIC.'</td>
        <td>'.$r->created_at->format('d/m/Y H:i:s').'</td>
        </tr>';
      }
    else:
      $html=$html.'
      <tr>
      <td colspan="3" >
      <center>
      No hay registros recientes
      </center>
      </td>
      </tr>';
    endif;
      $html=$html.'</table>
      <br /><br /><br /> TOTAL MONETARIO: Bs. '.$res2*30;
      $pdf->writeHTML($html, true, false, true, false, '');
      $pdf->SetFont('','BI','7');
      $pdf->SetXY(15, 265);
      $pdf->Write(0,'Generado por:'.Auth::user()->NOM_USU.' '.Auth::user()->APA_USU.' '.Auth::user()->AMA_USU.' - Administrador '.Carbon::now(),'','',false);
      $pdf->Output('Reportediariomedico.pdf');

    }
    public function mpsicologia($id)
    {
      $user = User::find($id);
      $res1=Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Evaluacion psicologica')->whereRaw('MONTH(ticket.created_at) = MONTH(CURRENT_DATE)')->join('users','ticket.ID_MED','=','users.id')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','ticket.created_at')->get();
      $res2=Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Evaluacion psicologica')->whereRaw('MONTH(ticket.created_at) = MONTH(CURRENT_DATE)')->join('users','ticket.ID_MED','=','users.id')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','ticket.created_at')->count();
      $pagelayout = array('165', '216');
      $pdf = new TCPDF('P','mm','LETTER', true, 'UTF-8', false);
      $pdf->SetTitle('REPORTE');
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);
      $pdf->SetAutoPageBreak(TRUE, 10);
      $pdf->SetMargins(15, 15, 10);
      $pdf->AddPage();
      $pdf->Image('img/logo.png', 5, 5, 25, 25, 'PNG', '', '', true, 250, '', false, false, false, false, false, false);
      $pdf->Line ( 35, 25,205,25 ,array('width' => 0.5,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
      $pdf->SetFont('','B','15');
      $pdf->SetXY(65, 8);
      $pdf->Write(0,'Reporte mensual - Evaluaciones psicologicas','','',false);
      $pdf->SetFont('','B','12');
      $pdf->SetXY(87, 17);
      $pdf->Write(0,'Centro de salud - DARSALUD','','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(15, 35);
      $pdf->Write(0,'Medico:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(35, 35);
      $pdf->Write(0,$user->NOM_USU.' '.$user->APA_USU.' '.$user->AMA_USU.' ','','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(125, 35);
      $pdf->Write(0,'Fecha:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(140, 35);
      $pdf->Write(0,Carbon::now()->format('d/m/Y'),'','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(15, 40);
      $pdf->Write(0,'Especialidad:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(45, 40);
      $pdf->Write(0,$user->ARE_USU,'','',false);
      $pdf->SetXY(15, 50);
      $html='
      <table class="table table-hover" border="1" cellpadding="4">
      <tr>
      <td><b>Paciente</b></td>
      <td><b>Especialidad</b></td>
      <td><b>Fecha y hora</b></td>
      </tr>';
      if(count($res1)>0):
      foreach ($res1 as $r) {
        $html=$html.'
        <tr>
        <td>'.$r->NOM_PAC.' '.$r->APA_PAC.' '.$r->AMA_PAC.' '.'</td>
        <td>'.$r->EVA_TIC.'</td>
        <td>'.$r->created_at->format('d/m/Y H:i:s').'</td>
        </tr>';
      }
    else:
      $html=$html.'
      <tr>
      <td colspan="3" >
      <center>
      No hay registros recientes
      </center>
      </td>
      </tr>';
    endif;
      $html=$html.'</table>
      <br /><br /><br /> TOTAL MONETARIO: Bs. '.$res2*30;
      $pdf->writeHTML($html, true, false, true, false, '');
      $pdf->SetFont('','BI','7');
      $pdf->SetXY(15, 265);
      $pdf->Write(0,'Generado por:'.Auth::user()->NOM_USU.' '.Auth::user()->APA_USU.' '.Auth::user()->AMA_USU.' - Administrador '.Carbon::now(),'','',false);
      $pdf->Output('Reportediariomedico.pdf');

    }
    public function tpsicologia($id)
    {
      $user = User::find($id);
      $res1=Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Evaluacion psicologica')->join('users','ticket.ID_MED','=','users.id')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','ticket.created_at')->get();
      $res2=Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Evaluacion psicologica')->join('users','ticket.ID_MED','=','users.id')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','ticket.created_at')->count();
      $pagelayout = array('165', '216');
      $pdf = new TCPDF('P','mm','LETTER', true, 'UTF-8', false);
      $pdf->SetTitle('REPORTE');
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);
      $pdf->SetAutoPageBreak(TRUE, 10);
      $pdf->SetMargins(15, 15, 10);
      $pdf->AddPage();
      $pdf->Image('img/logo.png', 5, 5, 25, 25, 'PNG', '', '', true, 250, '', false, false, false, false, false, false);
      $pdf->Line ( 35, 25,205,25 ,array('width' => 0.5,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
      $pdf->SetFont('','B','15');
      $pdf->SetXY(65, 8);
      $pdf->Write(0,'Reporte general - Evaluaciones psicologicas','','',false);
      $pdf->SetFont('','B','12');
      $pdf->SetXY(87, 17);
      $pdf->Write(0,'Centro de salud - DARSALUD','','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(15, 35);
      $pdf->Write(0,'Medico:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(35, 35);
      $pdf->Write(0,$user->NOM_USU.' '.$user->APA_USU.' '.$user->AMA_USU.' ','','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(125, 35);
      $pdf->Write(0,'Fecha:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(140, 35);
      $pdf->Write(0,Carbon::now()->format('d/m/Y'),'','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(15, 40);
      $pdf->Write(0,'Especialidad:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(45, 40);
      $pdf->Write(0,$user->ARE_USU,'','',false);
      $pdf->SetXY(15, 50);
      $html='
      <table class="table table-hover" border="1" cellpadding="4">
      <tr>
      <td><b>Paciente</b></td>
      <td><b>Especialidad</b></td>
      <td><b>Fecha y hora</b></td>
      </tr>';
      if(count($res1)>0):
      foreach ($res1 as $r) {
        $html=$html.'
        <tr>
        <td>'.$r->NOM_PAC.' '.$r->APA_PAC.' '.$r->AMA_PAC.' '.'</td>
        <td>'.$r->EVA_TIC.'</td>
        <td>'.$r->created_at->format('d/m/Y H:i:s').'</td>
        </tr>';
      }
    else:
      $html=$html.'
      <tr>
      <td colspan="3" >
      <center>
      No hay registros recientes
      </center>
      </td>
      </tr>';
    endif;
      $html=$html.'</table>
      <br /><br /><br /> TOTAL MONETARIO: Bs. '.$res2*30;
      $pdf->writeHTML($html, true, false, true, false, '');
      $pdf->SetFont('','BI','7');
      $pdf->SetXY(15, 265);
      $pdf->Write(0,'Generado por:'.Auth::user()->NOM_USU.' '.Auth::user()->APA_USU.' '.Auth::user()->AMA_USU.' - Administrador '.Carbon::now(),'','',false);
      $pdf->Output('Reportediariomedico.pdf');

    }
    public function doftalmo($id)
    {
      $user = User::find($id);
      $res1=Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Evaluacion oftalmologica')->whereRaw('DATE(ticket.created_at) = CURRENT_DATE')->join('users','ticket.ID_MED','=','users.id')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','ticket.created_at')->get();
      $res2=Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Evaluacion oftalmologica')->whereRaw('DATE(ticket.created_at) = CURRENT_DATE')->join('users','ticket.ID_MED','=','users.id')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','ticket.created_at')->count();
      $pagelayout = array('165', '216');
      $pdf = new TCPDF('P','mm','LETTER', true, 'UTF-8', false);
      $pdf->SetTitle('REPORTE');
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);
      $pdf->SetAutoPageBreak(TRUE, 10);
      $pdf->SetMargins(15, 15, 10);
      $pdf->AddPage();
      $pdf->Image('img/logo.png', 5, 5, 25, 25, 'PNG', '', '', true, 250, '', false, false, false, false, false, false);
      $pdf->Line ( 35, 25,205,25 ,array('width' => 0.5,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
      $pdf->SetFont('','B','15');
      $pdf->SetXY(65, 8);
      $pdf->Write(0,'Reporte diario - Evaluaciones oftalmologicas','','',false);
      $pdf->SetFont('','B','12');
      $pdf->SetXY(87, 17);
      $pdf->Write(0,'Centro de salud - DARSALUD','','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(15, 35);
      $pdf->Write(0,'Medico:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(35, 35);
      $pdf->Write(0,$user->NOM_USU.' '.$user->APA_USU.' '.$user->AMA_USU.' ','','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(125, 35);
      $pdf->Write(0,'Fecha:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(140, 35);
      $pdf->Write(0,Carbon::now()->format('d/m/Y'),'','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(15, 40);
      $pdf->Write(0,'Especialidad:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(45, 40);
      $pdf->Write(0,$user->ARE_USU,'','',false);
      $pdf->SetXY(15, 50);
      $html='
      <table class="table table-hover" border="1" cellpadding="4">
      <tr>
      <td><b>Paciente</b></td>
      <td><b>Especialidad</b></td>
      <td><b>Fecha y hora</b></td>
      </tr>';
      if(count($res1)>0):
      foreach ($res1 as $r) {
        $html=$html.'
        <tr>
        <td>'.$r->NOM_PAC.' '.$r->APA_PAC.' '.$r->AMA_PAC.' '.'</td>
        <td>'.$r->EVA_TIC.'</td>
        <td>'.$r->created_at->format('d/m/Y H:i:s').'</td>
        </tr>';
      }
    else:
      $html=$html.'
      <tr>
      <td colspan="3" >
      <center>
      No hay registros recientes
      </center>
      </td>
      </tr>';
    endif;
      $html=$html.'</table>
      <br /><br /><br /> TOTAL MONETARIO: Bs. '.$res2*30;
      $pdf->writeHTML($html, true, false, true, false, '');
      $pdf->SetFont('','BI','7');
      $pdf->SetXY(15, 265);
      $pdf->Write(0,'Generado por:'.Auth::user()->NOM_USU.' '.Auth::user()->APA_USU.' '.Auth::user()->AMA_USU.' - Administrador '.Carbon::now(),'','',false);
      $pdf->Output('Reportediariomedico.pdf');

    }
    public function moftalmo($id)
    {
      $user = User::find($id);
      $res1=Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Evaluacion oftalmologica')->whereRaw('MONTH(ticket.created_at) = MONTH(CURRENT_DATE)')->join('users','ticket.ID_MED','=','users.id')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','ticket.created_at')->get();
      $res2=Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Evaluacion oftalmologica')->whereRaw('MONTH(ticket.created_at) = MONTH(CURRENT_DATE)')->join('users','ticket.ID_MED','=','users.id')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','ticket.created_at')->count();
      $pagelayout = array('165', '216');
      $pdf = new TCPDF('P','mm','LETTER', true, 'UTF-8', false);
      $pdf->SetTitle('REPORTE');
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);
      $pdf->SetAutoPageBreak(TRUE, 10);
      $pdf->SetMargins(15, 15, 10);
      $pdf->AddPage();
      $pdf->Image('img/logo.png', 5, 5, 25, 25, 'PNG', '', '', true, 250, '', false, false, false, false, false, false);
      $pdf->Line ( 35, 25,205,25 ,array('width' => 0.5,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
      $pdf->SetFont('','B','15');
      $pdf->SetXY(65, 8);
      $pdf->Write(0,'Reporte mensual - Evaluaciones oftalmologicas','','',false);
      $pdf->SetFont('','B','12');
      $pdf->SetXY(87, 17);
      $pdf->Write(0,'Centro de salud - DARSALUD','','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(15, 35);
      $pdf->Write(0,'Medico:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(35, 35);
      $pdf->Write(0,$user->NOM_USU.' '.$user->APA_USU.' '.$user->AMA_USU.' ','','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(125, 35);
      $pdf->Write(0,'Fecha:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(140, 35);
      $pdf->Write(0,Carbon::now()->format('d/m/Y'),'','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(15, 40);
      $pdf->Write(0,'Especialidad:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(45, 40);
      $pdf->Write(0,$user->ARE_USU,'','',false);
      $pdf->SetXY(15, 50);
      $html='
      <table class="table table-hover" border="1" cellpadding="4">
      <tr>
      <td><b>Paciente</b></td>
      <td><b>Especialidad</b></td>
      <td><b>Fecha y hora</b></td>
      </tr>';
      if(count($res1)>0):
      foreach ($res1 as $r) {
        $html=$html.'
        <tr>
        <td>'.$r->NOM_PAC.' '.$r->APA_PAC.' '.$r->AMA_PAC.' '.'</td>
        <td>'.$r->EVA_TIC.'</td>
        <td>'.$r->created_at->format('d/m/Y H:i:s').'</td>
        </tr>';
      }
    else:
      $html=$html.'
      <tr>
      <td colspan="3" >
      <center>
      No hay registros recientes
      </center>
      </td>
      </tr>';
    endif;
      $html=$html.'</table>
      <br /><br /><br /> TOTAL MONETARIO: Bs. '.$res2*30;
      $pdf->writeHTML($html, true, false, true, false, '');
      $pdf->SetFont('','BI','7');
      $pdf->SetXY(15, 265);
      $pdf->Write(0,'Generado por:'.Auth::user()->NOM_USU.' '.Auth::user()->APA_USU.' '.Auth::user()->AMA_USU.' - Administrador '.Carbon::now(),'','',false);
      $pdf->Output('Reportediariomedico.pdf');

    }
    public function toftalmo($id)
    {
      $user = User::find($id);
      $res1=Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Evaluacion oftalmologica')->join('users','ticket.ID_MED','=','users.id')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','ticket.created_at')->get();
      $res2=Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Evaluacion oftalmologica')->join('users','ticket.ID_MED','=','users.id')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','ticket.created_at')->count();
      $pagelayout = array('165', '216');
      $pdf = new TCPDF('P','mm','LETTER', true, 'UTF-8', false);
      $pdf->SetTitle('REPORTE');
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);
      $pdf->SetAutoPageBreak(TRUE, 10);
      $pdf->SetMargins(15, 15, 10);
      $pdf->AddPage();
      $pdf->Image('img/logo.png', 5, 5, 25, 25, 'PNG', '', '', true, 250, '', false, false, false, false, false, false);
      $pdf->Line ( 35, 25,205,25 ,array('width' => 0.5,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
      $pdf->SetFont('','B','15');
      $pdf->SetXY(65, 8);
      $pdf->Write(0,'Reporte general - Evaluaciones oftalmologicas','','',false);
      $pdf->SetFont('','B','12');
      $pdf->SetXY(87, 17);
      $pdf->Write(0,'Centro de salud - DARSALUD','','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(15, 35);
      $pdf->Write(0,'Medico:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(35, 35);
      $pdf->Write(0,$user->NOM_USU.' '.$user->APA_USU.' '.$user->AMA_USU.' ','','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(125, 35);
      $pdf->Write(0,'Fecha:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(140, 35);
      $pdf->Write(0,Carbon::now()->format('d/m/Y'),'','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(15, 40);
      $pdf->Write(0,'Especialidad:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(45, 40);
      $pdf->Write(0,$user->ARE_USU,'','',false);
      $pdf->SetXY(15, 50);
      $html='
      <table class="table table-hover" border="1" cellpadding="4">
      <tr>
      <td><b>Paciente</b></td>
      <td><b>Especialidad</b></td>
      <td><b>Fecha y hora</b></td>
      </tr>';
      if(count($res1)>0):
      foreach ($res1 as $r) {
        $html=$html.'
        <tr>
        <td>'.$r->NOM_PAC.' '.$r->APA_PAC.' '.$r->AMA_PAC.' '.'</td>
        <td>'.$r->EVA_TIC.'</td>
        <td>'.$r->created_at->format('d/m/Y H:i:s').'</td>
        </tr>';
      }
    else:
      $html=$html.'
      <tr>
      <td colspan="3" >
      <center>
      No hay registros recientes
      </center>
      </td>
      </tr>';
    endif;
      $html=$html.'</table>
      <br /><br /><br /> TOTAL MONETARIO: Bs.'.$res2*30;
      $pdf->writeHTML($html, true, false, true, false, '');
      $pdf->SetFont('','BI','7');
      $pdf->SetXY(15, 265);
      $pdf->Write(0,'Generado por:'.Auth::user()->NOM_USU.' '.Auth::user()->APA_USU.' '.Auth::user()->AMA_USU.' - Administrador '.Carbon::now(),'','',false);
      $pdf->Output('Reportediariomedico.pdf');

    }
    public function dexterna($id)
    {
      $user = User::find($id);
      $res1=Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Consulta externa')->whereRaw('DATE(ticket.created_at) = CURRENT_DATE')->join('users','ticket.ID_MED','=','users.id')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','ticket.created_at')->get();
      $res2=Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Consulta externa')->whereRaw('DATE(ticket.created_at) = CURRENT_DATE')->join('users','ticket.ID_MED','=','users.id')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','ticket.created_at')->count();
      $pagelayout = array('165', '216');
      $pdf = new TCPDF('P','mm','LETTER', true, 'UTF-8', false);
      $pdf->SetTitle('REPORTE');
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);
      $pdf->SetAutoPageBreak(TRUE, 10);
      $pdf->SetMargins(15, 15, 10);
      $pdf->AddPage();
      $pdf->Image('img/logo.png', 5, 5, 25, 25, 'PNG', '', '', true, 250, '', false, false, false, false, false, false);
      $pdf->Line ( 35, 25,205,25 ,array('width' => 0.5,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
      $pdf->SetFont('','B','15');
      $pdf->SetXY(65, 8);
      $pdf->Write(0,'Reporte diario - Consultas externas','','',false);
      $pdf->SetFont('','B','12');
      $pdf->SetXY(87, 17);
      $pdf->Write(0,'Centro de salud - DARSALUD','','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(15, 35);
      $pdf->Write(0,'Medico:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(35, 35);
      $pdf->Write(0,$user->NOM_USU.' '.$user->APA_USU.' '.$user->AMA_USU.' ','','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(125, 35);
      $pdf->Write(0,'Fecha:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(140, 35);
      $pdf->Write(0,Carbon::now()->format('d/m/Y'),'','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(15, 40);
      $pdf->Write(0,'Especialidad:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(45, 40);
      $pdf->Write(0,$user->ARE_USU,'','',false);
      $pdf->SetXY(15, 50);
      $html='
      <table class="table table-hover" border="1" cellpadding="4">
      <tr>
      <td><b>Paciente</b></td>
      <td><b>Especialidad</b></td>
      <td><b>Fecha y hora</b></td>
      </tr>';
      if(count($res1)>0):
      foreach ($res1 as $r) {
        $html=$html.'
        <tr>
        <td>'.$r->NOM_PAC.' '.$r->APA_PAC.' '.$r->AMA_PAC.' '.'</td>
        <td>'.$r->EVA_TIC.'</td>
        <td>'.$r->created_at->format('d/m/Y H:i:s').'</td>
        </tr>';
      }
    else:
      $html=$html.'
      <tr>
      <td colspan="3" >
      <center>
      No hay registros recientes
      </center>
      </td>
      </tr>';
    endif;
      $html=$html.'</table>
      <br /><br /><br /> TOTAL MONETARIO: Bs. '.$res2*50;
      $pdf->writeHTML($html, true, false, true, false, '');
      $pdf->SetFont('','BI','7');
      $pdf->SetXY(15, 265);
      $pdf->Write(0,'Generado por:'.Auth::user()->NOM_USU.' '.Auth::user()->APA_USU.' '.Auth::user()->AMA_USU.' - Administrador '.Carbon::now(),'','',false);
      $pdf->Output('Reportediariomedico.pdf');

    }
    public function mexterna($id)
    {
      $user = User::find($id);
      $res1=Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Consulta externa')->whereRaw('MONTH(ticket.created_at) = MONTH(CURRENT_DATE)')->join('users','ticket.ID_MED','=','users.id')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','ticket.created_at')->get();
      $res2=Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Consulta externa')->whereRaw('MONTH(ticket.created_at) = MONTH(CURRENT_DATE)')->join('users','ticket.ID_MED','=','users.id')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','ticket.created_at')->count();
      $pagelayout = array('165', '216');
      $pdf = new TCPDF('P','mm','LETTER', true, 'UTF-8', false);
      $pdf->SetTitle('REPORTE');
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);
      $pdf->SetAutoPageBreak(TRUE, 10);
      $pdf->SetMargins(15, 15, 10);
      $pdf->AddPage();
      $pdf->Image('img/logo.png', 5, 5, 25, 25, 'PNG', '', '', true, 250, '', false, false, false, false, false, false);
      $pdf->Line ( 35, 25,205,25 ,array('width' => 0.5,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
      $pdf->SetFont('','B','15');
      $pdf->SetXY(65, 8);
      $pdf->Write(0,'Reporte mensual - Consultas externas','','',false);
      $pdf->SetFont('','B','12');
      $pdf->SetXY(87, 17);
      $pdf->Write(0,'Centro de salud - DARSALUD','','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(15, 35);
      $pdf->Write(0,'Medico:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(35, 35);
      $pdf->Write(0,$user->NOM_USU.' '.$user->APA_USU.' '.$user->AMA_USU.' ','','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(125, 35);
      $pdf->Write(0,'Fecha:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(140, 35);
      $pdf->Write(0,Carbon::now()->format('d/m/Y'),'','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(15, 40);
      $pdf->Write(0,'Especialidad:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(45, 40);
      $pdf->Write(0,$user->ARE_USU,'','',false);
      $pdf->SetXY(15, 50);
      $html='
      <table class="table table-hover" border="1" cellpadding="4">
      <tr>
      <td><b>Paciente</b></td>
      <td><b>Especialidad</b></td>
      <td><b>Fecha y hora</b></td>
      </tr>';
      if(count($res1)>0):
      foreach ($res1 as $r) {
        $html=$html.'
        <tr>
        <td>'.$r->NOM_PAC.' '.$r->APA_PAC.' '.$r->AMA_PAC.' '.'</td>
        <td>'.$r->EVA_TIC.'</td>
        <td>'.$r->created_at->format('d/m/Y H:i:s').'</td>
        </tr>';
      }
    else:
      $html=$html.'
      <tr>
      <td colspan="3" >
      <center>
      No hay registros recientes
      </center>
      </td>
      </tr>';
    endif;
      $html=$html.'</table>
      <br /><br /><br /> TOTAL MONETARIO: Bs. '.$res2*50;
      $pdf->writeHTML($html, true, false, true, false, '');
      $pdf->SetFont('','BI','7');
      $pdf->SetXY(15, 265);
      $pdf->Write(0,'Generado por:'.Auth::user()->NOM_USU.' '.Auth::user()->APA_USU.' '.Auth::user()->AMA_USU.' - Administrador '.Carbon::now(),'','',false);
      $pdf->Output('Reportediariomedico.pdf');

    }
    public function texterna($id)
    {
      $user = User::find($id);
      $res1=Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Consulta externa')->join('users','ticket.ID_MED','=','users.id')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','ticket.created_at')->get();
      $res2=Ticket::where('ID_MED','=',$user->id)->where('EVA_TIC','=','Consulta externa')->join('users','ticket.ID_MED','=','users.id')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','ticket.created_at')->count();
      $pagelayout = array('165', '216');
      $pdf = new TCPDF('P','mm','LETTER', true, 'UTF-8', false);
      $pdf->SetTitle('REPORTE');
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);
      $pdf->SetAutoPageBreak(TRUE, 10);
      $pdf->SetMargins(15, 15, 10);
      $pdf->AddPage();
      $pdf->Image('img/logo.png', 5, 5, 25, 25, 'PNG', '', '', true, 250, '', false, false, false, false, false, false);
      $pdf->Line ( 35, 25,205,25 ,array('width' => 0.5,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
      $pdf->SetFont('','B','15');
      $pdf->SetXY(65, 8);
      $pdf->Write(0,'Reporte general - Consultas externas','','',false);
      $pdf->SetFont('','B','12');
      $pdf->SetXY(87, 17);
      $pdf->Write(0,'Centro de salud - DARSALUD','','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(15, 35);
      $pdf->Write(0,'Medico:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(35, 35);
      $pdf->Write(0,$user->NOM_USU.' '.$user->APA_USU.' '.$user->AMA_USU.' ','','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(125, 35);
      $pdf->Write(0,'Fecha:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(140, 35);
      $pdf->Write(0,Carbon::now()->format('d/m/Y'),'','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(15, 40);
      $pdf->Write(0,'Especialidad:','','',false);
      $pdf->SetFont('','','11');
      $pdf->SetXY(45, 40);
      $pdf->Write(0,$user->ARE_USU,'','',false);
      $pdf->SetXY(15, 50);
      $html='
      <table class="table table-hover" border="1" cellpadding="4">
      <tr>
      <td><b>Paciente</b></td>
      <td><b>Especialidad</b></td>
      <td><b>Fecha y hora</b></td>
      </tr>';
      if(count($res1)>0):
      foreach ($res1 as $r) {
        $html=$html.'
        <tr>
        <td>'.$r->NOM_PAC.' '.$r->APA_PAC.' '.$r->AMA_PAC.' '.'</td>
        <td>'.$r->EVA_TIC.'</td>
        <td>'.$r->created_at->format('d/m/Y H:i:s').'</td>
        </tr>';
      }
    else:
      $html=$html.'
      <tr>
      <td colspan="3" >
      <center>
      No hay registros recientes
      </center>
      </td>
      </tr>';
    endif;
      $html=$html.'</table>
      <br /><br /><br /> TOTAL MONETARIO: Bs. '.$res2*50;
      $pdf->writeHTML($html, true, false, true, false, '');
      $pdf->SetFont('','BI','7');
      $pdf->SetXY(15, 265);
      $pdf->Write(0,'Generado por:'.Auth::user()->NOM_USU.' '.Auth::user()->APA_USU.' '.Auth::user()->AMA_USU.' - Administrador '.Carbon::now(),'','',false);
      $pdf->Output('Reportediariomedico.pdf');

    }


    public function deva($id)
    {
      $esp = Especialidad::find($id);
      $res1=Ticket::where('EVA_TIC','=',$esp->NOM_ESP)->whereRaw('DATE(ticket.created_at) = CURRENT_DATE')->join('users','ticket.ID_MED','=','users.id')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','NOM_USU','APA_USU','AMA_USU','ticket.created_at')->get();
      $res2=Ticket::where('EVA_TIC','=',$esp->NOM_ESP)->whereRaw('DATE(ticket.created_at) = CURRENT_DATE')->join('users','ticket.ID_MED','=','users.id')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','NOM_USU','APA_USU','AMA_USU','ticket.created_at')->count();
      $pagelayout = array('165', '216');
      $pdf = new TCPDF('P','mm','LETTER', true, 'UTF-8', false);
      $pdf->SetTitle('REPORTE EVALUACIONES');
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);
      $pdf->SetAutoPageBreak(TRUE, 10);
      $pdf->SetMargins(15, 15, 10);
      $pdf->AddPage();
      $pdf->Image('img/logo.png', 5, 5, 25, 25, 'PNG', '', '', true, 250, '', false, false, false, false, false, false);
      $pdf->Line ( 35, 25,205,25 ,array('width' => 0.5,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
      $pdf->SetFont('','B','15');
      $pdf->SetXY(80, 8);
      $pdf->Write(0,'Reporte diario - Evaluaciones','','',false);
      $pdf->SetFont('','B','12');
      $pdf->SetXY(87, 17);
      $pdf->Write(0,'Centro de salud - DARSALUD','','',false);
      $pdf->SetXY(15, 40);
      $pdf->SetFont('','','11');
      $html='
      <table class="table table-hover" border="1" cellpadding="4">
      <tr>
      <td><b>Medico</b></td>
      <td><b>Paciente</b></td>
      <td><b>Especialidad</b></td>
      <td><b>Fecha y hora</b></td>
      <td><b>Precio</b></td>
      </tr>';
      if(count($res1)>0):
      foreach ($res1 as $r) {
        $html=$html.'
        <tr>
        <td>'.$r->NOM_USU.' '.$r->APA_USU.' '.$r->AMA_USU.' '.'</td>
        <td>'.$r->NOM_PAC.' '.$r->APA_PAC.' '.$r->AMA_PAC.' '.'</td>
        <td>'.$r->EVA_TIC.'</td>
        <td>'.$r->created_at->format('d/m/Y H:i:s').'</td>
        <td> 50 Bs.</td>
        </tr>';
      }
    else:
      $html=$html.'
      <tr>
      <td colspan="5" >
      <center>
      No hay registros recientes
      </center>
      </td>
      </tr>';
    endif;
      $html=$html.'</table>
      <br /><br /><br /> TOTAL MONETARIO: Bs.'.$res2*50;
      $pdf->writeHTML($html, true, false, true, false, '');
      $pdf->SetFont('','BI','7');
      $pdf->SetXY(15, 265);
      $pdf->Write(0,'Generado por:'.Auth::user()->NOM_USU.' '.Auth::user()->APA_USU.' '.Auth::user()->AMA_USU.' - Administrador '.Carbon::now(),'','',false);
      $pdf->Output('Reportediariomedico.pdf');

    }
    public function meva($id)
    {
      $esp = Especialidad::find($id);
      $res1=Ticket::where('EVA_TIC','=',$esp->NOM_ESP)->whereRaw('MONTH(ticket.created_at) = MONTH(CURRENT_DATE)')->join('users','ticket.ID_MED','=','users.id')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','NOM_USU','APA_USU','AMA_USU','ticket.created_at')->get();
      $res2=Ticket::where('EVA_TIC','=',$esp->NOM_ESP)->whereRaw('MONTH(ticket.created_at) = MONTH(CURRENT_DATE)')->join('users','ticket.ID_MED','=','users.id')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','NOM_USU','APA_USU','AMA_USU','ticket.created_at')->count();
      $pagelayout = array('165', '216');
      $pdf = new TCPDF('P','mm','LETTER', true, 'UTF-8', false);
      $pdf->SetTitle('REPORTE EVALUACIONES');
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);
      $pdf->SetAutoPageBreak(TRUE, 10);
      $pdf->SetMargins(15, 15, 10);
      $pdf->AddPage();
      $pdf->Image('img/logo.png', 5, 5, 25, 25, 'PNG', '', '', true, 250, '', false, false, false, false, false, false);
      $pdf->Line ( 35, 25,205,25 ,array('width' => 0.5,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
      $pdf->SetFont('','B','15');
      $pdf->SetXY(80, 8);
      $pdf->Write(0,'Reporte mensual - Evaluaciones','','',false);
      $pdf->SetFont('','B','12');
      $pdf->SetXY(87, 17);
      $pdf->Write(0,'Centro de salud - DARSALUD','','',false);
      $pdf->SetXY(15, 40);
      $pdf->SetFont('','','11');
      $html='
      <table class="table table-hover" border="1" cellpadding="4">
      <tr>
      <td><b>Medico</b></td>
      <td><b>Paciente</b></td>
      <td><b>Especialidad</b></td>
      <td><b>Fecha y hora</b></td>
      <td><b>Precio</b></td>
      </tr>';
      if(count($res1)>0):
      foreach ($res1 as $r) {
        $html=$html.'
        <tr>
        <td>'.$r->NOM_USU.' '.$r->APA_USU.' '.$r->AMA_USU.' '.'</td>
        <td>'.$r->NOM_PAC.' '.$r->APA_PAC.' '.$r->AMA_PAC.' '.'</td>
        <td>'.$r->EVA_TIC.'</td>
        <td>'.$r->created_at->format('d/m/Y H:i:s').'</td>
        <td> 50 Bs.</td>
        </tr>';
      }
    else:
      $html=$html.'
      <tr>
      <td colspan="5" >
      <center>
      No hay registros recientes
      </center>
      </td>
      </tr>';
    endif;
      $html=$html.'</table>
      <br /><br /><br /> TOTAL MONETARIO: Bs.'.$res2*50;
      $pdf->writeHTML($html, true, false, true, false, '');
      $pdf->SetFont('','BI','7');
      $pdf->SetXY(15, 265);
      $pdf->Write(0,'Generado por:'.Auth::user()->NOM_USU.' '.Auth::user()->APA_USU.' '.Auth::user()->AMA_USU.' - Administrador '.Carbon::now(),'','',false);
      $pdf->Output('Reportediariomedico.pdf');

    }
    public function teva($id)
    {
      $esp = Especialidad::find($id);
      $res1=Ticket::where('EVA_TIC','=',$esp->NOM_ESP)->join('users','ticket.ID_MED','=','users.id')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','NOM_USU','APA_USU','AMA_USU','ticket.created_at')->get();
      $res2=Ticket::where('EVA_TIC','=',$esp->NOM_ESP)->join('users','ticket.ID_MED','=','users.id')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','NOM_USU','APA_USU','AMA_USU','ticket.created_at')->count();
      $pagelayout = array('165', '216');
      $pdf = new TCPDF('P','mm','LETTER', true, 'UTF-8', false);
      $pdf->SetTitle('REPORTE EVALUACIONES');
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);
      $pdf->SetAutoPageBreak(TRUE, 10);
      $pdf->SetMargins(15, 15, 10);
      $pdf->AddPage();
      $pdf->Image('img/logo.png', 5, 5, 25, 25, 'PNG', '', '', true, 250, '', false, false, false, false, false, false);
      $pdf->Line ( 35, 25,205,25 ,array('width' => 0.5,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
      $pdf->SetFont('','B','15');
      $pdf->SetXY(80, 8);
      $pdf->Write(0,'Reporte general - Evaluaciones','','',false);
      $pdf->SetFont('','B','12');
      $pdf->SetXY(87, 17);
      $pdf->Write(0,'Centro de salud - DARSALUD','','',false);
      $pdf->SetXY(15, 40);
      $pdf->SetFont('','','11');
      $html='
      <table class="table table-hover" border="1" cellpadding="4">
      <tr>
      <td><b>Medico</b></td>
      <td><b>Paciente</b></td>
      <td><b>Especialidad</b></td>
      <td><b>Fecha y hora</b></td>
      <td><b>Precio</b></td>
      </tr>';
      if(count($res1)>0):
      foreach ($res1 as $r) {
        $html=$html.'
        <tr>
        <td>'.$r->NOM_USU.' '.$r->APA_USU.' '.$r->AMA_USU.' '.'</td>
        <td>'.$r->NOM_PAC.' '.$r->APA_PAC.' '.$r->AMA_PAC.' '.'</td>
        <td>'.$r->EVA_TIC.'</td>
        <td>'.$r->created_at->format('d/m/Y H:i:s').'</td>
        <td> 50 Bs.</td>
        </tr>';
      }
    else:
      $html=$html.'
      <tr>
      <td colspan="5" >
      <center>
      No hay registros recientes
      </center>
      </td>
      </tr>';
    endif;
      $html=$html.'</table>
      <br /><br /><br /> TOTAL MONETARIO: Bs.'.$res2*50;
      $pdf->writeHTML($html, true, false, true, false, '');
      $pdf->SetFont('','BI','7');
      $pdf->SetXY(15, 265);
      $pdf->Write(0,'Generado por:'.Auth::user()->NOM_USU.' '.Auth::user()->APA_USU.' '.Auth::user()->AMA_USU.' - Administrador '.Carbon::now(),'','',false);
      $pdf->Output('Reportediariomedico.pdf');

    }
    public function tgeva()
    {
      $res1=Ticket::join('users','ticket.ID_MED','=','users.id')->whereRaw('DATE(ticket.created_at) = CURRENT_DATE')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','NOM_USU','APA_USU','AMA_USU','ticket.created_at')->get();
      $res2=Ticket::where('EVA_TIC','=','Evaluacion medica')->join('users','ticket.ID_MED','=','users.id')->whereRaw('DATE(ticket.created_at) = CURRENT_DATE')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','NOM_USU','APA_USU','AMA_USU','ticket.created_at')->count();
      $res3=Ticket::where('EVA_TIC','=','Evaluacion psicologica')->join('users','ticket.ID_MED','=','users.id')->whereRaw('DATE(ticket.created_at) = CURRENT_DATE')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','NOM_USU','APA_USU','AMA_USU','ticket.created_at')->count();
      $res4=Ticket::where('EVA_TIC','=','Evaluacion oftalmologica')->join('users','ticket.ID_MED','=','users.id')->whereRaw('DATE(ticket.created_at) = CURRENT_DATE')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','NOM_USU','APA_USU','AMA_USU','ticket.created_at')->count();
      $res5=Ticket::where('EVA_TIC','=','Consulta externa')->join('users','ticket.ID_MED','=','users.id')->whereRaw('DATE(ticket.created_at) = CURRENT_DATE')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','NOM_USU','APA_USU','AMA_USU','ticket.created_at')->count();
      $pagelayout = array('165', '216');
      $pdf = new TCPDF('P','mm','LETTER', true, 'UTF-8', false);
      $pdf->SetTitle('REPORTE EVALUACIONES');
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);
      $pdf->SetAutoPageBreak(TRUE, 10);
      $pdf->SetMargins(15, 15, 10);
      $pdf->AddPage();
      $pdf->Image('img/logo.png', 5, 5, 25, 25, 'PNG', '', '', true, 250, '', false, false, false, false, false, false);
      $pdf->Line ( 35, 25,205,25 ,array('width' => 0.5,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
      $pdf->SetFont('','B','15');
      $pdf->SetXY(60, 8);
      $pdf->Write(0,'Reporte general diario - Evaluaciones Darsalud','','',false);
      $pdf->SetFont('','B','12');
      $pdf->SetXY(87, 17);
      $pdf->Write(0,'Centro de salud - DARSALUD','','',false);
      $pdf->SetXY(15, 40);
      $pdf->SetFont('','','11');
      $html='
      <table class="table table-hover" border="1" cellpadding="4">
      <tr>
      <td><b>Medico</b></td>
      <td><b>Paciente</b></td>
      <td><b>Especialidad</b></td>
      <td><b>Fecha y hora</b></td>
      <td><b>Precio</b></td>
      </tr>';
      if(count($res1)>0):
      foreach ($res1 as $r) {
        $html=$html.'
        <tr>
        <td>'.$r->NOM_USU.' '.$r->APA_USU.' '.$r->AMA_USU.' '.'</td>
        <td>'.$r->NOM_PAC.' '.$r->APA_PAC.' '.$r->AMA_PAC.' '.'</td>
        <td>'.$r->EVA_TIC.'</td>
        <td>'.$r->created_at->format('d/m/Y H:i:s').'</td>
        <td>';
        if ($r->EVA_TIC=='Evaluacion medica') {
          $html=$html.' 50 Bs.';
        }elseif($r->EVA_TIC=='Evaluacion psicologica'){
          $html=$html.' 30 Bs.';
        }elseif($r->EVA_TIC=='Evaluacion oftalmologica'){
          $html=$html.' 30 Bs.';
        }elseif($r->EVA_TIC=='Consulta externa'){
          $html=$html.' 50 Bs.';
        }
        $html=$html.'</td>
        </tr>';
      }
    else:
      $html=$html.'
      <tr>
      <td colspan="5" >
      <center>
      No hay registros recientes
      </center>
      </td>
      </tr>';
    endif;
      $html=$html.'</table>
      <br /><br /><br /> TOTAL MONETARIO: Bs.'.($res2*50+$res3*30+$res4*30+$res5*50);
      $pdf->writeHTML($html, true, false, true, false, '');
      $pdf->SetFont('','BI','7');
      $pdf->SetXY(15, 265);
      $pdf->Write(0,'Generado por:'.Auth::user()->NOM_USU.' '.Auth::user()->APA_USU.' '.Auth::user()->AMA_USU.' - Administrador '.Carbon::now(),'','',false);
      $pdf->Output('Reportediariomedico.pdf');

    }
    public function personalizado(Request $request)
    {
      $pagelayout = array('165', '216');
      $pdf = new TCPDF('P','mm','LETTER', true, 'UTF-8', false);
      $pdf->SetTitle('REPORTE EVALUACIONES');
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);
      $pdf->SetAutoPageBreak(TRUE, 10);
      $pdf->SetMargins(15, 15, 10);
      $pdf->AddPage();
      $pdf->Image('img/logo.png', 5, 5, 25, 25, 'PNG', '', '', true, 250, '', false, false, false, false, false, false);
      $pdf->Line ( 35, 25,205,25 ,array('width' => 0.5,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
      $pdf->SetFont('','B','15');
      $pdf->SetXY(60, 8);
      $pdf->Write(0,'Reporte general diario - Evaluaciones Darsalud','','',false);
      $pdf->SetFont('','B','12');
      $pdf->SetXY(87, 17);
      $pdf->Write(0,'Centro de salud - DARSALUD','','',false);
      $pdf->SetXY(15, 40);
      $pdf->SetFont('','','11');

      switch($request->opcion){
        case '1':
        $res1=Ticket::join('users','ticket.ID_MED','=','users.id')->whereRaw('DATE(ticket.created_at) = subdate(CURRENT_DATE, 1)')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','NOM_USU','APA_USU','AMA_USU','ticket.created_at');
        break;
        case '2':
        $res1=Ticket::join('users','ticket.ID_MED','=','users.id')->whereRaw('DATE(ticket.created_at) = CURRENT_DATE')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','NOM_USU','APA_USU','AMA_USU','ticket.created_at');
        break;
        case '3':
        $res1=Ticket::join('users','ticket.ID_MED','=','users.id')->whereRaw('MONTH(ticket.created_at) = MONTH(CURRENT_DATE)')->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','NOM_USU','APA_USU','AMA_USU','ticket.created_at');
        break;
        case '4':
        $res1=Ticket::join('users','ticket.ID_MED','=','users.id')->whereDate('ticket.created_at','=',$request->input('fija'))->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','NOM_USU','APA_USU','AMA_USU','ticket.created_at');
        break;
        case '5':
        $res1=Ticket::join('users','ticket.ID_MED','=','users.id')->whereBetween('ticket.created_at',array($request->input('inicio'),$request->input('fin')))->join('pacientes','ticket.ID_PAC','=','pacientes.id')->select('NOM_PAC','APA_PAC','AMA_PAC','EVA_TIC','NOM_USU','APA_USU','AMA_USU','ticket.created_at');
        break;
      }
      switch($request->tabla){
        case '1':
        $res1= $res1->get();
        $html='
        <table class="table table-hover" border="1" cellpadding="4">
        <tr>
        <td><b>Medico</b></td>
        <td><b>Paciente</b></td>
        <td><b>Especialidad</b></td>
        <td><b>Fecha y hora</b></td>
        <td><b>Precio</b></td>
        </tr>';
        if(count($res1)>0):
        foreach ($res1 as $r) {
          $html=$html.'
          <tr>
          <td>'.$r->NOM_USU.' '.$r->APA_USU.' '.$r->AMA_USU.' '.'</td>
          <td>'.$r->NOM_PAC.' '.$r->APA_PAC.' '.$r->AMA_PAC.' '.'</td>
          <td>'.$r->EVA_TIC.'</td>
          <td>'.$r->created_at->format('d/m/Y H:i:s').'</td>
          <td>';
          if ($r->EVA_TIC=='Evaluacion medica') {
            $html=$html.' 50 Bs.';
          }elseif($r->EVA_TIC=='Evaluacion psicologica'){
            $html=$html.' 30 Bs.';
          }elseif($r->EVA_TIC=='Evaluacion oftalmologica'){
            $html=$html.' 30 Bs.';
          }elseif($r->EVA_TIC=='Consulta externa'){
            $html=$html.' 50 Bs.';
          }
          $html=$html.'</td>
          </tr>';
        }
      else:
        $html=$html.'
        <tr>
        <td colspan="5" >
        <center>
        No hay registros recientes
        </center>
        </td>
        </tr>';
      endif;
        $html=$html.'</table>';
        break;
        case '2':
        $res1= $res1->where('EVA_TIC','!=','Consulta externa')->get();
        $html='
        <table class="table table-hover" border="1" cellpadding="4">
        <tr>
        <td><b>Medico</b></td>
        <td><b>Paciente</b></td>
        <td><b>Especialidad</b></td>
        <td><b>Fecha y hora</b></td>
        <td><b>Precio</b></td>
        </tr>';
        if(count($res1)>0):
        foreach ($res1 as $r) {
          $html=$html.'
          <tr>
          <td>'.$r->NOM_USU.' '.$r->APA_USU.' '.$r->AMA_USU.' '.'</td>
          <td>'.$r->NOM_PAC.' '.$r->APA_PAC.' '.$r->AMA_PAC.' '.'</td>
          <td>'.$r->EVA_TIC.'</td>
          <td>'.$r->created_at->format('d/m/Y H:i:s').'</td>
          <td>';
          if ($r->EVA_TIC=='Evaluacion medica') {
            $html=$html.' 50 Bs.';
          }elseif($r->EVA_TIC=='Evaluacion psicologica'){
            $html=$html.' 30 Bs.';
          }elseif($r->EVA_TIC=='Evaluacion oftalmologica'){
            $html=$html.' 30 Bs.';
          }elseif($r->EVA_TIC=='Consulta externa'){
            $html=$html.' 50 Bs.';
          }
          $html=$html.'</td>
          </tr>';
        }
      else:
        $html=$html.'
        <tr>
        <td colspan="5" >
        <center>
        No hay registros recientes
        </center>
        </td>
        </tr>';
      endif;
        $html=$html.'</table>';
        break;
        case '3':
        $res1= $res1->where('EVA_TIC','=','Consulta externa')->get();
        $html='
        <table class="table table-hover" border="1" cellpadding="4">
        <tr>
        <td><b>Medico</b></td>
        <td><b>Paciente</b></td>
        <td><b>Especialidad</b></td>
        <td><b>Fecha y hora</b></td>
        <td><b>Precio</b></td>
        </tr>';
        if(count($res1)>0):
        foreach ($res1 as $r) {
          $html=$html.'
          <tr>
          <td>'.$r->NOM_USU.' '.$r->APA_USU.' '.$r->AMA_USU.' '.'</td>
          <td>'.$r->NOM_PAC.' '.$r->APA_PAC.' '.$r->AMA_PAC.' '.'</td>
          <td>'.$r->EVA_TIC.'</td>
          <td>'.$r->created_at->format('d/m/Y H:i:s').'</td>
          <td>';
          if ($r->EVA_TIC=='Evaluacion medica') {
            $html=$html.' 50 Bs.';
          }elseif($r->EVA_TIC=='Evaluacion psicologica'){
            $html=$html.' 30 Bs.';
          }elseif($r->EVA_TIC=='Evaluacion oftalmologica'){
            $html=$html.' 30 Bs.';
          }elseif($r->EVA_TIC=='Consulta externa'){
            $html=$html.' 50 Bs.';
          }
          $html=$html.'</td>
          </tr>';
        }
      else:
        $html=$html.'
        <tr>
        <td colspan="5" >
        <center>
        No hay registros recientes
        </center>
        </td>
        </tr>';
      endif;
        $html=$html.'</table>';
        break;
        case '4':
        $user = User::find($request->input('id'));
        $res1= $res1->where('ID_MED',$request->input('id'))->get();
        $pdf->SetFont('','B','11');
        $pdf->SetXY(15, 35);
        $pdf->Write(0,'Medico:','','',false);
        $pdf->SetFont('','','11');
        $pdf->SetXY(35, 35);
        $pdf->Write(0,$user->NOM_USU.' '.$user->APA_USU.' '.$user->AMA_USU.' ','','',false);
        $pdf->SetFont('','B','11');
        $pdf->SetXY(125, 35);
        $pdf->Write(0,'Fecha:','','',false);
        $pdf->SetFont('','','11');
        $pdf->SetXY(140, 35);
        $pdf->Write(0,Carbon::now()->format('d/m/Y'),'','',false);
        $pdf->SetFont('','B','11');
        $pdf->SetXY(15, 40);
        $pdf->Write(0,'Especialidad:','','',false);
        $pdf->SetFont('','','11');
        $pdf->SetXY(45, 40);
        $pdf->Write(0,$user->ARE_USU,'','',false);
        $pdf->SetXY(15, 50);
        $html='
        <table class="table table-hover" border="1" cellpadding="4">
        <tr>
        <td><b>Paciente</b></td>
        <td><b>Especialidad</b></td>
        <td><b>Fecha y hora</b></td>
        </tr>';
        if(count($res1)>0):
        foreach ($res1 as $r) {
          $html=$html.'
          <tr>
          <td>'.$r->NOM_PAC.' '.$r->APA_PAC.' '.$r->AMA_PAC.' '.'</td>
          <td>'.$r->EVA_TIC.'</td>
          <td>'.$r->created_at->format('d/m/Y H:i:s').'</td>
          </tr>';
        }
      else:
        $html=$html.'
        <tr>
        <td colspan="3" >
        <center>
        No hay registros recientes
        </center>
        </td>
        </tr>';
      endif;
        $html=$html.'</table>';
        break;
        case '5':
        $user = User::find($request->input('id'));
        $res1= $res1->where('ID_MED',$request->input('id'))->where('EVA_TIC','!=','Consulta externa')->get();
        $pdf->SetFont('','B','11');
        $pdf->SetXY(15, 35);
        $pdf->Write(0,'Medico:','','',false);
        $pdf->SetFont('','','11');
        $pdf->SetXY(35, 35);
        $pdf->Write(0,$user->NOM_USU.' '.$user->APA_USU.' '.$user->AMA_USU.' ','','',false);
        $pdf->SetFont('','B','11');
        $pdf->SetXY(125, 35);
        $pdf->Write(0,'Fecha:','','',false);
        $pdf->SetFont('','','11');
        $pdf->SetXY(140, 35);
        $pdf->Write(0,Carbon::now()->format('d/m/Y'),'','',false);
        $pdf->SetFont('','B','11');
        $pdf->SetXY(15, 40);
        $pdf->Write(0,'Especialidad:','','',false);
        $pdf->SetFont('','','11');
        $pdf->SetXY(45, 40);
        $pdf->Write(0,$user->ARE_USU,'','',false);
        $pdf->SetXY(15, 50);
        $html='
        <table class="table table-hover" border="1" cellpadding="4">
        <tr>
        <td><b>Paciente</b></td>
        <td><b>Especialidad</b></td>
        <td><b>Fecha y hora</b></td>
        </tr>';
        if(count($res1)>0):
        foreach ($res1 as $r) {
          $html=$html.'
          <tr>
          <td>'.$r->NOM_PAC.' '.$r->APA_PAC.' '.$r->AMA_PAC.' '.'</td>
          <td>'.$r->EVA_TIC.'</td>
          <td>'.$r->created_at->format('d/m/Y H:i:s').'</td>
          </tr>';
        }
      else:
        $html=$html.'
        <tr>
        <td colspan="3" >
        <center>
        No hay registros recientes
        </center>
        </td>
        </tr>';
      endif;
        $html=$html.'</table>';
        break;
        case '6':
        $user = User::find($request->input('id'));
        $res1= $res1->where('ID_MED',$request->input('id'))->where('EVA_TIC','=','Consulta externa')->get();
        $pdf->SetFont('','B','11');
        $pdf->SetXY(15, 35);
        $pdf->Write(0,'Medico:','','',false);
        $pdf->SetFont('','','11');
        $pdf->SetXY(35, 35);
        $pdf->Write(0,$user->NOM_USU.' '.$user->APA_USU.' '.$user->AMA_USU.' ','','',false);
        $pdf->SetFont('','B','11');
        $pdf->SetXY(125, 35);
        $pdf->Write(0,'Fecha:','','',false);
        $pdf->SetFont('','','11');
        $pdf->SetXY(140, 35);
        $pdf->Write(0,Carbon::now()->format('d/m/Y'),'','',false);
        $pdf->SetFont('','B','11');
        $pdf->SetXY(15, 40);
        $pdf->Write(0,'Especialidad:','','',false);
        $pdf->SetFont('','','11');
        $pdf->SetXY(45, 40);
        $pdf->Write(0,$user->ARE_USU,'','',false);
        $pdf->SetXY(15, 50);
        $html='
        <table class="table table-hover" border="1" cellpadding="4">
        <tr>
        <td><b>Paciente</b></td>
        <td><b>Especialidad</b></td>
        <td><b>Fecha y hora</b></td>
        </tr>';
        if(count($res1)>0):
        foreach ($res1 as $r) {
          $html=$html.'
          <tr>
          <td>'.$r->NOM_PAC.' '.$r->APA_PAC.' '.$r->AMA_PAC.' '.'</td>
          <td>'.$r->EVA_TIC.'</td>
          <td>'.$r->created_at->format('d/m/Y H:i:s').'</td>
          </tr>';
        }
      else:
        $html=$html.'
        <tr>
        <td colspan="3" >
        <center>
        No hay registros recientes
        </center>
        </td>
        </tr>';
      endif;
        $html=$html.'</table>';
        break;

      }



      $pdf->writeHTML($html, true, false, true, false, '');
      $pdf->SetFont('','BI','7');
      $pdf->SetXY(15, 265);
      $pdf->Write(0,'Generado por:'.Auth::user()->NOM_USU.' '.Auth::user()->APA_USU.' '.Auth::user()->AMA_USU.' - Administrador '.Carbon::now(),'','',false);
      $pdf->Output('Reportediariomedico.pdf');

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
