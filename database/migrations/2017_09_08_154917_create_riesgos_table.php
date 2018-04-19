<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRiesgosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('riesgos', function (Blueprint $table) {
        $table->int('id',11);
        $table->int('NID_RIE',11);
        $table->int('NIF_RIE',11);
        $table->int('HIP_RIE',11);
        $table->int('HIF_RIE',11);
        $table->int('DIP_RIE',11);
        $table->int('DIF_RIE',11);
        $table->int('TUP_RIE',11);
        $table->int('TUF_RIE',11);
        $table->int('SIP_RIE',11);
        $table->int('SIF_RIE',11);
        $table->int('TRP_RIE',11);
        $table->int('TRF_RIE',11);
        $table->int('CIP_RIE',11);
        $table->int('CIF_RIE',11);
        $table->int('SNP_RIE',11);
        $table->int('SNF_RIE',11);
        $table->int('OBP_RIE',11);
        $table->int('OBF_RIE',11);
        $table->int('DEP_RIE',11);
        $table->int('DEF_RIE',11);
        $table->int('DRP_RIE',11);
        $table->int('DRF_RIE',11);
        $table->int('ALP_RIE',11);
        $table->int('ALF_RIE',11);
        $table->int('TAP_RIE',11);
        $table->int('TAF_RIE',11);
        $table->int('OTP_RIE',11);
        $table->int('OTF_RIE',11);

        $table->integer('ID_COE')->unsigned();
        $table->foreign('ID_COE')->references('id')->on('consultaext');



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
