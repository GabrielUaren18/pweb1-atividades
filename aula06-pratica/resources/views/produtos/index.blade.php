@extends('layouts.app')

@section('titulo', 'Produtos')

@section('conteudo')
    <h2>Produtos da feira</h2>
    <ul>
        @forelse ($produtos as $id => $produto)
            <li>
                <a href="{{ route('produtos.show', $id) }}">{{ $produto['nome'] }}</a>
                @if ($produto['estoque'] === 0)
                    - <strong>Esgotado</strong>
                @else
                    - Estoque: {{ $produto['estoque'] }}
                @endif
            </li>
        @empty
            <li>Nenhum produto encontrado.</li>
        @endforelse
    </ul>
@endsection
