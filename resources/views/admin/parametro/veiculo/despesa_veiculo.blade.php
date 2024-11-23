@extends('layouts.app')
@section('content')

<section class="content">

    <div class="box">
        <div class="box-body">
            <div class="col-md-12">
                <div class="row">

                    <form action="{{ route('veiculo.despesa') }}" method="GET">

                        
                        <div class="col-md-2">
                            <div class="form-group" style="margin-right: 5px">
                                <label>Ano de Lançamento</label>
                                <select class="form-control select2" name="ano" id="ano" style="width: 100%;">
                                    <option value="{{ Null }}">Todas</option>
                                    @foreach ($anos as $year)
                                        <option {{ ($ano == $year->ano) ? 'selected' : '' }} value="{{ $year->ano }}">{{ $year->ano }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
 
                        <div class="col-md-2">
                            <div class="form-group" style="margin-right: 5px">
                                <label>Tipo de Serviço</label>
                                <select class="form-control select2" name="servico_id" id="servico_id" style="width: 100%;">
                                    <option value="{{ Null }}">Todas</option>
                                    @foreach ($servicos as $serv)
                                        <option {{ ($servico_id == $serv->id) ? 'selected' : '' }} value="{{ $serv->id }}">{{ $serv->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group" style="margin-right: 5px">
                                <label for="exampleInputEmail1"> Viatura</label>
                                <select id="veiculo_id" name="veiculo_id" class="form-control select2">
                                    <option value="{{ Null }}">Todas</option>
                                    @foreach ($viaturas as $veiculo)
                                        <option {{ ($veiculo_id == $veiculo->id) ? 'selected' : '' }} value="{{ $veiculo->id }}">
                                            {{ $veiculo->marca }} - {{ $veiculo->matricula }}
                                        </option> 
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group" style="margin-right: 5px">
                                <br />
                                <button type="submit" class="btn btn-danger btn-flat"> Filtrar <i
                                        class="fa fa-search-plus"></i></button>
                            </div>
                        </div>

                    </form> 
                </div>

            </div>

        </div>
    </div>

    <div class="box box-default">
        <div class="box-body" style="background: linear-gradient(45deg, #006def, transparent);">
            <div class="row">
                <div class="col-md-8 col-sm-4 col-xs-12">
                    <div class="top-bar-title padding-bottom" style="color: white; font-size: 17px; font-family: Verdana, Geneva, Tahoma, sans-serif; text-transform: uppercase">Despesas - Taxas de Viaturas  </div>
                </div>
                
                <div class="col-md-4 col-sm-4 col-xs-12" style="text-align: end;"> 
                    <a data-toggle="modal" data-target="#add-despesas-fixas" class="btn btn-sm btn-warning btn-flat">
                        <span class="fa fa-plus"> &nbsp;</span>Registar Nova Despesa
                    </a>
                </div>
            </div>
        </div>
    </div>
   
    <div class="box">
 
        <div class="box-body">
            
            <table id="veiclesList" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="border: 1px solid #ffffff5c; border-radius: 0;" class="text-center">#</th>
                        <th style="border: 1px solid #ffffff5c; border-radius: 0;">Serviço</th> 
                        <th style="border: 1px solid #ffffff5c; border-radius: 0;">Vaiculo (Marca/Modelo)</th> 
                        <th style="border: 1px solid #ffffff5c; border-radius: 0;" class="text-center">Vaiculo (Matricula)</th> 
                        <th style="border: 1px solid #ffffff5c; border-radius: 0;" class="text-center">Data Registo</th>
                        <th style="border: 1px solid #ffffff5c; border-radius: 0;" class="text-center">Data Renovação</th>
                        <th style="border: 1px solid #ffffff5c; border-radius: 0;" class="text-center">Valor</th>
                        <th style="border: 1px solid #ffffff5c; border-radius: 0;" class="text-center">Acção</th>
                    </tr>
                </thead>

                <tbody>
                    @php $i = 1; @endphp
                     
                    @foreach ($despesas as $data)
                        @php
                            $date = new \DateTime($data->data_termino);
                            $now = new \DateTime();
                            $interval = $now->diff($date);
                            $restante = $interval->format('%R%a');
                        @endphp
                        
                        @if ($restante <= 0)
                            <tr class="text-white bg-danger">
                        @else
                            @if ($restante <= 30)
                                <tr class="quadrat">
                            @else
                                <tr>
                            @endif
                        @endif
                            <td class="text-center">{{ $i++ }}</td>
                            <td>{{ $data->servico }}</td>
                            <td>{{ $data->marca.' - '.$data->modelo }}</td>
                            <td class="text-center">{{ $data->matricula }}</td>
                            <td class="text-center">{{ formatDate(date('d-m-Y', strtotime($data->data_inicio)))  }}</td>
                            <td class="text-center">{{ formatDate(date('d-m-Y', strtotime($data->data_termino)))  }}</td>
                            <td class="text-right">{{ number_format($data->valor,2) }}</td> 
                            <td class="text-center">
                                <form method="GET" action="{{ route('despesa_veiculo_remove', ['id' => $data->id]) }}"
                                    accept-charset="UTF-8" style="display:inline">
                                    {!! csrf_field() !!}
                                    <button title="Remoção de despesa veiculo" class="btn btn-xs btn-danger"
                                        type="button" data-toggle="modal" data-target="#confirmDelete"
                                        data-title="Remoção de despesa de veiculo"
                                        data-message="Tem certeza de que deseja remover esta despesa de viatura ? ">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
    @include('layouts.includes.message_boxes')
    @include('admin.Parametros.veiculo.form.add_despesa')

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

        
        $('.datepicker').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy',
        });
        
        var dataHoje = new Date();
        var dataFim = "";
        
        $('#datepicker').datepicker('update', dataHoje);

        function date(days) {
            dataHoje = new Date();
            dataFim = new Date(dataHoje.setDate(dataHoje.getDate() + days));

            var newdate = new Date();

            newdate.setDate(newdate.getDate() + Number(days));

            var dd = newdate.getDate();
            var mm = newdate.getMonth() + 1;
            var y = newdate.getFullYear();
            var dataFim2 = dd + '-' + mm + '-' + y;

            $('#data_fim2').val(dataFim2);

            $('#datepicker1').datepicker('update', dataFim);
            $("#data_fim").datepicker('update', dataFim);
        }

        
        date(365);
 
    });
  
</script>
@endsection