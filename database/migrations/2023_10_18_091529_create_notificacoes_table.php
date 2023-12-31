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
        Schema::create('notificacoes', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement()->unsigned();
            $table->addUuid();
            $table->usuario();
            $table->string('titulo', 90);
            $table->text('texto');
            $table->enum('lida', [0, 1])->default(0);
            $table->smallInteger('id_tipo_notificacao')->unsigned();
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
