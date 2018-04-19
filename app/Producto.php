<?php

namespace Darsalud;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['COD_PRO','DES_PRO','NOM_PRO','FEC_PRO','CAN_PRO','PRE_PRO','ID_USU'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $guarded =['id'];
}
