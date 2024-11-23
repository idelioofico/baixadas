@extends('layout.master')

@section('title')
    Nova Guia de Saida
@endsection

{{--  Em relacao ao registo, a Provincia, Distrito, Data e Lote e ele seleciona uma vez, ja o restante dos dados ele vai meter la embaixo  --}}
 

@section('content')
    <div class="page-heading">
        <h1 class="page-title">Nova Guia de Saida</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html"><i class="la la-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Nova Guia</li>
        </ol>
    </div>

    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-head bg-blue-100">
                        <div class="ibox-title">Registo de Guia De Saida</div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        </div>
 
                    </div>
                    <div class="ibox-body">
                        
                        <form action="{{ route('guiasaida.store') }}" enctype="multipart/form-data" method="post" class="pt-4">
                            @csrf

                            <div class="row">

                                <div class="col-md-3">
                                    <label for="">Projecto</label>
                                    <div class="form-group">
                                        <select name="site" class="form-control br" id="site">
                                            <option selected hidden>Selecione</option>
                                            @foreach ($site as $row)
                                                <option value="{{ $row->id }}">
                                                    {{ $row->projecto_nome }} - {{ $row->site_nome }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="">Requisitante</label>
                                    <div class="form-group">
                                        <input type="text" name="requisitante" class="form-control br"
                                            placeholder=".........." value="{{ Auth::user()->name }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="">Data da Requisição</label>
                                    <div class="form-group">
                                        <input type="date" name="data" class="form-control br" placeholder=".........."
                                            value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                               
                                <div class="col-md-3 form-group">
                                    <label for="">Responsavel</label>
                                    <input type="text" class="form-control br" readonly name="elaborado_por"
                                        value="{{ Auth::user()->name }}">
                                </div>
  
                                <div class="col-md-3">
                                    <label for="">Anexo</label>
                                    <div class="form-group">
                                        <input type="file" name="anexo" required class="form-control br" placeholder="anexo"
                                            value="{{ old('anexo') }}">
                                        <p class="text-danger">{{ $errors->first('anexo') }}</p>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button class="btn btn-success br">Salvar <i class="fa fa-check"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection



