<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Informacion extends Model
{
    protected $table = "datos";

    protected $fillable = [
        'facebookUrl',
        'twitterUrl',
        'googleUrl',
        'skypeUrl',
        'email',
        'direccion1',
        'direccion2',
        'telefono1',
        'telefono2',
        'nosotros'
    ];
    protected $hidden=[];
    public $timestamps = false;
}
