<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use Faker\Generator as Faker;
class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        
            Categoria::create([
                'nome' => 'Consumiveis',
                'parent_id' => 0
            ]);
            Categoria::create([
                'nome' => 'Produtos não Consumíveis',
                'parent_id' => 0
            ]);
        
        
            Categoria::create([
                'nome' => 'Frutas',
                'parent_id' => 1
            ]);
            Categoria::create([
                'nome' => 'Vegetais',
                'parent_id' => 1
            ]);
            Categoria::create([
                'nome' => 'Carros',
                'parent_id' => 2
            ]);
            Categoria::create([
                'nome' => 'Empresas',
                'parent_id' => 2
            ]);
            
        
        
    }
}
