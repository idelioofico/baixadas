<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Guiadeentrada;
use App\Models\GuiaEntrada_Produto;
use App\Models\Produto;

class GuiadeEntradaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for ($i = 0; $i <= 55; $i++) {
            $dia = date('d');
            $mes = '0'.rand(1,9);
            $ano = date('Y');
            $data= $ano.'-'.$mes.'-'.rand(01,020);
            // Criar guia Entrada
            $guia = Guiadeentrada::create([
                'numero_do_folheto' => $faker->numerify('####').'/2021',
                'codigo_do_folheto' => $faker->email,
                'fornecedor_id' => rand(1, 99),
                'responsavel' => $faker->firstname,
                'numero_da_fatura' => $faker->numerify('#####'),
                'outros_documentos' => $faker->address,
                'data' => $data,
                'categoria_id' => rand(1, 2),
                'pendente' => rand(0, 2)
            ]);
        }
    }
}
