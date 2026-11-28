@extends('layouts.app')

@section('titulo', 'Veículos')

@section('conteudo')
    <h1>Veículos no estacionamento</h1>
    <table>
        <thead>
            <tr>
                <th scope="col">Veículo</th>
                <th scope="col">Tipo e modelo</th>
                <th scope="col">Tarifa de 5 horas</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($veiculos as $id => $veiculo)
                <tr>
                    <td><a href="{{ route('produtos.show', $id) }}">{{ $veiculo->getPlaca() }}</a></td>
                    <td>{{ $veiculo->tipo() }} — {{ $veiculo->getModelo() }}</td>
                    <td>
                        @if ($veiculo->calcularTarifa(5) > 30)
                            <strong class="destaque">R$ {{ number_format($veiculo->calcularTarifa(5), 2, ',', '.') }}</strong>
                        @else
                            R$ {{ number_format($veiculo->calcularTarifa(5), 2, ',', '.') }}
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Nenhum veículo no estacionamento.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
