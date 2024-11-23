 
<div class="page-content fade-in-up" id="entradas-saidas-sites">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-head">
                    <ul class="nav nav-tabs {{ Request::is('stock/sites/entradas_saidas-pesquisa') ? 'd-none' : '' }}">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('stock.index') }}">Stock Total</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('stock.entradasaida') }}">Projectos: entradas & saidas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Sites: entradas & saidas</a>
                        </li>
                    </ul>
                    <div class="ibox-tools">
                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                </div>
                <div class="ibox-body pt-5">
                    <section>
                        <div class="row justify-content-between">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-8">
                                        <form id="pesquisaData">
                                            <div class="row">
                                                <div class="col-md-4 form-group">
                                                    <label for="">Data Inicio:</label>
                                                    <input type="date" class="form-control br" name="datainicio"
                                                        v-model="produto.datainicio" v-on:input="search">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label for="">Data Fim:</label>
                                                    <input type="date" class="form-control br" name="datafim"
                                                        v-model="produto.datafim" v-on:input="search">
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label for="">Sites/Estaleiros:</label>
                                                    <select class="form-control br" v-on:change="search" v-model="produto.site" name="site">
                                                        <option value="{{ Null }}" selected>Todos Sites</option>
                                                        @foreach ($site as $row)
                                                            <option value="{{ $row->id }}">{{ $row->nome }} </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                        </form>
                                    </div>

                                    <div class="col-md-4">
                                        <form action="">
                                            <div class="form-group">
                                                <label for="">Pesquisa geral:</label>
                                                <input type="text" class="form-control br" placeholder="Pesquisa" name="pesquisa"
                                                    v-model="produto.pesquisa" v-on:input="search">
                                            </div>
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9 d-none">
                                <form action="{{ route('stockfilter.sites.pesquisa') }}" method="post">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control " placeholder="Codigo"
                                                    name="codigo" v-model="produto.codigo" v-on:input="search">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control " placeholder="Nome" name="nome"
                                                    v-model="produto.nome" v-on:input="search">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control " placeholder="Subcategoria"
                                                    name="subcategoria" v-model="produto.subcategoria"
                                                    v-on:input="search">
                                            </div>
                                        </div>
                                    </div>

                                    @csrf
                                </form>
                            </div>
                            
                        </div>
                    </section>
                    <table class="table table-hover table-dashed table-striped" id="entradasSaidasSites-table" >
                        <thead class="bg-blue-100" >
                            <tr>
                                <th style="font-size: 13px" class="text-center">#</th>
                                <th style="font-size: 13px" class="text-center">Codigo</th>
                                <th style="white-space: nowrap; font-size: 13px">Nome</th>   
                                <th style="text-align: center; white-space: nowrap;font-size: 13px">Entrada</th>
                                <th style="text-align: center; white-space: nowrap;font-size: 13px">Saida</th>
                                <th style="text-align: center; white-space: nowrap;font-size: 13px">Saldo</th>

                            </tr>
                        </thead>
                        <tbody v-if="produtos.length!==0" v-html="produtos">
                        </tbody>
                        <tbody v-else> 
                            <tr>
                                <td colspan="30" class="text-center text-danger"  >
                                    Sem registos!
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-end">

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
