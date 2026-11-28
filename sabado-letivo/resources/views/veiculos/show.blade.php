@extends('layouts.app')

@section('titulo', 'Detalhe do veículo')

@section('conteudo')
    <h1>{{ $veiculo->getPlaca() }}</h1>
    <p>Tipo: {{ $veiculo->tipo() }}</p>
    <p>Modelo: {{ $veiculo->getModelo() }}</p>
    <ul>
        <li>1 hora: R$ {{ number_format($veiculo->calcularTarifa(1), 2, ',', '.') }}</li>
        <li>2 horas: R$ {{ number_format($veiculo->calcularTarifa(2), 2, ',', '.') }}</li>
        <li>5 horas: R$ {{ number_format($veiculo->calcularTarifa(5), 2, ',', '.') }}</li>
    </ul>
@endsection
