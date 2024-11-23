@extends('layout.master')

@section('title')
    Fornecedor
@endsection
@php
    $j = 1;
@endphp

@section('content')
    <div class="page-heading">
        <h1 class="page-title">Dados do Fornecedor: {{ $fornecedor->nome }}</h1>
        <hr>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html"><i class="la la-home font-20"></i></a>
            </li>
        </ol>
    </div>


    <section id="root">
        <div class="page-content fade-in-up">
            <div class="row">
                <div class="col-md-12">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title"> {{ $fornecedor->nome }}</div>

                            <div class="ibox-tools">
                                <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                            </div>
                        </div>
                        <div class="ibox-body">
                            <form class="pt-4" id="form">

                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Empresa</label>
                                        <div class="form-group">
                                            <input disabled type="text" name="nome" class="form-control br"
                                                placeholder=".........." value="{{ old('nome') ?? $fornecedor->nome }}">
                                            <p class="text-danger">{{ $errors->first('nome') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Email</label>
                                        <div class="form-group">
                                            <input disabled type="email" name="email" class="form-control br"
                                                placeholder=".........." value="{{ old('email') ?? $fornecedor->email }}">
                                            <p class="text-danger">{{ $errors->first('email') }}</p>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <label for="">Telefone</label>
                                        <div class="form-group">
                                            <input disabled type="number" name="telefone" class="form-control br"
                                                placeholder=".........."
                                                value="{{ old('telefone') ?? $fornecedor->telefone }}">
                                            <p class="text-danger">{{ $errors->first('telefone') }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nuit</label>
                                            <input type="text" name="nuit" class="form-control br"
                                                placeholder=".........." value="{{ old('nuit') ?? $fornecedor->nuit }}"
                                                disabled>
                                            <p class="text-danger">{{ $errors->first('nuit') }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="">Endereço </label>
                                        <div class="form-group">
                                            <input disabled type="text" name="endereco" class="form-control br"
                                                placeholder=".......... "
                                                value="{{ old('endereco') ?? $fornecedor->endereco }}">
                                            <p class="text-danger">{{ $errors->first('endereco') }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="">País</label>
                                        <div class="form-group">
                                            <input type="text" name="pais" class="form-control br"
                                                placeholder=".........." value="{{ old('pais') ?? $fornecedor->pais }}"
                                                disabled>
                                            <p class="text-danger">{{ $errors->first('pais') }}</p>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <label for="">Província</label>
                                        <div class="form-group">
                                            <input type="text" name="provincia" class="form-control br"
                                                placeholder=".........."
                                                value="{{ old('provincia') ?? $fornecedor->provincia }}" disabled>
                                            <p class="text-danger">{{ $errors->first('provincia') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Nome do Representante</label>
                                        <div class="form-group">
                                            <input disabled type="text" name="nome_do_representante"
                                                class="form-control br" placeholder=".........."
                                                value="{{ old('nome_do_representante') ?? $fornecedor->nome_do_representante }}">
                                            <p class="text-danger">{{ $errors->first('nome_do_representante') }}</p>
                                        </div>
                                    </div>




                                    <div class="col-md-4">
                                        <label for="">Email do Representante</label>
                                        <div class="form-group">
                                            <input disabled type="email" name="email_do_representante"
                                                class="form-control br" placeholder=".........."
                                                value="{{ old('email_do_representante') ?? $fornecedor->email_do_representante }}">
                                            <p class="text-danger">{{ $errors->first('email_do_representante') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Telefone do Representante</label>
                                        <div class="form-group">
                                            <input disabled type="number" name="telefone_do_representante"
                                                class="form-control br" placeholder=".........."
                                                value="{{ old('telefone_do_representante') ?? $fornecedor->telefone_do_representante }}">
                                            <p class="text-danger">{{ $errors->first('telefone_do_representante') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </form>


                            <div class="row">
                                <div class="col-md-6">
                                    {{-- <a class="btn btn-secondary" href="{{ route('fornecedor.index') }}">Voltar</a> --}}
                                </div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    @if (in_array([5, 4], \Session::get('USER_PERMISSION'), true))
                                        @if (Auth::user()->tipo_de_usuario == 1 || Auth::user()->tipo_de_usuario == 2)
                                            <div class=" mr-3">
                                                <a class="btn btn-warning d-none"
                                                    href="{{ route('fornecedor.edit', $fornecedor->id) }}">Editar</a>

                                                <button type="button" class="btn-sm btn btn-warning btn-md btn-rounded"
                                                    v-on:click="showModalEditar($event)">Editar</button>
                                            </div>
                                        @endif
                                    @endif
                                    @if (in_array([5, 5], \Session::get('USER_PERMISSION'), true))
                                        @if (Auth::user()->tipo_de_usuario == 1)
                                            <div>
                                                <form class="d-none"
                                                    action="{{ route('fornecedor.destroy', $fornecedor->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn-sm btn btn-danger">Remover do sistema</button>
                                                </form>
                                                <button type="button" class="btn-sm btn btn-danger btn-md btn-rounded"
                                                    v-on:click="showModalDeletar($event)">Remover do sistema</button>
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
                        <div class="ibox-head">
                            <div class="ibox-title">Listagem de Categorias</div>
                            <div class=" ">
                                <a href="{{ route('fornecedorCategoria.create', $fornecedor->id) }}"
                                    class="btn btn-sm btn-success btn-rounded "><i class="fa fa-plus"></i> Novo </a>
                            </div>
                        </div>
                        <div class="ibox-body">

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Subcategoria</th>
                                            <th>Categoria</th>
                                            @if (Auth::user()->tipo_de_usuario == 1)
                                                <th class="text-center">Deletar</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categorias as $categoria)
                                            <tr>
                                                <td>{{ $j++ }}</td>
                                                <td>{{ $categoria->categoria->nome }}</td>
                                                <td>{{ $categoria->categoria->parent_id == 0 ? '-' : $categoria->categoria->father->nome }}
                                                </td>
                                                {{-- <td><a href="{{ route('categoria.edit', $categoria->id) }}"
                                                    class="btn btn-warning">Editar</a></td> --}}
                                                @if (Auth::user()->tipo_de_usuario == 1)
                                                    <td class="text-center">

                                                        <form class="d-none"
                                                            action="{{ route('fornecedorCategoria.destroy', ['fornecedor_id' => $fornecedor->id, 'categoria_id' => $categoria->id]) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-danger">Deletar</button>
                                                        </form>
                                                        <button type="button" class="btn btn-danger btn-rounded"
                                                            v-on:click="showModalDeletar($event)"><i
                                                                class="fa fa-trash"></i></button>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>




                            </div>
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
        <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-center" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Alerta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4>Tem certeza que pretende deletar</h4>
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
