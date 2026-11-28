<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Estacionamento Campus')</title>
</head>
<body>
    @include('partials.menu')

    @if (session('sucesso'))
        <p><strong>{{ session('sucesso') }}</strong></p>
    @endif

    <main>
        @yield('conteudo')
    </main>

    <footer><small>Feito por Gabriel Uaren</small></footer>
</body>
</html>
