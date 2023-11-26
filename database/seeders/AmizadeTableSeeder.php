<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Usuario;
use App\Models\Amizade;

require_once 'vendor/autoload.php';

class AmizadeTableSeeder extends Seeder
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

        Amizade::firstOrCreate([
            "id_usuario" => $usuario->id,
            "id_usuario_adicionado" => $usuarioAdicionado->id,
        ],[
            "status" => '1',
        ]);
    }
}
