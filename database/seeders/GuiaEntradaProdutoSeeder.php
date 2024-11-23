<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GuiaEntrada_Produto;
use App\Models\Produto;
use Faker\Generator as Faker;

class GuiaEntradaProdutoSeeder extends Seeder
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
            $aleatorio=rand(1,50);
            $produto=Produto::find($aleatorio);
            $quantidade=rand(10,100);

            $saberPendente=GuiaEntrada_Produto::create([
                'guiaEntrada_id'=>rand(1,50),
                'produto_id'=>rand(1,10),
                // 'unidade'=>1,
                'quantidade'=>$quantidade,
                'custo_unitario'=>rand(1,100),
                'valor'=>rand(10,100),
            ]);
        }
    }
}
