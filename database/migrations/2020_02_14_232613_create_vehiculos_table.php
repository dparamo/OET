<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('td_vehiculos', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('vehi_placa');
            $table->string('vehi_color');
            $table->string('vehi_marca');
            $table->enum('vehi_tipo_vehiculo',['particular','publico']);
            $table->unsignedInteger('id_propietario');
            $table->foreign('id_propietario')->references('id')->on('td_propietarios');
            $table->unsignedInteger('id_conductor');
            $table->foreign('id_conductor')->references('id')->on('td_conductores');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehiculos');
    }
}
