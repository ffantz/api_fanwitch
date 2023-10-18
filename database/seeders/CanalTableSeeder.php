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
            if (\truemod($key, 2) == 0) {
                $faker = \Faker\Factory::create();
                $faker->addProvider(new \Faker\Provider\Internet($faker));

                Canal::firstOrCreate([
                    "id_usuario" => $usuario->id,
                ],[
                    "id_usuario" => $usuario->id,
                    "nome_canal" => $faker->name(),
                    "username" => $faker->userName(),
                    "status" => (string) \truemod($i, 2),
                    "email_verified_at" => now(),
                    "remember_token" => Str::random(10),
                ]);
            }
        }
    }
}
