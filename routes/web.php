<?php
 
use Illuminate\Support\Facades\Route;  
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\BaixadaController; 
use App\Http\Controllers\BaixadaProdutoController;  
use App\Http\Controllers\StockController;
use App\Http\Controllers\ProdutoController;  
use App\Http\Controllers\StockFilterDataController; 
use App\Http\Controllers\ReportControllerController;
use App\Http\Controllers\AgrpViaturaController;
use App\Http\Controllers\UserAttribuitionController;
use App\Http\Controllers\UsuarioController;
use App\Models\Produto;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
    return redirect()->route('dashboard.index');
})->middleware(['auth'])->name('dashboard');
Route::get('/home', function () {
    return redirect()->route('dashboard.index');
})->middleware(['auth'])->name('home');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');


    // Exec. Baixada
    Route::get('/baixada/{id?}', [BaixadaController::class, 'index'])->name('guiasaida.index');
    Route::post('/baixada', [BaixadaController::class, 'store'])->name('guiasaida.store');
    Route::get('/baixada/{id}/destroy', [BaixadaController::class, 'destroy'])->name('guiasaida.destroy');
    Route::get('/baixada/imprimir/listagem', [BaixadaController::class, 'print'])->name('guiasaida.imprimir');
    Route::get('/baixada/export/xlsx', [BaixadaController::class, 'export_daily_xlsx'])->name('export_daily_xlsx.baixada');


    Route::get('/baixada/{id}/produto/index', [BaixadaProdutoController::class, 'index'])->name('guiasaidaproduto.index');
    Route::get('/baixada/{id}/produto/create', [BaixadaProdutoController::class, 'create'])->name('guiasaidaproduto.create');
    Route::post('/baixada/{id}/produto/create', [BaixadaProdutoController::class, 'create'])->name('guiasaidaproduto.create');
    
    Route::post('/baixada/{site}/{data}/{provincia_id}/{distrito_id}/{veiculo_id}/{lote}/produto/store', 
        [BaixadaProdutoController::class, 'store'])
    ->name('guiasaidaproduto.store');

    
    Route::post('/baixada/produto/store/mobile', 
        [BaixadaProdutoController::class, 'mobile_store'])
    ->name('guiasaidaproduto.mobile_store');

    Route::get('/baixada/produto/{id}/edit', [BaixadaProdutoController::class, 'edit'])->name('guiasaidaproduto.edit');
    Route::post('/baixada/{id}/produto/update', [BaixadaProdutoController::class, 'update'])->name('guiasaidaproduto.update');
    Route::get('/baixada/destroy/{id}', [BaixadaProdutoController::class, 'destroy'])->name('guiasaidaproduto.destroy');

    
    Route::post('/baixada/import/xlsx', [BaixadaProdutoController::class, 'import_xls'])->name('import_xls.baixada');

    
    Route::get('/distrito_relacionado/{provincia_id}', [BaixadaController::class, 'distritos']);
    Route::get('/veiculo_relacionado/{provincia_id}', [BaixadaController::class, 'veiculos_associados']);
  

    // Stock
    Route::any('/stock/pesquisa', [StockController::class, 'pesquisa'])->name('stock.pesquisa');
    Route::get('/stock', [StockController::class, 'index'])->name('stock.index');
    Route::get('/stock-pesquisa', [StockController::class, 'stockpage'])->name('stockpages.index');
    Route::post('/stock/produtototal', [StockController::class, 'produtoTotal'])->name('stock.produtototal');

    // Entradas e Saidas de Stock dos projectos
    Route::get('/stock/entradas_saidas', [StockFilterDataController::class, 'index'])->name('stock.entradasaida');
    Route::get('/ajustes/{produto_id}', [StockFilterDataController::class, 'ajustes_stock'])->name('ajustes_stock');
    Route::get('/stock/entradas_saidas-pesquisa', [StockFilterDataController::class, 'stockpage'])->name('stockpages.entradasaida');
    Route::any('/stockfilter/pesquisa', [StockFilterDataController::class, 'pesquisa'])->name('stockfilter.pesquisa');
    Route::get('/stockfilter/export_data', [StockFilterDataController::class, 'export_data'])->name('stockfilter.export_data');

    // Entradas e Saidas de Stock dos Sites
    Route::get('/stock/sites/entradas_saidas', [SiteStockFilterDataController::class, 'index'])->name('stock.site_entradasaida');
    Route::get('/stock/sites/entradas_saidas-pesquisa', [SiteStockFilterDataController::class, 'stockpage'])->name('stockpages.entradasaida');
    Route::any('/stockfilter/sites/pesquisa', [SiteStockFilterDataController::class, 'pesquisa'])->name('stockfilter.sites.pesquisa');

    
    Route::get('/report/sheet/bairro', [ReportControllerController::class, 'bairros'])->name('report.bairros');
    Route::get('/relatorio/baixadas/mensal', [ReportControllerController::class, 'relatorio_mensal'])->name('report.mensal');
    Route::get('/relatorio/saidas', [ReportControllerController::class, 'saidas'])->name('report.saidas');
    Route::get('/relatorio/geral', [ReportControllerController::class, 'geral'])->name('report.geral');
    Route::get('/relatorio/geral/entradas_saidas', [StockFilterDataController::class, 'geral_entradas_saidas'])->name('report.geral_entradas_saidas');

     
    Route::get('/agrp_viatura', [AgrpViaturaController::class, 'index'])->name('agrp_viatura.index');
    Route::get('/agrp_viatura/create', [AgrpViaturaController::class, 'create'])->name('agrp_viatura.create');
    Route::post('/agrp_viatura', [AgrpViaturaController::class, 'store'])->name('agrp_viatura.store');
    Route::get('/agrp_viatura/{id}', [AgrpViaturaController::class, 'show'])->name('agrp_viatura.show');
    Route::get('/agrp_viatura/{id}/edit', [AgrpViaturaController::class, 'edit'])->name('agrp_viatura.edit');
    Route::post('/agrp_viatura/{id}', [AgrpViaturaController::class, 'update'])->name('agrp_viatura.update');
    Route::get('/agrp_viatura/destroy/{id}', [AgrpViaturaController::class, 'delete'])->name('agrp_viatura.destroy');

    
    Route::get('/user_attr', [UserAttribuitionController::class, 'index'])->name('user_attr.index');
    Route::get('/user_attr/create', [UserAttribuitionController::class, 'create'])->name('user_attr.create');
    Route::post('/user_attr', [UserAttribuitionController::class, 'store'])->name('user_attr.store');
    Route::get('/user_attr/{id}', [UserAttribuitionController::class, 'show'])->name('user_attr.show');
    Route::get('/user_attr/{id}/edit', [UserAttribuitionController::class, 'edit'])->name('user_attr.edit');
    Route::post('/user_attr/{id}', [UserAttribuitionController::class, 'update'])->name('user_attr.update');
    Route::get('/user_attr/destroy/{id}', [UserAttribuitionController::class, 'delete'])->name('user_attr.destroy');


    Route::get('/usuario', [UsuarioController::class, 'index'])->name('usuario.index');
    Route::get('/usuario/create', [UsuarioController::class, 'create'])->name('usuario.create');
    Route::post('/usuario/store', [UsuarioController::class, 'store'])->name('usuario.store');
    Route::get('/usuario/{id}/edit', [UsuarioController::class, 'edit'])->name('usuario.edit');
    Route::put('/usuario/{id}', [UsuarioController::class, 'update'])->name('usuario.update');
    Route::get('/usuario/show/{id}', [UsuarioController::class, 'show'])->name('usuario.show');
    Route::get('/usuario/{id}/destroy', [UsuarioController::class, 'destroy'])->name('usuario.destroy');
    Route::get('/usuario/site/destroy/{id}', [UsuarioController::class, 'user_site_destroy'])->name('user_site_destroy');
    Route::get('/usuario/proejct/destroy/{id}', [UsuarioController::class, 'user_project_destroy'])->name('user_project_destroy');
    
});

require __DIR__ . '/auth.php';
