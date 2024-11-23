<?php

namespace App\Http\Controllers;

use App\Models\GuiaEntrada_Produto;
use App\Models\Guiadeentrada;
use App\Models\GuiaDeSaida;
use App\Models\Produto;
use App\Models\ProdutoSite;
use App\Models\UsuarioProjecto;
use App\Models\StockProjectado; 
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Auth;
use DB;
use Barryvdh\DomPDF\Facade as PDF;

class StockFilterDataController extends Controller
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
        
        $site = $this->user_project->get_user_sites();
        $data['site'] = DB::table('site')
            ->select('site.id', 'site.nome as site_nome', 'projecto.nome as projecto_nome')
            ->leftJoin('projecto', 'projecto.id', '=', 'site.projecto')
            ->whereIn('site.id', $site)
            ->where([['site.removido',0], ['site.nome', 'Like', '%baixada%']]) 
        ->get();

        return view('admin.stock.date', $data);
    }
 

    // Pesquisa function
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
 
        $todosProdutos = $this->get_produtos_guias($request->projecto);

        $produtos = $this->produtos($todosProdutos, $request->datainicio, $request->datafim, $request->projecto);
 
        return response()->json(['produtos' => $produtos, 'meses' => $meses, 'data' => $data]); 
    }

    // Metodos que pega os Id's dos produtos projectados pra esse projecto;
    public function get_produtos_guias($site)
    {
         
         
        $id = [408, 410,412,469,470,372,373,368,369,370,405,406];
        $todosProdutos = Produto::with('categoria.father')
            ->whereHas('categoria', function ($q) {
                $q->where('status', 1);
            })
            ->whereIn('id', $id)
            ->orderBy('categoria_id')
            ->orderBy('nome', 'DESC')
        ->get();

        return $todosProdutos;
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

    public function totalEntrada($id, $data_inicio, $data_fim, $site)
    {
         
        switch ($id) {
            case 408:
                $col = 'quadrelec';
                break;
            case 410:
                $col = 'cx_md_2';
                break;
            
            case 412:
                $col = 'cx_md_4';
                break;
            
            case 469:
                $col = 'cb_210_mm2';
                break;
            
            case 470:
                $col = 'cb_416_mm2';
                break;
            
            case 372:
                $col = 'pm_216';
                break;
            
            case 373:
                $col = 'pm_425';
                break;
            
            case 368:
                $col = 'l_pc1';
                break;
            case 369:
                $col = 'l_pc2';
                break;
            
            case 370:
                $col = 'l_pc3';
                break;
            
            case 405:
                $col = 'contador_mono';
                break;
            
            case 406:
                $col = 'contador_trifasico';
                break;
            
            
            default:
                # code...
                break;
        }
        
        $dataSomada = strtotime($data_inicio . ' +1 day');  
        $data_inicio = date('Y-m-d', $dataSomada); 
        
        $condition = ($site == Null) ? 
        [['entrada_baixadas.removido', 0], ['entrada_baixadas.site', '!=', Null]] : 
        [['entrada_baixadas.removido', 0], ['entrada_baixadas.site', $site]];


        $total = DB::table('entrada_baixadas')
            ->select(DB::raw('SUM('.$col.') as '.$col.''))
            ->whereBetween('data', [$data_inicio, $data_fim])
            ->where($condition)
        ->sum(''.$col.'');

        
        return ['produto' => $id, 'total' => $total];
    }
 
    public function totalSaida($id, $data_inicio, $data_fim, $site)
    {

          
        switch ($id) {
            case 408:
                $col = 'quadrelec';
                break;
            case 410:
                $col = 'cx_md_2';
                break;
            
            case 412:
                $col = 'cx_md_4';
                break;
            
            case 469:
                $col = 'cb_210_mm2';
                break;
            
            case 470:
                $col = 'cb_416_mm2';
                break;
            
            case 372:
                $col = 'pm_216';
                break;
            
            case 373:
                $col = 'pm_425';
                break;
            
            case 368:
                $col = 'l_pc1';
                break;
            case 369:
                $col = 'l_pc2';
                break;
            
            case 370:
                $col = 'l_pc3';
                break;
            
            case 405:
                $col = 'contador_mono';
                break;
            
            case 406:
                $col = 'contador_trifasico';
                break;
            
            
            default:
                # code...
                break;
        }
        
        $dataSomada = strtotime($data_inicio . ' +1 day');  
        $data_inicio = date('Y-m-d', $dataSomada); 
        
        $condition = ($site == Null) ? 
        [['saida_baixadas.removido', 0], ['saida_baixadas.site', '!=', Null], ['saida_baixadas.destino', '=', Null]] : 
        [['saida_baixadas.removido', 0], ['saida_baixadas.site', $site], ['saida_baixadas.destino', '=', Null]];


        $total = DB::table('saida_baixadas')
            ->select(DB::raw('SUM('.$col.') as '.$col.''))
            ->whereBetween('data', [$data_inicio, $data_fim])
            ->where($condition)
        ->sum(''.$col.'');
        
        return ['produto' => $id, 'total' => $total];
    } 
    
    public function produtos($todosProdutos, $data_inicio, $data_fim, $site)
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
                    <td  align="right" class="font-weight-bold" style="white-space: nowrap">' . '' . '</td>
                    <td  align="right" class="font-weight-bold" style="white-space: nowrap">' . '' . '</td>
                    <td  align="right" class="font-weight-bold" style="white-space: nowrap">' . '' . '</td>
                </tr>';
                $ver = $produto->categoria->nome;
            } else {
                $categoria = '';
            }
            
            $total_entrada = $this->totalEntrada($produto->id, $data_inicio, $data_fim, $site)['total'];
            $total_saida = $this->totalSaida($produto->id, $data_inicio, $data_fim, $site)['total'];
            $saida_final = $total_entrada - $total_saida;  

            $produtos = 
    
            $produtos . ' ' . $categoria . '
            <tr style = "">

                <td class="text-center">
                    ' . $index++ . '
                </td>
                <td  style="width: 197.153px; white-space: nowrap; font-size: 13px">
                    &nbsp;' . $produto->codigo . '
                </td>
                <td style="white-space: nowrap; font-size: 13px"> 
                    &nbsp;&nbsp;' . $produto->nome . '
                </td> 
                <td style="text-align: right; white-space: nowrap;width: 100px; font-size: 13px" >
                    ' . number_format($total_entrada) . '&nbsp;
                </td>
                <td style="text-align: right; white-space: nowrap;width: 100px; font-size: 13px" >
                    ' . number_format($total_saida) . '&nbsp;
                </td>   
                <td style="text-align: right; white-space: nowrap;width: 100px; font-size: 13px"  class="font-weight-bold text-danger">
                    ' . number_format($saida_final) . '&nbsp;
                </td> 

            </tr>';
            
            
        }
        return $produtos;
    }

    public function produtos_exportable($todosProdutos, $data_inicio, $data_fim, $site)
    {
        $ver = ''; 
        $index = 1;
        $produtos = '';

        foreach ($todosProdutos as $produto) {
            if ($ver != $produto->categoria->nome) {
                $categoria = '
                <tr style="background-color: #c2e0f4!important">
                    <td colspan="6"  style = "font-size: 13px !important" align="center" class="font-weight-bold tcategoria titleProductCategorie text-danger">' . $produto->categoria->nome  . '</td>
                </tr>';
                $ver = $produto->categoria->nome;
            } else {
                $categoria = '';
            }
            
            $total_entrada = $this->totalEntrada($produto->id, $data_inicio, $data_fim, $site)['total'];
            $total_saida = $this->totalSaida($produto->id, $data_inicio, $data_fim, $site)['total'];
            $saida_final = $total_entrada - $total_saida;  

            $produtos = 
    
            $produtos . ' ' . $categoria . '
            <tr >

                <td align="center" style="border-bottom: 1px solid rgba(0,0,0,.1);  white-space: nowrap; font-size: 12px">
                    ' . $index++ . '
                </td>
                <td  style="border-bottom: 1px solid rgba(0,0,0,.1); width: 197.153px; white-space: nowrap; font-size: 12px">
                    &nbsp;' . $produto->codigo . '
                </td>
                <td style="border-bottom: 1px solid rgba(0,0,0,.1); white-space: nowrap; font-size: 12px"> 
                    &nbsp;&nbsp;' . $produto->nome . '
                </td> 
                <td style="border-bottom: 1px solid rgba(0,0,0,.1); text-align: right; white-space: nowrap;width: 100px; font-size: 12px" >
                    ' . number_format($total_entrada) . '&nbsp;
                </td>
                <td style="border-bottom: 1px solid rgba(0,0,0,.1); text-align: right; white-space: nowrap;width: 100px; font-size: 12px" >
                    ' . number_format($total_saida) . '&nbsp;
                </td>   
                <td style="border-bottom: 1px solid rgba(0,0,0,.1); text-align: right; white-space: nowrap;width: 100px; font-size: 12px; font-weight: 700"  class="font-weight-bold text-danger">
                    ' . number_format($saida_final) . '&nbsp;
                </td> 

            </tr>';
            
            
        }
        return $produtos;
    }

    public function export_data()
    {
        
        
        $data['data_inicio'] = $_GET['datainicio'];
        $data['data_fim'] = $_GET['datafim'];
        $data['site'] = $_GET['projecto'];
        $data['controller'] = $this;
        
        $todosProdutos = $this->get_produtos_guias($_GET['projecto']);
        $data['table'] = $this->produtos_exportable($todosProdutos, $data['data_inicio'], $data['data_fim'], $data['site']);

        $pdf = PDF::loadView('print.baixada_geral', $data);
        $pdf->setPaper(array(0,0,750,1060), 'portrait');
        return $pdf->stream('Relatório-de-baixadas'.time().'.pdf',array("Attachment"=>0));
    }

    public function sites()
    {
        
        $site = $this->user_project->get_user_sites();
        return $data['site'] = DB::table('site')
            ->select('site.id', 'site.nome as site_nome', 'projecto.nome as projecto_nome')
            ->leftJoin('projecto', 'projecto.id', '=', 'site.projecto')
            ->whereIn('site.id', $site)
            ->where('site.removido',0)
        ->get();
    }

    public function geral_entradas_saidas()
    {
        

        $data['from'] = $from = date("Y-m-d", strtotime("-30 day", strtotime(date('d-m-Y'))));
        $data['to'] = $to = date('Y-m-d');
        $data['site'] = Null;
        $data['site_data'] = 'Todos Sites';

        if (isset($_GET['from'])) {
            $data['from'] = $from = $_GET['from'];
            $data['to'] = $to = $_GET['to'];
            $data['site'] = $site = ($_GET['site']);
            $data['site_data'] = DB::table('site')->find($data['site']);
            $data['site_data'] = ($data['site_data']) ? $data['site_data']->nome : 'Todos Sites'; 
        }

        $data['controller'] = $this;
        $data['sites'] = $this->sites();


        return view('admin.relatorios.geral', $data);
    }

    function get_saldos($produto_id, $data_inicio, $data_fim, $site) : int {
        
        $total_entrada = $this->totalEntrada($produto_id, $data_inicio, $data_fim, $site)['total'];
        $total_saida = $this->totalSaida($produto_id, $data_inicio, $data_fim, $site)['total'];
        return $saida_final = $total_entrada - $total_saida;  
    }
 
}
 