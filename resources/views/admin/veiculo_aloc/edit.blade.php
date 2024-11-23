@extends('layout.master')

@section('title')
    Fornecedor
@endsection

@section('content')
    <div class="page-heading">
        <h1 class="page-title">Editar Fornecedor: {{ $fornecedor->nome }}</h1> <hr>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html"><i class="la la-home font-20"></i></a>
            </li> 
        </ol>
    </div>



    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Editar fornecedor</div>

                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <form action="{{ route('fornecedor.update', $fornecedor->id) }}" method="post"
                            class="pt-4" id="form">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Empresa</label>
                                    <div class="form-group">
                                        <input type="text" name="nome" class="form-control br"
                                            placeholder=".........."
                                            value="{{ old('nome') ?? $fornecedor->nome }}">
                                        <p class="text-danger">{{ $errors->first('nome') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Email</label>
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control br" placeholder=".........."
                                            value="{{ old('email') ?? $fornecedor->email }}">
                                        <p class="text-danger">{{ $errors->first('email') }}</p>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <label for="">Telefone</label>
                                    <div class="form-group">
                                        <input type="number" name="telefone" class="form-control br" placeholder=".........."
                                            value="{{ old('telefone') ?? $fornecedor->telefone }}">
                                        <p class="text-danger">{{ $errors->first('telefone') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Nuit</label>
                                        <input type="text" name="nuit" class="form-control br" placeholder=".........."
                                            value="{{ old('nuit') ?? $fornecedor->nuit }}">
                                        <p class="text-danger">{{ $errors->first('nuit') }}</p>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <label for="">Endereço </label>
                                    <div class="form-group">
                                        <input type="text" name="endereco" class="form-control br" placeholder=".......... "
                                            value="{{ old('endereco') ?? $fornecedor->endereco }}">
                                        <p class="text-danger">{{ $errors->first('endereco') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">País</label>
                                    <div class="form-group">
                                        <input type="text" name="pais" class="form-control br" placeholder=".........."
                                            value="{{ old('pais') ?? $fornecedor->pais }}">
                                        <p class="text-danger">{{ $errors->first('pais') }}</p>
                                    </div>
                                </div>



                                <div class="col-md-4">
                                    <label for="">Província</label>
                                    <div class="form-group">
                                        <input type="text" name="provincia" class="form-control br" placeholder=".........."
                                            value="{{ old('provincia') ?? $fornecedor->provincia }}">
                                        <p class="text-danger">{{ $errors->first('provincia') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Nome do Representante</label>
                                    <div class="form-group">
                                        <input type="text" name="nome_do_representante" class="form-control br"
                                            placeholder=".........."
                                            value="{{ old('nome_do_representante') ?? $fornecedor->nome_do_representante }}">
                                        <p class="text-danger">{{ $errors->first('nome_do_representante') }}</p>
                                    </div>
                                </div>



                                <div class="col-md-4">
                                    <label for="">Email do Representante</label>
                                    <div class="form-group">
                                        <input type="email" name="email_do_representante" class="form-control br"
                                            placeholder=".........."
                                            value="{{ old('email_do_representante') ?? $fornecedor->email_do_representante }}">
                                        <p class="text-danger">{{ $errors->first('email_do_representante') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Telefone do Representante</label>
                                    <div class="form-group">
                                        <input type="number" name="telefone_do_representante" class="form-control br"
                                            placeholder=".........."
                                            value="{{ old('telefone_do_representante') ?? $fornecedor->telefone_do_representante }}">
                                        <p class="text-danger">{{ $errors->first('telefone_do_representante') }}</p>
                                    </div>
                                </div>



                                <div class="col-md-12 text-right">
                                    <button class="btn btn-success btn-rounded">Salvar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
