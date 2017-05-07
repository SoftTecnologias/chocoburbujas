<?php
/**
 * Created by PhpStorm.
 * User: fenix
 * Date: 02/05/2017
 * Time: 06:19 PM
 */

namespace App;


class Carrito{

    public $productos = null;
    public $cantidadProductos = 0;
    public $total = 0;

    public function __construct($oldCarrito){
        if($oldCarrito){
            $this->productos = $oldCarrito->productos;
            $this->cantidadProductos = $oldCarrito->cantidadProductos;
            $this->total = $oldCarrito->total;
        }
    }

    public function add($item, $id){
        $producto =['cantidad' => 0,'total'=>0,  'item' => $item];
        if($this->productos){
            if(array_key_exists($id, $this->productos)){
                $producto = $this->productos[$id];
            }
        }
        $producto['cantidad']++;
        $producto['total'] = $item->precio1 * $producto['cantidad'];
        $this->productos[$id] = $producto;
        $this->cantidadProductos++;
        $this->total += $item->precio1;
    }

    public function remove($id){
        if($this->productos){
            if(array_key_exists($id,$this->productos)){
                $this->cantidadProductos -= $this->productos[$id]['cantidad'];
                $this->total -= $this->productos[$id]['total'];
                unset($this->productos[$id]);
            }
        }
    }

    public function setCantidad($id, $cantidad){

    }
}