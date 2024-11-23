<?php

namespace Database\Seeders;

use App\Models\FornecedorCategoria;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class Fornecedor_CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 0; $i <= 30; $i++) {
            FornecedorCategoria::create([
                'fornecedor_id' => rand(1, 10),
                'categoria_id' => rand(3, 6)
            ]);
        }
    }
}
