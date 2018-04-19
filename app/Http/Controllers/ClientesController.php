<?php

namespace Darsalud\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Darsalud\Http\Requests;
use Darsalud\Http\Controllers\Controller;
use Darsalud\Paciente;
use Darsalud\Producto;
use Darsalud\Reserva;
use Activity;
use Darsalud\Especialidad;
use Darsalud\User;
use Darsalud\Ticket;
use Carbon\Carbon;
use Darsalud\Laboratorio;
class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->NIV_USU==3){
        return view('index');
        }
        elseif(Auth::user()->NIV_USU==2){
          $reservas= Reserva::join('ticket','ticket.id','=','ID_TIC')->join('pacientes','pacientes.id','=','ticket.ID_PAC')->join('users','users.id','=','ticket.ID_MED')->where('EST_TIC','!=',2)->where('FEC_RES','>=',Carbon::now()->toDateString())->where('ID_MED','=',Auth::user()->id)->get();
        return view('indexmed')->with('reservas',$reservas);
        }
        elseif(Auth::user()->NIV_USU==1){
        return view('administrador.indexadmin');
        }
    }

    public function index3()
    {
          $pacientes = Paciente::OrderBy('updated_at','DESC')->get();
           $actividades = Activity::users(600)->get();
           $especialidades = Especialidad::where('TIP_ESP','=',1)->get();
            $especialidades2 = Especialidad::where('TIP_ESP','=',2)->get();
            $medicos = User::where('NIV_USU','=',2)->get();
           return view('registropacientes2')->with('pacientes',$pacientes)->with('actividades',$actividades)->with('especialidades',$especialidades)->with('especialidades2',$especialidades2)->with('medicos',$medicos);
    }
    public function factura()
    {
        return view('factura');
    }
    public function farmacia()
    {
        $productos= Producto::get();
        return view('farmacia')->with('productos',$productos);
    }
     public function reservas()
    {
        if(Auth::user()->NIV_USU==3):
        $reservas= Reserva::join('ticket','ticket.id','=','ID_TIC')->join('pacientes','pacientes.id','=','ticket.ID_PAC')->join('users','users.id','=','ticket.ID_MED')->where('EST_TIC','!=',2)->get();
        return view('reserva')->with('reservas',$reservas);
        endif;
        if(Auth::user()->NIV_USU==2):
            $reservas= Reserva::join('ticket','ticket.id','=','ID_TIC')->join('pacientes','pacientes.id','=','ticket.ID_PAC')->join('users','users.id','=','ticket.ID_MED')->where('EST_TIC','!=',2)->where('ID_MED','=',Auth::user()->id)->get();
        return view('reservamed')->with('reservas',$reservas);
        endif;

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
    public function laboratorios()
    {
        $id = $_POST['id'];
        $laboratorios = Laboratorio::where('ID_CAL','=',$id)->get();
        $i=1;
        $html2 ='
        <option value="">SELECCIONE</option>';
        foreach ($laboratorios as $laboratorio ) {
            $html2=$html2.'<option value="'.$laboratorio->id.'">'.$laboratorio->DES_LAB.'</option>';
        }
       //   dd($html2);
          echo $html2;


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
