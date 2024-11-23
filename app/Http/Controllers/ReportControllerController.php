<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use App\Models\RelatorioStock;
use App\Models\UsuarioProjecto;
use App\Models\Guiadeentrada;
use Illuminate\Http\Request;
use App\Models\Baixada;
use DB;

class ReportControllerController extends Controller
{

    
    public function __construct(Baixada $baixadas)
    {
        $this->baixadas = $baixadas;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function bairros()
    {
        
 
        $data['controller'] = $this;
        $data['provincia_id'] = isset($_GET['provincia_id']) ? $_GET['provincia_id'] : Null; 
        $data['site_id'] = isset($_GET['site_id']) ? $_GET['site_id'] : Null; 
        
        $data['from'] = isset($_GET['from']) ? $_GET['from'] : date('Y-m-d', strtotime("-30 days")); 
        $data['to'] = isset($_GET['to']) ? $_GET['to'] : date('Y-m-d'); 
 
        
        $data['saidas'] = $this->baixadas->getAllBairroSheet($data['from'], $data['to'], $data['provincia_id'], $data['site_id']);


        $data['provincias'] = DB::table('provincias')->where('removido', 0)->get();
        
        $data['sites'] = DB::table('site')
            ->select('site.id', 'site.nome', 'projecto.nome as nome_projecto')
            ->leftJoin('projecto', 'projecto.id', '=', 'site.projecto')
            ->where([['site.removido', 0], ['site.activo', 1]])
        ->get();

        $data['meses'] = DB::table('meses')->get(); 

        return view('admin.relatorios.bairro_sheet', $data);
    }

    public function relatorio_mensal()
    {
        
        $data['site_id'] = isset($_GET['site_id']) ? $_GET['site_id'] : Null; 
        $data['from'] = isset($_GET['from']) ? $_GET['from'] : date('Y-m-d', strtotime("-30 days")); 
        $data['to'] = isset($_GET['to']) ? $_GET['to'] : date('Y-m-d'); 

        
        $data['saidas'] = $this->baixadas->getAllMontlySheet($data['from'], $data['to'], $data['site_id']);
        
        $data['sites'] = $this->sites_added();

        return view('admin.relatorios.monthly_sheet', $data);
    }
   

    public function sites_added()
    {
        
        return $data['site'] = DB::table('baixada')
            ->select('site.id', 'site.nome as site', 'projecto.nome as projecto')
            ->leftJoin('site', 'site.id', '=', 'baixada.site')
            ->leftJoin('projecto', 'projecto.id', '=', 'site.projecto')
            ->where([['baixada.removido',0], ['site.activo', 1]])
            ->where('baixada.site', '!=', Null)
            ->groupBy('baixada.site')
        ->get();
        
    }

    public function sites()
    {
        return $data['site'] = DB::table('site')
            ->select('site.id', 'site.nome as site_nome', 'projecto.nome as projecto_nome')
            ->leftJoin('projecto', 'projecto.id', '=', 'site.projecto')
            // ->whereIn('site.id', $site)
            ->where([['site.removido',0], ['site.activo', 1]])
            ->where('site.nome', 'LIKE', 'baixada' . '%')
        ->get();
    }

    public function get_obj($mes)
    {
        return  DB::table('meses')->find($mes)->nome;
    }

}
