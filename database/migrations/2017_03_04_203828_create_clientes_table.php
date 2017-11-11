<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nombre',100);
            $table->string('ape_pat',100);
            $table->string('ape_mat',100);
            $table->string('email')->unique();
            $table->string('calle',200);
            $table->string('colonia',200);
            $table->string('numero_int',10);
            $table->string('numero_ext',10);
            $table->integer('cp');
            $table->string('estado',200);
            $table->string('municipio',200);
            $table->string('telefono1',20);
            $table->string('telefono2',20);
            $table->string('username',32)->unique();
            $table->string('password');
            $table->boolean('suscrito');
            $table->string('img');
            $table->string('apikey');
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
        Schema::drop('clientes');
    }
}
