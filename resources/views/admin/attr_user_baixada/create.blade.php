@extends('layout.master')

@section('title')
    Fornecedor
@endsection

@section('content')
  
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                    
                    <div class="ibox-head bg-blue-100">
                        <div class="ibox-title" style="text-transform: uppercase; font-weight: 800; text-align: center">
                            Distribuição/Alocação de Usuarios
                        </div> 
                    </div>

                    <div class="ibox-body">
                        <form action="{{ route('user_attr.store') }}" method="post" class="pt-4" id="form">
                            @csrf

                            <div class="row">

                                <div class="col-md-3">
                                    <label for="">Usuario</label>
                                    <div class="form-group">
                                        <select required name="user_id" id="user_id" class="form-control br custom_select">
                                            <option selected disabled hidden>selecione</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <p class="text-danger">{{ $errors->first('site') }}</p>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="">Provincia</label>
                                    <div class="form-group">
                                        <select required name="provincia_id" id="provincia_id" class="form-control br custom_select">
                                            <option selected disabled hidden>selecione</option>
                                            @foreach ($provincias as $prov)
                                                <option value="{{ $prov->id }}">
                                                    {{ $prov->nome }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <p class="text-danger">{{ $errors->first('provincia_id') }}</p>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="">Projecto/Site</label>
                                    <div class="form-group">
                                        <select required name="site_id" id="site_id" class="form-control br custom_select">
                                            <option selected disabled hidden>selecione</option>
                                            @foreach ($sites as $site)
                                                <option value="{{ $site->id }}">
                                                    {{ $site->site_nome.' - '.$site->projecto_nome }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <p class="text-danger">{{ $errors->first('site') }}</p>
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-3">
                                    <label for="">Viatura</label>
                                    <div class="form-group">
                                        <select required name="viatura_id" id="viatura_id" class="form-control br custom_select">
                                            <option selected disabled hidden>selecione</option>
                                            @foreach ($veiculos as $veiculo)
                                                <option value="{{ $veiculo->id }}">
                                                    {{ $veiculo->matricula }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <p class="text-danger">{{ $errors->first('site') }}</p>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="">Lote</label>
                                    <div class="form-group">
                                        <input required style="border-radius: 7px;" type="text"
                                        class="form-control" value="0" placeholder="Ex: VI" value="{{ old('lote') }}" name="lote">
                                    </div>
                                </div>
                                

                                <hr>
                                <div class="col-md-12 text-right">
                                    <a href="{{ route('user_attr.index') }}" class="btn btn-danger btn-xs btn-rounded">Sair <i class="fa fa-times"></i></a>
                                    
                                    <button class="btn btn-success btn-xs btn-rounded">Salvar <i class="fa fa-send"></i></button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
@endsection
