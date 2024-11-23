@php
ini_set('maxdb_execution_time', 3000);
ini_set('max_execution_time', 3000);
ini_set('memory_limit', '512M');
@endphp

<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
    <meta charset="UTF-8" http-equiv="Content-Type" content="text/html;">
    <title>Guia de Transporte</title>
</head>

<style>
    body {
        font-family: 'Nova Mono', monospace;
        color: #121212;
        line-height: 22px;
    }

    table,
    tr,
    td {
        border-bottom: 1px solid #000000;
        padding: 3px 0px;
    }

    tr {
        height: 10px;
    }


    .footer1 {
        bottom: -90px;
        width: 100%;
        /* Set the fixed height of the footer here */
        height: 230px;
        /*background-color: #f5f5f5*/
        ;
    }

    .footer {
        position: absolute;
        bottom: 1px;
        width: 100%;
        /* Set the fixed height of the footer here */
        height: 120px;
        /*background-color: #f5f5f5*/
        ;
    }

    .tablefooter {
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 2px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    }

</style>


    <body onLoad="loadHandler();">

        <div>
            <div class="row">
                <div class="form-group">
                    
                    <img src="assets/anexos/logo_empresas/Testop.jpg" width="180">

                    <div style="width:440px; float:right; padding-top: 80px">
                    
                        <div style="font-size:22px; font-weight:bold; color:#383838; text-align: center;">
                            Guia de Transporte: <strong>#{{ $guia->numero_do_folheto }}</strong>
                        </div>
                        <br><br>

                        <div class="col-md-6" style="font-size: 14px; margin-left: 80px; padding-left: 10px;padding-bottom: 10px;padding-top: 10px;padding-right: 10px; border-radius: 10px; border: 1px solid #ccc;">

                            <div class=""><strong>Dados do destinatario:</strong></div> <hr> 
                            <div>
                                <strong style="background-color: rebeccapurple">Destinatario: </strong>{{ $guia->destinatario }} <br>  
                                <strong>Contacto:</strong>{{ $guia->contacto_destinatario }} <br/> 
                                <strong>Nuit:</strong>{{ $guia->nuit_do_destinatario }} <br/> 
                                <strong>Local da descarga:</strong>{{ $guia->local_de_descarga }} <br /> 
                                <strong>Viatura:</strong>{{ $guia->viatura_marca }} <br /> 
                                <strong>Matricula:</strong>{{ $guia->matricula }} <br /> 
                            </div> 

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div style="margin-top:10px;height:125px;">
            <div class="col-md-5" style="margin-left:5px;margin-right:-5px; padding: 10px;">
                <div class=""><strong style="font-size: 14px">TES-TOP, LDA</strong></div> <br>
                <div class="">Av. Karl Max 1877, R/C</div>

                <div class="">Maputo - Mocambique</div>
                <div class="">Contacto(s): <br> Telef. +258 21328056, <br> Fax, +258 21328 057</div>
                <div class="">Email: info@testop.co.mz</div>

            </div>
        </div>

        <br><br><br><br>
        <div style="clear:both"></div>

        <div style="margin-top:30px;">

            <div> <br>
                <span style="text-align:left; font-size:12px; color:#383838; font-weight: 200">Data: {{ $guia->data }}</span>
            </div>


            <table style="width:100%; border-radius:2px;  ">
                <thead> 
                    <tr style="background:#3f9fdf;text-align:center; font-size:12px; font-weight:bold; color: white !important">

                        <td style="color: white;">#Ord. </td> 
                        <td style="color: white;">Nome do Produto/Item</td> 
                        <td style="text-align:center; color: white;">Unidade</td> 
                        <td style="text-align:center; color: white;">Quantidade </td> 

                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($guia->guiaSaida->requisicaoArmazem->requisicaoProduto as $item)
                        <tr style="background-color:#fff; text-align:center; font-size:11px;">
                            <td style="font-size:13px;">{{ $i++ }}</td>
                            <td style="font-size:13px;">{{ $item->produto->nome }}</td>
                            <td style="text-align:center; font-size:13px;">{{ $item->produto->unidade_total }}</td>
                            <td style="font-size:13px; text-align: center">{{ $item->quantidade }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
 

        <div style="position: fixed; font-size:12px; margin-top: 360px left:-1px; bottom:30px; width:100%;   border-radius: 10px; border: 1px solid #ccc;  ">
            <div style="padding: 12px">
                <h6 style="padding-top: -21px; font-size: 11px">Dados do Motorista:</h6> <hr>
                <span><b>Motorista:</b> {{ $guia->motorista }}</span>  |
                <span><b>Carta de Condução:</b> {{ $guia->carta_de_conducao }}</span>  |
                <span><b>Local de Emissão:</b> {{ $guia->local_de_emissao }}</span> |
                <span><b>Contacto do Motorista:</b> {{ $guia->contacto_motorista }}</span>    
            </div>
        </div>


        <br><br>


        <footer class="footer1" style="position:absolute;">

            <div class="container">
                
                
                <div> <br><br><br><br><br><br>
                    <hr>
                    <div style="width:400px; float:left; font-size:10px; color:#383838; font-weight:bold;">

                        <div>Documento processado por Computador</div>

                    </div>

                    <div style="width:160px;font-weight:bold; float:right; font-size:10px; color:#383838;">

                        <div>Licenciado a: TES-TOP, LDA</div>

                    </div>

                </div>

        </footer>

    </body>

</html>
