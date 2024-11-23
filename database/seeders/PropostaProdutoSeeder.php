<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PropostaProduto;
use Faker\Generator as Faker;


class PropostaProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //
        for($i=0;$i<=1000;$i++){
            PropostaProduto::create([
                'proposta_id'=>rand(1,100),
                'produto_id'=>rand(1,10),
                // 'unidade'=>rand(1,1000),
                'quantidade'=>rand(1,1000),
                'preco_unitario'=>rand(1,1000),
                'preco_total'=>rand(1,1000),
                'entrega'=>'Imediata',
    
            ]);
        }
    }
}
