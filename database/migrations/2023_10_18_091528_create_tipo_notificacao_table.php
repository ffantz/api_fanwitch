<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tipo_notificacao', function (Blueprint $table) {
            $table->smallInteger('id')->autoIncrement()->unsigned();
            $table->addUuid();
            $table->string('nome', 30);
            $table->string('sigla', 4);
            $table->status();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificacoes');
    }
};
