<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Baixada;
use App\Models\BaixadaProduto;
use App\Models\Bug;
use App\Models\Produto;
use App\Models\SaidaBaixadas;
use App\Models\UserAtribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;



class BaixadaAPIController extends Controller
{



    public function baixada_info(Request $request)
    {

        try {

            $baixada_info = UserAtribution::select('site.nome as site', 'provincias.nome as provincia', 'distritos.nome as distrito', 'veiculo.matricula', 'user_atribution_baixada.provincia_id')
                ->leftJoin('site', 'site.id', '=', 'user_atribution_baixada.site')
                ->leftJoin('provincias', 'provincias.id', '=', 'user_atribution_baixada.provincia_id')
                ->leftJoin('distritos', 'distritos.id', '=', 'user_atribution_baixada.distrito_id')
                ->leftJoin('veiculo', 'veiculo.id', '=', 'user_atribution_baixada.viatura_id')
                ->leftJoin('users', 'users.id', '=', 'user_atribution_baixada.user_id')
                ->where([['user_id', Auth::user()->id], ['user_atribution_baixada.removido', 0], ['user_atribution_baixada.status', 1]])
                ->first();

            $response = array(
                'success' => true,
                'status' => $status = 200,
                'data' =>  $baixada_info ?: [],
                'message' => "Dados listados"
            );
        } catch (\Throwable $th) {

            Bug::create([
                'name' => 'PARAMS',
                'description' => 'BAIXADA_INFO',
                'cause' => $th->getMessage(),
                'behavior' => json_encode($th),
                'created_on' => now(env('TIMEZONE')),
                'created_on' => now(env('TIMEZONE')),
                'modified_on' => now(env('TIMEZONE')),
                'start_date' => now(env('TIMEZONE')),
                'end_date' => now(env('TIMEZONE'))->addYears(35)
            ]);

            $response = [
                'success' => false,
                'message' => 'Ocorreu um erro ao tentar listar distritos. Porfavor, contacte a equipa de suporte!',
                'data' => [],
                'status' => $status = 500
            ];
        }

        $log = new LogController();
        $log->save_log($status, 'PARAMS', 'BAIXADA_INFO', json_encode($request->all()), json_encode($response), $request->ip());
        return response()->json($response, 200);
    }


    public function store(Request $request)
    {

        //Default answer
        $response = [
            'success' => false,
            'message' => 'Ocorreu um erro ao tentar registar Baixada. Porfavor, contacte a equipa de suporte!',
            'data' => [],
            'status' => $status = 500
        ];

        $status = 500;
        $log = new LogController();
        try {

            $validator = Validator::make($request->all(), [
                'data' => 'nullable',
                'distrito' => 'nullable',
                'tecnico' => 'nullable',
                'cliente' => 'nullable',
                'bairro' => 'nullable',
                'contador' => 'nullable',
                'contacto' => 'nullable',
                'pinca_2_16' => 'nullable',
                'pinca_4_16' => 'nullable',
                'coordenadas' => 'nullable',
                'cabo_abc_2_10' => 'nullable',
                'cabo_abc_4_16' => 'nullable',
                'ligadores_pc1' => 'nullable',
                'ligadores_pc2' => 'nullable',
                'kicker_post_66' => 'nullable',
                'quadro_electrico' => 'nullable',
                'caixa_sup_post_v2' => 'nullable',
                'caixa_sup_post_v4' => 'nullable',
            ]);

            if ($validator->fails()) {

                $response = [
                    'success' => false,
                    'message' => 'Validação de campos falhou',
                    'data' => $validator->errors(),
                    'status' => $status = 412
                ];

            } else {

                $contador = DB::table('baixada')->where([['contador', $request->contador], ['removido', 0]])->count();

                if ($contador == 0) {

                    $user_att = UserAtribution::where([['user_id', Auth::user()->id], ['removido', 0], ['status', 1]])->first();

                    Baixada::create([
                        'data' => (!empty($request->data)) ? date('Y-m-d', strtotime($request->data)) : date('Y-m-d'),
                        'site' => $user_att->site,
                        'lote' => $user_att->lote,
                        'user_id' => auth()->user()->id,
                        'viatura_id' => $user_att->viatura_id,
                        'provincia_id' => $user_att->provincia_id,
                        'distrito' => $request->distrito,

                        'tecnico' => Helper::removerAcentos($request->tecnico),
                        'cliente' => Helper::removerAcentos($request->cliente),
                        'bairro_id' => Helper::removerAcentos($request->bairro),
                        'contacto' => Helper::ValidateMSISDN($request->contacto),

                        'contador' => $request->contador,

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

                    $response = [
                        'success' => true,
                        'message' => 'Produto salvo com sucesso.',
                        'data' => [],
                        'status' => $status = 201
                    ];
                }
            }
        } catch (\Throwable $th) {

            Bug::create([
                'name' => 'BAIXADA',
                'description' => 'STORE',
                'cause' => $th->getMessage(),
                'behavior' => json_encode($th),
                'created_on' => now(env('TIMEZONE')),
                'created_on' => now(env('TIMEZONE')),
                'modified_on' => now(env('TIMEZONE')),
                'start_date' => now(env('TIMEZONE')),
                'end_date' => now(env('TIMEZONE'))->addYears(35)
            ]);
        }

        $log->save_log(412, 'BAIXADA', 'STORE', json_encode($request->all()), json_encode($response), $request->ip(), now(), now()->addYears(35));
        return response()->json($response, 200);
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
                'deleted_by' => Auth::user()->name . 'Date: ' . date('d/m/Y') . '  -  Time: ' . date('H:i:s'),
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

                foreach ($data as $row) {
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
        return DB::table('baixada')->where('contador', 'like', '%' . $contador . '%')->count();
    }


    public function toaster($type, $message)
    {
        return toastr()->$type($message);
    }
}
