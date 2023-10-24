<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiabetesMeasurementsTable extends Migration
{
    public function up()
    {
        Schema::create('diabetes_measurements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('device_id'); // Chave estrangeira para dispositivos
            $table->unsignedBigInteger('user_id'); // Chave estrangeira para usuários
            $table->decimal('glucose_level', 5, 2); // Nível de glicose
            $table->enum('classification', ['normal', 'alta', 'baixa']); // Classificação
            $table->text('comments')->nullable(); // Comentários opcionais
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('diabetes_measurements');
    }
};

