@extends('layout.master')
@section('title', 'Fornecedores')
@php
$i = 1;
$ano = null;
@endphp

@section('content')
 

<div class="row mt-5 mb-5">
    @php
        $searchDropdown = 'Fornecedor';
    @endphp
    {{-- <div class="col-md-6">
        @include('layout.partials.searchDropdown')
    </div> --}}
</div>
    @include('admin.pesquisas.fornecedor.index')

@endSection
@push('javascript')
    @include('admin.pesquisas.fornecedor.script')
@endpush
