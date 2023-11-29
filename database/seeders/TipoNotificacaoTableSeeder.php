<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\TipoNotificacao;
use App\Models\Usuario;

require_once 'vendor/autoload.php';

class TipoNotificacaoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoNotificacao::create([
            "nome" => "Notificação comum",
            "sigla" => "NTCM",
            "status" => "1",
        ]);

        TipoNotificacao::create([
            "nome" => "Solicitação amizade",
            "sigla" => "SLAZ",
            "status" => "1",
        ]);
    }
}
