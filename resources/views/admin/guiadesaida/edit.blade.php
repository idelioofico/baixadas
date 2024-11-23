@extends('layout.master')

@section('title')
    Editar Guia de Saida
@endsection

@section('content')
    <div class="page-heading">
        <h1 class="page-title">Editar Guia de Saida Numero {{ $guiasaida->numero_do_folheto }}</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html"><i class="la la-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Editar Guia Numero {{ $guiasaida->numero_do_folheto }}</li>
        </ol>
    </div>

    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Editar Guia De Saida Numero {{ $guiasaida->numero_do_folheto }}</div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <form action="{{ route('guiasaida.update', $guiasaida->id) }}" method="post"
                            class="pt-4">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Numero de Guia</label>
                                    <div class="form-group">
                                        <input type="text" name="numero_do_folheto" class="form-control"
                                            placeholder="Numero de Guia"
                                            value="{{ old('numero_do_folheto') ?? $guiasaida->numero_do_folheto }}" disabled>
                                        <p class="text-danger">{{ $errors->first('numero_do_folheto') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Requisicao Ao Armazem Numero</label>
                                    <div class="form-group">
                                        <select name="requisicaoArmazem_id" class="form-control select2_demo_1"
                                            id="requisicaoArmazem_id" disabled>

                                            @foreach ($requisicaoArmazems as $requisicaoArmazem)
                                                <option value="{{ $requisicaoArmazem->id }}"
                                                    {{ $requisicaoArmazem->id == $guiasaida->requisicaoArmazem_id ? 'selected' : '' }}>
                                                    {{ $requisicaoArmazem->numero_do_folheto }}
                                                </option>
                                            @endforeach


                                        </select>
                                        <p class="text-danger">{{ $errors->first('requisicaoArmazem_id') }}</p>

                                        <input type="hidden" name="guiaSaidaLast"
                                            value="{{ $guiasaida->requisicaoArmazem_id }}">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <label for="">Destino do Material</label>
                                    <div class="form-group">
                                        <input type="text" name="destino_do_material" class="form-control"
                                            placeholder="Destino do Material"
                                            value="{{ old('destino_do_material') ?? $guiasaida->destino_do_material }}">
                                        <p class="text-danger">{{ $errors->first('destino_do_material') }}</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="">Requisitante</label>
                                    <div class="form-group">
                                        <input type="text" name="requisitante" class="form-control"
                                            placeholder="Requisitante"
                                            value="{{ old('requisitante') ?? $guiasaida->requisitante }}">
                                        <p class="text-danger">{{ $errors->first('requisitante') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Departamento</label>
                                    <div class="form-group">
                                        <input type="text" name="departamento" class="form-control"
                                            placeholder="Departamento"
                                            value="{{ old('departamento') ?? $guiasaida->departamento }}">
                                        <p class="text-danger">{{ $errors->first('departamento') }}</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="">Documentos Assoc</label>
                                    <div class="form-group">
                                        <input type="text" name="documentos_assoc" class="form-control"
                                            placeholder="Documentos Assoc"
                                            value="{{ old('documentos_assoc') ?? $guiasaida->documentos_assoc }}">
                                        <p class="text-danger">{{ $errors->first('documentos_assoc') }}</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="">Data do Documento</label>
                                    <div class="form-group">
                                        <input type="date" name="data_do_documento" class="form-control"
                                            placeholder="Data do Documento"
                                            value="{{ old('data_do_documento') ?? $guiasaida->data_do_documento }}">
                                        <p class="text-danger">{{ $errors->first('data_do_documento') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Data do Fornecimento</label>
                                    <div class="form-group">
                                        <input type="date" name="data_do_fornecimento" class="form-control"
                                            placeholder="Data do Fornecimento"
                                            value="{{ old('data_do_fornecimento') ?? $guiasaida->data_do_fornecimento }}">
                                        <p class="text-danger">{{ $errors->first('data_do_fornecimento') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Data do Recebimento</label>
                                    <div class="form-group">
                                        <input type="date" name="data_do_recebimento" class="form-control"
                                            placeholder="Data do Recebimento"
                                            value="{{ old('data_do_recebimento') ?? $guiasaida->data_do_recebimento }}">
                                        <p class="text-danger">{{ $errors->first('data_do_recebimento') }}</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="">Fiel do Armazem</label>
                                    <div class="form-group">
                                        <input type="text" name="fiel_do_armazem" class="form-control"
                                            placeholder="Fiel do Armazem"
                                            value="{{ old('fiel_do_armazem') ?? $guiasaida->fiel_do_armazem }}">
                                        <p class="text-danger">{{ $errors->first('fiel_do_armazem') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Assistente do Armazem</label>
                                    <div class="form-group">
                                        <input type="text" name="assistente_do_armazem" class="form-control"
                                            placeholder="Assistente do Armazem"
                                            value="{{ old('assistente_do_armazem') ?? $guiasaida->assistente_do_armazem }}">
                                        <p class="text-danger">{{ $errors->first('assistente_do_armazem') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Levantado Por</label>
                                    <div class="form-group">
                                        <input type="text" name="levantado_por" class="form-control"
                                            placeholder="Levantado Por"
                                            value="{{ old('levantado_por') ?? $guiasaida->levantado_por }}">
                                        <p class="text-danger">{{ $errors->first('levantado_por') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Nr do Documento</label>
                                    <div class="form-group">
                                        <input type="text" name="nrDocumento" class="form-control"
                                            placeholder="Nr do Documento" value="{{ old('nrDocumento')?? $guiasaida->nrDocumento }}">
                                        <p class="text-danger">{{ $errors->first('nrDocumento') }}</p>
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



{{-- <input type="hidden" name="guiaTransporteLast" value="{{$guiasaida->guiaTransporte_id}}"> --}}
