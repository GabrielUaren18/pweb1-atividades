@extends('layouts.app')

@section('titulo', 'Início')

@section('conteudo')
    <section class="hero">
        <p class="eyebrow">Estacionamento Campus</p>
        <h1>Seu veículo, bem cuidado.</h1>
        <p>Consulte informações sobre o estacionamento e conheça os serviços disponíveis.</p>
        <a class="button" href="{{ route('sobre') }}">Conheça o estacionamento</a>
    </section>
@endsection
