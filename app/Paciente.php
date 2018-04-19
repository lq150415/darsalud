<?php

namespace Darsalud;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'pacientes';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['NOM_PAC','APA_PAC','AMA_PAC','SEX_PAC','CI_PAC','FEC_PAC','REF_PAC','ID_USU','created_at','updated_at','DOM_PAC','PRO_PAC'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $guarded =['id'];
}
