<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotasevolucionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('laboratorios', function (Blueprint $table) {
        $table->int('id',11);
        $table->timestamps('FEC_NEV');
        $table->varchar('NNN_NEV',45);
        $table->varchar('RRR_NEV',45);
        $table->int('EAC_NEV',11);
        $table->float('PES_NEV');
        $table->float('TAL_NEV');
        $table->text('PA_NEV');
        $table->text('FC_NEV');
        $table->text('TEM_NEV');
        $table->text('FUM_NEV');
        $table->text('SUB_NEV');
        $table->text('OBJ_NEV');
        $table->text('ANA_NEV');
        $table->text('PLA_NEV');


        $table->integer('ID_COE')->unsigned();
        $table->foreign('ID_COE')->references('id')->on('consultaext');

        $table->integer('ID_MED')->unsigned();
        $table->foreign('ID_MED')->references('id')->on('evaluacionmedica');


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
