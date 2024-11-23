<div class="modal fade" id="modal_alocacao" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            
            <div class="modal-header bg-whitesmoke">
                <h5 class="modal-title" id="formModal">Transferencia de Viatura</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form class="" method="POST" action="{{ route('transferencia_store') }}">
                <div class="modal-body">

                    <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                    <input type="hidden" name="veiculo" id="veiculo">
                    <input type="hidden" name="alocacao_id" id="alocacao_id">

                     
        
                    <div class="form-row">

                        <div class="form-group col-md-4">
                            <label>Viatura:</label>
                            <input type="text" class="form-control" disabled name="veiculo_matricula" id="veiculo_matricula">
                        </div>
                        
                        <div class="form-group col-md-4">
                            <label>Site Atual:</label>
                            <input type="text" class="form-control" disabled name="site" id="site">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Projecto Atual:</label>
                            <input type="text" disabled class="form-control" name="projecto" id="projecto">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="subprojecto">Novo Site</label>
                            <select required id="subprojecto"  name="subprojecto" class="form-control" data-live-search="true"  data-actions-box="true"> 
                                <option selected disabled hidden>Selecione</option>
                                @foreach ($site as $row)
                                    <option value="{{ $row->id }}">{{ $row->nome }}</option>
                                @endforeach 
                            </select>
                        </div>

                    </div> 

                
                </div>
                <div class="modal-footer bg-whitesmoke">
                    <button type="button" class="btn btn-danger m-t-15 waves-effect"><i class="fa fa-times"></i></button>
                    <button type="submit" class="btn btn-success m-t-15 waves-effect">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>