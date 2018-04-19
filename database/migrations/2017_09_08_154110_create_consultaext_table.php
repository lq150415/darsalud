<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultaextTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('consultaext', function (Blueprint $table) {
        $table->increments('id');
        $table->timestamps('FEC_COE');
        $table->text('HCL_COE');
        $table->text('GLA_COE');
        $table->text('SAN_COE');
        $table->text('FAC_COE');


        $table->integer('ID_PAC')->unsigned();
            $table->foreign('ID_PAC')->references('id')->on('pacientes');

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
