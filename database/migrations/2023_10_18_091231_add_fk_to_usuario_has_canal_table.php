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
        Schema::table('usuario_has_canal', function (Blueprint $table) {
            $table->addFk('usuario', 'fk_uhc_id_usuario');
            $table->addFk('canal', 'fk_uhc_id_canal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuario_has_canal', function (Blueprint $table) {
            $table->dropFk('fk_uhc_id_usuario');
            $table->dropFk('fk_uhc_id_canal');
        });
    }
};
