<?php

namespace Darsalud;

use Illuminate\Database\Eloquent\Model;

class Laboratorio extends Model
{
    protected $table ='laboratorios';

    protected $fillable = ['DES_LAB','ID_CAL'];
}
