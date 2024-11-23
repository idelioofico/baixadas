<!doctype html>
<html lang="en">
@php
    $i=1;
@endphp
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('assets/print/css/style.css')}}">
    

    <title>Guia de Entrada</title>
</head>

<body >

    <nav class="container mb-5">
        <section class="row">
            <article class="col-md-2">
                <div class="image">
                    <img src="{{asset('assets/print/image/testtop.PNG')}}" alt="foto" class="image" />
                    <img src="{{asset('assets/print/image/logos-abaixo.PNG')}}" alt="foto" />
                </div>
            </article>
            <article class="col-md-4">
                <div class="d-flex justify-content-start">
                   
                    <div class="font-weight-bold font-size-5 text-center">
                        <h1 class="title-18 font-weight-bold">TES-TOP, LDA</h1>
                        <div>FORÇA E DESENVOLVIMENTO</div>
                        <div>MATERIAL | MATERIAL  HIDRÁULICO | ELETRIFICAÇÃO</div>
                        <div>CONSTRUÇÃO | COMBUSTIVEL</div>
                    </div>
                </div>
            </article>
            <article class="col-md-3 font-weight-bold font-size-13">
                <div>No de Contribuinte 400 670 021</div>
                <div>Av. Karl Max 1877, R/C</div>
                <div>Maputo - Mocambique</div>
                <div>Telef. +258 21328056</div>
                <div>Fex, +258 21328 057</div>
                <div>E-mail: producao@testop.co.mz</div>
            </article>
            <article class="col-md-3 text-center ">
                <h1 class="title-18 font-weight-bold">No. <span class="text-danger">000659</span> </h1>
                <h1 class="title-18 font-weight-bold">GUIA DE ENTRADA DE MATERIAL</h1>
            </article>
        </section>
    </nav>
    <main class="container">
        <section class="row">
            <div class="col-md-6 line-height-12">
                <p><span class="font-weight-bold">Tipo de Material : </span> {{$subcategoria->find($guia->categoria_id)->nome}}</p>
                <p><span class="font-weight-bold">Fornecedor :</span> {{$guia->fornecedor->nome}}</p>
                <p><span class="font-weight-bold">Responsavel :</span> {{$guia->responsavel}}</p>
                <p><span class="font-weight-bold">No da Factura/Packink List:</span> {{$guia->numero_da_fatura}} {{$guia->packing_list}}</p>
            </div>
            <div class="col-md-6 d-flex align-items-end justify-content-end line-height-12">
                <p><span>Maputo aos :</span> {{date('d/m/Y', strtotime($guia->data))}}</p>
            </div>
        </section>

        <section class="mt-4">
            <table class="table ">
                <thead>
                    <tr>
                        <th class="gg">Item</th>
                        <th class="gg">Cod.</th>
                        <th class="ggg">Descrição  do Material</th>
                        <th class="gg">Unid.</th>
                        <th class="gg">Quant.</th>
                        <th class="gg">Custo Unit.</th>
                        <th class="gg">Valor</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($guia->guiaEntradaProduto as $item)
                        <tr>
                            <td>{{$i++}}</td>
                            {{-- <td>{{$item->produto->codigo}}</td> --}}
                            <td class="text-center">---</td>
                            <td>{{$item->produto->nome}}</td>
                            <td>m</td>
                            <td>{{$item->quantidade}}</td>
                            <td>{{$item->custo_unitario?$item->custo_unitario:'-'}}</td>
                            <td>{{$item->valor?$item->valor:'-'}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        <section class="mt-5">
            <article class="row">
                <div class="col-md-4 text-center">
                    <p style="text-decoration: underline">Iyonissio daniel Sitoe</p>
                    <p>(Fiel do Armazem)</p>
                </div>
                <div class="col-md-4 text-center">
                    <p style="text-decoration: underline">Filipe Manuel</p>
                    <p>(Assistente do Armazem)</p>
                </div>
                <div class="col-md-4 text-center">
                    <p style="text-decoration: underline">Manuel Monjane</p>
                    <p>(Procurement)</p>
                </div>
            </article>
        </section>
    </main>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
        <script src="extensions/print/bootstrap-table-print.js"></script>
<!-- 
    <script>
        document.title = ''; window.print();
    </script> -->
</body>

</html>