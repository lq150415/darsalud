<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluacionmedicaTable extends Migration
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
        $table->timestamp('FEC_MED');
        $table->varchar('LUG_MED',45);
        $table->varchar('FOT_MED',105);
        $table->text('ACO_MED');
        $table->text('APA_MED');
        $table->varchar('HBE_MED',45);
        $table->varchar('HFU_MED',45);
        $table->varchar('VAM_MED',45);
        $table->varchar('VTE_MED',45);
        $table->varchar('GSA_MED',45);
        $table->varchar('SIG_MED',45);
        $table->float('TEM_MED');
        $table->float('PRE_MED');
        $table->float('FRC_MED');
        $table->float('FRR_MED');
        $table->float('SOM_MED');
        $table->float('TAL_MED');
        $table->float('PES_MED');
        $table->text('EGO_MED');
        $table->text('MOC_MED');
        $table->text('REC_MED');
        $table->varchar('ETR_MED',45);
        $table->varchar('LEN_MED',45);
        $table->text('CAM_MED');
        $table->text('COL_MED');
        $table->text('VPR_MED');

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
