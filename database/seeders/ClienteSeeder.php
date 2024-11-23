<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i=0;$i<=100;$i++){
            Cliente::create([
                'nome'=>$faker->firstname,
                'email'=>$faker->email,
                'telefone'=>$faker->numerify('#########'),
                'nuit'=>$faker->numerify('#########'),
                'endereco1'=>$faker->address,
                'endereco2'=>$faker->address,
                'pais'=>$faker->country,
                'provincia'=>$faker->country,
                'representante_do_cliente'=>$faker->name(),
                'email_do_representante'=>$faker->email,
                'telefone_do_representante'=>$faker->numerify('#########'),
            ]);
        }
    }
}
