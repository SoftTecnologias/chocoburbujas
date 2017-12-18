<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Promotion extends Model
{
    protected $table="producto_promocion";
    protected  $fillable = [
        "idProducto","idPromocion"
    ];

    protected $hidden=[];

    public $timestamps = false;
}
