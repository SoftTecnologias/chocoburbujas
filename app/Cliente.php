<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Cliente extends Authenticatable
{
    protected $table="clientes";
    protected $fillable=[
            "nombre","ape_pat","ape_mat","email","calle","colonia",
            "numero_int","numero_ext", "cp","estado","municipio",
            "telefono1", "telefono2", "username","password","suscrito"
    ];

    protected $hidden=[
        "password"
    ];
}
