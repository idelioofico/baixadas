@extends('layout.master')
@section('title', 'Tipos de Material Fornecidos')
    {{-- @php
    DB::table('categoria')->where();
    @endphp --}}

@section('content')
    <div class="page-heading">
        <h1 class="page-title">Tipos de Material Fornecidos </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html"><i class="la la-home font-20"></i></a>
            </li>
            <li class="breadcrumb-item">Tipos de Material Fornecidos</li>
        </ol>
    </div>


    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Adiçionar tipo de material</div>
                        <div class="ibox-tools">
                            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <form action="{{ route('fornecedorCategoria.store',$fornecedor->id) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Categoria</label>
                                        <select name="parent_id" id="categoria_id" class="form-control" value="{{old('parent_id')}}">
                                            @foreach ($categorias as $categoria)
                                                <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                                            @endforeach

                                        </select>
                                        <p class="text-danger">{{$errors->first('parent_id')}}</p>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Subcategoria</label>
                                        <select name="categorsia_id" id="parent_idw" class="form-control" value="{{ old('categoria_id') }}">
                                            @foreach ($subcategorias as $data)
                                                <option value="{{ $data->id }}">{{ $data->nome }}</option>
                                            @endforeach
                                        </select>
                                        <p class="text-danger">{{$errors->first('categoria_id')}}</p>
                                    </div>
                                </div> --}}
                                <div class="col-md-12 text-right pt-3">
                                    <button class="btn btn-primary">Salvar</button>
                                    <a href="{{route('fornecedor.show',$fornecedor->id)}}" class="btn btn-secondary">Terminar</a>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endSection

@push('javascript')
    <script>
        // Token
        let categoria = {
            categoria_id: ''
        }
        const csrfToken = document.getElementsByName('_token')[0].value;
        // Primeira lida
        let loadPage = document.getElementById('categoria_id').value;
        console.log('sd')
        categoria.categoria_id = loadPage
        axios.post(`{{ route('fornecedorCategoria.change') }}`, categoria, {
            headers: {
                "X-CSRF-Token": csrfToken
            }
        }).then(doc => {
            doc.data.forEach(subcategoria => {
                let option = document.createElement('option')
                option.value = subcategoria.id;
                option.innerText = subcategoria.nome
                document.getElementById('parent_id').appendChild(option)
            })
        }).catch(error => console.log(error))

        // Selecionado
        document.getElementById('categoria_id').addEventListener('change', function() {
            Array.from(document.getElementById('parent_id').children).forEach((element, item) => {
                if (item != 0) element.remove()
            })
            categoria.categoria_id = document.getElementById('categoria_id').value
            axios.post(`{{ route('fornecedorCategoria.change') }}`, categoria, {
                headers: {
                    "X-CSRF-Token": csrfToken
                }
            }).then(doc => {
                doc.data.forEach(subcategoria => {
                    let option = document.createElement('option')
                    option.value = subcategoria.id;
                    option.innerText = subcategoria.nome
                    document.getElementById('parent_id').appendChild(option)
                })
            }).catch(error => console.log(error))
        })
    </script>
@endpush
