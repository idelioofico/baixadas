 
<div class="page-content fade-in-up" id="entradas-saidas">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-head bg-blue-100">
                    <ul class="nav nav-tabs {{ Request::is('stock/entradas_saidas-pesquisa') ? 'd-none' : '' }}">
                        <li class="nav-item">
                            <a class="nav-link active" href="#" style="text-transform: uppercase; font-weight: 800">Projectos: entradas</a>
                        </li>
                        <li class="nav-item d-none">
                            <a class="nav-link" href="{{ route('stock.site_entradasaida') }}">Sites: entradas</a>
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
                                <form action="{{ route('stockfilter.export_data') }}" method="GET">
                                    @method('GET')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <form id="pesquisaData">
                                                <div class="row">
                                                    <div class="col-md-3 form-group">
                                                        <label for="">Ano:</label>
                                                        <select class="form-control baixada_input" v-on:change="search" v-model="produto.ano" name="ano" id="ano">
                                                            <option value="{{ Null }}">Todos</option>
                                                            <option value="2022">2022</option>
                                                            <option value="2023">2023</option>
                                                        </select>
                                                    </div> 
                                                    <div class="col-md-6 form-group">
                                                        <label for="">Projecto:</label>
                                                        <select class="form-control " style="height: 34px; border: 1px solid #00000040; border-radius: 5px;" v-on:change="search" v-model="produto.projecto" name="site">
                                                            <option value="{{ Null }}" selected>Todos</option>
                                                            @foreach ($site as $row)
                                                                <option value="{{ $row->id }}">
                                                                    {{ $row->site_nome }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
     
                                                </div>
    
                                            </form>
                                        </div>
     
                                        <div class="col-md-3 form-group" style="margin-top: 31px">
                                            <button type="submit" class="btn btn-sm btn-warning"> 
                                                <i class="fa fa-print"></i>Exportar
                                            </button>
                                        </div>
    
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-9 d-none">
                                <form action="{{ route('stockfilter.pesquisa') }}" method="post">
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
                    <table class="table table-hover table-dashed table-striped table-responsive" id="entradasSaidas-table" >
                        <thead class="bg-blue-100" >
                            <tr> 
                                <th style="white-space: nowrap; font-size: 13px">&nbsp; Nome</th>   
                                @foreach (DB::table('meses')->get() as $mes)
                                    <th style="white-space: nowrap; font-size: 13px; text-align: end;">&nbsp; {{ $mes->nome }} &nbsp;</th>   
                                @endforeach 
                            </tr>
                        </thead>
                        <tbody v-if="produtos.length!==0" v-html="produtos">
                        </tbody>
                        <tbody v-else> 
                            <tr>
                                <td colspan="15" class="text-center text-danger"  >
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
