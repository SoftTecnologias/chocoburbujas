<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    protected $table="configuraciones";
    protected $fillable=[
        "seccion","activo",'nombre','height','setHeight'
    ];
    public $timestamps = false;
}
