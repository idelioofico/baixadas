@extends('layout.master')

@section('title', 'Dashboard')

<style>
    .quadrat {
        -webkit-animation: NAME-YOUR-ANIMATION 2s infinite;  /* Safari 4+ */
    }

    @-webkit-keyframes NAME-YOUR-ANIMATION {
        0%, 49% {
            padding: 10px;
            background-color: rgb(255, 255, 255);
        }
        50%, 100% {
            background-color: #e500001f;
        }
    }
</style>

@section('content')
    <div class="page-content fade-in-up">
        {{-- <div class="row">
            <div class="col-md-12" style="text-align: center;">
                <img src="{{ asset('coming.png') }}" alt="">
            </div>
        </div> --}}
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="ibox bg-success color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong" id="card-entrada">
                            {{ 0 }}
                        </h2>
                        <div class="m-b-5">Guias de Entrada</div><i class="ti-shopping-cart widget-stat-icon"></i>
                        <div><i class="fa fa-level-up m-r-5"></i><small></small></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="ibox bg-info color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">

                            {{ 0 }}</h2>
                        <div class="m-b-5">Guias de Saida</div><i class="ti-bar-chart widget-stat-icon"></i>
                        <div><i class="fa fa-level-up m-r-5"></i><small></small></div>
                    </div>
                </div>
            </div>  

        </div>



        <style>
            .visitors-table tbody tr td:last-child {
                display: flex;
                align-items: center;
            }

            .visitors-table .progress {
                flex: 1;
            }

            .visitors-table .progress-parcent {
                text-align: right;
                margin-left: 10px;
            }

        </style>

    </div>


@endsection
