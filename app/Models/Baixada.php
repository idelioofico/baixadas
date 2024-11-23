<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Baixada extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected $table = 'baixada';
    public $timestamps = false;
 
    public function getAll($from, $to, $prov_id, $viat_id, $site_id, $contador)
    {

        
        $general = ['baixada.removido', 0]; 
		$viatura_cond = ($viat_id != Null && $viat_id != 0) ? ['baixada.viatura_id', $viat_id] : ['baixada.viatura_id', '!=' , Null];
		$province_cond = ($prov_id != Null && $prov_id != '0') ? ['baixada.provincia_id', $prov_id] : ['baixada.provincia_id', '!=' , Null];
		$site_cond = ($site_id != Null && $site_id != '0') ? ['baixada.site', $site_id] : ['baixada.site', '!=' , Null];
		$contador_cond = ($contador != Null && $contador != '0') ? ['baixada.contador', 'LIKE', '%'.$contador.'%'] : ['baixada.contador', '!=' , Null];
        
        $saidas = DB::table('baixada')
            ->select('baixada.*','site.nome as site_nome', 'provincias.nome as nome_prov', 'distritos.nome as distrito_nome', 'veiculo.matricula', 'users.name as user_name')
            ->leftJoin('site', 'site.id', '=', 'baixada.site') 
            ->leftJoin('provincias', 'provincias.id', '=', 'baixada.provincia_id') 
            ->leftJoin('distritos', 'distritos.id', '=', 'baixada.distrito') 
            ->leftJoin('veiculo', 'veiculo.id', '=', 'baixada.viatura_id') 
            ->leftJoin('users', 'users.id', '=', 'baixada.user_id') 
            ->where([$general, $province_cond, $viatura_cond, $site_cond, $contador_cond])
            ->whereBetween('data', [$from, $to])
            ->orderBy('baixada.id', 'ASC')
            ->paginate(300) ;
 
        return $saidas;
    }

    public function getAllDailyExport($from, $to, $prov_id, $viat_id, $site_id)
    {

        
        $general = ['baixada.removido', 0]; 
		$viatura_cond = ($viat_id != Null && $viat_id != 0) ? ['baixada.viatura_id', $viat_id] : ['baixada.viatura_id', '!=' , Null];
		$province_cond = ($prov_id != Null && $prov_id != '0') ? ['baixada.provincia_id', $prov_id] : ['baixada.provincia_id', '!=' , Null];
		$site_cond = ($site_id != Null && $site_id != '0') ? ['baixada.site', $site_id] : ['baixada.site', '!=' , Null];
        
        $saidas = DB::table('baixada')
            ->select('baixada.*','site.nome as site_nome', 'provincias.nome as nome_prov', 'distritos.nome as distrito_nome', 'veiculo.matricula', 'users.name as user_name')
            ->leftJoin('site', 'site.id', '=', 'baixada.site') 
            ->leftJoin('provincias', 'provincias.id', '=', 'baixada.provincia_id') 
            ->leftJoin('distritos', 'distritos.id', '=', 'baixada.distrito') 
            ->leftJoin('veiculo', 'veiculo.id', '=', 'baixada.viatura_id') 
            ->leftJoin('users', 'users.id', '=', 'baixada.user_id') 
            ->where([$general, $province_cond, $viatura_cond, $site_cond])
            ->whereBetween('data', [$from, $to])
            ->orderBy('baixada.data', 'DESC')
        ->get();
 
        return $saidas;
    }


    public function getAllReistered($data, $site, $provincia_id, $distrito_id, $veiculo_id, $lote)
    {

        
        $general = ['baixada.removido', 0]; 
		$distr_cond = ($distrito_id != Null && $distrito_id != 0) ? ['baixada.distrito', $distrito_id] : ['baixada.distrito', '!=' , Null];
		$site_cond = ($site != Null && $site != 0) ? ['baixada.site', $site] : ['baixada.site', '!=' , Null];
		$veic_cond = ($veiculo_id != Null && $veiculo_id != 0) ? ['baixada.viatura_id', $veiculo_id] : ['baixada.viatura_id', '!=' , Null];
		$province_cond = ($provincia_id != Null && $provincia_id != '0') ? ['baixada.provincia_id', $provincia_id] : ['baixada.provincia_id', '!=' , Null];
        
        $saidas = DB::table('baixada')
            ->select('baixada.*','site.nome as site_nome', 'provincias.nome as nome_prov', 'distritos.nome as distrito_nome', 'veiculo.matricula', 'users.name as user_name')
            ->leftJoin('site', 'site.id', '=', 'baixada.site') 
            ->leftJoin('provincias', 'provincias.id', '=', 'baixada.provincia_id') 
            ->leftJoin('distritos', 'distritos.id', '=', 'baixada.distrito') 
            ->leftJoin('veiculo', 'veiculo.id', '=', 'baixada.viatura_id') 
            ->leftJoin('users', 'users.id', '=', 'baixada.user_id') 
            ->where([$general, $distr_cond, $veic_cond, $site_cond])
            ->where([['data', $data], ['lote', $lote]])
            ->orderBy('baixada.data', 'DESC')
        ->get();
 
        return $saidas;
    }


    public function getAllBairroSheet($from, $to, $prov_id, $site_id)
    {
        $general = ['baixada.removido', 0]; 
		$site_cond = ($site_id != Null && $site_id != 0) ? ['baixada.site', $site_id] : ['baixada.site', '!=' , Null];
		$province_cond = ($prov_id != Null && $prov_id != '0') ? ['baixada.provincia_id', $prov_id] : ['baixada.provincia_id', '!=' , Null];
        

        $saidas = DB::table('baixada')
            ->select(DB::raw('SUM(baixada_mono) as baixada_mono'), DB::raw('SUM(baixada_tri) as baixada_tri'), DB::raw('SUM(caixa_sup_post_v2) as caixa_sup_post_v2'), DB::raw('SUM(caixa_sup_post_v4) as caixa_sup_post_v4'),DB::raw('SUM(quadro_electrico) as quadro_electrico'),DB::raw('SUM(kicker_post_66) as kicker_post_66'), DB::raw('SUM(cabo_abc_2_10) as cabo_abc_2_10'), DB::raw('SUM(cabo_abc_4_16) as cabo_abc_4_16') ,DB::raw('SUM(ligadores_pc1) as ligadores_pc1'), DB::raw('SUM(ligadores_pc2) as ligadores_pc2'), DB::raw('SUM(pinca_2_16) as pinca_2_16'), DB::raw('SUM(pinca_4_16) as pinca_4_16'), 'bairro_id')
            ->where([$general, $province_cond, $site_cond])
            ->whereBetween('data', [$from, $to])
            ->orderBy('bairro_id', 'DESC')
            ->groupBy('bairro_id') 
        ->get();
 
        return $saidas;
    }

    public function getAllMontlySheet($from, $to, $site_id)
    {
        $general = ['baixada.removido', 0]; 
		$site_cond = ($site_id != Null && $site_id != 0) ? ['baixada.site', $site_id] : ['baixada.site', '!=' , Null];
        

        $saidas = DB::table('baixada')
            ->select(DB::raw('SUM(baixada_mono) as baixada_mono'), DB::raw('SUM(baixada_tri) as baixada_tri'), DB::raw('SUM(caixa_sup_post_v2) as caixa_sup_post_v2'),DB::raw('SUM(quadro_electrico) as quadro_electrico'), DB::raw('SUM(cabo_abc_2_10) as cabo_abc_2_10'), DB::raw('SUM(cabo_abc_4_16) as cabo_abc_4_16') ,DB::raw('SUM(ligadores_pc1) as ligadores_pc1'), DB::raw('SUM(ligadores_pc2) as ligadores_pc2'), DB::raw('SUM(pinca_2_16) as pinca_2_16'), DB::raw('SUM(pinca_4_16) as pinca_4_16'), 'data', 'site')
            ->where([$general, $site_cond])
            ->whereBetween('data', [$from, $to])
            ->orderBy('data', 'ASC')
            ->groupBy('data') 
            ->groupBy('site') 
        ->get();
 
        return $saidas;
    }

    
    public function saidas_list_report($from, $to, $site)
    {

        $condition = ($site == Null) ? 
        [['saida_baixadas.removido', 0], ['saida_baixadas.site', '!=', Null], ['saida_baixadas.destino', '=', Null]] : 
        [['saida_baixadas.removido', 0], ['saida_baixadas.site', $site], ['saida_baixadas.destino', '=', Null]];

        $saidas = DB::table('saida_baixadas')
            ->select(DB::raw('SUM(quadrelec) as quadrelec'), DB::raw('SUM(cx_md_2) as cx_md_2'), DB::raw('SUM(cx_md_4) as cx_md_4'), DB::raw('SUM(cb_210_mm2) as cb_210_mm2'), DB::raw('SUM(cb_416_mm2) as cb_416_mm2'),DB::raw('SUM(pm_216) as pm_216') ,DB::raw('SUM(pm_425) as pm_425'),DB::raw('SUM(l_pc1) as l_pc1'),DB::raw('SUM(l_pc2) as l_pc2'), DB::raw('SUM(l_pc3) as l_pc3'), DB::raw('SUM(contador_mono) as contador_mono') ,DB::raw('SUM(contador_trifasico) as contador_trifasico'), 'data', 'site', 'site.nome as site_nome')
            ->leftJoin('site', 'site.id', '=', 'saida_baixadas.site')
            ->whereBetween('data', [$from, $to])
            ->where($condition)
            ->orderBy('saida_baixadas.data', 'DESC')
            ->groupBy('data', 'site') 
        ->get();

        return $saidas;
    }

    
    public function saidas_report_table($from, $to, $site)
    {

        $condition = ($site == Null) ? 
        [['saida_baixadas.removido', 0], ['saida_baixadas.site', '!=', Null], ['saida_baixadas.destino', '=', Null]] : 
        [['saida_baixadas.removido', 0], ['saida_baixadas.site', $site], ['saida_baixadas.destino', '=', Null]];

        $saidas = DB::table('saida_baixadas')
            ->select('saida_baixadas.quantidade_diaria', DB::raw('SUM(cb_210_mm2) as projectado_1') , DB::raw('SUM(cb_416_mm2) as projectado_2'))
            ->whereBetween('data', [$from, $to])
            ->where($condition)
            ->orderBy('data', 'desc')
            ->orderBy('saida_baixadas.data', 'DESC')
            ->groupBy('data', 'site') 
        ->get();
        

        return $saidas;
    }
    
}
