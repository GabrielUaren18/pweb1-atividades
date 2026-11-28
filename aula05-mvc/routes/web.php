<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/quem-somos', function () {
    return 'O Estacionamento Campus organiza a entrada e a saída de veículos.';
})->name('sobre');

Route::get('/contato', function () {
    return view('contato');
})->name('contato');

Route::get('/inicio', function () {
    return redirect('/');
});

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
