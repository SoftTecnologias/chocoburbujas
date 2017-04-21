<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    protected $table = "tipo_unidades";
    protected $fillable=["id","descripcion"];
}
