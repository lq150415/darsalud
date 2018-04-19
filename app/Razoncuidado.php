<?php

namespace Darsalud;

use Illuminate\Database\Eloquent\Model;

class Razoncuidado extends Model
{
  protected $table = 'razoncuidado';

/**
* The attributes that are mass assignable.
*
* @var array
*/
protected $fillable = ['DES_RUC','ID_COE'];

/**
* The attributes excluded from the model's JSON form.
*
* @var array
*/
protected $guarded =['id'];
}
