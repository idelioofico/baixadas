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
                            Distribuição/Alocação de Viaturas
                        </div> 
                    </div>

                    <div class="ibox-body">
                        <form action="{{ route('agrp_viatura.store') }}" method="post" class="pt-4" id="form">
                            @csrf

                            <div class="row">

                                <div class="col-md-6">
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
                                        <p class="text-danger">{{ $errors->first('site') }}</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="">Viatura</label>
                                    <div class="form-group">
                                        <select required name="veiculo_id" id="veiculo_id" class="form-control br custom_select">
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


                                <div class="col-md-12 text-right">
                                    <button class="btn btn-success btn-sm btn-rounded">Salvar <i class="fa fa-send"></i></button>
                                    <a href="{{ route('agrp_viatura.index') }}" class="btn btn-danger btn-sm btn-rounded">Sair <i class="fa fa-times"></i></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
@endsection
