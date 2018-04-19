<?php

namespace Darsalud;

use Illuminate\Database\Eloquent\Model;

class EvaOftalmo extends Model
{
     protected $table = 'evaluacionoftalmo';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['FEC_OFT','ULE_OFT','UCV_OFT','VBI_OFT','SAL_OFT','ROD_OFT','ROI_OFT','ESD_OFT','ESI_OFT','CID_OFT','CII_OFT','EJD_OFT','EJI_OFT','AVD_OFT','AVI_OFT','RUS_OFT','RMA_OFT','OBS_OFT','ID_MED','ID_PAC'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $guarded =['id'];
}
