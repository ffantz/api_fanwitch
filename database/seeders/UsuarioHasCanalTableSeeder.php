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
        $usuarios = Usuario::get();
        $canais = Canal::get();

        foreach ($canais as $canal) {
            foreach ($usuarios as $key => $usuario) {
                if (\truemod($key, 3) == 0 && $usuario->id != $canal->id_usuario) {
                    UsuarioHasCanal::firstOrCreate([
                        "id_canal" => $canal->id,
                        "id_usuario" => $usuario->id,
                    ],[
                        "id_canal" => $canal->id,
                        "id_usuario" => $usuario->id,
                        "moderador" => (\truemod($key, 7) ? "0" : "1"),
                        "administrador" => (\truemod($key, 2) ? "0" : "1"),
                        "inscrito" => (\truemod($key, 2) ? "0" : "1"),
                        "recomendado" => (\truemod($key, 4) ? "0" : "1"),
                    ]);
                }
            }
        }

    }
}
