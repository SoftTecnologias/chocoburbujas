<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo',20)->unique();
            $table->string('nombre',200);
            $table->string('descripcion');
            $table->integer('marca_id')->unsigned();
            $table->integer('categoria_id')->unsigned();
            $table->integer('proveedor_id')->unsigned();
            $table->integer('unidad_id')->unsigned();
            $table->integer('stock_max');
            $table->integer('stock_min');
            $table->integer('stock')->default(0);
            $table->integer('vendidos')->default(0);
            $table->boolean('promocion')->default(false);
            $table->float('precio1');
            $table->float('precio2');
            $table->string('img1');
            $table->string('img2');
            $table->string('img3');
            $table->timestamps();

        });

        Schema::table('productos',function(Blueprint $table){
            $table->foreign('marca_id')->references('id')->on('marcas');
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->foreign('proveedor_id')->references('id')->on('proveedores');
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
        Schema::drop('productos');
    }
}
