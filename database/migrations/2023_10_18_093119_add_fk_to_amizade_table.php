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
        Schema::table('amizade', function (Blueprint $table) {
            $table->addFk('usuario', 'fk_a_id_usuario');
            $table->foreign('id_usuario_adicionado', 'fk_a_id_usuario_a')->references('id')->on('usuario')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('amizade', function (Blueprint $table) {
            $table->dropFk('fk_a_id_usuario');
            $table->dropFk('fk_a_id_usuario_a');
        });
    }
};
