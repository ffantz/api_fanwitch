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
        Schema::create('usuario', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement()->unsigned();
            $table->addUuid();
            $table->string('nome', 70)->nullable();
            $table->string('username', 35)->unique('username_UNIQUE');
            $table->string('email', 100)->unique('email_UNIQUE');
            $table->date('data_nascimento')->nullable();
            $table->dateTime('email_verified_at')->nullable();
            $table->string('password', 100);
            $table->string('avatar', 100)->nullable();
            $table->status();
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
