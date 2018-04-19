<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaracobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('caracobs', function (Blueprint $table) {
        $table->increments('id');
        $table->int('AEM_COB',11);
        $table->text('DUR_COB');
        $table->text('TVA_COB');
        $table->text('TCE_COB');
        $table->int('NVI_COB',11);
        $table->int('NMU_COB',11);
        $table->timestamp('FCO_COB',11);
        $table->text('RCO_COB');

        $table->integer('ID_AOB')->unsigned();
            $table->foreign('ID_AOB')->references('id')->on('antecobs');

            $table->timestamps();
            });

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
