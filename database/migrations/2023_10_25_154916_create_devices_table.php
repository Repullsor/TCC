<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['diabetes', 'blood_pressures']);
            $table->string('brand');
            $table->string('model');
            $table->timestamps();
            $table->unsignedBigInteger('diabetes_id')->nullable(); // Chave estrangeira para diabetes measurements
            $table->unsignedBigInteger('blood_pressure_id')->nullable(); // Chave estrangeira para pression measurements
            $table->foreign('diabetes_id')->references('id')->on('diabetes');
            $table->foreign('blood_pressure_id')->references('id')->on('blood_pressures');
        });
    }

    public function down()
    {
        Schema::dropIfExists('devices');
    }
};

