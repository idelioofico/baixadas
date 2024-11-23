<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAtribution;
use App\Models\User;
use DB;

class UserAttribuitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['data'] = 
                UserAtribution::select('user_atribution_baixada.id', 'users.name', 'site.nome as site', 'provincias.nome as provincia', 'veiculo.matricula', 'lote', 'user_atribution_baixada.status')
                ->leftJoin('site', 'site.id', '=', 'user_atribution_baixada.site') 
                ->leftJoin('provincias', 'provincias.id', '=', 'user_atribution_baixada.provincia_id') 
                ->leftJoin('veiculo', 'veiculo.id', '=', 'user_atribution_baixada.viatura_id') 
                ->leftJoin('users', 'users.id', '=', 'user_atribution_baixada.user_id') 
                ->where([['user_atribution_baixada.removido', 0], ['user_atribution_baixada.status', 1]])
                ->orderBy('users.name', 'ASC')
            ->get();

        return view('admin.attr_user_baixada.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $data['provincias'] = DB::table('provincias')
            ->where('removido',0)
        ->get();
        
        $data['users'] = DB::table('users')
            ->where('status', 1)
        ->get();

        $data['veiculos'] = DB::table('veiculo')
            ->where([['removido',0], ['activo', 1]])
        ->get();

        $data['sites'] = DB::table('site')
            ->select('site.id', 'site.nome as site_nome', 'projecto.nome as projecto_nome')
            ->leftJoin('projecto', 'projecto.id', '=', 'site.projecto')
            ->where([['site.removido',0], ['site.activo', 1]])
            ->where('site.nome', 'LIKE', 'baixada' . '%')
        ->get();

        return view('admin.attr_user_baixada.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        try {
            $data = UserAtribution::create([
                'provincia_id' => $request->provincia_id,
                'viatura_id' => $request->viatura_id,
                'lote' => $request->lote,
                'site' => $request->site_id,
                'user_id' => $request->user_id,
                'removido' => 0,
                'status' => 1,
            ]);

            User::find($data['user_id'])->update(['mobile_access' => 1]);
            
            
            $this->toaster('success', 'Usuario alocado com sucesso!');
            return redirect()->back();

        } catch (\Throwable $error) {

            $this->toaster('error', 'Erro ao tentar alocar Usuario!');
            return redirect()->back()->withErrors($validated);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $data['data'] = UserAtribution::find($id);

        $data['provincias'] = DB::table('provincias')
            ->where('removido',0)
        ->get();
        
        $data['users'] = DB::table('users')
            ->where('status', 1)
        ->get();

        $data['veiculos'] = DB::table('veiculo')
            ->where([['removido',0], ['activo', 1]])
        ->get();

        $data['sites'] = DB::table('site')
            ->select('site.id', 'site.nome as site_nome', 'projecto.nome as projecto_nome')
            ->leftJoin('projecto', 'projecto.id', '=', 'site.projecto')
            ->where([['site.removido',0], ['site.activo', 1]])
            ->where('site.nome', 'LIKE', 'baixada' . '%')
        ->get();

        return view('admin.attr_user_baixada.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            
            $data = UserAtribution::find($id)->update([
                'provincia_id' => $request->provincia_id,
                'viatura_id' => $request->viatura_id,
                'lote' => $request->lote,
                'site' => $request->site_id,
                'user_id' => $request->user_id,
                'removido' => 0,
                'status' => 1,
            ]);

            User::find($request->user_id)->update(['mobile_access' => 1]);
            
            
            $this->toaster('success', 'Alocação de Viatura atualizada com sucesso!');
            return redirect()->route('user_attr.index');

        } catch (\Throwable $error) {

            return $error;
            $this->toaster('error', 'Erro ao tentar atualizar Alocação!');
            return redirect()->back();
        }
    }
  

    public function toaster($type, $message)
    {
        return toastr()->$type($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
       

        try {

            $user_data = UserAtribution::find($id);
            
            if ($user_data) {
                # code...
                $user_data->update(['removido' => 1]);
                User::find($user_data->user_id)->update(['mobile_access' => 0]);
            }
            
            
            $this->toaster('success', 'Removido com sucesso!');
            return redirect()->back();

        } catch (\Throwable $error) {
 
            $this->toaster('error', 'Erro ao tentar remover dados!');
            return redirect()->back();
        }
    }

     

}
