<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GuiaEntrada_Produto;
use App\Models\Guiadeentrada;
use App\Models\GuiaDeSaida;
use App\Models\Produto;
use App\Models\UsuarioProjecto;
use App\Models\StockProjectado; 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use DB;

class StockController extends Controller
{

    
    protected $user_project;
    public function __construct(UsuarioProjecto $user_project)
    { 
        $this->user_project = $user_project;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $user_projects = $this->user_project->get_user_projects();
        $data['projecto'] = DB::table('projecto')->whereIn('id', $user_projects)->get();

        return view('admin.stock.index', $data);
    }

     
    public function pesquisa(Request $request)
    {

        $filters = $request->except('_token');
        $meses = Produto::orderBy('created_at', 'desc')->get()->groupBy(function ($item) {
            return $item->created_at->format('Y-m');
        });
 
        // Pesquisa total por search
        if ($request->pesquisa) {
            
            $produtos = $this->searchtotal($request);
            $produtos = $this->produtos($produtos, $request->datainicio, $request->datafim, $request->projecto);
            return response()->json(['produtos' => $produtos], 200);
        }


        // Pesquisa vazia
        $meses = Produto::orderBy('created_at', 'desc')->get()->groupBy(function ($item) {
            return $item->created_at->format('Y-m');
        });
        
        $mes = Produto::first()->created_at->format('Y-m');
        $data = $mes;

        $todosProdutos = Produto::with('categoria.father')
            ->whereHas('categoria', function ($q) {
                $q->where('status', 1);
            })
            ->where('status', 1)->orderBy('categoria_id')->orderBy('nome', 'asc')
            // ->whereIn('id', $this->get_produtos_projectados())
            ->whereIn('id', $this->get_produtos_guias())
        ->get();

        $produtos = $this->produtos($todosProdutos, $request->datainicio, $request->datafim, $request->projecto);
 
        return response()->json(['produtos' => $produtos, 'meses' => $meses, 'data' => $data]); 
    }

    // Metodos que pega os Id's dos produtos projectados pra esse projecto;
    public function get_produtos_guias()
    {
        // Projectos do usuario!
        $user_projects = $this->user_project->get_user_projects();

        // Alternativa de produtos, fora do projectado!
        return $projeccao = Guiadeentrada::whereIn('projecto', $user_projects)
            ->leftJoin('guia_entrada__produtos', 'guia_entrada__produtos.guiaEntrada_id', 'guiadeentradas.id')
            ->groupBy('guia_entrada__produtos.produto_id')
        ->pluck('guia_entrada__produtos.produto_id');

    }

    // Metodos que pega os Id's dos produtos projectados pra esse projecto;
    public function get_produtos_projectados()
    {
        // Projectos do usuario!
        $user_projects = $this->user_project->get_user_projects();
        // Id das projeccoes!
        $projeccao = StockProjectado::whereIn('projecto', $user_projects)->orderBy('id', 'desc')->pluck('id');
        // Id dos produtos das projeccoes!
        return DB::table('stock_projectado_produtos')
            ->whereIn('projectado_id', $projeccao)->groupBy('produto_id')
        ->pluck('produto_id');
    }

    // Filtros
    public function filtros($request)
    {
        return $produtos = Produto::with('categoria.father', 'guiaEntradaProduto', 'guiaSaidaProduto')->where('status', 1)->Where('nome', 'LIKE', $request->nome . '%')->Where('codigo', 'LIKE', $request->codigo . '%')
            ->WhereHas('categoria', function ($q) use ($request) {
                $q->where('nome', 'LIKE', $request->subcategoria . '%')->where('status', 1);
            })
            ->WhereHas('categoria', function ($q) use ($request) {
                $pai = $request;
                $q->where('status', 1)->WhereHas('father', function ($f) use ($pai) {
                    $f->where('nome', 'LIKE', $pai->categoria . '%');
                });
            })->orderBy('categoria_id')
            ->get();
    }

    // Pesquisa total de search
    public function searchtotal($request)
    {

        return $produtos = Produto::with('categoria.father')->where('status', 1)->Where('nome', 'LIKE', $request->pesquisa . '%')
            ->orWhere('codigo', 'LIKE', $request->pesquisa . '%')
            ->orWhereHas('categoria', function ($q) use ($request) {
                $q->where('nome', 'LIKE', $request->pesquisa . '%')->where('status', 1);
            })
            ->orWhereHas('categoria', function ($q) use ($request) {
                $pai = $request;
                $q->where('status', 1)->WhereHas('father', function ($f) use ($pai) {
                    $f->where('nome', 'LIKE', $pai->pesquisa . '%');
                });
            })->orderBy('categoria_id')
        ->get(); 
    }

    function pendente($pendente)
    {
        $pendente;
        return $produtos = Produto::where('status', 1)->Where('pendente', 'LIKE', $pendente . '%')
            ->paginate(20);
    }
 

