<?php

namespace Database\Seeders;

use App\Models\GuiaDeSaida;
use App\Models\GuiaDeTransporte;
use App\Models\GuiaSaida_Produto;
use App\Models\RequisicaoArmazem;
use App\Models\RequisicaoArmazem_Produto;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // $this->call(UsuariosSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(FornecedorSeeder::class);
        $this->call(Fornecedor_CategoriasSeeder::class);
        $this->call(ProdutoSeeder::class);
        $this->call(GuiadeEntradaSeeder::class);
        $this->call(GuiaEntradaProdutoSeeder::class);
        
        $this->call(RequisicaoArmazemSeeder::class);
        $this->call(RequisicaoArmazemProdutoSeeders::class);

        $this->call(PropostaSeeder::class);
        $this->call(PropostaProdutoSeeder::class);
        $this->call(GuiaDeTransporteSeeder::class);
        
        $this->call(GuiaSaidaSeeder::class);
    }
}
