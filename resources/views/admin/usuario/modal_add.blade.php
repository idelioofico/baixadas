<!-- Modal -->

 
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue-100">
                <h5 class="modal-title" id="exampleModalLabel">Atribuição de Projecto ao Usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('user_project') }}" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="row">
                        
                        <input type="hidden" name="user_id" value="{{ $data->id }}">

                        <div class="col-md-12">
                            <label for="">Projecto</label>
                            <div class="form-group">
                                <select name="projecto_id" id="projecto_id" class="form-control br">
                                    @foreach (DB::table('projecto')->where('removido', 0)->orderBy('id', 'desc')->get() as $row)
                                        <option value="{{ $row->id }}">{{ $row->nome }}</option>
                                    @endforeach 
                                </select>
                                <p class="text-danger">{{ $errors->first('projecto_id') }}</p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">X</button>
                    <button type="submit" class="btn btn-success btn-sm">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Modal -->

 
<div class="modal fade" id="siteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue-100">
                <h5 class="modal-title" id="exampleModalLabel">Atribuição de Site ao Usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('user_site') }}" method="POST">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="row">
                        
                        <input type="hidden" name="user_id" value="{{ $data->id }}">

                        <div class="col-md-12">
                            <label for="">Projecto</label>
                            <div class="form-group">
                                <select name="projecto_id" id="projecto_selected" class="form-control br">
                                    <option selected disabled  >Selecione projecto</option>
                                    @foreach ($projectos as $row_w)
                                        <option value="{{ $row_w->id }}">{{ $row_w->nome }}</option>
                                    @endforeach 
                                </select>
                                <p class="text-danger">{{ $errors->first('projecto_id') }}</p>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="">Site</label>
                            <div class="form-group">
                                <select name="site_id" id="site_id" class="form-control br">
                                    <option selected disabled>Selecione</option>
                                </select>
                                <p class="text-danger">{{ $errors->first('site_id') }}</p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">X</button>
                    <button type="submit" class="btn btn-success btn-sm">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>