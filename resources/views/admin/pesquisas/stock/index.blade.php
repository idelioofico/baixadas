<div class="page-content fade-in-up" id="stock">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-head">
                    <ul class="nav nav-tabs {{ Request::is('stock-pesquisa') ? 'd-none' : '' }}">
                        <li class="nav-item">
                            <a class="nav-link active" style="text-transform: uppercase; font-weight: 800" href="#">Stock Total</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="text-transform: uppercase; font-weight: 800" href="{{ route('stock.entradasaida') }}">Projectos: Entradas & saidas</a>
                        </li> 
                    </ul>
                    <div class="ibox-tools">
                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                </div>
                <div class="ibox-body pt-5">
                    <section class="container-fluid">
                        <div class="row justify-content-between">

                            <div class="col-md-9">
                                <form action="{{ route('stock.pesquisa') }}" method="post">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control br" placeholder="Codigo"
                                                    name="codigo" v-model="produto.codigo" v-on:input="search">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3 d-none">
                                            <div class="form-group">
                                                <input type="text" class="form-control " placeholder="Nome" name="nome"
                                                    v-model="produto.nome" v-on:input="search">
                                            </div>
                                        </div>
                                        <div class="col-md-3 d-none">
                                            <div class="form-group">
                                                <input type="text" class="form-control " placeholder="Categoria"
                                                    name="categoria" v-model="produto.categoria" v-on:input="search">
                                            </div>
                                        </div>
                                        <div class="col-md-3 d-none">
                                            <div class="form-group">
                                                <input type="text" class="form-control br" placeholder="Subcategoria"
                                                    name="subcategoria" v-model="produto.subcategoria"
                                                    v-on:input="search">
                                            </div>
                                        </div>
                                    </div>

                                    @csrf
                                </form>
                            </div>
                            <div class="col-md-3">
                                <form action="">
                                    <div class="form-group">
                                        <input type="text" class="form-control br" placeholder="Pesquisa rapida....." name="pesquisa"
                                            v-model="buscar.pesquisa" v-on:input="searchtotal">
                                    </div>
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </section>
                    <table class="table table-hover table-dashed table-striped" id="stock-table" width="100%">
                        <thead class="bg-blue-100" >
                            <tr>
                                <th class="text-center">#</th>
                                <th style="width: 197.153px; white-space: nowrap">&nbsp;&nbsp; Codigo</th>
                                <th style="white-space: nowrap" >  &nbsp;&nbsp;Nome</th>
                                <th style="white-space: nowrap" class="text-right">&nbsp;&nbsp; Qtd. Total &nbsp;&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody v-if="produtos.length!==0" v-html="produtos">
                        </tbody>
                        <tbody v-else> 
                            <td colspan="8" class="text-center text-danger"  >
                                Sem registos!
                            </td>
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-end">

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
