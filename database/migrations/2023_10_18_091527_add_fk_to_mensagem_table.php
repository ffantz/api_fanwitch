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
        Schema::table('mensagem', function (Blueprint $table) {
            $table->foreign('id_usuario_remetente', 'fk_m_id_usuario_r')->references('id')->on('usuario')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('id_usuario_destinatario', 'fk_m_id_usuario_d')->references('id')->on('usuario')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mensagem', function (Blueprint $table) {
            $table->dropFk('fk_m_id_usuario_r');
            $table->dropFk('fk_m_id_usuario_d');
        });
    }
};
