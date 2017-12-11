<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class ProductPromocionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("producto_promocion", function (Blueprint $table) {
            $table->integer('idProducto');
            $table->integer('idPromocion');

            $table->foreign('idProducto')->references('id')->on('productos');
            $table->foreign('idPromocion')->references('id')->on('promociones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('producto_promocion');
    }
}
