 
<html lang="pt-pt">

    <head>
        <meta charset="utf-8">
        <title>Execução DIARIA DE Material das BAIXADAS - {{ ($site_data) }}</title>
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="invoice_tamplate/css/template.css"> 
 
        <style>
            .pagenum:before {
                content: counter(page);
            }

            body {
                font-family: 'Nova Mono', monospace;
                color: #121212;
                line-height: 22px;
            }

            .table {
                border-collapse: collapse;
            }
            .p-2 {
                padding: 0.5rem!important;
            }

            .table-bordered td, .table-bordered th {
                border: 1px solid #e9ecef;
            }

            .table td, .table th {
                padding: 0;
                font-size: 12px;
            }

            .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th {
                border-top: 1px solid #e8e8e8;
            }
 
            .table td,
            .table th {
                padding: 0;
                font-size: 12px;
            }

            .text-center {
                text-align: center!important;
            }

            .p-2 {
                padding-top: 12px; text-align: center;
            }
        </style>
    </head>

    <body>
  

        <div id="container">

            <div style="position: relative">
                <section id="memo" >

                    <div class="logo">
                        <img style="width: 200px; height: 100px" src="assets/logo.png" />
                    </div>
                    
                    <div class="company-info">
                        <div>TES-TOP, LDA</div>
    
                        <br />
                        
                        <span>Moçambique, MAPUTO </span>
                        <span>AV. KARL MARX, Nº1877 R/C</span>
    
                        <br />
                        
                        <span>+258 21328056</span>
                        <span>testop.co.mz | info@testop.co.mz</span>
                    </div>
    
                </section>
    
                <section id="invoice-title-number">
                
                    <span id="title">Execução/Saida diária de Material - {{ ($site_data) }}</span>
                     
                </section>
            </div>
 
            
            
            <section id="items" >
                
                <table  class="table table-hover table-dashed table-striped table-bordered" >
                    <thead class="thead-default">
                        <tr>
                            <th colspan="15" style="color: black; text-align: center; padding: 12px">Materiais e Acessórios Fornecidos</th>
                        </tr>
                    </thead>
                    <thead class="thead-default" >
                        <tr>
                            <th colspan="4" style="padding-bottom: 6px; color: black; text-align: center; background: darkgray"></th> 
                            <th colspan="2" style="padding-bottom: 6px; color: black; text-align: center; background: #c2e0f4;">
                                Caixas
                            </th>
                            <th colspan="2" style="padding-bottom: 6px; color: black; text-align: center; background: #d21e1e5e;">
                                Cabos ABC (m)
                            </th>
                            <th colspan="2" style="padding-bottom: 6px; color: black; text-align: center; background: burlywood;">
                                Contadores
                            </th>
                            <th colspan="2" style="padding-bottom: 6px; color: black; text-align: center; background: darkseagreen;">
                                Pinças
                            </th>
                            <th colspan="3" style="padding-bottom: 6px; color: black; text-align: center; background: aquamarine">
                                Ligadores
                            </th>
                        </tr>
                    </thead>
                    <thead class="thead-default" >
                        <tr>
                            
                            <th class="'" style="text-align: center; padding-bottom 5px: 12px; font-size: 10px; color: black; background: burlywood; width: 10%">
                                Projecto | Site
                            </th>
                            
                            <th class="p-2 mt-1 mb-1 th_br" 
                            style="padding-bottom 5px: 12px; text-align: center; font-size: 10px; color: black; background: burlywood; width: 15%; text-align: center"
                            >
                                Destino 
                            </th>
                            <th style="padding-bottom 5px: 12px; text-align: center; font-size: 10px; color: black; background: burlywood; width: 5%; text-align: center">
                                Data
                            </th>
                            <th style="padding-bottom 5px: 12px; text-align: center; font-size: 10px; color: black; background: burlywood">
                                Quadrelec
                            </th>
                            <th style="padding-bottom 5px: 12px; text-align: center; font-size: 10px; color: black; background: #c2e0f4;">
                                Mod 2
                            </th>
                            <th style="padding-bottom 5px: 12px; text-align: center; font-size: 10px; color: black; background: #c2e0f4;">
                                Mod 4
                            </th>
                            <th style="padding-bottom 5px: 12px; text-align: center; font-size: 10px; color: black; background: #d21e1e5e;">
                                2x10 mm2
                            </th>
                            <th style="padding-bottom 5px: 12px; text-align: center; font-size: 10px; color: black; background: #d21e1e5e;">
                                4x16 mm2
                            </th>
                            <th style="padding-bottom 5px: 12px; text-align: center; font-size: 10px; color: black; background: burlywood;">
                                Mono
                            </th>
                            <th style="padding-bottom 5px: 12px; text-align: center; font-size: 10px; color: black; background: burlywood;">
                                Trifasico
                            </th>
                            <th style="padding-bottom 5px: 12px; text-align: center; font-size: 10px; color: black; background: darkseagreen;">
                                2x16 mm2
                            </th>
                            <th style="padding-bottom 5px: 12px; text-align: center; font-size: 10px; color: black; background: darkseagreen;">
                                4x25 mm2
                            </th>
                            <th style="padding-bottom 5px: 12px; text-align: center; font-size: 10px; color: black; background: aquamarine">PC 1</th>
                            <th style="padding-bottom 5px: 12px; text-align: center; font-size: 10px; color: black; background: aquamarine">PC 2</th> 
                            <th style="padding-bottom 5px: 12px; text-align: center; font-size: 10px; color: black; background: aquamarine">PC 3</th> 
                        </tr>
                    </thead>
                    <tbody>

                        @php
                            $i = 1;
                            $quadrelec = 0;
                            $total_cabos_abc1 = 0;
                            $total_cabos_abc2 = 0;
                            $total_pinca1 = 0;
                            $total_pinca2 = 0;
                            $total_cx_2 = 0;
                            $total_cx_4 = 0;
                            $total_pc1 = 0;
                            $total_pc2 = 0;
                            $total_pc3 = 0;
                            $cont_mono = 0;
                            $cont_trif = 0;
                            $total_caixa_proteccao = 0;
                        @endphp

                        @forelse ($saidas as $data)
                            <tr>
                                <td style="padding-top: 12px; font-size: 10px; color: black; text-align: center; width: 15%"> 
                                    {{ $data->site_nome }} 
                                </td> 
                                <td class="p-2 mt-1 mb-1 '" 
                                    style="padding-top: 12px; font-size: 10px; color: black; text-align: center; width: 5%"> 
                                    {{ $data->destino }} 
                                </td>
                                <td style="padding-top: 12px; text-align: center; font-size: 10px; color: black; text-align: center; width: 10%" > 
                                    {{ $data->data }} 
                                </td>
                                <td style="padding-top: 12px; text-align: center; font-size: 10px; color: black; text-align: center" >
                                    {{ $data->quadrelec }} 
                                </td>
                                <td style="padding-top: 12px; text-align: center; font-size: 10px; color: black; text-align: center" >
                                    {{ $data->cx_md_2 }} 
                                </td>
                                <td style="padding-top: 12px; text-align: center; font-size: 10px; color: black; text-align: center" >
                                    {{ $data->cx_md_4 }} 
                                </td>
                                <td style="padding-top: 12px; text-align: center; font-size: 10px; color: black; text-align: center" >
                                    {{ $data->cb_210_mm2 }} 
                                </td>
                                <td style="padding-top: 12px; text-align: center; font-size: 10px; color: black; text-align: center" >
                                    {{ $data->cb_416_mm2 }} 
                                </td>
                                <td style="padding-top: 12px; text-align: center; font-size: 10px; color: black; text-align: center" >
                                    {{ $data->contador_mono }} 
                                </td>
                                <td style="padding-top: 12px; text-align: center; font-size: 10px; color: black; text-align: center" >
                                    {{ $data->contador_trifasico }} 
                                </td>
                                <td style="padding-top: 12px; text-align: center; font-size: 10px; color: black; text-align: center" >
                                    {{ $data->pm_216 }} 
                                </td>
                                <td style="padding-top: 12px; text-align: center; font-size: 10px; color: black; text-align: center" >
                                    {{ $data->pm_425 }} 
                                </td>
                                <td style="padding-top: 12px; text-align: center; font-size: 10px; color: black; text-align: center" >
                                    {{ $data->l_pc1 }} 
                                </td>
                                <td style="padding-top: 12px; text-align: center; font-size: 10px; color: black; text-align: center" >
                                    {{ $data->l_pc2 }} 
                                </td> 
                                <td style="padding-top: 12px; text-align: center; font-size: 10px; color: black; text-align: center" >
                                    {{ $data->l_pc3 }} 
                                </td> 
                            </tr>

                            @php
                                $quadrelec += $data->quadrelec;
                                $total_cx_2 += $data->cx_md_2;
                                $total_cx_4 += $data->cx_md_4;
                                $total_cabos_abc1 += $data->cb_210_mm2;
                                $total_cabos_abc2 += $data->cb_416_mm2;
                                $total_pinca1 += $data->pm_216;
                                $total_pinca2 += $data->pm_425;
                                $total_pc1 += $data->l_pc1;
                                $total_pc2 += $data->l_pc2;
                                $total_pc3 += $data->l_pc3;
                                $cont_trif += $data->contador_trifasico;
                                $cont_mono += $data->contador_mono;
                            @endphp

                        @empty
                            <tr>
                                <td colspan="14" class="text-center bg-blue-100">
                                    Sem registos!
                                </td>
                            </tr>
                        @endforelse

                        <tr> 
                            <td colspan="4" style="padding: 12px; text-align:right; font-weight: 900; font-size: 12px; background: darkgray">{{ $quadrelec }} &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</td> 
                            <td style="padding: 12px; text-align:center; font-weight: 900; font-size: 12px; background: #c2e0f4;">     
                                {{ $total_cx_2 }}
                            </td>
                            <td style="padding: 12px; text-align:center; font-weight: 900; font-size: 12px; background: #c2e0f4;">     
                                {{ $total_cx_4 }}
                            </td>
                            <td style="padding: 12px; text-align:center; font-weight: 900; font-size: 12px; background: #d21e1e5e;">
                                {{ $total_cabos_abc1 }}
                            </td>
                            <td style="padding: 12px; text-align:center; font-weight: 900; font-size: 12px; background: #d21e1e5e;">
                                {{ $total_cabos_abc2 }}
                            </td>
                            <td style="padding: 12px; text-align:center; font-weight: 900; font-size: 12px; background: burlywood ">
                                {{ $cont_mono }}
                            </td>
                            <td style="padding: 12px; text-align:center; font-weight: 900; font-size: 12px; background: burlywood ">
                                {{ $cont_trif }}
                            </td>
                            <td style="padding: 12px; text-align:center; font-weight: 900; font-size: 12px; background: darkseagreen; ">
                                {{ $total_pinca1 }}
                            </td>
                            <td style="padding: 12px; text-align:center; font-weight: 900; font-size: 12px; background: darkseagreen; ">
                                {{ $total_pinca2 }}
                            </td>
                            <td style="padding: 12px; text-align:center; font-weight: 900; font-size: 12px; background: aquamarine ">
                                {{ $total_pc1 }}
                            </td>
                            <td style="padding: 12px; text-align:center; font-weight: 900; font-size: 12px; background: aquamarine ">
                                {{ $total_pc2 }}
                            </td>
                            <td style="padding: 12px; text-align:center; font-weight: 900; font-size: 12px; background: aquamarine ">
                                {{ $total_pc3 }}
                            </td>
                        </tr>

                    </tbody>

                </table>
                
            </section>
            
            <section id="sums">
            
                <table> </table>
                <div class="clearfix"></div>
                
            </section>
             

        </div>

        
    </body>
</html>