    public function totalEntrada($id, $data_inicio, $data_fim, $projecto)
    {
        $dataSomada = strtotime($data_inicio . ' +1 day');  
        $data_inicio = date('Y-m-d', $dataSomada); 

        if ($projecto != 0 && $projecto != NULL) {
            $condition = [['numero_do_folheto', '<>', 'AJUSTE'], ['tipo', 1], ['projecto', $projecto]];

            $produto = Produto::with([
                'categoria.father', 'entradaTotal' => function ($q) use ($data_inicio, $data_fim, $condition) {

                    $q->whereHas('guiaDeEntrada', function ($q) use ($data_inicio, $data_fim, $condition) {
                        $q->whereBetween('data', [$data_inicio, $data_fim])
                        ->where($condition);
                    });
                }
            ])->where('status', 1)->find($id);

        } else {
            $project = $this->user_project->get_user_projects();

            $produto = Produto::with([
                'categoria.father', 'entradaTotal' => function ($q) use ($data_inicio, $data_fim, $project) {

                    $q->whereHas('guiaDeEntrada', function ($q) use ($data_inicio, $data_fim, $project) {
                        $q->whereBetween('data', [$data_inicio, $data_fim]);
                    });
                }
            ])->where('status', 1)->find($id);

        }

        $total = ($produto->entradaTotal_counter($projecto));
        
        return ['produto' => $produto, 'total' => $total];
    }

    public function totalSaida($id, $data_inicio, $data_fim, $projecto)
    {

        $dataSomada = strtotime($data_fim . ' -0 day'); // Exemplo de saída: 1565064000
        $data_fim = date('Y-m-d', $dataSomada); // 06/08/2019

        if ($projecto != 0 && $projecto != NULL) {
            $condition = [['numero_do_folheto', '<>', 'AJUSTE'], ['tipo', 1], [ 'projecto', $projecto] ];

            $produto = Produto::with([
                'categoria.father', 'saidaTotal' => function ($q) use ($data_inicio, $data_fim, $condition) {

                    $q->whereHas('guiaSaida', function ($q) use ($data_inicio, $data_fim, $condition) {
                        $q->whereBetween('data_do_recebimento', [$data_inicio, $data_fim])
                        ->where($condition);
                    });
                }
            ])->where('status', 1)->find($id);

        } else {
            $project = $this->user_project->get_user_projects();

            $produto = Produto::with([
                'categoria.father', 'saidaTotal' => function ($q) use ($data_inicio, $data_fim, $project) {

                    $q->whereHas('guiaSaida', function ($q) use ($data_inicio, $data_fim, $project) {
                        $q->whereBetween('data_do_recebimento', [$data_inicio, $data_fim])
                        ->whereIn('projecto', $project);
                    });
                }
            ])->where('status', 1)->find($id);

        }
        
        // $total = ($produto->saidaTotal->sum('quantidade'));
        $total = ($produto->saidaTotal_counter($projecto));
        
        return ['produto' => $produto, 'total' => $total];
    }

    public function produtos($todosProdutos, $data_inicio, $data_fim, $projecto)
    {
        $ver = ''; 
        $index = 1;
        $produtos = '';

        foreach ($todosProdutos as $produto) {
            if ($ver != $produto->categoria->nome) {
                $categoria = '<tr>
                    <td  class="font-weight-bold">' . '' . '</td>
                    <td  align="center" class="font-weight-bold" style="white-space: nowrap">' . '' . '</td>
                    <td  style = "font-size: 14px !important" align="center" class="font-weight-bold tcategoria titleProductCategorie text-danger">' . $produto->categoria->nome  . '</td>
                    <td  align="center" class="font-weight-bold" style="white-space: nowrap">' . '' . '</td>
                </tr>';
                $ver = $produto->categoria->nome;
            } else {
                $categoria = '';
            }
            
            $total_entrada = $this->totalEntrada($produto->id, $data_inicio, $data_fim, $projecto)['total'];
            $total_saida = $this->totalSaida($produto->id, $data_inicio, $data_fim, $projecto)['total'];


            $qtd_total = $total_entrada - $total_saida;
            
            if ($produto->controle_quantidade == 1 && $produto->quantidade_minima >= $saida_final) {
                $produtos = 
            
                $produtos . ' ' . $categoria . '
                <tr style = "" class= "blink-bg">

                    <td class="text-center">
                        ' . $index++ . '
                    </td>
                    <td class="" style="width: 197.153px; white-space: nowrap; font-size: 13px">
                        ' . $produto->codigo . '
                    </td>
                    <td style="white-space: nowrap; font-size: 13px"> 
                        &nbsp;&nbsp;' . $produto->nome . '
                    </td> 
                    <td style="text-align: center; white-space: nowrap;width: 100px; font-size: 13px" >
                        ' . number_format($qtd_total, 1) . '&nbsp;&nbsp;
                    </td> 

                </tr>';
            } else {
                $produtos = 
            
                $produtos . ' ' . $categoria . '
                <tr>

                    <td class="text-center">
                        ' . $index++ . '
                    </td>
                    <td class="" style="width: 197.153px; white-space: nowrap; font-size: 13px">
                        &nbsp;&nbsp;' . $produto->codigo . '
                    </td>
                    <td style="white-space: nowrap; font-size: 13px" > 
                        &nbsp;&nbsp;' . $produto->nome . ' 
                    </td> 
                    <td style="text-align: right; white-space: nowrap;width: 100px; font-size: 13px" >
                        ' . number_format($qtd_total,1) . ' &nbsp;&nbsp;
                    </td>
                    
                </tr>';
            }
            
            
        }
        return $produtos;
    }

    public function stockpage(){
        return view('admin.stockpages.date');
    }

}
