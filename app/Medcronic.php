<?php

namespace Darsalud;

use Illuminate\Database\Eloquent\Model;

class Medcronic extends Model
{
  protected $table = 'medcronic';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['MED_MCR','DOS_MCR','FIN_MCR','ID_COE'];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $guarded =['id'];
}
