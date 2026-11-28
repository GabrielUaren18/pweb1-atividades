@extends('layouts.app')

@section('titulo', 'Estacionamentos')

@section('conteudo')
    <h1>Estacionamentos cadastrados</h1>
    <a class="button" href="{{ route('estacionamentos.create') }}">Novo estacionamento</a>

    @forelse ($estacionamentos as $registro)
        <section class="card">
            <h2>
                <a href="{{ route('estacionamentos.show', $registro['id']) }}">
                    {{ $registro['estacionamento']->getNome() }}
                </a>
            </h2>
            <p>Veículos: {{ count($registro['estacionamento']->getVeiculos()) }}</p>
            <ul>
                @foreach ($registro['estacionamento']->getVeiculos() as $veiculo)
                    <li>{{ $veiculo->getPlaca() }} — {{ $veiculo->tipo() }} — {{ $veiculo->getModelo() }}</li>
                @endforeach
            </ul>
            <a href="{{ route('estacionamentos.edit', $registro['id']) }}">Editar</a>
            <form action="{{ route('estacionamentos.destroy', $registro['id']) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Excluir estacionamento</button>
            </form>
        </section>
    @empty
        <p>Nenhum estacionamento cadastrado.</p>
    @endforelse
@endsection
