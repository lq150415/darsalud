<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('recetas', function (Blueprint $table) {
        $table->int('id',11);
        $table->text('DES_REC');
        $table->timestamps('FEC_REC');


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
