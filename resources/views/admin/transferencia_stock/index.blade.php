@extends('layout.master')

@section('title')
    Transferências de Stock
@endsection
@php
    $i = 1;
    $ano = null;
@endphp
@section('content')

    <div class="page-content fade-in-up" id="requisicao-armazem">
        <div class="row">
            <div class="col-md-12">

                <div class="ibox">

                    <div class="ibox-head bg-blue-100">
                        <div class="ibox-title" style="text-transform: uppercase; font-weight: 800">Transferências de Stock </div>
                        <div class=" ">
                            @if (Auth::user()->tipo_de_usuario != 0 && Auth::user()->tipo_de_usuario != 4)
                                <a class="btn btn-sm btn-success btn-rounded" href="{{ route('transferencias.create') }}">
                                    <i class="fa fa-plus"></i> Registar Transferência
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="ibox-body">

                        <table class="table table-hover table-striped" style="width: 100%"  id="requisicaoArmazem-table">
                            <thead class="bg-blue-100" >
                                <tr>
                                    <th>#</th>
                                    <th>Data</th>
                                    <th>Referência</th>
                                    <th>Proejcto Origem</th>
                                    <th>Proejcto Destino</th>
                                    <th>Requisitante</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Acções</th>
                                </tr>
                            </thead>
                            <tbody >
                                @foreach ($transferencia as $data)
                                    <tr>

                                        <td>{{ $i++ }}</td>
                                        <td>{{ $data->data }}</td>
                                        <td>{{ $data->referencia }}</td>
                                        <td>{{ $data->site_origem->nome }}</td>
                                        <td>{{ $data->destino->nome }}</td>
                                        <td>{{ $data->requisitante }}</td>
                                        <td class="text-center">
                                            @if ($data->status == 1)
                                                <span class="badge badge-warning badge-sm badge-rounded  mt-1" title="Pendente"><i class="fa fa-warning"></i></span>
                                            @elseif ($data->status == 2)
                                                <span class="badge badge-success badge-sm badge-rounded  mt-1" title="Aprovado"> <i class="fa fa-check"></i></span>
                                            @endif

                                            @if ($data->status == 0)
                                                <span class="badge badge-danger badge-sm badge-rounded  mt-1" title="Cancelado"> <i class="fa fa-times"></i></span>
                                            @endif 
                                        </td>
                                        <th class="text-center">
                                            <a href="{{ route('transferencias.show', ['transferencia' => $data->id]) }}" class="btn btn-info btn-sm m-t-5 btn-rounded " data-original-title="Ver detalhes">
                                                <i class="fa fa-search-plus"></i>
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


@endsection 