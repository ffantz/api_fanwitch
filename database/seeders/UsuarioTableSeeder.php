<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Usuario;

require_once 'vendor/autoload.php';

class UsuarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Usuario::firstOrCreate([
            "email" => "flavioluzio22@gmail.com",
        ],[
            "email" => "flavioluzio22@gmail.com",
            "username" => "ffantz",
            "password" => bcrypt("123456"),
            "status" => '0',
            "remember_token" => Str::random(10),
        ]);

        for ($i = 0; $i < 150; $i++) {
            $faker = \Faker\Factory::create("pt_BR");
            $faker->addProvider(new \Faker\Provider\Internet($faker));
            $email = $faker->email();
            $nome = \truemod($i, 2) == 0 ? $faker->name() : null;

            Usuario::firstOrCreate([
                "email" => $email,
            ],[
                "nome" => $nome,
                "email" => $email,
                "username" => $faker->userName(),
                "password" => bcrypt(Str::random(15)),
                "status" => (string) \truemod($i, 2),
                "email_verified_at" => \truemod($i, 2) == 0 ? null : now(),
                "remember_token" => Str::random(10),
            ]);
        }
    }
}
