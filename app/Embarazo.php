<?php

namespace Darsalud;

use Illuminate\Database\Eloquent\Model;

class Embarazo extends Model
{
  protected $table = 'embarazo';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['ANI_EMB','DUR_EMB','VAG_EMB','CES_EMB','VIV_EMB','MUE_EMB','FPA_EMB','RES_EMB','ID_ACO'];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $guarded =['id'];
}
