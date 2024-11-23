@php
    ini_set('maxdb_execution_time', 3000);
    ini_set('max_execution_time', 3000);
    ini_set('memory_limit', '512M');
    
    date_default_timezone_set('America/Sao_Paulo');
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
@endphp

<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
    <meta charset="UTF-8" http-equiv="Content-Type" content="text/html;">
    <title>Relatório de baixadas: entradas & saidas mensais</title>
</head>

<style>
    @font-face {
        font-family: 'DM Sans';
        font-style: normal;
        font-weight: 400;
        font-display: swap;
        src: url(https://fonts.gstatic.com/s/dmsans/v11/rP2Hp2ywxg089UriCZ2IHSeH.woff2) format('woff2');
        unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
    }

    /* latin */
    @font-face {
        font-family: 'DM Sans';
        font-style: normal;
        font-weight: 400;
        font-display: swap;
        src: url(https://fonts.gstatic.com/s/dmsans/v11/rP2Hp2ywxg089UriCZOIHQ.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
    }

    body {
        font-family: 'DM Sans', sans-serif !important;
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
 
    .footer1 {
        bottom: -10px;
        width: 100%;
        /* Set the fixed height of the footer here */
        height: 230px;
        /*background-color: #f5f5f5*/
        ;
    }

    .footer {
        position: absolute;
        bottom: -340px;
        width: 100%;
        /* Set the fixed height of the footer here */
        height: 350px;
        /*background-color: #f5f5f5*/
        ;
    }

    main {
        position: relative;
        margin-bottom: 9em;

    }
    p{line-height: 2em; font-size: 16px}
</style>


<body onLoad="loadHandler();">
 
   
    <main>
        <div style="margin-top: 0">
            
            <div style="width:100%; text-align: center ">
                <img style="width: 300px; height: 200px" src="assets/logo.png" />
            </div>
            
            <div class="form-group">

                <div style=" ">
                    <div style="margin-right:-5px; padding: 30px; padding-top:0px">
                        <h3>
                            Relatório de baixadas: entradas & saidas mensais {{ ($site) ? ' ('.App\Models\Site::find($site)['nome'] .')' : ''  }} {{ $ano }}
                        </h3> 
                    </div>
                </div>

            </div>
        </div>


        <div style="clear:both"></div>

        <div style=" padding: 10px;">
            
            <table class="table table-hover table-dashed table-striped table-bordered" style="width: 100%">
                <thead style="background: burlywood">
                    <tr> 
                        <th style="padding-bottom: 6px; color: black; text-align: center; font-size: 13px">&nbsp; Nome</th>   
                        @foreach (DB::table('meses')->get() as $mes)
                            <th style="font-size: 13px; text-align: end;">&nbsp; {{ $mes->nome }}</th>   
                        @endforeach 
                    </tr>

                </thead>
               
                <tbody>
                    {!! $table !!}
                </tbody>
                
            </table>

        </div>
         
    </main>

    <footer class="footer">
        <div>  
            <hr>
            <div style="width:600px; float:left; font-size:9px; color:#383838; font-weight:bold;">

                <div>Documento processado por Computador | Impresso por: {{ Auth::user()->name }} | {{ date('d-m-Y h:i') }}</div>

            </div>

            <div style="width:130px;font-weight:bold; float:right; font-size:9px; color:#383838;">

                <div>Licenciado a: Tes-top, Lda</div>

            </div>

        </div>
    </footer>

</body>

</html>
