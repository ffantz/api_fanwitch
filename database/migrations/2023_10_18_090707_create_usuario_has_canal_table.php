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
        Schema::create('usuario_has_canal', function (Blueprint $table) {
            $table->bigInteger('id_canal')->unsigned();
            $table->usuario();
            $table->enum('moderador', ['0', '1'])->default('0');
            $table->enum('administrador', ['0', '1'])->default('0');
            $table->enum('inscrito', ['0', '1'])->default('0');
            $table->enum('recomendado', ['0', '1'])->default('0');
            $table->timestamps();

            $table->primary([ 'id_usuario', 'id_canal' ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario_has_canal');
    }
};
