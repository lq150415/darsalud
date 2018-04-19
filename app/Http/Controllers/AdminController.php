<?php

namespace Darsalud\Http\Controllers;

use Illuminate\Http\Request;

use Darsalud\Http\Requests;
use Darsalud\Http\Controllers\Controller;
use Darsalud\User;
use DB;
use Darsalud\Ticket;
use Darsalud\Especialidad;

class AdminController extends Controller
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

    public function repmedicos()
    {
      $user= User::where('NIV_USU','=',2)->get();
      return view('administrador.repmedicos')->with('usuario',$user);
    }
    public function repventas()
    {
      $user= User::where('NIV_USU','=',2)->get();
      return view('administrador.repventas')->with('usuario',$user);
    }
    public function repevaluacion()
    {
      $user= User::where('NIV_USU','=',2)->get();
      $especialidad= Especialidad::get();
      return view('administrador.repevaluacion')->with('usuario',$user)->with('especialidad',$especialidad);
    }
    public function adminusuarios(){
      $user= User::get();
      return view('administrador.usuarios')->with('users',$user);
    }
    public function adminproductos(){

    }
    public function admregistrarusuarios(Request $request){
      $usuario = new User;
      $usuario->NOM_USU= $request->input('nom_usu');
      $usuario->APA_USU= $request->input('apa_usu');
      $usuario->AMA_USU= $request->input('ama_usu');
      $usuario->EMA_USU= 0;
      $usuario->EST_USU= 'Sin asignar';
      $usuario->ARE_USU= $request->input('are_usu');
      $usuario->TEL_USU= $request->input('tel_usu');
      $usuario->CI_USU= 0;
      $usuario->NIV_USU= $request->input('niv_usu');
      $usuario->NIC_USU= $request->input('nic_usu');
      $usuario->password= bcrypt($request->input('pas_usu'));
      $usuario->save();
      $mensaje='Usuario registrado correctamente';
       return redirect()->route('adminusuarios')->with('mensaje',$mensaje);
    }
    public function admmodificarusuarios(Request $request){
      $usuario = User::find($request->input('id_usu'));
      $usuario->NOM_USU= $request->input('nom_usu');
      $usuario->APA_USU= $request->input('apa_usu');
      $usuario->AMA_USU= $request->input('ama_usu');
      $usuario->EST_USU= $request->input('est_usu');
      $usuario->NIV_USU= $request->input('niv_usu');
      $usuario->TEL_USU= $request->input('tel_usu');
      $usuario->ARE_USU= $request->input('are_usu');
      $usuario->NIC_USU= $request->input('nic_usu');
      $usuario->save();
      $mensaje='Datos de usuario modificados correctamente';
       return redirect()->route('adminusuarios')->with('mensaje',$mensaje);
    }
    public function admmodificarpass(Request $request){
      $usuario = User::find($request->input('idcon'));
      $usuario->password= bcrypt($request->input('conusu'));
      $usuario->save();
      $mensaje='Contraseña modificada correctamente';
       return redirect()->route('adminusuarios')->with('mensaje',$mensaje);
    }
    public function admeliminarusuario(Request $request){
      $usuario = User::find($request->input('ideli'));
      $usuario->delete();
      $mensaje='Usuario eliminado correctamente';
       return redirect()->route('adminusuarios')->with('mensaje2',$mensaje);
    }
    public function graficos(){
      $medica = Ticket::select(DB::raw("count(*) as count , month(created_at) as mes"))->where('EVA_TIC','=','Evaluacion medica')->groupBy(DB::raw("month(created_at)"))->orderBy(DB::raw("month(created_at)"))
       ->get()->toArray();
      $psico = Ticket::select(DB::raw("count(*) as count , month(created_at) as mes"))->orderBy(DB::raw("month(created_at)"))->where('EVA_TIC','=','Evaluacion psicologica')
       ->groupBy(DB::raw("month(created_at)"))
       ->get()->toArray();
      $oftalmo = Ticket::select(DB::raw("count(*) as count , month(created_at) as mes"))->orderBy(DB::raw("month(created_at)"))->where('EVA_TIC','=','Evaluacion oftalmologica')
       ->groupBy(DB::raw("month(created_at)"))
       ->get()->toArray();
      $externa = Ticket::select(DB::raw("count(*) as count , month(created_at) as mes"))->orderBy(DB::raw("month(created_at)"))->where('EVA_TIC','=','Consulta externa')
       ->groupBy(DB::raw("month(created_at)"))
       ->get()->toArray();
      $total = Ticket::select(DB::raw("count(*) as count , month(created_at) as mes, EVA_TIC as eva"))->orderBy(DB::raw("month(created_at)"))
       ->groupBy(DB::raw("month(created_at)"))
       ->get()->toArray();
      $total2 = Ticket::select(DB::raw("count(*) as count , month(created_at) as mes, EVA_TIC as eva"))->orderBy(DB::raw("month(created_at)"))->orderBy(DB::raw("eva_tic"))
       ->groupBy(DB::raw("month(created_at)"))->groupBy(DB::raw("eva_tic"))
       ->get()->toArray();

   return view('administrador.graficos')
           ->with('medica',json_encode($medica,JSON_NUMERIC_CHECK))
           ->with('psico',json_encode($psico,JSON_NUMERIC_CHECK))
           ->with('oftalmo',json_encode($oftalmo,JSON_NUMERIC_CHECK))
           ->with('externa',json_encode($externa,JSON_NUMERIC_CHECK))
           ->with('total',json_encode($total,JSON_NUMERIC_CHECK))
           ->with('total2',json_encode($total2,JSON_NUMERIC_CHECK));
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
