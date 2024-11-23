<?php

namespace Database\Seeders;

use App\Models\Produto;
use Faker\Generator as Faker;
use App\Models\RequisicaoArmazem_Produto;

use Illuminate\Database\Seeder;

class RequisicaoArmazemProdutoSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //
        for($i=0;$i<=500;$i++){
            $aleatorio=rand(1,20);
            $produto=Produto::find($aleatorio);
            // $quantidade=rand(10,100);
            RequisicaoArmazem_Produto::create([
                'requisicaoArmazem_id'=>rand(1,100),
                'produto_id'=>rand(1,10),
                // 'unidade'=>1,
                'quantidade'=>rand(1,100),
                'valor'=>rand(1,100),
                'custo_unitario'=>rand(1,100),
            ]);
        }
    }
}
