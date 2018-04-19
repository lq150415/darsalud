<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaboratoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('laboratorios', function (Blueprint $table) {
        $table->int('id',11);
        $table->text('DES_LAB');

        $table->integer('ID_CAL')->unsigned();
        $table->foreign('ID_CAL')->references('id')->on('');



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
