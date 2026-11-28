@extends('layouts.app')

@section('titulo', 'Cadastrar veículo')

@section('conteudo')
    <h1>Cadastrar veículo</h1>
    <form method="POST" action="{{ route('veiculos.store') }}">
        @csrf
        <p>
            Tipo:
            <select name="tipo">
                <option value="carro" @selected(old('tipo') === 'carro')>Carro</option>
                <option value="moto" @selected(old('tipo') === 'moto')>Moto</option>
                <option value="caminhonete" @selected(old('tipo') === 'caminhonete')>Caminhonete</option>
            </select>
            @error('tipo') <small>{{ $message }}</small> @enderror
        </p>
        <p>
            Placa: <input name="placa" value="{{ old('placa') }}">
            @error('placa') <small>{{ $message }}</small> @enderror
        </p>
        <p>
            Modelo: <input name="modelo" value="{{ old('modelo') }}">
            @error('modelo') <small>{{ $message }}</small> @enderror
        </p>
        <p><button type="submit">Cadastrar</button></p>
    </form>
@endsection
