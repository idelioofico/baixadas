@extends('layouts.app')
@section('content')
    <!-- Main content -->
    <section id="ordem_view" class="content">
        <div class="box box-default">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="top-bar-title padding-bottom" style="text-transform: uppercase; font-weight: 700; color: black">Atualização de Veiculo - {{ $row->matricula }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('veiculo.update', ['id' => $row->id]) }}" enctype="multipart/form-data" method="POST">
                            <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">

                            <div class="form-row">
        
                                <div class="form-group col-md-3">
                                    <label for="empresa">Empresa</label>
                                    <select required id="empresa_id" value="{{ old('empresa_id') }}"
                                        name="empresa_id" class="form-control">
                                        @foreach ($empresas as $empresa)
                                            <option {{ ($row->empresa_id == $empresa->id) ? 'Selected' : '' }} value="{{ $empresa->id }}">{{ $empresa->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
     
                                <div class="form-group col-md-3">
                                    <label for="marca">Marca</label> 
                                    <select required id="marca" value="{{ old('marca') }}"
                                        name="marca" class="form-control">
                                        <option value="n/a">N/A</option>
                                        @foreach ($marcas as $mar)
                                            <option {{ ($row->marca == $mar->nome) ? 'Selected' : '' }} value="{{ $mar->nome }}">{{ $mar->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
    
                                <div class="form-group col-md-3">
                                    <label for="modelo">Modelo</label>
                                    <input type="text" class="form-control" id="modelo" value="{{ $row->modelo }}"
                                        name="modelo" placeholder=".........">
                                </div>
    
                                <div class="form-group col-md-3">
                                    <label for="tipo">Tipo</label> 
                                    <select required id="tipo" value="{{ old('tipo') }}"
                                    name="tipo" class="form-control">
                                        <option {{ ($row->tipo = 'Ligeiro') ? 'Selected' : '' }} value="Ligeiro">Ligeiro</option>
                                        <option {{ ($row->tipo = 'Pesado') ? 'Selected' : '' }} value="Pesado">Pesado</option>
                                        <option {{ ($row->tipo = '4x4') ? 'Selected' : '' }} value="4x4">4x4</option>
                                        <option {{ ($row->tipo = 'Camião Grua') ? 'Selected' : '' }} value="Camião Grua">Camião Grua</option>
                                        <option {{ ($row->tipo = 'Maquina (MAQ.)') ? 'Selected' : '' }} value="Maquina (MAQ.)">
                                            Maquina (MAQ.)
                                        </option>
                                    </select>
                                </div>
    
                                <div class="form-group col-md-3">
                                    <label for="matricula">Matricula</label>
                                    <input type="text" required class="form-control" id="matricula"
                                        value="{{ $row->matricula }}" name="matricula" placeholder=".........">
                                </div>
    
                                <div class="form-group col-md-3">
                                    <label for="ano">Ano de Fabrico</label>
                                    <input type="number" class="form-control" id="ano" value="{{ $row->ano }}" name="ano"
                                        placeholder=".........">
                                </div>
    
                                <div class="form-group col-md-3">
                                    <label for="data_registo">Data de Registo</label>
                                    <input type="date" value="{{ $row->data_registo }}" class="form-control" id="data_registo" name="data_registo"
                                        placeholder=".........">
                                </div>
    
                                <div class="form-group col-md-3">
                                    <label for="nr_livrete">Nr. Livrete</label>
                                    <input type="text" value="{{ $row->nr_livrete }}" class="form-control" id="nr_livrete" name="nr_livrete"
                                        placeholder="-">
                                </div>
    
                                <div class="form-group col-md-3">
                                    <label for="nr_motor">Nr. Motor</label>
                                    <input type="text" value="{{ $row->nr_motor }}" class="form-control" id="nr_motor" name="nr_motor"
                                        placeholder="-">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="combustivel">Conbustivel</label>
                                    <select required id="combustivel" value="{{ old('combustivel') }}"
                                        name="combustivel" class="form-control">
                                        @foreach ($combustivel as $conbu)
                                            <option {{ ($row->tipo_combustivel == $conbu->id) ? 'selected' : '' }} value="{{ $conbu->id }}">
                                                {{ $conbu->nome }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
    
                                <div class="form-group col-md-3">
                                    <label for="data_aquisicao">Data de Compra</label>
                                    <input type="date" value="{{ $row->data_aquisicao }}" class="form-control" id="data_aquisicao" name="data_aquisicao"
                                        >
                                </div>
    
                                <div class="form-group col-md-3">
                                    <label for="valor_aquisicao">Valor de Compra</label>
                                    <input type="text" class="form-control" id="valor_aquisicao" name="valor_aquisicao"
                                        placeholder="0,0" value="{{ $row->valor_aquisicao }}">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="percentual_amortizacao">Depreciação</label>
                                    <input type="number" class="form-control" value="{{ $row->percentual_amortizacao }}" id="percentual_amortizacao" name="percentual_amortizacao"
                                        placeholder="%">
                                </div>

    
                                <div class="form-group col-md-3">
                                    <label for="data_venda">Data de Venda <span><i class="text-danger">(Caso tenha sido vendida/oferecida)</i></span></label>
                                    <input type="date"  class="form-control" value="{{ $row->data_venda }}" id="data_venda" name="data_venda">
                                </div>

                                
                                <div class="form-group col-md-3">
                                    <label for="valor_venda">Valor de Venda <span><i class="text-danger">(Caso tenha sido vendida/oferecida)</i></span></label>
                                    <input type="text" class="form-control" value="{{ $row->valor_venda }}" id="valor_venda" name="valor_venda" >
                                </div>
    
                                <div class="form-group col-md-3">
                                    <label for="porcentagem_amortizacao">Estado da Viatura</label>
                                    <select name="activo" id="activo" class="form-control">
                                        <option {{ ($row->activo == 1) ? 'selected' : '' }} value="1">Activa</option>
                                        <option {{ ($row->activo == 0) ? 'selected' : '' }} value="0">Inactiva</option>
                                    </select>
                                </div>

                                
                                <div class="form-group col-md-3">
                                    <label for="anexo">Anexo <span><i class="text-danger">(livrete, titulo de propriedade, etc...)</i></span></label>
                                    <input type="file" class="form-control" id="anexo" name="anexo" >
                                </div>
    
                                <div class="form-group col-md-3">
                                    <label for="tanque">Qt. Tanque (litros)</label> 
                                    <input type="text" value="{{ $row->tanque }}" placeholder="Ex: 60L" class="form-control" id="tanque" name="tanque" >
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="observacoes">Observações</label> 
                                    <input type="text" value="{{ $row->observacoes }}" class="form-control" id="observacoes" name="observacoes" >
                                </div>

                                
                                <div class="col-md-12"> 
                                    <a href="{{ route('veiculo.index', ['tipo' => 1 ]) }}" class="btn btn-danger btn-sm btn-flat"><i
                                            class="fa fa-back"></i>Sair</a>
                                    <button type="submit" class="btn btn-success btn-flat pull-right"
                                        id=" ">Atualizar <i class="fa fa-edit"></i></button>
                                </div>
    
                            </div>


                        </form>
                    </div>
                    <!-- /.row -->
                </div>
            </div>

    </section>
@endsection
