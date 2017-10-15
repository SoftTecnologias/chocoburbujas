<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaFacturacionEnvios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Facturacion_Envio', function (Blueprint $table) {
            $table->increments('id');
            $table->string('a_nombre_de');
            $table->string('RFC');
            $table->string('pais');
            $table->string('estado');
            $table->string('Municipio');
            $table->string('ciudad');
            $table->string('Colonia');
            $table->string('Calle');
            $table->integer('CP');
            $table->integer('num_int')->nullable();
            $table->integer('num_ext');
            $table->string('correo');
            $table->string('telefono');
            $table->string('celular');
            $table->string('EstadoFactura');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
