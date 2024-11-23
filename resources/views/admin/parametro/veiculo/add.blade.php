@extends('layouts.app')
@section('content')
    <!-- Main content -->
    <section id="ordem_view" class="content">
        <div class="box box-default">
            <div class="box-body" style="background: linear-gradient(45deg, #006def, transparent);;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="top-bar-title padding-bottom" style="text-transform: uppercase; font-weight: 700; color: white; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">
                            <i class="fa fa-truck"></i> Registo de Viatura
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('veiculo.store') }}" enctype="multipart/form-data" method="POST">
                            <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                            <div class="card-body">
        
                                <div class="form-row">
        
                                    <div class="form-group col-md-3">
                                        <label for="empresa">Empresa</label>
                                        <select required id="empresa_id" value="{{ old('empresa_id') }}"
                                            name="empresa_id" class="form-control">
                                            @foreach ($empresas as $empresa)
                                                <option value="{{ $empresa->id }}">{{ $empresa->nome }}</option>
                                            @endforeach
                                        </select>
                                    </div>
        
                                    <div class="form-group col-md-3">
                                        <label for="marca">Marca</label> 
                                        <select required id="marca" value="{{ old('marca') }}"
                                            name="marca" class="form-control">
                                            <option value="n/a">N/A</option>
                                            @foreach ($marcas as $marca)
                                                <option value="{{ $marca->nome }}">{{ $marca->nome }}</option>
                                            @endforeach
                                        </select>
                                    </div>
        
        
                                    <div class="form-group col-md-3">
                                        <label for="modelo">Modelo</label> 
                                        <select required id="modelo" value="{{ old('modelo') }}"
                                            name="modelo" class="form-control">
                                            <option value="n/a">N/A</option>
                                            @foreach ($modelos as $modelo)
                                                <option value="{{ $modelo->nome }}">{{ $modelo->nome }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                  
                                    <div class="form-group col-md-3">
                                        <label for="tipo">Tipo</label> 
                                        <select required id="tipo" value="{{ old('tipo') }}"
                                        name="tipo" class="form-control">
                                            <option value="Ligeiro">Ligeiro</option>
                                            <option value="Pesado">Pesado</option>
                                            <option value="4x4">4x4</option>
                                            <option value="Camião Grua">Camião Grua</option>
                                            <option value="Maquina (MAQ.)">Maquina (MAQ.)</option>
                                        </select>
                                    </div>
        
                                    <div class="form-group col-md-3">
                                        <label for="matricula">Matricula</label>
                                        <input type="text" required class="form-control" id="matricula"
                                            value="{{ old('matricula') }}" name="matricula" placeholder=".........">
                                    </div>
        
                                    <div class="form-group col-md-3">
                                        <label for="ano">Ano de Fabrico</label>
                                        <input type="number" class="form-control" id="ano" value="{{ old('ano') }}" name="ano"
                                            placeholder=".........">
                                    </div>
        
                                    <div class="form-group col-md-3">
                                        <label for="data_registo">Data de Registo</label>
                                        <input type="date" value="{{ date('Y-m-d') }}" class="form-control" id="data_registo" name="data_registo"
                                            placeholder=".........">
                                    </div>
        
                                    <div class="form-group col-md-3">
                                        <label for="nr_livrete">Nr. Livrete</label>
                                        <input type="text" value="{{ old('nr_livrete') }}" class="form-control" id="nr_livrete" name="nr_livrete"
                                            placeholder="-">
                                    </div>
        
                                    <div class="form-group col-md-3">
                                        <label for="nr_motor">Nr. Motor</label>
                                        <input type="text" value="{{ old('nr_motor') }}" class="form-control" id="nr_motor" name="nr_motor"
                                            placeholder="-">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="tipo_combustivel">Tipo de Conbustivel</label>
                                        <select required id="tipo_combustivel" value="{{ old('tipo_combustivel') }}"
                                            name="tipo_combustivel" class="form-control">
                                            @foreach ($combustivel as $row)
                                                <option value="{{ $row->id }}">{{ $row->nome }}</option>
                                            @endforeach
                                        </select>
                                    </div>
        
                                    <div class="form-group col-md-3">
                                        <label for="data_aquisicao">Data de Compra</label>
                                        <input type="date" value="{{ date('Y-m-d') }}" class="form-control" id="data_aquisicao" name="data_aquisicao"
                                            >
                                    </div>
        
                                    <div class="form-group col-md-3">
                                        <label for="valor_aquisicao">Valor de Compra</label>
                                        <input type="text" value="{{ old('valor_aquisicao') }}" class="form-control" id="valor_aquisicao" name="valor_aquisicao"
                                            placeholder="0,0">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="percentual_amortizacao">Depreciação</label>
                                        <input type="number" value="{{ old('percentual_amortizacao') }}" class="form-control" id="percentual_amortizacao" name="percentual_amortizacao"
                                            placeholder="%">
                                    </div>

        
                                    <div class="form-group col-md-3">
                                        <label for="data_venda">Data de Venda <span><i class="text-danger">(Caso tenha sido vendida/oferecida)</i></span></label>
                                        <input type="date" value="{{ date('Y-m-d') }}" class="form-control" id="data_venda" name="data_venda">
                                    </div>

                                    
                                    <div class="form-group col-md-3">
                                        <label for="valor_venda">Valor de Venda <span><i class="text-danger">(Caso tenha sido vendida/oferecida)</i></span></label>
                                        <input type="text" value="{{ old('valor_venda') }}" class="form-control" id="valor_venda" name="valor_venda" >
                                    </div>
        
                                    <div class="form-group col-md-3">
                                        <label for="porcentagem_amortizacao">Estado da Viatura</label>
                                        <select name="activo" id="activo" class="form-control">
                                            <option value="1">Activa</option>
                                            <option value="0">Inactiva</option>
                                        </select>
                                    </div>

                                    
                                    <div class="form-group col-md-3">
                                        <label for="anexo">Anexo <span><i class="text-danger">(livrete, titulo de propriedade, etc...)</i></span></label>
                                        <input type="file" class="form-control" id="anexo" name="anexo" >
                                    </div>
        
                                    
                                    <div class="form-group col-md-3">
                                        <label for="tanque">Qt. Tanque (litros)</label> 
                                        <input type="text" value="{{ old('tanque') }}" placeholder="Ex: 60L" class="form-control" id="tanque" name="tanque" >
                                    </div>
                                    
                                    
                                    <div class="form-group col-md-6">
                                        <label for="observacoes">Observações</label> 
                                        <input type="text" value="{{ old('observacoes') }}" class="form-control" id="observacoes" name="observacoes" >
                                    </div>

                                    
                                    <div class="col-md-12"> 
                                        <a href="{{ route('veiculo.index', ['tipo' => 1 ]) }}" class="btn btn-danger btn-flat"><i
                                                class="fa fa-times"></i></a>
                                        <button type="submit" class="btn btn-success btn-flat pull-right"
                                            id=" ">{{ trans('message.form.submit') }} <i class="fa fa-send"></i></button>
                                    </div>
        
                                </div>
        
                            </div>
        
                        </form>
                    </div>
                    <!-- /.row -->
                </div>
            </div>

    </section>
@endsection
@section('js') 
@endsection
