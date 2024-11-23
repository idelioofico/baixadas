<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title> Baixadas @yield('title')</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="{{ asset('./assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('./assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('./assets/vendors/themify-icons/css/themify-icons.css') }}" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <link href="{{ asset('./assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css') }}" rel="stylesheet" />

    {{-- Datatable --}}
    <link href="{{ asset('./assets/vendors/DataTables/datatables.min.css') }}" rel="stylesheet" />
    {{--  --}}
    <link href="{{ asset('./assets/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="{{ asset('assets/css/main.min.css') }}" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <link href="{{ asset('assets/general_assets/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/general_assets/dataTables.dataTables.min.css') }}" rel="stylesheet" />
 
    <style>

        div.dt-container .dt-search input {
            border-radius: 12px;
            padding: 0px;
        }

        div.dt-container select.dt-input {
            padding: 0px;
        }

        .side-menu>li a:focus,
        .side-menu>li a:hover {
            background-color: #f86818
        }

        .br {
            border-radius: 13px;
        }

        .table td,
        .table th {
            padding: 0;
            font-size: 12px;
        }

        .modal {
            position: fixed;
            top: 30%;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 1050;
            display: none;
            overflow: hidden;
            outline: 0;
        }

        .scrollar {
            overflow: hidden;
            height: 80vh;
            overflow-y: scroll;

        }

        .scrollar::-webkit-scrollbar {
            width: 10px;

            /* color: red */
        }

        .scrollar::-webkit-scrollbar-thumb {
            background-color: rgb(160, 160, 160);
            border-radius: 10px;
            margin-right: 3px;
        }

        .titleProductCategorie {
            font-size: 25px !important;
            white-space: nowrap;
            font-family: timesnewerroman;
            text-decoration: underline;
        }

        @media (max-width: 1000px) {

            .table td,
            .table th {
                padding: 0;
                font-size: 9px;
            }


            .titleProductCategorie {
                font-size: 13px !important;
                white-space: nowrap;
                font-family: timesnewerroman;
                text-decoration: underline;
            }
        }

        .baixada_input {
            height: 34px;
            border: 1px solid #00000040;
            border-radius: 5px;
        }
    </style>
    @stack('css')
</head>

{{--  <body class="fixed-navbar">  --}}

@php
    $check_attr = App\Models\UserAtribution::where([['user_id', Auth::user()->id], ['removido', 0], ['status', 1]])->count();
@endphp

<body class="{{ (Auth::user()->mobile_access == 1 && $check_attr != 0) ? 'fixed-navbar sidebar-mini' : 'fixed-navbar' }}">
    <div class="page-wrapper">

        @include('layout.partials.navbar')
        @include('layout.partials.sidebar')

        <div class="content-wrapper" style="background: #f6f6f6;">

            @yield('content')
            @include('layout.partials.footer')

        </div>
        
    </div>

    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <script src="{{ asset('./assets/vendors/jquery/dist/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/popper.js/dist/umd/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/metisMenu/dist/metisMenu.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('./assets/vendors/chart.js/dist/Chart.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/jvectormap/jquery-jvectormap-2.0.3.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('./assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('./assets/vendors/jvectormap/jquery-jvectormap-us-aea-en.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/js/app.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('./assets/vue/axios.min.js') }}"></script>
    <script src="{{ asset('./assets/vue/vue.js') }}"></script>
    <script src="{{ asset('./assets/vendors/DataTables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/chart.js/dist/Chart.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/general_assets/moment.min.js') }}"></script>
    <script src="{{ asset('assets/general_assets/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/general_assets/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/general_assets/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/general_assets/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/general_assets/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/general_assets/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/general_assets/buttons.print.min.js') }}"></script>

        

    <script src="{{ asset('./assets/moment/moment.js') }}"></script>
    <script src="{{ asset('./assets/custom.js') }}"></script>
    <script src="{{ asset('assets/general_assets/select2.min.js') }}"></script>
    <script src="{{ asset('assets/general_assets/dataTables.min.js') }}"></script>

    <script>

        
        $(document).ready(function() {
            $('.custom_select').select2();
        });

        let table = new DataTable('.myTable');
 
        $('#projecto').on('change', function() {
            var projecto = $(this).val(); 
            if (projecto) {
                $.ajax({
                    url: '/sites_relacioandos/' + projecto,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            $('#site').empty();
                            $('#site').append(
                                '<option selected disabled hidden>Selecione</option>');
                            $.each(data, function(key, row) {
                                $('select[name="site"]').append(
                                    '<option value="' + row.id + '">' +
                                    row.nome + '</option>');
                            });
                        } else {
                            $('#site').append(
                                '<option selected disabled hidden>Sem sites relacionados!</option>'
                            );
                        }
                    }
                });
            } else {
                $('#site').empty();
            }
        });

        $('.provincia_id').on('change', function() {
            
            var provincia = $(this).val(); 
            if (provincia) {
                $.ajax({
                    url: '/distrito_relacionado/' + provincia,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            $('#distrito_id').empty();
                            $('#distrito_id').append(
                                '<option selected disabled hidden>Selecione</option>');
                            $.each(data, function(key, row) {
                                $('select[name="distrito_id"]').append(
                                    '<option value="' + row.id + '">' +
                                    row.nome + '</option>');
                            });
                        } else {
                            $('#distrito_id').append(
                                '<option selected disabled hidden>Sem distritos relacionados!</option>'
                            );
                        }
                    }
                });
            } else {
                $('#site').empty();
            }
        });

        $('.provincia_id').on('change', function() {
            
            var provincia = $(this).val(); 
            if (provincia) {
                $.ajax({
                    url: '/veiculo_relacionado/' + provincia,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {

                        if (data) {
                            $('#veiculo_id').empty();
                            $('#veiculo_id').append(
                                '<option selected disabled hidden>Selecione</option>');
                            $.each(data, function(key, row) {
                                $('select[name="veiculo_id"]').append(
                                    '<option value="' + row.id + '">' +
                                    row.matricula + '</option>');
                            });
                        } else {
                            $('#veiculo_id').append(
                                '<option selected disabled hidden>Sem veiculos relacionados!</option>'
                            );
                        }
                    }
                });
            } else {
                $('#veiculo_id').empty();
            }
        });

    </script>
    @stack('javascript')

</body>

</html>
