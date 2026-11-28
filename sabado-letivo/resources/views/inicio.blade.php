@extends('layouts.app')

@section('titulo', 'Início')

@section('conteudo')
    <h1>{{ $sistema }}</h1>
    <p>{{ $tema }}</p>
    <p>O sistema organiza veículos, tipos e cálculo do valor de permanência no estacionamento.</p>
@endsection
