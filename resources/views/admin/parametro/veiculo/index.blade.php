@extends('layout.master')
@section('content')

<div class="page-content fade-in-up" id="requisicao-armazem">
 
    <div class="borowx">
 
        <div class="col-md-12">

            <div class="ibox">

                
                <div class="ibox-head bg-blue-100">
                    <div class="ibox-title" style="text-transform: uppercase; font-weight: 800; text-align: center">
                        Listagem de Viaturas
                    </div> 
                </div>

                <div class="ibox-body">

                    
                    <div class="" style="overflow-x:auto;">
                            
                        <table id="veiclesList" class="table table-bordered table-striped">
                            <thead>
                                <tr style="border: 1px solid white">
                                    <th style="border: 1px solid #ffffff5c; border-radius: 0;" colspan="1"></th> 
                                    <th style="border: 1px solid #ffffff5c; border-radius: 0; text-transform: uppercase" colspan="7" class=" text-center">
                                        Veiculo
                                    </th>
                                    <th style="border: 1px solid #ffffff5c; border-radius: 0; text-transform: uppercase" colspan="4" class=" text-center">
                                        Valores
                                    </th> 
                                    <th style="border: 1px solid #ffffff5c; border-radius: 0;" colspan="2" class=" text-center">VENDA</th>
                                    <th style="border: 1px solid #ffffff5c; border-radius: 0;" colspan="2" class=" text-center"></th>
                                </tr>
                                <tr>
                                    <th style="border: 1px solid #ffffff5c; border-radius: 0;" class="text-center">#</th>
                                    <th style="border: 1px solid #ffffff5c; border-radius: 0;">Matricula</th>
                                    <th style="border: 1px solid #ffffff5c; border-radius: 0;">Marca</th>
                                    <th style="border: 1px solid #ffffff5c; border-radius: 0;">Modelo</th>
                                    <th style="border: 1px solid #ffffff5c; border-radius: 0;" class="text-center">Tipo</th>
                                    <th style="border: 1px solid #ffffff5c; border-radius: 0;" class="text-center">Ano Mod</th>
                                    <th style="border: 1px solid #ffffff5c; border-radius: 0;" class="text-center">Data de compra</th>
                                    <th style="border: 1px solid #ffffff5c; border-radius: 0;" class="text-center">Anos Usado</th>
                                    <th style="border: 1px solid #ffffff5c; border-radius: 0;" class="text-center">Preco de compra</th>
                                    <th style="border: 1px solid #ffffff5c; border-radius: 0;" class="text-center">Depreciação</th>
                                    <th style="border: 1px solid #ffffff5c; border-radius: 0;" class="text-center">Valor depreciado</th>
                                    <th style="border: 1px solid #ffffff5c; border-radius: 0;" class="text-center">Valor book value</th>
                                    <th style="border: 1px solid #ffffff5c; border-radius: 0;" class="text-center">Data da Venda</th>
                                    <th style="border: 1px solid #ffffff5c; border-radius: 0;" class="text-center">Valor da Venda</th> 
                                    <th style="text-align: center">Acções</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php $i = 1; @endphp
                                @forelse ($viaturas as $data)
                                    @php
                                        $date = new \DateTime($data->data_aquisicao);
                                        $now = new \DateTime();
                                        $interval = $now->diff($date);
                                        $restante = $interval->y;

                                        $valor_depreciado = $data->valor_aquisicao*($data->percentual_amortizacao/100);
                                    @endphp
                                    <tr>
                                        <th class="text-center">{{ $i++ }}</th>
                                        <td>{{ $data->matricula }}</td>
                                        <td>{{ $data->marca }}</td>
                                        <td>{{ $data->modelo }}</td>
                                        <td class="text-center">n/a</td>
                                        <td class="text-center">{{ $data->ano }}</td>
                                        <td class="text-center">{{ $data->data_aquisicao }}</td>
                                        <td class="text-center">{{ $restante.' anos' }} </td> {{-- anos usado --}}
                                        <td class="text-right">
                                            {{ number_format(($data->valor_aquisicao) ? $data->valor_aquisicao : 0.0, 2) }}
                                        </td>
                                        <td class="text-right">{{ $data->percentual_amortizacao.'%' }}</td>
                                        <td class="text-right">{{ number_format($valor_depreciado, 2) }}</td> 
                                        <td class="text-right">
                                            {{ number_format($data->valor_aquisicao - $valor_depreciado, 2)  }}
                                        </td>  
                                        <td class="text-right">{{ ($data->data_entrega) ? $data->data_entrega : 'n/a' }}</td>
                                        <td class="text-right">
                                            {{ number_format($data->valor_entrega, 2)  }}
                                        </td>   
                                        <td  style="text-align: center">
                                            <a href="#"
                                                class="btn btn-icon btn-xs btn-success"> <i class="fa fa-search-plus"></i> 
                                            </a>
                                            <a href="#"
                                                class="btn btn-icon btn-xs btn-primary"> <i class="fa fa-edit"></i> 
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="16" class="text-center text-danger">Sem veiculos</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            
            </div>

        </div>

    </div>


</div>


@endsection

@section('js')
<script type="text/javascript">
    $(function () {
        $("#veiclesList").DataTable({
            "order": [],
            // "paging":false,
            "columnDefs": [{
                "targets": 6,
                "orderable": false
            }],
            "pageLength": 20, 
            "language": '{{ Session::get('dflt_lang') }}',
    
        });
        $(".select2").select2({});
    });
  
</script>
@endsection