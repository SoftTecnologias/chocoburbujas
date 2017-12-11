<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table="promociones";
    protected  $fillable = [
        "id","nombre","descripcion","descuento","fin_promocion"
    ];

    protected $hidden=[];

    public $timestamps = false;
}
