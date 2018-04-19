<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnticoncepcionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('anticoncepcion', function (Blueprint $table) {
        $table->int('id',11);
        $table->timestamps('INI_ANC');
        $table->text('MET_ANC');
        $table->text('CON_ANC');
        $table->text('ORI_ANC');

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
