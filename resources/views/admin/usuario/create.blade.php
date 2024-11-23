@extends('layout.master')

@section('title')
    Novo usuário
@endsection

@section('content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-head bg-blue-100">
                        <div class="ibox-title">Registo de novo usuário</div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <form action="{{ route('usuario.store') }}" method="post" class="pt-4">
                            @csrf

                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Nome <small class="text-danger">*</small></label>
                                    <div class="form-group">
                                        <input type="text" name="name" required class="form-control br "
                                            placeholder="Nome do Usuario" value="{{ old('name') }}">
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Username <small class="text-danger">*(NB: Para acesso ao sistema,
                                            ex: wilson)</small></label>
                                    <div class="form-group">
                                        <input type="text" name="username" required class="form-control br"
                                            placeholder="Username" value="{{ old('username') }}">
                                        <p class="text-danger">{{ $errors->first('username') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Email <small class="text-danger">*</small></label>
                                    <div class="form-group">
                                        <input type="email" name="email" required class="form-control br"
                                            placeholder="Email" value="{{ old('email') }}">
                                        <p class="text-danger">{{ $errors->first('email') }}</p>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="">Telefone</label>
                                    <div class="form-group">
                                        <input type="number" name="telefone" class="form-control br" placeholder="Telefone"
                                            value="{{ old('telefone') }}">
                                        <p class="text-danger">{{ $errors->first('telefone') }}</p>
                                    </div>
                                </div>

                                
                                <div class="col-md-3">
                                    <label for="">Departamento</label>
                                    <div class="form-group">
                                        <select name="departamento" required class="form-control br">
                                            <option>Selecione</option>
                                            @foreach ($departamentos as $dept)
                                                <option value="{{ $dept->id }}">{{ $dept->nome }}</option>
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
                                                <option value="{{ $data->tipo }}">{{ $data->nome }}</option>
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
                                            <option value="{{null}}">Sem Permissões</option>
                                            @foreach ($permission as $data)
                                                <option value="{{ $data->id }}">{{ $data->nome }}</option>
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
                                                <option value="{{ $roles->id }}">{{ $roles->nome }}</option>
                                            @endforeach
                                        </select>
                                        <p class="text-danger">{{ $errors->first('role_id') }}</p>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="">Password <small class="text-danger">*</small></label>
                                    <div class="form-group">
                                        <input type="password" required name="password" class="form-control br"
                                            placeholder="Password" value="{{ old('password') }}">
                                        <p class="text-danger">{{ $errors->first('password') }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 text-right">
                                    <button class="btn bg-green-200 btn-rounded btn-sm">Salvar</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
