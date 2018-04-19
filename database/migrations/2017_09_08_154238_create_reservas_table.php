<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('resevas', function (Blueprint $table) {
        $table->increments('id');
        $table->timestamps('FEC_RES');
        $table->timestamps('HOR_RES');




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
