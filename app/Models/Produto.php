<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;
use Auth;

class Produto extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    function get_user_projects() {
        // Query que traz todos projectos relacionados a esse usuario;
        return  $user_project = UsuarioProjecto::where('user_id', Auth::user()->id)->pluck('projecto_id');
    }

    function get_user_sites() {
        // Query que traz todos sites relacionados a esse usuario;
        $projectos = $this->get_user_projects();
        return $sites = Site::whereIn('projecto', $projectos)->get();
    }

    public function guiaEntradaProduto()
    {
        $projectos = $this->get_user_projects();
        return  $produto = $this->hasMany(GuiaEntrada_Produto::class, 'produto_id')->where([['status', 1], ['estado_produto_id', 0]])->WhereHas('guiaDeEntrada', function ($q) use ($projectos) {
            $q->where('status', 1)
            ->where([['pendente', 2], ['origem', 1]])
            ->where('projecto', $projectos);
        });

        return $produto->sum('quantidade');
    }

    public function guiaEntradaProdutoProjecto($projecto, $site)
    { 

        // $site = Site::find($site);
        $condition = ($projecto == Null || empty($projecto)) ? 
            [['pendente', 2], ['status', 1], ['origem', 1], ['site', $site]] : 
            [['pendente', 2], ['status', 1], ['origem', 1], ['projecto', $projecto]];
            

        $produto = $this->hasMany(GuiaEntrada_Produto::class, 'produto_id')->where('status', 1)
            ->WhereHas('guiaDeEntrada', function ($q) use ($condition) {
            $q->where($condition);
        });

        return $produto->sum('quantidade');
    }

    public function guiaSaidaProdutoProjecto($projecto, $site)
    {

        // $site = Site::find($site);
        $condition = ($projecto == Null || empty($projecto)) ? 
            [['pendente', 2], ['status', 1], ['origem', 1], ['site', $site]] : 
            [['pendente', 2], ['status', 1], ['origem', 1], ['projecto', $projecto]];
            

        $produto = $this->hasMany(GuiaSaidaProduto::class, 'produto_id')->where('status', 1)
            ->WhereHas('guiaSaida', function ($q) use ($condition) {
                $q->where($condition);
            });

        return $produto->sum('quantidade');
    }

    public function guiaSaidaProduto()
    {
        return $this->hasMany(GuiaSaidaProduto::class, 'produto_id')->where('status', 1)
            ->WhereHas('guiaSaida', function ($q) {
                $q->where('status', 1)->where([['pendente', 2], ['origem', 1]]);
            });

    }

    // Guias by (Empresa:id)
    public function guiaEntradaProdutoEmpresa($empresa, $projecto)
    {
        $condition = ($empresa != null && $projecto != null) ? 
        ['empresa_id'=> $empresa, 'projecto'=> $projecto, 'pendente' => 2] : 
        ['pendente' => 2]; 
        
        return  $produto = $this->hasMany(GuiaEntrada_Produto::class, 'produto_id')->where([['status', 1], ['estado_produto_id', 0]])->WhereHas('guiaDeEntrada', function ($q) use ($condition) {
            $q->where('status', 1)->where($condition);
        });

        return $produto->sum('quantidade');
    }
    
    public function guiaSaidaProdutoEmpresa($empresa, $projecto)
    {
        $condition = ($empresa != null && $projecto != null) ? 
        ['empresa_id'=> $empresa, 'projecto'=> $projecto, 'pendente' => 2] : 
        ['pendente' => 2]; 

        return $this->hasMany(GuiaSaidaProduto::class, 'produto_id')->where('status', 1)
            ->WhereHas('guiaSaida', function ($q) use ($condition) {
                $q->where('status', 1)->where($condition);
        });

    }


    public function dataInicioEntrada()
    {
        return  $produto = $this->hasMany(GuiaEntrada_Produto::class, 'produto_id')->where([['status', 1], ['estado_produto_id', 0]])->WhereHas('guiaDeEntrada', function ($q) {
            $q->where('status', 1)->where([['pendente', 2], ['origem', 1]]);
        });
    }

    public function dataInicioSaida()
    {
        return $this->hasMany(GuiaSaidaProduto::class, 'produto_id')->where('status', 1)
            ->WhereHas('guiaSaida', function ($q) {
                $q->where('status', 1)->where([['pendente', 2], ['origem', 1]]);
            });
    }


    
    public function entradaTotal()
    {
        return  $produto = $this->hasMany(GuiaEntrada_Produto::class, 'produto_id')->where('status', 1)->WhereHas('guiaDeEntrada', function ($q) {
            $q->where('status', 1)->where([['pendente', 2], ['origem', 1]]);
        });
 
    }

    public function saidaTotal()
    {
        return $this->hasMany(GuiaSaidaProduto::class, 'produto_id')->where('status', 1)->whereHas('guiaSaida', function ($q) {
            $q->where('status', 1)->where([['pendente', 2], ['origem', 1]]);
        });
    }

    public function saidaTotal_counter($projecto)
    {
        
        $condition = ($projecto != 0) ? [['projecto', $projecto], ['origem' , 1], ['pendente' , 2]] : [['origem' , 1], ['pendente' , 2]]; 

        if ($projecto != 0) {

            return $this->hasMany(GuiaSaidaProduto::class, 'produto_id')->where('status', 1)
                ->whereHas('guiaSaida', function ($q) use($condition) {
                    $q->where('status', 1)->where($condition);
                })->sum('quantidade');
            # code...
        } else {
            
            return $this->hasMany(GuiaSaidaProduto::class, 'produto_id')->where('status', 1)
            ->whereHas('guiaSaida', function ($q) {
                $q->where([['status', 1], ['origem' , 1], ['pendente' , 2]])->whereIn('projecto', $this->get_user_projects());
            })->sum('quantidade');
        }
        
    }

    public function entradaTotal_counter($projecto)
    {
        
        $condition = ($projecto != 0) ? ['projecto'=> $projecto, 'origem' => 1, 'pendente' => 2] : ['origem' => 1, 'pendente' => 2]; 
 

        if ($projecto != 0) {

            return $this->hasMany(GuiaEntrada_Produto::class, 'produto_id')->where('status', 1)
                ->whereHas('guiaDeEntrada', function ($q) use($condition) {
                $q->where('status', 1)->where($condition);
            })->sum('quantidade');
            # code...
        } else {
             
            return $this->hasMany(GuiaEntrada_Produto::class, 'produto_id')->where('status', 1)
            ->whereHas('guiaDeEntrada', function ($q) use($condition) {
                $q->where([['status', 1], ['origem', 1], ['pendente', 2]])->whereIn('projecto', $this->get_user_projects());
            })->sum('quantidade');
        }

    }

    public function dataInicioEntrada_counter($projecto)
    {
        $condition = ($projecto != 0) ? ['projecto'=> $projecto, 'origem' => 1, 'pendente' => 2] : ['origem' => 1, 'pendente' => 2]; 
 

        if ($projecto != 0) {

            return  $produto = $this->hasMany(GuiaEntrada_Produto::class, 'produto_id')
            ->where([['status', 1], ['estado_produto_id', 0]])->WhereHas('guiaDeEntrada', function ($q) use ($condition) {
                $q->where('status', 1)->where($condition);
            })->sum('quantidade');
            # code...
        } else {
              
            return  $produto = $this->hasMany(GuiaEntrada_Produto::class, 'produto_id')
            ->where([['status', 1], ['estado_produto_id', 0]])->WhereHas('guiaDeEntrada', function ($q) use ($condition) {
                $q->where([['status', 1], ['origem', 1], ['pendente', 2]])->whereIn('projecto', $this->get_user_projects());
            })->sum('quantidade');
        }

    }

    public function dataInicioSaida_counter($projecto)
    { 
        $condition = ($projecto != 0) ? ['projecto'=> $projecto, 'origem' => 1, 'pendente' => 2] : ['origem' => 1, 'pendente' => 2]; 
 
        if ($projecto != 0) {

            return $this->hasMany(GuiaSaidaProduto::class, 'produto_id')->where('status', 1)
            ->WhereHas('guiaSaida', function ($q) use ($condition) {
                $q->where('status', 1)->where($condition);
            })->sum('quantidade');
            # code...
        } else {

            return $this->hasMany(GuiaSaidaProduto::class, 'produto_id')->where('status', 1)
            ->WhereHas('guiaSaida', function ($q) use ($condition) {
                $q->where([['status', 1], ['origem', 1], ['pendente', 2]])->whereIn('projecto', $this->get_user_projects());
            })->sum('quantidade');
        }
    }

    public function dataInicioEntrada_counter_ajuste($empresa)
    {
        $condition = ($empresa != 0) ? ['empresa_id'=> $empresa, 'origem' => 1, 'pendente' => 2, 'numero_do_folheto' => 'AJUSTE'] : ['origem' => 1, 'pendente' => 2, 'numero_do_folheto' => 'AJUSTE']; 
        
        return  $produto = $this->hasMany(GuiaEntrada_Produto::class, 'produto_id')
        ->where([['status', 1], ['estado_produto_id', 0]])->WhereHas('guiaDeEntrada', function ($q) use ($condition) {
            $q->where('status', 1)->where($condition);
        })->sum('quantidade');
    }

    public function dataInicioSaida_counter_ajuste($empresa)
    {
        $condition = ($empresa != 0) ? ['empresa_id'=> $empresa, 'origem' => 1, 'pendente' => 2, 'numero_do_folheto' => 'AJUSTE'] : ['origem' => 1, 'pendente' => 2, 'numero_do_folheto' => 'AJUSTE']; 
        return $this->hasMany(GuiaSaidaProduto::class, 'produto_id')->where('status', 1)
            ->WhereHas('guiaSaida', function ($q) use ($condition) {
                $q->where('status', 1)->where($condition);
            })->sum('quantidade');
    }


    // Start Ajustes
    public function entradaTotal_ajuste($empresa)
    {
        $condition = ($empresa != 0) ? ['empresa_id'=> $empresa, 'origem' => 1, 'pendente' => 2] : ['origem' => 1, 'pendente' => 2];
        return  $produto = $this->hasMany(GuiaEntrada_Produto::class, 'produto_id')
            ->where('status', 1)->WhereHas('guiaDeEntrada', function ($q) use($condition) 
        { 
            $q->where([['status', 1], ['numero_do_folheto' , 'AJUSTE'], ['role_id', Auth::user()->role_id]])->where($condition);
        })->sum('quantidade');
    }

    public function entradaTotal_ajusteBtwn($site,$data_inicio, $data_fim)
    {
        $condition = ($site != 0) ? 
        ['origem' => 1, 'pendente' => 2, 'site'=> $site, 'status'=> 1, 'numero_do_folheto' => 'AJUSTE', 'role_id' => Auth::user()->role_id] : 
        ['origem' => 1, 'pendente' => 2, 'status'=> 1, 'numero_do_folheto' => 'AJUSTE', 'role_id' => Auth::user()->role_id];

        return  $produto = $this->hasMany(GuiaEntrada_Produto::class, 'produto_id')
            ->where('status', 1)->WhereHas('guiaDeEntrada', function ($q) use($condition,$data_inicio, $data_fim) 
        { 
            $q->where($condition)
            ->whereBetween('data', [$data_inicio, $data_fim]);
        })->sum('quantidade');
    }

    
    public function saidaTotal_counter_ajusteBtwn($site, $data_inicio, $data_fim)
    {

        $condition = ($site != 0) ? 
        ['origem' => 1, 'pendente' => 2, 'site'=> $site, 'status'=> 1, 'numero_do_folheto' => 'AJUSTE', 'role_id' => Auth::user()->role_id] : 
        ['origem' => 1, 'pendente' => 2, 'status'=> 1, 'numero_do_folheto' => 'AJUSTE', 'role_id' => Auth::user()->role_id];

        return $this->hasMany(GuiaSaidaProduto::class, 'produto_id')->where('status', 1)
        ->whereHas('guiaSaida', function ($q) use($condition, $data_inicio, $data_fim) {
            $q->where($condition)
            ->whereBetween('data', [$data_inicio, $data_fim]);
        })->sum('quantidade');
    }

    public function saidaTotal_counter_ajuste($site)
    {

        $condition = ($site != 0) ? ['site'=> $site, 'origem' => 1, 'pendente' => 2] : ['origem' => 1, 'pendente' => 2];

        return $this->hasMany(GuiaSaidaProduto::class, 'produto_id')->where('status', 1)
        ->whereHas('guiaSaida', function ($q) use($condition) {
            $q->where([['status', 1], ['numero_do_folheto' , 'AJUSTE'], ['role_id', Auth::user()->role_id]])->where($condition);
        })->sum('quantidade');
    }
    // End Ajustes
}
