<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropietariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('td_propietarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('prop_fnombre');
            $table->string('prop_Lnombre');
            $table->string('prop_apellidos');
            $table->integer('prop_cedula');
            $table->string('prop_direccion');
            $table->string('prop_telefono');
            $table->string('prop_Ciudad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('propietarios');
    }
}
