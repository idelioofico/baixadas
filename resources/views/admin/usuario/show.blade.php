@extends('layout.master')
 
@section('content')

    <section class="card p-2 mt-4 bg-blue-50">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h3>Projectos & Sites do Usuario <i>{{ $data->name }}</i></h3>
                </div>
                <div class="col-md-6 text-right"> 
                </div>
            </div>
        </div>
    </section>
     
    <div class="page-content fade-in-up">
        <div class="row">

            <div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Projectos sob gestão do  usuario </div>
                        <div class="ibox-tools">
                            <button type="button" class="bt btn-sm btn-success btn-rounded" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Adicionar Projecto</button>
                        </div>
 
                    </div>
                    <div class="ibox-body">
                        
                        <div class="table-responsive">
                        <table class="table table-hover ">
                            <thead class="bg-blue-100" >
                                <tr>
                                    <th>#</th>
                                    <th>Empresa</th>
                                    <th>Nome do Projecto</th>
                                    <th>Responsavel</th> 
                                    <th>Cidade/Provincia</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Acções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($projectos as $row)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $row->empresa_nome }}</td>
                                    <td>{{ $row->nome }}</td>
                                    <td>{{ $row->responsavel }}</td>
                                    <td>{{ $row->cidade_nome }}</td>


                                    <td class="text-center">
                                        @if ($row->activo == 0)
                                            <span class="text-danger">
                                                Inativo <i class="fa fa-times"></i>
                                            </span>   
                                        @else
                                            <span class="text-success">
                                                Activo <i class="fa fa-check"></i>
                                            </span>
                                        @endif
                                    </td>

                                    
                                    <td class="text-center">
                                        <a href="{{ route('user_project_destroy', ['id' => $row->usuario_project_id]) }}" class="btn btn-xs btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                    

                                </tr>
                            @endforeach
                            </tbody> 
                        </table>
                        </div>
                    </div>
                </div>
                
            </div>


            <div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Sites do Usuario</div>
                        <div class="ibox-tools">
                            <button type="button" class="bt btn-sm btn-primary btn-rounded" data-toggle="modal" data-target="#siteModal"><i class="fa fa-plus"></i> Adicionar Site</button>
                        </div>
 
                    </div>
                    <div class="ibox-body">
                        
                        <table class="table table-hover table-responsive">
                            <thead class="bg-blue-100" >
                                <tr>
                                    <th>#</th>
                                    <th>Nome do Site</th>
                                    <th>Cidade/Provincia</th>
                                    <th>Responsavel pelo Site</th> 
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Acções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($sites as $site)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $site->nome }}</td>
                                        <td>{{ $site->cidade_nome }}</td>
                                        <td>{{ $site->responsavel }}</td>
        
                                        <td class="text-center">
                                            @if ($site->activo == 0)
                                                <span class="text-danger">
                                                    Inativo <i class="fa fa-times"></i>
                                                </span>   
                                            @else
                                                <span class="text-success">
                                                    Activo <i class="fa fa-check"></i>
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('user_site_destroy', ['id' => $site->user_site_id]) }}" class="btn btn-xs btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody> 
                        </table>

                    </div>
                </div>
                
            </div>
 
        </div>
    </div>

    @include('admin.usuario.modal_add')

@endsection



