<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableConfiguraciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuraciones',function (Blueprint $table){
            $table->increments('id');
            $table->string('seccion');
            $table->string('nombre');
            $table->boolean('activo')->default(true);
            $table->integer('height')->default(0);
            $table->boolean('setHeight')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('configuraciones');
    }
}
