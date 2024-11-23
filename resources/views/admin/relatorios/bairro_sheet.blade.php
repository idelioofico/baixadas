@extends('layout.master')

@section('title')
    Execução Diaria de Material das Baixadas
@endsection
 
@section('content')

    <div class="page-content fade-in-up" id="requisicao-armazem">
        <div class="row">
            <div class="col-md-12">

                <div class="ibox">

                    <div class="ibox-head bg-blue-100">
                        <div class="ibox-title" style="text-transform: uppercase; font-weight: 800; text-align: center">
                            Daily sheet Baixadas - TesTop
                        </div> 
                    </div>

                    <div class="ibox-body">

                        <section >
                            <div class="row justify-content-between">

                                <div class="col-md-12 mb-5">
                                    <form action="{{ route('report.bairros') }}" method="GET">
                                        <div class="row">
                                              
                                             
                                            <div class="col-md-2">
                                                <label for="from">De:</label>
                                                <div class="form-group">
                                                    <input style="padding: 0.3rem .75rem !important;" class="form-control br" id="from" type="date" name="from" value="{{ $from }}"  />
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <label for="">Até:</label>
                                                <div class="form-group">
                                                    <input style="padding: 0.3rem .75rem !important;" class="form-control br" id="to" type="date" name="to" value="{{ $to }}"  />
                                                </div>
                                            </div>
                                          
                                            <div class="col-md-2">
                                                <label for="">Site:</label>
                                                <div class="form-group">
                                                    <select name="site_id" id="site_id" class="form-control br custom_select">
                                                        <option value="{{ null }}">Todos</option>
                                                        @foreach ($sites as $site)
                                                            <option {{ $site->id == $site_id ? 'selected' : '' }} value="{{ $site->id }}">
                                                                {{ $site->nome_projecto }} - {{ $site->nome }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-danger">{{ $errors->first('site') }}</p>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <label for="">Provincia:</label>
                                                <div class="form-group">
                                                    <select name="provincia_id" id="provincia_id" class="form-control br custom_select">
                                                        <option value="{{ null }}">Todas</option>
                                                        @foreach ($provincias as $prov)
                                                            <option {{ $prov->id == $provincia_id ? 'selected' : '' }} value="{{ $prov->id }}">
                                                                {{ $prov->nome }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-danger">{{ $errors->first('site') }}</p>
                                                </div>
                                            </div>
                                            
    
                                            <div class="col-md-2 form-group" style="margin-top: 30px;">
                                                <button type="submit" class="btn btn-sm btn-info br">
                                                    Pesquisar <i class="fa fa-search-plus"></i>
                                                </button>
                                            </div>

                                            
                                            <div class="col-md-2 form-group" style="margin-top: 30px; text-align: end;">
                                                <a target="_blank" href="#go" class="btn btn-sm btn-warning br">
                                                    Exportar Excel <i class="fa fa-print"></i>
                                                </a>
                                            </div>
                                            
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </section>
                        
                        
                        <div class="" style="overflow-x:auto;">

                            <table class="table table-hover table-dashed table-striped table-bordered" id="relatorio_baixadas-table" >
                            
                                <thead>
                                    <tr>
                                        <th colspan="14" class="p-2 mt-1 mb-1 th_br text-center text-uppercase" style="background: #e9ecef; font-size: 20px">
                                            Bairro Summary Sheet 
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="4" class="p-2 mt-1 mb-1 th_br text-center" style="background: #e9ecef"></th>
                                        <th colspan="2" class="p-2 mt-1 mb-1 th_br text-center" style="background: #FCE4D6;">Caixas de Proteção</th>
                                        <th colspan="2" class="p-2 mt-1 mb-1 th_br text-center" style="background: #e9ecef"></th>
                                        <th colspan="2" class="p-2 mt-1 mb-1 th_br text-center" style="background: #FCE4D6;">Cabos</th>
                                        <th colspan="4" class="p-2 mt-1 mb-1 th_br text-center" style="background: #e9ecef"></th>
                                    </tr>
                                </thead>
                            
                                <thead class="thead-default" >
                                    <tr>
                                        <th class="p-2 mt-1 mb-1 th_br text-center" style="background: #FCE4D6">Nº série</th> 
                                        <th class="p-2 mt-1 mb-1 th_br" style="background: #FCE4D6;">Bairro</th>
                                        <th class="text-center p-2 mt-1 mb-1 th_br" style="background: #FCE4D6;">Baixadas Monofasicas</th>
                                        <th class="text-center p-2 mt-1 mb-1 th_br" style="background: #FCE4D6;">Baixadas Trifasicas</th>
                                        <th class="text-center p-2 mt-1 mb-1 th_br" style="background: #FCE4D6;">2 Vias</th>
                                        <th class="text-center p-2 mt-1 mb-1 th_br" style="background: #FCE4D6;">4 Vias</th>
                                        <th class="text-center p-2 mt-1 mb-1 th_br" style="background: #FCE4D6">Quadro Electrico</th>
                                        <th class="text-center p-2 mt-1 mb-1 th_br" style="background: #FCE4D6">Postes Kicker de 6,6m</th> 
                                        <th class="text-center p-2 mt-1 mb-1 th_br" style="background: #FCE4D6">C. abc 2*10mm2</th>
                                        <th class="text-center p-2 mt-1 mb-1 th_br" style="background: #FCE4D6">C. abc 4*16mm2</th>
                                        <th class="text-center p-2 mt-1 mb-1 th_br" style="background: #FCE4D6">L. PC1</th>
                                        <th class="text-center p-2 mt-1 mb-1 th_br" style="background: #FCE4D6">L. PC2</th>
                                        <th class="text-center p-2 mt-1 mb-1 th_br" style="background: #FCE4D6">P. 2*16</th> 
                                        <th class="text-center p-2 mt-1 mb-1 th_br" style="background: #FCE4D6">P. 4*16</th> 
                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                        $i = 1;
                                        $total_pinca1 = 0;
                                        $total_pc1 = 0;
                                        $total_pc2 = 0;
                                        $total_pinca2 = 0;
                                        $total_cabos_abc1 = 0;
                                        $total_cabos_abc2 = 0;
                                        $total_kicker = 0;
                                        $quadrelec = 0;
                                        $total_cx_2 = 0;
                                        $total_cx_4 = 0;
                                        $cont_mono = 0;
                                        $cont_trif = 0;
                                    @endphp

                                    @forelse ($saidas as $data)

                                        @php
                                            $total_pinca1 += $data->pinca_2_16;
                                            $total_pinca2 += $data->pinca_4_16;
                                            $total_pc1 += $data->ligadores_pc1;
                                            $total_pc2 += $data->ligadores_pc2;
                                            $total_cabos_abc1 += $data->cabo_abc_2_10;
                                            $total_cabos_abc2 += $data->cabo_abc_4_16;
                                            $total_kicker += $data->kicker_post_66;
                                            $quadrelec += $data->quadro_electrico;
                                            $total_cx_2 += $data->caixa_sup_post_v2;
                                            $total_cx_4 += $data->caixa_sup_post_v4;
                                            $cont_mono += $data->baixada_mono;
                                            $cont_trif += $data->baixada_tri;
                                        @endphp

                                        <tr>
                                            <td class="p-2 mt-1 mb-1 text-center"> {{ $i++ }} </td> 
                                            <td class="p-2 mt-1 mb-1"> {{ $data->bairro_id }} </td>
                                            <td class="p-2 mt-1 mb-1 text-center"> {{ number_format($data->baixada_mono) }} </td>
                                            <td class="p-2 mt-1 mb-1 text-center"> {{ number_format($data->baixada_tri) }} </td>
                                            <td class="p-2 mt-1 mb-1 text-center"> {{ number_format($data->caixa_sup_post_v2) }} </td>
                                            <td class="p-2 mt-1 mb-1 text-center"> {{ $data->caixa_sup_post_v4 }} </td>
                                            <td class="p-2 mt-1 mb-1 text-center"> {{ $data->quadro_electrico }} </td>
                                            <td class="p-2 mt-1 mb-1 text-center"> {{ $data->kicker_post_66 }} </td> 
                                            <td class="p-2 mt-1 mb-1 text-center"> {{ $data->cabo_abc_2_10 }} </td> 
                                            <td class="p-2 mt-1 mb-1 text-center"> {{ $data->cabo_abc_4_16 }} </td> 
                                            <td class="p-2 mt-1 mb-1 text-center"> {{ $data->ligadores_pc1 }} </td> 
                                            <td class="p-2 mt-1 mb-1 text-center"> {{ $data->ligadores_pc2 }} </td> 
                                            <td class="p-2 mt-1 mb-1 text-center"> {{ $data->pinca_2_16 }} </td>
                                            <td class="p-2 mt-1 mb-1 text-center"> {{ $data->pinca_4_16 }} </td> 
                                            
                                            {{--  <td class="p-2 mt-1 mb-1 text-center">
                                                <a href="{{ route('guiasaida.destroy', ['id' => $data->id]) }}" class="btn btn-xs btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </a> 
                                            </td>   --}}
                                        </tr>


                                    @empty
                                        <tr>
                                            <td colspan="14" class="text-center bg-blue-100">
                                                Sem registos!
                                            </td>
                                        </tr>
                                    @endforelse

                                    <tr> 
                                        <td colspan="2" style="background: #D9D9D9"></td> 
                                        <td style="padding: 12px; text-align:center; font-weight: 900; font-size: 14px; background: #D9D9D9;">     
                                            {{ number_format($cont_mono) }}
                                        </td>
                                        <td style="padding: 12px; text-align:center; font-weight: 900; font-size: 14px; background: #D9D9D9;">     
                                            {{ number_format($cont_trif) }}
                                        </td>
                                        <td style="padding: 12px; text-align:center; font-weight: 900; font-size: 14px; background: #D9D9D9;">
                                            {{ number_format($total_cx_2) }}
                                        </td>
                                        <td style="padding: 12px; text-align:center; font-weight: 900; font-size: 14px; background: #D9D9D9;">
                                            {{ number_format($total_cx_4) }}
                                        </td>
                                        <td style="padding: 12px; text-align:center; font-weight: 900; font-size: 14px; background: #D9D9D9 ">
                                            {{ number_format($quadrelec) }}
                                        </td>
                                        <td style="padding: 12px; text-align:center; font-weight: 900; font-size: 14px; background: #D9D9D9 ">
                                            {{ number_format($total_kicker) }}
                                        </td>
                                        <td style="padding: 12px; text-align:center; font-weight: 900; font-size: 14px; background: #D9D9D9; ">
                                            {{ number_format($total_cabos_abc1) }}
                                        </td>
                                        <td style="padding: 12px; text-align:center; font-weight: 900; font-size: 14px; background: #D9D9D9; ">
                                            {{ number_format($total_cabos_abc2) }}
                                        </td>
                                        <td style="padding: 12px; text-align:center; font-weight: 900; font-size: 14px; background: #D9D9D9 ">
                                            {{ number_format($total_pc1) }}
                                        </td>
                                        <td style="padding: 12px; text-align:center; font-weight: 900; font-size: 14px; background: #D9D9D9 ">
                                            {{ number_format($total_pc2) }}
                                        </td>
                                        <td style="padding: 12px; text-align:center; font-weight: 900; font-size: 14px; background: #D9D9D9 ">
                                            {{ number_format($total_pinca1) }}
                                        </td>
                                        
                                        <td style="padding: 12px; text-align:center; font-weight: 900; font-size: 14px; background: #D9D9D9 ">
                                            {{ number_format($total_pinca2) }}
                                        </td>
                                        
                                    </tr>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
 

@endsection

