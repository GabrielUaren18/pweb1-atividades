@extends('layouts.app')

@section('titulo', $estacionamento->getNome())

@section('conteudo')
    <h1>{{ $estacionamento->getNome() }}</h1>
    <p>Veículos que compõem este estacionamento:</p>

    <ul>
        @foreach ($estacionamento->getVeiculos() as $veiculo)
            <li>{{ $veiculo->getPlaca() }} — {{ $veiculo->tipo() }} — {{ $veiculo->getModelo() }}</li>
        @endforeach
    </ul>

    <p>
        <a href="{{ route('estacionamentos.edit', $id) }}">Editar estacionamento</a>
        · <a href="{{ route('estacionamentos.index') }}">Voltar aos estacionamentos</a>
    </p>
@endsection
