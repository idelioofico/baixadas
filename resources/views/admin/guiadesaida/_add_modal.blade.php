

{{--  Em relacao ao registo, a Provincia, Distrito, Data e Lote e ele seleciona uma vez, ja o restante dos dados ele vai meter la embaixo  --}}



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header bg-blue-100">
                <h5 class="modal-title" style="font-weight: 700; text-transform: uppercase">
                    Registo de Saida de Material - Baixadadas
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('guiasaidaproduto.create', ['id' => 0]) }}" method="GET">
                    @method('get')
                    <div class="row">
                        
                        
                        <div class="col-md-6">
                            <label for="">Data</label>
                            <div class="form-group">
                                <input required type="date" name="data" value="{{ date('Y-m-d') }}" class="form-control br">
                                <p class="text-danger">{{ $errors->first('site') }}</p>
                            </div>
                        </div>
                        
                        
                        <div class="col-md-6">
                            <label for="">Projecto/Site</label>
                            <div class="form-group">
                                <select required name="site" class="form-control br" id="site">
                                    <option selected disabled hidden>selecione</option>
                                    @foreach ($sites as $data)
                                        <option value="{{ $data->id }}">
                                            {{ $data->projecto_nome }} | {{ $data->site_nome }}
                                        </option>
                                    @endforeach
                                </select>
                                <p class="text-danger">{{ $errors->first('site') }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="">Provincia</label>
                            <div class="form-group">
                                <select required name="provincia_id" id="provincia_id" class="form-control br provincia_id">
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
                            <label for="">Distrito</label>
                            <div class="form-group">
                                <select required name="distrito_id" id="distrito_id" class="form-control br">
                                    <option selected disabled hidden>selecione</option>
                                </select>
                                <p class="text-danger">{{ $errors->first('site') }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="">Viatura</label>
                            <div class="form-group">
                                <select required name="veiculo_id" id="veiculo_id" class="form-control br veiculo_id">
                                    <option selected disabled hidden>selecione</option> 
                                </select>
                                <p class="text-danger">{{ $errors->first('site') }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="">Lote</label>
                            <div class="form-group">
                                <input required type="text" name="lote" value="0" placeholder="Ex: Lote IV" class="form-control br">
                                <p class="text-danger">{{ $errors->first('lote') }}</p>
                            </div>
                        </div>
                        
 

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times"></i></button>
                        <button type="submit" class="btn btn-success btn-sm">Registar <i class="fa fa-check"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>