<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('users', function (Blueprint $table) {
        $table->increments('id');
        $table->varchar('NOM_USU',45);
        $table->varchar('APA_USU',45);
        $table->varchar('AMA_USU',45);
        $table->int('NIV_USU');
        $table->varchar('NIC_USU',45);
        $table->varchar('password',60);
        $table->varchar('remember_token',60);



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
