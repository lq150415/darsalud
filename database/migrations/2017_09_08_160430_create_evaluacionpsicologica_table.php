<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluacionpsicologicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('evaluacionpsicologica', function (Blueprint $table) {
        $table->int('id',11);
        $table->timestamps('FEC_PSI');
        $table->text('LUGNAC_PSI');
        $table->text('HIS_PSI');
        $table->text('EX1_PSI');
        $table->text('EX2_PSI');
        $table->text('EX3_PSI');
        $table->text('EX4_PSI');
        $table->text('RFI_PSI');




        $table->integer('ID_PAC')->unsigned();
        $table->foreign('ID_PAC')->references('id')->on('pacientes');

        $table->integer('ID_MED')->unsigned();
        $table->foreign('ID_MED')->references('id')->on('evaluacionmedica');

        $table->integer('ID_TIC')->unsigned();
        $table->foreign('ID_TIC')->references('id')->on('ticket');


            $table->timestamps();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
