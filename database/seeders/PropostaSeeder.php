<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Proposta;

class PropostaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)

    {
        //
        for($i=0;$i<=100;$i++){
            Proposta::create([
                'cliente_id'=>rand(1,100),
                'proposta_numero'=>$faker->numerify('#########').'/2021',
                'data'=>$faker->date(),
                'pagamento'=>$faker->firstName,
                'validade'=>$faker->numerify('#########'),
                'entrega'=>$faker->firstName,
                'pendente'=>rand(1,2),
                'endereco_empresa'=>$faker->address,
                'nuit'=>$faker->numerify("#########")
            ]);
        }
        
    }
}
