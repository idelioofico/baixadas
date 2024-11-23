<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agrp_viaturas as AgrpViatura;
use DB;

class AgrpViaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['alocacoes'] = DB::table('agrp_viaturas')
            ->select('agrp_viaturas.id', 'agrp_viaturas.created_at', 'veiculo.matricula', 'provincias.nome as provincia', 'users.name as user_name')
            ->leftJoin('veiculo', 'veiculo.id', '=', 'agrp_viaturas.viatura_id')
            ->leftJoin('provincias', 'provincias.id', '=', 'agrp_viaturas.provincia_id')
            ->leftJoin('users', 'users.id', '=', 'agrp_viaturas.user_id')
            ->where('agrp_viaturas.removido',0)
        ->get();

        return view('admin.agrp_viatura.index', $data);
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
        
        $data['veiculos'] = DB::table('veiculo')
            ->where([['removido',0], ['activo', 1]])
        ->get();

        return view('admin.agrp_viatura.create', $data);
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
            
            $data = $request->validate([
                'provincia_id' => 'required',
                'veiculo_id' => 'required',
            ]);
    
            $fornecedor = AgrpViatura::create([
                'provincia_id' => $data['provincia_id'],
                'viatura_id' => $data['veiculo_id'],
                'user_id' => auth()->user()->id,
            ]);
    
            
            $this->toaster('success', 'Viatura alocada com sucesso!');
            return redirect()->back();

        } catch (\Throwable $error) {

            $this->toaster('error', 'Erro ao tentar alocar viatura!');
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
        $data['data'] = AgrpViatura::find($id);
        
        $data['provincias'] = DB::table('provincias')
            ->where('removido',0)
        ->get();
        
        $data['veiculos'] = DB::table('veiculo')
            ->where([['removido',0], ['activo', 1]])
        ->get();

        return view('admin.agrp_viatura.edit', $data);
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
            
            $data = $request->validate([
                'provincia_id' => 'required',
                'veiculo_id' => 'required',
            ]);
    
            $fornecedor = AgrpViatura::find($id)->update([
                'provincia_id' => $data['provincia_id'],
                'viatura_id' => $data['veiculo_id'],
                'user_id' => auth()->user()->id,
            ]);
    
            
            $this->toaster('success', 'Viatura atualizada com sucesso!');
            return redirect()->route('agrp_viatura.index');

        } catch (\Throwable $error) {

            $this->toaster('error', 'Erro ao tentar atualizar viatura!');
            return redirect()->back()->withErrors($validated);
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
        AgrpViatura::find($id)->update(['removido' => 1]);
        
        $this->toaster('success', 'Removido com sucesso!');
        return redirect()->back();
    }

     

}
