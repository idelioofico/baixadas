@extends('layout.master')

@section('title')
    Guia de Saida
@endsection

@php
$i = 1; 
@endphp

@section('content')
    <div class="page-heading">
        <h1 class="page-title" style="text-transform: uppercase; font-weight: 800">Guia de Saida: {{ $guiasaida->numero_do_folheto }}</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html"><i class="la la-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Guia {{ $guiasaida->numero_do_folheto }}</li>
        </ol>
        <div class="pt-4 pb-3">
            <h4> <a href="{{ route('guiasaida.index') }}" ><i class="fa fa-arrow-left"></i> Voltar</a></h4>
        </div>
    </div>

    @if ($guiasaida->pendente == 1)
        <section class="card p-2 mt-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h3>Aprovar Guia</h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ route('guiasaida.aprovar', $guiasaida->id) }}" class="btn btn-success btn-sm btn-rounded">Aprovar <i class="fa fa-check"></i></a>
                    </div>
                </div>
            </div>
        </section>
    @endIf

    @if ($guiasaida->pendente == 0)
        <section class="card p-2 mt-4 bg-danger">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h3 class="text-white font-weight-bold">Guia Cancelada</h3>
                    </div> 
                </div>
            </div>
        </section>
    @endIf
    <section id="root">
        <div class="page-content fade-in-up">
            <div class="row">
                <div class="col-md-8">
                    <div class="ibox">
                        <div class="ibox-head bg-blue-100">
                            <div class="ibox-title" style="text-transform: uppercase; font-weight: 800">Guia De Saida {{ $guiasaida->numero_do_folheto }}</div>
                            <div class="iboxw">
                                @if ($guiasaida->pendente == 2 || $guiasaida->pendente == 3)
                                    <a href="{{ route('guiasaida.imprimir', $guiasaida->id) }}" class="btn btn-warning btn-sm btn-rounded">Imprimir Guia <i class="fa fa-print"></i></a>
                                @endIf
                            </div>
                        </div>
                        <div class="ibox-body">
                            <form action="{{ route('guiasaida.update', $guiasaida->id) }}" method="post"
                                class="pt-4">
                                @csrf
                                @method('put')
                                <div class="row">

                                    <div class="col-md-3">
                                        <label for="">Numero de Guia</label>
                                        <div class="form-group">
                                            <input type="text" name="numero_do_folheto" class="form-control br"
                                                placeholder="Numero de Guia"
                                                value="{{ old('numero_do_folheto') ?? $guiasaida->numero_do_folheto }}"
                                                disabled>
                                            <p class="text-danger">{{ $errors->first('numero_do_folheto') }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="">Projecto</label>
                                        <div class="form-group">
                                            <input type="text" name="site_nome" class="form-control br"
                                                placeholder="Numero de Guia"
                                                value="{{ $guiasaida->projecto_nome.' - '. $guiasaida->site_nome }}"
                                                disabled>
                                            <p class="text-danger">{{ $errors->first('site') }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="">Requisitante</label>
                                        <div class="form-group">
                                            <input type="text" name="requisitante" class="form-control br"
                                            disabled value="{{ $guiasaida->requisitante }}">
                                            <p class="text-danger">{{ $errors->first('requisitante') }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="">Data da Requisição</label>
                                        <div class="form-group">
                                            <input type="date" name="data" class="form-control br" placeholder=".........."
                                            disabled   value="{{ $guiasaida->data }}">
                                            <p class="text-danger">{{ $errors->first('data') }}</p>
                                        </div>
                                    </div>
                                 
                                    @if ($guiasaida->elaborado_por)
                                        <div class="col-md-3">
                                            <label for="">Elaborado por</label>
                                            <div class="form-group">
                                                <input type="text" name="data" class="form-control br" placeholder="data"
                                                    value="{{ old('data') ?? $guiasaida->elaborado_por }}" disabled>
                                                <p class="text-danger">{{ $errors->first('data') }}</p>
                                            </div>
                                        </div>
                                    @endif
                           
                                    
                                    @if ($guiasaida->aprovado_por)
                                        <div class="col-md-3">
                                            <label for="">Aprovado por</label>
                                            <div class="form-group">
                                                <input type="text" name="data" class="form-control br" placeholder="data"
                                                    value="{{ old('data') ?? $guiasaida->aprovado_por }}" disabled>
                                                <p class="text-danger">{{ $errors->first('data') }}</p>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($guiasaida->editado_por)
                                        <div class="col-md-3">
                                            <label for="">Atualizado por</label>
                                            <div class="form-group">
                                                <input type="text" name="data" class="form-control br" placeholder="data"
                                                    value="{{ old('data') ?? $guiasaida->editado_por }}" disabled>
                                                <p class="text-danger">{{ $errors->first('data') }}</p>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($guiasaida->cancelado_por)
                                        <div class="col-md-3">
                                            <label for="">Cancelado por</label>
                                            <div class="form-group">
                                                <input type="text" name="data" class="form-control br" placeholder="data"
                                                    value="{{ old('data') ?? $guiasaida->cancelado_por }}" disabled>
                                                <p class="text-danger">{{ $errors->first('data') }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                            </form>

                            <div class="row mt-4">
                                <div class="col-md-6">
                                    {{-- <a class="btn btn-secondary" href="{{ route('guiasaida.index') }}">Voltar</a> --}}
                                </div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    {{-- @if ($guiasaida->pendente != 0) --}}
                                        {{-- @if (Auth::user()->tipo_de_usuario == 1 || Auth::user()->tipo_de_usuario == 2) --}}
                                            @if ($guiasaida->pendente == 1)
                                                <div class="mr-3">
                                                    <a class="btn btn-warning d-none"
                                                        href="{{ route('guiasaida.edit', $guiasaida->id) }}">Editar</a>
                                                    <button type="button" class="btn btn-warning btn-sm br"
                                                        v-on:click="showModalEditar($event)">Editar</button>
                                                </div>
                                            @endif
                                        {{-- @endif --}}
                                        {{-- @if (Auth::user()->tipo_de_usuario == 1) --}}
                                            <div>
                                                <form class="d-none"
                                                    action="{{ route('guiasaida.destroy', $guiasaida->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger">Cancelar</button>
                                                </form>
                                                <button type="button" class="btn btn-danger btn-sm btn-rounded"
                                                    v-on:click="showModalDeletar($event)">Cancelar</button>
                                            </div>
                                        {{-- @endif --}}
                                    {{-- @endif --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="ibox">
                        <div class="ibox-body">
                            @if ($guiasaida->anexo)
                                <div class="col-md-12" style=" height: 271px; text-align: center;">
                                    <a href="{{ asset('anexos/system/' . $guiasaida->anexo) }}">
                                        <img style="height: 91%;" src="{{ asset('anexos/system/' . $guiasaida->anexo) }}" alt=""
                                        class="igm-fluid">
                                    </a>
                                </div>
                            @else
                            <div class="col-md-12" style=" height: 271px; text-align: center;">
                                    <img style="height: 91%;"  src="{{ asset('anexos/system/files.png') }}" alt=""
                                        class="igm-fluid">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="page-content fade-in-up">
            <div class="row">
                <div class="col-md-12">
                    <div class="ibox">
                        <div class="ibox-head  bg-blue-100">
                            <div class="ibox-title" style="text-transform: uppercase; font-weight: 800">Produtos da Guia de Saida</div>
                            <div class="ibox-tools">
                                <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                            </div>
                        </div>
                        <div class="ibox-body">

                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-left">Produto</th>
                                        <th class="text-center">Unidade</th>
                                        <th class="text-right">P. Unitario</th>
                                        <th class="text-right">Quantidade</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($guiasaida->guiaSaidaProdutos as $requisicao_produto)
                                        <tr class="text-center">
                                            <td>{{ $i++ }}</td>
                                            <td class="text-left">{{ $requisicao_produto->produto['nome'] }}</td>
                                            <td class="text-center">{{ $requisicao_produto->produto['unidade_total'] }}</td>
                                            <td class="text-right">{{ number_format($requisicao_produto->custo_unitario) ?? '-' }}</td>
                                            <td class="text-right">{{ number_format($requisicao_produto->quantidade) ?? '-' }}</td>
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


@push('javascript')
    <script>
        let root = new Vue({
            el: '#root',
            data: {
                categoriaId: '',
                errors: '',

            },
            mounted: function() {

            },
            methods: {
                showModalDeletar(event) {
                    event.preventDefault()

                    this.categoriaId = event.target.parentNode.children[0]
                    $('#modalDelete').modal('show')


                },
                modalDeletar(event) {
                    // console.log('chegou')
                    event.preventDefault();
                    this.categoriaId.submit()
                },
                showModalEditar(event) {
                    event.preventDefault()
                    console.log('chegou')
                    this.categoriaId = event.target.parentNode.children[0]
                    $('#modalEdit').modal('show')
                },
                modalEditar(event) {
                    event.preventDefault();
                    // console.log('chegou')
                    this.categoriaId.click()
                }
            }

        })
    </script>
@endpush
