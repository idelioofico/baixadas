@extends('layouts.app')
@section('content')

<section class="content">

    <div class="box box-default">
        <div class="box-body">
            <div class="row">
                <div class="col-md-8 col-sm-4 col-xs-12">
                    <div class="top-bar-title padding-bottom" style="color: black; font-size: 17px; font-family: Verdana, Geneva, Tahoma, sans-serif; text-transform: uppercase">Historico de Alocação de Viaturas</div>
                </div>
                
                <div class="col-md-4 col-sm-4 col-xs-12" style="text-align: end;">
                    <a href="{{ route('alocacao_create') }}" class="btn btn-warning btn-flat btn-border-warning">
                        <i class="fa fa-plus-circle"></i> Alocar Viatura
                    </a>
                </div>
            </div>
        </div>
    </div>
   
    <div class="box">
 
        <div class="box-body">
            
            <table id="example1" class="uk-table uk-table-responsive uk-table-divider table table-bordered">
                <thead>
                    <tr>
                        <th style="text-align: center">Ord.</th> 
                        <th style="text-align: center">Data de Alocação</th>
                        <th>Projecto</th>
                        <th>Site</th>
                        <th style="text-align: center">Veiculo</th>
                        <th style="text-align: center">Estado</th>
                        <th style="text-align: center">Acções</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($data as $row) 
                        <tr>
                            <td style="text-align: center">
                                {{ $i++ }}
                            </td>
                            <td style="text-align: center">{{ $row->data_alocacao }}</td>
                            <td>{{ $row->projecto_nome }}</td>
                            <td>{{ $row->site_nome }}</td>
                            <td style="text-align: center">{{ $row->matricula }}</td>


                            <td style="text-align: center">
                                @if ($row->activo == 1)
                                    <h6> 
                                        <span style="border-radius: 12px" class="btn btn-xs btn-success">
                                            <i class="fa fa-check"></i> Em funcionamento
                                        </span>
                                    </h6>
                                @else
                                    <h6> 
                                        <span style="border-radius: 12px" class="btn btn-xs btn-danger">
                                            <i class="fa fa-times"></i> Viatura Inactiva
                                        </span>
                                    </h6>
                                @endif
                            </td>
                            <td style="text-align: center">


                                <button style="border: 0px;" type="button" class="btn-icon btn-primary btn-xs modal_add"
                                    data-toggle="modal" data-alocacao_id="{{ $row->id }}" data-site="{{ $row->site_nome }}"
                                    data-projecto="{{ $row->projecto_nome }}"
                                    data-veiculo_matricula="{{ $row->matricula }}"
                                    data-veiculo="{{ $row->veiculo }}">
                                    <i class="fa fa-sync"></i> Transferir
                                </button>

                                @if ($row->activo == 1)
                                    <a href="{{ route('desativar_alocacao', ['id' => $row->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Desativar</a>
                                @else
                                    <a href="{{ route('desativar_alocacao', ['id' => $row->id]) }}" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Reativar</a>
                                @endif

                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

    @include('layouts.includes.message_boxes')
    @include('admin.Parametros.veiculo.alocacao_change')

    

</section>


@endsection

@section('js')
<script type="text/javascript">
    $(function () {
        $("#example1").DataTable({
            "order": [],
            // "paging":false,
            "columnDefs": [{
                "targets": 6,
                "orderable": false
            }],
            "pageLength": 10, 
            "language": '{{ Session::get('dflt_lang') }}',
    
        });
        $(".select2").select2({});
    });

    $(document).on('click', '.modal_add', function () {
        var a = $(this); 

        var alocacao_id = a.data('alocacao_id')
        var veiculo = a.data('veiculo')
        
        var site = a.data('site')
        var projecto = a.data('projecto')
        var veiculo_matricula = a.data('veiculo_matricula')
        

        var modal = $('#modal_alocacao')
    
        
        $('input[name="veiculo"]').val(veiculo);
        $('input[name="alocacao_id"]').val(alocacao_id);

        $('input[name="site"]').val(site);
        $('input[name="projecto"]').val(projecto);
        $('input[name="veiculo_matricula"]').val(veiculo_matricula);

        $(".select2").select2({});
        modal.modal('show');
    })
  
</script>
@endsection