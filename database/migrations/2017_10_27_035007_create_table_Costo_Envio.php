<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCostoEnvio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costo_envio', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('estado_id')->nullable();
            $table->Integer('municipio_id')->nullable();
            $table->float('costo')->default(0);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('costo_envio');
    }
}
