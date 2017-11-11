<?php
/**
 * Created by PhpStorm.
 * User: fenix
 * Date: 02/05/2017
 * Time: 06:19 PM
 */

namespace App;


class Carrito
{

    public $productos = null;
    public $cantidadProductos = 0;
    public $total = 0;

    public function __construct()
    {
        $this->productos = null;
        $this->cantidadProductos = 0;
        $this->total = 0;
    }

    public static function withCart($oldCarrito)
    {
        #dd($oldCarrito);
        $instance = new self();
        if ($oldCarrito) {
            $instance->productos = $oldCarrito->productos;
            $instance->cantidadProductos = $oldCarrito->cantidadProductos;
            $instance->total = $oldCarrito->total;
        }
    }

    public function add($item, $id)
    {
        $producto = ['cantidad' => 0, 'total' => 0, 'item' => $item];
        if ($this->productos) {
            if (array_key_exists($id, $this->productos)) {
                $producto = $this->productos[$id];
            }
        }
        $producto['cantidad']++;
        $producto['total'] = $item['precio1'] * $producto['cantidad'];
        $this->productos[$id] = $producto;
        $this->cantidadProductos++;
        $this->total += $item['precio1'];
    }

    public function update($item, $id,$cantidad){
        $producto =['cantidad' => 0,'total'=>0,  'item' => $item];
        if($this->productos){
            if(array_key_exists($id, $this->productos)){
                $producto = $this->productos[$id];
            }
        }
        $this->cantidadProductos-=$producto['cantidad'];
        $this->total -= $producto['total'];
        $producto['cantidad']=$cantidad;
        $producto['total'] = $item['precio1'] * $producto['cantidad'];
        $this->productos[$id] = $producto;
        $this->cantidadProductos+=$cantidad;
        $this->total += $producto['total'];
    }

    public function remove($id)
    {
        if ($this->productos) {
            if (array_key_exists($id, $this->productos)) {
                $this->cantidadProductos -= $this->productos[$id]['cantidad'];
                $this->total -= $this->productos[$id]['total'];
                unset($this->productos[$id]);
            }
        }
    }

    public function setCantidad($id, $cantidad)
    {
        $this->cantidadProductos -= $this->productos[$id]['cantidad'];
        $this->productos[$id]['cantidad'] = $cantidad;
        $this->cantidadProductos += $this->productos[$id]['cantidad'];
        dd($this->productos);
        $this->total -= $this->productos[$id]['total'];
        $this->productos[$id]['total'] = $this->productos[$id]['cantidad'] * $this->productos[$id]['item']->precio1;
        $this->total += $this->productos[$id]['total'];
    }
}