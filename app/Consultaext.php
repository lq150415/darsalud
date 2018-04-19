<?php

namespace Darsalud;

use Illuminate\Database\Eloquent\Model;

class Consultaext extends Model
{
  protected $table = 'consultaext';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['FEC_COE','HCL_COE','GLA_COE','SAN_COE','FAC_COE','ID_PAC','ID_MED'];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $guarded =['id'];
}
