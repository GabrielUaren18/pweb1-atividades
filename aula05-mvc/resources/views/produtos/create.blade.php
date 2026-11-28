@extends('layouts.app')

@section('titulo', 'Cadastrar veículo')

@section('conteudo')
    <h1>Cadastrar veículo</h1>
    <p>Informe o veículo e o tempo previsto de permanência. A tarifa é calculada conforme o tipo.</p>

    <form class="form-grid" action="{{ route('produtos.store') }}" method="POST">
        @csrf

        <div class="field">
            <label for="tipo">Tipo de veículo</label>
            <select id="tipo" name="tipo">
                <option value="">Selecione</option>
                @foreach (['carro' => 'Carro', 'moto' => 'Moto', 'caminhonete' => 'Caminhonete', 'van' => 'Van'] as $valor => $rotulo)
                    <option value="{{ $valor }}" @selected(old('tipo') === $valor)>{{ $rotulo }}</option>
                @endforeach
            </select>
            @error('tipo') <p class="erro">{{ $message }}</p> @enderror
        </div>

        <div class="field">
            <label for="placa">Placa</label>
            <input id="placa" name="placa" value="{{ old('placa') }}" maxlength="10">
            @error('placa') <p class="erro">{{ $message }}</p> @enderror
        </div>

        <div class="field">
            <label for="modelo">Modelo</label>
            <input id="modelo" name="modelo" value="{{ old('modelo') }}" maxlength="100">
            @error('modelo') <p class="erro">{{ $message }}</p> @enderror
        </div>

        <div class="field">
            <label for="horas">Tempo previsto (horas)</label>
            <input id="horas" name="horas" type="number" step="any" min="0.01" value="{{ old('horas') }}">
            @error('horas') <p class="erro">{{ $message }}</p> @enderror
        </div>

        <button type="submit">Cadastrar</button>
    </form>
@endsection
