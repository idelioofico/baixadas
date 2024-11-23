<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\GuiaDeSaida;
use App\Models\GuiaDeTransporte;
use App\Models\Produto;
use App\Models\RequisicaoArmazem;

class GuiaSaidaSeeder extends Seeder
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
            $dia = date('d');
            $mes = '0'.rand(1,9);
            $ano = date('Y');
            $data= $ano.'-'.$mes.'-'.rand(01,020);
            $transporte = RequisicaoArmazem::where('status', 1)->where('pendente', 2)->find($i);
            if ($transporte) {
                GuiaDeSaida::create([
                    'requisicaoArmazem_id' => $transporte->id,
                    'numero_do_folheto' => rand(2000, 4000).'/2021',
                    'destino_do_material' => $faker->address,
                    'documentos_assoc' => $faker->name(),
                    'elaborado_por' => $faker->name(),
                    'data' => $data,
                    'pendente' => rand(0,3),
                    'requisitante'=>$faker->name(),
                    'departamento'=>'Informatica',
                    'data_do_documento' =>$faker->date(),
                    'data_do_fornecimento'=>$faker->date(),
                    'data_do_recebimento'=>$faker->date(),
                    'levantado_por'=>$faker->name(),
                    'fiel_do_armazem'=>$faker->name(),
                    'assistente_do_armazem'=>$faker->name()
                ]);

            }
        }

    }
}
