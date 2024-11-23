<?php

namespace Database\Seeders;

use App\Models\Fornecedor;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //
        for ($i = 0; $i <= 10; $i++) {
            Fornecedor::create([
                'nome' => $faker->company,
                'telefone' => $faker->numerify('#########'),
                'email' => $faker->email,
                'pais' => $faker->state,
                'endereco' => $faker->address,
                'nome_do_representante' => $faker->firstname,
                'telefone_do_representante' => $faker->numerify('#########'),
                'email_do_representante' => $faker->email,
                'nuit' => $faker->numerify('#########'),
                'provincia' =>  $faker->country
            ]);
        }
    }
}
