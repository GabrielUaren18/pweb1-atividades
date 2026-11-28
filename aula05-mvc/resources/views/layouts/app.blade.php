<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Estacionamento Campus')</title>
    <link rel="stylesheet" href="{{ asset('css/estilo.css') }}">
</head>
<body>
    @include('partials.menu')

    <main class="container">
        @if (session('sucesso'))
            <p class="alert-success" role="status">{{ session('sucesso') }}</p>
        @endif

        @yield('conteudo')
    </main>

    <footer class="container">
        <small>Estacionamento Campus · Gestão simples de veículos</small>
    </footer>
</body>
</html>
