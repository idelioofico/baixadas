@extends('layouts.app')
@section('content')
    <!-- Main content -->
    <section id="ordem_view" class="content">
        <div class="box box-default">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="top-bar-title padding-bottom" style="text-transform: uppercase; font-weight: 700; color: black">
                            Alocação de Veiculos
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
                        <form action="{{ route('alocacao_store') }}" method="POST">
                            <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                            <div class="card-body">
        
                                <div class="form-row">
        
        
                                    <div class="form-group col-md-6">
                                        <label for="subprojecto">Site</label>
                                        <select required id="subprojecto" name="subprojecto" class="form-control select2" >
                                            <option selected disabled hidden>Selecione</option>
                                            @foreach ($site as $row)
                                                <option value="{{ $row->id }}">{{ $row->nome }}</option>
                                            @endforeach
                                        </select>
                                    </div>
        
                                    <div class="form-group col-md-6">
                                        <label for="veiculo">Selecione as Viaturas: </label>
                                        <select required autofocus name="veiculo[]" id="veiculo" class="form-control select2" >
                                            <option selected disabled hidden>Selecione as viaturas...</option>
                                            @foreach ($veiculo as $data)
                                                <option value="{{ $data->id }}">{{ $data->marca }} - {{ $data->matricula }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    
                                    <div class="col-md-12"> 
                                        <a href="{{ route('veiculo_alocacao') }}" class="btn btn-danger btn-flat"><i
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
