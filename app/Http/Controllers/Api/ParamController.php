<?php

namespace App\Http\Controllers\Api;

use App\Models\Bug;
use App\Models\Province;
use App\Models\UserAtribution;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ParamController extends Controller
{
    public function districts(Request $request)
    {

        try {

            $baixada_info= UserAtribution::select('site.nome as site', 'provincias.nome as provincia', 'distritos.nome as distrito', 'veiculo.matricula', 'user_atribution_baixada.provincia_id')
                ->leftJoin('site', 'site.id', '=', 'user_atribution_baixada.site')
                ->leftJoin('provincias', 'provincias.id', '=', 'user_atribution_baixada.provincia_id')
                ->leftJoin('distritos', 'distritos.id', '=', 'user_atribution_baixada.distrito_id')
                ->leftJoin('veiculo', 'veiculo.id', '=', 'user_atribution_baixada.viatura_id')
                ->leftJoin('users', 'users.id', '=', 'user_atribution_baixada.user_id')
                ->where([['user_id', Auth::user()->id], ['user_atribution_baixada.removido', 0], ['user_atribution_baixada.status', 1]])
                ->first();

            $query = DB::table('distritos');
            if (!empty($baixada_info))
                $query = $query->where('provincia_id',$baixada_info->provincia_id);

            $data= $query->get();

            $response = array(
                'success' => true,
                'status' => $status = 200,
                'data' => $data?:[],
                'message' => "Dados listados"
            );
        } catch (\Throwable $th) {

            Bug::create([
                'name' => 'PARAMS',
                'description' => 'DISCTRICT',
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
        $log->save_log($status, 'PARAMS', 'DISCTRICT', json_encode($request->all()), json_encode($response), $request->ip());
        return response()->json($response, 200);
    }


   

}
