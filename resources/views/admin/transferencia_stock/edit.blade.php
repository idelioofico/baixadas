@extends('layout.master')

@section('title')
    Editar Requisição Ao Armazem {{ $requisicao->numero_do_folheto }}
@endsection

@section('content')


    <div class="page-content fade-in-up" id="root">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Editar Requisição para o Armazem {{ $requisicao->numero_do_folheto }}
                        </div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <form action="{{ route('requisicao.update', $requisicao->id) }}" method="post"
                            class="pt-4">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Requisição Numero</label>
                                    <div class="form-group">
                                        <input type="text" name="numero_do_folheto" class="form-control"
                                            placeholder="Requisição Numero"
                                            value="{{ old('numero_do_folheto') ?? $requisicao->numero_do_folheto }}"
                                            disabled>
                                        <p class="text-danger">{{ $errors->first('numero_do_folheto') }}</p>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="">Requisitante</label>
                                    <div class="form-group">
                                        <input type="text" name="requisitante" class="form-control"
                                            placeholder="Requisitante"
                                            value="{{ old('requisitante') ?? $requisicao->requisitante }}">
                                        <p class="text-danger">{{ $errors->first('requisitante') }}</p>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="">Finalidade</label>
                                    <div class="form-group">
                                        <select name="finalidade" id="" class="form-control"
                                            v-on:change="selecionado($event)">
                                            <option value="1">Cliente</option>
                                            <option value="2">Aplicação</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3" v-if="finalidade==1">
                                    <label for="">Cliente</label>
                                    <div class="form-group">
                                        <select class="form-control select2_demo_1 custom_select" id="" name="aplicacao">
                                            @foreach ($clientes as $item)
                                                <option value="{{ $item->nome }}"
                                                    {{ $requisicao->aplicacao == $item->nome ? 'selected' : '' }}>
                                                    {{ $item->nome }}</option>
                                            @endforeach
                                        </select>
                                        <p class="text-danger">{{ $errors->first('aplicacao') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3" v-if="finalidade==2">
                                    <label for="">Aplicação</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="aplicacao" placeholder="Aplicação"
                                            value="{{ old('aplicacao') ?? $requisicao->aplicacao }}">
                                        <p class="text-danger">{{ $errors->first('aplicacao') }}</p>
                                    </div>
                                </div>



                                <div class="col-md-3">
                                    <label for="">Data da Requisição</label>
                                    <div class="form-group">
                                        <input type="date" name="data" class="form-control" placeholder="data"
                                            value="{{ old('data') ?? $requisicao->data }}">
                                        <p class="text-danger">{{ $errors->first('data') }}</p>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="">Hora</label>
                                    <div class="form-group">
                                        <input type="time" name="hora" class="form-control" placeholder="Hora"
                                            value="{{ old('hora') ?? $requisicao->hora }}">
                                        <p class="text-danger">{{ $errors->first('hora') }}</p>
                                    </div>
                                </div>



                                <div class="col-md-3">
                                    <label for="">Motivo Da Requisição</label>
                                    <div class="form-group">
                                        <select name="motivo_de_requisicao" v-on:change="outros($event)"
                                            id="motivo_requisicao" class="form-control">
                                            <option value="">-----------Seleçione--------------</option>
                                            <option value="1"
                                                {{ $requisicao->motivo_de_requisicao == 1 ? 'selected' : '' }}>
                                                Avaria / Reparação</option>
                                            <option value="2"
                                                {{ $requisicao->motivo_de_requisicao == 2 ? 'selected' : '' }}>
                                                Manutenção</option>
                                            <option value="4"
                                                {{ $requisicao->motivo_de_requisicao == 4 ? 'selected' : '' }}>
                                                Fornecimento</option>
                                            <option value="3"
                                                {{ $requisicao->motivo_de_requisicao == 3 ? 'selected' : '' }}>
                                                Outros</option>
                                        </select>
                                        <p class="text-danger">{{ $errors->first('motivo_de_requisicao') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 d-none" id="outros">
                                    <div class="form-group">
                                        <label for="">Outros</label>
                                        <input type="text" class="form-control" id="motivo_descricao"
                                            value="{{ old('motivo_descricao') ?? $requisicao->motivo_descricao }}"
                                            name="motivo_descricao" placeholder="Outros">
                                    </div>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="">Laborado Por</label>
                                    <input type="text" class="form-control" name="laborado_por"
                                        value="{{ old('laborado_por') ?? $requisicao->laborado_por }}"
                                        placeholder="Paborado Por">
                                    <p class="text-danger">{{ $errors->first('laborado_por') }}</p>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="">Autorizado Por</label>
                                    <input type="text" class="form-control" name="autorizado_por"
                                        value="{{ old('autorizado_por') ?? $requisicao->autorizado_por }}"
                                        placeholder="Autorizado Por">
                                    <p class="text-danger">{{ $errors->first('autorizado_por') }}</p>
                                </div>

                                <div class="col-md-3">
                                    <label for="">Nr do Documento</label>
                                    <div class="form-group">
                                        <input type="text" name="nrDocumento" class="form-control"
                                            placeholder="Nr do Documento" value="{{ old('nrDocumento')?? $requisicao->nrDocumento }}">
                                        <p class="text-danger">{{ $errors->first('nrDocumento') }}</p>
                                    </div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="">Observações</label>
                                    <textarea class="form-control" name="obs" value="{{ old('obs') ?? $requisicao->obs }}" cols="30" rows="5" placeholder="Observações.................">
                                        {{ $requisicao->obs }}
                                    </textarea>
                                    <p class="text-danger">{{ $errors->first('obs') }}</p>
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

@push('javascript')
    <script>
        if (document.getElementById('motivo_requisicao').value == 3 || document.getElementById('motivo_requisicao').value ==
            4) {
            document.getElementById('outros').classList.remove('d-none')
        }

        document.getElementById('motivo_requisicao').addEventListener('change', function(e) {


        })
    </script>

    <script>
        let finalidadeValue = {!! $requisicao->finalidade !!}
        let root = new Vue({
            el: '#root',
            data: {
                finalidade: finalidadeValue
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
