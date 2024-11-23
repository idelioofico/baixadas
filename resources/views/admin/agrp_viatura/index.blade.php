@extends('layout.master')
 
@section('content')

    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                  
                    <div class="ibox-head bg-blue-100">
                        <div class="ibox-title" style="text-transform: uppercase; font-weight: 800; text-align: center">
                            Distribuição de Viaturas Por Provincia | Baixadas
                        </div>
                        <div>
                            <a href="{{ route('agrp_viatura.create') }}" class="btn btn-sm btn-success br">
                                <i class="fa fa-plus"></i> Registar Alocação
                            </a>
                        </div>
                    </div>

                    <div class="ibox-body">
                        
                        <table class="table table-hover table-dashed table-striped table-bordered myTable">
                            <thead class="bg-blue-100">
                                <tr>
                                    <th class="p-1 mt-1 mb-1 text-center">Ord</th>
                                    <th class="p-1 mt-1 mb-1">Veiculo</th>
                                    <th class="p-1 mt-1 mb-1">Provincia</th>
                                    <th class="p-1 mt-1 mb-1">Responsavel</th>
                                    <th class="p-1 mt-1 mb-1 text-center">Acções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $index = 1;
                                @endphp
                                @foreach ($alocacoes as $aloc)
                                    <tr>
                                        <td class="p-1 mt-1 mb-1 text-center">{{ $index++ }}</td>
                                        <td class="p-1 mt-1 mb-1">{{ $aloc->matricula }}</td>
                                        <td class="p-1 mt-1 mb-1">{{ $aloc->provincia }}</td>
                                        <td class="p-1 mt-1 mb-1">{{ $aloc->user_name .'- '. $aloc->created_at }}</td>
                                        
                                        <th class="p-1 mt-1 mb-1 text-center">
                                            <a href="{{ route('agrp_viatura.edit', ['id' => $aloc->id]) }}" class="btn btn-xs btn-primary br">
                                                <i class="fa fa-edit"></i>
                                            </a> 
                                            <a href="{{ route('agrp_viatura.destroy', ['id' => $aloc->id]) }}" class="btn btn-xs btn-danger br">
                                                <i class="fa fa-trash"></i>
                                            </a> 
                                        </th> 
                                    </tr>
                                @endforeach 
                            </tbody>
                             
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endSection

 