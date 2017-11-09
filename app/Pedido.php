<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table="pedidos_temp";
    protected $fillable =[
        'cliente_id','envio_disponible'
    ];

}
