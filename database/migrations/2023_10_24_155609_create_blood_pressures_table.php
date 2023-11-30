<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloodPressuresTable extends Migration
{
    public function up()
    {
        Schema::create('blood_pressures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('device_id'); // Chave estrangeira para dispositivos
            $table->unsignedBigInteger('user_id'); // Chave estrangeira para usuários
            $table->integer('systolic'); // Pressão sistólica
            $table->integer('diastolic'); // Pressão diastólica
            $table->enum('classification', ['Normal', 'Alta', 'Baixa']); // Classificação
            $table->text('comments')->nullable(); // Comentários opcionais
            $table->date('measurement_date')->nullable(); // Campo para a data
            $table->time('measurement_time')->nullable(); // Campo para a hora
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('blood_pressure');
    }
};
