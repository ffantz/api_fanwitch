<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsuarioTableSeeder::class);
        $this->call(CanalTableSeeder::class);
        $this->call(UsuarioHasCanalTableSeeder::class);
        $this->call(TipoNotificacaoTableSeeder::class);
        $this->call(NotificacoesTableSeeder::class);
        $this->call(AmizadeTableSeeder::class);
        $this->call(MensagemTableSeeder::class);
    }
}
