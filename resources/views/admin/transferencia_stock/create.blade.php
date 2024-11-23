@extends('layout.master')

@section('title')
    Registo de Transferencia de Stock
@endsection
 
@section('content') 

    <div class="page-content fade-in-up" id="root">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-head bg-blue-100">
                        <div class="ibox-title" style="text-transform: uppercase; font-weight: 800">Registo de Transferencia de Stock Entre Sites</div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <form action="{{ route('transferencias.store') }}" method="post" class="pt-4">
                            @csrf
                            <div class="row">

                                <div class="col-md-3">
                                    <label for="">Projecto Origem(Saida)</label>
                                    <div class="form-group">
                                        <select name="empresa_origem" class="form-control br" >
                                            <option value="0" selected disabled>Selecione a origem</option>
                                            @foreach ($site as $origem)
                                                <option value="{{ $origem->id }}">
                                                    {{ $origem->projecto_nome }} - {{ $origem->site_nome }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <p class="text-danger">{{ $errors->first('empresa_origem') }}</p>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <label for="">Projecto Destino(Entrada)</label>
                                    <div class="form-group">
                                        <select name="empresa_destino" class="form-control br" >
                                            <option value="0" selected disabled>Selecione o destino</option>
                                            @foreach ($site as $destino)
                                                <option value="{{ $destino->id }}">
                                                    {{ $destino->projecto_nome }} - {{ $destino->site_nome }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <p class="text-danger">{{ $errors->first('empresa_destino') }}</p>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="">Data</label>
                                    <div class="form-group">
                                        <input type="date" name="data" class="form-control br" value="{{ old('data') ?? date('Y-m-d')}}">
                                        <p class="text-danger">{{ $errors->first('data') }}</p>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="">Requisitante</label>
                                    <div class="form-group">
                                        <input type="text" name="requisitante" class="form-control br"
                                            placeholder=".........." value="{{ Auth::user()->name }}">
                                        <p class="text-danger">{{ $errors->first('requisitante') }}</p>
                                    </div>
                                </div>
  
                                <div class="col-md-12 form-group">
                                    <label for="">Motivo/ Observações</label>
                                    <textarea class="form-control br" name="motivo" value="{{ old('motivo') }}" cols="30" rows="5" placeholder="..........">{{ old('motivo') }}</textarea>
                                    <p class="text-danger">{{ $errors->first('motivo') }}</p>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button class="btn btn-success btn-rounded">Salvar <i class="fa fa-save"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@push('javascript')
    <script>
        if (document.getElementById('motivo_requisicao').value == 3) {
            document.getElementById('outros').classList.remove('d-none')
        }

        document.getElementById('motivo_requisicao').addEventListener('change', function(e) {
            console.log('entro')

        })
    </script>

    <script>
        let root = new Vue({
            el: '#root',
            data: {
                finalidade: 1
            },
            mounted: function() {

            },
            methods: {
                selecionado(event) {
                    this.finalidade = event.target.value
                    setTimeout(() => {
                        $('.select2_demo_1').select2()
                    }, 3);
                },
                outros(e) {
                    if (e.target.value == 3) {
                        document.getElementById('outros').classList.remove('d-none')
                    } else {
                        if (document.getElementById('outros').classList[1] && document.getElementById('outros')
                            .classList[
                                1] == 'd-none') {
                            return ''
                        } else {
                            document.getElementById('outros').classList.add('d-none')
                            document.getElementById('motivo_descricao').value = ''
                        }
                    }
                }
            }

        })
    </script>
@endpush
