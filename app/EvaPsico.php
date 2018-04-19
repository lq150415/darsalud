<?php

namespace Darsalud;

use Illuminate\Database\Eloquent\Model;

class EvaPsico extends Model
{
     protected $table = 'evaluacionpsicologica';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['FEC_PSI','LUG_NAC','HIS_PSI','EX1_PSI','EX2_PSI','EX3_PSI','EX4_PSI','RFI_PSI','ID_MED','ID_PAC'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $guarded =['id'];
}
