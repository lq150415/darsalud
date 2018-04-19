<?php

namespace Darsalud;

use Illuminate\Database\Eloquent\Model;

class Factoriesgo extends Model
{
  protected $table = 'factoriesgo';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['DES_FAR','ID_COE'];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $guarded =['id'];
}
