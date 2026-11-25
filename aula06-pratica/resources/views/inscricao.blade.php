@extends('layouts.app')

@section('titulo', 'Inscrição')

@section('conteudo')
    <h2>Inscrição de produtores</h2>

    @if (session('sucesso'))
        <p><strong>{{ session('sucesso') }}</strong></p>
    @endif

    <form method="POST" action="{{ route('inscricao.store') }}">
        @csrf

        <div>
            <label for="nome">Nome</label>
            <input id="nome" name="nome" value="{{ old('nome') }}">
            @error('nome') <span>{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}">
            @error('email') <span>{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="produto">Produto</label>
            <input id="produto" name="produto" value="{{ old('produto') }}">
            @error('produto') <span>{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="quantidade">Quantidade</label>
            <input id="quantidade" name="quantidade" type="number" value="{{ old('quantidade') }}">
            @error('quantidade') <span>{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="telefone">Telefone</label>
            <input id="telefone" name="telefone" value="{{ old('telefone') }}">
            @error('telefone') <span>{{ $message }}</span> @enderror
        </div>

        <button type="submit">Enviar</button>
    </form>
@endsection
