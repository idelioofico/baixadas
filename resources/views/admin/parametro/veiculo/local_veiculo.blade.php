@extends('layouts.app')
@section('content')

<section class="content">

    <div class="box box-default">
        <div class="box-body" style="background: linear-gradient(45deg, #006def, transparent);;">
            <div class="row">
                <div class="col-md-8 col-sm-4 col-xs-12">
                    <div class="top-bar-title padding-bottom" style="color: white; font-size: 17px; font-family: Verdana, Geneva, Tahoma, sans-serif; text-transform: uppercase"> Histórico de localização de Veiculos</div>
                </div>
                
                <div class="col-md-4 col-sm-4 col-xs-12" style="text-align: end;"> 
                    <a data-toggle="modal" data-target="#add-despesas-fixas" class="btn btn-sm btn-warning btn-flat">
                        <span class="fa fa-plus"> &nbsp;</span>Registar Nova Localização
                    </a>
                </div>
            </div>
        </div>
    </div>
   
    <div class="box">
 
        <div class="box-body">
            
            <table id="veiclesList" class="table table-bordered table-striped">
                <thead>
                    <tr style="border: 1px solid white">
                        <th style="border: 1px solid #ffffff5c; border-radius: 0;"></th> 
                        <th style="border: 1px solid #ffffff5c; border-radius: 0;" class=" text-center">
                            Empresa
                        </th>
                        <th style="border: 1px solid #ffffff5c; border-radius: 0;" colspan="2" class=" text-center">
                            Localização
                        </th> 
                        <th style="border: 1px solid #ffffff5c; border-radius: 0;" colspan="4" class=" text-center">
                            Motorista & Carta de Condução
                        </th>
                        <th style="border: 1px solid #ffffff5c; border-radius: 0;" class=" text-center"></th>
                    </tr>
                    <tr>
                        <th style="border: 1px solid #ffffff5c; border-radius: 0;" class="text-center">#</th>
                        <th style="border: 1px solid #ffffff5c; border-radius: 0;" class=" text-center">Empresa</th> 
                        <th style="border: 1px solid #ffffff5c; border-radius: 0;" class="text-center">Zona</th>
                        <th style="border: 1px solid #ffffff5c; border-radius: 0;" class="text-center">Cidade</th>
                        <th style="border: 1px solid #ffffff5c; border-radius: 0;" class="text-center">Nome</th>
                        <th style="border: 1px solid #ffffff5c; border-radius: 0;" class="text-center">
                            Nr. Carta
                        </th>
                        <th style="border: 1px solid #ffffff5c; border-radius: 0;" class="text-center">
                            Validade
                        </th>
                        <th style="border: 1px solid #ffffff5c; border-radius: 0;" class="text-center">Contacto</th>
                        <th style="border: 1px solid #ffffff5c; border-radius: 0;" class="text-center">Acção</th>
                    </tr>
                </thead>

                <tbody>
                    @php $i = 1; @endphp
                     
                    @forelse ($localizacao as $local) 
                        <tr>
                            <th class="text-center">{{ $i++ }}</th>
                            <td class=" text-center">{{ $local->empresa }}</td>
                            <td class="text-center">{{ $local->zona }}</td>
                            <td class="text-center">{{ $local->provincia_nome }}</td> 
                            <td class="text-center">{{ $local->motorista_nome }}</td> 
                            <td class="text-center">{{ $local->carta_conducao }}</td> 
                            <td class="text-center">{{ $local->validade_carta }}</td> 
                            <td class="text-center">{{ $local->contacto }}</td> 
                            <td class="text-center">
                                <form method="GET" action="{{ route('localizacao_veiculo_remove', ['id' => $local->id]) }}"
                                    accept-charset="UTF-8" style="display:inline"> 
                                    <button title="Remoção de localização veiculo" class="btn btn-xs btn-danger"
                                        type="button" data-toggle="modal" data-target="#confirmDelete"
                                        data-title="Remoção de localização veiculo"
                                        data-message="Tem certeza de que deseja remover esta localização da viatura ? ">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-danger">Sem historico de localização disponivel</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
    @include('layouts.includes.message_boxes')
    @include('admin.Parametros.veiculo.form.add_local')

</section>


@endsection

@section('js')
<script type="text/javascript">
    $(function () {
        $("#veiclesList").DataTable({
            "order": [],
            "columnDefs": [{
                "targets": 6,
                "orderable": false
            }],
            "pageLength": 20, 
            "language": '{{ Session::get('dflt_lang') }}',
    
        });
        $(".select2").select2({});
    });
  
</script>
@endsection