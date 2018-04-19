<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedcronicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('medcronic', function (Blueprint $table) {
          $table->increments('id');
          $table->text('MED_MCR',);
          $table->text('DOS_MCR',);
          $table->text('FIN_MCR',);

          $table->integer('ID_COE')->unsigned();
              $table->foreign('ID_COE')->references('id')->on('consultaext');

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
