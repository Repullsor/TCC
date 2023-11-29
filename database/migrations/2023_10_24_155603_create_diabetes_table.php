<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiabetesTable extends Migration
{
    public function up()
{
    Schema::create('diabetes', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('device_id');
        $table->unsignedBigInteger('user_id');
        $table->unsignedInteger('glucose_level')->nullable()->default(null)->limit(3);
        $table->enum('classification', ['Normal', 'Alta', 'Baixa']);
        $table->text('comments')->nullable();
        $table->date('measurement_date')->nullable(); // Campo para a data
        $table->time('measurement_time')->nullable(); // Campo para a hora
        $table->timestamps();
    });
    
}


    public function down()
    {
        Schema::dropIfExists('diabetes');
    }
};

