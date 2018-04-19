<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAntecobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('antecobs', function (Blueprint $table) {
        $table->int('id',11);
        $table->text('EMG_AOB');
        $table->text('EMP_AOB');
        $table->text('EMA_AOB');
        $table->text('EMC_AOB');


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
