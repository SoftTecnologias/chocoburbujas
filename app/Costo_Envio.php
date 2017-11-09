<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Costo_Envio extends Model
{
    protected $table="costo_envio";
    protected $fillable =[
        'estado_id','municipio_id','costo'
    ];
    public $timestamps = false;
}
