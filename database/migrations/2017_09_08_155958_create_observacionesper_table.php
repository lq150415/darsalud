<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObservacionesperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('observacionesper', function (Blueprint $table) {
        $table->int('id',11);
        $table->text('DES_OBP');

        $table->integer('ID_ANP')->unsigned();
        $table->foreign('ID_ANP')->references('id')->on('antecpedia');



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
