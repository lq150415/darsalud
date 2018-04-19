<?php

namespace Darsalud;

use Illuminate\Database\Eloquent\Model;

class Riesgos extends Model
{
  protected $table = 'riesgos';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['NID_RIE','NIF_RIE','HIP_RIE','HIF_RIE','DIP_RIE','DIF_RIE','TUP_RIE','TUF_RIE','SIP_RIE','SIF_RIE','TRP_RIE','TRF_RIE','CIP_RIE','CIF_RIE','SNP_RIE','SNF_RIE','OBP_RIE','OBF_RIE','DEP_RIE','DEF_RIE','DRP_RIE','DRF_RIE','ALP_RIE','ALF_RIE','TAP_RIE','TAF_RIE','OTP_RIE','OTF_RIE','ID_COE'];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $guarded =['id'];
}
