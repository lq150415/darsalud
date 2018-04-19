<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluacionoftalmoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('evaluacionoftalmo', function (Blueprint $table) {
        $table->int('id',11);
        $table->timestamps('FEC_OFT');
        $table->varchar('ULE_OFT',45);
        $table->timestamps('UCV_OFT');
        $table->text('VBI_OFT');
        $table->text('SAL_OFT');
        $table->text('ROD_OFT');
        $table->text('ROI_OFT');
        $table->text('ESD_OFT');
        $table->text('ESI_OFT');
        $table->text('CID_OFT');
        $table->text('CII_OFT');
        $table->text('EJD_OFT');
        $table->text('EJI_OFT');
        $table->text('AVD_OFT');
        $table->text('AVI_OFT');
        $table->text('CDI_OFT');
        $table->text('CRC_OFT');
        $table->text('RUS_OFT');
        $table->text('RMA_OFT');
        $table->text('OBS_OFT');
        $table->text('RFO_OFT');


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
