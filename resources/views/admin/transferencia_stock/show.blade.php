@extends('layout.master')

@section('title')
    Requisição de Transferencia de Stock: {{ $transferencia->referencia }}
@endsection

@php
$i = 1;
@endphp

@section('content')
    <div class="page-heading">
        <div class="pt-4  ">
            <h4> <a href="{{ route('transferencias.index') }}" ><i class="fa fa-arrow-left"></i> Voltar</a></h4>
        </div>
    </div>


    @if ($transferencia->status == 0)
        <section class="card  mt-4 bg-danger" style="">
            <div class="card-body" style="padding: 9px;">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h5 class="text-white  font-weight-bold"><i class="fa fa-times"></i> Transferencia Cancelada</h5>
                    </div> 
                </div>
            </div>
        </section>
    @endIf

    <section id=root>
        <div class="page-content fade-in-up">
            <div class="row">
                <div class="col-md-12">
                    <div class="ibox">
                        <div class="ibox-head bg-blue-100">

                            {{ Session::get('error_message') }}
                            <div class="ibox-title" style="text-transform: uppercase; font-weight: 800">Transferencia de Stock: {{ $transferencia->referencia }}</div>

                            @if ($transferencia_produtos->isNotEmpty() && $transferencia->status == 1)

                                <div class="ibox-tools">
                                    <div class=" text-right">
                                            <a href="{{ route('transferencia_stock.aprovar', ['id' => $transferencia->id]) }}"
                                            class="btn btn-success btn-sm btn-rounded">Aprovar <i class="fa fa-check"></i></a>
                                    </div>
                                </div>

                            @endIf

                        </div>
                        <div class="ibox-body">
                            <div class="row">

                                <div class="col-md-3">
                                    <label for="">Origem</label>
                                    <div class="form-group">
                                        <input type="text" name="requisitante" class="form-control br" disabled  value="{{ $transferencia->site_origem->nome }}">
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <label for="">Destino</label>
                                    <div class="form-group">
                                        <input type="text" name="requisitante" class="form-control br" disabled  value="{{ $transferencia->destino->nome }}">
                                        <p class="text-danger">{{ $errors->first('empresa_destino') }}</p>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="">Data</label>
                                    <div class="form-group">
                                        <input type="text" name="requisitante" class="form-control br" disabled  value="{{ $transferencia->data }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="">Requisitante</label>
                                    <div class="form-group">
                                        <input type="text" name="requisitante" class="form-control br" disabled  value="{{ $transferencia->requisitante }}">
                                    </div>
                                </div>
  
                                <div class="col-md-12 form-group">
                                    <label for="">Motivo/ Observações</label> 
                                    <input type="text" name="requisitante" class="form-control br" disabled  value="{{ $transferencia->motivo }}">
                                </div>

                            </div>
                            <hr>
                             
                            <div class="row mt-4"> 
                                <div class="col-md-12 d-flex justify-content-end">
                                    @if ($transferencia->status != 0)
                                        @if (Auth::user()->tipo_de_usuario == 1 || Auth::user()->tipo_de_usuario == 2)
                                            @if ($transferencia->status == 1)
                                                <div class="mr-3">
                                                    <a class="btn btn-warning d-none"
                                                        href="{{ route('requisicao.edit', $transferencia->id) }}">Editar</a>
                                                    <button type="button" class="btn btn-info btn-sm btn-rounded"
                                                        v-on:click="showModalEditar($event)"><i class="fa fa-edit"></i> Editar</button>
                                                </div>
                                            @endif
                                        @endif
                                        @if (Auth::user()->tipo_de_usuario == 1)
                                            <div>
                                                <form class="d-none"
                                                    action="{{ route('requisicao.destroy', $transferencia->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('post')
                                                    <button class="btn btn-danger">Cancelar</button>
                                                </form>
                                                <button type="button" class="btn btn-danger  btn-sm btn-rounded"
                                                    v-on:click="showModalDeletar($event)"><i class="fa fa-times"></i> Cancelar Requisição</button>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="page-content fade-in-up">
            <div class="row">
                <div class="col-md-12">
                    <div class="ibox">
                        <div class="ibox-head bg-blue-100">
                            <div class="ibox-title" style="text-transform: uppercase; font-weight: 800">Produtos a ser transferidos</div>
                        </div>
                        <div class="ibox-body">
                            
                            <table class="table table-striped"  id="requisicaoArmazem-table">

                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Produto</th>
                                        <th class="text-right">Quantidade</th>
                                    </tr>
                                </thead>
                                <tbody >
                                    @foreach ($transferencia_produtos as $data)
                                        <tr>

                                            <td>{{ $i++ }}</td>
                                            <td>{{ $data->produto['nome'] }}</td>
                                            <td class="text-right">{{ $data->quantidade }}</td> 
                                        </tr>
                                    @endforeach

                                </tbody> 
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Modal Editar -->
        <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-center" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Alerta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4>Tem certeza que pretende editar</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" v-on:click="modalEditar($event)">Sim</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>

                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Deletar -->
        <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-center" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Alerta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4>Tem certeza que pretende cancelar</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" v-on:click="modalDeletar($event)">Sim</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>

                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection
 