@extends('layout.master')
@section('title', 'Stock')
@php
$i = 1;
$ano = null;
@endphp

@section('content')
    <div class="page-heading">
        <h1 class="page-title" style="text-transform: uppercase; font-weight: 800">
            Entradas e Saidas dos Sites
        </h1> <hr>
    </div>



    @include('admin.pesquisas.entradasSaidasSites.index')
@endSection

@push('javascript')
    @include('admin.pesquisas.entradasSaidasSites.script')
@endpush
