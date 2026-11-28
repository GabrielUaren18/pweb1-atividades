@extends('layouts.app')

@section('titulo', 'Veículo ' . $veiculo->getPlaca())

@section('conteudo')
    <h1>{{ $veiculo->getPlaca() }}</h1>
    <p>Tipo: {{ $veiculo->tipo() }}</p>
    <p>Modelo: {{ $veiculo->getModelo() }}</p>

    <h2>Tarifas</h2>
    <ul>
        @foreach ([1, 2, 5] as $horas)
            <li>{{ $horas }} hora(s): R$ {{ number_format($veiculo->calcularTarifa($horas), 2, ',', '.') }}</li>
        @endforeach
    </ul>

    <a href="{{ route('produtos.index') }}">Voltar aos veículos</a>
@endsection
