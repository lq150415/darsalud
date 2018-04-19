<?php

namespace Darsalud;

use Illuminate\Database\Eloquent\Model;

class Observacionesper extends Model
{
  protected $table = 'observacionesper';

/**
 * The attributes that are mass assignable.
 *
 * @var array
 */
protected $fillable = ['DES_OBP','ID_ANP'];
/**

 * The attributes excluded from the model's JSON form.
 *
 * @var array
 */
protected $guarded =['id'];
}
