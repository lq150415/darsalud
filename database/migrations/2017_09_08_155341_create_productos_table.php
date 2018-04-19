<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('productos', function (Blueprint $table) {
        $table->int('id',11);
        $table->varchar('COD_PRO',45);
        $table->varchar('NOM_PRO',100);
        $table->text('DES_PRO');
        $table->int('CAN_PRO',11);
        $table->float('PRE_PRO');
        $table->timestamps('FEC_PRO');


        $table->integer('ID_USU')->unsigned();
        $table->foreign('ID_USU')->references('id')->on('usuario');



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
