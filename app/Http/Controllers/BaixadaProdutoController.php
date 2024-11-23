<?php

namespace App\Http\Controllers;

use App\Models\Baixada;
use App\Models\BaixadaProduto;
use App\Models\Produto;
use App\Models\SaidaBaixadas;
use App\Models\UserAtribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;



class BaixadaProdutoController extends Controller
{

    public function __construct(Baixada $baixadas)
    {
        $this->baixadas = $baixadas;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {


        $check_attr = UserAtribution::where([['user_id', Auth::user()->id], ['removido', 0], ['status', 1]])->count();

        if (Auth::user()->mobile_access == 1 && $check_attr != 0) {

            $data['baixada_info'] = UserAtribution::select('site.nome as site', 'provincias.nome as provincia', 'distritos.nome as distrito', 'veiculo.matricula', 'user_atribution_baixada.provincia_id')
                ->leftJoin('site', 'site.id', '=', 'user_atribution_baixada.site')
                ->leftJoin('provincias', 'provincias.id', '=', 'user_atribution_baixada.provincia_id')
                ->leftJoin('distritos', 'distritos.id', '=', 'user_atribution_baixada.distrito_id')
                ->leftJoin('veiculo', 'veiculo.id', '=', 'user_atribution_baixada.viatura_id')
                ->leftJoin('users', 'users.id', '=', 'user_atribution_baixada.user_id')
                ->where([['user_id', Auth::user()->id], ['user_atribution_baixada.removido', 0], ['user_atribution_baixada.status', 1]])
            ->first();


            $data['distritos'] = DB::table('distritos')->where('provincia_id', $data['baixada_info']->provincia_id)->get();

            return view('admin.guiadesaida.produto.create_mobile_view', $data);

        }elseif (Auth::user()->mobile_access == 1 && $check_attr == 0) {
            # code...
            return redirect()->route('guiasaida.index');
        }

        if (!isset($_GET['site']) || !isset($_GET['provincia_id']) || !isset($_GET['distrito_id']) || !isset($_GET['veiculo_id'])) {

            $this->toaster('error', 'Opps....! Preencha todos campos do formulario para continuar.');
            return redirect()->back();

        }
        $data['data'] = $_GET['data'];
        $data['site'] = $_GET['site'];
        $data['provincia_id'] = $_GET['provincia_id'];
        $data['distrito_id'] = $_GET['distrito_id'];
        $data['veiculo_id'] = $_GET['veiculo_id'];
        $data['lote'] = $_GET['lote'];

        $data['registed'] = $this->baixadas->getAllReistered(
            $data['data'], $data['site'], $data['provincia_id'], $data['distrito_id'], $data['veiculo_id'], $data['lote']
        );

        $data['baixada_info'] = $this->find_values($_GET['provincia_id'], $_GET['distrito_id'], $_GET['veiculo_id'])[0];



        return view('admin.guiadesaida.produto.create', $data);
    }

    public function edit($id)
    {


        $check_attr = UserAtribution::where([['user_id', Auth::user()->id], ['removido', 0], ['status', 1]])->count();

        if (Auth::user()->mobile_access == 1 && $check_attr != 0) {

            $data['baixada_info'] = UserAtribution::select('site.nome as site', 'provincias.nome as provincia', 'distritos.nome as distrito', 'veiculo.matricula', 'user_atribution_baixada.provincia_id')
                ->leftJoin('site', 'site.id', '=', 'user_atribution_baixada.site')
                ->leftJoin('provincias', 'provincias.id', '=', 'user_atribution_baixada.provincia_id')
                ->leftJoin('distritos', 'distritos.id', '=', 'user_atribution_baixada.distrito_id')
                ->leftJoin('veiculo', 'veiculo.id', '=', 'user_atribution_baixada.viatura_id')
                ->leftJoin('users', 'users.id', '=', 'user_atribution_baixada.user_id')
                ->where([['user_id', Auth::user()->id], ['user_atribution_baixada.removido', 0], ['user_atribution_baixada.status', 1]])
            ->first();


            $data['distritos'] = DB::table('distritos')->where('provincia_id', $data['baixada_info']->provincia_id)->get();

            return view('admin.guiadesaida.produto.create_mobile_view', $data);

        }elseif (Auth::user()->mobile_access == 1 && $check_attr == 0) {
            # code...
            return redirect()->route('guiasaida.index');
        }


        $data['baixada_id'] = $id;
        $data['data'] = Baixada::find($id);
        $data['baixada_info'] = $this->find_values($data['data']->provincia_id, $data['data']->distrito, $data['data']->viatura_id)[0];

        return view('admin.guiadesaida.produto.edit', $data);
    }

    function find_values($prov, $distr, $veic) {

        $prov = DB::table('provincias')->find($prov);
        $distr = DB::table('distritos')->find($distr);
        $veic = DB::table('veiculo')->find($veic);

        return array([
            'provincia' => $prov ? $prov->nome : null,
            'distrito' => $distr ? $distr->nome : null,
            'veiculo' => $veic ? $veic->matricula : null,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $site, $data, $provincia_id, $distrito_id, $veiculo_id, $lote)
    {
        try {

            $contador = DB::table('baixada')->where([['contador', $request->contador], ['removido', 0]])->count();

            if ($contador == 0) {
                Baixada::create([
                    'site' => $site,
                    'data' => $data,
                    'distrito' => $distrito_id,
                    'viatura_id' => $veiculo_id,
                    'provincia_id' => $provincia_id,
                    'lote' => $lote,
                    'user_id' => auth()->user()->id,
                    'tecnico' => $request->tecnico,
                    'cliente' => $request->cliente,
                    'bairro_id' => $request->bairro,
                    'contador' => $request->contador,
                    'contacto' => $request->contacto,
                    'pinca_2_16' => $request->pinca_2_16,
                    'pinca_4_16' => $request->pinca_4_16,
                    'coordenadas' => $request->coordenadas,
                    'baixada_tri' => $request->baixada_tri,
                    'baixada_mono' => $request->baixada_mono,
                    'cabo_abc_2_10' => $request->cabo_abc_2_10,
                    'cabo_abc_4_16' => $request->cabo_abc_4_16,
                    'ligadores_pc1' => $request->ligadores_pc1,
                    'ligadores_pc2' => $request->ligadores_pc2,
                    'kicker_post_66' => $request->kicker_post_66,
                    'quadro_electrico' => $request->quadro_electrico,
                    'caixa_sup_post_v2' => $request->caixa_sup_post_v2,
                    'caixa_sup_post_v4' => $request->caixa_sup_post_v4,
                ]);

                return response()->json('Produto salvo com sucesso', 200);
            }


            return response()->json('Erro, o numero de contador nao pode ser repetido!', 505);


        } catch (\Throwable $error) {

            return response()->json('Erro ao tentar salvar produto', 505);

        }
    }

    public function update(Request $request, $id)
    {
        try {

            Baixada::find($id)->update([
                'tecnico' => $request->tecnico,
                'cliente' => $request->cliente,
                'bairro_id' => $request->bairro,
                'contador' => $request->contador,
                'contacto' => $request->contacto,
                'pinca_2_16' => $request->pinca_2_16,
                'pinca_4_16' => $request->pinca_4_16,
                'coordenadas' => $request->coordenadas,
                'baixada_tri' => $request->baixada_tri,
                'baixada_mono' => $request->baixada_mono,
                'cabo_abc_2_10' => $request->cabo_abc_2_10,
                'cabo_abc_4_16' => $request->cabo_abc_4_16,
                'ligadores_pc1' => $request->ligadores_pc1,
                'ligadores_pc2' => $request->ligadores_pc2,
                'quadro_electrico' => $request->quadro_electrico,
                'caixa_sup_post_v2' => $request->caixa_sup_post_v2,
                'caixa_sup_post_v4' => $request->caixa_sup_post_v4,
            ]);

            return response()->json('Produto salvo com sucesso', 200);

        } catch (\Throwable $error) {

            return response()->json('Erro ao tentar salvar produto', 505);

        }
    }

    public function mobile_store(Request $request)
    {
        try {


            // 1- Pegar os dados de atribuicao a destacas: site, data atual, distrito, veiculo, provincia, lote

            $contador = DB::table('baixada')->where([['contador', $request->contador], ['removido', 0]])->count();

            if ($contador == 0) {

                $user_att = UserAtribution::where([['user_id', Auth::user()->id], ['removido', 0], ['status', 1]])->first();

                Baixada::create([
                    'data' => date('Y-m-d'),
                    'site' => $user_att->site,
                    'lote' => $user_att->lote,
                    'user_id' => auth()->user()->id,
                    'viatura_id' => $user_att->viatura_id,
                    'provincia_id' => $user_att->provincia_id,

                    'distrito' => $request->distrito_id,
                    'tecnico' => $request->tecnico,
                    'cliente' => $request->cliente,
                    'bairro_id' => $request->bairro,
                    'contador' => $request->contador,
                    'contacto' => $request->contacto,
                    'pinca_2_16' => $request->pinca_2_16,
                    'pinca_4_16' => $request->pinca_4_16,
                    'coordenadas' => $request->coordenadas,
                    'baixada_tri' => 0,
                    'baixada_mono' => 1,
                    'cabo_abc_2_10' => $request->cabo_abc_2_10,
                    'cabo_abc_4_16' => $request->cabo_abc_4_16,
                    'ligadores_pc1' => $request->ligadores_pc1,
                    'ligadores_pc2' => $request->ligadores_pc2,
                    'quadro_electrico' => $request->quadro_electrico,
                    'caixa_sup_post_v2' => $request->caixa_sup_post_v2,
                    'caixa_sup_post_v4' => $request->caixa_sup_post_v4,
                ]);


                $this->toaster('success', 'Baixada registada com sucesso!');
                return redirect()->back();
            }


            $this->toaster('error', 'Opps, numero de contador ja usado!');
            return redirect()->back();


        } catch (\Throwable $error) {

            $this->toaster('error', 'Erro ao tentar salvar baixada!');
            return redirect()->back();

        }
    }


    public function destroy($id)
    {

        try {

            $saidas = Baixada::where('id', $id)->update([
                'removido' => 1,
                'deleted_by' => Auth::user()->name. 'Date: ' . date('d/m/Y').'  -  Time: '.date('H:i:s'),
            ]);
            $this->toaster('success', 'Execu. De baixada removida com sucesso!');

        } catch (\Throwable $error) {

            $this->toaster('error', 'Erro ao tentar remover exec. De baixada!');
            return redirect()->back();
        }

        return redirect()->back();
    }

    public function import_xls(Request $request)
    {

        try {

            if ($request->has('import_file')) {


                $allowed_extension = array('xls', 'csv', 'xlsx');
                $file_array = explode(".", $_FILES["import_file"]["name"]);
                $file_extension = end($file_array);

                $file_name = time() . '.' . $file_extension;
                move_uploaded_file($_FILES['import_file']['tmp_name'], $file_name);
                $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

                $spreadsheet = $reader->load($file_name);

                unlink($file_name);

                $data = $spreadsheet->getActiveSheet()->toArray();

                foreach($data as $row)
                {
                    if ($this->check_contador($row[3]) == 0) {

                        if ($row[1] != Null && $row[3]) {


                            Baixada::create([

                                'data' => $row[15],
                                'site' => $request->site,
                                'viatura_id' => $request->veiculo_id,
                                'provincia_id' => $request->provincia_id,
                                'distrito' => $request->distrito_id,
                                'lote' => $request->lote,

                                'user_id' => auth()->user()->id,

                                'cliente' => $row[1],
                                'bairro_id' => $row[2],
                                'contador' => $row[3],
                                'quadro_electrico' => $row[4],
                                'cabo_abc_2_10' => $row[5],
                                'cabo_abc_4_16' => $row[6],
                                'pinca_2_16' => $row[7],
                                'pinca_4_16' => $row[8],
                                'ligadores_pc1' => $row[9],
                                'ligadores_pc2' => $row[10],
                                'coordenadas' => $row[11],

                                'baixada_mono' => 1,
                                'caixa_sup_post_v2' => ($row[14] == null) ? 0 : $row[14],


                                'baixada_tri' => 0,
                                'kicker_post_66' => 0,
                                'caixa_sup_post_v4' => 0,
                            ]);

                        }
                    }
                }
            }


            $this->toaster('success', 'Cadastrado com sucesso!');
            return redirect()->back();


        } catch (\Throwable $error) {

           return $error;
        }
    }



    public function check_contador($contador)
    {
        return DB::table('baixada')->where('contador', 'like', '%'.$contador.'%')->count();
    }


    public function toaster($type, $message)
    {
        return toastr()->$type($message);
    }



}
