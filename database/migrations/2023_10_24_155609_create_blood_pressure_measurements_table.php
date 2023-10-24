<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloodPressureMeasurementsTable extends Migration
{
    public function up()
    {
        Schema::create('blood_pressure_measurements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('device_id'); // Chave estrangeira para dispositivos
            $table->unsignedBigInteger('user_id'); // Chave estrangeira para usuários
            $table->integer('systolic'); // Pressão sistólica
            $table->integer('diastolic'); // Pressão diastólica
            $table->enum('classification', ['normal', 'alta', 'baixa']); // Classificação
            $table->text('comments')->nullable(); // Comentários opcionais
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('blood_pressure_measurements');
    }
};
