<?php

namespace App\Http\Controllers;
 
use App\Models\Baixada;
use App\Models\UserAtribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;


use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class BaixadaController extends Controller
{
 
    public function __construct(Baixada $baixadas)
    { 
        $this->baixadas = $baixadas;
    }


    public function index($id = null)
    {

        $check_attr = UserAtribution::where([['user_id', Auth::user()->id], ['removido', 0], ['status', 1]])->count();

        if (Auth::user()->mobile_access == 1 && $check_attr != 0) {
            
            $data['baixada_info'] = UserAtribution::select('site.nome as site', 'provincias.nome as provincia', 'distritos.nome as distrito', 'veiculo.matricula')
                ->leftJoin('site', 'site.id', '=', 'user_atribution_baixada.site') 
                ->leftJoin('provincias', 'provincias.id', '=', 'user_atribution_baixada.provincia_id') 
                ->leftJoin('distritos', 'distritos.id', '=', 'user_atribution_baixada.distrito_id') 
                ->leftJoin('veiculo', 'veiculo.id', '=', 'user_atribution_baixada.viatura_id') 
                ->leftJoin('users', 'users.id', '=', 'user_atribution_baixada.user_id') 
                ->where([['user_id', Auth::user()->id], ['user_atribution_baixada.removido', 0], ['user_atribution_baixada.status', 1]])
            ->first();

            return view('admin.guiadesaida.produto.create_mobile_view', $data);
        }
       
        $data['controller'] = $this;
        $data['provincia_id'] = isset($_GET['provincia_id']) ? $_GET['provincia_id'] : Null; 
        $data['viatura_id'] = isset($_GET['viatura_id']) ? $_GET['viatura_id'] : Null;  
        $data['site_id'] = isset($_GET['site_id']) ? $_GET['site_id'] : Null;  
        $data['contador'] = isset($_GET['contador']) ? $_GET['contador'] : Null;  
        $data['from'] = isset($_GET['from']) ? $_GET['from'] : date('Y-m-d', strtotime("-30 days")); 
        $data['to'] = isset($_GET['to']) ? $_GET['to'] : date('Y-m-d'); 
        
        $data['provincias'] = DB::table('provincias')->where('removido', 0)->get();
        $data['veiculos_added'] = $this->veiculo_added();
        $data['veiculos'] = DB::table('veiculo')->where('removido', 0)->get();
        $data['sites_added'] = $this->sites_added();
        $data['sites'] = $this->sites();
 
        $data['saidas'] = $this->baixadas->getAll($data['from'], $data['to'], $data['provincia_id'], $data['viatura_id'], $data['site_id'], $data['contador']);


        return view('admin.guiadesaida.index', $data);
    }

    public function veiculo_added()
    {

        return $data_list = DB::table('veiculo')
            ->select('id', 'matricula') 
            ->where('removido',0)
        ->get();
        
        return DB::table('veiculo')
            ->select('baixada.viatura_id as id', 'veiculo.matricula', 'marca') 
            ->leftJoin('baixada', 'baixada.id', '=', 'veiculo.id')
            ->where('baixada.viatura_id', '!=', Null)
            ->where('baixada.removido',0)
            ->groupBy('baixada.viatura_id')
        ->get();
        
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

    public function distritos($provincia_id)
    {
        
        return  DB::table('distritos') 
            ->where([['removido',0], ['provincia_id', $provincia_id]])
        ->get();
        
    }

    
    public function veiculos_associados($provincia_id)
    {
         
        $agrp = DB::table('agrp_viaturas')
            ->select('veiculo.matricula', 'veiculo.id')
            ->leftJoin('veiculo', 'veiculo.id', '=', 'agrp_viaturas.viatura_id')
            ->where([['veiculo.removido',0], ['provincia_id', $provincia_id]])
        ->get();
        
        $veiculo = DB::table('veiculo')
            ->select('veiculo.matricula', 'veiculo.id') 
            ->where([['removido',0], ['activo', 1]])
        ->get();

        return $agrp->count() > 0 ? $agrp : $veiculo; 
        
    }

    public function destroy($id)
    {

        try {

            $saidas = DB::table('saida_baixadas')
                ->where('id', $id) 
            ->delete();
            $this->toaster('success', 'Execu. De baixada removida com sucesso!');

        } catch (\Throwable $error) {
            
            $this->toaster('error', 'Erro ao tentar remover exec. De baixada!');
        }

        return redirect()->back();
    }

    public function toaster($type, $message)
    {
        return toastr()->$type($message);
    }

    function get_site($id) {
        return DB::table('site')->find($id)->nome;
    }
   
    public function export_daily_xlsx()
    { 
        
        $data['provincia_id'] = (isset($_GET['provincia_id']) && $_GET['provincia_id'] != 0) ? $_GET['provincia_id'] : null; 
        $data['viatura_id'] = (isset($_GET['viatura_id']) && $_GET['viatura_id'] != 0) ? $_GET['viatura_id'] : Null;  
        $data['site_id'] = (isset($_GET['site_id']) && $_GET['site_id'] != 0) ? $_GET['site_id'] : Null;  
        $data['from'] = isset($_GET['from']) ? $_GET['from'] : date('Y-m-d', strtotime("-30 days")); 
        $data['to'] = isset($_GET['to']) ? $_GET['to'] : date('Y-m-d'); 

        $site_name = (isset($_GET['site_id']) && $_GET['site_id'] != 0) ? $this->get_site($_GET['site_id']) : 'N/A';  
        $viatura_name = (isset($_GET['viatura_id']) && $_GET['viatura_id'] != 0) ? DB::table('veiculo')->find($_GET['viatura_id'])->matricula : 'N/A';  
        

        $report_list = $this->baixadas->getAllDailyExport($data['from'], $data['to'], $data['provincia_id'], $data['viatura_id'], $data['site_id']);

        
        $reader = IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load(public_path('Baixadas.xlsx'));
        $currentContentRow = 5;


        $spreadsheet->setActiveSheetIndex(0);
        
        $spreadsheet->getActiveSheet()->setCellValue('A1', 'Projecto/Site: '.$site_name.' - Viatura: '.$viatura_name.'  | Data: ' . $data['from'] . ' Até '. $data['to']);
        

        foreach ($report_list as $index => $row) {
            $spreadsheet->getActiveSheet()->insertNewRowBefore($currentContentRow + 1, 1);
            // fill the cell with data

            $spreadsheet
                ->getActiveSheet()
                ->setCellValue('A' . $currentContentRow, $index + 1)
                ->setCellValue('B' . $currentContentRow, $row->cliente)
                ->setCellValue('C' . $currentContentRow, $row->bairro_id)
                ->setCellValue('D' . $currentContentRow, $row->contador)
                ->setCellValue('E' . $currentContentRow, $row->quadro_electrico)
                ->setCellValue('F' . $currentContentRow, $row->cabo_abc_2_10)
                ->setCellValue('G' . $currentContentRow, $row->cabo_abc_4_16)
                ->setCellValue('H' . $currentContentRow, $row->pinca_2_16)
                ->setCellValue('I' . $currentContentRow, $row->pinca_4_16)
                ->setCellValue('J' . $currentContentRow, $row->ligadores_pc1)
                ->setCellValue('K' . $currentContentRow, $row->ligadores_pc2)
                ->setCellValue('L' . $currentContentRow, $row->coordenadas)
                ->setCellValue('M' . $currentContentRow, $row->distrito_nome)
                ->setCellValue('N' . $currentContentRow, ($row->baixada_mono == 0 || $row->baixada_mono == Null) ? 'Trif' : 'Mono')
                ->setCellValue('O' . $currentContentRow, $row->caixa_sup_post_v2)
                ->setCellValue('P' . $currentContentRow, $row->tecnico)
                ->setCellValue('Q' . $currentContentRow, $row->contacto);
            // increment the current row number
            $currentContentRow++;
        }

        // $spreadsheet
        //     ->getActiveSheet()
        //     ->setCellValue('E' . ($currentContentRow + 1), $total_sum);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="report_baixadas.xlsx"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        //create IOFactory object
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        //save into php output
        $writer->save('php://output');

            
        // $this->toaster('success', 'Relatorio Exportado com sucesso');
        // return redirect()->back();
        
    }
 
     
 
}
