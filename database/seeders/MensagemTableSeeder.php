<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Usuario;
use App\Models\Mensagem;

require_once 'vendor/autoload.php';

class MensagemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuario = Usuario::where('username', 'ffantz')->first();
        $usuarioAdicionado = Usuario::where('username', 'gbresende')->first();

        for ($i = 0; $i < 10; $i++) {
            $faker = \Faker\Factory::create("pt_BR");
            $faker->addProvider(new \Faker\Provider\Internet($faker));

            Mensagem::create([
                "id_usuario_remetente" => \truemod($i, 2) == 0 ? $usuarioAdicionado->id : $usuario->id ,
                "id_usuario_destinatario" => \truemod($i, 2) == 0 ? $usuario->id : $usuarioAdicionado->id,
                "mensagem" => $faker->text(),
            ]);
        }

    }
}
