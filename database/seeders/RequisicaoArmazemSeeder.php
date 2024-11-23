<?php

namespace Database\Seeders;

use Faker\Generator as Faker;
use App\Models\RequisicaoArmazem;

use Illuminate\Database\Seeder;

class RequisicaoArmazemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //
        for ($i = 0; $i <= 100; $i++) {
            RequisicaoArmazem::create([
                'numero_do_folheto' => rand(2000, 4000).'/2021',
                'aplicacao' => $faker->firstname,
                'motivo_de_requisicao' => rand(1, 3),
                'motivo_descricao' => $faker->address,
                'requisitante' => $faker->firstname,
                'data' => $faker->date(),
                'hora' => $faker->time(),
                'obs' => $faker->firstname,
                'pendente' => rand(0, 3),
                'laborado_por' => $faker->firstname,
                'autorizado_por' => $faker->firstname
            ]);
        }
    }
}
