<?php

namespace Darsalud;

use Illuminate\Database\Eloquent\Model;

class Lactancia extends Model
{
  protected $table = 'lactancia';

/**
* The attributes that are mass assignable.
*
* @var array
*/
protected $fillable = ['TIP_LAC','ID_COE'];

/**
* The attributes excluded from the model's JSON form.
*
* @var array
*/
protected $guarded =['id'];
}
