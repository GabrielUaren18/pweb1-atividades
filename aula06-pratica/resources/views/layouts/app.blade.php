<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo', 'Feira Digital')</title>
</head>
<body>
    @include('partials.menu')
    <main>
        @yield('conteudo')
    </main>
</body>
</html>
