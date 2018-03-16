<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table="productos";
    protected  $fillable = [
        "codigo","nombre","descripcion","marca_id","categoria_id",
        "proveedor_id","unidad_id","stock_max","stock_min","stock",
        "precio1","precio2","img1","img2","img3","mostrar"
    ];

    protected $hidden=[];

    public $timestamps = false;

}
