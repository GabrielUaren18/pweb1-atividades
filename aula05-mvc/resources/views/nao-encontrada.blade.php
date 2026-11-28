@extends('layouts.app')

@section('titulo', 'Página não encontrada')

@section('conteudo')
    <h1>404 - Página não encontrada</h1>
    <p>O endereço solicitado não existe neste estacionamento.</p>
    <a href="{{ route('inicio') }}">Voltar ao início</a>
@endsection
