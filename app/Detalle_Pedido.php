<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle_Pedido extends Model
{
    protected $table="detalle_temp";
    protected $fillable =[
        'pedido_id'
        ,'cantidad'
        ,'precio'
        ,'subtotal'
        ,'fecha'
    ];
    public $timestamps = true;

}
