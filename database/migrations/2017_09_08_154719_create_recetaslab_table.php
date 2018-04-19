<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecetaslabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('recetaslab', function (Blueprint $table) {
        $table->int('id',11);
        $table->timestamps('FEC_RLA');

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
