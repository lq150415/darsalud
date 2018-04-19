<?php

namespace Darsalud;

use Illuminate\Database\Eloquent\Model;

class Notasevolucion extends Model
{
  protected $table = 'notasevolucion';

/**
 * The attributes that are mass assignable.
 *
 * @var array
 */
protected $fillable = ['FEC_NEV','NNN_NEV','RRR_NEV','EAC_NEV','PA_NEV','TEM_NEV','FC_NEV','FUM_NEV','SUB_NEV','OBJ_NEV','ANA_NEV','PLA_NEV','ID_TIC','ID_PAC','ID_MED'];

/**
 * The attributes excluded from the model's JSON form.
 *
 * @var array
 */
protected $guarded =['id'];
}
