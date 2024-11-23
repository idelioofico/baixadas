<!DOCTYPE html>
 
<html lang="pt-pt">

    <head>
        <meta charset="utf-8">
        <title>Guia de Entrada</title>
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="invoice_tamplate/css/template.css"> 
 
        <style>
            .pagenum:before {
                content: counter(page);
            }

              /** Define the margins of your page **/
            @page {
                margin: 100px 25px;
            }

            header {
                position: fixed;
                top: -60px;
                left: 0px;
                right: 0px;
                height: 50px;

                /** Extra personal styles **/
                background-color: #03a9f4;
                color: white;
                text-align: center;
                line-height: 35px;
            }

            footer {
                position: fixed; 
                bottom: -60px; 
                left: 0px; 
                right: 0px;
                height: 50px; 

                /** Extra personal styles **/
                background-color: #03a9f4;
                color: white;
                text-align: center;
                line-height: 35px;
            }
            
        </style>
    </head>

    <body>
  

        <div id="container">

            <div>
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
                
                    <span id="title">Guia de Entrada</span>
                    <span id="number"># {{ $guia->numero_do_folheto }}</span>

                    <div style="position: relative; left: 950px; background:rgba(74, 69, 69, 0.819); border-radius: 12px; top: -36px; padding: 7px">
                        <span style="color: white">pag.</span><span class="pagenum" style="color: white"></span>
                    </div>
                </section>
    
                
                <section id="client-info" style="border: 1px solid rgb(189, 197, 203); padding: 12px; border-radius: 5px; margin-top: 7px; padding-bottom: 0">
    
    
                    <div style="margin-bottom: 12px;">
                        <span>Tipo de Material:</span>
                        <span class="bold" style="text-transform: uppercase; margin-top: 3px">
                            {{ $subcategoria->find($guia->categoria_id) }}
                        </span>
                    </div>
                    
                    
    
                    <div style="position: relative; left: 290px; top: -33px;">
                        <span>Fornecedor: </span>
                        <span style="text-transform: uppercase; margin-top: 3px"> <b>{{ $guia->fornecedor['nome'] }}</b></span>
                    </div>
    
                    
                    <div style="position: relative; left: 600px; top: -65px">
                        <span>Responsavel: </span>
                        <span style="text-transform: uppercase; margin-top: 3px"> <b>{{ $guia->responsavel }}</b></span>
                    </div>
    
                    
                    <div style="margin-bottom: 12px; margin-top: -80px">
                        <span>Nr. Factura/Packink List:</span>
                        <span style="text-transform: uppercase; margin-top: 3px">
                            <b>{{ $guia->numero_da_fatura }} - {{ $guia->packing_list }}</b>
                        </span>
                    </div>
                    
                    {{-- <div style="margin-top: -180px; position: relative; left: 600px;">
                        <span>Outros Documentos:</span>
                        <span style="text-transform: uppercase; margin-top: 3px; word"> 
                            <b>{{ $guia->outros_documentos }}</b>
                        </span>
                    </div>  --}}
                    
                    <div style="margin-top: -180px; position: relative; left: 290px; margin-bottom: 5px">
                        <span>Maputo aos:</span>
                        <span style="text-transform: uppercase; margin-top: 3px"> 
                            <b>{{ date('d/m/Y', strtotime($guia->data)) }}</b>
                        </span>
                    </div> 
    
                </section>
            </div>
            
            <div class="clearfix"></div>

            
            <br><br><br><br>
            <div style="clear:both"></div>
            
            <section id="items">
                
                <table cellpadding="0" cellspacing="0">
                
                    <tr>
                        <th style="text-align: center" width="10%">#</th>   
                        <th >Descrição do Material</th>
                        <th style="text-align: center">Unid.</th>
                        <th style="text-align: center">Quant.</th>
                        <th style="text-align: center">Custo Unit.</th>
                        <th style="text-align: center">Valor</th>
                    </tr>
                     
                    @php
                        $i = 1;
                        $total = 0;
                    @endphp
                
                    @foreach ($guia->guiaEntradaProduto as $item)
                    
                        <tr data-iterate="item"> 
                            <td style="text-align: center;" >{{ $i++ }}</td>
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
                        <td style="text-align: center; font-weight: 700">Totais:</td>
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
                
                <table cellpadding="0" cellspacing="0" style="margin-top: 200px">
                
                    <tr>
                        <th style="text-align: center; font-size: 12px; text-transform: capitalize; background: none;color: rgba(0, 0, 0, 0.644)">
                            Fiel do Armazém <br><br><br> __________________________
                        </th>  
                        <th style="text-align: center; font-size: 12px; text-transform: capitalize; background: none;color: rgba(0, 0, 0, 0.644)">
                            Assistente do Armazém <br><br><br> __________________________
                        </th>  
                        <th style="text-align: center; font-size: 12px; text-transform: capitalize; background: none;color: rgba(0, 0, 0, 0.644)">
                            Procurement <br><br><br> __________________________
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
