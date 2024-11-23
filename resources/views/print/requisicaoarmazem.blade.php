<!DOCTYPE html>
 
<html lang="pt-pt">

    <head>
        <meta charset="utf-8">
        <title>Requisição ao Armazém</title>
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="invoice_tamplate/css/template.css"> 
 
        <style>
            .pagenum:before {
                content: counter(page);
            }
        </style>
    </head>

    <body>
  

        <div id="container">

            <section id="memo">

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
            
                <span id="title">Requisição ao Armazém</span>
                <span id="number">#{{ $guia->numero_do_folheto ? $guia->numero_do_folheto : 'n/a' }}</span>
                
                <div style="position: relative; left: 950px; background:rgba(74, 69, 69, 0.819); border-radius: 12px; top: -36px; padding: 7px">
                    <span style="color: white">pag.</span><span class="pagenum" style="color: white"></span>
                </div>
            </section>
 
            
            <div class="clearfix"></div>
            
            <section id="client-info" style="border: 1px solid rgb(189, 197, 203); padding: 12px; border-radius: 5px; margin-top: 47px; padding-bottom: 0">


                <div style="margin-bottom: 12px;">
                    <span>Requisitante:</span>
                    <span class="bold" style="text-transform: uppercase; margin-top: 3px">{{ $guia->requisitante }}</span>
                </div>
                
                

                <div style="position: relative; left: 290px; top: -43px">
                    <span>Data: </span>
                    <span style="text-transform: uppercase; margin-top: 3px"> <b>{{ $guia->data }}</b></span>
                </div>

                
                <div style="position: relative; left: 510px; top: -75px">
                    <span>Hora: </span>
                    <span style="text-transform: uppercase; margin-top: 3px"> <b>{{ $guia->data }}</b></span>
                </div>

                
                <div style="margin-top: -180px; position: relative; left: 290px;">
                    <span>Motivo da Requisição:</span>
                    <span style="text-transform: uppercase; margin-top: 3px"> 
                        <b>
                            {{ $guia->motivo_de_requisicao == 1 ? 'Avaria / Reparação' : '' }}
                            {{ $guia->motivo_de_requisicao == 2 ? 'Manutenção' : '' }}
                            {{ $guia->motivo_de_requisicao == 3 ? 'Fornecimento' : '' }} 
                            {{ $guia->motivo_de_requisicao == 4 ? 'Outros' : '' }} 
                        </b>
                    </span>
                </div> 
                
                <div style="margin-bottom: 12px; margin-top: -80px">
                    <span>Aplicação:</span>
                    <span style="text-transform: uppercase; margin-top: 3px"> <b>{{ $guia->aplicacao }}</b></span>
                </div>

            </section>
            
            <div class="clearfix"></div>
            
            <section id="items">
                
                <table cellpadding="0" cellspacing="0">
                
                    <tr>
                        <th style="text-align: center" width="10%">#</th>  
                        <th>Descrição</th>
                        <th width="15%" style="text-align: right">Quantidade</th>
                        <th style="text-align: center">Unidade</th> 
                    </tr>
                     
                    @php
                        $i = 1;
                        $total = 0;
                    @endphp
                
                    @foreach ($guia->requisicaoProduto as $item)
                    
                        <tr data-iterate="item">
                            <td width="5%" style="text-align: center">{{ $i++ }}</td>
                            <td>{{ $item->produto->nome }}</td>
                            <td width="15%" style="text-align: right">{{ $item->quantidade }}</td>
                            <td style="font-size: 13px; text-align: center">{{ $item->produto->unidade_total }}</td> 
                        </tr>

                        @php
                            $total += $item->quantidade;
                        @endphp
                    @endforeach

                    <tr data-iterate="item" style="background: rgb(189, 197, 203)">
                        <td>---</td>
                        <td style="text-align: left; font-weight: 700">Totais:</td>
                        <td style="text-align: right; font-weight: 800; color: black">{{ number_format($total, 2) }}</td>
                        <td  style="text-align: center">---</td>
                    </tr>

                </table>
                
            </section>
            
            <section id="sums">
            
                <table> </table>
                <div class="clearfix"></div>
                
            </section>

            <section id="items">
                
                <b>Observações:</b>
                <div style="border: 1px solid rgb(189, 197, 203); padding: 12px; border-radius: 5px; margin-top: 7px">
                    <span >
                        {{ $guia->obs }}
                    </span>
                </div>

            </section>
            
            <div class="clearfix"></div>

            <section id="items">
                
                <table cellpadding="0" cellspacing="0" style="margin-top: 200px">
                
                    <tr>
                        <th style="text-align: center; font-size: 12px; text-transform: capitalize; background: none;color: rgba(0, 0, 0, 0.644)">
                            Elaborado ({{ $guia->laborado_por }}) <br><br><br>  _____________________________
                        </th>  
                        <th style="text-align: center; font-size: 12px; text-transform: capitalize; background: none;color: rgba(0, 0, 0, 0.644)">
                            Autorizado ({{ $guia->autorizado_por }}) <br><br><br>  _____________________________
                        </th>  
                        <th style="text-align: center; font-size: 12px; text-transform: capitalize; background: none;color: rgba(0, 0, 0, 0.644)">
                            Entregue <br><br><br>  _____________________________
                        </th>  
                        <th style="text-align: center; font-size: 12px; text-transform: capitalize; background: none;color: rgba(0, 0, 0, 0.644)">
                            Levantado <br><br><br>  _____________________________
                        </th>  
                    </tr>
                     
                </table>
                
            </section>
              
            <section class="footer" >
                <span style="color: black;  font-weight: 700">MD001</span>
            </section>

        </div>

        
    </body>
</html>
