@extends('layouts.app')

@section('titulo', 'Novo estacionamento')

@section('conteudo')
    <h1>{{ $estacionamento ? 'Editar estacionamento' : 'Novo estacionamento' }}</h1>
    <p>Escolha um nome e ao menos um veículo para compor o estacionamento.</p>

    <form class="form-grid" action="{{ $estacionamento ? route('estacionamentos.update', $estacionamentoId) : route('estacionamentos.store') }}" method="POST">
        @csrf
        @if ($estacionamento)
            @method('PUT')
        @endif

        <div class="field">
            <label for="nome">Nome do estacionamento</label>
            <input id="nome" name="nome" value="{{ old('nome', $estacionamento?->getNome()) }}" maxlength="100">
            @error('nome') <p class="erro">{{ $message }}</p> @enderror
        </div>

        <div class="field">
            <label for="veiculos">Veículos</label>
            <select id="veiculos" name="veiculos[]" multiple size="6">
                @foreach ($veiculos as $veiculo)
                    <option value="{{ $veiculo->getPlaca() }}" @selected(in_array($veiculo->getPlaca(), old('veiculos', $veiculosSelecionados), true))>
                        {{ $veiculo->getPlaca() }} — {{ $veiculo->tipo() }} — {{ $veiculo->getModelo() }}
                    </option>
                @endforeach
            </select>
            @error('veiculos') <p class="erro">{{ $message }}</p> @enderror
            @foreach ($errors->get('veiculos.*') as $mensagens)
                @foreach ($mensagens as $mensagem)
                    <p class="erro">{{ $mensagem }}</p>
                @endforeach
            @endforeach
        </div>

        <button type="submit">{{ $estacionamento ? 'Salvar alterações' : 'Criar estacionamento' }}</button>
    </form>
@endsection
