@extends('layouts.app')

@section('titulo', 'Contato')

@section('conteudo')
    <h1>Contato</h1>
    <p>Atendimento do Estacionamento Campus: segunda a sexta, das 8h às 18h.</p>
    <a href="{{ route('sobre') }}">Sobre o estacionamento</a>
@endsection
