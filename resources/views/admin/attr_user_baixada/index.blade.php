@extends('layout.master')
 
@section('content')

    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                  
                    <div class="ibox-head bg-blue-100">
                        <div class="ibox-title" style="text-transform: uppercase; font-weight: 800; text-align: center">
                            Distribuição de Usuarios Por Provincia | Baixadas
                        </div>
                        <div>
                            <a href="{{ route('user_attr.create') }}" class="btn btn-sm btn-success br">
                                <i class="fa fa-plus"></i> Registar Nova
                            </a>
                        </div>
                    </div>

                    <div class="ibox-body">
                        
                        <table class="table table-hover table-dashed table-striped table-bordered myTable">
                            <thead class="bg-blue-100">
                                <tr>
                                    <th class="p-1 mt-1 mb-1 text-center">Ord</th>
                                    <th class="p-1 mt-1 mb-1">Usuario</th>
                                    <th class="p-1 mt-1 mb-1">Provincia</th>
                                    <th class="p-1 mt-1 mb-1">Site</th>
                                    <th class="p-1 mt-1 mb-1">Viatura</th>
                                    <th class="p-1 mt-1 mb-1 text-center">Lote</th>
                                    <th class="p-1 mt-1 mb-1 text-center">Estado</th>
                                    <th class="p-1 mt-1 mb-1 text-center">Acções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $index = 1;
                                @endphp
                                @foreach ($data as $aloc)
                                    <tr>
                                        <td class="p-1 mt-1 mb-1 text-center">{{ $index++ }}</td>
                                        <td class="p-1 mt-1 mb-1">{{ $aloc->name }}</td>
                                        <td class="p-1 mt-1 mb-1">{{ $aloc->provincia }}</td>
                                        <td class="p-1 mt-1 mb-1">{{ $aloc->site }}</td>
                                        <td class="p-1 mt-1 mb-1">{{ $aloc->matricula }}</td>
                                        <td class="p-1 mt-1 mb-1 text-center">{{ $aloc->lote }}</td>
                                        <td class="p-1 mt-1 mb-1 text-center text-success">Ativo <i class="fa fa-check-circle"></i></td>
                                        
                                        <th class="p-1 mt-1 mb-1 text-center">
                                            <a href="{{ route('user_attr.edit', ['id' => $aloc->id]) }}" class="btn btn-xs btn-primary br">
                                                <i class="fa fa-edit"></i>
                                            </a> 
                                            <a href="{{ route('user_attr.destroy', ['id' => $aloc->id]) }}" class="btn btn-xs btn-danger br">
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

 