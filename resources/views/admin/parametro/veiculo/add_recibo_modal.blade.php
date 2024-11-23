<!-- Modal -->


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="font-weight: 700">Cadastro de Recibo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="{{ route('recibo_requisicao_store') }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" value="{{csrf_token()}}" name="_token" id="token">
                <div class="modal-body">
                    <div class="row">
     
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sel1">Referência do Documento</label>
                                <div class="form-group">
                                    <select class="form-control" name="documento_id" id="documento_id">
                                        <option value="all">Todos</option> 
                                        @foreach($documentos as $data)
                                            <option value="{{ $data->id }}">{{ $data->referencia_documento }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div> 

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="anexo_recibo" style="font-weight: 100">Anexo (Recibo)</label>
                                <input type="file" id="anexo_recibo" name="anexo_recibo" class="form-control">
                            </div> 
                        </div>
    
                    </div>
                </div>
    
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">X</button>
                    <button type="submit" class="btn btn-sm btn-success">Salvar/Registar</button>
                </div>
            </form>

        </div>
    </div>
</div>
 
 
 
<script type="text/javascript">
    $(function () {
        $("#example1").DataTable({
            "order": [],
            // "paging":false,
            "columnDefs": [{
                "targets": 6,
                "orderable": false
            }],
            "pageLength": 20, 
            "language": '{{ Session::get('dflt_lang') }}',
            "pageLength": '50',
    
        });
        $(".select2").select2({});
    });
  
</script>