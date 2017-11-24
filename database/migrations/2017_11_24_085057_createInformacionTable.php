<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("datos", function ($table) {
            $table->increments('id');
            $table->string('facebookUrl')->nullable();
            $table->string('twitterUrl')->nullable();
            $table->string('googleUrl')->nullable();
            $table->string('skypeUrl')->nullable();
            $table->string('email');
            $table->string('direccion1');
            $table->string('direccion2');
            $table->string('telefono1');
            $table->string('telefono2')->nullable();
            $table->string('nosotros');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('datos');
    }
}
