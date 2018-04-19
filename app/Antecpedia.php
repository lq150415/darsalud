<?php

namespace Darsalud;

use Illuminate\Database\Eloquent\Model;

class Antecpedia extends Model
{
  protected $table = 'antecpedia';

/**
 * The attributes that are mass assignable.
 *
 * @var array
 */
protected $fillable = ['PES_ANP','ID_COE'];

/**
 * The attributes excluded from the model's JSON form.
 *
 * @var array
 */
protected $guarded =['id'];
}
