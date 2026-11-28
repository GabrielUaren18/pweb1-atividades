@extends('layouts.app')

@section('titulo', 'Veículos')

@section('conteudo')
    <h1>Veículos no estacionamento</h1>
    <ul>
        @forelse ($veiculos as $indice => $veiculo)
            <li>
                <a href="{{ route('veiculos.show', $indice) }}">{{ $veiculo->getPlaca() }}</a>
                ({{ $veiculo->tipo() }}):
                {{ $veiculo->getModelo() }} — 2 horas custam R$ {{ number_format($veiculo->calcularTarifa(2), 2, ',', '.') }}
            </li>
        @empty
            <li>Nenhum veículo cadastrado.</li>
        @endforelse
    </ul>
@endsection
