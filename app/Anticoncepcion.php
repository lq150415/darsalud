<?php

namespace Darsalud;

use Illuminate\Database\Eloquent\Model;

class Anticoncepcion extends Model
{
  protected $table = 'anticoncepcion';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['INI_ANC','MET_ANC','CON_ANC','ORI_ANC','ID_COE'];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $guarded =['id'];
}
