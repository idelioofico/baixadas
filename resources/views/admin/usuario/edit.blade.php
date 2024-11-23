@extends('layout.master')

@section('title')
    Editar Usuario {{ $usuario->nome }}
@endsection

@section('content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Atualização de Usuario: <i>{{ $usuario->name }}</i></div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <form action="{{ route('usuario.update', $usuario->id) }}" method="post" class="pt-4">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Nome</label>
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control br"
                                            placeholder="Nome do Usuario" value="{{ $usuario->name }}">
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Username</label>
                                    <div class="form-group">
                                        <input type="text" name="username" class="form-control br" placeholder="Username"
                                            value="{{ $usuario->username }}">
                                        <p class="text-danger">{{ $errors->first('username') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Email</label>
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control br" placeholder="Email"
                                            value="{{ $usuario->email }}">
                                        <p class="text-danger">{{ $errors->first('email') }}</p>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="">Telefone</label>
                                    <div class="form-group">
                                        <input type="number" name="telefone" class="form-control br" placeholder="Telefone"
                                            value="{{ $usuario->telefone }}">
                                        <p class="text-danger">{{ $errors->first('telefone') }}</p>
                                    </div>
                                </div> 
                                
                                <div class="col-md-3">
                                    <label for="">Departamento</label>
                                    <div class="form-group">
                                        <select name="departamento" required class="form-control br">
                                            <option selected disabled hidden>Selecione</option>
                                            @foreach ($departamentos as $dept)
                                                <option {{ $dept->id == $usuario->departamento ? 'selected' : '' }}
                                                    value="{{ $dept->id }}">{{ $dept->nome }}</option>
                                            @endforeach
                                        </select>
                                        <p class="text-danger">{{ $errors->first('departamento') }}</p>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="">Tipo de Usuario</label>
                                    <div class="form-group">
                                        <select name="tipo_de_usuario" id="" class="form-control br">
                                            @foreach ($tipo_usuario as $data)
                                                <option {{ $data->tipo == $usuario->tipo_de_usuario ? 'selected' : '' }}
                                                    value="{{ $data->tipo }}">{{ $data->nome }}</option>
                                            @endforeach
                                        </select>
                                        <p class="text-danger">{{ $errors->first('tipo_de_usuario') }}</p>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="">Tipo de Permissões</label>
                                    <div class="form-group">
                                        <select name="permission_id" id="" class="form-control br">
                                            <option value="" disabled>Selecione</option>
                                            <option value="{{null}}" {{ $usuario->permission_id==null ? 'selected' : '' }}>Sem Permissões</option>
                                            @foreach ($permission as $data)
                                                <option {{ $data->id == $usuario->permission_id ? 'selected' : '' }}
                                                    value="{{ $data->id }}">{{ $data->nome }}</option>
                                            @endforeach
                                        </select>
                                        <p class="text-danger">{{ $errors->first('permission_id') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Módulo/Gestão</label>
                                    <div class="form-group">
                                        <select name="role_id" id="role_id" class="form-control br">
                                            @foreach ($role as $roles)
                                                <option {{ $roles->id == $usuario->role_id ? 'selected' : '' }}
                                                    value="{{ $roles->id }}">{{ $roles->nome }}</option>
                                            @endforeach
                                        </select>
                                        <p class="text-danger">{{ $errors->first('role_id') }}</p>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="">Password</label>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control br"
                                            placeholder="Password">
                                        <p class="text-danger">{{ $errors->first('password') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button class="btn btn-success btn-rounded">Salvar <i class="fa fa-check"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection
