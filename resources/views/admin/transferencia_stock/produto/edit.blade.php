@extends('layout.master')

@section('title')
    Editar Produto
@endsection

@section('content')
    <div class="page-heading">
        <h1 class="page-title">Editar Produto</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html"><i class="la la-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Editar Produto</li>
        </ol>
    </div>



    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Editar </div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <form action="{{ route('requisicaoproduto.update',['requisicao_id'=>$requisicao_id,'id'=>$requisicaoProduto->id]) }}" method="post" class="pt-4">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Produto</label>
                                    <div class="form-group">
                                        <select name="produto_id" class="form-control select2_demo_1 custom_select"
                                            id="produto_id">

                                            @foreach ($produtos as $produto)
                                                <option value="{{ $produto->id }}" {{$requisicaoProduto->produto_id==$produto->id?'selected':''}}>{{ $produto->nome }}
                                                </option>
                                            @endforeach


                                        </select>
                                        <p class="text-danger">{{ $errors->first('produto_id') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Unidade</label>
                                    <div class="form-group">
                                       <select name="unidade" id="" class="form-control">
                                           <option value="1">m</option>
                                       </select>
                                        <p class="text-danger">{{ $errors->first('unidade') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Quantidade</label>
                                    <div class="form-group">
                                        <input type="number" name="quantidade" class="form-control" placeholder="Quantidade"
                                            value="{{ old('quantidade') ?? $requisicaoProduto->quantidade }}">
                                        <p class="text-danger">{{ $errors->first('quantidade') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Custo Unitario</label>
                                    <div class="form-group">
                                        <input type="number" name="custo_unitario" class="form-control"
                                            placeholder="Custo Unitario"
                                            value="{{ old('custo_unitario') ?? $requisicaoProduto->custo_unitario }}">
                                        <p class="text-danger">{{ $errors->first('custo_unitario') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Valor</label>
                                    <div class="form-group">
                                        <input type="text" name="valor" class="form-control" placeholder="Valor"
                                            value="{{ old('valor') ?? $requisicaoProduto->valor }}">
                                        <p class="text-danger">{{ $errors->first('valor') }}</p>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button class="btn btn-primary">Salvar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
