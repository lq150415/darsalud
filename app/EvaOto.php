<?php

namespace Darsalud;

use Illuminate\Database\Eloquent\Model;

class EvaOto extends Model
{
     protected $table = 'evaluacionotorrino';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['FEC_OTO','LUG_NAC','ANT_OTO','EFI_OTO','CON_OTO','RFI_OTO','ID_MED','ID_PAC'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $guarded =['id'];
}
