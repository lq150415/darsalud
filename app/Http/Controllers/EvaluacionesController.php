<?php

namespace Darsalud\Http\Controllers;

use Illuminate\Http\Request;
use Darsalud\EvaPsico;
use Darsalud\Paciente;
use Darsalud\EvaMedi;
use Darsalud\EvaOto;
use Darsalud\Reserva;
use Darsalud\EvaOftalmo;
use Darsalud\Ticket;
use Darsalud\Receta;
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
use Illuminate\Support\Facades\Auth;
use Darsalud\Http\Requests;
use TCPDF;
use PDF;
use Carbon\Carbon;
use Response;
use Darsalud\Http\Controllers\Controller;

class EvaluacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    public function pdfpsico(Request $request,$id,$ids)
    {
      $ticket=Ticket::find($ids);
      if(isset($_POST['guardar'])){
      $ticket=Ticket::find($ids);
      $comprueba= EvaPsico::where('ID_TIC','=',$ids)->first();


      if($comprueba){
      $idmed=$comprueba->id;
      $psicologia= EvaPsico::find($idmed);
      }else{
      $psicologia= new EvaPsico;
      }
      $psicologia->FEC_PSI= Carbon::now();
      $psicologia->LUG_NAC= $request->input('lug_nac');
      $psicologia->HIS_PSI= $request->input('his_psi');
      $psicologia->EX1_PSI= $request->input('opciones');
      $psicologia->EX2_PSI= $request->input('opciones1');
      $psicologia->EX3_PSI= $request->input('opciones2');
      $psicologia->EX4_PSI= $request->input('opciones3');
      $psicologia->RFI_PSI= $request->input('rfi_psi');
      $psicologia->ID_MED= Auth::user()->id;
      $psicologia->ID_PAC= $id;
      $psicologia->ID_TIC= $ids;
      $psicologia->save();
      $ticket->EST_TIC=4;
      $ticket->IMP_TIC=1;
      $ticket->save();
      $mensaje="El paciente fue marcado como pendiente";
      $reservas= Reserva::join('ticket','ticket.id','=','ID_TIC')->join('pacientes','pacientes.id','=','ticket.ID_PAC')->join('users','users.id','=','ticket.ID_MED')->where('EST_TIC','!=',2)->where('ID_MED','=',Auth::user()->id)->get();
     return redirect()->route('/')->with('reservas',$reservas)->with('mensaje2',$mensaje);
   }
        if($ticket->IMP_TIC==0)
        {
        $psicologia= new EvaPsico;
        $psicologia->FEC_PSI= Carbon::now();
        $psicologia->LUG_NAC= $request->input('lug_nac');
        $psicologia->HIS_PSI= $request->input('his_psi');
        $psicologia->EX1_PSI= $request->input('opciones');
        $psicologia->EX2_PSI= $request->input('opciones1');
        $psicologia->EX3_PSI= $request->input('opciones2');
        $psicologia->EX4_PSI= $request->input('opciones3');
        $psicologia->RFI_PSI= $request->input('rfi_psi');
        $psicologia->ID_MED= Auth::user()->id;
        $psicologia->ID_PAC= $id;
        $psicologia->ID_TIC= $ids;
        $psicologia->save();
        $ticket->IMP_TIC=1;
        $ticket->save();
        }
        if($ticket->IMP_TIC==1)
        {
        $busqueda= EvaPsico::orderBy('created_at','DESC')->where('ID_PAC','=',$id)->first();
        $psicologia= EvaPsico::find($busqueda->id);
        $psicologia->FEC_PSI= Carbon::now();
        $psicologia->LUG_NAC= $request->input('lug_nac');
        $psicologia->HIS_PSI= $request->input('his_psi');
        $psicologia->EX1_PSI= $request->input('opciones');
        $psicologia->EX2_PSI= $request->input('opciones1');
        $psicologia->EX3_PSI= $request->input('opciones2');
        $psicologia->EX4_PSI= $request->input('opciones3');
        $psicologia->RFI_PSI= $request->input('rfi_psi');
        $psicologia->ID_MED= Auth::user()->id;
        $psicologia->ID_PAC= $id;
        $psicologia->ID_TIC= $ids;
        $psicologia->save();
        }
        $pdf = new TCPDF('P','mm','LETTER', true, 'UTF-8', false);
        $pdf->SetTitle('EVALUACION PSICOLOGICA');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetAutoPageBreak(TRUE, 10);
        $pdf->SetMargins(15, 15, 10);
        $pdf->AddPage();


        $pdf->SetFont('','B','9');
        $pdf->SetXY(15, 35);
        $pdf->Write(0,'A) DATOS PERSONALES','','',false);

        $pdf->Line ( 15, 55,55,55,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 65, 55,105,55,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 115, 55,155,55,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 165, 55,205,55,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $paciente=Paciente::where('id','=',$id)->get();
        $pdf->SetXY(20, 57);
        $pdf->SetFont('','B','7');
        $pdf->Write(0,'APELLIDO PATERNO','','',false);
        $pdf->SetXY(70, 57);
        $pdf->Write(0,'APELLIDO MATERNO','','',false);
        $pdf->SetXY(125, 57);
        $pdf->Write(0,'NOMBRES','','',false);
        $pdf->SetXY(180, 57);
        $pdf->Write(0,'CI','','',false);
        $pdf->SetXY(18, 50);
        $pdf->SetFont('','','11');
        $pdf->Write(0,$paciente[0]->APA_PAC,'','',false);
        $pdf->SetXY(67, 50);
        $pdf->SetFont('','','11');
        $pdf->Write(0,$paciente[0]->AMA_PAC,'','',false);
        $pdf->SetXY(123, 50);
        $pdf->SetFont('','','11');
        $pdf->Write(0,$paciente[0]->NOM_PAC,'','',false);
        $pdf->SetXY(170, 50);
        $pdf->SetFont('','','11');
        $pdf->Write(0,$paciente[0]->CI_PAC,'','',false);
        $pdf->SetXY(18, 70);
        $pdf->SetFont('','','11');
        $pdf->Write(0,$request->input('lug_nac').' '.$paciente[0]->FEC_PAC,'','',false);
        $pdf->SetXY(80, 70);
        $pdf->SetFont('','','11');
        $edad = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente[0]->FEC_PAC)->format('Y');
        $edad2 = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente[0]->FEC_PAC)->format('m');
        $edad3 = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente[0]->FEC_PAC)->format('d');
        $date = \Carbon\Carbon::createFromDate($edad,$edad2,$edad3)->age;
        $pdf->Write(0,$date,'','',false);
        $pdf->SetXY(118, 70);
        $pdf->SetFont('','','11');
        $pdf->Write(0,$paciente[0]->PRO_PAC,'','',false);
        $pdf->SetXY(165, 70);
        $pdf->SetFont('','','11');
        $pdf->Write(0,\Carbon\Carbon::now()->format('d-m-Y'),'','',false);
        $pdf->SetXY(18, 90);
        $pdf->SetFont('','','11');
        $pdf->Write(0,$paciente[0]->DOM_PAC,'','',false);
                $pdf->SetXY(157, 90);
        $pdf->SetFont('','','11');
        $pdf->Write(0,$paciente[0]->REF_PAC,'','',false);
        $pdf->SetXY(18, 110);
        $pdf->SetFont('','','10');
        $pdf->Write(0,$request->input('his_psi'),'','',false);


        $pdf->Line ( 15, 75,70,75,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 75, 75,95,75,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 105, 75,150,75,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 160, 75,205,75,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->SetXY(20, 78);
        $pdf->SetFont('','B','7');
        $pdf->Write(0,'LUGAR Y FECHA DE NACIMIENTO','','',false);
        $pdf->SetXY(80, 78);
        $pdf->Write(0,'EDAD','','',false);
        $pdf->SetXY(120, 78);
        $pdf->Write(0,'PROFESION','','',false);
        $pdf->SetXY(165, 78);
        $pdf->Write(0,'FECHA DEL EXAMEN','','',false);
        $pdf->Line ( 16, 95,205,95,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->SetXY(95, 98);
        $pdf->SetFont('','B','7');
        $pdf->Write(0,'DIRECCION','','',false);
        $pdf->SetXY(160, 98);
        $pdf->SetFont('','B','7');
        $pdf->Write(0,'TELEFONO','','',false);
        $pdf->SetFont('','B','9');
        $pdf->SetXY(15, 105);
        $pdf->Write(0,'B) HISTORIA FAMILIAR','','',false);
        $pdf->SetXY(15, 143);
        $pdf->Write(0,'C) EXAMEN PSICOLOGICO','','',false);
        $pdf->SetXY(15, 150);
        $pdf->SetFont('','B','7');
        $pdf->Write(0,'1. Coordinacion visomotora','','',false);
        $pdf->SetXY(15, 165);
        $pdf->Write(0,'2. Personalidad','','',false);
        $pdf->SetXY(15, 180);
        $pdf->Write(0,'3. Atencion, concentracion, memoria y coordinacion','','',false);
        $pdf->SetXY(15, 195);
        $pdf->Write(0,'4. Prueba de reaccion ante situaciones de estres y riesgo','','',false);
        $pdf->SetXY(62, 158);
        $pdf->Write(0,'INADECUADO','','',false);
         $pdf->SetXY(102, 158);
        $pdf->Write(0,'OBSERVACION','','',false);
         $pdf->SetXY(22, 173);
        $pdf->Write(0,'ADECUADO','','',false);
          $pdf->SetXY(62, 173);
        $pdf->Write(0,'INADECUADO','','',false);
          $pdf->SetXY(102, 173);
        $pdf->Write(0,'OBSERVACION','','',false);
         $pdf->SetXY(22, 158);
        $pdf->Write(0,'ADECUADO','','',false);
        $pdf->SetXY(18, 50);
        $pdf->SetFont('','','11');
        if($request->input('opciones')=='ADECUADO'){

            $pdf->SetXY(42, 157);
            $pdf->SetFont('','','11');
            $pdf->Write(0,'X','','',false);
        }
        if($request->input('opciones')=='INADECUADO'){
            $pdf->SetXY(84, 157);
            $pdf->SetFont('','','11');
            $pdf->Write(0,'X','','',false);
        }
        if($request->input('opciones')=='OBSERVACION'){
            $pdf->SetXY(127, 157);
            $pdf->SetFont('','','11');
            $pdf->Write(0,'X','','',false);
        }
        if($request->input('opciones1')=='ADECUADO'){

            $pdf->SetXY(42, 172);
            $pdf->SetFont('','','11');
            $pdf->Write(0,'X','','',false);
        }
        if($request->input('opciones1')=='INADECUADO'){
            $pdf->SetXY(84, 172);
            $pdf->SetFont('','','11');
            $pdf->Write(0,'X','','',false);
        }
        if($request->input('opciones1')=='OBSERVACION'){
            $pdf->SetXY(127, 172);
            $pdf->SetFont('','','11');
            $pdf->Write(0,'X','','',false);
        }
        if($request->input('opciones2')=='ADECUADO'){

            $pdf->SetXY(42, 187);
            $pdf->SetFont('','','11');
            $pdf->Write(0,'X','','',false);
        }
        if($request->input('opciones2')=='INADECUADO'){
            $pdf->SetXY(84, 187);
            $pdf->SetFont('','','11');
            $pdf->Write(0,'X','','',false);
        }
        if($request->input('opciones2')=='OBSERVACION'){
            $pdf->SetXY(127, 187);
            $pdf->SetFont('','','11');
            $pdf->Write(0,'X','','',false);
        }
        if($request->input('opciones3')=='OPTIMO'){

            $pdf->SetXY(42, 202);
            $pdf->SetFont('','','11');
            $pdf->Write(0,'X','','',false);
        }
        if($request->input('opciones3')=='MEDIO'){
            $pdf->SetXY(84, 202);
            $pdf->SetFont('','','11');
            $pdf->Write(0,'X','','',false);
        }
        if($request->input('opciones3')=='INADECUADO'){
            $pdf->SetXY(127, 202);
            $pdf->SetFont('','','11');
            $pdf->Write(0,'X','','',false);
        }
        if($request->input('opciones3')=='OBSERVACION'){
            $pdf->SetXY(167, 202);
            $pdf->SetFont('','','11');
            $pdf->Write(0,'X','','',false);
        }
        $pdf->SetFont('','B','7');
        $pdf->Rect ( 40,155,8,8,'','', '');
        $pdf->Rect ( 82,155,8,8,'','', '');
        $pdf->Rect ( 125,155,8,8,'','', '');
        $pdf->Rect ( 40,170,8,8,'','', '');
        $pdf->Rect ( 82,170,8,8,'','', '');
        $pdf->Rect ( 125,170,8,8,'','', '');
        $pdf->SetXY(22, 188);
        $pdf->Write(0,'ADECUADO','','',false);
        $pdf->SetXY(62, 188);
        $pdf->Write(0,'INADECUADO','','',false);
        $pdf->SetXY(102, 188);
        $pdf->Write(0,'OBSERVACION','','',false);

        $pdf->Rect ( 40,185,8,8,'','', '');
        $pdf->Rect ( 82,185,8,8,'','', '');
        $pdf->Rect ( 125,185,8,8,'','', '');

         $pdf->SetXY(22, 203);
        $pdf->Write(0,'OPTIMO','','',false);
         $pdf->SetXY(62, 203);
        $pdf->Write(0,'MEDIO','','',false);
         $pdf->SetXY(102, 203);
        $pdf->Write(0,'INADECUADO','','',false);
         $pdf->SetXY(142, 203);
        $pdf->Write(0,'OBSERVACION','','',false);

        $pdf->Rect ( 40,200,8,8,'','', '');
        $pdf->Rect ( 82,200,8,8,'','', '');
        $pdf->Rect ( 125,200,8,8,'','', '');
        $pdf->Rect ( 165,200,8,8,'','', '');
         $pdf->SetXY(15, 213);
         $pdf->SetFont('','B','9');
        $pdf->Write(0,'RESULTADO FINAL DE LA EVALUACION PSICOLOGICA','','',false);
        $pdf->SetXY(15, 218);
         $pdf->SetFont('','B','8');
        $pdf->Write(0,'OBSERVACIONES: (EN ESTE ACAPITE INCORPORAR SI EL POSTULANTE ES APTO PARA CONDUCIR VEHICULO, SI NO FUERA APTO INDICAR LOS MOTIVOS)','','',false);
        $pdf->SetXY(30, 229);
        $pdf->SetFont('','BS','9');

        $pdf->MultiCell(148, 4, $request->input('rfi_psi') , 0, 'L', 0, 0, '', '', true);
        $pdf->Line ( 30, 263,70,263,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 80, 263,120,263,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 130, 263,165,263,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
         $pdf->SetXY(30, 265);
         $pdf->SetFont('','B','8');
        $pdf->Write(0,'SELLO CENTRO DE SALUD','','',false);
         $pdf->SetXY(85, 265);
         $pdf->SetFont('','B','8');
        $pdf->Write(0,'SELLO PSICOLOGO/A','','',false);
         $pdf->SetXY(130, 265);
         $pdf->SetFont('','B','8');
        $pdf->Write(0,'FIRMA PSICOLOGO/A','','',false);
        $pdf->SetXY(180,230);
        $pdf->SetFont('','','11');
        $pdf->write2DBarcode ( 'Paciente :'.$paciente[0]->NOM_PAC.' '.$paciente[0]->APA_PAC.' '.$paciente[0]->AMA_PAC.' | Medico: '.Auth::user()->NOM_USU.' '.Auth::user()->APA_USU.' '.Auth::user()->AMA_USU.' | Fecha:'.Carbon::now(), 'QRCODE,M', 181, 230, 30, 30, '','','');
        $pdf->Output('EvaluacionPsicologica.pdf');
    }


 public function pdfoftalmo(Request $request,$id,$ids)
    {   $ticket=Ticket::find($ids);
        if($ticket->IMP_TIC==0)
        {
        $oftalmo= new EvaOftalmo;
        $oftalmo->FEC_OFT= Carbon::now();
        $oftalmo->ULE_OFT= $request->input('opciones');
        $oftalmo->UCV_OFT= $request->input('fec_con');
        $oftalmo->VBI_OFT= $request->input('vbi');
        $oftalmo->SAL_OFT= $request->input('soc');
        $oftalmo->ROD_OFT= $request->input('rod');
        $oftalmo->ROI_OFT= $request->input('roi');
        $oftalmo->ESD_OFT= $request->input('cesd');
        $oftalmo->ESI_OFT= $request->input('cesi');
        $oftalmo->CID_OFT= $request->input('ccid');
        $oftalmo->CII_OFT= $request->input('ccii');
        $oftalmo->EJD_OFT= $request->input('cejd');
        $oftalmo->EJI_OFT= $request->input('ceji');
        $oftalmo->AVD_OFT= $request->input('cavd');
        $oftalmo->AVI_OFT= $request->input('cavi');
        $oftalmo->CDI_OFT= $request->input('cdid');
        $oftalmo->CRC_OFT= $request->input('add');
        $oftalmo->RUS_OFT= $request->input('rus');
        $oftalmo->RMA_OFT= $request->input('rma');
        $oftalmo->OBS_OFT= $request->input('robs');
        $oftalmo->RFO_OFT= $request->input('rfi_psi');
        $oftalmo->ID_MED= Auth::user()->id;
        $oftalmo->ID_PAC= $id;
        $oftalmo->save();
        $ticket->IMP_TIC=1;
        $ticket->save();
        }
        if($ticket->IMP_TIC==1)
        {
        $busqueda= EvaOftalmo::orderBy('created_at','DESC')->where('ID_PAC','=',$id)->first();
        $oftalmo= EvaOftalmo::find($busqueda->id);
        $oftalmo->FEC_OFT= Carbon::now();
        $oftalmo->ULE_OFT= $request->input('opciones');
        $oftalmo->UCV_OFT= $request->input('fec_con');
        $oftalmo->VBI_OFT= $request->input('vbi');
        $oftalmo->SAL_OFT= $request->input('soc');
        $oftalmo->ROD_OFT= $request->input('rod');
        $oftalmo->ROI_OFT= $request->input('roi');
        $oftalmo->ESD_OFT= $request->input('cesd');
        $oftalmo->ESI_OFT= $request->input('cesi');
        $oftalmo->CID_OFT= $request->input('ccid');
        $oftalmo->CII_OFT= $request->input('ccii');
        $oftalmo->EJD_OFT= $request->input('cejd');
        $oftalmo->EJI_OFT= $request->input('ceji');
        $oftalmo->AVD_OFT= $request->input('cavd');
        $oftalmo->AVI_OFT= $request->input('cavi');
        $oftalmo->CDI_OFT= $request->input('cdid');
        $oftalmo->CRC_OFT= $request->input('add');
        $oftalmo->RUS_OFT= $request->input('rus');
        $oftalmo->RMA_OFT= $request->input('rma');
        $oftalmo->OBS_OFT= $request->input('robs');
        $oftalmo->RFO_OFT= $request->input('rfi_psi');
        $oftalmo->ID_MED= Auth::user()->id;
        $oftalmo->ID_PAC= $id;
        $oftalmo->save();
       }
        $medio=array('140','215.9');
        $pdf = new TCPDF('P','mm',$medio, true, 'UTF-8', false);
        $pdf->SetTitle('EVALUACION OFTALMOLOGICA');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetAutoPageBreak(TRUE, 10);
        $pdf->SetMargins(15, 15, 10);
        $pdf->AddPage();
        $pdf->Image('img/Optometria.png', 0, 1, 135, 20, 'PNG', '', '', true, 250, '', false, false, false, false, false, false);

        $pdf->SetFont('','B','9');
        $pdf->SetXY(10, 39);


        $pdf->Line ( 10, 24,45,24,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 53, 24,88,24,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 95, 24,130,24,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 165, 24,205,24,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $paciente=Paciente::where('id','=',$id)->get();
        $pdf->SetXY(15, 25);
        $pdf->SetFont('','B','7');
        $pdf->Write(0,'APELLIDO PATERNO','','',false);
        $pdf->SetXY(55, 25);
        $pdf->Write(0,'APELLIDO MATERNO','','',false);
        $pdf->SetXY(100, 25);
        $pdf->Write(0,'NOMBRES','','',false);
        $pdf->SetXY(165, 25);
        $pdf->Write(0,'CI','','',false);
        $pdf->SetXY(13, 19);
        $pdf->SetFont('','','9');
        $pdf->Write(0,$paciente[0]->APA_PAC,'','',false);
        $pdf->SetXY(55, 19);
        $pdf->SetFont('','','9');
        $pdf->Write(0,$paciente[0]->AMA_PAC,'','',false);
        $pdf->SetXY(95, 19);
        $pdf->SetFont('','','9');
        $pdf->Write(0,$paciente[0]->NOM_PAC,'','',false);

        $pdf->SetXY(15, 30);
        $pdf->SetFont('','','9');
        $pdf->Write(0,$paciente[0]->CI_PAC,'','',false);
        $pdf->SetXY(52, 30);
        $pdf->SetFont('','','9');
        $edad = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente[0]->FEC_PAC)->format('Y');
        $edad2 = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente[0]->FEC_PAC)->format('m');
        $edad3 = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente[0]->FEC_PAC)->format('d');
        $date = \Carbon\Carbon::createFromDate($edad,$edad2,$edad3)->age;
        $pdf->Write(0,$date,'','',false);
        $pdf->SetXY(68, 30);
        $pdf->SetFont('','','9');
        $pdf->Write(0,$paciente[0]->SEX_PAC,'','',false);
        $pdf->SetXY(100, 30);
        $pdf->SetFont('','','9');
        $pdf->Write(0,\Carbon\Carbon::now()->format('d-m-Y'),'','',false);


        $pdf->Line ( 10, 35,45,35,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 50, 35,60,35,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 65, 35,90,35,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 95, 35,130,35,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->SetXY(25, 36);
        $pdf->SetFont('','B','7');
        $pdf->Write(0,'CI','','',false);
        $pdf->SetXY(51, 36);
        $pdf->Write(0,'EDAD','','',false);
        $pdf->SetXY(73, 36);
        $pdf->Write(0,'SEXO','','',false);
        $pdf->SetXY(105, 36);
        $pdf->Write(0,'FECHA','','',false);


        $pdf->SetFont('','','8');
        $pdf->SetXY(10, 45);
        $pdf->Write(0,'USA LENTES','','',false);
        $pdf->SetFont('','','8');
        $pdf->SetXY(10, 53);
        $pdf->Write(0,'ÚLTIMO CONTROL VISUAL','','',false);
        $pdf->SetFont('','','9');
        $pdf->SetXY(58, 53);
        $pdf->Write(0,$request->input('fec_con'),'','',false);
        $pdf->SetXY(45, 45);
        $pdf->Write(0,'SI','','',false);
        $pdf->SetXY(92, 45);
        $pdf->Write(0,'NO','','',false);
        $pdf->Line ( 55, 57,95,57,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->SetFont('','B','9');
        $pdf->SetXY(10, 60);
        $pdf->Write(0,'DIAGNÓSTICO','','',false);
         $pdf->SetFont('','','9');
        $vib=$request->input('vbi');
         $soc=$request->input('soc');
          $rod=$request->input('rod');
           $roi=$request->input('roi');
        $pdf->SetXY(15, 65);
            $html='
            <style>
                .tabla{ font-size:8px;}
                .fila{width:20%;}
                .ref{padding-top: 6px;}
                .ref2{border-top: none;}
            </style>
            <table cellpadding="3" class="tabla" border="1px">
            <tr class="fila" >
                <td width="20%"><b>VISIÓN BINOCULAR</b></td>
                <td width="80%">'.$vib.'</td>
            </tr>
            <tr>
                <td><b>SALUD OCULAR</b></td>
                <td> '.$soc.'</td>

            </tr>
            <tr >
                <td class"ref" rowspan="2"><b>REFRACTIVO</b></td>
                 <td><b>OD </b> '.$rod.'</td>
            </tr>
            <tr rowspan="2">

                 <td><b>OI</b> '.$roi.'</td>
            </tr>
            </table>';
            $pdf->writeHTML($html, true, false, true, false, '');
            $pdf->SetXY(15, 105);
            $cesd= $request->input('cesd');
            $ccid= $request->input('ccid');
            $cejd= $request->input('cejd');
            $cavd= $request->input('cavd');
            $cdid= $request->input('cdid');
            $cesi= $request->input('cesi');
            $ccii= $request->input('ccii');
            $ceji= $request->input('ceji');
            $cavi= $request->input('cavi');

        $html2='
           <style>
                .tabla{ font-size:8px;}
                .fila{width:10%;}
            </style>
            <table cellpadding="3" class="tabla" border="1px">
            <tr class="fila" >
                <td width="15%"></td>
                <td>Esfera</td>
                <td>Cilindro</td>
                <td>Eje</td>
                <td>A.V.</td>
                <td>DIP</td>
            </tr>
            <tr>
                <td>OD</td>
                <td>'.$cesd.'</td>
                <td>'.$ccid.'</td>
                <td>'.$cejd.'</td>
                <td>'.$cavd.'</td>
                <td rowspan="2">'.$cdid.'</td>
            </tr>
            <tr>
                <td>OI</td>
                <td>'.$cesi.'</td>
                <td>'.$ccii.'</td>
                <td>'.$ceji.'</td>

                <td>'.$cavi.'</td>
            </tr>
            </table>';
            $add=$request->input('add');
            $pdf->writeHTML($html2, true, false, true, false, '');
          $pdf->SetFont('','B','7');
        $pdf->SetXY(10, 100);
        $pdf->Write(0,'CORRECCIÓN REFRACTIVA LEJOS:','','',false);
          $pdf->SetFont('','B','7');
        $pdf->SetXY(45, 125);
        $pdf->Write(0,'CORRECCIÓN REFRACTIVA CERCA:','','',false);
          $pdf->SetFont('','B','8');
          $pdf->SetXY(95, 125);
            $html3='
           <style>
                .tabla{ font-size:8px;}
                .fila{width:10%;}
            </style>
            <table cellpadding="3" class="tabla" border="1px">
            <tr class="fila" >
                <td width="25%"><b>ADD</b></td>
                <td width="80">'.$add.'</td>

            </tr>

            </table>';
            $pdf->writeHTML($html3, true, false, true, false, '');
        $pdf->SetXY(15, 140);
        $pdf->Write(0,'RECOMENDACIONES:','','',false);
        $pdf->SetFont('','B','8');
        $pdf->SetXY(15, 147);
        $pdf->Write(0,'USO:','','',false);
        $pdf->SetFont('','','8');
        $pdf->SetXY(45, 147);
        $pdf->Write(0,$request->input('rus'),'','',false);
        $pdf->SetXY(45, 161);
        $pdf->Write(0,$request->input('robs'),'','',false);
        $pdf->SetFont('','B','8');
        $pdf->SetXY(15, 154);
        $pdf->Write(0,'MATERIAL:','','',false);
        $pdf->SetFont('','','8');
        $pdf->SetXY(45, 154);
        $pdf->Write(0,$request->input('rma'),'','',false);
        $pdf->SetFont('','B','8');
        $pdf->SetXY(15, 161);
        $pdf->Write(0,'OBSERVACIONES:','','',false);
        if($request->input('opciones')=='NO'){
            $pdf->SetXY(102, 45);
            $pdf->SetFont('','B','11');
            $pdf->Write(0,'X','','',false);
        }
        if($request->input('opciones')=='SI'){
            $pdf->SetXY(55.5, 45);
            $pdf->SetFont('','','11');
            $pdf->Write(0,'X','','',false);
        }
        $pdf->SetFont('','B','7');
        $pdf->Rect ( 55,45,5,5,'','', '');
        $pdf->Rect ( 102,45,5,5,'','', '');

         $pdf->SetXY(15, 168);
         $pdf->SetFont('','B','8');
        $pdf->Write(0,'RESULTADO FINAL DE LA EVALUACION VISUAL','','',false);
        $pdf->SetXY(25, 175);
         $pdf->SetFont('','UB','9');
         $pdf->Write(0,$request->input('rfi_psi'),'','',false);
         $pdf->SetXY(10, 202);
         $pdf->SetFont('','B','7');
        $pdf->Write(0,'SELLO CENTRO DE SALUD','','',false);

         $pdf->SetXY(60, 202);
         $pdf->SetFont('','B','7');
        $pdf->Write(0,'SELLO FIRMA EVALUADOR/A','','',false);
        $pdf->SetXY(180,180);
        $pdf->SetFont('','','11');
        $pdf->write2DBarcode ( 'Paciente :'.$paciente[0]->NOM_PAC.' '.$paciente[0]->APA_PAC.' '.$paciente[0]->AMA_PAC.' | Optometra: '.Auth::user()->NOM_USU.' '.Auth::user()->APA_USU.' '.Auth::user()->AMA_USU.' | Fecha:'.Carbon::now().'|Dar salud| Ev.'.$oftalmo->id, 'QRCODE,M', 110, 185, 25, 25, '','','');
        $pdf->Output('EvaluacionOftalmologica.pdf');
    }

    public function pdfotorrino(Request $request,$id,$ids)
    {   $ticket=Ticket::find($ids);
        if($ticket->IMP_TIC==0)
        {
        $otorrino= new EvaOto;
        $otorrino->FEC_OTO= Carbon::now();
        $otorrino->LUG_NAC= $request->input('lug_nac');
        $otorrino->ANT_OTO= $request->input('ant_oto');
        $otorrino->EFI_OTO= $request->input('efi_oto');
        $otorrino->CON_OTO= $request->input('con_oto');
        $otorrino->RFI_OTO= $request->input('rfi_oto');
        $otorrino->ID_MED= Auth::user()->id;
        $otorrino->ID_PAC= $id;
        $otorrino->save();
        $ticket->IMP_TIC=1;
        $ticket->save();
        }
        $pac=$id;
        if($ticket->IMP_TIC==1)
        {
            $busqueda= EvaOto::orderBy('created_at','DESC')->where('ID_PAC','=',$pac)->first();
            $otorrino2= EvaOto::find($busqueda->id);
            $otorrino2->FEC_OTO= Carbon::now();
            $otorrino2->LUG_NAC= $request->input('lug_nac');
            $otorrino2->ANT_OTO= $request->input('ant_oto');
            $otorrino2->EFI_OTO= $request->input('efi_oto');
            $otorrino2->CON_OTO= $request->input('con_oto');
            $otorrino2->RFI_OTO= $request->input('rfi_oto');
            $otorrino2->ID_MED= Auth::user()->id;
            $otorrino2->ID_PAC= $id;
            $otorrino2->save();
        }

        $pdf = new TCPDF('P','mm','LETTER', true, 'UTF-8', false);
        $pdf->SetTitle('EVALUACION OTORRINOLARINGOLOGICA');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetAutoPageBreak(TRUE, 10);
        $pdf->SetMargins(15, 15, 10);
        $pdf->AddPage();


        $pdf->SetFont('','B','9');
        $pdf->SetXY(15, 42);
        $pdf->Write(0,'A) DATOS PERSONALES','','',false);

        $pdf->Line ( 15, 55,55,55,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 65, 55,105,55,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 115, 55,155,55,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 165, 55,200,55,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $paciente=Paciente::where('id','=',$id)->get();
        $pdf->SetXY(20, 57);
        $pdf->SetFont('','B','7');
        $pdf->Write(0,'APELLIDO PATERNO','','',false);
        $pdf->SetXY(70, 57);
        $pdf->Write(0,'APELLIDO MATERNO','','',false);
        $pdf->SetXY(125, 57);
        $pdf->Write(0,'NOMBRES','','',false);
        $pdf->SetXY(180, 57);
        $pdf->Write(0,'CI','','',false);
        $pdf->SetXY(18, 50);
        $pdf->SetFont('','','11');
        $pdf->Write(0,$paciente[0]->APA_PAC,'','',false);
        $pdf->SetXY(67, 50);
        $pdf->SetFont('','','11');
        $pdf->Write(0,$paciente[0]->AMA_PAC,'','',false);
        $pdf->SetXY(123, 50);
        $pdf->SetFont('','','11');
        $pdf->Write(0,$paciente[0]->NOM_PAC,'','',false);
        $pdf->SetXY(170, 50);
        $pdf->SetFont('','','11');
        $pdf->Write(0,$paciente[0]->CI_PAC,'','',false);
        $pdf->SetXY(18, 70);
        $pdf->SetFont('','','11');
        $pdf->Write(0,$request->input('lug_nac').' '.$paciente[0]->FEC_PAC,'','',false);
        $pdf->SetXY(80, 70);
        $pdf->SetFont('','','11');
        $edad = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente[0]->FEC_PAC)->format('Y');
        $edad2 = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente[0]->FEC_PAC)->format('m');
        $edad3 = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente[0]->FEC_PAC)->format('d');
        $date = \Carbon\Carbon::createFromDate($edad,$edad3,$edad2)->age;
        $pdf->Write(0,$date,'','',false);
        $pdf->SetXY(118, 70);
        $pdf->SetFont('','','11');
        $pdf->Write(0,$paciente[0]->PRO_PAC,'','',false);
        $pdf->SetXY(165, 70);
        $pdf->SetFont('','','11');
        $pdf->Write(0,\Carbon\Carbon::now()->format('d-m-Y'),'','',false);
        $pdf->SetXY(18, 90);
        $pdf->SetFont('','','11');
        $pdf->Write(0,$paciente[0]->DOM_PAC,'','',false);
        $pdf->SetXY(170, 90);
        $pdf->SetFont('','','11');
        $pdf->Write(0,$paciente[0]->REF_PAC,'','',false);
        $pdf->SetXY(18, 110);
        $pdf->SetFont('','','10');
        $pdf->Write(0,$request->input('ant_oto'),'','',false);
        $pdf->Line ( 15, 75,70,75,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 75, 75,95,75,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 105, 75,150,75,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 160, 75,200,75,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->SetXY(20, 78);
        $pdf->SetFont('','B','7');
        $pdf->Write(0,'LUGAR Y FECHA DE NACIMIENTO','','',false);
        $pdf->SetXY(80, 78);
        $pdf->Write(0,'EDAD','','',false);
        $pdf->SetXY(120, 78);
        $pdf->Write(0,'PROFESION','','',false);
        $pdf->SetXY(165, 78);
        $pdf->Write(0,'FECHA DEL EXAMEN','','',false);
        $pdf->Line ( 16, 95,150,95,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
         $pdf->Line ( 160, 95,200,95,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->SetXY(70, 98);
        $pdf->SetFont('','B','7');
        $pdf->Write(0,'DIRECCION','','',false);
         $pdf->SetXY(175, 98);
        $pdf->SetFont('','B','7');
        $pdf->Write(0,'TELEFONO','','',false);
        $pdf->SetFont('','B','9');
        $pdf->SetXY(15, 105);
        $pdf->Write(0,'B) ANTECEDENTES','','',false);
        $pdf->SetXY(15, 143);
        $pdf->Write(0,'C) EXAMEN FISICO','','',false);
        $pdf->SetXY(15, 173);
        $pdf->Write(0,'D) CONCLUSION','','',false);
        $pdf->SetXY(18, 148);
        $pdf->SetFont('','','10');
        $pdf->Write(0,$request->input('efi_oto'),'','',false);
        $pdf->SetXY(18, 178);
        $pdf->SetFont('','','10');
        $pdf->Write(0,$request->input('con_oto'),'','',false);
        $pdf->SetFont('','B','7');

         $pdf->SetXY(15, 213);
         $pdf->SetFont('','B','9');
        $pdf->Write(0,'RESULTADO FINAL DE LA EVALUACION OTORRINOLARINGOLOGICA','','',false);
        $pdf->SetXY(15, 218);
         $pdf->SetFont('','B','8');
        $pdf->Write(0,'OBSERVACIONES: (EN ESTE ACAPITE INCORPORAR SI EL POSTULANTE ES APTO PARA CONDUCIR VEHICULO, SI NO FUERA APTO INDICAR LOS MOTIVOS)','','',false);
        $pdf->SetXY(15, 227);
        $pdf->SetFont('','S','9');
        $pdf->Write(0,$request->input('rfi_oto'),'','',false);
        $pdf->Line ( 30, 263,70,263,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 80, 263,120,263,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 130, 263,165,263,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
         $pdf->SetXY(30, 265);
         $pdf->SetFont('','B','8');
        $pdf->Write(0,'SELLO CENTRO DE SALUD','','',false);
         $pdf->SetXY(75, 265);
         $pdf->SetFont('','B','8');
        $pdf->Write(0,'SELLO OTORRINOLARINGOLOGIA','','',false);
         $pdf->SetXY(125, 265);
         $pdf->SetFont('','B','8');
        $pdf->Write(0,'FIRMA OTORRINOLARINGOLOGIA','','',false);
        $pdf->SetXY(180,230);
        $pdf->SetFont('','','11');
        $pdf->write2DBarcode ( 'Paciente :'.$paciente[0]->NOM_PAC.' '.$paciente[0]->APA_PAC.' '.$paciente[0]->AMA_PAC.' | Medico: '.Auth::user()->NOM_USU.' '.Auth::user()->APA_USU.' '.Auth::user()->AMA_USU.' | Fecha:'.Carbon::now().' | DARSALUD', 'QRCODE,M', 170, 230, 30, 30, '','','');
        $pdf->Output('EvaluacionOtorrino.pdf');
    }
    public function pdfmedi(Request $request,$id,$ids)
    {
        $sw=0;
        if(isset($_POST['guardar'])){
        $ticket=Ticket::find($ids);
        $comprueba= EvaMedi::where('ID_TIC','=',$ids)->first();

        if($comprueba){
        $idmed=$comprueba->id;
        $medica= EvaMedi::find($idmed);
        }else{
        $medica= new EvaMedi;
        }
        $medica->FEC_MED= Carbon::now();
        $medica->LUG_MED= $request->input('lug_med');
        $paciente= Paciente::find($id);
        if ($request->input('img')):
          $foto=Carbon::now()->format('d-m-Y').'-'.preg_replace('[\s+]','',$paciente->CI_PAC).'.png';
          $medica->FOT_PAC= $foto;
          //$medica->IMG_MED= $request->input('img');
          $base=$request->input('img');
          $base_php=explode(',',$base);
          $data= base64_decode($base_php[1]);
          \Storage::disk('local')->put($foto, $data);
          $sw=1;
        endif;
        if ($request->input('img2') && $sw==0):
          $foto=Carbon::now()->format('d-m-Y').'-'.preg_replace('[\s+]','',$paciente->CI_PAC).'.png';
          //$medica->IMG_MED= $request->input('img2');
          $medica->FOT_PAC= $foto;
          $base=$request->input('img2');
          $base_php=explode(',',$base);
          $data= base64_decode($base_php[1]);
          \Storage::disk('local')->put($foto, $data);
          $sw=0;
        endif;
        $medica->ACO_MED= $request->input('aco_med');
        $medica->APA_MED= $request->input('apa_med');
        $medica->HBE_MED= $request->input('opciones');
        $medica->HFU_MED= $request->input('opciones2');
        $medica->VAM_MED= $request->input('opciones3');
        $medica->VTE_MED= $request->input('opciones4');
        $medica->GSA_MED= $request->input('gsa_med').' '.$request->input('rh_med');
        $medica->SIG_MED= $request->input('sig_med');
        $medica->TEM_MED= $request->input('tem_med');
        $medica->PRE_MED= $request->input('pre_med');
        $medica->ESP_MED= $request->input('esp_med');
        $medica->FRC_MED= $request->input('frc_med');
        $medica->OBS_MED= $request->input('obs_med');
        $medica->OBI_MED= $request->input('obi_med');
        $medica->FRR_MED= $request->input('frr_med');
        $medica->SOM_MED= $request->input('som_med');
        $medica->TAL_MED= $request->input('tal_med');
        $medica->PES_MED= $request->input('pes_med');
        $medica->ECA_MED= $request->input('eca_med');
        $medica->ECU_MED= $request->input('ecu_med');
        $medica->ECR_MED= $request->input('ecr_med');
        $medica->EGO_MED= $request->input('ego_med');
        $medica->MOC_MED= $request->input('moc_med');
        $medica->REC_MED= $request->input('rec_med');
        $medica->ETR_MED= $request->input('opciones5');
        $medica->LEN_MED= $request->input('opciones6');
        $medica->CAM_MED= $request->input('cam_med');
        $medica->COL_MED= $request->input('col_med');
        $medica->VPR_MED= $request->input('vpr_med');
        $medica->ALD_MED= $request->input('ald_med');
        $medica->ASD_MED= $request->input('asd_med');
        $medica->ALI_MED= $request->input('ali_med');
        $medica->ASI_MED= $request->input('asi_med');
        $medica->ACI_MED= $request->input('aci_med');
        $medica->ACD_MED= $request->input('acd_med');
        $medica->EOE_MED= $request->input('eoe_med');
        $medica->OTO_MED= $request->input('oto_med');
        $medica->TWE_MED= $request->input('twe_med');
        $medica->TRI_MED= $request->input('tri_med');
        $medica->EXT_MED= $request->input('ext_med');
        $medica->EXC_MED= $request->input('exc_med');
        $medica->EXA_MED= $request->input('exa_med');
        $medica->TRS_MED= $request->input('trs_med');
        $medica->TMS_MED= $request->input('tms_med');
        $medica->FMS_MED= $request->input('fms_med');
        $medica->TIN_MED= $request->input('tin_med');
        $medica->TMI_MED= $request->input('tmi_med');
        $medica->FMI_MED= $request->input('fmi_med');
        $medica->CMA_MED= $request->input('cma_med');
        $medica->REF_MED= $request->input('ref_med');
        $medica->PTR_MED= $request->input('ptr_med');
        $medica->PDN_MED= $request->input('pdn_med');
        $medica->PRG_MED= $request->input('prg_med');
        $medica->FAM_MED= $request->input('fam_med');
        $medica->REE_MED= $request->input('opciones7');
        $medica->MRE_MED= $request->input('mre_med');
        $medica->REV_MED= $request->input('rev_med');
        $medica->REP_MED= $request->input('opciones8');
        $medica->RFI_MED= $request->input('rfi_med');
        $medica->RFS_MED= $request->input('rfs_med');
        $medica->RFT_MED= $request->input('rft_med');
        $medica->APT_MED= $request->input('apt_med');
        $medica->MNA_MED= $request->input('mna_med');
        $medica->ID_USU= Auth::user()->id;
        $medica->ID_PAC= $id;
        $medica->ID_TIC= $ticket->id;
        $medica->save();
        $ticket->EST_TIC=4;
        $ticket->IMP_TIC=1;
        $ticket->save();
        $mensaje="El paciente fue marcado como pendiente";
        $reservas= Reserva::join('ticket','ticket.id','=','ID_TIC')->join('pacientes','pacientes.id','=','ticket.ID_PAC')->join('users','users.id','=','ticket.ID_MED')->where('EST_TIC','!=',2)->where('ID_MED','=',Auth::user()->id)->get();
       return redirect()->route('/')->with('reservas',$reservas)->with('mensaje2',$mensaje);
       }
        if(isset($_POST['imprimir'])){
        $ticket=Ticket::find($ids);
        if($ticket->IMP_TIC==0)
        {
        $medica= new EvaMedi;
        $medica->FEC_MED= Carbon::now();
        $medica->LUG_MED= $request->input('lug_med');
        $paciente= Paciente::find($id);
        $foto=Carbon::now()->format('d-m-Y').'-'.preg_replace('[\s+]','',$paciente->CI_PAC).'.png';
        $medica->FOT_PAC= $foto;
        if ($request->input('img')):
          $base=$request->input('img');
          //$medica->IMG_MED= $request->input('img');
          $base_php=explode(',',$base);
          $data= base64_decode($base_php[1]);
          \Storage::disk('local')->put($foto, $data);
          $sw=1;
        endif;
        if ($request->input('img2')&& $sw==0):
          $base=$request->input('img2');
          //$medica->IMG_MED= $request->input('img2');
          $base_php=explode(',',$base);
          $data= base64_decode($base_php[1]);
          \Storage::disk('local')->put($foto, $data);
          $sw=0;
        endif;
        $medica->ACO_MED= $request->input('aco_med');
        $medica->APA_MED= $request->input('apa_med');
        $medica->HBE_MED= $request->input('opciones');
        $medica->HFU_MED= $request->input('opciones2');
        $medica->VAM_MED= $request->input('opciones3');
        $medica->VTE_MED= $request->input('opciones4');
        $medica->GSA_MED= $request->input('gsa_med').' '.$request->input('rh_med');
        $medica->SIG_MED= $request->input('sig_med');
        $medica->TEM_MED= $request->input('tem_med');
        $medica->PRE_MED= $request->input('pre_med');
        $medica->FRC_MED= $request->input('frc_med');
        $medica->FRR_MED= $request->input('frr_med');
        $medica->SOM_MED= $request->input('som_med');
        $medica->TAL_MED= $request->input('tal_med');
        $medica->PES_MED= $request->input('pes_med');
        $medica->ECA_MED= $request->input('eca_med');
        $medica->ECU_MED= $request->input('ecu_med');
        $medica->ECR_MED= $request->input('ecr_med');
        $medica->EGO_MED= $request->input('ego_med');
        $medica->MOC_MED= $request->input('moc_med');
        $medica->REC_MED= $request->input('rec_med');
        $medica->ETR_MED= $request->input('opciones5');
        $medica->LEN_MED= $request->input('opciones6');
        $medica->ESP_MED= $request->input('esp_med');
        $medica->CAM_MED= $request->input('cam_med');
        $medica->COL_MED= $request->input('col_med');
        $medica->VPR_MED= $request->input('vpr_med');
        $medica->ALD_MED= $request->input('ald_med');
        $medica->ASD_MED= $request->input('asd_med');
        $medica->ALI_MED= $request->input('ali_med');
        $medica->ASI_MED= $request->input('asi_med');
        $medica->ACI_MED= $request->input('aci_med');
        $medica->ACD_MED= $request->input('acd_med');
        $medica->OBS_MED= $request->input('obs_med');
        $medica->OBI_MED= $request->input('obi_med');
        $medica->EOE_MED= $request->input('eoe_med');
        $medica->OTO_MED= $request->input('oto_med');
        $medica->TWE_MED= $request->input('twe_med');
        $medica->TRI_MED= $request->input('tri_med');
        $medica->EXT_MED= $request->input('ext_med');
        $medica->EXC_MED= $request->input('exc_med');
        $medica->EXA_MED= $request->input('exa_med');
        $medica->TRS_MED= $request->input('trs_med');
        $medica->TMS_MED= $request->input('tms_med');
        $medica->FMS_MED= $request->input('fms_med');
        $medica->TIN_MED= $request->input('tin_med');
        $medica->TMI_MED= $request->input('tmi_med');
        $medica->FMI_MED= $request->input('fmi_med');
        $medica->CMA_MED= $request->input('cma_med');
        $medica->REF_MED= $request->input('ref_med');
        $medica->PTR_MED= $request->input('ptr_med');
        $medica->PDN_MED= $request->input('pdn_med');
        $medica->PRG_MED= $request->input('prg_med');
        $medica->FAM_MED= $request->input('fam_med');
        $medica->REE_MED= $request->input('opciones7');
        $medica->MRE_MED= $request->input('mre_med');
        $medica->REV_MED= $request->input('rev_med');
        $medica->REP_MED= $request->input('opciones8');
        $medica->RFI_MED= $request->input('rfi_med');
        $medica->RFS_MED= $request->input('rfs_med');
        $medica->RFT_MED= $request->input('rft_med');
        $medica->APT_MED= $request->input('apt_med');
        $medica->MNA_MED= $request->input('mna_med');
        $medica->ID_USU= Auth::user()->id;
        $medica->ID_PAC= $id;
        $medica->ID_TIC=$ids;
        $medica->save();
        $ticket->IMP_TIC=1;
        $ticket->save();
        }
        $pac=$id;
        if($ticket->IMP_TIC==1)
        {
        $busqueda= EvaMedi::orderBy('created_at','DESC')->where('ID_PAC','=',$pac)->first();
        $medica= EvaMedi::find($busqueda->id);
        $medica->FEC_MED= Carbon::now();
        $medica->LUG_MED= $request->input('lug_med');
        $paciente= Paciente::find($id);
        $foto=Carbon::now()->format('d-m-Y').'-'.preg_replace('[\s+]','',$paciente->CI_PAC).'.png';
        $medica->FOT_PAC= $foto;
        if ($request->input('img')):
          $base=$request->input('img');
          $base_php=explode(',',$base);
          //$medica->IMG_MED= $request->input('img');
          $data= base64_decode($base_php[1]);
          \Storage::disk('local')->put($foto, $data);
          $sw=1;
        endif;

        if ($request->input('img2') && $sw==0):
          $base=$request->input('img2');
          //$medica->IMG_MED= $request->input('img2');
          $base_php=explode(',',$base);
          $data= base64_decode($base_php[1]);
          \Storage::disk('local')->put($foto, $data);
          $sw=0;
        endif;
        $medica->ACO_MED= $request->input('aco_med');
        $medica->APA_MED= $request->input('apa_med');
        $medica->HBE_MED= $request->input('opciones');
        $medica->HFU_MED= $request->input('opciones2');
        $medica->VAM_MED= $request->input('opciones3');
        $medica->VTE_MED= $request->input('opciones4');
        $medica->GSA_MED= $request->input('gsa_med').' '.$request->input('rh_med');
        $medica->SIG_MED= $request->input('sig_med');
        $medica->TEM_MED= $request->input('tem_med');
        $medica->PRE_MED= $request->input('pre_med');
        $medica->ESP_MED= $request->input('esp_med');
        $medica->FRC_MED= $request->input('frc_med');
        $medica->OBS_MED= $request->input('obs_med');
        $medica->OBI_MED= $request->input('obi_med');
        $medica->FRR_MED= $request->input('frr_med');
        $medica->SOM_MED= $request->input('som_med');
        $medica->TAL_MED= $request->input('tal_med');
        $medica->PES_MED= $request->input('pes_med');
        $medica->ECA_MED= $request->input('eca_med');
        $medica->ECU_MED= $request->input('ecu_med');
        $medica->ECR_MED= $request->input('ecr_med');
        $medica->EGO_MED= $request->input('ego_med');
        $medica->MOC_MED= $request->input('moc_med');
        $medica->REC_MED= $request->input('rec_med');
        $medica->ETR_MED= $request->input('opciones5');
        $medica->LEN_MED= $request->input('opciones6');
        $medica->CAM_MED= $request->input('cam_med');
        $medica->COL_MED= $request->input('col_med');
        $medica->VPR_MED= $request->input('vpr_med');
        $medica->ALD_MED= $request->input('ald_med');
        $medica->ASD_MED= $request->input('asd_med');
        $medica->ALI_MED= $request->input('ali_med');
        $medica->ASI_MED= $request->input('asi_med');
        $medica->ACI_MED= $request->input('aci_med');
        $medica->ACD_MED= $request->input('acd_med');
        $medica->EOE_MED= $request->input('eoe_med');
        $medica->OTO_MED= $request->input('oto_med');
        $medica->TWE_MED= $request->input('twe_med');
        $medica->TRI_MED= $request->input('tri_med');
        $medica->EXT_MED= $request->input('ext_med');
        $medica->EXC_MED= $request->input('exc_med');
        $medica->EXA_MED= $request->input('exa_med');
        $medica->TRS_MED= $request->input('trs_med');
        $medica->TMS_MED= $request->input('tms_med');
        $medica->FMS_MED= $request->input('fms_med');
        $medica->TIN_MED= $request->input('tin_med');
        $medica->TMI_MED= $request->input('tmi_med');
        $medica->FMI_MED= $request->input('fmi_med');
        $medica->CMA_MED= $request->input('cma_med');
        $medica->REF_MED= $request->input('ref_med');
        $medica->PTR_MED= $request->input('ptr_med');
        $medica->PDN_MED= $request->input('pdn_med');
        $medica->PRG_MED= $request->input('prg_med');
        $medica->FAM_MED= $request->input('fam_med');
        $medica->REE_MED= $request->input('opciones7');
        $medica->MRE_MED= $request->input('mre_med');
        $medica->REV_MED= $request->input('rev_med');
        $medica->REP_MED= $request->input('opciones8');
        $medica->RFI_MED= $request->input('rfi_med');
        $medica->RFS_MED= $request->input('rfs_med');
        $medica->RFT_MED= $request->input('rft_med');
        $medica->APT_MED= $request->input('apt_med');
        $medica->MNA_MED= $request->input('mna_med');
        $medica->ID_USU= Auth::user()->id;
        $medica->ID_PAC= $id;
        $medica->save();
        }

        $pdf = new TCPDF('P','mm','LETTER', true, 'UTF-8', false);
        $pdf->SetTitle('EVALUACION MEDICA');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetAutoPageBreak(TRUE, 10);
        $pdf->SetMargins(15, 15, 10);
        $pdf->AddPage();

        $pdf->Line ( 20, 50,55,50,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 60, 50,95,50,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 105, 50,155,50,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 20, 63,55,63,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $paciente=Paciente::where('id','=',$id)->get();
        $pdf->SetXY(24, 51);
        $pdf->SetFont('','B','7');
        $pdf->Write(0,'APELLIDO PATERNO','','',false);
        $pdf->SetXY(64, 51);
        $pdf->Write(0,'APELLIDO MATERNO','','',false);
        $pdf->SetXY(120, 51);
        $pdf->Write(0,'NOMBRES','','',false);
        $pdf->SetXY(34, 64);
        $pdf->Write(0,'CI','','',false);
        $pdf->SetXY(21, 44);
        if(strlen($paciente[0]->APA_PAC)>15):
          $pdf->SetFont('','','8');
        else:
          $pdf->SetFont('','','10');
        endif;
        $pdf->Write(0,$paciente[0]->APA_PAC,'','',false);
        $pdf->SetXY(61, 44);
        if(strlen($paciente[0]->AMA_PAC)>15):
          $pdf->SetFont('','','8');
        else:
          $pdf->SetFont('','','10');
        endif;
        $pdf->Write(0,$paciente[0]->AMA_PAC,'','',false);
        $pdf->SetXY(105, 44);
        if(strlen($paciente[0]->NOM_PAC)>20):
          $pdf->SetFont('','','8');
        else:
          $pdf->SetFont('','','10');
        endif;
        $pdf->Write(0,$paciente[0]->NOM_PAC,'','',false);
        $pdf->SetXY(25, 57);
        $pdf->SetFont('','','10');
        $pdf->Write(0,$paciente[0]->CI_PAC,'','',false);
        $pdf->SetXY(62, 57);
        $pdf->SetFont('','','10');
        $edad = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente[0]->FEC_PAC)->format('Y');
        $edad2 = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente[0]->FEC_PAC)->format('m');
        $edad3 = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente[0]->FEC_PAC)->format('d');
        $date = \Carbon\Carbon::createFromDate($edad,$edad2,$edad3)->age;
        $pdf->Write(0,$date,'','',false);
        $pacientes= Paciente::find($id);
        //$htmla='<img width="40px" height="40px" src="../public/storage/abc.jpg'.'"/>';
        //dd($html5);
        //$pdf->SetXY(170,40);
        //$pdf->writeHTML($htmla, true, false, true, false, '');
        //$imgdata= base64_decode($request->input('img2'));
        //dd($imgdata);
        //$pdf->Image('@'.$imgdata,170,40,35,35);
        //$image='../public/storage/15-11-2017-1234565LP.jpg';
        //dd($medica->FOT_PAC);
        $pdf->Image('storage/'.$medica->FOT_PAC, 170, 40, 35, 35, 'PNG', '', '', true, 250, '', false, false, false, false, false, false);
        //$pdf->Image(rtrim($image), 170, 40, 35, 35,'JPG');
        //dd($asd);
        $pdf->SetXY(110, 57);
        $pdf->SetFont('','','10');
        $pdf->Write(0,$request->input('lug_med').'   '.\Carbon\Carbon::now()->format('d-m-Y'),'','',false);

        $pdf->SetXY(18, 110);
        $pdf->SetFont('','','10');
        $pdf->Write(0,$request->input('ant_oto'),'','',false);
        $pdf->Line ( 75, 63,95,63,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 60, 63,70,63,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 105, 63,155,63,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));

        $pdf->SetXY(74, 57);
        $pdf->SetFont('','','10');
        $pdf->Write(0,$paciente[0]->SEX_PAC,'','',false);
        $pdf->SetFont('','B','7');
        $pdf->SetXY(61, 64);
        $pdf->Write(0,'EDAD','','',false);
        $pdf->SetXY(80, 64);
        $pdf->Write(0,'SEXO','','',false);
        $pdf->SetXY(110, 64);
        $pdf->Write(0,'LUGAR Y FECHA DEL EXAMEN','','',false);

        $pdf->SetFont('','B','9');
        $pdf->SetXY(15, 75);
        $pdf->Write(0,'I. ANTECEDENTES','','',false);
        $pdf->SetXY(10, 80);
        $pdf->Write(0,'Antecedentes relacionados con la conduccion:','','',false);
        $pdf->SetXY(85, 80);
        $pdf->SetFont('','','9');
        $pdf->MultiCell(115, 2, $request->input('aco_med') , 0, 'L', 0, 0, '', '', true);
        $pdf->SetXY(80, 98);
        $pdf->SetFont('','','9');
        $pdf->MultiCell(115, 2, $request->input('apa_med') , 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('','B','5');
        $pdf->SetXY(76, 142);
        $pdf->Write(0,'SI','','',false);
        $pdf->SetXY(86, 142);
        $pdf->Write(0,'NO','','',false);
        $pdf->SetXY(186, 142);
        $pdf->Write(0,'SI','','',false);
        $pdf->SetXY(196, 142);
        $pdf->Write(0,'NO','','',false);

        $pdf->SetFont('','B','9');
        $pdf->SetXY(10, 98);
        $pdf->Write(0,'Antecedentes personales patológicos:','','',false);

        $pdf->SetFont('','','9');

        $pdf->SetXY(55, 152);
        $pdf->Write(0,$request->input('sig_med'),'','',false);
        $pdf->SetXY(105, 152);
        $pdf->Write(0,$request->input('tem_med').' °C','','',false);
        $pdf->SetXY(170, 152);
        $pdf->Write(0,$request->input('pre_med').' mmHg','','',false);
        $pdf->SetXY(75, 160);
        $pdf->Write(0,$request->input('frc_med').' x min','','',false);
        $pdf->SetXY(170, 160);
        $pdf->Write(0,$request->input('frr_med').' x min','','',false);
        $pdf->SetXY(55, 168);
        $pdf->Write(0,$request->input('som_med'),'','',false);
        $pdf->SetXY(115, 168);
        $pdf->Write(0,$request->input('tal_med').' cms','','',false);
        $pdf->SetXY(180, 168);
        $pdf->Write(0,$request->input('pes_med').' Kg','','',false);
        $pdf->SetXY(40, 185);
        $pdf->Write(0,$request->input('eca_med'),'','',false);
        $pdf->SetXY(40, 190);
        $pdf->Write(0,$request->input('ecr_med'),'','',false);
        $pdf->SetXY(40, 195);
        $pdf->Write(0,$request->input('ecu_med'),'','',false);
         $pdf->SetXY(130, 203);
        $pdf->Write(0,$request->input('ego_med'),'','',false);
         $pdf->SetXY(130, 210);
        $pdf->Write(0,$request->input('moc_med'),'','',false);
         $pdf->SetXY(130, 217);
        $pdf->Write(0,$request->input('rec_med'),'','',false);
         $pdf->SetXY(120, 238);
        $pdf->Write(0,$request->input('cam_med'),'','',false);
         $pdf->SetXY(180, 238);
        $pdf->Write(0,$request->input('col_med'),'','',false);
         $pdf->SetXY(150, 245);
        $pdf->Write(0,$request->input('vpr_med'),'','',false);

        $pdf->SetFont('','B','9');
        $pdf->SetXY(15, 118);
        $pdf->Write(0,'Hábitos:','','',false);
        $pdf->SetXY(15, 136);
        $pdf->Write(0,'Vacunas:','','',false);
        $pdf->SetXY(40, 118);
        $pdf->Write(0,'Bebe:','','',false);
        $pdf->SetXY(40, 127);
        $pdf->Write(0,'Fuma:','','',false);
        $pdf->SetXY(40, 136);
        $pdf->Write(0,'Antiamarillica:','','',false);
        $pdf->SetXY(60, 118);
        $pdf->Write(0,'Nunca:','','',false);
        $pdf->SetXY(95, 118);
        $pdf->Write(0,'Ocasionalmente:','','',false);
        $pdf->SetXY(145, 118);
        $pdf->Write(0,'Una o mas a la semana:','','',false);
        $pdf->SetXY(145, 136);
        $pdf->Write(0,'Antitetanica:','','',false);
        $pdf->SetXY(60, 127);
        $pdf->Write(0,'Nunca:','','',false);
        $pdf->SetXY(95, 127);
        $pdf->Write(0,'Ocasionalmente:','','',false);
        $pdf->SetXY(145, 127);
        $pdf->Write(0,'Una o mas a la semana:','','',false);
        $pdf->Rect ( 75,117,6,6,'','', '');
        $pdf->Rect ( 125,117,6,6,'','', '');
        $pdf->Rect ( 185,117,6,6,'','', '');
        $pdf->Rect ( 75,126,6,6,'','', '');
        $pdf->Rect ( 125,126,6,6,'','', '');
        $pdf->Rect ( 185,126,6,6,'','', '');
        $pdf->Rect ( 75,135,6,6,'','', '');
        $pdf->Rect ( 85,135,6,6,'','', '');
        $pdf->Rect ( 185,135,6,6,'','', '');
        $pdf->Rect ( 195,135,6,6,'','', '');
        if($request->input('opciones')=='NUNCA')
        {
            $pdf->SetXY(76, 118);
            $pdf->Write(0,'X','','',false);
        }elseif($request->input('opciones')=='OCASIONALMENTE')
        {
            $pdf->SetXY(126, 118);
            $pdf->Write(0,'X','','',false);
        }elseif($request->input('opciones')=='UNA O MAS A LA SEMANA')
        {
            $pdf->SetXY(186, 118);
            $pdf->Write(0,'X','','',false);
        }
        if($request->input('opciones2')=='NUNCA')
        {
            $pdf->SetXY(76, 127);
            $pdf->Write(0,'X','','',false);
        }elseif($request->input('opciones2')=='OCASIONALMENTE')
        {
            $pdf->SetXY(126, 127);
            $pdf->Write(0,'X','','',false);
        }elseif($request->input('opciones2')=='UNA O MAS A LA SEMANA')
        {
            $pdf->SetXY(186, 127);
            $pdf->Write(0,'X','','',false);
        }
        if($request->input('opciones3')=='SI')
        {
            $pdf->SetXY(76, 136);
            $pdf->Write(0,'X','','',false);
        }elseif($request->input('opciones3')=='NO')
        {
            $pdf->SetXY(86, 136);
            $pdf->Write(0,'X','','',false);
        }
         if($request->input('opciones4')=='SI')
        {
            $pdf->SetXY(186, 136);
            $pdf->Write(0,'X','','',false);
        }elseif($request->input('opciones4')=='NO')
        {
            $pdf->SetXY(196, 136);
            $pdf->Write(0,'X','','',false);
        }
        $pdf->SetXY(15, 145);
        $pdf->Write(0,'II. EXAMEN CLINICO:','','',false);
        $pdf->SetXY(60, 145);
        $pdf->Write(0,'GRUPO SANGUINEO:','','',false);
        $pdf->SetFont('','B','8');
        $pdf->SetXY(25, 152);
        $pdf->Write(0,'SIGNOS VITALES:','','',false);
        $pdf->SetXY(80, 152);
        $pdf->Write(0,'TEMPERATURA:','','',false);
        $pdf->SetXY(135, 152);
        $pdf->Write(0,'PRESION ARTERIAL:','','',false);
        $pdf->SetXY(25, 160);
        $pdf->Write(0,'FRECUENCIA CARDIACA:','','',false);
        $pdf->SetXY(122,160);
        $pdf->Write(0,'FRECUENCIA RESPIRATORIA:','','',false);
        $pdf->SetXY(25, 168);
        $pdf->Write(0,'SOMATOMETRIA:','','',false);
        $pdf->SetXY(95, 168);
        $pdf->Write(0,'TALLA:','','',false);
        $pdf->SetXY(155, 168);
        $pdf->Write(0,'PESO:','','',false);

        $pdf->SetXY(105, 144);
        $pdf->SetFont('','B','12');
        $pdf->Write(0,$request->input('gsa_med').' '.$request->input('rh_med'),'','',false);
        $pdf->SetFont('','B','9');
        $pdf->SetXY(15, 175);
        $pdf->Write(0,'III. EXAMEN FISICO:','','',false);
        $pdf->SetXY(15, 203);
        $pdf->Write(0,'EVALUACION OFTALMOLOGICA:','','',false);
        $pdf->SetXY(15, 203);
        $pdf->Write(0,'EVALUACION OFTALMOLOGICA:','','',false);
        $pdf->SetXY(75, 203);
        $pdf->Write(0,'Examen general de ojos:','','',false);
        $pdf->SetXY(75, 210);
        $pdf->Write(0,'Movimientos oculares:','','',false);
        $pdf->SetXY(75, 217);
        $pdf->Write(0,'Reflejo luminoso corneal:','','',false);
        $pdf->SetXY(75, 224);
        $pdf->Write(0,'Estrabismo:','','',false);
        $pdf->SetXY(100, 224);
        $pdf->Write(0,'SI:','','',false);
        $pdf->SetXY(150, 224);
        $pdf->Write(0,'NO:','','',false);
        $pdf->SetXY(100, 231);
        $pdf->Write(0,'SI:','','',false);
        $pdf->SetXY(150, 231);
        $pdf->Write(0,'NO:','','',false);
        $pdf->Rect ( 108,223,6,6,'','', '');
        $pdf->Rect ( 159,223,6,6,'','', '');
        $pdf->Rect ( 108,230,6,6,'','', '');
        $pdf->Rect ( 159,230,6,6,'','', '');
          if($request->input('opciones5')=='SI')
        {
            $pdf->SetXY(109, 224);
            $pdf->Write(0,'X','','',false);
        }elseif($request->input('opciones5')=='NO')
        {
            $pdf->SetXY(160, 224);
            $pdf->Write(0,'X','','',false);
        }
          if($request->input('opciones6')=='SI')
        {
            $pdf->SetXY(109, 231);
            $pdf->Write(0,'X','','',false);
        }elseif($request->input('opciones6')=='NO')
        {
            $pdf->SetXY(160, 231);
            $pdf->Write(0,'X','','',false);
        }
            $pdf->SetXY(15, 245);
            $pdf->Write(0,'Agudeza visual','','',false);
            $pdf->SetXY(28, 256);
            $pdf->Write(0,$request->input('ald_med'),'','',false);
            $pdf->SetXY(45, 256);
            $pdf->Write(0,$request->input('asd_med'),'','',false);
            $pdf->SetXY(62, 256);
            $pdf->Write(0,$request->input('acd_med'),'','',false);
            $pdf->SetXY(28, 261);
            $pdf->Write(0,$request->input('ali_med'),'','',false);
            $pdf->SetXY(45, 261);
            $pdf->Write(0,$request->input('asi_med'),'','',false);
            $pdf->SetXY(62, 261);
            $pdf->Write(0,$request->input('aci_med'),'','',false);

            $pdf->SetXY(15, 250);
            $html='
            <style>
                .tabla{width:35%; font-size:7px;}
                .fila{width:10%;}
            </style>
            <table cellpadding="3" class="tabla" border="1px">
            <tr class="fila" >
                <td width="15%"></td>
                <td>Con lentes</td>
                <td>Sin lentes</td>
                <td>Correccion</td>
            </tr>
            <tr>
                <td>OD</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>OI</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </table>';
            $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->SetXY(75, 231);
        $pdf->Write(0,'Usa Lentes:','','',false);
        $pdf->SetXY(75, 238);
        $pdf->Write(0,'Campimetria:','','',false);
        $pdf->SetXY(150, 238);
        $pdf->Write(0,'Colorimetria:','','',false);
        $pdf->SetXY(95, 245);
        $pdf->Write(0,'Vision profunda:','','',false);
        $pdf->SetXY(20, 180);
        $pdf->Write(0,'1. EXPLORACION DE CABEZA; CARA Y CUELLO:','','',false);
        $pdf->SetXY(24, 185);
        $pdf->Write(0,'Cabeza:','','',false);
        $pdf->SetXY(24, 190);
        $pdf->Write(0,'Cara:','','',false);
        $pdf->SetXY(24, 195);
        $pdf->Write(0,'Cuello:','','',false);
        $pdf->write2DBarcode ( 'Paciente :'.$paciente[0]->NOM_PAC.' '.$paciente[0]->APA_PAC.' '.$paciente[0]->AMA_PAC.' | Medico: '.Auth::user()->NOM_USU.' '.Auth::user()->APA_USU.' '.Auth::user()->AMA_USU.' | Fecha:'.Carbon::now().' | DARSALUD | Ev. '.$medica->id, 'QRCODE,M', 185, 245, 20, 20, '','','');
        $pdf->AddPage();
        $pdf->SetFont('','','8');
        $pdf->SetXY(65, 50.5);
        $pdf->Write(0,$request->input('eoe_med'),'','',false);
        $pdf->SetXY(50, 56);
        $pdf->Write(0,$request->input('oto_med'),'','',false);
        $pdf->SetXY(114, 56);
        $pdf->Write(0,$request->input('twe_med'),'','',false);
        $pdf->SetXY(174, 56);
        $pdf->Write(0,$request->input('tri_med'),'','',false);
        $pdf->SetXY(63, 69);
        $pdf->Write(0,$request->input('ext_med'),'','',false);
        $pdf->SetXY(85, 76);
        $pdf->Write(0,$request->input('exc_med'),'','',false);
        $pdf->SetXY(70, 90);
        $pdf->Write(0,$request->input('exa_med'),'','',false);
        $pdf->SetXY(70, 104);
        $pdf->Write(0,$request->input('trs_med'),'','',false);
        $pdf->SetXY(165, 104);
        $pdf->Write(0,$request->input('tin_med'),'','',false);
        $pdf->SetXY(80, 110);
        $pdf->Write(0,$request->input('tms_med'),'','',false);
        $pdf->SetXY(175, 110);
        $pdf->Write(0,$request->input('tmi_med'),'','',false);
        $pdf->SetXY(80, 116);
        $pdf->Write(0,$request->input('fms_med'),'','',false);
        $pdf->SetXY(175, 116);
        $pdf->Write(0,$request->input('fmi_med'),'','',false);
        $pdf->SetXY(63, 122);
        $pdf->SetFont('','','7');
        $pdf->MultiCell(55, 2, $request->input('obs_med') , 0, 'L', 0, 0, '', '', true);
        $pdf->SetXY(158, 122);
        $pdf->MultiCell(55, 2, $request->input('obi_med') , 0, 'L', 0, 0, '', '', true);
        $pdf->SetXY(70, 136);
        $pdf->SetFont('','','8');
        $pdf->Write(0,$request->input('cma_med'),'','',false);
        $pdf->SetXY(70, 142);
        $pdf->Write(0,$request->input('ref_med'),'','',false);
        $pdf->SetXY(70, 154);
        $pdf->Write(0,$request->input('ptr_med'),'','',false);
        $pdf->SetXY(70, 160);
        $pdf->Write(0,$request->input('pdn_med'),'','',false);
        $pdf->SetXY(70, 172);
        $pdf->Write(0,$request->input('prg_med'),'','',false);
        $pdf->SetXY(105, 178);
        $pdf->Write(0,$request->input('fam_med'),'','',false);

        $pdf->Rect ( 118,189,6,6,'','', '');
        $pdf->Rect ( 178,189,6,6,'','', '');
        $pdf->Rect ( 118,216,6,6,'','', '');
        $pdf->Rect ( 178,216,6,6,'','', '');
        $pdf->SetXY(105, 198);
        $pdf->MultiCell(105, 5, $request->input('mre_med') , 0, 'L', 0, 0, '', '', true);
        $pdf->SetXY(105, 208);
        $pdf->MultiCell(105, 2, $request->input('rev_med') , 0, 'L', 0, 0, '', '', true);

        $pdf->SetFont('','B','9');
          if($request->input('opciones7')=='SI')
        {
            $pdf->SetXY(119, 190);
            $pdf->Write(0,'X','','',false);
        }elseif($request->input('opciones7')=='NO')
        {
            $pdf->SetXY(179, 190);
            $pdf->Write(0,'X','','',false);
        }
          if($request->input('opciones8')=='SI')
        {
            $pdf->SetXY(119, 217);
            $pdf->Write(0,'X','','',false);
        }elseif($request->input('opciones8')=='NO')
        {
            $pdf->SetXY(179, 217);
            $pdf->Write(0,'X','','',false);
        }
        $pdf->SetXY(125, 190);

        $pdf->MultiCell(45, 2, $request->input('esp_med') , 0, 'L', 0, 0, '', '', true);
        $pdf->SetXY(110, 190);
        $pdf->Write(0,'SI','','',false);
        $pdf->SetXY(170, 190);
        $pdf->Write(0,'NO','','',false);
        $pdf->SetXY(110, 217);
        $pdf->Write(0,'SI','','',false);
        $pdf->SetXY(170, 217);
        $pdf->Write(0,'NO','','',false);

        $pdf->SetXY(20, 44);
        $pdf->Write(0,'APARATO AUDITIVO:','','',false);
        $pdf->SetXY(26, 50);
        $pdf->Write(0,'Examen de oido externo:','','',false);
        $pdf->SetXY(26, 56);
        $pdf->Write(0,'Otoscopia:','','',false);
        $pdf->SetXY(94, 56);
        $pdf->Write(0,'T. Weber:','','',false);
        $pdf->SetXY(154, 56);
        $pdf->Write(0,'T. Rinne:','','',false);
        $pdf->SetXY(20, 62);
        $pdf->Write(0,'2. EXPLORACION DEL APARATO CARDIO CIRCULATORIO Y RESPIRATORIO','','',false);
        $pdf->SetXY(26, 69);
        $pdf->Write(0,'Exploracion del tórax:','','',false);
        $pdf->SetXY(26, 76);
        $pdf->Write(0,'Exploracion de area cardiopulmonar:','','',false);
        $pdf->SetXY(20, 83);
        $pdf->Write(0,'3. EXPLORACION DEL APARATO DIGESTIVO','','',false);
        $pdf->SetXY(26, 90);
        $pdf->Write(0,'Exploracion del abdomen:','','',false);
        $pdf->SetXY(20, 97);
        $pdf->Write(0,'4. EXPLORACION DEL APARATO LOCOMOTOR','','',false);
        $pdf->SetXY(50, 104);
        $pdf->Write(0,'Trofismo:','','',false);
        $pdf->SetXY(50, 110);
        $pdf->Write(0,'Tono muscular:','','',false);
        $pdf->SetXY(50, 116);
        $pdf->Write(0,'Fuerza muscular:','','',false);
        $pdf->SetXY(50, 122);
        $pdf->Write(0,'Otros:','','',false);
        $pdf->SetXY(145, 104);
        $pdf->Write(0,'Trofismo:','','',false);
        $pdf->SetXY(145, 110);
        $pdf->Write(0,'Tono muscular:','','',false);
        $pdf->SetXY(145, 116);
        $pdf->Write(0,'Fuerza muscular:','','',false);
         $pdf->SetXY(145, 122);
        $pdf->Write(0,'Otros:','','',false);
        $pdf->SetXY(26, 109);
        $pdf->Write(0,'Miembros','','',false);
        $pdf->SetXY(25, 113);
        $pdf->Write(0,'Superiores','','',false);
        $pdf->SetXY(121, 109);
        $pdf->Write(0,'Miembros','','',false);
        $pdf->SetXY(121, 113);
        $pdf->Write(0,'Inferiores','','',false);

        $pdf->Line ( 50, 102,50,127,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 145, 102,145,127,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->SetXY(20, 130);
        $pdf->Write(0,'5. SISTEMA NEUROLOGICO','','',false);
        $pdf->SetXY(26, 136);
        $pdf->Write(0,'Coordinacion y Marcha:','','',false);
        $pdf->SetXY(26, 142);
        $pdf->Write(0,'Reflejos osteondinosos:','','',false);
        $pdf->SetXY(26, 148);
        $pdf->Write(0,'PRUEBAS DE COORDINACION','','',false);
        $pdf->SetXY(35, 154);
        $pdf->Write(0,'Prueba talón - rodilla:','','',false);
        $pdf->SetXY(35, 160);
        $pdf->Write(0,'Prueba dedo - nariz:','','',false);
        $pdf->SetXY(26, 166);
        $pdf->Write(0,'PRUEBAS DE EQUILIBRIO','','',false);
        $pdf->SetXY(35, 172);
        $pdf->Write(0,'Prueba Romberg:','','',false);
        $pdf->SetXY(35, 178);
        $pdf->Write(0,'Fallas motoras y sensitivas diagnosticadas:','','',false);
        $pdf->SetXY(26, 184);
        $pdf->Write(0,'RESULTADOS DE EVALUACION','','',false);
         $pdf->SetXY(35, 190);
        $pdf->Write(0,'Requiere evaluación de especialidad:','','',false);
         $pdf->SetXY(35, 198);
        $pdf->Write(0,'Motivo de la referencia a la especialidad:','','',false);
         $pdf->SetXY(35, 210);
        $pdf->Write(0,'Resultado de la evaluacion de especialidad:','','',false);
         $pdf->SetXY(35, 218);
        $pdf->Write(0,'Requiere de evaluacion psicosensometrica:','','',false);

        $pdf->SetFont('','B','7');
        $pdf->SetXY(15, 224);
        $pdf->SetFont('','B','10');
        $pdf->Write(0,'RESULTADO FINAL CERTIFICACION MEDICA','','',false);
        $pdf->SetXY(15, 230);
        $pdf->SetFont('','B','8');
        $pdf->Write(0,'OBSERVACIONES: (EN ESTE ACAPITE INCORPORAR SI EL POSTULANTE ES APTO PARA CONDUCIR VEHICULO, SI NO FUERA APTO INDICAR LOS MOTIVOS)','','',false);

        if($request->input('apt_med')==1){
        $pdf->SetXY(60, 239);
        $pdf->SetFont('','UB','11');
        $pdf->Write(0,'APTO PARA CONDUCIR CATEGORIA "'.$request->input('rfi_med').'"','','',false);
        }else{
        $pdf->SetXY(20, 237);
        $pdf->SetFont('','UB','10');
        $pdf->MultiCell(150, 2, 'NO APTO PARA CONDUCIR - '.$request->input('mna_med'), 0, 'L', 0, 0, '', '', true);
        }
        if(($request->input('rfs_med')!='') && ($request->input('rft_med')=='')&& ($request->input('apt_med')=='1'))
            {
            $pdf->SetXY(137, 239);
            $pdf->SetFont('','UB','11');
            $pdf->Write(0,' Y "'.$request->input('rfs_med').'"','','',false);
            }
        if(($request->input('rfs_med')!='')&&($request->input('rft_med')!='')&& ($request->input('apt_med')=='1'))
            {
            $pdf->SetXY(137, 239);
            $pdf->SetFont('','UB','11');
            $pdf->Write(0,', "'.$request->input('rfs_med').'" Y "'.$request->input('rft_med').'"','','',false);
            }
        $pdf->Line ( 30, 263,70,263,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 80, 263,120,263,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 130, 263,165,263,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
         $pdf->SetXY(30, 265);
         $pdf->SetFont('','B','8');
        $pdf->Write(0,'SELLO CENTRO DE SALUD','','',false);
         $pdf->SetXY(90, 265);
         $pdf->SetFont('','B','8');
        $pdf->Write(0,'SELLO MEDICO','','',false);
         $pdf->SetXY(133, 265);
         $pdf->SetFont('','B','8');
        $pdf->Write(0,'FIRMA DEL MEDICO','','',false);
        $pdf->SetXY(180,230);
        $pdf->SetFont('','','11');
        $pdf->write2DBarcode ( 'Paciente :'.$paciente[0]->NOM_PAC.' '.$paciente[0]->APA_PAC.' '.$paciente[0]->AMA_PAC.' | Medico: '.Auth::user()->NOM_USU.' '.Auth::user()->APA_USU.' '.Auth::user()->AMA_USU.' | Fecha:'.Carbon::now().' | DARSALUD | Ev. '.$medica->id, 'QRCODE,M', 175, 235, 25, 25, '','','');
        $pdf->Output('EvaluacionMedica.pdf');
    }
    }

    public function pdfhistpsico($id, $ids)
    {
      $psico=Evapsico::find($ids);
      $pdf = new TCPDF('P','mm','LETTER', true, 'UTF-8', false);
      $pdf->SetTitle('EVALUACION PSICOLOGICA');
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);
      $pdf->SetAutoPageBreak(TRUE, 10);
      $pdf->SetMargins(15, 15, 10);
      $pdf->AddPage();
      $pdf->Image('img/cabecera.jpg', 0, 1, 215, 30, 'JPG', '', '', true, 250, '', false, false, false, false, false, false);
      $paciente=Paciente::where('id','=',$id)->get();

      $pdf->SetFont('','B','9');
      $pdf->SetXY(15, 35);
      $pdf->Write(0,'A) DATOS PERSONALES','','',false);

      $pdf->Line ( 15, 55,55,55,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
      $pdf->Line ( 65, 55,105,55,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
      $pdf->Line ( 115, 55,155,55,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
      $pdf->Line ( 165, 55,205,55,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));

      $pdf->SetXY(20, 57);
      $pdf->SetFont('','B','7');
      $pdf->Write(0,'APELLIDO PATERNO','','',false);
      $pdf->SetXY(70, 57);
      $pdf->Write(0,'APELLIDO MATERNO','','',false);
      $pdf->SetXY(125, 57);
      $pdf->Write(0,'NOMBRES','','',false);
      $pdf->SetXY(180, 57);
      $pdf->Write(0,'CI','','',false);
      $pdf->SetXY(18, 50);
      $pdf->SetFont('','','11');
      $pdf->Write(0,$paciente[0]->APA_PAC,'','',false);
      $pdf->SetXY(67, 50);
      $pdf->SetFont('','','11');
      $pdf->Write(0,$paciente[0]->AMA_PAC,'','',false);
      $pdf->SetXY(123, 50);
      $pdf->SetFont('','','11');
      $pdf->Write(0,$paciente[0]->NOM_PAC,'','',false);
      $pdf->SetXY(170, 50);
      $pdf->SetFont('','','11');
      $pdf->Write(0,$paciente[0]->CI_PAC,'','',false);
      $pdf->SetXY(18, 70);
      $pdf->SetFont('','','11');
      $pdf->Write(0,$psico->LUG_NAC.' '.$paciente[0]->FEC_PAC,'','',false);
      $pdf->SetXY(80, 70);
      $pdf->SetFont('','','11');
      $edad = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente[0]->FEC_PAC)->format('Y');
      $edad2 = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente[0]->FEC_PAC)->format('m');
      $edad3 = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente[0]->FEC_PAC)->format('d');
      $date = \Carbon\Carbon::createFromDate($edad,$edad2,$edad3)->age;
      $pdf->Write(0,$date,'','',false);
      $pdf->SetXY(118, 70);
      $pdf->SetFont('','','11');
      $pdf->Write(0,$paciente[0]->PRO_PAC,'','',false);
      $pdf->SetXY(165, 70);
      $pdf->SetFont('','','11');
      $pdf->Write(0,\Carbon\Carbon::now()->format('d-m-Y'),'','',false);
      $pdf->SetXY(18, 90);
      $pdf->SetFont('','','11');
      $pdf->Write(0,$paciente[0]->DOM_PAC,'','',false);
              $pdf->SetXY(157, 90);
      $pdf->SetFont('','','11');
      $pdf->Write(0,$paciente[0]->REF_PAC,'','',false);
      $pdf->SetXY(18, 110);
      $pdf->SetFont('','','10');
      $pdf->Write(0,$psico->HIS_PSI,'','',false);


      $pdf->Line ( 15, 75,70,75,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
      $pdf->Line ( 75, 75,95,75,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
      $pdf->Line ( 105, 75,150,75,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
      $pdf->Line ( 160, 75,205,75,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
      $pdf->SetXY(20, 78);
      $pdf->SetFont('','B','7');
      $pdf->Write(0,'LUGAR Y FECHA DE NACIMIENTO','','',false);
      $pdf->SetXY(80, 78);
      $pdf->Write(0,'EDAD','','',false);
      $pdf->SetXY(120, 78);
      $pdf->Write(0,'PROFESION','','',false);
      $pdf->SetXY(165, 78);
      $pdf->Write(0,'FECHA DEL EXAMEN','','',false);
      $pdf->Line ( 16, 95,205,95,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
      $pdf->SetXY(95, 98);
      $pdf->SetFont('','B','7');
      $pdf->Write(0,'DIRECCION','','',false);
      $pdf->SetXY(160, 98);
      $pdf->SetFont('','B','7');
      $pdf->Write(0,'TELEFONO','','',false);
      $pdf->SetFont('','B','9');
      $pdf->SetXY(15, 105);
      $pdf->Write(0,'B) HISTORIA FAMILIAR','','',false);
      $pdf->SetXY(15, 143);
      $pdf->Write(0,'C) EXAMEN PSICOLOGICO','','',false);
      $pdf->SetXY(15, 150);
      $pdf->SetFont('','B','7');
      $pdf->Write(0,'1. Coordinacion visomotora','','',false);
      $pdf->SetXY(15, 165);
      $pdf->Write(0,'2. Personalidad','','',false);
      $pdf->SetXY(15, 180);
      $pdf->Write(0,'3. Atencion, concentracion, memoria y coordinacion','','',false);
      $pdf->SetXY(15, 195);
      $pdf->Write(0,'4. Prueba de reaccion ante situaciones de estres y riesgo','','',false);
      $pdf->SetXY(62, 158);
      $pdf->Write(0,'INADECUADO','','',false);
       $pdf->SetXY(102, 158);
      $pdf->Write(0,'OBSERVACION','','',false);
       $pdf->SetXY(22, 173);
      $pdf->Write(0,'ADECUADO','','',false);
        $pdf->SetXY(62, 173);
      $pdf->Write(0,'INADECUADO','','',false);
        $pdf->SetXY(102, 173);
      $pdf->Write(0,'OBSERVACION','','',false);
       $pdf->SetXY(22, 158);
      $pdf->Write(0,'ADECUADO','','',false);
      $pdf->SetXY(18, 50);
      $pdf->SetFont('','','11');
      if($psico->EX1_PSI=='ADECUADO'){

          $pdf->SetXY(42, 157);
          $pdf->SetFont('','','11');
          $pdf->Write(0,'X','','',false);
      }
      if($psico->EX1_PSI=='INADECUADO'){
          $pdf->SetXY(84, 157);
          $pdf->SetFont('','','11');
          $pdf->Write(0,'X','','',false);
      }
      if($psico->EX1_PSI=='OBSERVACION'){
          $pdf->SetXY(127, 157);
          $pdf->SetFont('','','11');
          $pdf->Write(0,'X','','',false);
      }
      if($psico->EX2_PSI=='ADECUADO'){

          $pdf->SetXY(42, 172);
          $pdf->SetFont('','','11');
          $pdf->Write(0,'X','','',false);
      }
      if($psico->EX2_PSI=='INADECUADO'){
          $pdf->SetXY(84, 172);
          $pdf->SetFont('','','11');
          $pdf->Write(0,'X','','',false);
      }
      if($psico->EX2_PSI=='OBSERVACION'){
          $pdf->SetXY(127, 172);
          $pdf->SetFont('','','11');
          $pdf->Write(0,'X','','',false);
      }
      if($psico->EX3_PSI=='ADECUADO'){

          $pdf->SetXY(42, 187);
          $pdf->SetFont('','','11');
          $pdf->Write(0,'X','','',false);
      }
      if($psico->EX3_PSI=='INADECUADO'){
          $pdf->SetXY(84, 187);
          $pdf->SetFont('','','11');
          $pdf->Write(0,'X','','',false);
      }
      if($psico->EX3_PSI=='OBSERVACION'){
          $pdf->SetXY(127, 187);
          $pdf->SetFont('','','11');
          $pdf->Write(0,'X','','',false);
      }
      if($psico->EX4_PSI=='OPTIMO'){

          $pdf->SetXY(42, 202);
          $pdf->SetFont('','','11');
          $pdf->Write(0,'X','','',false);
      }
      if($psico->EX4_PSI=='MEDIO'){
          $pdf->SetXY(84, 202);
          $pdf->SetFont('','','11');
          $pdf->Write(0,'X','','',false);
      }
      if($psico->EX4_PSI=='INADECUADO'){
          $pdf->SetXY(127, 202);
          $pdf->SetFont('','','11');
          $pdf->Write(0,'X','','',false);
      }
      if($psico->EX4_PSI=='OBSERVACION'){
          $pdf->SetXY(167, 202);
          $pdf->SetFont('','','11');
          $pdf->Write(0,'X','','',false);
      }
      $pdf->SetFont('','B','7');
      $pdf->Rect ( 40,155,8,8,'','', '');
      $pdf->Rect ( 82,155,8,8,'','', '');
      $pdf->Rect ( 125,155,8,8,'','', '');
      $pdf->Rect ( 40,170,8,8,'','', '');
      $pdf->Rect ( 82,170,8,8,'','', '');
      $pdf->Rect ( 125,170,8,8,'','', '');
      $pdf->SetXY(22, 188);
      $pdf->Write(0,'ADECUADO','','',false);
      $pdf->SetXY(62, 188);
      $pdf->Write(0,'INADECUADO','','',false);
      $pdf->SetXY(102, 188);
      $pdf->Write(0,'OBSERVACION','','',false);

      $pdf->Rect ( 40,185,8,8,'','', '');
      $pdf->Rect ( 82,185,8,8,'','', '');
      $pdf->Rect ( 125,185,8,8,'','', '');

       $pdf->SetXY(22, 203);
      $pdf->Write(0,'OPTIMO','','',false);
       $pdf->SetXY(62, 203);
      $pdf->Write(0,'MEDIO','','',false);
       $pdf->SetXY(102, 203);
      $pdf->Write(0,'INADECUADO','','',false);
       $pdf->SetXY(142, 203);
      $pdf->Write(0,'OBSERVACION','','',false);

      $pdf->Rect ( 40,200,8,8,'','', '');
      $pdf->Rect ( 82,200,8,8,'','', '');
      $pdf->Rect ( 125,200,8,8,'','', '');
      $pdf->Rect ( 165,200,8,8,'','', '');
       $pdf->SetXY(15, 213);
       $pdf->SetFont('','B','9');
      $pdf->Write(0,'RESULTADO FINAL DE LA EVALUACION PSICOLOGICA','','',false);
      $pdf->SetXY(15, 218);
       $pdf->SetFont('','B','8');
      $pdf->Write(0,'OBSERVACIONES: (EN ESTE ACAPITE INCORPORAR SI EL POSTULANTE ES APTO PARA CONDUCIR VEHICULO, SI NO FUERA APTO INDICAR LOS MOTIVOS)','','',false);
      $pdf->SetXY(30, 229);
      $pdf->SetFont('','BS','9');

      $pdf->MultiCell(148, 4, $psico->RFI_PSI , 0, 'L', 0, 0, '', '', true);
      $pdf->Line ( 30, 263,70,263,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
      $pdf->Line ( 80, 263,120,263,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
      $pdf->Line ( 130, 263,165,263,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
       $pdf->SetXY(30, 265);
       $pdf->SetFont('','B','8');
      $pdf->Write(0,'SELLO CENTRO DE SALUD','','',false);
       $pdf->SetXY(85, 265);
       $pdf->SetFont('','B','8');
      $pdf->Write(0,'SELLO PSICOLOGO/A','','',false);
       $pdf->SetXY(130, 265);
       $pdf->SetFont('','B','8');
      $pdf->Write(0,'FIRMA PSICOLOGO/A','','',false);
      $pdf->SetXY(180,230);
      $pdf->SetFont('','','11');
      $pdf->write2DBarcode ( 'Paciente :'.$paciente[0]->NOM_PAC.' '.$paciente[0]->APA_PAC.' '.$paciente[0]->AMA_PAC.' | Medico: '.Auth::user()->NOM_USU.' '.Auth::user()->APA_USU.' '.Auth::user()->AMA_USU.' | Fecha:'.Carbon::now(), 'QRCODE,M', 181, 230, 30, 30, '','','');
      $pdf->Output('EvaluacionPsicologica.pdf');
    }
    public function pdfhistmedi($id, $ids)
    {
        $medica=EvaMedi::find($ids);
        $pdf = new TCPDF('P','mm','LETTER', true, 'UTF-8', false);
        $pdf->SetTitle('EVALUACION MEDICA');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetAutoPageBreak(TRUE, 10);
        $pdf->SetMargins(15, 15, 10);
        $pdf->AddPage();
        $pdf->Image('img/cabecera.jpg', 0, 1, 215, 30, 'JPG', '', '', true, 250, '', false, false, false, false, false, false);
        $pdf->Line ( 20, 50,55,50,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 60, 50,95,50,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 105, 50,155,50,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 20, 63,55,63,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $paciente=Paciente::where('id','=',$id)->get();
        $paciente=Paciente::where('id','=',$id)->get();
        $pdf->SetXY(24, 51);
        $pdf->SetFont('','B','7');
        $pdf->Write(0,'APELLIDO PATERNO','','',false);
        $pdf->SetXY(64, 51);
        $pdf->Write(0,'APELLIDO MATERNO','','',false);
        $pdf->SetXY(120, 51);
        $pdf->Write(0,'NOMBRES','','',false);
        $pdf->SetXY(34, 64);
        $pdf->Write(0,'CI','','',false);
        $pdf->SetXY(21, 44);
        if(strlen($paciente[0]->APA_PAC)>15):
          $pdf->SetFont('','','8');
        else:
          $pdf->SetFont('','','10');
        endif;
        $pdf->Write(0,$paciente[0]->APA_PAC,'','',false);
        $pdf->SetXY(61, 44);
        if(strlen($paciente[0]->AMA_PAC)>15):
          $pdf->SetFont('','','8');
        else:
          $pdf->SetFont('','','10');
        endif;
        $pdf->Write(0,$paciente[0]->AMA_PAC,'','',false);
        $pdf->SetXY(105, 44);
        if(strlen($paciente[0]->NOM_PAC)>20):
          $pdf->SetFont('','','8');
        else:
          $pdf->SetFont('','','10');
        endif;
        $pdf->Write(0,$paciente[0]->NOM_PAC,'','',false);
        $pdf->SetXY(25, 57);
        $pdf->SetFont('','','10');
        $pdf->Write(0,$paciente[0]->CI_PAC,'','',false);
        $pdf->SetXY(62, 57);
        $pdf->SetFont('','','10');
        $edad = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente[0]->FEC_PAC)->format('Y');
        $edad2 = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente[0]->FEC_PAC)->format('m');
        $edad3 = \Carbon\Carbon::createFromFormat('Y-m-d', $paciente[0]->FEC_PAC)->format('d');
        $date = \Carbon\Carbon::createFromDate($edad,$edad2,$edad3)->age;
        $pdf->Write(0,$date,'','',false);
        $pacientes= Paciente::find($id);
        //$htmla='<img width="40px" height="40px" src="../public/storage/abc.jpg'.'"/>';
        //dd($html5);
        //$pdf->SetXY(170,40);
        //$pdf->writeHTML($htmla, true, false, true, false, '');
        //$imgdata= base64_decode($request->input('img2'));
        //dd($imgdata);
        //$pdf->Image('@'.$imgdata,170,40,35,35);
        //$image='../public/storage/15-11-2017-1234565LP.jpg';
        //dd($medica->FOT_PAC);
        $pdf->Image('storage/'.$medica->FOT_PAC, 170, 40, 35, 35, 'PNG', '', '', true, 250, '', false, false, false, false, false, false);
        //$pdf->Image(rtrim($image), 170, 40, 35, 35,'JPG');
        //dd($asd);
        $pdf->SetXY(110, 57);
        $pdf->SetFont('','','10');
        $pdf->Write(0,$medica->LUG_MED.'   '.\Carbon\Carbon::now()->format('d-m-Y'),'','',false);

        $pdf->SetXY(18, 110);
        $pdf->SetFont('','','10');
        $pdf->Write(0,$medica->ANT_OTO,'','',false);
        $pdf->Line ( 75, 63,95,63,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 60, 63,70,63,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 105, 63,155,63,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));

        $pdf->SetXY(74, 57);
        $pdf->SetFont('','','10');
        $pdf->Write(0,$paciente[0]->SEX_PAC,'','',false);
        $pdf->SetFont('','B','7');
        $pdf->SetXY(61, 64);
        $pdf->Write(0,'EDAD','','',false);
        $pdf->SetXY(80, 64);
        $pdf->Write(0,'SEXO','','',false);
        $pdf->SetXY(110, 64);
        $pdf->Write(0,'LUGAR Y FECHA DEL EXAMEN','','',false);

        $pdf->SetFont('','B','9');
        $pdf->SetXY(15, 75);
        $pdf->Write(0,'I. ANTECEDENTES','','',false);
        $pdf->SetXY(10, 80);
        $pdf->Write(0,'Antecedentes relacionados con la conduccion:','','',false);
        $pdf->SetXY(85, 80);
        $pdf->SetFont('','','9');
        $pdf->MultiCell(115, 2,$medica->ACO_MED, 0, 'L', 0, 0, '', '', true);
        $pdf->SetXY(80, 98);
        $pdf->SetFont('','','9');
        $pdf->MultiCell(115, 2, $medica->APA_MED , 0, 'L', 0, 0, '', '', true);
        $pdf->SetFont('','B','5');
        $pdf->SetXY(76, 142);
        $pdf->Write(0,'SI','','',false);
        $pdf->SetXY(86, 142);
        $pdf->Write(0,'NO','','',false);
        $pdf->SetXY(186, 142);
        $pdf->Write(0,'SI','','',false);
        $pdf->SetXY(196, 142);
        $pdf->Write(0,'NO','','',false);

        $pdf->SetFont('','B','9');
        $pdf->SetXY(10, 98);
        $pdf->Write(0,'Antecedentes personales patológicos:','','',false);

        $pdf->SetFont('','','9');

        $pdf->SetXY(55, 152);
        $pdf->Write(0,$medica->SIG_MED,'','',false);
        $pdf->SetXY(105, 152);
        $pdf->Write(0,$medica->TEM_MED.' °C','','',false);
        $pdf->SetXY(170, 152);
        $pdf->Write(0,$medica->PRE_MED.' mmHg','','',false);
        $pdf->SetXY(75, 160);
        $pdf->Write(0,$medica->FRC_MED.' x min','','',false);
        $pdf->SetXY(170, 160);
        $pdf->Write(0,$medica->FRR_MED.' x min','','',false);
        $pdf->SetXY(55, 168);
        $pdf->Write(0,$medica->SOM_MED,'','',false);
        $pdf->SetXY(115, 168);
        $pdf->Write(0,$medica->TAL_MED.' cms','','',false);
        $pdf->SetXY(180, 168);
        $pdf->Write(0,$medica->PES_MED.' Kg','','',false);
        $pdf->SetXY(40, 185);
        $pdf->Write(0,$medica->ECA_MED,'','',false);
        $pdf->SetXY(40, 190);
        $pdf->Write(0,$medica->ECR_MED,'','',false);
        $pdf->SetXY(40, 195);
        $pdf->Write(0,$medica->ECU_MED,'','',false);
         $pdf->SetXY(130, 203);
        $pdf->Write(0,$medica->EGO_MED,'','',false);
         $pdf->SetXY(130, 210);
        $pdf->Write(0,$medica->MOC_MED,'','',false);
         $pdf->SetXY(130, 217);
        $pdf->Write(0,$medica->REC_MED,'','',false);
         $pdf->SetXY(120, 238);
        $pdf->Write(0,$medica->CAM_MED,'','',false);
         $pdf->SetXY(180, 238);
        $pdf->Write(0,$medica->COL_MED,'','',false);
         $pdf->SetXY(150, 245);
        $pdf->Write(0,$medica->VPR_MED,'','',false);

        $pdf->SetFont('','B','9');
        $pdf->SetXY(15, 118);
        $pdf->Write(0,'Hábitos:','','',false);
        $pdf->SetXY(15, 136);
        $pdf->Write(0,'Vacunas:','','',false);
        $pdf->SetXY(40, 118);
        $pdf->Write(0,'Bebe:','','',false);
        $pdf->SetXY(40, 127);
        $pdf->Write(0,'Fuma:','','',false);
        $pdf->SetXY(40, 136);
        $pdf->Write(0,'Antiamarillica:','','',false);
        $pdf->SetXY(60, 118);
        $pdf->Write(0,'Nunca:','','',false);
        $pdf->SetXY(95, 118);
        $pdf->Write(0,'Ocasionalmente:','','',false);
        $pdf->SetXY(145, 118);
        $pdf->Write(0,'Una o mas a la semana:','','',false);
        $pdf->SetXY(145, 136);
        $pdf->Write(0,'Antitetanica:','','',false);
        $pdf->SetXY(60, 127);
        $pdf->Write(0,'Nunca:','','',false);
        $pdf->SetXY(95, 127);
        $pdf->Write(0,'Ocasionalmente:','','',false);
        $pdf->SetXY(145, 127);
        $pdf->Write(0,'Una o mas a la semana:','','',false);
        $pdf->Rect ( 75,117,6,6,'','', '');
        $pdf->Rect ( 125,117,6,6,'','', '');
        $pdf->Rect ( 185,117,6,6,'','', '');
        $pdf->Rect ( 75,126,6,6,'','', '');
        $pdf->Rect ( 125,126,6,6,'','', '');
        $pdf->Rect ( 185,126,6,6,'','', '');
        $pdf->Rect ( 75,135,6,6,'','', '');
        $pdf->Rect ( 85,135,6,6,'','', '');
        $pdf->Rect ( 185,135,6,6,'','', '');
        $pdf->Rect ( 195,135,6,6,'','', '');
        if($medica->HBE_MED=='NUNCA')
        {
            $pdf->SetXY(76, 118);
            $pdf->Write(0,'X','','',false);
        }elseif($medica->HBE_MED=='OCASIONALMENTE')
        {
            $pdf->SetXY(126, 118);
            $pdf->Write(0,'X','','',false);
        }elseif($medica->HBE_MED=='UNA O MAS A LA SEMANA')
        {
            $pdf->SetXY(186, 118);
            $pdf->Write(0,'X','','',false);
        }
        if($medica->HFU_MED=='NUNCA')
        {
            $pdf->SetXY(76, 127);
            $pdf->Write(0,'X','','',false);
        }elseif($medica->HFU_MED=='OCASIONALMENTE')
        {
            $pdf->SetXY(126, 127);
            $pdf->Write(0,'X','','',false);
        }elseif($medica->HFU_MED=='UNA O MAS A LA SEMANA')
        {
            $pdf->SetXY(186, 127);
            $pdf->Write(0,'X','','',false);
        }
        if($medica->VAM_MED=='SI')
        {
            $pdf->SetXY(76, 136);
            $pdf->Write(0,'X','','',false);
        }elseif($medica->VAM_MED=='NO')
        {
            $pdf->SetXY(86, 136);
            $pdf->Write(0,'X','','',false);
        }
         if($medica->VTE_MED=='SI')
        {
            $pdf->SetXY(186, 136);
            $pdf->Write(0,'X','','',false);
        }elseif($medica->VTE_MED=='NO')
        {
            $pdf->SetXY(196, 136);
            $pdf->Write(0,'X','','',false);
        }
        $pdf->SetXY(15, 145);
        $pdf->Write(0,'II. EXAMEN CLINICO:','','',false);
        $pdf->SetXY(60, 145);
        $pdf->Write(0,'GRUPO SANGUINEO:','','',false);
        $pdf->SetFont('','B','8');
        $pdf->SetXY(25, 152);
        $pdf->Write(0,'SIGNOS VITALES:','','',false);
        $pdf->SetXY(80, 152);
        $pdf->Write(0,'TEMPERATURA:','','',false);
        $pdf->SetXY(135, 152);
        $pdf->Write(0,'PRESION ARTERIAL:','','',false);
        $pdf->SetXY(25, 160);
        $pdf->Write(0,'FRECUENCIA CARDIACA:','','',false);
        $pdf->SetXY(122,160);
        $pdf->Write(0,'FRECUENCIA RESPIRATORIA:','','',false);
        $pdf->SetXY(25, 168);
        $pdf->Write(0,'SOMATOMETRIA:','','',false);
        $pdf->SetXY(95, 168);
        $pdf->Write(0,'TALLA:','','',false);
        $pdf->SetXY(155, 168);
        $pdf->Write(0,'PESO:','','',false);

        $pdf->SetXY(105, 144);
        $pdf->SetFont('','B','12');
        $pdf->Write(0,$medica->GSA_MED.' '.$medica->RH_MED,'','',false);
        $pdf->SetFont('','B','9');
        $pdf->SetXY(15, 175);
        $pdf->Write(0,'III. EXAMEN FISICO:','','',false);
        $pdf->SetXY(15, 203);
        $pdf->Write(0,'EVALUACION OFTALMOLOGICA:','','',false);
        $pdf->SetXY(15, 203);
        $pdf->Write(0,'EVALUACION OFTALMOLOGICA:','','',false);
        $pdf->SetXY(75, 203);
        $pdf->Write(0,'Examen general de ojos:','','',false);
        $pdf->SetXY(75, 210);
        $pdf->Write(0,'Movimientos oculares:','','',false);
        $pdf->SetXY(75, 217);
        $pdf->Write(0,'Reflejo luminoso corneal:','','',false);
        $pdf->SetXY(75, 224);
        $pdf->Write(0,'Estrabismo:','','',false);
        $pdf->SetXY(100, 224);
        $pdf->Write(0,'SI:','','',false);
        $pdf->SetXY(150, 224);
        $pdf->Write(0,'NO:','','',false);
        $pdf->SetXY(100, 231);
        $pdf->Write(0,'SI:','','',false);
        $pdf->SetXY(150, 231);
        $pdf->Write(0,'NO:','','',false);
        $pdf->Rect ( 108,223,6,6,'','', '');
        $pdf->Rect ( 159,223,6,6,'','', '');
        $pdf->Rect ( 108,230,6,6,'','', '');
        $pdf->Rect ( 159,230,6,6,'','', '');
          if($medica->GSA_MED=='SI')
        {
            $pdf->SetXY(109, 224);
            $pdf->Write(0,'X','','',false);
        }elseif($medica->GSA_MED=='NO')
        {
            $pdf->SetXY(160, 224);
            $pdf->Write(0,'X','','',false);
        }
          if($medica->GSA_MED=='SI')
        {
            $pdf->SetXY(109, 231);
            $pdf->Write(0,'X','','',false);
        }elseif($medica->GSA_MED=='NO')
        {
            $pdf->SetXY(160, 231);
            $pdf->Write(0,'X','','',false);
        }
            $pdf->SetXY(15, 245);
            $pdf->Write(0,'Agudeza visual','','',false);
            $pdf->SetXY(28, 256);
            $pdf->Write(0,$medica->ALD_MED,'','',false);
            $pdf->SetXY(45, 256);
            $pdf->Write(0,$medica->ASD_MED,'','',false);
            $pdf->SetXY(62, 256);
            $pdf->Write(0,$medica->ACD_MED,'','',false);
            $pdf->SetXY(28, 261);
            $pdf->Write(0,$medica->ALI_MED,'','',false);
            $pdf->SetXY(45, 261);
            $pdf->Write(0,$medica->ASI_MED,'','',false);
            $pdf->SetXY(62, 261);
            $pdf->Write(0,$medica->ACI_MED,'','',false);

            $pdf->SetXY(15, 250);
            $html='
            <style>
                .tabla{width:35%; font-size:7px;}
                .fila{width:10%;}
            </style>
            <table cellpadding="3" class="tabla" border="1px">
            <tr class="fila" >
                <td width="15%"></td>
                <td>Con lentes</td>
                <td>Sin lentes</td>
                <td>Correccion</td>
            </tr>
            <tr>
                <td>OD</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>OI</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </table>';
            $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->SetXY(75, 231);
        $pdf->Write(0,'Usa Lentes:','','',false);
        $pdf->SetXY(75, 238);
        $pdf->Write(0,'Campimetria:','','',false);
        $pdf->SetXY(150, 238);
        $pdf->Write(0,'Colorimetria:','','',false);
        $pdf->SetXY(95, 245);
        $pdf->Write(0,'Vision profunda:','','',false);
        $pdf->SetXY(20, 180);
        $pdf->Write(0,'1. EXPLORACION DE CABEZA; CARA Y CUELLO:','','',false);
        $pdf->SetXY(24, 185);
        $pdf->Write(0,'Cabeza:','','',false);
        $pdf->SetXY(24, 190);
        $pdf->Write(0,'Cara:','','',false);
        $pdf->SetXY(24, 195);
        $pdf->Write(0,'Cuello:','','',false);
        $pdf->write2DBarcode ( 'Paciente :'.$paciente[0]->NOM_PAC.' '.$paciente[0]->APA_PAC.' '.$paciente[0]->AMA_PAC.' | Medico: '.Auth::user()->NOM_USU.' '.Auth::user()->APA_USU.' '.Auth::user()->AMA_USU.' | Fecha:'.Carbon::now().' | DARSALUD | Ev. '.$medica->id, 'QRCODE,M', 185, 245, 20, 20, '','','');
        $pdf->AddPage();
        $pdf->Image('img/cabecera.jpg', 0, 1, 215, 30, 'JPG', '', '', true, 250, '', false, false, false, false, false, false);
        $pdf->SetFont('','','8');
        $pdf->SetXY(65, 50.5);
        $pdf->Write(0,$medica->EOE_MED,'','',false);
        $pdf->SetXY(50, 56);
        $pdf->Write(0,$medica->OTO_MED,'','',false);
        $pdf->SetXY(114, 56);
        $pdf->Write(0,$medica->TWE_MED,'','',false);
        $pdf->SetXY(174, 56);
        $pdf->Write(0,$medica->TRI_MED,'','',false);
        $pdf->SetXY(63, 69);
        $pdf->Write(0,$medica->EXT_MED,'','',false);
        $pdf->SetXY(85, 76);
        $pdf->Write(0,$medica->EXC_MED,'','',false);
        $pdf->SetXY(70, 90);
        $pdf->Write(0,$medica->EXA_MED,'','',false);
        $pdf->SetXY(70, 104);
        $pdf->Write(0,$medica->TRS_MED,'','',false);
        $pdf->SetXY(165, 104);
        $pdf->Write(0,$medica->TIN_MED,'','',false);
        $pdf->SetXY(80, 110);
        $pdf->Write(0,$medica->TMS_MED,'','',false);
        $pdf->SetXY(175, 110);
        $pdf->Write(0,$medica->TMI_MED,'','',false);
        $pdf->SetXY(80, 116);
        $pdf->Write(0,$medica->FMS_MED,'','',false);
        $pdf->SetXY(175, 116);
        $pdf->Write(0,$medica->FMI_MED,'','',false);
        $pdf->SetXY(63, 122);
        $pdf->SetFont('','','7');
        $pdf->MultiCell(55, 2, $medica->OBS_MED , 0, 'L', 0, 0, '', '', true);
        $pdf->SetXY(158, 122);
        $pdf->MultiCell(55, 2, $medica->OBI_MED , 0, 'L', 0, 0, '', '', true);
        $pdf->SetXY(70, 136);
        $pdf->SetFont('','','8');
        $pdf->Write(0,$medica->CMA_MED,'','',false);
        $pdf->SetXY(70, 142);
        $pdf->Write(0,$medica->REF_MED,'','',false);
        $pdf->SetXY(70, 154);
        $pdf->Write(0,$medica->PTR_MED,'','',false);
        $pdf->SetXY(70, 160);
        $pdf->Write(0,$medica->PDN_MED,'','',false);
        $pdf->SetXY(70, 172);
        $pdf->Write(0,$medica->PRG_MED,'','',false);
        $pdf->SetXY(105, 178);
        $pdf->Write(0,$medica->FAM_MED,'','',false);

        $pdf->Rect ( 118,189,6,6,'','', '');
        $pdf->Rect ( 178,189,6,6,'','', '');
        $pdf->Rect ( 118,216,6,6,'','', '');
        $pdf->Rect ( 178,216,6,6,'','', '');
        $pdf->SetXY(105, 198);
        $pdf->MultiCell(105, 5, $medica->MRE_MED , 0, 'L', 0, 0, '', '', true);
        $pdf->SetXY(105, 208);
        $pdf->MultiCell(105, 2, $medica->REV_MED , 0, 'L', 0, 0, '', '', true);

        $pdf->SetFont('','B','9');
          if($medica->GSA_MED=='SI')
        {
            $pdf->SetXY(119, 190);
            $pdf->Write(0,'X','','',false);
        }elseif($medica->GSA_MED=='NO')
        {
            $pdf->SetXY(179, 190);
            $pdf->Write(0,'X','','',false);
        }
          if($medica->GSA_MED=='SI')
        {
            $pdf->SetXY(119, 217);
            $pdf->Write(0,'X','','',false);
        }elseif($medica->GSA_MED=='NO')
        {
            $pdf->SetXY(179, 217);
            $pdf->Write(0,'X','','',false);
        }
        $pdf->SetXY(125, 190);

        $pdf->MultiCell(45, 2, $medica->ESP_MED , 0, 'L', 0, 0, '', '', true);
        $pdf->SetXY(110, 190);
        $pdf->Write(0,'SI','','',false);
        $pdf->SetXY(170, 190);
        $pdf->Write(0,'NO','','',false);
        $pdf->SetXY(110, 217);
        $pdf->Write(0,'SI','','',false);
        $pdf->SetXY(170, 217);
        $pdf->Write(0,'NO','','',false);

        $pdf->SetXY(20, 44);
        $pdf->Write(0,'APARATO AUDITIVO:','','',false);
        $pdf->SetXY(26, 50);
        $pdf->Write(0,'Examen de oido externo:','','',false);
        $pdf->SetXY(26, 56);
        $pdf->Write(0,'Otoscopia:','','',false);
        $pdf->SetXY(94, 56);
        $pdf->Write(0,'T. Weber:','','',false);
        $pdf->SetXY(154, 56);
        $pdf->Write(0,'T. Rinne:','','',false);
        $pdf->SetXY(20, 62);
        $pdf->Write(0,'2. EXPLORACION DEL APARATO CARDIO CIRCULATORIO Y RESPIRATORIO','','',false);
        $pdf->SetXY(26, 69);
        $pdf->Write(0,'Exploracion del tórax:','','',false);
        $pdf->SetXY(26, 76);
        $pdf->Write(0,'Exploracion de area cardiopulmonar:','','',false);
        $pdf->SetXY(20, 83);
        $pdf->Write(0,'3. EXPLORACION DEL APARATO DIGESTIVO','','',false);
        $pdf->SetXY(26, 90);
        $pdf->Write(0,'Exploracion del abdomen:','','',false);
        $pdf->SetXY(20, 97);
        $pdf->Write(0,'4. EXPLORACION DEL APARATO LOCOMOTOR','','',false);
        $pdf->SetXY(50, 104);
        $pdf->Write(0,'Trofismo:','','',false);
        $pdf->SetXY(50, 110);
        $pdf->Write(0,'Tono muscular:','','',false);
        $pdf->SetXY(50, 116);
        $pdf->Write(0,'Fuerza muscular:','','',false);
        $pdf->SetXY(50, 122);
        $pdf->Write(0,'Otros:','','',false);
        $pdf->SetXY(145, 104);
        $pdf->Write(0,'Trofismo:','','',false);
        $pdf->SetXY(145, 110);
        $pdf->Write(0,'Tono muscular:','','',false);
        $pdf->SetXY(145, 116);
        $pdf->Write(0,'Fuerza muscular:','','',false);
         $pdf->SetXY(145, 122);
        $pdf->Write(0,'Otros:','','',false);
        $pdf->SetXY(26, 109);
        $pdf->Write(0,'Miembros','','',false);
        $pdf->SetXY(25, 113);
        $pdf->Write(0,'Superiores','','',false);
        $pdf->SetXY(121, 109);
        $pdf->Write(0,'Miembros','','',false);
        $pdf->SetXY(121, 113);
        $pdf->Write(0,'Inferiores','','',false);

        $pdf->Line ( 50, 102,50,127,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 145, 102,145,127,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->SetXY(20, 130);
        $pdf->Write(0,'5. SISTEMA NEUROLOGICO','','',false);
        $pdf->SetXY(26, 136);
        $pdf->Write(0,'Coordinacion y Marcha:','','',false);
        $pdf->SetXY(26, 142);
        $pdf->Write(0,'Reflejos osteondinosos:','','',false);
        $pdf->SetXY(26, 148);
        $pdf->Write(0,'PRUEBAS DE COORDINACION','','',false);
        $pdf->SetXY(35, 154);
        $pdf->Write(0,'Prueba talón - rodilla:','','',false);
        $pdf->SetXY(35, 160);
        $pdf->Write(0,'Prueba dedo - nariz:','','',false);
        $pdf->SetXY(26, 166);
        $pdf->Write(0,'PRUEBAS DE EQUILIBRIO','','',false);
        $pdf->SetXY(35, 172);
        $pdf->Write(0,'Prueba Romberg:','','',false);
        $pdf->SetXY(35, 178);
        $pdf->Write(0,'Fallas motoras y sensitivas diagnosticadas:','','',false);
        $pdf->SetXY(26, 184);
        $pdf->Write(0,'RESULTADOS DE EVALUACION','','',false);
         $pdf->SetXY(35, 190);
        $pdf->Write(0,'Requiere evaluación de especialidad:','','',false);
         $pdf->SetXY(35, 198);
        $pdf->Write(0,'Motivo de la referencia a la especialidad:','','',false);
         $pdf->SetXY(35, 210);
        $pdf->Write(0,'Resultado de la evaluacion de especialidad:','','',false);
         $pdf->SetXY(35, 218);
        $pdf->Write(0,'Requiere de evaluacion psicosensometrica:','','',false);

        $pdf->SetFont('','B','7');
        $pdf->SetXY(15, 224);
        $pdf->SetFont('','B','10');
        $pdf->Write(0,'RESULTADO FINAL CERTIFICACION MEDICA','','',false);
        $pdf->SetXY(15, 230);
        $pdf->SetFont('','B','8');
        $pdf->Write(0,'OBSERVACIONES: (EN ESTE ACAPITE INCORPORAR SI EL POSTULANTE ES APTO PARA CONDUCIR VEHICULO, SI NO FUERA APTO INDICAR LOS MOTIVOS)','','',false);

        if($medica->APT_MED==1){
        $pdf->SetXY(60, 239);
        $pdf->SetFont('','UB','11');
        $pdf->Write(0,'APTO PARA CONDUCIR CATEGORIA "'.$medica->RFI_MED.'"','','',false);
        }else{
        $pdf->SetXY(20, 237);
        $pdf->SetFont('','UB','10');
        $pdf->MultiCell(150, 2, 'NO APTO PARA CONDUCIR - '.$medica->MNA_MED, 0, 'L', 0, 0, '', '', true);
        }
        if(($medica->RFS_MED!='') && ($medica->RFT_MED=='')&& ($medica->APT_MED=='1'))
            {
            $pdf->SetXY(137, 239);
            $pdf->SetFont('','UB','11');
            $pdf->Write(0,' Y "'.$medica->RFS_MED.'"','','',false);
            }
        if(($medica->RFS_MED!='')&&($medica->RFT_MED!='')&& ($medica->APT_MED=='1'))
            {
            $pdf->SetXY(137, 239);
            $pdf->SetFont('','UB','11');
            $pdf->Write(0,', "'.$medica->RFS_MED.'" Y "'.$medica->RFT_MED.'"','','',false);
            }
        $pdf->Line ( 30, 263,70,263,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 80, 263,120,263,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $pdf->Line ( 130, 263,165,263,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
         $pdf->SetXY(30, 265);
         $pdf->SetFont('','B','8');
        $pdf->Write(0,'SELLO CENTRO DE SALUD','','',false);
         $pdf->SetXY(90, 265);
         $pdf->SetFont('','B','8');
        $pdf->Write(0,'SELLO MEDICO','','',false);
         $pdf->SetXY(133, 265);
         $pdf->SetFont('','B','8');
        $pdf->Write(0,'FIRMA DEL MEDICO','','',false);
        $pdf->SetXY(180,230);
        $pdf->SetFont('','','11');
        $pdf->write2DBarcode ( 'Paciente :'.$paciente[0]->NOM_PAC.' '.$paciente[0]->APA_PAC.' '.$paciente[0]->AMA_PAC.' | Medico: '.Auth::user()->NOM_USU.' '.Auth::user()->APA_USU.' '.Auth::user()->AMA_USU.' | Fecha:'.Carbon::now().' | DARSALUD | Ev. '.$medica->id, 'QRCODE,M', 175, 235, 25, 25, '','','');
        $pdf->Output('EvaluacionMedica.pdf');
    }
     public function pdfreceta(Request $request,$id)
    {
      $receta=new Receta;
      $receta->DES_REC=$request->input('rec_med');
      $receta->ID_PAC=$id;
      $receta->FEC_REC=Carbon::now();

        if(isset($_POST['finreceta'])){
          $receta->save();
          $pacientes= Paciente::find($id);
          $evamedi=Evamedi::where('ID_PAC','=',$id)->join('users','ID_USU','=','users.id')->select('FEC_MED','evaluacionmedica.id','NOM_USU','APA_USU','AMA_USU')->get();
          $evapsi=EvaPsico::where('ID_PAC','=',$id)->join('users','ID_MED','=','users.id')->select('FEC_PSI','evaluacionpsicologica.id','NOM_USU','APA_USU','AMA_USU')->get();
          $evaoto=EvaOto::where('ID_PAC','=',$id)->join('users','ID_MED','=','users.id')->select('FEC_OTO','evaluacionotorrino.id','NOM_USU','APA_USU','AMA_USU')->get();
          $evaoft=EvaOftalmo::where('ID_PAC','=',$id)->join('users','ID_MED','=','users.id')->select('FEC_OFT','evaluacionoftalmo.id','NOM_USU','APA_USU','AMA_USU')->get();
          $recetas=Receta::where('ID_PAC','=',$id)->join('users','ID_MED','=','users.id')->select('FEC_REC','recetas.id','NOM_USU','APA_USU','AMA_USU')->get();
          return redirect()->route('pacientes/{id}',['id'=>$id])->with('pacientes',$pacientes)->with('id',$id)->with('evamedi',$evamedi)->with('evapsi',$evapsi)->with('evaoto',$evaoto)->with('evaoft',$evaoft)->with('recetas',$recetas);
        }else{
        $pagelayout = array('165', '107.5');
        $pdf = new TCPDF('P','mm',$pagelayout, true, 'UTF-8', false);
        $pdf->SetTitle('RECETA MEDICA');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetAutoPageBreak(TRUE, 10);
        $pdf->SetMargins(15, 15, 10);
        $pdf->AddPage();


        $pdf->SetFont('','B','9');
        $pdf->SetXY(7, 35);
        $pdf->Write(0,'Paciente:','','',false);


        $paciente=Paciente::where('id','=',$id)->first();

        $nom=$paciente->NOM_PAC.' '.$paciente->APA_PAC.' '.$paciente->AMA_PAC;
        $pdf->SetXY(25, 35);
        $pdf->SetFont('','','8');
        $pdf->Write(0,ucwords(strtolower($nom)),'','',false);

        $pdf->SetFont('','B','9');
        $pdf->SetXY(9, 45);
        $pdf->Write(0,'Medico:','','',false);

        $pdf->SetXY(25, 45);
        $pdf->SetFont('','','8');
        $pdf->Write(0,Auth::user()->NOM_USU.' '.Auth::user()->APA_USU.' '.Auth::user()->AMA_USU,'','',false);

        $pdf->SetXY(10, 55);
        $pdf->SetFont('','B','14');
        $pdf->Write(0,'R.f.','','',false);

        $pdf->SetXY(10, 65);
        $pdf->SetFont('','','10');
        $pdf->MultiCell(150, 10,$receta->DES_REC, 0, 'L', 0, 0, '', '', true);

        $pdf->write2DBarcode ( 'Paciente :'.$paciente->NOM_PAC.' '.$paciente->APA_PAC.' '.$paciente->AMA_PAC.' | Medico: '.Auth::user()->NOM_USU.' '.Auth::user()->APA_USU.' '.Auth::user()->AMA_USU.' | Fecha:'.$receta->FEC_REC, 'QRCODE,M', 80, 135, 20, 20, '','','');


        $pdf->Output('Receta.pdf');
      }
    }

    public function finreceta($request)
    {
      $receta=new Receta;
      $receta->DES_REC=$request->input('rec_med');
      $receta->ID_PAC=$id;
      $receta->FEC_REC=Carbon::now();
      //$receta->save();
    }
    public function getpaciente(){
      $id= $_POST['id'];
      $consulta= Paciente::find($id);
      return Response::json( array(
      		'datos' => $consulta,
      		));
    }
    public function pdfexterna(Request $request, $id,$ids)
    { $ticket=Ticket::find($ids);
      if($ticket->IMP_TIC==0):
        $hist= Consultaext::where('ID_TIC','=',$ids)->orderby('id','DESC')->first();
        //dd($hist);
        if(isset($hist)):
          $historia= Consultaext::find($hist->id);
          $pediat= Antecpedia::where('ID_COE','=',$hist->id)->first();
        else:
          $historia= new Consultaext;
        endif;
        if(isset($pediat)):
          $pedia= Antecpedia::find($pediat->id);
        else:
          $pedia= new Antecpedia;
        endif;
        $anteco= Antecobs::where('ID_COE','=',$historia->id)->first();
        if(count($anteco)==0):
          $obs= new Antecobs;
        else:
          $obs= Antecobs::find($anteco->id);
        endif;
        $lact= Lactancia::where('ID_COE','=',$historia->id)->first();
        if(count($lact)==0):
          $lac= new Lactancia;
        else:
          $lac= Lactancia::find($lact->id);
        endif;
        $riesg= Riesgos::where('ID_COE','=',$historia->id)->first();
        if(count($riesg)==0):
          $rie= new Riesgos;
        else:
          $rie= Riesgos::find($lact->id);
        endif;
      else:
        $hist= Consultaext::where('ID_TIC','=',$ids)->orderby('id','DESC')->first();
        //dd($hist);
        if(count($hist)==0):
          $historia= new Consultaext;
        else:
          $historia= Consultaext::find($hist->id);
        endif;
        $pediat= Antecpedia::where('ID_COE','=',$hist->id)->first();
        if(count($pediat)==0):
          $pedia= new Antecpedia;
        else:
          $pedia= Antecpedia::find($pediat->id);
        endif;
        $anteco= Antecobs::where('ID_COE','=',$historia->id)->first();
        if(count($anteco)==0):
          $obs= new Antecobs;
        else:
          $obs= Antecobs::find($anteco->id);
        endif;
        $lact= Lactancia::where('ID_COE','=',$historia->id)->first();
        if(count($lact)==0):
          $lac= new Lactancia;
        else:
          $lac= Lactancia::find($lact->id);
        endif;
        $riesg= Riesgos::where('ID_COE','=',$historia->id)->first();
        if(count($riesg)==0):
          $rie= new Riesgos;
        else:
          $rie= Riesgos::find($lact->id);
        endif;
      endif;
      $ticket->IMP_TIC=1;
      $ticket->save();
      $historia->FEC_COE= Carbon::now();
      $historia->HCL_COE= 'HCL-'.$id;
      $historia->GLA_COE= $request->input('gla_coe');
      $historia->SAN_COE= $request->input('san_coe');
      $historia->FAC_COE= $request->input('fac_coe');
      $historia->ID_PAC= $id;
      $historia->ID_TIC= $ids;
      $historia->ID_MED= Auth::user()->id;
      $historia->save();

      $pedia->PES_ANP=$request->input('pes_anp');
      $pedia->ID_COE=$historia->id;
      $pedia->save();

      $obs->EMG_AOB=$request->input('emg_aob');
      $obs->EMP_AOB=$request->input('emp_aob');
      $obs->EMA_AOB=$request->input('ema_aob');
      $obs->EMC_AOB=$request->input('emc_aob');
      $obs->ID_COE=$historia->id;
      $obs->save();

      $lac->TIP_LAC=$request->input('lac');
      $lac->ID_COE=$historia->id;
      $lac->save();

      $rie->NID_RIE= $request->input('nip_rie');
      $rie->NIF_RIE= $request->input('nif_rie');
      $rie->HIP_RIE= $request->input('hip_rie');
      $rie->HIF_RIE= $request->input('hif_rie');
      $rie->DIP_RIE= $request->input('dip_rie');
      $rie->DIF_RIE= $request->input('dif_rie');
      $rie->TUP_RIE= $request->input('tup_rie');
      $rie->TUF_RIE= $request->input('tuf_rie');
      $rie->SIP_RIE= $request->input('sip_rie');
      $rie->SIF_RIE= $request->input('sif_rie');
      $rie->TRP_RIE= $request->input('trp_rie');
      $rie->TRF_RIE= $request->input('trf_rie');
      $rie->CIP_RIE= $request->input('cip_rie');
      $rie->CIF_RIE= $request->input('cif_rie');
      $rie->SNP_RIE= $request->input('snp_rie');
      $rie->SNF_RIE= $request->input('snf_rie');
      $rie->OBP_RIE= $request->input('obp_rie');
      $rie->OBF_RIE= $request->input('obf_rie');
      $rie->DEP_RIE= $request->input('dep_rie');
      $rie->DEF_RIE= $request->input('def_rie');
      $rie->DRP_RIE= $request->input('drp_rie');
      $rie->DRF_RIE= $request->input('drf_rie');
      $rie->ALP_RIE= $request->input('alp_rie');
      $rie->ALF_RIE= $request->input('alf_rie');
      $rie->TAP_RIE= $request->input('tap_rie');
      $rie->TAF_RIE= $request->input('taf_rie');
      $rie->OTP_RIE= $request->input('otp_rie');
      $rie->OTF_RIE= $request->input('otf_rie');
      $rie->ID_COE= $historia->id;
      $rie->save();

      $razonreset=Razoncuidado::where('ID_COE','=',$historia->id)->delete();
      $perireset=Observacionesper::where('ID_ANP','=',$pedia->id)->delete();
      $embreset=Embarazo::where('ID_ACO','=',$obs->id)->delete();
      $antireset=Anticoncepcion::where('ID_COE','=',$historia->id)->delete();
      $facreset=Factoriesgo::where('ID_COE','=',$historia->id)->delete();
      $patreset=Antecpat::where('ID_COE','=',$historia->id)->delete();
      $enfreset=Medcronic::where('ID_COE','=',$historia->id)->delete();
      $j=count($request->input('rcu'));
      //dd($request->input('rcu'));
      for($i=1; $i<$j; $i++)
      {
        //dd($request->input('rcu.'.$i));
        $razon= new Razoncuidado;
        $razon->DES_RUC=$request->input('rcu.'.$i);
        $razon->ID_COE=$historia->id;
        $razon->save();
      }
      for($i=1; $i<count($request->input('obs_per')); $i++)
      {
        //dd($request->input('rcu.'.$i));
        $peri= new Observacionesper;
        $peri->DES_OBP=$request->input('obs_per.'.$i);
        $peri->ID_ANP=$pedia->id;
        $peri->save();
      }
      for($i=1; $i<count($request->input('ani_emb')); $i++)
      {
        //dd($request->input('rcu.'.$i));
        $emb= new Embarazo;
        $emb->ANI_EMB=$request->input('ani_emb.'.$i);
        $emb->DUR_EMB=$request->input('dur_emb.'.$i);
        $emb->VAG_EMB=$request->input('vag_emb.'.$i);
        $emb->CES_EMB=$request->input('ces_emb.'.$i);
        $emb->VIV_EMB=$request->input('viv_emb.'.$i);
        $emb->MUE_EMB=$request->input('mue_emb.'.$i);
        $emb->FPA_EMB=$request->input('fpa_emb.'.$i);
        $emb->RES_EMB=$request->input('res_emb.'.$i);
        $emb->ID_ACO=$obs->id;
        $emb->save();
      }
      for($i=1; $i<count($request->input('ini_anc')); $i++)
      {
        //dd($request->input('rcu.'.$i));
        $aco= new Anticoncepcion;
        $aco->INI_ANC=$request->input('ini_anc.'.$i);
        $aco->MET_ANC=$request->input('met_anc.'.$i);
        $aco->CON_ANC=$request->input('con_anc.'.$i);
        $aco->ORI_ANC=$request->input('ori_anc.'.$i);
        $aco->ID_COE=$historia->id;
        $aco->save();
      }
      for($i=1; $i<count($request->input('des_far')); $i++)
      {
        //dd($request->input('rcu.'.$i));
        $fac= new Factoriesgo;
        $fac->DES_FAR=$request->input('des_far.'.$i);
        $fac->ID_COE=$historia->id;
        $fac->save();
      }
      for($i=1; $i<count($request->input('hos_apa')); $i++)
      {
        //dd($request->input('rcu.'.$i));
        $apa= new Antecpat;
        $apa->HOS_APA=$request->input('hos_apa.'.$i);
        $apa->ANI_APA=$request->input('ani_apa.'.$i);
        $apa->EVA_APA=$request->input('eva_apa.'.$i);
        $apa->ID_COE=$historia->id;
        $apa->save();
      }
      for($i=1; $i<count($request->input('med_mcr')); $i++)
      {
        //dd($request->input('rcu.'.$i));
        $medcr= new Medcronic;
        $medcr->MED_MCR=$request->input('med_mcr.'.$i);
        $medcr->DOS_MCR=$request->input('dos_mcr.'.$i);
        $medcr->FIN_MCR=$request->input('fin_mcr.'.$i);
        $medcr->ID_COE=$historia->id;
        $medcr->save();
      }
      if(isset($_POST['guardar'])):
        $mensaje= "Consulta externa guardada correctamente";
        return redirect()->route('externa.index',[$id,$ids])->with('mensaje',$mensaje);
      else:
      $pagelayout = array('165', '107.5');
      $pdf = new TCPDF('P','mm','LETTER', true, 'UTF-8', false);
      $pdf->SetTitle('Consulta externa - DARSALUD');
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);
      $pdf->SetAutoPageBreak(TRUE, 10);
      $pdf->SetMargins(15, 15, 10);
      $pdf->AddPage();

      // Margenes
      $pdf->Line ( 5, 5,210,5,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 12, 89)));
      $pdf->Line ( 5, 5,5,273,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 12, 89)));
      $pdf->Line ( 5, 273,210,273,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 12, 89)));
      $pdf->Line ( 210, 5,210,273,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 12, 89)));
      //end margenes
      $pdf->Line ( 5, 70,210,70,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 12, 89)));
      $pdf->Line ( 140, 5,140,70,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 12, 89)));
      $pdf->Image('img/logo.png', 7, 7, 20, 20, 'PNG', '', '', true, 250, '', false, false, false, false, false, false);

      $pdf->SetFont('','B','11');
      $pdf->SetXY(87, 9);
      $pdf->Write(0,'HISTORIA BASICA','','',false);
      $pdf->SetFont('','B','11');
      $pdf->SetXY(85, 16);
      $pdf->Write(0,'CONSULTA EXTERNA','','',false);
      $pdf->SetFont('','B','9');

      $pdf->SetXY(143, 15);
      $pdf->Write(0,'N° Historia clinica:','','',false);
      $pdf->SetFont('','B','9');

      $pdf->SetXY(143, 22);
      $pdf->Write(0,'Alergias:','','',false);
      $pdf->SetFont('','B','9');

      $pdf->SetXY(143, 35);
      $pdf->Write(0,'Sanguineo:','','',false);
      $pdf->SetFont('','B','9');
      $pdf->SetXY(175, 35);
      $pdf->Write(0,'Factor:','','',false);
      $pdf->SetFont('','B','9');

      $pdf->SetXY(143, 44);
      $pdf->Write(0,'Razon de especial cuidado:','','',false);
      $pdf->SetFont('','B','9');

      $paciente=Paciente::where('id','=',$id)->first();

      $pdf->SetXY(13, 37);
      $pdf->Write(0,'Apellido Paterno','','',false);
      $pdf->SetFont('','B','9');
      $pdf->Line ( 8, 36,43,36,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));

      $pdf->SetXY(53, 37);
      $pdf->Write(0,'Apellido Materno','','',false);
      $pdf->SetFont('','B','9');
      $pdf->Line ( 47, 36,87,36,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));

      $pdf->SetXY(107, 37);
      $pdf->Write(0,'Nombres','','',false);
      $pdf->SetFont('','B','9');
      $pdf->Line ( 93, 36,135,36,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));

      $pdf->SetXY(10, 50);
      $pdf->Write(0,'Fecha de Nacimiento','','',false);
      $pdf->SetFont('','B','9');
      $pdf->Line ( 8, 49,43,49,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));

      $pdf->SetXY(57, 50);
      $pdf->Write(0,'Edad','','',false);
      $pdf->SetFont('','B','9');
      $pdf->Line (52, 49,72,49,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));

      $pdf->SetXY(90, 50);
      $pdf->Write(0,'Genero','','',false);
      $pdf->SetFont('','B','9');
      $pdf->Line ( 77, 49,120,49,array('width' => 0.3,'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));

      $pdf->SetXY(10, 55);
      $pdf->Write(0,'Profesion u oficio:','','',false);
      $pdf->SetFont('','B','9');

      $pdf->SetXY(80, 55);
      $pdf->Write(0,'Fecha de ingreso: ','','',false);
      $pdf->SetFont('','B','9');

      $pdf->SetXY(10, 60);
      $pdf->Write(0,'Direccion:','','',false);
      $pdf->SetFont('','B','9');

      $pdf->SetXY(10, 65);
      $pdf->Write(0,'Telefono:','','',false);
      $pdf->SetFont('','B','9');

      $pdf->SetXY(10, 75);
      $html='
      <table border="1">
        <thead>
          <tr>
            <td align="center" colspan="1" width="20%">
            Antecedentes<br>pediatricos
            </td>
            <td align="center" colspan="8" width="60%">
            Antecedentes obstetricos
            </td>
            <td align="center" rowspan="3" colspan="4" width="20%">
            Anticoncepcion
            </td>
          </tr>
          <tr>
            <td >
            Peso R.N.
            </td>
            <td align="center" colspan="8">
            Embarazo: G........................ P........................A........................C........................
            </td>
          </tr>
          <tr>
            <td  align="center"colspan="1">
            </td>
            <td align="center" rowspan="2" colspan="1"> Año
            </td>
            <td align="center" rowspan="1"> Duracion <br> meses
            </td>
            <td align="center" colspan="2"> Tipo de parto
            </td>
            <td align="center" colspan="2"> Nro de recien <br> nacidos
            </td>
            <td align="center" colspan="2"> PAP Colposcopia
            </td>
            <td align="center" colspan="4">
            </td>
          </tr>
          <tr>
            <td align="center">Observaciones Perinatales
            </td>
            <td align="center">
            </td>
            <td align="center">Vaginal
            </td>
            <td align="center">Cesarea
            </td>
            <td align="center">Vivos
            </td>
            <td align="center">Muertos
            </td>
            <td align="center">Fecha
            </td>

            <td align="center"><font size="8">Resultado</font>
            </td>
            <td align="center"><font size="7">Inicio</font>
            </td>
            <td align="center"><font size="7">Metodo</font>
            </td>
            <td align="center"><font size="7">Control</font>
            </td>
            <td align="center"><font size="7">Orientacion</font>
            </td>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
      ';
      $pdf->writeHTML($html, true, false, true, false, '');
      $pdf->write2DBarcode ( 'Paciente :'.$paciente->NOM_PAC.' '.$paciente->APA_PAC.' '.$paciente->AMA_PAC.' | Medico: '.Auth::user()->NOM_USU.' '.Auth::user()->APA_USU.' '.Auth::user()->AMA_USU.' | Fecha:'.'$receta->FEC_REC', 'QRCODE,M', 180, 240, 25, 25, '','','');


      $pdf->Output('Consulta externa.pdf');
      endif;
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
