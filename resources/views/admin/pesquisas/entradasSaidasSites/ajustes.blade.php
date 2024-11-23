@extends('layout.master')
 
@section('content')

    <div class="page-content fade-in-up" id="ajuste-saida">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Listagem de Ajustes de Saida</div>

                        @if (Auth::user()->tipo_de_usuario != 4)
                            <div class=" ">
                                <a class="btn btn-sm btn-success btn-rounded" href="{{ route('ajustesaida.create') }}"><i class="fa fa-plus"></i> Adicionar Ajuste</a>
                            </div>
                        @endif
                    </div>
                    <div class="ibox-body">
                        <section>
                            <div class="row justify-content-between">
                                <div class="col-md-12">
                                    <div class="row d-none">
                                        <div class="col-md-3">
                                            <form class="form-group" id="pesquisaData">
                                                <select name="data" id="data_busca" class="form-control"
                                                    v-model="tempo.data" v-on:change="searchdata">
                                                    <option value="">All</option>
                                                    <option v-for="(epoca,index) in epocas" v-bind:value="epoca.value"
                                                        v-text="epoca.write"
                                                        :selected="epoca.selected?tempo.data=epoca.value:''"></option>
                                                </select>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <form action="{{ route('guiaentrada.pesquisa') }}" method="post">
                                        <div class="row">
                                            <div class="col-md-3 d-none">
                                                <div class="form-group">
                                                    <input type="text" class="form-control " placeholder="No. Folheto"
                                                        name="numero_do_folheto" v-model="saida.numero_do_folheto"
                                                        v-on:input="search">
                                                </div>
                                            </div>
                                            <div class="col-md-3 d-none">
                                                <div class="form-group">
                                                    <input type="text" class="form-control " placeholder="Requisicao Armazem No"
                                                        name="requisicaoArmazem" v-model="saida.requisicaoArmazem"
                                                        v-on:input="search">
                                                </div>
                                            </div>
                                            <div class="col-md-3 d-none">
                                                <div class="form-group">
                                                    <input type="text" class="form-control br" placeholder="Responsavel"
                                                        name="requisitante" v-model="saida.requisitante"
                                                        v-on:input="search">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <input type="date" class="form-control br" placeholder="Data" name="data"
                                                        v-model="saida.data_entrada" v-on:input="search">
                                                </div>
                                            </div>
                                        </div>

                                        @csrf
                                    </form>
                                </div>
                                <div class="col-md-3">
                                    <form action="">
                                        <div class="form-group">
                                            <input type="text" class="form-control br" placeholder="Pesquisa" name="pesquisa"
                                                v-model="buscar.pesquisa" v-on:input="searchtotal">
                                        </div>
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </section>
                        <table class="table table-striped">
                            <thead class="bg-blue-100" >
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Empresa</th>
                                    <th scope="col">Data do Ajuste</th>
                                    <th scope="col">Quantidade Ajustada</th>
                                    <th scope="col">Acções</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                    <td>@mdo</td>
                                </tr>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection 