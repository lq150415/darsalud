<?php

namespace Darsalud\Http\Controllers;

use Illuminate\Http\Request;

use Darsalud\Http\Requests;
use Darsalud\Http\Controllers\Controller;
use Darsalud\Paciente;
use Darsalud\Evamedi;
use Darsalud\EvaPsico;
use Darsalud\EvaOto;
use Darsalud\EvaOftalmo;
use Darsalud\Receta;
use Darsalud\Notasevolucion;

class HistoriaBasicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id)

    {
        $pacientes= Paciente::find($id);
        $evamedi=Evamedi::where('ID_PAC','=',$id)->join('users','ID_USU','=','users.id')->select('FEC_MED','evaluacionmedica.id','NOM_USU','APA_USU','AMA_USU')->get();
        $evapsi=EvaPsico::where('ID_PAC','=',$id)->join('users','ID_MED','=','users.id')->select('FEC_PSI','evaluacionpsicologica.id','NOM_USU','APA_USU','AMA_USU')->get();
        $evaoto=EvaOto::where('ID_PAC','=',$id)->join('users','ID_MED','=','users.id')->select('FEC_OTO','evaluacionotorrino.id','NOM_USU','APA_USU','AMA_USU')->get();
        $evaoft=EvaOftalmo::where('ID_PAC','=',$id)->join('users','ID_MED','=','users.id')->select('FEC_OFT','evaluacionoftalmo.id','NOM_USU','APA_USU','AMA_USU')->get();
        $recetas=Receta::where('ID_PAC','=',$id)->join('users','ID_MED','=','users.id')->select('FEC_REC','recetas.id','NOM_USU','APA_USU','AMA_USU')->get();
        $notas= Notasevolucion::where('ID_PAC','=',$id)->join('users','ID_MED','=','users.id')->get();

        return  view('historiabasica')->with('pacientes',$pacientes)->with('notas',$notas)->with('id',$id)->with('evamedi',$evamedi)->with('evapsi',$evapsi)->with('evaoto',$evaoto)->with('evaoft',$evaoft)->with('recetas',$recetas);

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
