<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table = "marcas";

    protected $fillable = [
      'nombre', 'img'
    ];
    protected $hidden=[];
    public $timestamps = false;
}
