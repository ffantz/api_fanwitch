<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Notificacoes;
use App\Models\Usuario;

require_once 'vendor/autoload.php';

class NotificacoesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 5; $i++) {
            $faker = \Faker\Factory::create("pt_BR");

            Notificacoes::create([
                "id_usuario" => 1,
                "titulo" => "Você tem uma notificação nova!",
                "texto" => $faker->text(),
                "lida" => '0',
                "id_tipo_notificacao" => 1,
            ]);
        }
    }
}
