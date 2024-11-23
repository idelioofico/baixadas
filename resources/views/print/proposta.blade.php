<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <style>
        .table-bordered {
            border-collapse: collapse;
            width: 100%;
        }


        .table-bordered,
        .table-head,
        .table-body {
            border: 1px solid black;
            /* white-space: nowrap; */
            /* text-align: left; */
            /* padding: 5px; */
            padding-top: 3px;
            padding-bottom: 3px
        }

        .text-center {
            text-align: center;
        }

        /* =============End Helpers ==================*/


        /* ==============Media print================= */
        .title-6 {
            font-size: 8px
        }

        .title-10 {
            font-size: 12px;
        }

        .title-12 {
            font-size: 14px;
        }

        /* ==============End Media Print=============== */
        /* .row {
            display: flex;
            justify-content: space-between;
            width: 100%;
        } */
        .position-r {
            position: relative;
            width: 100%;
        }

        .position-left {}

        .navbar {
            font-family: 'Roboto', sans-serif;
        }

    </style>


    <title>Proposta</title>
</head>

<body>
    <nav>
        <table>
            <td>
                <img src="assets/print/image/testtop.PNG" alt="foto"
                    style="width:250px; height:150px; margin-top:-30;" />
            </td>
            <td style="text-align: center">
                <div>
                    <div style="font-size:30px; font-weight:bold">TES-TOP, Limitada</div>
                    <div style="font-size: 12px; font-weight:bold" class="navbar">MATERIAL ELECTRICO</div>
                    <div style="font-size: 12px; font-weight:bold" class="navbar">ELETRIFICAÇÃO</div>
                    <div style="font-size: 12px; font-weight:bold" class="navbar">HIDRÁULICO</div>
                    <div style="font-size: 12px; font-weight:bold" class="navbar">CONSTRUÇÃO</div>
                    <div style="font-size: 12px; font-weight:bold" class="navbar">COMBUSTIVEIS</div>
                    <div style="font-size: 13px; font-weight:bold; margin-top:12px" class="navbar">FORÇA E
                        DESENVOLVIMENTO</div>
                </div>
            </td>

        </table>
        <table style="width: 100%">
            <td>
                </div>
                <div style="font-size: 12px; font-weight:bold; margin-top:3px" class="navbar">AV. KAL MARX, NO
                    1877 R/C</div>
                <div style="font-size: 12px; font-weight:bold; margin-top:3px" class="navbar">TELEF: 21328056 *
                    FAZ: 21328057
                </div>
                <div style="font-size: 12px; font-weight:bold; margin-top:3px" class="navbar">REPUBLICA DE
                    MOCAMBIQUE</div>
                <div style="font-size: 12px; font-weight:bold; margin-top:3px" class="navbar">EMAIL:
                    proccurement@testop.co.mz
                </div>
                <div style="font-size: 12px; font-weight:bold; margin-top:3px" class="navbar">info@testop.co.mz
                </div>
                <div style="font-size: 12px; font-weight:bold; margin-top:3px" class="navbar">NUIT: 400 670 021
                </div>
                </div>
            </td>
            <td style="text-align: right;">
                <img src="assets/print/image/LOGO.PNG" alt="foto" style="width:250px; height:80px; margin-top:30px" />
            </td>
        </table>


    </nav>

    <main style="width: 100%; border-top:3px solid red; margin-top:10px">

        <section class="row mt-1">
            <table style="width: 100%">
                <td class="table-body">
                    <div style="font-size: 14px; font-weight:bold; margin-top:3px" class="navbar">
                        <div>A: {{ $guia->cliente->nome }}</div>
                        <div>{{ $guia->endereco_empresa }}</div>
                        <div>NUIT: {{ $guia->nuit }}</div>
                    </div>

                </td>
                <td style="padding: 30px">

                </td>

                <td class="table-body">
                    <div style="font-size: 14px; font-weight:bold; margin-top:3px" class="navbar">
                        <div>PROPOSTA</div>
                        <div>No. {{ $guia->proposta_numero }}</div>
                        <div>DATA: {{ date('d/m/Y', strtotime($guia->data)) }}</div>
                    </div>
                </td>
            </table>
        </section>




        <section class="mt-4 p-5" style="text-align: center">
            <table style="border-collapse: collapse;
            width: 100%;">
                <thead>
                    <tr style="font-size: 13px">
                        <th width="10px" class="table-head">ITEM.</th>
                        <th width="300px" class="table-head">DESIGNAÇÃO.</th>
                        <th width="10px" class="table-head">UN</th>
                        <th width="10px" class="table-head">ENTREGA</th>
                        <th width="10px" class="table-head">QTY</th>
                        <th width="10px" class="table-head">PRECO UNIT.(MT)</th>
                        <th width="10px" class="table-head">PREÇO TOT.(MT)</th>
                    </tr>
                </thead>
                @php
                    $i = 1;
                @endphp
                <tbody>
                    @foreach ($guia->propostaProdutos as $item)
                        <tr class="table-bordered">
                            <td width="10px" class="table-bordered">{{ $i++ }}</td>
                            <td width="300px" class="table-bordered">{{ $item->produto->nome }}</td>
                            <td width="10px" class="table-bordered text-center">{{ $item->produto->unidade_total }}
                            </td>
                            <td width="10px" class="table-bordered">{{ $item->entrega }}</td>
                            <td width="10px" class="table-bordered">{{ $item->quantidade }}</td>
                            <td width="10px" class="table-bordered">{{ $item->preco_unitario }}</td>
                            <td width="10px" class="table-bordered">{{ $item->preco_total }}</td>
                        </tr>
                    @endforeach


                    <tr>
                        <td width="10px"></td>
                        <td width="300px"></td>
                        <td width="10px"></td>
                        <td width="10px"></td>
                        <td width="10px"></td>
                        <td width="10px" class="table-bordered">SUBTOTAL</td>
                        <td width="10px" class="table-bordered">
                            {{ $guia->propostaProdutos->sum('preco_total') }}</td>

                    </tr>
                    <tr>
                        <td width="10px"></td>
                        <td width="300px"></td>
                        <td width="10px"></td>
                        <td width="10px"></td>
                        <td width="10px"></td>
                        <td width="10px" class="table-bordered" style="font-weight:bold;">IVA 17%</td>
                        <td width="10px" class="table-bordered" style="font-weight:bold;">
                            {{ $guia->propostaProdutos->sum('preco_total') * 0.17 }}</td>

                    </tr>
                    <tr>
                        <td width="10px"></td>
                        <td width="300px"></td>
                        <td width="10px"></td>
                        <td width="10px"></td>
                        <td width="10px"></td>
                        <td width="10px" class="table-bordered" style="font-weight:bold;">TOTAL</td>
                        <td width="10px" class="table-bordered" style="font-weight:bold;">
                            {{ $guia->propostaProdutos->sum('preco_total') * 0.17 + $guia->propostaProdutos->sum('preco_total') }}
                        </td>

                    </tr>

                </tbody>
            </table>
        </section>
        <section style="font-size: 15px; font-weight:bold; margin-top:0px">
            <div class="pt-3">
                <div style="margin-top:0px" class="navbar">Detalhes Bancarios
                </div>
            </div>
            <div style="margin-top:5px" class="navbar">EMPRESA: TES-TOP, LDA</div>
            <div style="margin-top:5px" class="navbar">Banco: BCI</div>
            <div style="margin-top:5px" class="navbar">Detalhes Bancarios</div>
            <div style="margin-top:5px" class="navbar">Numero de conta BCI: 50312941005</div>
            <div style="margin-top:5px" class="navbar">NIB: 000800000503129410568</div>

            <div class="pt-3">
                <div style="margin-top:15px">CONDIÇÕES:
                </div>
            </div>
            <div style="margin-top:5px" class="navbar">Pagamento: {{ $guia->pagamento }}</div>
            <div style="margin-top:5px" class="navbar">Validade: {{ $guia->validade }}</div>
            <div style="margin-top:5px" class="navbar">
                Entrega : {{ $guia->entrega }}
            </div>

            <div>
                <div style="margin-top:15px">Notas:
                </div>
            </div>
            <div style="margin-top:5px" class="navbar">
                Para validar a aceitação da proposta, nos envie a vossa Requisição
                assinada e carimbada para posterior entrega do referido material.
            </div>
            <div style="margin-top:5px" class="navbar">
                No acto do levantamento devera ser apresentada a devida
                documentação.
            </div>



            <div style="margin-top: 10px; text-align:center">
                <img src="assets/print/image/assinatura.PNG" alt="foto" style="width:200px; height:150px;" />
            </div>
        </section>
    </main>


</body>

</html>
