<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaDireccionesClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Direcciones_Envio', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('Estado');
            $table->tinyInteger('Municipio');
            $table->string('Colonia');
            $table->string('Calle');
            $table->integer('CP');
            $table->integer('num_int')->nullable();
            $table->integer('num_ext');
            $table->string('correo');
            $table->string('telefono');
            $table->tinyInteger('cliente_id');
            $table->string('EstadoEnvio');
            $table->string('Factura');
            $table->rememberToken();
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
