@extends('layout.master')

@section('title')
    Adicionar Produtos
@endsection

@section('content')
   
    <div class="page-content fade-in-up" id="root">
        <div class="row ">
            <div class="col-md-12">
                <div class="ibox">
                    
                    <div class="ibox-head bg-blue-100">
                        <div class="ibox-title" style="text-transform: uppercase; font-weight: 800">Produtos/Items da Transferência de Stock </div>
                    </div>
                    <div class="ibox-body ">
                        <section>
                            {{-- @csrf --}}
                            <div class="row align-items-end">
                                <div class="col-md-4">
                                    <label for="">Produto</label>
                                </div> 
                                <div class="col-md-2">
                                    <label for="">Quantidade</label>
                                </div>
                                <div class="col-md-2 d-none">
                                    <label for="">Custo Unitario</label>
                                </div>

                                <div class="col-md-2 d-none">
                                    <label for="">Valor</label>
                                </div>


                            </div>
                        </section>
                        <section v-for="(produto,index) in produtos" v-bind:key="index">
                            {{-- @csrf --}}
                            <div class="row align-items-end">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select name="produto_id" class="form-control br select2_demo_1 custom_select"
                                            v-bind:id="'produto'+produto.id" disabled>

                                            @foreach ($produtos as $produto)
                                                <option value="{{ $produto->id }}"
                                                    v-bind:selected="produto.produto_id=={!! $produto->id !!}?true:false">
                                                    {{ $produto->nome }} - ({{ $armazem_produto_controller->quantidade_existente($produto->id,$requisicao->empresa_origem) }})
                                                </option>
                                            @endforeach


                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-1 d-none">
                                    <div class="form-group">
                                        <select name="unidade" id="" class="form-control br" style="height: 29px;" disabled>
                                            <option value="1">m</option>
                                        </select>
                                        <p class="text-danger">{{ $errors->first('unidade') }}</p>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input type="number" step="any" v-model="produto.quantidade" name="quantidade"
                                            class="form-control br" style="height: 29px;" placeholder="0.00"
                                            value="{{ old('quantidade') }}" disabled>

                                    </div>
                                </div>
                                <div class="col-md-2 d-none">
                                    <div class="form-group">
                                        <input type="number" v-model="produto.custo_unitario" name="custo_unitario"
                                            class="form-control br" style="height: 29px;" placeholder="0.00"
                                            value="{{ old('custo_unitario') }}" disabled>
                                        <p class="text-danger">{{ $errors->first('custo_unitario') }}</p>
                                    </div>
                                </div>

                                <div class="col-md-2 d-none">
                                    <div class="form-group">
                                        <input type="text" name="valor" v-model="produto.valor" class="form-control br" style="height: 29px;"
                                            placeholder="0.00" value="{{ old('valor') }}" disabled>
                                        <p class="text-danger">{{ $errors->first('valor') }}</p>
                                    </div>
                                </div>


                                <div class="col-md-2 "> 
                                    <div class="form-group"> 
                                        <a class="btn btn-danger btn-sm btn-rounded text-white" v-on:click="deletar(produto.id,$event)"><i
                                                class="fa fa-trash"></i></a>
                                    </div>

                                </div>

                            </div>
                        </section>
                        
                        <form v-on:submit.prevent="addProduto({!! $requisicao_id !!})" action="#" method="post"
                            id="formulario">
                            <div class="row">

                                <input type="hidden" name="empresa_id" value="{{ $requisicao->empresa_origem }}">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select name="produto_id" class="form-control br select2_demo_1 custom_select">

                                            @foreach ($produtos as $produto)
                                                <option value="{{ $produto->id }}"
                                                    v-bind:selected="usedProduct({!! $produto->id !!})?true:false"
                                                    v-if="usedProduct({!! $produto->id !!})">
                                                    {{ $produto->nome }} - ({{ $armazem_produto_controller->quantidade_existente($produto->id,$requisicao->empresa_origem) }})
                                                </option>
                                            @endforeach


                                        </select>
                                        <p class="text-danger" v-text="errors.produto_id?errors.produto_id[0]:''">
                                            {{ $errors->first('produto_id') }}</p>
                                    </div>
                                </div>

                                <div class="col-md-1 d-none">
                                    <div class="form-group">
                                        <select name="unidade" id="" class="form-control br" style="height: 29px;">
                                            <option value="1">m</option>
                                        </select>
                                        <p class="text-danger">{{ $errors->first('unidade') }}</p>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input type="number" step="any" name="quantidade" class="form-control br" style="height: 29px;"
                                            placeholder="0.00" value="{{ old('quantidade') }}">
                                        <p class="text-danger" v-text="errors.quantidade?errors.quantidade[0]:''">
                                            {{ $errors->first('quantidade') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-2 d-none">
                                    <div class="form-group">
                                        <input type="number" name="custo_unitario" class="form-control br" style="height: 29px;"
                                            placeholder="0.00" value="{{ old('custo_unitario') }}">
                                        <p class="text-danger">{{ $errors->first('custo_unitario') }}</p>
                                    </div>
                                </div>

                                <div class="col-md-2 d-none">
                                    <div class="form-group">
                                        <input type="text" name="valor" class="form-control br" style="height: 29px;" placeholder="0.00"
                                            value="{{ old('valor') }}">
                                        <p class="text-danger">{{ $errors->first('valor') }}</p>
                                    </div>
                                </div>


                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button class="btn btn-warning btn-md btn-rounded"><i class="fa fa-plus"></i></button>
                                    </div>

                                </div>
                            </div>
                        </form>
                        <div class="row mt-5">
                            <div class="col-md-10">
                                @if ($editar)
                                    <a href="{{ route('requisicao.show', $requisicao_id) }}"
                                        class="btn btn-secondary">Voltar</a>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <form action="{{ route('transferencias_produto.verificar', ['id' => $requisicao_id]) }}" method="GET" style="text-align: end;">
                                    @csrf
                                    <input type="hidden" name="editar" value="{{ $editar }}">
                                    <button class="btn btn-success btn-md btn-rounded pl-4 pr-4">Salvar <i class="fa fa-check"></i></button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('javascript')
    <script>
        const guiaId = {!! $requisicao_id !!}
        let root = new Vue({
            el: '#root',
            data: {
                produtos: [],
                errors: {
                    quantidade: '',
                    produto_id: ''
                },

            },
            mounted: function() {
                this.index();
            },
            methods: {
                addProduto(id) {
                    const csrfToken = document.getElementsByName('_token')[0].value;
                    let formData = new FormData(document.getElementById('formulario'))
                    axios.post(`/transferencias_produto/${id}/produto`, formData, {
                        headers: {
                            "X-CSRF-Token": csrfToken
                        }
                    }).then(doc => { 
                        this.index();
                        this.errors = {}
                        Array.from(document.getElementsByTagName('input')).forEach((input) => {
                            if (input.type != 'hidden') {
                                input.value = ''
                            }
                        }) 
                    }).catch(error => {
                        console.log(error.response)
                        this.errors = error.response.data.errors
                    })
                },
                index() {
                    const csrfToken = document.getElementsByName('_token')[0].value;

                    axios.get(`/transferencias_produto/${guiaId}/produto/index`, {
                        headers: {
                            "X-CSRF-Token": csrfToken
                        }
                    }).then(doc => {
                        this.produtos = doc.data.produtos 
                    }).catch(error => {
                        console.log(error.response)
                        this.errors = error.response.data.errors
                    })
                },
                deletar(id, event) {
                    event.preventDefault();
                    const csrfToken = document.getElementsByName('_token')[0].value;
                    let formData = new FormData()
                    formData.append('_method', 'delete')
                    axios.post(`/transferencias_produto/${guiaId}/produto/${id}/destroy`, formData, {
                        headers: {
                            "X-CSRF-Token": csrfToken
                        }
                    }).then(doc => {
                        this.index();
                    }).catch(error => {
                        console.log(error.response)
                        this.errors = error.response.data.errors
                    })
                },
                editar(produto, event) {
                    event.preventDefault()
                    let linha = event.currentTarget.parentNode.parentNode.parentNode
                    if (event.currentTarget.children[0].className === 'fa fa-edit') {
                        Array.from(linha.children).forEach((elemento, index) => {
                            if (index <= 4) {
                                elemento.children[0].children[0].disabled = false
                            }

                        })

                        event.currentTarget.children[0].className = 'fa fa-check'
                        event.currentTarget.className = "btn btn-success text-white"
                        $('.select2_demo_1').select2()
                    } else if (event.currentTarget.children[0].className === 'fa fa-check') {
                        Array.from(linha.children).forEach((elemento, index) => {
                            if (index <= 4) {
                                elemento.children[0].children[0].disabled = true
                            }

                        })
                        produto.produto_id = document.getElementById('produto' + produto.id).value
                        const csrfToken = document.getElementsByName('_token')[0].value;

                        axios.put(`/transferencias_produto/${guiaId}/produto/${produto.id}`, produto, {
                            headers: {
                                "X-CSRF-Token": csrfToken
                            }
                        }).then(doc => {
                            this.index();
                            this.errors = {}
                        }).catch(error => {
                            console.log(error.response)
                            this.errors = error.response.data.errors
                        })

                        event.currentTarget.children[0].className = 'fa fa-edit'
                        event.currentTarget.className = "btn btn-warning text-white"
                    }

                },
                usedProduct(product_id) {
                    let dado = true
                    this.produtos.map(produto => {
                        if (produto.produto_id == product_id) {
                            dado = false
                        }
                    })
                    return dado
                }
            }

        })
    </script>
@endpush
