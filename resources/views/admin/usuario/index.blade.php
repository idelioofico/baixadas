@extends('layout.master')

@section('title')
    Usuarios
@endsection
@php
    $i = 1;
@endphp
@section('content')
    <div class="page-content fade-in-up" id="root">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-head bg-blue-100">
                        <div class="ibox-title">Listagem de usuários</div>
                        <div class="">
                            <a href="{{ route('usuario.create') }}" class="btn btn-sm btn-rounded btn-success">Registar Novo +</a>
                        </div>
                    </div>
                    <div class="ibox-body">

                        <div class="table-responsive"> 
                            <table class="table table-hover table-sm  " id="myTable" cellspacing="0" width="100%">
                                <thead class="thead-default">
                                    <tr>
                                        <th class="text-center" scope="col">Ord</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Dpartamento</th>
                                        <th scope="col">User Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Telefone</th>
                                        <th>Tipo de usuário</th>
                                        <th>Permissão</th>
                                        <th class="text-center">Acções</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usuarios as $usuario)
                                        <tr style="background: {{ $usuario->status == 0 ? '#ff000021' : '' }}">

                                            <th class="text-center">{{ $i++ }}</th>
                                            <td>{{ $usuario->name }}</td>
                                            <td>{{ $usuario->dept_nome }}</td>
                                            <td>{{ $usuario->username }}</td>
                                            <td>{{ $usuario->email }}</td>
                                            <td>{{ $usuario->telefone }}</td>
                                            <td>{{ $usuario->tipo_usuario_nome }}</td>
                                            <td>
                                                {{ DB::table('permission')->where('id', $usuario->permission_id)->first()->nome ?? 'Sem Permissões' }}
                                            </td>
                                            <td class="text-center">
                                                
                                                @if ($usuario->status == 1)
                                                    <a href="{{ route('usuario.edit', $usuario->id) }}"
                                                        class="btn btn-warning btn-rounded btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                @else
                                                    <span class="text text-danger font-weight-bolder">inativo</span>
                                                @endif
                                                <a href="{{ route('usuario.destroy', $usuario->id) }}"
                                                    class="btn {{ $usuario->status == 0 ? 'btn-success' : 'btn-danger' }} btn-rounded btn-sm">
                                                    <i
                                                        class="{{ $usuario->status == 0 ? 'fa fa-check' : 'fa fa-trash' }}"></i>
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


    </div>
@endsection
