@extends('layout.master')
@section('title', 'Stock')
@php
$i = 1;
$ano = null;
@endphp

@section('content')
    <div class="page-heading">
        <h1 class="page-title">Stock</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html"><i class="la la-home font-20"></i></a>
            </li> 
        </ol>
    </div>
 
    @include('admin.pesquisas.stock.index')
@endSection

@push('javascript')
    @include('admin.pesquisas.stock.script')


@endpush
