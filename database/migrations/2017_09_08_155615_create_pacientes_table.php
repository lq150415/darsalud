<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('pacientes', function (Blueprint $table) {
        $table->int('id',11);
        $table->varchar('NOM_PAC',45);
        $table->varchar('APA_PAC',45);
        $table->varchar('AMA_PAC',45);
        $table->varchar('SEX_PAC',20);
        $table->varchar('CI_PAC',20);
        $table->date('FEC_PAC');
        $table->bigint('REF_PAC',20);
        $table->text('DOM_PAC');
        $table->int('NUM_PAC',11);
        $table->varchar('PRO_PAC',200);
          

        $table->integer('ID_USU')->unsigned();
        $table->foreign('ID_USU')->references('id')->on('usuario');



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
