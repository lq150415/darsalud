<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSanguineoTable extends Migration
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
        $table->varchar('TIP_SAN');
        $table->varchar('FAC_SAN');

        $table->integer('ID_PAC')->unsigned();
        $table->foreign('ID_PAC')->references('id')->on('pacientes');



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
