@extends('layout.master')
@section('title', 'Stock')
@php
$i = 1;
$ano = null;
@endphp

@section('content')
    <div class="page-heading">
        <h1 class="page-title" style="text-transform: uppercase; font-weight: 800">Relatório de Quantidades Resumido</h1>
    </div>
 
    @include('admin.pesquisas.stock.index')
@endSection

@push('javascript')
    @include('admin.pesquisas.stock.script')


@endpush
