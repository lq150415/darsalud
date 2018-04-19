<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecetadoslabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('recetadoslab', function (Blueprint $table) {
        $table->int('id',11);

        $table->integer('ID_LAB')->unsigned();
        $table->foreign('ID_LAB')->references('id')->on('laboratorios');



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
