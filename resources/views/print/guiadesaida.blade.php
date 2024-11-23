<!DOCTYPE html>
 
<html lang="pt-pt">

    <head>
        <meta charset="utf-8">
        <title>Guia de Saida</title>
        
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
            
                <span id="title">Guia de Saída</span>
                <span id="number"># {{ $guia->numero_do_folheto }}</span>

                <div style="position: relative; left: 950px; background:rgba(74, 69, 69, 0.819); border-radius: 12px; top: -36px; padding: 7px">
                    <span style="color: white">pag.</span><span class="pagenum" style="color: white"></span>
                </div>
            </section>

            
            <div class="clearfix"></div>
            
            <section id="client-info" style="border: 1px solid rgb(189, 197, 203); padding: 12px; border-radius: 5px; margin-top: 47px; padding-bottom: 0">


                <div style="margin-bottom: 12px;">
                    <span>Destino do Material:</span>
                    <span class="bold" style="text-transform: uppercase; margin-top: 3px">
                        {{ $guia->destino_do_material }}
                    </span>
                </div>
                
                

                <div style="position: relative; left: 290px; top: -33px;">
                    <span>Cliente/ Nr Obra: </span>
                    <span style="text-transform: uppercase; margin-top: 3px"> <b>{{ $guia->requisicaoArmazem->aplicacao }}</b></span>
                </div>

                
                <div style="position: relative; left: 600px; top: -65px">
                    <span>Requisitante: </span>
                    <span style="text-transform: uppercase; margin-top: 3px"> <b>{{ $guia->requisitante }}</b></span>
                </div>

                
                <div style="margin-bottom: 12px; margin-top: -80px">
                    <span>Departamento:</span>
                    <span style="text-transform: uppercase; margin-top: 3px">
                        <b>{{ $guia->departamento }}</b>
                    </span>
                </div>
                
                <div style="margin-top: -180px; position: relative; left: 600px;">
                    <span>Documentos Assoc:</span>
                    <span style="text-transform: uppercase; margin-top: 3px"> 
                        <b>{{ $guia->documentos_assoc }}</b>
                    </span>
                </div> 
                
                <div style="margin-top: -180px; position: relative; left: 290px;">
                    <span>Maputo aos:</span>
                    <span style="text-transform: uppercase; margin-top: 3px"> 
                        <b>{{ date('d/m/Y', strtotime($guia->data_do_document)) }}</b>
                    </span>
                </div> 

            </section>
            
            <div class="clearfix"></div>
            
            <section id="items">
                <table cellpadding="0" cellspacing="0">
                
                    <tr>
                        <th style="text-align: center" >#</th>   
                        <th>Descrição do Material</th>
                        <th style="text-align: center">Unid.</th>
                        <th style="text-align: center">Quant.</th>
                        <th style="text-align: center">Custo Unit.</th>
                        <th style="text-align: center">Valor</th>
                    </tr>
                     
                    @php
                        $i = 1;
                        $total = 0;
                    @endphp
                
                    @foreach ($guia->guiaSaidaProdutos as $item)
                    
                        <tr> 
                            <td style="text-align: center">{{ $i++ }}</td>
                            <td>{{ $item->produto->nome }}</td>
                            <td style="text-align: center">{{ $item->produto->unidade_total }}</td>
                            <td style="text-align: center">{{ $item->quantidade }}</td>
                            <td style="text-align: center">
                                {{ $item->custo_unitario ? $item->custo_unitario : '-' }}
                            </td>
                            <td style="text-align: center">{{ $item->valor ? $item->valor : '-' }}</td>

                        </tr>

                        @php
                            $total += $item->quantidade;
                        @endphp
                    @endforeach

                    <tr data-iterate="item" style="background: rgb(189, 197, 203)">
                        <td style="text-align: left; font-weight: 700">Totais:</td>
                        <td style="text-align: center">---</td>
                        <td style="text-align: center">---</td>
                        <td style="text-align: center; font-weight: 800; color: black">{{ number_format($total, 2) }}</td>
                        <td style="text-align: center">---</td>
                        <td style="text-align: center">---</td>
                    </tr>

                </table>
                
            </section>
            
            <section id="sums">
            
                <table> </table>
                <div class="clearfix"></div>
                
            </section>
 
            
            <div class="clearfix"></div>

            

            <section id="items">
            
                <span>Fornecido em:  ____/____/______</span> 
                <span style="margin-left: 536px ">Recebido em:  ____/____/______</span>
                
            </section>


            <section id="items">
                
                <table cellpadding="0" cellspacing="0" style="margin-top: 200px">
                
                    <tr> 
                        <th style="text-align: center; font-size: 12px; text-transform: capitalize; background: none;color: rgba(0, 0, 0, 0.644)">
                            Fiel do Armazem ({{ $guia->fiel_do_armazem }}): <br><br><br>  _____________________________
                        </th>  
                        
                        <th style="text-align: center; font-size: 12px; text-transform: capitalize; background: none;color: rgba(0, 0, 0, 0.644)">
                            Assistente ({{ $guia->assistente_do_armazem }}): <br><br><br>  _____________________________
                        </th>   
                       
                        <th style="text-align: center; font-size: 12px; text-transform: capitalize; background: none;color: rgba(0, 0, 0, 0.644)">
                            Levantado por ({{ $guia->levantado_por }}): <br><br><br>  _____________________________
                        </th>  
                        
                        <th style="text-align: center; font-size: 12px; text-transform: capitalize; background: none;color: rgba(0, 0, 0, 0.644)">
                            Procurement <br><br><br>  _____________________________
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
