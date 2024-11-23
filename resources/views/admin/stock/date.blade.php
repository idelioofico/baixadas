@extends('layout.master')
@section('title', 'Stock')
@php
$i = 1;
$ano = null;
@endphp

@section('content')

    <div class="page-heading">
        <h1 class="page-title" style="text-transform: uppercase; font-weight: 800">Entradas de Stock dos Projectos</h1> <hr>
    </div>


    @include('admin.pesquisas.entradasSaidas.index')
@endSection

@push('javascript')
    @include('admin.pesquisas.entradasSaidas.script')
@endpush
