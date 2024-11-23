<?php

namespace Database\Seeders;

use App\Models\GuiaDeSaida;
use App\Models\GuiaDeTransporte;
use App\Models\RequisicaoArmazem;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class GuiaDeTransporteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i=0;$i<=100;$i++){
            $number=GuiaDeSaida::where('status',1)->where('pendente',2)->find($i);
            if($number){
                GuiaDeTransporte::create([
                    'guiaSaida_id' => $number->id,
                    'motorista' => rand(1,10),
                    'numero_do_folheto' => rand(2000,4000).'/2021',
                    'viatura_marca' => $faker->text($maxNbChars = 10),
                    'matricula' => $faker->name(),
                    'local_de_descarga' => $faker->address,
                    'local_de_carga' =>  $faker->address,
                    'destinatario' => $faker->name(),
                    'data' => $faker->date(),
                    'responsavel' => $faker->name(),
                    'elaborado_por' => $faker->name(),
                    'pendente'=>rand(1,3)
                ]);
            }
    }
    }
}
