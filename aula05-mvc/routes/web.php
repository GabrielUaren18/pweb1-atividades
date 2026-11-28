<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('inicio');
})->name('inicio');

Route::get('/quem-somos', function () {
    return view('sobre');
})->name('sobre');

Route::get('/contato', function () {
    return view('contato');
})->name('contato');

Route::get('/inicio', function () {
    return redirect('/');
});

Route::get('/produtos', function () {
    return view('produtos.index', [
        'produtos' => [
            ['nome' => 'Vaga coberta para carro', 'preco' => 42.00],
            ['nome' => 'Vaga para motocicleta', 'preco' => 18.00],
            ['nome' => 'Vaga com carregamento elétrico', 'preco' => 36.50],
        ],
    ]);
})->name('produtos.index');

Route::get('/produtos/{id}', function (int $id) {
    return "Produto {$id} solicitado no Estacionamento Campus.";
})->whereNumber('id');

Route::get('/saudacao/{nome?}', function (string $nome = 'visitante') {
    return "Olá, {$nome}!";
});

Route::post('/mensagem', function () {
    return 'Mensagem do Estacionamento Campus recebida.';
})->name('mensagem.store');

Route::fallback(function () {
    return response()->view('nao-encontrada', [], 404);
});
