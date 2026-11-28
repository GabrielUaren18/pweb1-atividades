@extends('layouts.app')

@section('titulo', 'Vagas e serviços')

@section('conteudo')
    <h1>Vagas e serviços</h1>
    <table>
        <thead>
            <tr>
                <th scope="col">Serviço</th>
                <th scope="col">Valor</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($produtos as $produto)
                <tr>
                    <td>{{ $produto['nome'] }}</td>
                    <td>
                        @if ($produto['preco'] > 30)
                            <strong class="destaque">R$ {{ number_format($produto['preco'], 2, ',', '.') }}</strong>
                        @else
                            R$ {{ number_format($produto['preco'], 2, ',', '.') }}
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">Nenhuma vaga disponível.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
