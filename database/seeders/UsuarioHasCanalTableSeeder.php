<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Canal;
use App\Models\Usuario;
use App\Models\UsuarioHasCanal;

require_once 'vendor/autoload.php';

class UsuarioHasCanalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuarios = Usuario::get()->shuffle();
        $canais = Canal::get();

        foreach ($canais as $canal) {
            $qtdSeguidores = rand(10, count($usuarios) - 1);
            for ($i = 0; $i < $qtdSeguidores; $i++) {
                $usuario = $usuarios[$i];
                if ($usuario->id != $canal->id_usuario) {
                    UsuarioHasCanal::firstOrCreate([
                        "id_canal" => $canal->id,
                        "id_usuario" => $usuario->id,
                    ],[
                        "id_canal" => $canal->id,
                        "id_usuario" => $usuario->id,
                        "moderador" => (\truemod($i, 7) ? "0" : "1"),
                        "administrador" => (\truemod($i, 2) ? "0" : "1"),
                        "inscrito" => (\truemod($i, 2) ? "0" : "1"),
                        "recomendado" => (\truemod($i, 4) ? "0" : "1"),
                    ]);
                }
            }
        }

    }
}
