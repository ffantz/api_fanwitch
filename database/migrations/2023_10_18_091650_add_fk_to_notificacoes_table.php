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
        Schema::table('notificacoes', function (Blueprint $table) {
            $table->addFk('usuario', 'fk_n_id_usuario');
            $table->addFk('tipo_notificacao', 'fk_n_id_tipo_notificacao');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notificacoes', function (Blueprint $table) {
            $table->dropFk('fk_n_id_usuario');
            $table->dropFk('fk_n_id_tipo_notificacao');
        });
    }
};
