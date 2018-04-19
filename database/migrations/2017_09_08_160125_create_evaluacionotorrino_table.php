<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluacionotorrinoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('evaluacionotorrino', function (Blueprint $table) {
        $table->int('id',11);
        $table->timestamps('FEC_OTO');
        $table->varchar('LUGNAC_OTO',100);
        $table->text('ANT_OTO');
        $table->text('EFI_OTO');
        $table->text('CON_OTO');
        $table->varchar('RFI_OTO',1000);


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
