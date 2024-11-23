<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GuiaSaida_Produto;
use Faker\Generator as Faker;

class GuiaSaidaProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i=0;$i<=1000;$i++){
            GuiaSaida_Produto::create([
                'guiaSaida_id'=>rand(1,100),
                'produto_id'=>rand(1,1000),
                'unidade'=>rand(1,100),
                'quantidade'=>rand(1000000,10000000),
                'custo_unitario'=>rand(100000,10000000),
                'valor'=>rand(10000,10000000),
                'quantidade_aprovado'=>rand(100,200)
            ]);
        }
    }
}
