<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Models\Bug;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Str;

class IAMController extends Controller
{
    public function login(Request $request)
    {
        $response = [];
        $status = 500;
        $log = new LogController();
        try {

            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'password' => 'required'
            ], [
                'required' => 'campo obrigatório'
            ]);

            if ($validator->fails()) {

                $response = [
                    'success' => false,
                    'message' => 'Validação de campos falhou',
                    'data' => $validator->errors(),
                    'status' => $status = 412
                ];

            } else {

                $user = User::where('username', 'LIKE', $request->username)
                    ->where('status',1)
                    ->where('status',1)
                    ->first();

                if (!empty($user) && Hash::check($request->password, $user->password)) {

                    Auth::loginUsingId($user->row_id);

                    $token = hash('sha256', now() . Str::random(60));

                    $token = $user->createToken($token)->plainTextToken;

                    $response = [
                        'success' => true,
                        'message' => "Login feito com sucesso",
                        'data' => [
                            'user' => $user,
                            'auth_token' => $token,
                        ],
                        'status' => $status = 200
                    ];

                } else {

                    $response = [
                        'success' => false,
                        'message' => "Utilizador ou senha inválida",
                        'data' => [],
                        'status' => $status = 404
                    ];
                }
            }
        } catch (\Throwable $th) {

            Bug::create([
                'name' => 'IAM',
                'description' => 'LOGIN',
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
                'message' => 'Ocorreu um erro ao tentar efectuar login. Porfavor, contacte a equipa de suporte!',
                'data' => [],
                'status' => $status = 500
            ];
        }

        $log->save_log(412, 'IAM', 'LOGIN', json_encode($request->all()), json_encode($response), $request->ip(), now(), now()->addYears(35));
        return response()->json($response, 200);
    }
}
