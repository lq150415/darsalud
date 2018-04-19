<?php

namespace Darsalud\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use Darsalud\Ticket;
use Darsalud\Paciente;
use Darsalud\EvaMedi;
use Darsalud\EvaPsico;
use Darsalud\Http\Requests;
use Darsalud\Http\Controllers\Controller;
use Carbon\Carbon;

class ExcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
   public function actionIndex()
 {

  Excel::create('LISTA DIARIA SEGIP', function($excel)
  {
   $excel->sheet('Sheetname', function($sheet)
   {
     $pacientes= Ticket::join('pacientes','pacientes.id','=','ID_PAC')->join('evaluacionmedica','evaluacionmedica.ID_TIC','=','ticket.id')->where('FEC_MED','>=',Carbon::now()->format('Y-m-d'))->where('EST_TIC','=',2)->get();


    $sheet->mergeCells('A1:J1');
    $sheet->mergeCells('A2:I2');
    $sheet->setMergeColumn(array(
        'columns'=>array('J'),
        'rows'=>array(
            array(2,6),
            )
    ));
    $sheet->mergeCells('C3:F3');
    $sheet->mergeCells('A3:B3');
    $sheet->mergeCells('A4:B4');
    $sheet->mergeCells('A5:B5');
    $sheet->mergeCells('A6:B6');
    $sheet->mergeCells('C4:F4');
    $sheet->mergeCells('C5:F5');
    $sheet->mergeCells('C6:F6');

    $sheet->setBorder('J2:J6', 'thin');
    $sheet->setBorder('A8:J103', 'thin');
    $sheet->cells('J2:J6',function($cells)
    {
     $cells->setBackground('#FFFFFF');
     $cells->setFontColor('#2F75B5');
     $cells->setAlignment('center');
     $cells->setValignment('center');
     $cells->setFontFamily('Calibri');
     $cells->setFontSize(16);
    });
    $sheet->cells('H8:H103',function($cells)
    {
     $cells->setBackground('#FFF2CC');
     $cells->setFontColor('#000000');
     $cells->setAlignment('center');
     $cells->setValignment('center');
     $cells->setFontFamily('Calibri');
     $cells->setFontSize(11);
    });
    $sheet->cells('I8:I103',function($cells)
    {
     $cells->setBackground('#8EA9DB');
     $cells->setFontColor('#000000');

     $cells->setFontFamily('Calibri');
     $cells->setFontSize(11);
    });
    $sheet->cells('J8',function($cells)
    {
     $cells->setBackground('#92D050');
     $cells->setFontColor('#000000');

     $cells->setFontFamily('Calibri');
     $cells->setFontSize(11);
    });
    $sheet->cells('J9:J103',function($cells)
    {
     $cells->setBackground('#FFFFFF');
     $cells->setFontColor('#000000');

     $cells->setFontFamily('Calibri');
     $cells->setFontSize(11);
    });
    $sheet->cells('C2:C6',function($cells)
    {
     $cells->setBackground('#FFFFFF');
     $cells->setFontColor('#000000');
     $cells->setFontFamily('Calibri');
     $cells->setFontSize(10);
    });
    $sheet->cells('A1:J1', function($cells)
    {
     $cells->setBackground('#FFFFFF');
     $cells->setFontColor('#000000');
     $cells->setAlignment('center');
     $cells->setValignment('center');
     $cells->setFontFamily('Calibri');
     $cells->setFontSize(22);
    });
    $sheet->cells('A2:I2', function($cells)
    {
     $cells->setBackground('##F8CBAD');
     $cells->setFontColor('#000000');
     $cells->setAlignment('center');
     $cells->setValignment('center');
     $cells->setFontFamily('Calibri');
     $cells->setFontSize(10);
    });
    $sheet->cells('A8:G8', function($cells)
    {
     $cells->setBackground('##F8CBAD');
     $cells->setFontColor('#000000');
     $cells->setAlignment('center');
     $cells->setValignment('center');
     $cells->setFontFamily('Calibri');
     $cells->setFontSize(8);
    });
    $sheet->cells('H8:J8', function($cells)
    {
     $cells->setFontSize(8);
     $cells->setAlignment('center');
     $cells->setValignment('center');
    });
    $sheet->cells('A3:B3', function($cells)
    {
     $cells->setBackground('#BDD7EE');
     $cells->setFontColor('#000000');
     $cells->setFontFamily('Calibri');
     $cells->setFontSize(8);
     $cells->setFontWeight('bold');
    });
    $sheet->cells('C3:C6', function($cells)
    {

     $cells->setFontColor('#000000');
     $cells->setFontFamily('Calibri');
     $cells->setFontSize(8);
     $cells->setFontWeight('bold');
    });
    $sheet->cells('A4:B4', function($cells)
    {
     $cells->setBackground('#BDD7EE');
     $cells->setFontColor('#000000');
     $cells->setFontFamily('Calibri');
     $cells->setFontSize(8);
     $cells->setFontWeight('bold');
    });
    $sheet->cells('A5:B5', function($cells)
    {
     $cells->setBackground('#BDD7EE');
     $cells->setFontColor('#000000');
     $cells->setFontFamily('Calibri');
     $cells->setFontSize(8);
     $cells->setFontWeight('bold');
    });
    $sheet->cells('A6:B6', function($cells)
    {
     $cells->setBackground('#BDD7EE');
     $cells->setFontColor('#000000');
     $cells->setFontFamily('Calibri');
     $cells->setFontSize(8);
     $cells->setFontWeight('bold');
    });
    $sheet->cells('A9:A103',function($cells)
    {
     $cells->setBackground('#ffffff');
     $cells->setFontColor('#000000');
     $cells->setAlignment('center');
     $cells->setFontFamily('Calibri');
     $cells->setFontSize(11);
    });
    $sheet->cells('G9:G103',function($cells)
    {
     $cells->setBackground('#ffffff');
     $cells->setFontColor('#000000');
     $cells->setFontFamily('Calibri');
     $cells->setFontSize(11);
    });
    $sheet->cells('B9:F103',function($cells)
    {
     $cells->setBackground('#FFFFFF');
     $cells->setFontColor('#000000');
     $cells->setAlignment('center');
     $cells->setValignment('center');
     $cells->setFontFamily('Calibri');
     $cells->setFontSize(11);
    });
    $sheet->setWidth(array
     (
      'A' => '5.71',
      'B' => '17.14',
      'C' => '28.86',
      'D' => '24.43',
      'E' => '28.71',
      'F' => '9.43',
      'G' => '20.14',
      'H' => '17.29',
      'I' => '32.14',
      'J' => '22.14'
     )
    );

    $sheet->setHeight(array
     (
      '1' => '28.5',
      '2' => '15',
      '3' => '15',
      '4' => '15',
      '5' => '15',
      '6' => '15',
      '7' => '4.5',
      '8' => '64.50',
      '9' => '67.50',
      '10' => '67.50',
      '11' => '67.50',
      '12' => '67.50',
      '13' => '67.50',
      '14' => '67.50',
      '15' => '67.50',
      '16' => '67.50',
      '17' => '67.50',
      '18' => '67.50',
      '19' => '67.50',
      '20' => '67.50',
      '21' => '67.50',
      '22' => '67.50',
      '23' => '67.50',
      '24' => '67.50',
      '25' => '67.50',
      '26' => '67.50',
      '27' => '67.50',
      '28' => '67.50',
      '29' => '67.50',
      '30' => '67.50',
      '31' => '67.50',
      '32' => '67.50',
      '33' => '67.50',
      '34' => '67.50',
      '35' => '67.50',
      '36' => '67.50',
      '37' => '67.50',
      '38' => '67.50',
      '39' => '67.50',
      '40' => '67.50',
      '41' => '67.50',
      '42' => '67.50',
      '43' => '67.50',
      '44' => '67.50',
      '45' => '67.50',
      '46' => '67.50',
      '47' => '67.50',
      '48' => '67.50',
      '49' => '67.50',
      '50' => '67.50',
      '51' => '67.50',
      '52' => '67.50',
      '53' => '67.50',
      '54' => '67.50',
      '55' => '67.50',
      '56' => '67.50',
      '57' => '67.50',
      '58' => '67.50',
      '59' => '67.50',
      '60' => '67.50',
      '61' => '67.50',
      '62' => '67.50',
      '63' => '67.50',
      '64' => '67.50',
      '65' => '67.50',
      '66' => '67.50',
      '67' => '67.50',
      '68' => '67.50',
      '69' => '67.50',
      '70' => '67.50',
      '71' => '67.50',
      '72' => '67.50',
      '73' => '67.50',
      '74' => '67.50',
      '75' => '67.50',
      '76' => '67.50',
      '77' => '67.50',
      '78' => '67.50',
      '79' => '67.50',
      '80' => '67.50',
      '81' => '67.50',
      '82' => '67.50',
      '83' => '67.50',
      '84' => '67.50',
      '85' => '67.50',
      '86' => '67.50',
      '87' => '67.50',
      '88' => '67.50',
      '89' => '67.50',
      '90' => '67.50',
      '91' => '67.50',
      '92' => '67.50',
      '93' => '67.50',
      '94' => '67.50',
      '95' => '67.50',
      '96' => '67.50',
      '97' => '67.50',
      '98' => '67.50',
      '99' => '67.50',
      '100' => '67.50',
      '101' => '67.50',
      '102' => '67.50',
      '103' => '67.50',


     )
    );



    $data = array(
    array('LISTA DE CIUDADANOS EVALUADOS'),
    array('DEBERA SER LLENADO POR EL CENTRO DE EVALUACION MEDICA',' ','','','','','','','','F-M01'),
    array('Centro Médico',' ','DAR SALUD'),
    array('Departamento',' ','LA PAZ'),
    array('Localidad',' ','LA PAZ MURILLO'),
    array('Fecha actual',' ',Carbon::now()->format('d/m/Y')),
    array('',' ',''),
    array('Número','Número de cédula de identidad','Nombres','Primer Apellido','Segundo Apellido','Categoria a la que se postula (M)(P)(A)(B)(C)(T)','Fecha de emision','Fotografia','APTO/NO APTO','Descripcion del impedimento en caso de ser NO APTO'),

    );

    $sheet->fromArray($data, null, 'A1', false, false);
    $sheet->loadView('excel')->with('pacientes',$pacientes);
   });
  })->export('xlsx');

  //return View::make('index');
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
