@extends('layouts.app')

@section('titulo', 'Feira Digital')

@section('conteudo')
    @if ($paginaSobre)
        <h2>Sobre a Feira Digital</h2>
        <p>A Feira Digital conecta produtores locais e consumidores.</p>
    @else
        <h2>Feira Digital</h2>
        <p>Bem-vindo à Feira Digital.</p>
    @endif
@endsection
