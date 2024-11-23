<div class="page-content fade-in-up" id="produto">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">Listagem de Produtos </div>
                    <div class=" ">
                        <a class="btn btn-sm btn-success" href="{{ route('produto.create') }}"><i class="fa fa-plus"></i> Adicionar Produtos</a>
                    </div>
                </div>
                <div class="ibox-body">
                    <section>
                        <div class="row justify-content-between">
                            <div class="col-md-3">
                                <form action="">
                                    <div class="form-group">
                                        <input style="  border-radius: 13px;" type="text" class="form-control " placeholder="Pesquisa" name="pesquisa"
                                            v-model="buscar.pesquisa" v-on:input="searchtotal">
                                    </div>
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </section>
                    <table class="table table-hover" id="produto-table" width="100%">
                        <thead class="bg-blue-100" >
                            <tr>
                                <th>#</th>
                                <th class="text-center">Codigo</th>
                                <th>Nome</th>
                                <th>Categoria</th>
                                <th>Subcategoria</th>
                                <th>Localização</th>
                                <th class="text-center">Detalhes</th> 
                            </tr>
                        </thead>
                        <tbody v-if="produtos.length!==0">
                            <tr v-for="(produto, index) in produtos">
                                <td v-text="index+1"></td>
                                <td class="text-center" v-text="produto.codigo"></td>
                                <td v-text="produto.nome"></td>

                                <td v-text="produto.categoria.father.nome"></td>
                                <td v-text="produto.categoria.nome"></td>
                                <td v-text="produto.localozacao_no_armazem"></td>
                                <td class="text-center">
                                    <a v-bind:href="`produto/${produto.id}/show`" class="btn btn-success btn-sm btn-rounded">
                                        Detalhes <i class="fa fa-eye"></i>
                                    </a>
                                </td>

                            </tr>
                        </tbody>
                        <tbody v-else>
                            <tr>
                                <td colspan="30" class="text-center bg-blue-100">
                                    Sem registos!
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
