<?php

namespace Database\Seeders;

use App\Models\Motorista;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class MotoristaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i <= 10; $i++) {
            Motorista::create([
                'nome' => $faker->name(),
                'email' => $faker->email(),
                'telefone' => $faker->numerify('#########'),
                'nuit' => $faker->numerify('#########'),
                'carta_de_conducao' => $faker->numerify('#####'),
                'local_de_emissao' => $faker->country,
            ]);
        }
    }
}
