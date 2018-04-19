<?php

namespace Darsalud;

use Illuminate\Database\Eloquent\Model;

class EvaMedi extends Model
{
     protected $table = 'evaluacionmedica';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['FEC_MED','LUG_MED','FOT_PAC','ACO_MED','APA_MED','HBE_MED','HFU_MED','VAM_MED','VTE_MED','GSA_MED','SIG_MED','TEM_MED','PRE_MED','FRC_MED','FRR_MED','SOM_MED','TAL_MED','PES_MED','ECA_MED','ECU_MED','ECR_MED','EGO_MED','MOC_MED','REC_MED','ETR_MED','LEN_MED','CAM_MED','COL_MED','VPR_MED','ALD_MED','ASD_MED','ALI_MED','ASI_MED','ACD_MED','ACI_MED','EOE_MED','OTO_MED','TWE_MED','TRI_MED','EXT_MED','EXC_MED','EXA_MED','TRS_MED','TMS_MED','FMS_MED','TIN_MED','TMI_MED','FMI_MED','CMA_MED','REF_MED','PTR_MED','PDN_MED','PRG_MED','FAM_MED','REE_MED','MRE_MED','REV_MED','REP_MED','RFI_MED','ID_USU','ID_PAC'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $guarded =['id'];
}
