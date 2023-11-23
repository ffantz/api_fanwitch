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
        Schema::create('canal', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement()->unsigned();
            $table->addUuid();
            $table->usuario();
            $table->string('nome_canal', 75);
            $table->string('username', 45);
            $table->text('descricao');
            $table->status();
            $table->string('avatar', 100)->nullable();
            $table->string('foto_capa', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('canal');
    }
};
