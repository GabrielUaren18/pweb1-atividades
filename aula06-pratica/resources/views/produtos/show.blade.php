@extends('layouts.app')

@section('titulo', $produto['nome'])

@section('conteudo')
    <h2>{{ $produto['nome'] }}</h2>
    <p>Categoria: {{ $produto['categoria'] }}</p>
    <p>Estoque: {{ $produto['estoque'] }}</p>
    <p>Preço: R$ {{ number_format($produto['preco'], 2, ',', '.') }}</p>
    <a href="{{ route('produtos.index') }}">Voltar aos produtos</a>
@endsection
