<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('venta_id')->unsigned();
            $table->integer('producto_id')->unsigned();
            $table->integer('renglon')->unsigned();
            $table->float('precio')->unsigned();
            $table->integer('unidad_id')->unsigned();
            $table->integer('cantidad');
            $table->float('total');
        });

        Schema::table('detalle_ventas',function($table){
            $table->foreign('venta_id')->references('id')->on('ventas');
            $table->foreign('producto_id')->references('id')->on('productos');
            $table->foreign('unidad_id')->references('id')->on('tipo_unidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('detalle_ventas');
    }
}
