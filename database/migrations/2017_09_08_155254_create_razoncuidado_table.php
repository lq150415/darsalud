<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRazoncuidadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('sanguineo', function (Blueprint $table) {
        $table->int('id',11);
        $table->varchar('DEC_RUC');


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
