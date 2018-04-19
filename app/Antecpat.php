<?php

namespace Darsalud;

use Illuminate\Database\Eloquent\Model;

class Antecpat extends Model
{
  protected $table = 'antecpat';

/**
 * The attributes that are mass assignable.
 *
 * @var array
 */
protected $fillable = ['HOS_APA','ANI_APA','EVA_APA','ID_COE'];

/**
 * The attributes excluded from the model's JSON form.
 *
 * @var array
 */
protected $guarded =['id'];
}
