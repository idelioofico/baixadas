<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;
use DB;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['usuarios'] = DB::table('users')
            ->select('users.*', 'tipo_usuario.nome as tipo_usuario_nome', 'departamento.nome as dept_nome')
            ->leftJoin('tipo_usuario', 'users.tipo_de_usuario', 'tipo_usuario.tipo')
            ->leftJoin('departamento', 'departamento.id', 'users.departamento')
            ->orderBy('users.name', 'asc')
        ->get();

        return view('admin.usuario.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $data['role'] = DB::table('role')->get();
        $data['tipo_usuario'] = DB::table('tipo_usuario')->get();
        $data['departamentos'] = DB::table('departamento')->orderBy('nome', 'asc')->get();
        $data['permission']=DB::table('permission')->where('removido',0)->get();
        
        return view('admin.usuario.create', $data);
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

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'password' => ['required', Rules\Password::defaults()],
                'tipo_de_usuario' => 'required',
                'telefone' => '',
                'role_id' => '',
                'username' => 'required|unique:users',
                'permission_id'=>'',
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'tipo_de_usuario' => $request->tipo_de_usuario,
                'telefone' => $request->telefone,
                'departamento' => $request->departamento,
                'username' => $request->username,
                'role_id' => $request->role_id,
                'permission_id'=>$request->permission_id,
            ]);
            
            $this->toaster('success', 'User registado com sucesso!');
            return redirect()->route('usuario.index');

        } catch (\Throwable $error) {
            $this->toaster('error', 'Erro ao tentar registar user, contacte o administrador!');
            return redirect()->back();
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['data'] = DB::table('users')->find($id);

        $data['sites'] = DB::table('site')
            ->select('site.*', 'cidade.nome as cidade_nome', 'usuario_sites.id as user_site_id')
            ->leftJoin('cidade', 'cidade.id', 'site.cidade')
            ->leftJoin('usuario_sites', 'usuario_sites.site_id', 'site.id')
            ->where('usuario_sites.user_id', $id)
        ->get();

        $data['projectos'] = DB::table('projecto')
            ->select('projecto.*', 'empresa.nome as empresa_nome', 'provincias.nome as provincia_nome', 'cidade.nome as cidade_nome', 'usuario_projectos.id as usuario_project_id')
            ->leftJoin('usuario_projectos', 'usuario_projectos.projecto_id', 'projecto.id')
            ->leftJoin('empresa', 'empresa.id', 'projecto.empresa')
            ->leftJoin('cidade', 'cidade.id', 'projecto.cidade')
            ->leftJoin('provincias', 'provincias.id', 'projecto.provincia')
            ->where([['usuario_projectos.user_id', $id], ['projecto.removido', 0]])
        ->get();


        return view('admin.usuario.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['usuario'] = User::find($id);
        $data['role'] = DB::table('role')->get();
        $data['tipo_usuario'] = DB::table('tipo_usuario')->get();
        $data['departamentos'] = DB::table('departamento')->orderBy('nome', 'asc')->get(); 
        $data['permission']=DB::table('permission')->where('removido',0)->get();
        
        $data['user_controller']=$this;

        return view('admin.usuario.edit', $data);
    }


    public function menu_role_tipo_permission($id){
        return DB::table('menu_role_tipo_permission')->select('tipo_permission.*')
        ->leftJoin('tipo_permission','tipo_permission.id','menu_role_tipo_permission.tipo_permission_id')
        ->where('menu_role_tipo_permission.menu_permission_id',$id)->get();
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
 
            if ($request->password) {
                $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255',
                    'password' => ['required', Rules\Password::defaults()],
                    'tipo_de_usuario' => 'required|max:255',
                    'telefone' => 'required|max:255',
                    'departamento' => 'required',
                    'username' => 'required',
                    'permission_id'=>'',
                ]);
            }
            User::find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'tipo_de_usuario' => $request->tipo_de_usuario,
                'telefone' => $request->telefone,
                'departamento' => $request->departamento,
                'username' => $request->username,
                'permission_id'=>$request->permission_id,
            ]);
            
            $this->toaster('success', 'User atualizado com sucesso!');
            return redirect()->route('usuario.index');

        } catch (\Throwable $error) {
            $this->toaster('warning', 'Erro ao tentar atualizar user, preencha corretamente os dados!');
            return redirect()->back();
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = User::find($id);

            $data->update([
                'status' => ($data->status == 0) ? 1 : 0,
            ]);

            $this->toaster('success', 'User atualizado com sucesso!');
            return redirect()->route('usuario.index');

        } catch (\Throwable $error) {

            $this->toaster('error', 'Erro ao tentar remover user, contacte o administrador!');
            return redirect()->back();
        }
    }

    public function user_site_destroy($id)
    {
        try {
            $data = DB::table('usuario_sites')->where('id', $id)->delete();
  
            $this->toaster('success', 'Site do usuario removido com sucesso!');
            return redirect()->back();

        } catch (\Throwable $error) {
            $this->toaster('success', 'Erro ao tentar remover user site!');
            return redirect()->back();
        }
    }

    
    public function user_project_destroy($id)
    {
        try {
            $data = DB::table('usuario_projectos')->where('id', $id)->delete();
 
            return redirect()->back()->with('success', 'Projecto do usuario removido com sucesso!!');

        } catch (\Throwable $error) {
            return redirect()->back()->with('error', 'Erro ao tentar remover Projecto!');
        }
    }

    
    public function toaster($type, $message)
    {
        return toastr()->$type($message);
    }
}
