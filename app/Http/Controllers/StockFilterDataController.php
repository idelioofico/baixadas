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
            ->select('site.id', 'site.nome as site_nome')
            ->leftJoin('saida_baixadas', 'saida_baixadas.site', '=', 'site.id')
            ->leftJoin('entrada_baixadas', 'entrada_baixadas.site', '=', 'site.id')
            ->where([['entrada_baixadas.site', '!=', Null], ['saida_baixadas.site', '!=', Null]])
            ->where([['site.removido',0], ['site.nome', 'Like', '%baixada%']]) 
            ->groupBy('site.id')
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
 
        // Pesquisa vazia
        $meses = Produto::orderBy('created_at', 'desc')->get()->groupBy(function ($item) {
            return $item->created_at->format('Y-m');
        });
        
        $mes = Produto::first()->created_at->format('Y-m');
        $data = $mes;
 
        $todosProdutos = $this->get_produtos_guias();

        $produtos = $this->produtos($todosProdutos, $request->projecto, $request->ano);
 
        return response()->json(['produtos' => $produtos, 'meses' => $meses, 'data' => $data]); 
    }

    // Metodos que pega os Id's dos produtos projectados pra esse projecto;
    public function get_produtos_guias()
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

    public function totalEntrada($id, $mes, $site, $ano)
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
         
        
        $condition = ($site == Null) ? 
        [['entrada_baixadas.removido', 0], ['entrada_baixadas.site', '!=', Null]] : 
        [['entrada_baixadas.removido', 0], ['entrada_baixadas.site', $site]];


        $total = DB::table('entrada_baixadas')
            ->select(DB::raw('SUM('.$col.') as '.$col.''))
            ->whereMonth('data', '=', $mes)
            ->whereYear('data', '=', $ano)
            ->where($condition)
        ->sum(''.$col.'');

        
        return ['produto' => $id, 'total' => $total];
    }
 
    public function totalSaida($id, $mes, $site, $ano)
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
         
        
        $condition = ($site == Null) ? 
        [['saida_baixadas.removido', 0], ['saida_baixadas.site', '!=', Null], ['saida_baixadas.destino', '=', Null]] : 
        [['saida_baixadas.removido', 0], ['saida_baixadas.site', $site], ['saida_baixadas.destino', '=', Null]];


        $total = DB::table('saida_baixadas')
            ->select(DB::raw('SUM('.$col.') as '.$col.''))
            ->whereMonth('data', '=', $mes)
            ->whereYear('data', '=', $ano)
            ->where($condition)
        ->sum(''.$col.'');
        
        return ['produto' => $id, 'total' => $total];
    } 
    
    public function produtos($todosProdutos, $site, $ano)
    {
        $ver = ''; 
        $index = 1;
        $produtos = '';
        
        $ano = ($ano == '' || $ano == Null) ? date('Y') : $ano;

        foreach ($todosProdutos as $produto) {
            if ($ver != $produto->categoria->nome) {
                $categoria = '<tr style="background: antiquewhite;"> 
                    <td style = "font-size: 12px !important" align="center" class="font-weight-bold tcategoria titleProductCategorie text-danger">' . $produto->categoria->nome  . '</td>
                    <td colspan="12"  align="right" class="font-weight-bold" style="white-space: nowrap">' . '' . '</td> 
                </tr>';
                $ver = $produto->categoria->nome;
            } else {
                $categoria = '';
            }
             

            $produtos = 
    
            $produtos . ' ' . $categoria . '
            <tr>
 
                <td style="font-size: 11px; width: 10%; padding: 10px;"> 
                     ' . $produto->nome . '
                </td> 
                <td style="text-align: right;width: 100px; font-size: 13px" >
                    <span style="font-size: 10px">' . number_format($this->totalEntrada($produto->id, 1, $site, $ano)['total']) . 
                    '</span>&nbsp;<br><span style="font-size: 10px">' . number_format($this->totalSaida($produto->id, 1, $site, $ano)['total']) . 
                    '</span>&nbsp;<br><b style="font-size: 11px">' . number_format($this->get_values($produto->id, 1, $site, $ano)) . '&nbsp;</b>
                </td> 
                <td style="text-align: right;width: 100px; font-size: 13px" >
                    <span style="font-size: 10px">' . number_format($this->totalEntrada($produto->id, 2, $site, $ano)['total']) . 
                    '</span>&nbsp;<br><span style="font-size: 10px">' . number_format($this->totalSaida($produto->id, 2, $site, $ano)['total']) . 
                    '</span>&nbsp;<br><b style="font-size: 11px">' . number_format($this->get_values($produto->id, 2, $site, $ano)) . '&nbsp;</b>
                </td> 
                <td style="text-align: right;width: 100px; font-size: 13px" >
                    <span style="font-size: 10px">' . number_format($this->totalEntrada($produto->id, 3, $site, $ano)['total']) . 
                    '</span>&nbsp;<br><span style="font-size: 10px">' . number_format($this->totalSaida($produto->id, 3, $site, $ano)['total']) . 
                    '</span>&nbsp;<br><b style="font-size: 11px">' . number_format($this->get_values($produto->id, 3, $site, $ano)) . '&nbsp;</b>
                </td>  
                <td style="text-align: right;width: 100px; font-size: 13px" >
                    <span style="font-size: 10px">' . number_format($this->totalEntrada($produto->id, 4, $site, $ano)['total']) . 
                    '</span>&nbsp;<br><span style="font-size: 10px">' . number_format($this->totalSaida($produto->id, 4, $site, $ano)['total']) . 
                    '</span>&nbsp;<br><b style="font-size: 11px">' . number_format($this->get_values($produto->id, 4, $site, $ano)) . '&nbsp;</b>
                </td> 
                
                <td style="text-align: right;width: 100px; font-size: 13px" >
                    <span style="font-size: 10px">' . number_format($this->totalEntrada($produto->id, 5, $site, $ano)['total']) . 
                    '</span>&nbsp;<br><span style="font-size: 10px">' . number_format($this->totalSaida($produto->id, 5, $site, $ano)['total']) . 
                    '</span>&nbsp;<br><b style="font-size: 11px">' . number_format($this->get_values($produto->id, 5, $site, $ano)) . '&nbsp;</b>
                </td> 
               
                <td style="text-align: right;width: 100px; font-size: 13px" >
                    <span style="font-size: 10px">' . number_format($this->totalEntrada($produto->id, 6, $site, $ano)['total']) . 
                    '</span>&nbsp;<br><span style="font-size: 10px">' . number_format($this->totalSaida($produto->id, 6, $site, $ano)['total']) . 
                    '</span>&nbsp;<br><b style="font-size: 11px">' . number_format($this->get_values($produto->id, 6, $site, $ano)) . '&nbsp;</b>
                </td> 
                
                <td style="text-align: right;width: 100px; font-size: 13px" >
                    <span style="font-size: 10px">' . number_format($this->totalEntrada($produto->id, 7, $site, $ano)['total']) . 
                    '</span>&nbsp;<br><span style="font-size: 10px">' . number_format($this->totalSaida($produto->id, 7, $site, $ano)['total']) . 
                    '</span>&nbsp;<br><b style="font-size: 11px">' . number_format($this->get_values($produto->id, 7, $site, $ano)) . '&nbsp;</b>
                </td> 
                
                <td style="text-align: right;width: 100px; font-size: 13px" >
                    <span style="font-size: 10px">' . number_format($this->totalEntrada($produto->id, 8, $site, $ano)['total']) . 
                    '</span>&nbsp;<br><span style="font-size: 10px">' . number_format($this->totalSaida($produto->id, 8, $site, $ano)['total']) . 
                    '</span>&nbsp;<br><b style="font-size: 11px">' . number_format($this->get_values($produto->id, 8, $site, $ano)) . '&nbsp;</b>
                </td> 
                
                <td style="text-align: right;width: 100px; font-size: 13px" >
                    <span style="font-size: 10px">' . number_format($this->totalEntrada($produto->id, 9, $site, $ano)['total']) . 
                    '</span>&nbsp;<br><span style="font-size: 10px">' . number_format($this->totalSaida($produto->id, 9, $site, $ano)['total']) . 
                    '</span>&nbsp;<br><b style="font-size: 11px">' . number_format($this->get_values($produto->id, 9, $site, $ano)) . '&nbsp;</b>
                </td>  
                
                <td style="text-align: right;width: 100px; font-size: 13px" >
                    <span style="font-size: 10px">' . number_format($this->totalEntrada($produto->id, 10, $site, $ano)['total']) . 
                    '</span>&nbsp;<br><span style="font-size: 10px">' . number_format($this->totalSaida($produto->id, 10, $site, $ano)['total']) . 
                    '</span>&nbsp;<br><b style="font-size: 11px">' . number_format($this->get_values($produto->id, 10, $site, $ano)) . '&nbsp;</b>
                </td> 
                
                <td style="text-align: right;width: 100px; font-size: 13px" >
                    <span style="font-size: 10px">' . number_format($this->totalEntrada($produto->id, 11, $site, $ano)['total']) . 
                    '</span>&nbsp;<br><span style="font-size: 10px">' . number_format($this->totalSaida($produto->id, 11, $site, $ano)['total']) . 
                    '</span>&nbsp;<br><b style="font-size: 11px">' . number_format($this->get_values($produto->id, 11, $site, $ano)) . '&nbsp;</b>
                </td> 
                
                <td style="text-align: right;width: 100px; font-size: 13px" >
                    <span style="font-size: 10px">' . number_format($this->totalEntrada($produto->id, 12, $site, $ano)['total']) . 
                    '</span>&nbsp;<br><span style="font-size: 10px">' . number_format($this->totalSaida($produto->id, 12, $site, $ano)['total']) . 
                    '</span>&nbsp;<br><b style="font-size: 11px">' . number_format($this->get_values($produto->id, 12, $site, $ano)) . '&nbsp;</b>
                </td> 
            </tr>';
            
            
        }
        return $produtos;
    }

    function get_values($produto_id, $mes, $site, $ano){
        $total_entrada = $this->totalEntrada($produto_id, $mes, $site, $ano)['total'];
        $total_saida = $this->totalSaida($produto_id, $mes, $site, $ano)['total'];
        return $saida_final = $total_entrada - $total_saida;  
    }

    public function export_data(Request $request)
    {
        
        $data['controller'] = $this;
        
        $todosProdutos = $this->get_produtos_guias();
        $data['table'] = $this->produtos($todosProdutos, $request->site, $request->ano);
        $data['site'] = $request->site;
        $data['ano'] = $request->ano;

        $pdf = PDF::loadView('print.baixada_geral', $data);
        $pdf->setPaper('A3', 'landscape');
        return $pdf->stream('relatório_mensal_baixadas'.time().'.pdf',array("Attachment"=>0));
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

 
}
 