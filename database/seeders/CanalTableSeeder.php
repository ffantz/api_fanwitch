<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Canal;
use App\Models\Usuario;

require_once 'vendor/autoload.php';

class CanalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usuarios = Usuario::get();

        foreach ($usuarios as $key => $usuario) {
            if (\truemod($key, 3) == 0) {
                $faker = \Faker\Factory::create("pt_BR");
                $faker->addProvider(new \Faker\Provider\Internet($faker));

                Canal::firstOrCreate([
                    "id_usuario" => $usuario->id,
                ],[
                    "id_usuario" => $usuario->id,
                    "nome_canal" => $faker->name(),
                    "username" => $faker->userName(),
                    "status" => (string) \truemod($key, 2),
                    "avatar" => (\truemod($key, 2) ? "no_photo" : "profile") . ".png",
                    "foto_capa" => "capa" . (\truemod($key, 2) ? "1" : "2") . ".jpg",
                ]);
            }
        }
    }
}
