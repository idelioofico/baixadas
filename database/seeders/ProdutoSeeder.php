<?php

namespace Database\Seeders;

use App\Models\Produto;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $count = 2001;
        for ($i = 1; $i <= 10; $i++) {
            Produto::create([
                'codigo' => $count++,
                'nome' => $faker->company(),
                'categoria_id' => rand(3, 6),
                'unidade_total'=>'m'
            ]);
        }
    }
}
